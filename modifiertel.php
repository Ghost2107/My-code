<?php
require_once "Connect.php";
require_once "template.php";


$select_all_telephone = "SELECT * FROM Telephone ";

$execution_select_all_telephone = $db->query($select_all_telephone);

$mat_tel = $_GET['matricule'];

$select_marque = "SELECT marque FROM telephone WHERE matricule = '$mat_tel'";
$execute_select_marque = $db->query($select_marque);
$contenu_colonne = $execute_select_marque->fetch(PDO::FETCH_ASSOC);

/* var_dump($contenu_colonne);
 exit; */


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UN TELEPHONE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->
                                <div class="form-group">
                                    <label class=" col-sm-6 control-label">MATRICULE TELEPHPONE:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="matricule" id="matricule" value="<?php echo $_GET['matricule']  ?>" required>
                                    </div>

                                </div>





                            </div><!--  col-xs-5-->
                            <div class="col-xs-5">

                                <div class="form-group">
                                    <label class=" col-sm-6 control-label">MARQUE TELEPHONE:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="marque" id="marque" value="<?php echo $contenu_colonne['marque']  ?> " required>




                                    </div>
                                </div>


                                <div class="form-group">


                                    <div class="col-sm-8">



                                    </div>
                                </div>

                                <div class="col-xs-5">

                                </div>

                                <div class="form-group">


                                    <div class="col-sm-8">



                                    </div>
                                </div>



                            </div><!--  /col-xs-5>-->
                            <div class="col-xs-2">
                                <p>
                                    <button type="submit" class="btn btn-primary" name="submit">Valider </button>
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


    if (isset($_POST['submit'])) {


        $id_telephone = $_GET['id_telephone'];
        $marque_telephone = $_POST['marque'];
        $matricule_telephone = $_POST['matricule'];


        $update_all_telephone = null;
        if (isset($_POST['marque']) && isset($_POST['matricule'])) {
            $update_all_telephone = " UPDATE Telephone SET marque='$marque_telephone', matricule='$matricule_telephone'  WHERE (id_telephone ='$id_telephone') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->query($update_all_telephone);
            //creation de l'enregistrement
            echo "<div class='alert alert-success'>";
            echo " Modifié avec success ";
            echo " </div>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo "  Modification refusé   ";
            echo " </div>";
        }
    }
