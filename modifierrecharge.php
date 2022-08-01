<?php
require_once "template.php";

require_once "Connect.php";






$sql1 = "SELECT * FROM carte_sim";

$stmt1 = $db->query($sql1);


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UN RECHARGE </h3>

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
                                        <select name="id_carte_sim" class="form-control" value="<?php echo $_GET['id_carte_sim']  ?>" required>

                                            /* affiche les id des cartes sim avec les numero corespondant *\

                                            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>

                                    </div>
                                </div>


                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MONTANT :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="montant" id="montant" pattern="[0-9]+" value="<?php echo $_GET['montant']  ?>" required>

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

    if (isset($_POST['enregistrer'])) {


        if (isset($_GET['id_recharge']) && isset($_POST['id_carte_sim']) && isset($_POST['montant'])) {

            $id_recharge = $_GET['id_recharge'];

            $montant = htmlspecialchars($_POST['montant']);

            $taille_montant = strlen($montant);

            if ($taille_montant < 0 || $taille_montant >  9) {

                array_push($tab_error, 'Montant incorrect');
            }

            //verifie si le montant contient (-) à la fin ou au debut ou seulement (-)
            $verif_montant = (preg_match_all("/[0-9]+/", $montant));
            //verifie si le montant contient (_) à la fin ou au debut ou seulement (_)
            $verif_underscore = (preg_match_all("/^([a-z0-9]+_)*[a-z0-9]+$/i", $montant));


            if (!($verif_montant)) {


                array_push($tab_error, 'Error ! Montant incorrect ');
            } else {

                $operation_recharge = "OK inserons dans recharge";

                array_push($tab_success, $operation_recharge);
            }
        } elseif (!(isset($_GET['id_recharge']) && isset($_POST['id_carte_sim']) && isset($_POST['montant']))) {


            echo "<div class='alert alert-danger'>";
            echo  " Modification echoué <br>";
            echo " </div>";
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

        //verifie si le montant est un nombre entier positif superieur à zero
        $verif_montant_int_positif = (is_int($montant) || ctype_digit($montant)) && (int)$montant > 0;

        if ($verif_montant_int_positif) {
            $maj_recharge = " UPDATE Recharge SET montant='$montant' WHERE  (id_recharge ='$id_recharge') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($maj_recharge);

            echo "<div class='alert alert-success'>";

            echo  "Modifié avec success ";

            echo " </div>";
        } else {

            echo "<div class='alert alert-danger'>";

            echo  " Modification échoué   <br>";

            echo " </div>";
        }
        exit;
    }
