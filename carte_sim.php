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

    $tab_error = [];
    $tab_success = [];

    $operateur = array_key_exists("operateur", $_POST) === true ? $_POST['operateur'] : NULL;
    $numero_sim = array_key_exists("numero_sim", $_POST) === true ? $_POST['numero_sim'] : NULL;



    if (isset($_POST['enregistrer'])) {

        if (isset($_POST['operateur']) && !empty($_POST['operateur']) && isset($_POST['numero_sim']) && !empty($_POST['numero_sim'])) {

            $operateur = htmlspecialchars($_POST['operateur']);

            $numero_sim = htmlspecialchars($_POST['numero_sim']);

            $taille_numero_sim = strlen($numero_sim);

            if ($taille_numero_sim >= 10 && $taille_numero_sim < 15) {

                $operation_taille_numero_sim = "OK inserons dans matricule";

                //creation de l'enregistrement
                array_push($tab_success, $operation_taille_numero_sim);
            }

            if (is_numeric($numero_sim)) {


                $operation_numero_sim = "OK inserons dans carte sim";

                //creation de l'enregistrement
                array_push($tab_success, $operation_numero_sim);
            } else {

                array_push($tab_error, "Numero incorrect");
            }

            $num = substr($numero_sim, 0, -8);

            if (($operateur === "MTN" && $num === "05") || ($operateur === "ORANGE" && $num === "07") || ($operateur === "MOOV" && $num === "01")) {

                $operation_insertion_carte_sim = "operateur et numero correspondent";

                array_push($tab_success, $operation_insertion_carte_sim);
            } else {

                echo "<div class='alert alert-danger'>";
                echo  " L'perateur et le numero ne correspondent pas ";
                echo " </div>";
                exit;
            }
        } elseif (!(isset($_POST['operateur'])  && isset($_POST['numero_sim']))) {



            echo "<div class='alert alert-danger'>";
            echo  " Nouvel enregistrement refusé   <br>";
            echo " </div>";
            exit;
        } else {
            array_push($tab_error, "Numero incorrect");
        }


        $select_all_from_carte_sim = $db->prepare("SELECT numero_sim FROM carte_sim WHERE numero_sim='$numero_sim' ");
        $select_all_from_carte_sim->execute();
        $nombre_de_ligne = $select_all_from_carte_sim->rowCount();

        if ($nombre_de_ligne) {

            echo "<div class='alert alert-danger'>";
            echo "Ce numero existe déjà ";
            echo " </div>";
            exit;
        }
    }

    $nbr = count($tab_error);


    if ($tab_error) {


        for ($i = 0; $i <= $nbr - 1; $i++) {


            echo "<div class='alert alert-danger'>";
            echo  "<p> $tab_error[$i]</p>";
            echo " </div>";
        }
        exit;
    }

    if ($tab_success) {

        //la fonction(substr) utilisé ici permet de selectionner un certain nombre de caractère dans une chaine


        $insertion_carte_sim = " INSERT INTO carte_sim (operateur,numero_sim) 
                                               VALUES ('$operateur','$numero_sim') ";
        // utilise exec() car aucun résultat n'est renvoyé
        $db->exec($insertion_carte_sim);

        echo "<div class='alert alert-success'>";
        echo  " Nouvel enregistrement crée avec success ";
        echo " </div>";
        exit;
    }
