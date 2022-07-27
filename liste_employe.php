<?php
require_once "Connect.php";
require_once "template.php";


$requete_sql_employe = "SELECT * FROM Employe ";

$execution_requete = $db->query($requete_sql_employe);

$req_sql_carte_sim = "SELECT * FROM carte_sim";
$execution_requete_carte_sim = $db->query($req_sql_carte_sim);

?>



<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form class="form-horizontal" data-toggle="validator" role="form" method="get" action="recherche_employe.php">
                        <input type="text" class=" form-control" name="recherche_employe" id="recherche_employe">

                        <p>
                            <button type="submit" class="btn btn-primary">Recherche </button>
                        </p>
                        Liste des employés
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>

                                    <th class=" col-sm-1 ">NOM EMPLOYE</th>
                                    <th class=" col-sm-1">PRENOM</th>
                                    <th class=" col-sm-1 ">MATRICULE</th>
                                    <th class=" col-sm-1 ">POSTE</th>
                                    <th class=" col-sm-1 ">NOM SERVICE</th>
                                    <th class=" col-sm-1 ">NUMERO ASSOCIE</th>
                                    <th class=" col-sm-1 ">MATRICULE TELEPHONE</th>
                                    <th class=" col-sm-1 ">DATE</th>


                                    <th class=" col-sm-3 ">Action</th>
                                </tr>
                            </thead>
                            <?php while ($row = $execution_requete->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $row['nom_employe']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['prenom_employe']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['matricule_employe']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['poste']; ?>

                                        </td>
                                        <td>
                                            <?php
                                            $recup_id_services = $row['id_services'];
                                            $verif_table_service = "SELECT * FROM `Services` WHERE `id_services`='$recup_id_services'";

                                            $stmt = $db->query($verif_table_service);
                                            $contenu_colonne_service = $stmt->fetch(PDO::FETCH_ASSOC);
                                            echo ($contenu_colonne_service === false ? NULL : $contenu_colonne_service['nom_services']);

                                            ?>


                                        </td>

                                        <td>
                                            <?php

                                            echo $row['numero_associe'];



                                            ?>
                                        </td>

                                        <td>

                                            <?php
                                            $recup_id_telephone = $row['id_telephone'];
                                            $verif_table_telephone = "SELECT * FROM `Telephone` WHERE `id_telephone`='$recup_id_telephone'";


                                            $stmt = $db->query($verif_table_telephone);
                                            $contenu_colonne_telephone = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo ($contenu_colonne_telephone === false ? NULL : $contenu_colonne_telephone['matricule']);
                                            ?>
                                        <td>
                                            <?php

                                            echo $row['created_at'];



                                            ?>
                                        </td>

                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifieremp.php?id_employe=<?php echo $row['id_employe']; ?>&id_telephone=<?php echo $row['id_telephone']; ?>&nom_employe=<?php echo $row['nom_employe']; ?>&prenom_employe=<?php echo $row['prenom_employe']; ?>&matricule_employe= <?php echo $row['matricule_employe']; ?>&poste= <?php echo $row['poste']; ?> "><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="liste_employe.php?id_employe=<?php echo $row['id_employe']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>

                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->