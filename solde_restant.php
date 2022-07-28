<?php
require_once "template.php";

require_once "Connect.php";


$sql1 = "SELECT * FROM carte_sim";

$stmt1 = $db->query($sql1);


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> SOLDE RESTANT </h3>

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

                                            /* affiche les id des cartes sim avec les numero corespondant *\

                                            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label"> DATA RESTANT :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sr_data" id="sr_data" pattern="[-+]?[0-9]+(\.[0-9]+)?([eE][-+]?[0-9]+)?" title=" exemple de format 55 ou 55.5" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label"> SMS RESTANT :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sr_sms" id="sr_sms" pattern="[0-9]+" title=" exemple de format 55 ou 55.5" required>
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label"> MINUTE RESTANTE :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="sr_minute" id="sr_minute" pattern="[-+]?[0-9]+(\.[0-9]+)?([eE][-+]?[0-9]+)?" title="exemple de farmat 55 ou 55.5 " required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">DATE:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dates" id="dates" required>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">CREDIT RESTANT:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sr_credit" id="sr_credit" pattern="[0-9]+" title=" exemple de format 550" required>
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
        if (isset($_POST['enregistrer'])) 
    {


            $cartesim = $_POST['id_carte_sim'];
            $data_restant = $_POST['sr_data'];
            $sms_restant = $_POST['sr_sms'];
            $minute_restante = $_POST['sr_minute'];
            $dates = $_POST['dates'];
            $credit_restant = $_POST['sr_credit'];


            if (  isset($_POST['sr_data']) && isset($_POST['sr_data']) && isset($_POST['sr_data']) && isset($_POST['sr_sms'])
                && isset($_POST['sr_minute']) &&  isset($_POST['dates']) && isset($_POST['sr_credit']) ) 
        {

                $solde_rest_data = htmlspecialchars($_POST['sr_data']);
                $solde_rest_sms = htmlspecialchars($_POST['sr_sms']);
                $solde_rest_minute = htmlspecialchars($_POST['sr_minute']);
                $solde_rest_credit = htmlspecialchars($_POST['sr_credit']);
                $solde_rest_dates= ($_POST['dates']);

                $regex_solde_rest_data = preg_match_all('/[0-9]+/', $solde_rest_data);
                $regex_solde_rest_sms = preg_match_all('/[0-9]+/', $solde_rest_sms);
                $regex_solde_rest_minute = preg_match_all('/[0-9]+/', $solde_rest_minute);
                $regex_solde_rest_credit = preg_match_all('/[0-9]+/', $solde_rest_credit);

                $int_positif_rest_data = (is_int($solde_rest_data) || ctype_digit($solde_rest_data)) && ((int)$solde_rest_data > 0 );
                $int_positif_rest_sms = (is_int($solde_rest_sms) || ctype_digit($solde_rest_sms)) && ((int)$solde_rest_sms > 0 );
                $int_positif_rest_minute = (is_int($solde_rest_minute) || ctype_digit($solde_rest_minute)) && ((int)$solde_rest_minute > 0 );
                $int_positif_rest_credit = (is_int($solde_rest_credit) || ctype_digit($solde_rest_credit)) && ((int)$solde_rest_credit > 0 );


                  if ( ($regex_solde_rest_data && $int_positif_rest_data) && ($regex_solde_rest_sms && $int_positif_rest_sms) && ($regex_solde_rest_minute && $int_positif_rest_minute) && ($regex_solde_rest_credit && $int_positif_rest_credit) )
       
            {



                $sql = " INSERT INTO solde_restant (sr_credit,sr_data,sr_sms,sr_minute,id_carte_sim) 
                VALUES ('$credit_restant','$data_restant','$sms_restant','$minute_restante','$cartesim') ";
                // utilise exec() car aucun résultat n'est renvoyé
                $db->exec($sql);
                echo "<div class='alert alert-success'>";
                echo " Nouvel enregistrement crée avec succes ";
                echo " </div>";
            }     else {
                echo "<div class='alert alert-danger'>";
                echo " Nouvel enregistrement refusé ";
                echo " </div>";
               
            }

            
            
        } elseif ( !(isset( $_POST['id_carte_sim'] ) && isset($_POST['s_data']) && isset($_POST['s_sms'])  && isset($_POST['s_minute']) && isset($_POST['s_credit']) && isset($_POST['dates'])) ) {

                echo "<div class='alert alert-danger'>";
                echo  " Nouvel enregistrement refusé   <br>";
                echo " </div>";
        
        
            }


    }
