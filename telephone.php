<?php
require_once "Connect.php";
require_once "template.php";


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UN TELEPHONE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label"> MATRICULE DU TELEPHONE:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="matricule" id="matricule" required>
                                    </div>
                                </div>



                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">




                            </div><!--  /col-xs-5>-->
                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MARQUE DU TELEPHONE :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="marque" id="marque">
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
    $tab_error = [];
    $tab_success = [];

    $matricule = array_key_exists("matricule", $_POST) === true ? $_POST['matricule'] : NULL;
    $marque= array_key_exists("marque", $_POST) === true ? $_POST['marque'] : NULL;

    if (isset($_POST['enregistrer'])) {


        if (isset($_POST['matricule']) && isset($_POST['marque'])) {

            $matricule = htmlspecialchars($_POST['matricule']);

            //verifie si le nom contient (-) à la fin ou au debut ou seulement (-)
            $verif_hippen_matricule = (preg_match_all("/^([a-z0-9]+-)*[a-z0-9]+$/i", $matricule));

            //verifie si le nom contient (_) à la fin ou au debut ou seulement (_)
            $verif_underscore_matricule = (preg_match_all("/^([a-z0-9]+_)*[a-z0-9]+$/i", $matricule));

            //verifie si le matricule contient (/) à la fin ou au debut ou seulement (/)
            $verif_slash_matricule = (preg_match_all("/^([a-z0-9]+\/)*[a-z0-9]+$/i", $matricule));


            if (($verif_hippen_matricule) || ($verif_underscore_matricule) || ($verif_slash_matricule)) {


                  //verifie si le matricule est uniquement de chiffres 
                if (is_numeric($matricule)) {


                    array_push($tab_error, 'Error ! Pas de chiffre uniquement dans le matricule');


                } else {


                    $operation_matricule = "OK inserons dans matricule";

                    //creation de l'enregistrement
                    array_push($tab_success, $operation_matricule);
                }
            } else {


                array_push($tab_error, 'Error ! Le matricule ne doit pas contenir 1 ou plusieurs caractères speciaux ou des espaces vides et doit etre alphanumérique');


            }

            $marque = htmlspecialchars($_POST['marque']);


            //verifie si le nom de la marque contient (-) à la fin ou au debut ou seulement (-) et empeche les espaces vides
            $verif_hippen_marque = (preg_match_all("/^([a-z0-9]+-)*[a-z0-9]+$/i", $marque ));

            //verifie si le nom de la marque contient (_) à la fin ou au debut ou seulement (_) et empeche les espaces vides
            $verif_underscore_marque = (preg_match_all("/^([a-z0-9]+_)*[a-z0-9]+$/i", $marque));

            //verifie si le nom de la marque contient (/) à la fin ou au debut ou seulement (/)
            $verif_slash_marque = (preg_match_all("/^([a-z0-9]+\/)*[a-z0-9]+$/i", $marque));


            if (($verif_hippen_marque) || ($verif_underscore_marque) || ($verif_slash_marque)) {


               //verifie si le matricule est uniquement des chiffres 
                if (is_numeric($marque)) {


                    array_push($tab_error, 'Error ! Pas de chiffre uniquement concernant la marque');


                } else {


                    $operation_marque = "OK inserons dans marque";

                    array_push($tab_success, $operation_marque);

                }
            } else {


                array_push($tab_error, 'Error ! Le nom de la marque  ne doit pas contenir 1 ou plusieurs caractères speciaux ou des espaces vides et doit etre alphanumérique');


            }
        } elseif ($_POST['matricule'] === " " || $_POST['matricule'] === "0" || $_POST['marque']  === " " || $_POST['marque']  === "0") {


            array_push($tab_error, 'Champ vide');
        }


    }

    $nbr = count($tab_error);


    if ($tab_error) {


        for ($i = 0; $i <= $nbr - 1; $i++) {


            echo "<div class='alert alert-danger'>";
            echo  "<p> $tab_error[$i]</p>";
            echo " </div>";
            
        }
        exit ;
    }
    if ($tab_success) {


        $insertion_matricule_marque = " INSERT INTO telephone (matricule,marque) 
        VALUES ('$matricule','$marque') ";

        
        $db->exec($insertion_matricule_marque);

        echo "<div class='alert alert-success'>";
        echo  "<p> Nouvel enregistrement crée avec success </p>";
        echo " </div>";
        exit;
    }
    ?>