<?php
require_once "template.php";

require_once "Connect.php";





$req_sql_solde_initial = "SELECT * FROM carte_sim";

$execution_req_sql_initial = $db->query($req_sql_solde_initial);


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER SOLDE INITIAL </h3>

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

                                            <?php while ($row = $execution_req_sql_initial->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE DATA :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="s_data" id="s_data" value="<?php echo $_GET['s_data']  ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE SMS :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="s_sms" id="s_sms" value="<?php echo $_GET['s_sms']  ?>">
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE MINUTE :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="s_minute" id="s_minute" value="<?php echo $_GET['s_minute']  ?>">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SOLDE CREDIT:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="s_credit" id="s_credit" value="<?php echo $_GET['s_credit']  ?>">
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






        <?php






        $sql = null;




        if (isset($_POST['enregistrer'])) {


            /* $id= $_GET['id_employe'];
    $service= $_POST['nom_employe'];
    $prenom = $_POST['prenom_employe'];
    $maticule = $_POST['matricule_employe'];
    $poste = $_POST['poste'];
    */

            $id_solde_ini = $_GET['id_solde_ini'];
            $cartesim = $_POST['id_carte_sim'];
            $data_initial = $_POST['s_data'];
            $sms_initial = $_POST['s_sms'];
            $minute_initiale = $_POST['s_minute'];
            $credit_initial = $_POST['s_credit'];
            $dates = $_POST['dates'];


            if (isset($_GET['id_solde_ini']) && isset($_POST['id_carte_sim']) && isset($_POST['s_data']) && isset($_POST['s_sms']) && isset($_POST['s_minute']) && isset($_POST['dates']) && isset($_POST['s_credit'])) {
                $sql = " UPDATE  Solde_initial SET s_data = . '$data_initial' . ,s_sms= . '$sms_initial' . ,s_minute= . '$minute_initiale' . ,s_credit= . '$credit_restant' . , created_at= . '$dates' .  WHERE  (id_solde_ini = . '$id_solde_ini' .) ";

                // utilise exec() car aucun résultat n'est renvoyé
                $db->exec($sql);
                //creation de l'enregistrement
                echo " modifier crée avec success ";
            } else {
                echo "  refusé   ";
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
