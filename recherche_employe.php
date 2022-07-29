<?php
require_once "template.php";
require_once "Connect.php";
$tab = [];
if (isset($_GET['recherche_employe'])) {


    $recherche_employe = $_GET['recherche_employe'];


    $recherche_employe = $_GET['recherche_employe'];
    $sql = $db->prepare("SELECT * FROM employe WHERE nom_employe = '$recherche_employe' ");
    $sql->execute();
    $result = $sql->rowCount();

    if (!$result) {
        echo "vide";
    }
}

?>

<style>
    .recherche_employe {

        width: 70%;
        outline: none;
        border: 1px solid;
        height: 30px;
        background: whitesmoke;
        border-radius: 7px;

    }
</style>

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
                        <a href="liste_employe.php" color="white">Retour</a>
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
                                    <th class=" col-sm-1 ">MATRICULE TELEPHONE</th>
                                    <th class=" col-sm-2 ">DATE</th>


                                    <th class=" col-sm-3 ">Action</th>
                                </tr>
                            </thead>
                            <?php while ($row = $sql->fetch(PDO::FETCH_ASSOC)) : ?>
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
                                            <?php
                                            $recup_nom_poste = $row['poste'];
                                            /*  $insert_table_employe = "SELECT  Employe(poste) VALUE ('$recup_nom_poste')";


                                            $stmt = $db->query($insert_table_employe);
                                            $contenu_colonne = $stmt->fetch(PDO::FETCH_ASSOC); */
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $nbr3 = $row['id_services'];
                                            $sql8 = "SELECT * FROM `Services`  where `id_services`='$nbr3'";


                                            $stmt4 = $db->query($sql8);
                                            $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                        </td>
                                        <td>

                                            <?php
                                            $nbr = $row['id_telephone'];
                                            $sql2 = "SELECT * FROM `Telephone`  where `id_telephone`='$nbr'";
                                            $stmt2 = $db->query($sql2);
                                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $row['created_at']; ?>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifieremp.php?id_employe=<?php echo $row['id_employe']; ?>&id_telephone=<?php echo $row['id_telephone']; ?>&nom_employe=<?php echo $row['nom_employe']; ?>&prenom_employe=<?php echo $row['prenom_employe']; ?>&matricule_employe= <?php echo $row['matricule_employe']; ?>&poste= <?php echo $row['poste']; ?> "><i class="fa fa-edit fa-lg"></i> Editer</a>
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