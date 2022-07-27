<?php
require_once "template.php";

require_once "Connect.php";

$sql1 = "SELECT id_carte_sim, numero_sim FROM carte_sim ";

$stmt1 = $db->query($sql1);



?>



<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UN ACHAT </h3>

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
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="vol" id="vol" pattern="[0-9]+" required>
                                    </div>
                                </div>



                            </div>
                            <div class="col-xs-5">

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MONTANT :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="montant" id="montant" pattern="[0-9]+" required>


                                    </div>
                                </div>




                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">DATE :</label>
                                    <div class="col-sm-8">


                                        <input type="date" class="form-control" name="dates" id="dates" required>

                                    </div>
                                </div>

                            </div>

                            <div class="col-xs-2">

                                <p>
                                    <button type="submit" class="btn btn-primary" name="enregistrer">Valider </button>
                                </p>

                            </div>
                </form>












            </div><!--  col-xs-5-->
        </div>
    </div>

    <?php

    $sql = null;
    /*   $volume = null;
    $montant = null ;
    $date = null ; */

    if (isset($_POST['enregistrer'])) {


        $type_pass = $_POST['type_pass'] === "SMS";
        $id_carte_sim = $_POST['id_carte_sim'];


        if ($type_pass === true) {


            if (isset($_POST['vol']) && isset($_POST['montant']) && isset($_POST['dates'])) {

                $volume = htmlspecialchars($_POST['vol']);
                $montant = htmlspecialchars($_POST['montant']);
                $dates = ($_POST['dates']);

                /*  var_dump($dates);
                exit ; */


                $regex_volume = preg_match_all('/[0-9]+/', $volume);
                $regex_montant = preg_match_all('/[0-9]+/', $montant);
                $int_positif = (is_int($volume) || ctype_digit($montant)) && ((int)$volume > 0 && (int)$montant > 0);



                if ($regex_volume && $regex_montant && $int_positif) {


                    $sql = "INSERT INTO achat_de_pass (vol_sms,montant_achat,id_carte_sim) 
                    VALUES ('$volume','$montant','$id_carte_sim')";
                    $db->exec($sql);

                    echo "<div class='alert alert-success'>";
                    echo  " Nouvel enregistrement crée avec success ";
                    echo " </div>";
                } else {

                    echo "<div class='alert alert-danger'>";
                    echo  " Nouvel enregistrement refusé   <br>";
                    echo " </div>";
                }
            }
        }
    }
