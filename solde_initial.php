<?php
require_once "template.php";

require_once "Connect.php";


$sql1 = "SELECT * FROM carte_sim";

$stmt1 = $db->query($sql1);


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UN SOLDE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">CARTE SIM :</label>
                                    <div class="col-sm-6">
                                        <select name="id_carte_sim" class="form-control" required>

                                            /* affiche les id des cartes sim avec les numero corespondant *\

                                            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE DATA :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="s_data" id="s_data" pattern="[0-9]+" title=" exemple de format 550" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE SMS :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="s_sms" id="s_sms" pattern="[0-9]+" title=" exemple de format 55 ou 55.5" required>
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE MIN :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="s_minute" id="s_minute" pattern="[0-9]+" title=" exemple de format 550" required>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE CREDIT:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="s_credit" id="s_credit" pattern="[0-9]+" title=" exemple de format 550" required>
                                    </div>


                                </div>

                            </div><!--  /col-xs-5>-->
                            <div class="col-xs-2">
                                <p>
                                    <button type="submit" class="btn btn-primary" name="enregistrer">Valider </button>
                                </p>

                            </div>
                            <!--col-xs-2 -->
                        </div>
                        <!--col-xs-12 -->

                    </div>
                    <!--row -->

                </form> <!--  /form>-->



            </div>

        </div>
    </div>



    <?php
    $sql = null;
    if (isset($_POST['enregistrer'])) {


        $cartesim = $_POST['id_carte_sim'];
        $data_initial = $_POST['s_data'];
        $sms_initial = $_POST['s_sms'];
        $minute_initial = $_POST['s_minute'];
        $credit_initial = $_POST['s_credit'];








        if (
            isset($_POST['s_credit']) &&  isset($_POST['s_data'])
            && isset($_POST['s_sms']) && isset($_POST['s_minute']) &&  isset($_POST['id_carte_sim'])
        ) {

            $solde_ini_data = htmlspecialchars($_POST['s_data']);
            $solde_ini_sms = htmlspecialchars($_POST['s_sms']);
            $solde_ini_minute = htmlspecialchars($_POST['s_minute']);
            $solde_ini_credit = htmlspecialchars($_POST['s_credit']);




            $regex_solde_ini_data = preg_match_all('/[0-9]+/', $solde_ini_data);
            $regex_solde_ini_sms = preg_match_all('/[0-9]+/', $solde_ini_sms);
            $regex_solde_ini_minute = preg_match_all('/[0-9]+/', $solde_ini_minute);
            $regex_solde_ini_credit = preg_match_all('/[0-9]+/', $solde_ini_credit);

            $int_positif_data = (is_int($solde_ini_data) || ctype_digit($solde_ini_data)) && ((int)$solde_ini_data > 0);
            $int_positif_sms = (is_int($solde_ini_sms) || ctype_digit($solde_ini_sms)) && ((int)$solde_ini_sms > 0);
            $int_positif_minute = (is_int($solde_ini_minute) || ctype_digit($solde_ini_minute)) && ((int)$solde_ini_minute > 0);
            $int_positif_credit = (is_int($solde_ini_credit) || ctype_digit($solde_ini_credit)) && ((int)$solde_ini_credit > 0);


            if (($regex_solde_ini_data && $int_positif_data) && ($regex_solde_ini_sms && $int_positif_sms) && ($regex_solde_ini_minute && $int_positif_minute) && ($regex_solde_ini_credit && $int_positif_credit)) {

                $sql = " INSERT INTO solde_initial (s_credit,s_data,s_sms,s_minute,id_carte_sim) 
                VALUES ('$credit_initial','$data_initial','$sms_initial','$minute_initial','$cartesim') ";
                // utilise exec() car aucun résultat n'est renvoyé
                $db->exec($sql);
                //creation de l'enregistrement
                echo "<div class='alert alert-success'>";
                echo " Nouvel enregistrement crée avec succes ";
                echo " </div>";
            } else {
                echo "<div class='alert alert-danger'>";
                echo " Nouvel enregistrement refusé ";
                echo " </div>";
            }
        } elseif (!(isset($_POST['id_carte_sim']) && isset($_POST['s_data']) && isset($_POST['s_sms'])  && isset($_POST['s_minute']) && isset($_POST['s_credit']))) {

            echo "<div class='alert alert-danger'>";
            echo  " Nouvel enregistrement refusé   <br>";
            echo " </div>";
        }
    }
