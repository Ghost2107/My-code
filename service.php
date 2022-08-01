<?php
require_once "Connect.php";
require_once "template.php";
?>
<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UN SERVICE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post" align="center">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->
                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NOM DU SERVICE:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nom_services" id="nom_services" maxlength="60" required>
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

    $service = array_key_exists("nom_services", $_POST) === true ? $_POST['nom_services'] : NULL;

    if (isset($_POST['enregistrer'])) {


        if (isset($_POST['nom_services']) && !empty($_POST['nom_services'])) {

            /*  //verifie si le champ nom comporte des espaces vides avant ou après le nom
                $space = preg_match_all("^[A-Za-z][A-Za-z0-9]*$", $service); */


            $service = htmlspecialchars($_POST['nom_services']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            $number = (preg_match_all("/^([a-z0-9]+-)*[a-z0-9]+$/i", $service));
            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $number2 = (preg_match_all("/^([a-z0-9]+_)*[a-z0-9]+$/i", $service));
            if (($number) || ($number2)) {

                if (is_numeric($service)) {
                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le nom du service');
                } else {

                    $var = "Ok inserons dans service";

                    array_push($tab_success, $var);
                }
            } else {

                array_push($tab_error, 'Error ! Le nom du service ne doit pas contenir 1 ou plusieurs caractères speciaux ou des espaces vides ou des chiffres');
            }

            /* $dates = htmlspecialchars($_POST['dates']);

            $dates = date('Y-m-d', strtotime($dates));

            if ($_POST['dates'] === $dates) {

                $operation_date = "Date correct";

                array_push($tab_success, $operation_date);
            } else {

                array_push($tab_error, 'Date incorrect');
            } */
        } elseif (!(isset($_POST['nom_employe'])) || empty($_POST['prenom_employe']) && isset($_POST['dates'])) {


            echo "<div class='alert alert-danger'>";
            echo  " Nouvel enregistrement refusé   <br>";
            echo " </div>";
        }

        $verif_service = $db->prepare("SELECT nom_services FROM services WHERE nom_services='$service' ");
        $verif_service->execute();
        $nombre_de_ligne = $verif_service->rowCount();

        if ($nombre_de_ligne) {

            echo "<div class='alert alert-danger'>";
            echo "Ce service existe déjà ";
            echo " </div>";
            exit;
        }
    }





    $taille_tableau = count($tab_error);

    if ($tab_error) {

        for ($i = 0; $i <= $taille_tableau - 1; $i++) {
            echo "<div class='alert alert-danger'>";
            echo  "<p> $tab_error[$i]</p>";
            echo " </div>";
        }
        exit;
    }
    if ($tab_success) {

        $insertion_service = "INSERT INTO services (nom_services) VALUE ('$service')";
        $db->exec($insertion_service);


        echo "<div class='alert alert-success'>";
        echo "Nouvel enregistrement crée avec success";
        echo " </div>";
        exit;
    }
    ?>