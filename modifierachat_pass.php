<?php
require_once "template.php";

require_once "Connect.php";

$sql1 = "SELECT id_carte_sim, numero_sim FROM carte_sim ";

$stmt1 = $db->query($sql1);



?>



<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UN ACHAT DE PASS </h3>

            <div class="panel panel-primary">

                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->


                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">CARTE SIM:</label>
                                    <div class="col-sm-6">
                                        <select name="id_carte_sim" class="form-control" required>
                                            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">TYPE PASS :</label>
                                    <div class="col-sm-6">
                                        <select name="type_pass" class="form-control" required>
                                            <option disabled selected value> Selectionner un pass </option>


                                            <option name="SMS">SMS</option>
                                            <option name="data">DATA</option>
                                            <option name="MINUTES">MINUTES</option>




                                        </select>



                                    </div>




                                </div>


                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">VOLUME :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="vol" id="vol" pattern="[0-9]+" value=" <?php if (isset($_GET['vol_sms']) && !empty($_GET['vol_sms'])) {
                                                                                                                                    echo $_GET['vol_sms'];
                                                                                                                                } ?>
                                                                                                                                <?php
                                                                                                                                if (isset($_GET['vol_data']) && !empty($_GET['vol_data'])) {
                                                                                                                                    echo $_GET['vol_data'];
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                                <?php
                                                                                                                                if (isset($_GET['vol_min']) && !empty($_GET['vol_min'])) {
                                                                                                                                    echo $_GET['vol_min'];
                                                                                                                                } ?>" required>
                                    </div>
                                </div>



                            </div>
                            <div class="col-xs-5">

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MONTANT :</label>
                                    <div class="col-sm-6">

                                        <input type="text" class="form-control" name="montant" id="montant" pattern="[0-9]+" value="<?php echo $_GET['montant_achat']  ?>" required>
                                        <br>
                                        <button type="submit" class="btn btn-primary" name="enregistrer">Valider </button>



                                    </div>
                                </div>

                            </div>












                        </div><!--  col-xs-5-->
                    </div>
            </div>

            <?php

            $sql = null;
            $update_achat_de_pass_sms = null;
            $update_achat_de_pass_data = null;
            $update_achat_de_pass_minute = null;

            $tab_error = [];

            $tab_success = [];


            if (isset($_POST['enregistrer'])) {

                $id_achat = $_GET['id_achat'];
                $type_pass_sms = $_POST['type_pass'] === "SMS";
                $type_pass_data = $_POST['type_pass'] === "DATA";
                $type_pass_minute = $_POST['type_pass'] === "MINUTES";
                $id_carte_sim = $_POST['id_carte_sim'];

                if ((isset($_GET['id_achat']) && isset($_POST['id_carte_sim']) && isset($_POST['type_pass']) && isset($_POST['vol'])  && isset($_POST['montant']))) {




                    if ($type_pass_sms === true) {


                        if (isset($_POST['vol']) && !empty($_POST['vol']) && isset($_POST['montant']) && !empty($_POST['montant'])) {

                            $volume_sms = htmlspecialchars($_POST['vol']);
                            $montant_sms = htmlspecialchars($_POST['montant']);




                            $regex_volume_sms = preg_match_all("/[0-9]+/", $volume_sms);
                            $regex_montant_sms = preg_match_all("/[0-9]+/", $montant_sms);
                            $int_positif_sms = (is_int($volume_sms) || ctype_digit($montant_sms)) && ((int)$volume_sms > 0 && (int)$montant_sms > 0);



                            if ($regex_volume_sms && $regex_montant_sms && $int_positif_sms) {


                                $update_achat_de_pass_sms = "UPDATE achat_de_pass SET vol_min= NULL, vol_data= NULL, vol_sms='$volume_sms', montant_achat='$montant_sms', id_carte_sim='$id_carte_sim' WHERE  (id_achat ='$id_achat')";
                                $db->exec($update_achat_de_pass_sms);

                                echo "<div class='alert alert-success'>";
                                echo " Modifié avec success ";
                                echo " </div>";
                                exit;
                            } else {

                                echo "<div class='alert alert-danger'>";
                                echo  " Nouvel enregistrement refusé   <br>";
                                echo " </div>";
                                exit;
                            }
                        }
                    }


                    if ($type_pass_data === true) {


                        if (isset($_POST['vol']) && !empty($_POST['vol']) && isset($_POST['montant']) && !empty($_POST['montant'])) {

                            $volume_data = htmlspecialchars($_POST['vol']);
                            $montant_data = htmlspecialchars($_POST['montant']);

                            /*  var_dump($dates);
                exit ; */


                            $regex_volume_data = preg_match_all('/[0-9]+/', $volume_data);
                            $regex_montant_data = preg_match_all('/[0-9]+/', $montant_data);
                            $int_positif_data = (is_int($volume_data) || ctype_digit($montant_data)) && ((int)$volume_data > 0 && (int)$montant_data > 0);



                            if ($regex_volume_data && $regex_montant_data && $int_positif_data) {


                                $update_achat_de_pass_data = "UPDATE achat_de_pass SET vol_min=NULL, vol_sms=NULL, vol_data='$volume_data', montant_achat='$montant_data', id_carte_sim='$id_carte_sim' WHERE  (id_achat ='$id_achat')";
                                $db->exec($update_achat_de_pass_data);

                                echo "<div class='alert alert-success'>";
                                echo " Modifié avec success ";
                                echo " </div>";
                                exit;
                            } else {

                                echo "<div class='alert alert-danger'>";
                                echo  " Nouvel enregistrement refusé   <br>";
                                echo " </div>";
                                exit;
                            }
                        }
                    }

                    if ($type_pass_minute === true) {


                        if (isset($_POST['vol']) && !empty($_POST['vol']) && isset($_POST['montant']) && !empty($_POST['montant'])) {

                            $volume_minute = htmlspecialchars($_POST['vol']);
                            $montant_minute = htmlspecialchars($_POST['montant']);


                            /*  var_dump($dates);
                exit ; */


                            $regex_volume_minute = preg_match_all('/[0-9]+/', $volume_minute);
                            $regex_montant_minute = preg_match_all('/[0-9]+/', $montant_minute);
                            $int_positif_minute = (is_int($volume_minute) || ctype_digit($montant_minute)) && ((int)$volume_minute > 0 && (int)$montant_minute > 0);



                            if ($regex_volume_minute && $regex_montant_minute && $int_positif_minute) {


                                $update_achat_de_pass_minute = "UPDATE achat_de_pass SET vol_sms=NULL, vol_data=NULL, vol_min='$volume_minute', montant_achat='$montant_minute', id_carte_sim='$id_carte_sim' WHERE  (id_achat ='$id_achat')";
                                $db->exec($update_achat_de_pass_minute);

                                echo "<div class='alert alert-success'>";
                                echo " Modifié avec success ";
                                echo " </div>";
                                exit;
                            } else {

                                echo "<div class='alert alert-danger'>";
                                echo  " Nouvel enregistrement refusé   <br>";
                                echo " </div>";
                                exit;
                            }
                        }
                    }
                } elseif (!(isset($_GET['id_achat']) && isset($_POST['id_carte_sim']) && isset($_POST['type_pass']) && isset($_POST['vol'])  && isset($_POST['montant']))) {

                    echo "<div class='alert alert-danger'>";
                    echo " Modification refusé   <br>";
                    echo " </div>";
                }
                /*  if ($_POST['enregistrer'] === "") {
            
            echo "<div class='alert alert-danger'>";
            echo " Champ(s) vide(s)";
            echo " </div>";
        } */
            } /* elseif (!(isset( $_POST['id_carte_sim'] ) && isset($_POST['type_pass'])
    && isset($_POST['vol'])  && isset($_POST['montant']) && isset($_POST['dates']))) {


    echo "<div class='alert alert-danger'>";
    echo  " Nouvel enregistrement refusé   <br>";
    echo " </div>";
} */
