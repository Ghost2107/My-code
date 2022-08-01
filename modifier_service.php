<?php
require_once "Connect.php";
require_once "template.php";





?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UN SERVICE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->





                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NOM SERVICE:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nom_services" id="nom_services" value="<?php echo $_GET['nom_services']  ?>" required>
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
    $tab_error = [];
    $tab_success = [];

    if (isset($_POST['submit'])) {


        // $sql1 = null;
        if (isset($_GET['id_services']) && isset($_POST['nom_services']) && !empty($_POST['nom_services'])) {

            $id_services = $_GET['id_services'];
            $services = htmlspecialchars($_POST['nom_services']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            $verif_tiret = (preg_match_all("/^([a-z0-9]+-)*[a-z0-9]+$/i", $services));
            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $verif_underscore = (preg_match_all("/^([a-z0-9]+_)*[a-z0-9]+$/i", $services));

            if (($verif_tiret) || ($verif_underscore)) {

                if (is_numeric($services)) {
                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le nom du service');
                } else {

                    $var = "Ok inserons dans service";

                    array_push($tab_success, $var);
                }
            } else {

                array_push($tab_error, 'Error ! Le nom du service ne doit pas contenir 1 ou plusieurs caractères speciaux ou des espaces vides ou des chiffres');
            }
        } elseif (!(isset($_GET['id_services']) && isset($_POST['nom_services']) && !empty($_POST['nom_services']))) {
            echo "<div class='alert alert-danger'>";
            echo " Modification refusé   <br>";
            echo " </div>";
        }

        $verif_service = $db->prepare("SELECT nom_services FROM services WHERE nom_services='$services' ");
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

        $maj_service = "UPDATE Services SET nom_services='$services' WHERE (id_services ='$id_services')";
        // utilise exec() car aucun résultat n'est renvoyé
        $db->exec($maj_service);

        echo "<div class='alert alert-success'>";
        echo " <h4>Modifié avec success</h4> <br>";
        echo " </div>";
        exit;
    }
