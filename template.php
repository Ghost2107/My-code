<?php
require_once 'Connect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta charset="utf-8">

    <title>ACCEUIL</title>
</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <div class="navbar-header">
                <span class="navbar-brand navbar-header"> Gestion admin - Gestion Telecom </span>
            </div>

        </nav>
        <!-- Menu vertical-->
        <! -- Menu vertical --->
            <div class="nav-side-menu">
                <div class="brand">Menu Principal </div>
                <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

                <div class="menu-list">

                    <ul id="menu-content" class="menu-content collapse out">
                        <!--Menu acceuil-->
                        <li data-toggle="collapse" data-target="#acceuil" class="collapsed active">
                            <a href="template.php" style="color:white"><i class="fa fa-home"></i> Acceuil<span class="arrow"></span></a>
                        </li>
                        <!--Menu SERVICE-->
                        <li data-toggle="collapse" data-target="#class" class="collapsed ">
                            <a href="#"><i class="fa fa-group fa-lg"></i> Services<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="class">
                            <a href="service.php" style="color:white">
                                <li>Ajouter un Service</li>
                            </a>
                            <a href="liste_service.php" style="color:white">
                                <li>Liste des services</li>
                            </a>
                        </ul>

                        <!--Menu TELEPHONE-->
                        <li data-toggle="collapse" data-target="#etudiant" class="collapsed ">
                            <a href="#"><i class="fa fa-bank fa-lg "></i> Telephone <span class="arrow"></span></a>
                        </li>

                        <ul class="sub-menu collapse" id="etudiant">
                            <a href="telephone.php" style="color:white">
                                <li>Ajouter un Telephone</li>
                            </a>
                            <a href="liste_telephone.php" style="color:white">
                                <li>Liste des Telephones</li>
                            </a>
                        </ul>



                        <!--Menu CARTE SIM-->
                        <li data-toggle="collapse" data-target="#para" class="collapsed">
                            <a href="#"><i class="fa fa-gears fa-lg"></i> Carte Sim <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="para">

                            <a href="carte_sim.php" style="color:white">
                                <li>Ajouter une Carte Sim</li>
                            </a>
                            <a href="liste_carte_sim.php" style="color:white">
                                <li>Liste des cartes sim</li>
                            </a>
                        </ul>
                        <!--Menu EMPLOYE-->
                        <li data-toggle="collapse" data-target="#ue" class="collapsed">
                            <a href="#"><i class="fa fa- fa-male"></i> Employé<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="ue">
                            <a href="employe.php" style="color:white">
                                <li>Ajouter un Employé</li>
                            </a>
                            <a href="liste_employe.php" style="color:white">
                                <li>Liste des employés</li>
                            </a>


                        </ul>
                        <!--Menu RECHARGE-->
                        <li data-toggle="collapse" data-target="#rech" class="collapsed">
                            <a href="#"><i class="fa fa-gears fa-lg"></i> Recharge <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="rech">

                            <a href="recharge.php" style="color:white">
                                <li>Ajouter une recharge</li>
                            </a>

                            <a href="liste_recharge.php" style="color:white">
                                <li>Liste des recharges</li>
                            </a>

                        </ul>

                        <!--Menu Achat de pass-->
                        <li data-toggle="collapse" data-target="#achat" class="collapsed">
                            <a href="#"><i class="fa fa-money "></i>Achat de pass <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="achat">

                            <a href="achat_de_pass.php" style="color:white">
                                <li>Ajouter un achat</li>
                            </a>

                            <a href="liste_achat_de_pass.php" style="color:white">
                                <li>Liste des achats</li>
                            </a>

                        </ul>




                        <!--Menu SOLDE-->

                        <li data-toggle="collapse" data-target="#enseignant" class="collapsed">
                            <a href="#"><i class="fa fa-desktop fa-lg"></i> Solde<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="enseignant">
                            <a href="solde_initial.php" style="color:white">
                                <li>Solde initial</li>
                            </a>
                            <a href="liste_solde_initial.php" style="color:white">
                                <li>Liste des soldes initiaux</li>
                            </a>
                            <a href="solde_restant.php" style="color:white">
                                <li>solde restant</li>
                            </a>
                            <a href="liste_solde_restant.php" style="color:white">
                                <li>Liste des soldes restants</li>
                            </a>
                        </ul>

                        <!--Menu CONSO-->
                        <li data-toggle="collapse" data-target="#cons" class="collapsed">
                            <a href="#"><i class="fa fa-signal"></i> Consommation <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="cons">

                            <a href="conso.php" style="color:white">
                                <li>Voir consommation</li>
                            </a>
                            <a href="liste_conso.php" style="color:white">
                                <li>Liste des consommations</li>
                            </a>
                        </ul>






                    </ul>



                </div>
            </div> <!-- nav-side-menu -->



    </div> <!-- page-wrapper-->

    </div><!-- wrapper-->


    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

</html>