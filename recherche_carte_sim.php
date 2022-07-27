<?php
require_once "template.php";
require_once "Connect.php";
$tab = [];
if (isset($_GET['recherche_carte_sim '])) {


    $recherche_carte_sim  = $_GET['recherche_carte_sim '];


    $recherche_carte_sim  = $_GET['recherche_carte_sim '];
    $sql = $db->prepare("SELECT * FROM carte_sim WHERE numero_sim = '$recherche_carte_sim ' ");
    $sql->execute();
    $result = $sql->rowCount();

    if (!$result) {
        echo "vide";
    }
}

?>

<style>
    .recherche_carte_sim {

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
                <form class="form-horizontal" data-toggle="validator" role="form" method="get" action="recherche_carte_sim.php">
                        <input type="text" class=" form-control" name="recherche_carte_sim" id="recherche_carte_sim">

                        <p>
                            <button type="submit" class="btn btn-primary">Recherche </button>
                        </p>
                        <a href="liste_carte_sim.php" color="white">Retour</a>
                   
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>

                                    <th class=" col-sm-1 ">OPERATEUR</th>
                                    <th class=" col-sm-1">NUMERO</th>

                                    <th class=" col-sm-3 ">Action</th>
                                </tr>
                            </thead>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tbody>

                                    <tr>

                                        <td>
                                            <?php echo $row['operateur']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['numero_sim']; ?>

                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifiercarte.php?id_carte_sim=<?php echo $row['id_carte_sim']; ?>&operateur=<?php echo $row['operateur']; ?>&numero_sim= <?php echo $row['numero_sim']; ?> "><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="liste_carte_sim.php?id_carte_sim=<?php echo $row['id_carte_sim']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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