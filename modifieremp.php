<?php
require_once "template.php";

require_once "Connect.php";

$requete_sql_employe = "SELECT * FROM Employe ";

$execution_requete = $db->query($requete_sql_employe);


$sql = "SELECT * FROM Services  ";

$stmt = $db->query($sql);


$sql1 = "SELECT * FROM Telephone ";

$stmt1 = $db->query($sql1);

$req_carte_sim = "SELECT * FROM carte_sim";

$execution_req = $db->query($req_carte_sim);


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UN EMPLOYE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NOM EMPLOYE:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nom_employe" id="nom_employe" value="<?php echo $_GET['nom_employe']  ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">PRENOM EMPLOYE:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="prenom_employe" id="prenom_employe" value="<?php echo $_GET['prenom_employe']  ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MATRICULE :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="matricule_employe" id="matricule_employe" value="<?php echo $_GET['matricule_employe']  ?>" required>
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->


                            <div class="col-xs-5">




                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">POSTE :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="poste" id="poste" value="<?php echo $_GET['poste']  ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NOM SERVICE:</label>
                                    <div class="col-sm-8">
                                        <select name="id_services" class="form-control" value="<?php echo $_GET['id_services'];  ?>">
                                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_services']; ?>"><?php echo $row['nom_services']; ?></option>

                                            <?php endwhile; ?>




                                        </select>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NUMERO ASSOCIE:</label>
                                    <div class="col-sm-8">
                                        <select name="numero_associe" class="form-control" value="<?php echo $_GET['id_carte_sim'] ?>">


                                            <?php while ($row = $execution_req->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>

                                            <?php endwhile; ?>


                                        </select>



                                    </div>



                                </div>



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MATRICULE TELEPHONE:</label>
                                    <div class="col-sm-6">
                                        <select name="id_telephone" class="form-control" value="<?php echo $_GET['matricule']  ?>">
                                            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_telephone']; ?>"><?php echo $row['matricule']; ?></option>





                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">DATE:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dates" id="dates">

                                    </div>

                                </div>



                            </div><!--  /col-xs-5>-->






                            <div class="col-xs-2">
                                <p>
                                    <button type="submit" class="btn btn-primary" name="enregistrer_employe">Valider </button>
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

    $update_all_employe = null;

    $tab_error = [];

    $tab_success = [];

    if (isset($_POST['enregistrer_employe'])) {



        $id_employe = $_GET['id_employe'];

        $nom_employe = array_key_exists("nom_employe", $_POST) === true ? $_POST['nom_employe'] : NULL;

        $prenom_employe = array_key_exists("prenom_employe", $_POST) === true ? $_POST['prenom_employe'] : NULL;

        $matricule_employe = array_key_exists("matricule_employe", $_POST) === true ? $_POST['matricule_employe'] : NULL;

        $poste = array_key_exists("poste", $_POST) === true ? $_POST['poste'] : NULL;

        $id_services = array_key_exists("id_services", $_POST) === true ? $_POST['id_services'] : NULL;

        $num_associe = array_key_exists("numero_associe", $_POST) === true ? $_POST['numero_associe'] : NULL;

        $id_telephone = array_key_exists("id_telephone", $_POST) === true ? $_POST['id_telephone'] : NULL;

        $dates = $_POST['dates'];



        if (isset($_POST['nom_employe']) && isset($_POST['prenom_employe']) && isset($_POST['matricule_employe']) && isset($_POST['dates'])) {

            //la fonction htmlspecialchars est utilisé pour eviter les attaques xss et les injectons SQL
            $nom_employe = htmlspecialchars($_POST['nom_employe']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            $hippen_nom = (preg_match_all("/^([a-z0-9{20}]+-)*[a-z0-9{20}]+$/i", $nom_employe));
            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $underscore_nom = (preg_match_all("/^([a-z0-9{20}]+_)*[a-z0-9{20}]+$/i", $nom_employe));

            if ($hippen_nom || $underscore_nom) {
                //verfifie si le nom est composé de nom uniquement
                if (is_numeric($nom_employe)) {

                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le nom');
                } else {

                    $operation_nom = "OK inserons dans le nom";

                    array_push($tab_success, $operation_nom);
                }
            } else {

                array_push($tab_error, 'Error ! Nom incorrect ');
            }

            $prenom_employe = htmlspecialchars($_POST['prenom_employe']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            $hippen_prenom = (preg_match_all("/^([a-z0-9{100}]+-)*[a-z0-9{50}]+$/i", $prenom_employe));
            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $underscore_prenom = (preg_match_all("/^([a-z0-9{100}]+_)*[a-z0-9{50}]+$/i", $prenom_employe));

            if ($hippen_prenom || $underscore_prenom) {

                if (is_numeric($prenom)) {



                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le prénom');
                } else {

                    $operation_prenom = "OK inserons dans le prénom";
                    array_push($tab_success, $operation_prenom);
                }
            } else {

                array_push($tab_error, 'Error ! Prenom incorrect');
            }

            $matricule_employe = htmlspecialchars($_POST['matricule_employe']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            /*                     $hippen_matricule = (preg_match_all("/^([a-z0-9{30}]+-)*[a-z0-9{30}]+$/i", $matricule));
                    //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
                     $underscore_matricule = (preg_match_all("/^([a-z0-9{30}]+_)*[a-z0-9{30}]+$/i", $matricule)); */

            $regex_alpha_numeric = (preg_match_all("/^[A-Z0-9]+$/", $matricule_employe));

            if (/* $hippen_matricule || $underscore_matricule || */$regex_alpha_numeric) {
                if (is_numeric($matricule_employe)) {

                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le matricule');
                } else {


                    $operation_matricule_employe = "OK inserons dans le matricule";

                    array_push($tab_success, $operation_matricule_employe);
                }
            } else {

                array_push($tab_error, 'Error ! Mauvais format du matricule exemple de format (XYZ1) ');
            }

            $dates = htmlspecialchars($_POST['dates']);
            /*  $dates = $_POST['dates'];
                        $verif_dates = date_parse(($dates));
                            var_dump($verif_dates); */
            //verifie le format de la date 
            $dates = date('Y-m-d', strtotime($dates));

            if ($_POST['dates'] === $dates) {

                $operation_date = "Ok";

                array_push($tab_success, $operation_date);
            } else {

                array_push($tab_error, 'Date incorrect');
            }


            $verif_employe = $db->prepare("SELECT matricule_employe FROM Employe WHERE matricule_employe='$matricule_employe' ");

            $verif_employe->execute();

            $nombre_de_ligne = $verif_employe->rowCount();

            if ($nombre_de_ligne) {

                echo "<div class='alert alert-danger'>";
                echo "Ce matricule est déjà utilisé ";
                echo " </div>";
                exit;
            }
        } elseif (!(isset($_POST['nom_employe']) && isset($_POST['prenom_employe']) && isset($_POST['matricule_employe']) && isset($_POST['dates']))) {


            echo "<div class='alert alert-danger'>";
            echo  " Nouvel enregistrement refusé   <br>";
            echo " </div>";
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


            $update_all_employe = " UPDATE  Employe SET nom_employe= '$nom_employe', prenom_employe='$prenom_employe' ,matricule_employe='$matricule_employe', poste='$poste', id_services='$id_services' ,numero_associe ='$num_associe', id_telephone='$id_telephone'  WHERE  (id_employe ='$id_employe') ";

            // utilise exec() car aucun résultat n'est renvoyé

            $db->query($update_all_employe);

            echo "<div class='alert alert-success'>";
            echo " Modifié avec success ";
            echo " </div>";
        }
    }
