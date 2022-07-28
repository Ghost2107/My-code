<?php
require_once "template.php";

require_once "Connect.php";





$req_sql_solde_restant = "SELECT * FROM carte_sim";

$execution_req_sql_restant = $db->query($req_sql_solde_restant);


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER SOLDE RESTANT </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->
                                <div class="form-group">

                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">CARTE SIM:</label>
                                    <div class="col-sm-6">
                                        <select name="id_carte_sim" class="form-control" value="<?php echo $_GET['numero_sim']  ?>">

                                            /* affiche les id des cartes sim avec les numero corespondant *\

                                            <?php while ($row = $execution_req_sql_restant->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE DATA RESTANT :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sr_data" id="sr_data" value="<?php echo $_GET['sr_data']  ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE SMS RESTANT :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sr_sms" id="sr_sms" value="<?php echo $_GET['sr_sms']  ?>">
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE MINUTE RESTANT :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="sr_minute" id="sr_minute" value="<?php echo $_GET['sr_minute']  ?>">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE CREDIT RESTANT:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sr_credit" id="sr_credit" value="<?php echo $_GET['sr_credit']  ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">DATE :</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dates" id="dates" value="<?php echo $_GET['dates']  ?>">

                                    </div>
                                </div>
                            </div><!--  /col-xs-5>-->
                            <div class="col-xs-2">
                                <p>
                                    <button type="submit" class="btn btn-primary" name="enregistrer_restant">Valider </button>
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




    if (isset($_POST['enregistrer_restant'])) {


        /* $id= $_GET['id_employe'];
   $service= $_POST['nom_employe'];
   $prenom = $_POST['prenom_employe'];
   $maticule = $_POST['matricule_employe'];
   $poste = $_POST['poste'];
   */

        $id_solde_rest = $_GET['id_solde_rest'];
        $cartesim = $_POST['id_carte_sim'];
        $data_restant = $_POST['sr_data'];
        $sms_restant = $_POST['sr_sms'];
        $minute_restante = $_POST['sr_minute'];
        $credit_restant = $_POST['sr_credit'];
        $dates = $_POST['dates'];


        if (isset($_GET['id_solde_rest']) && isset($_POST['id_carte_sim']) && isset($_POST['sr_data']) && isset($_POST['sr_sms']) && isset($_POST['sr_minute']) && isset($_POST['sr_credit']) && isset($_POST['dates'])) {

            $sql = " UPDATE  Solde_restant SET sr_data = '$data_restant' , sr_sms= '$sms_restant' ,sr_minute = '$minute_restante', sr_credit= '$credit_restant' WHERE  (id_solde_rest = '$id_solde_rest') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($sql);
            //creation de l'enregistrement
            echo "<div class='alert alert-success'>";
            echo " Modifié avec success ";
            echo " </div>";
        } elseif (!(isset($_GET['id_solde_rest']) && isset($_POST['id_carte_sim']) && isset($_POST['sr_data']) && isset($_POST['sr_sms']) && isset($_POST['sr_minute']) && isset($_POST['sr_credit']) && isset($_POST['dates']))) {

            echo "<div class='alert alert-danger'>";
            echo "  Modification refusé   ";
            echo " </div>";
        }
    }



/*

$sql = null;


if (isset($_POST['enregistrer'])) {

$id=$_GET['id_solde'];
$data = $_POST['s_data'];
$sms = $_POST['s_sms'];
$minute = $_POST['s_minute'];
$dateexpi = $_POST['date_dexpi'];
$credit = $_POST['s_credit'];
$cartesim = $_POST['id_carte_sim'];


if(isset($_POST['s_data']) && isset($_POST['s_sms']) && isset($_POST['s_minute'])
&& isset($_POST['date_dexpi']) && isset($_POST['s_credit'])  && isset($_POST['id_carte_sim'])) {
   
   $sql1 = " UPDATE Solde set s_data='".$data."',s_sms='".$sms."',s_minute='".$minute."',date_dexpi='".$dateexpi."',s_credit='".$credit."',id_carte_sim='".$cartesim."'  where (id_solde ='".$id."') ";
       // utilise exec() car aucun résultat n'est renvoyé
       $db->exec($sql);
       //creation de l'enregistrement
       echo " Nouvel enregistrement crée avec succes ";
   } else {
       echo " Nouvel enregistrement refusé ";
       
   }
}*/
