<?php
require_once "Connect.php";
require_once "template.php";
$sql = "SELECT * FROM Recharge ";

$stmt = $db->query($sql);

if (isset($_POST['enregistrer'])) {
    $id_recharge = $_POST['id_recharge'];
    $montant = $_POST['montant'];
    $dates = $_POST['dates'];
    $sql = null;
}


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des recharges
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class=" col-sm-1 ">CARTE SIM</th>
                                    <th class=" col-sm-1 ">MONTANT</th>
                                    <th class=" col-sm-1 ">DATE</th>

                                    <th class=" col-sm-3 ">Action</th>
                                </tr>
                            </thead>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tbody>

                                    <tr>
                                        <td>
                                            <?php
                                            $nbr = $row['id_carte_sim'];
                                            $sql2 = "SELECT * FROM `carte_sim`  where `id_carte_sim`='$nbr'";
                                            $stmt2 = $db->query($sql2);
                                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                            echo $row2['numero_sim'];
                                            ?>

                                        </td>
                                        <td>
                                            <?php echo $row['montant']; ?>
                                        </td>
                                        <td>

                                            <?php echo $row['created_at']; ?>

                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifierrecharge.php?id_recharge=<?php echo $row['id_recharge']; ?>&montant=<?php echo $row['montant']; ?>&created_at=<?php echo $row['created_at']; ?>  "><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="delete.php?id_recharge=<?php echo $row['id_recharge']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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