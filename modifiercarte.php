<?php
require_once "Connect.php";
require_once "template.php";





?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UNE CARTE SIM </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->

                                <div class="form-group">
                                    <label class=" col-sm-6 control-label">OPERATEUR:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="operateur" id="operateur" value="<?php echo $_GET['operateur']  ?>" required>
                                    </div>

                                </div>




                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NUMERO:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="numero_sim" id="numero_sim" value="<?php echo $_GET['numero_sim']  ?>" required>
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
    $numero_sim = null;

    if (isset($_POST['submit'])) {

        if (isset($_GET['id_carte_sim']) && isset($_POST['operateur']) && !empty($_POST['numero_sim'])) {

            $id_carte_sim = $_GET['id_carte_sim'];


            $operateur = htmlspecialchars($_POST['operateur']);

            $numero_sim = htmlspecialchars($_POST['numero_sim']);

            $taille_numero_sim = strlen($numero_sim);

            if ($taille_numero_sim >= 10 && $taille_numero_sim < 15) {

                $operation_taille_numero_sim = "OK inserons dans matricule";


                array_push($tab_success, $operation_taille_numero_sim);
            } else {
                array_push($tab_error, "Numero incorrect");
            }

            if (is_numeric($numero_sim)) {


                $operation_numero_sim = "OK inserons dans carte sim";


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
        } elseif (!(isset($_GET['id_carte_sim']) && isset($_POST['operateur'])  && isset($_POST['numero_sim']))) {
            echo "<div class='alert alert-danger'>";
            echo " Modification refusé   <br>";
            echo " </div>";
        }


        $select_all_from_carte_sim = $db->prepare("SELECT * FROM carte_sim WHERE numero_sim='$numero_sim' ");
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



        $maj_carte_sim = "UPDATE carte_sim SET operateur ='$operateur', numero_sim='$numero_sim' WHERE (id_carte_sim ='$id_carte_sim') ";
        // utilise exec() car aucun résultat n'est renvoyé
        $db->exec($maj_carte_sim);

        echo "<div class='alert alert-success'>";
        echo " <h4>Modifié avec success</h4> <br>";
        echo " </div>";
    }
