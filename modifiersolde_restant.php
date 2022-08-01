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
                                    <label class=" col-sm-4 control-label">CARTE SIM :</label>
                                    <div class="col-sm-6">
                                        <select name="id_carte_sim" class="form-control" value="<?php echo $_GET['numero_sim']  ?>">

                                            /* affiche les id des cartes sim avec les numeros corespondant *\

                                            <?php while ($row = $execution_req_sql_restant->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">DATA :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="sr_data" id="sr_data" pattern="[0-9]+" value="<?php echo $_GET['sr_data']  ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">SMS :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="sr_sms" id="sr_sms" pattern="[0-9]+" value="<?php echo $_GET['sr_sms']  ?>">
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MINUTE :</label>
                                    <div class="col-sm-6">

                                        <input type="text" class="form-control" name="sr_minute" id="sr_minute" pattern="[0-9]+" value="<?php echo $_GET['sr_minute']  ?>">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">CREDIT :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="sr_credit" id="sr_credit" pattern="[0-9]+" value="<?php echo $_GET['sr_credit']  ?>">
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


        if (isset($_GET['id_solde_rest']) && isset($_POST['id_carte_sim']) && isset($_POST['sr_data']) && isset($_POST['sr_data']) && isset($_POST['sr_data']) && isset($_POST['sr_sms']) && isset($_POST['sr_minute']) && isset($_POST['sr_credit'])) {

            $id_solde_rest = $_GET['id_solde_rest'];
            $carte_sim = htmlspecialchars($_POST['id_carte_sim']);
            $solde_rest_data = htmlspecialchars($_POST['sr_data']);
            $solde_rest_sms = htmlspecialchars($_POST['sr_sms']);
            $solde_rest_minute = htmlspecialchars($_POST['sr_minute']);
            $solde_rest_credit = htmlspecialchars($_POST['sr_credit']);

            $regex_solde_rest_data = preg_match_all('/[0-9]+/', $solde_rest_data);
            $regex_solde_rest_sms = preg_match_all('/[0-9]+/', $solde_rest_sms);
            $regex_solde_rest_minute = preg_match_all('/[0-9]+/', $solde_rest_minute);
            $regex_solde_rest_credit = preg_match_all('/[0-9]+/', $solde_rest_credit);

            $int_positif_rest_data = (is_int($solde_rest_data) || ctype_digit($solde_rest_data)) && ((int)$solde_rest_data > 0);
            $int_positif_rest_sms = (is_int($solde_rest_sms) || ctype_digit($solde_rest_sms)) && ((int)$solde_rest_sms > 0);
            $int_positif_rest_minute = (is_int($solde_rest_minute) || ctype_digit($solde_rest_minute)) && ((int)$solde_rest_minute > 0);
            $int_positif_rest_credit = (is_int($solde_rest_credit) || ctype_digit($solde_rest_credit)) && ((int)$solde_rest_credit > 0);

            if (($regex_solde_rest_data && $int_positif_rest_data) && ($regex_solde_rest_sms && $int_positif_rest_sms) && ($regex_solde_rest_minute && $int_positif_rest_minute) && ($regex_solde_rest_credit && $int_positif_rest_credit)) {


                $sql = " UPDATE  Solde_restant SET sr_credit= '$solde_rest_credit' ,sr_data = '$solde_rest_data', sr_sms= '$solde_rest_sms' ,sr_minute = '$solde_rest_minute', id_carte_sim='$carte_sim'
                WHERE  (id_solde_rest = '$id_solde_rest') ";
                $db->exec($sql);

                echo "<div class='alert alert-success'>";
                echo " Modifié avec success ";
                echo " </div>";
            } else {
                echo "<div class='alert alert-danger'>";
                echo "  Modification refusé   ";
                echo " </div>";
            }
        } elseif (!(isset($_GET['id_solde_rest']) && isset($_POST['id_carte_sim']) && isset($_POST['sr_data']) && isset($_POST['sr_sms']))) {

            echo "<div class='alert alert-danger'>";
            echo  " Nouvel enregistrement refusé   <br>";
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
