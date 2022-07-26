<?php
require_once "Connect.php";
require_once "template.php";










?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UNE CARTE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->

                                <div class="form-group">
                                    <label class=" col-sm-6 control-label">OPERATEUR :</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="operateur" id="operateur" required>
                                            <option id="05">MTN</option>
                                            <option id="07">ORANGE</option>
                                            <option id="01">MOOV</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-8">



                                    </div>
                                </div>



                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NUMERO CARTE SIM:</label>
                                    <div class="col-sm-8">
                                        <input type="tel" class="form-control" name="numero_sim" id="numero_sim" pattern="[0-9]{10}" title="Entrez un numero à 10 chiffres" required>

                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-8">



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

            if (isset($_POST['operateur']) && isset($_POST['numero_sim']) && !empty($_POST['operateur']) && !empty($_POST['numero_sim'])) {
                $numero = $_POST['numero_sim'];
                $operateur = $_POST['operateur'];
                $num = substr($numero, 0, -8);
                if (($operateur === "MTN" && $num === "05") || ($operateur === "ORANGE" && $num === "07") || ($operateur === "MOOV" && $num === "01")) {
                    $sql = $db->prepare("SELECT numero_sim FROM carte_sim WHERE numero_sim='$numero'");
                    $sql->execute();
                    $result = $sql->rowCount();
                    if ($result) {

                        echo  " le numero existe déja autre numero  svp <br> ";
                    } else {

                        $sql = " INSERT INTO carte_sim (operateur,numero_sim) 
            VALUES ('$operateur','$numero') ";
                        // utilise exec() car aucun résultat n'est renvoyé
                        $db->exec($sql);
                        //creation de l'enregistrement

                        echo "<div class='alert alert-success'>";
                        echo  " Nouvel enregistrement crée avec success ";
                        echo " </div>";


                        
                    }
                } else {

                    echo "<div class='alert alert-danger'>";
                    echo  " L'operateur et le numero ne correspondent pas ";
                    echo " </div>";

                }
            } else {
                echo "Erreur !";
            }
        }
