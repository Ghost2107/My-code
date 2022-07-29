<?php
require_once "Connect.php";
require_once "template.php";


$requete_sql_employe = "SELECT * FROM Employe ";

$execution_requete = $db->query($requete_sql_employe);

if (isset($_POST['enregistrer'])) {

    $id_employe = $_POST['id_employe'];
    $nom_employe = $_POST['nom_employe'];
    $prenom_employe = $_POST['prenom_employe'];
    $matricule_employe = $_POST['matricule_employe'];
    $poste = $_POST['poste'];
    $num_associe = $_POST['num_associe'];
    $sms_initial = $_POST['s_sms'];
    $minute_initiale = $_POST['s_minute'];
    $credit_initial = $_POST['s_credit'];
    $dates = $_POST['dates'];

    $req_update_sql = null;
    if (
        isset($_POST['id_solde']) && isset($_POST['carte_sim']) && isset($_POST['s_data']) &&
        isset($_POST['s_sms']) && isset($_POST['s_minute']) && isset($_POST['s_credit']) && isset($_POST['dates'])
    ) {

        $req_update_sql = " UPDATE  solde_initial  WHERE  (id_solde_ini ='" . $id_solde_ini . "') ";

        // utilise exec() car aucun résultat n'est renvoyé
        $db->exec($req_update_sql);
        //creation de l'enregistrement
        echo "<div class='alert alert-success'>";
        echo " Nouvel enregistrement crée avec success ";
        echo "</div>";
    } else {
        echo "<div class='alert alert-danger'>";
        echo " Nouvel enregistrement refusé   ";
        echo "</div>";
    }
}



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
                                    <th class=" col-sm-2">PRENOM</th>
                                    <th class=" col-sm-1 ">MATRICULE</th>
                                    <th class=" col-sm-1 ">POSTE</th>
                                    <th class=" col-sm-1 ">NOM SERVICE</th>
                                    <th class=" col-sm-1 ">NUMERO ASSOCIE</th>
                                    <th class=" col-sm-1 ">MATRICULE TELEPHONE</th>
                                    <th class=" col-sm-3 ">DATE</th>


                                    <th class=" col-sm-6 ">Action</th>
                                </tr>
                            </thead>
                            <?php while ($row = $execution_requete->fetch(PDO::FETCH_ASSOC)) :

                            ?>
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
                                            <a type="button" class="btn btn-warning" href="modifieremp.php?id_employe=<?php echo $row['id_employe']; ?>&id_telephone=<?php echo $row['id_telephone']; ?>&nom_employe=<?php echo $row['nom_employe']; ?>&prenom_employe=<?php echo $row['prenom_employe']; ?>&matricule_employe= <?php echo $row['matricule_employe']; ?>&poste= <?php echo $row['poste']; ?>&id_services= <?php echo $row['id_services']; ?>&id_carte_sim= <?php echo $row['id_carte_sim']; ?> "><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="deletes.php?id_employe=<?php echo $row['id_employe']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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