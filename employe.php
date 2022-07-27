<?php
require_once "template.php";

require_once "Connect.php";




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
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UN EMPLOYE </h3>

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
                                        <input type="text" class="form-control" name="nom_employe" id="nom_employe" pattern="^[A-Z0-9]+$/^([A-Z0-9]+-)*+$/i" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">PRENOM EMPLOYE:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="prenom_employe" id="prenom_employe" pattern="^[A-Z0-9]+$/^([A-Z0-9]+-)*+$/i" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MATRICULE :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="matricule_employe" id="matricule_employe" pattern="^[A-Z0-9]+$" required>
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->


                            <div class="col-xs-5">




                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">POSTE :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="poste" id="poste" pattern="^[A-Z0-9]+$/^([A-Z0-9]+-)*+$/i">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NOM SERVICE:</label>
                                    <div class="col-sm-8">
                                        <select name="id_services" class="form-control">
                                            <option disabled selected value> Selectionner un service </option>
                                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_services']; ?>"><?php echo $row['nom_services']; ?></option>

                                            <?php endwhile; ?>




                                        </select>



                                    </div>



                                </div>


                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NUMERO ASSOCIE:</label>
                                    <div class="col-sm-8">
                                        <select name="num_associe" class="form-control">
                                            <option disabled selected value> Selectionner un numéro </option>
                                            <?php while ($row = $execution_req->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>

                                            <?php endwhile; ?>




                                        </select>



                                    </div>



                                </div>




                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MATRICULE TELEPHONE:</label>
                                    <div class="col-sm-6">
                                        <select name="id_telephone" class="form-control">
                                            <option disabled selected value> Selectionner un matricule </option>
                                            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_telephone']; ?>"><?php echo $row['matricule']; ?></option>





                                            <?php endwhile; ?>

                                        </select>
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

    //COD EMPLOYE GES ADMIN

    $sql = null;
    $tab_error = [];
    $tab_success = [];


    //operation terner : si array_key existe ca renvoie un booléen si ce booléen = à true faire ce qui suit après ? Si non faire ce qui vient apfrès le :


    if (isset($_POST['enregistrer'])) {


        $nom = array_key_exists("nom_employe", $_POST) === true ? $_POST['nom_employe'] : NULL;
        $prenom = array_key_exists("prenom", $_POST) === true ? $_POST['prenom_employe'] : NULL;
        $matricule = array_key_exists("matricule", $_POST) === true ? $_POST['matricule_employe'] : NULL;
        $poste = array_key_exists("poste", $_POST) === true ? $_POST['poste'] : NULL;
        $id_services = array_key_exists("id_services", $_POST) === true ? $_POST['id_services'] : NULL;
        $num_associe = array_key_exists("num_associe", $_POST) === true ? $_POST['num_associe'] : NULL;
        $id_telephone = array_key_exists("id_telephone", $_POST) === true ? $_POST['id_telephone'] : NULL;


        if (
            isset($_POST['nom_employe']) && isset($_POST['prenom_employe'])
            && isset($_POST['matricule_employe'])
        ) {

            $nom = htmlspecialchars($_POST['nom_employe']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            $hippen_nom = (preg_match_all("/^([a-z0-9{20}]+-)*[a-z0-9{20}]+$/i", $nom));
            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $underscore_nom = (preg_match_all("/^([a-z0-9{20}]+_)*[a-z0-9{20}]+$/i", $nom));


            if ($hippen_nom || $underscore_nom) {

                if (is_numeric($nom)) {

                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le nom');
                } else {

                    $operation_nom = "OK inserons dans le nom";

                    array_push($tab_success, $operation_nom);
                }
            } else {

                array_push($tab_error, 'Error ! Nom incorrect ');
            }


            $prenom = htmlspecialchars($_POST['prenom_employe']);


            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            $hippen_prenom = (preg_match_all("/^([a-z0-9{100}]+-)*[a-z0-9{50}]+$/i", $prenom));
            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $underscore_prenom = (preg_match_all("/^([a-z0-9{100}]+_)*[a-z0-9{50}]+$/i", $prenom));

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


            $matricule = htmlspecialchars($_POST['matricule_employe']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            /*       $hippen_matricule = (preg_match_all("/^([a-z0-9{30}]+-)*[a-z0-9{30}]+$/i", $matricule));
            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $underscore_matricule = (preg_match_all("/^([a-z0-9{30}]+_)*[a-z0-9{30}]+$/i", $matricule)); */

            $regex_alpha_numeric = (preg_match_all("/^[A-Z0-9]+$/", $matricule));

            if (/* $hippen_matricule || $underscore_matricule || */$regex_alpha_numeric) {

                if (is_numeric($matricule)) {


                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le matricule');
                } else {


                    $operation_matricule = "OK inserons dans le matricule";

                    //creation de l'enregistrement
                    array_push($tab_success, $operation_matricule);
                }
            } else {

                array_push($tab_error, 'Error ! Mauvais format du matricule exemple de format (XYZ1) ');
            }


            $verif_employe = $db->prepare("SELECT matricule_employe FROM Employe WHERE matricule_employe='$matricule' ");
            $verif_employe->execute();
            $nombre_de_ligne = $verif_employe->rowCount();

            if ($nombre_de_ligne) {

                echo "<div class='alert alert-danger'>";
                echo "Ce matricule est déjà utilisé ";
                echo " </div>";
                exit;
            }
        } elseif (!(isset($_POST['nom_employe']) && isset($_POST['prenom_employe'])
        && isset($_POST['matricule_employe']))) {


        echo "<div class='alert alert-danger'>";
        echo  " Nouvel enregistrement refusé   <br>";
        echo " </div>";
    }
    }

    $nbr = count($tab_error);

    /*  var_dump($nbr);
 exit ; */


    if ($tab_error) {

        for ($i = 0; $i <= $nbr - 1; $i++) {


            echo "<div class='alert alert-danger'>";
            echo  "<p> $tab_error[$i]</p>";
            echo " </div>";
        }
        exit;
    }

    if ($tab_success) {







        if ($id_services === NULL && $id_telephone === NULL && $num_associe === NULL && $poste === NULL) {
            $insertion_employe_champ_requis = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe) 
        VALUES ('$nom',' $prenom','$matricule') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_champ_requis);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }

        if ($poste !== NULL && $id_services === NULL && $id_telephone === NULL && $num_associe === NULL) {
            $insertion_employe_champ_requis_poste = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste) 
        VALUES ('$nom',' $prenom','$matricule','$poste') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_champ_requis_poste);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }


        if ($poste !== NULL  &&  $id_services !== NULL &&  $id_telephone === NULL && $num_associe === NULL) {
            $insertion_employe_champ_requis_poste_service = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste,id_services) 
        VALUES ('$nom',' $prenom','$matricule','$poste', '$id_services') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_champ_requis_poste_service);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }



        /*   if ( $id_services !== NULL &&  $id_telephone !== NULL && $num_associe !== NULL && $poste !== NULL ) {
            $insertion_employe_champ_requis_poste_service = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste,id_services) 
        VALUES ('$nom',' $prenom','$matricule','$poste', '$id_services') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_champ_requis_poste_service);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        } */






        if ($poste !== NULL  &&  $id_services !== NULL && $num_associe !== NULL && $id_telephone === NULL) {


            if ($num_associe) {


                $req_numero_sim = "SELECT numero_sim FROM carte_sim WHERE id_carte_sim = '$num_associe'";
                $execution_req = $db->query($req_numero_sim);
                $value_numero = $execution_req->fetch(PDO::FETCH_ASSOC);
                $numero_sim = $value_numero['numero_sim'];
            }


            $insertion_employe_champ_requis_poste_service_num = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste,numero_associe,id_services,id_carte_sim) 
        VALUES ('$nom',' $prenom','$matricule','$poste', '$numero_sim','$id_services','$num_associe') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_champ_requis_poste_service_num);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }


        if ($poste !== NULL  &&  $num_associe !== NULL) {


            if ($num_associe) {


                $req_numero_sim = "SELECT numero_sim FROM carte_sim WHERE id_carte_sim = '$num_associe'";
                $execution_req = $db->query($req_numero_sim);
                $value_numero = $execution_req->fetch(PDO::FETCH_ASSOC);
                $numero_sim = $value_numero['numero_sim'];
            }


            $insertion_employe_avec_numero_associe_poste = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste,numero_associe,id_carte_sim) 
        VALUES ('$nom',' $prenom','$matricule','$poste','$numero_sim','$num_associe') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_avec_numero_associe_poste);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }


        if ($poste !== NULL  &&  $id_telephone !== NULL) {





            $insertion_employe_avec_numero_associe_poste = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste,id_telephone) 
        VALUES ('$nom',' $prenom','$matricule','$poste','$id_telephone') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_avec_numero_associe_poste);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }





        if ($id_services === NULL) {
            $insertion_employe_sans_service = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste) 
        VALUES ('$nom',' $prenom','$matricule','$poste') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_sans_service);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }

        if ($num_associe === NULL) {
            $insertion_employe_sans_numero_associe = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste) 
        VALUES ('$nom',' $prenom','$matricule','$poste') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_sans_numero_associe);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }

        if ($id_telephone === NULL) {
            $insertion_employe_sans_telephone = " INSERT INTO Employe (nom_employe,prenom_employe,matricule_employe,poste,id_services) 
       VALUES ('$nom',' $prenom','$matricule','$poste','$num_associe','$id_services') ";
            // utilise exec() car aucun résultat n'est renvoyé
            $db->exec($insertion_employe_sans_telephone);

            echo "<div class='alert alert-success'>";
            echo  "<p> Nouvel enregistrement crée avec success </p>";
            echo " </div>";

            exit;
        }


        /*     $contenu_colonne_carte_sim = $execution_req->fetch(PDO::FETCH_ASSOC);
    $num_associe = echo ($contenu_colonne_carte_sim === false ? NULL : $contenu_colonne_carte_sim['numero_sim']); */

        $insertion_employe = " INSERT INTO employe (nom_employe,prenom_employe,matricule_employe,poste,numero_associe,id_services,id_telephone,id_carte_sim) 
    VALUES ('$nom','$prenom','$matricule','$poste','$numero_sim','$id_services','$id_telephone','$num_associe') ";
        $db->exec($insertion_employe);

        echo "<div class='alert alert-success'>";
        echo  "<p> Nouvel enregistrement crée avec success </p>";
        echo " </div>";
        exit;
    }
