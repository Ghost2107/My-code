<?php
require_once "template.php";

require_once "Connect.php";




$sql1 = "SELECT id_carte_sim, numero_sim FROM carte_sim ";

$stmt1 = $db->query($sql1);



?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UNE RECHARGE</h3>

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
                                        <select name="id_carte_sim" class="form-control" required>



                                            /* affiche les id des cartes sim et les numero correspondes *\
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

                                        <input type="text" class="form-control" name="montant" id="montant" pattern="[-+]?[0-9]+(\.[0-9]+)?([eE][-+]?[0-9]+)?" title="exemple de farmat 55 ou 55.5 " required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">DATE:</label>
                                    <div class="col-sm-8">


                                        <input type="date" class="form-control" name="dates" id="dates" required>

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

        $id_carte_sim = $_POST['id_carte_sim'];
        $montant = $_POST['montant'];
        $dates = $_POST['dates'];



        //verifie si le montant contient (-) à la fin ou au debut ou seulement (-)
        $verif_tiret = (preg_match_all("/^([a-z0-9]+-)*[a-z0-9]+$/i", $montant));
        //verifie si le montant contient (_) à la fin ou au debut ou seulement (_)
        $verif_underscore = (preg_match_all("/^([a-z0-9]+_)*[a-z0-9]+$/i", $montant));



        if (
            isset($_POST['id_carte_sim']) && isset($_POST['montant'])
            && isset($_POST['dates'])
        ) {
            //verifie si le montant est un nombre et un entier positif et superieur à zero
            $verif_montant_int_positif = (is_int($montant) || ctype_digit($montant)) && (int)$montant > 0;


            if ($verif_montant_int_positif) {


                $sql = " INSERT INTO Recharge (id_carte_sim,montant)  
        VALUES ('$id_carte_sim','$montant') ";
                // utilise exec() car aucun résultat n'est renvoyé
                $db->exec($sql);
                //creation de l'enregistrement
                echo "<div class='alert alert-success'>";
                echo  " Nouvel enregistrement crée avec success ";
                echo " </div>";
            } else {
                echo "<div class='alert alert-danger'>";
                echo  " Nouvel enregistrement refusé   <br>";
                echo " </div>";
            }
        } elseif (!(isset($_POST['id_carte_sim']) && isset($_POST['montant'])
            && isset($_POST['dates']))) {


            echo "<div class='alert alert-danger'>";
            echo  " Nouvel enregistrement refusé   <br>";
            echo " </div>";
        }
    }
