<?php
require_once "Connect.php";
require_once "template.php";
$select_all_from_telephone = "SELECT * FROM Telephone  ";

$execution_req = $db->query($select_all_from_telephone);

if (isset($_POST['enregistrer'])) {
    $id = $_POST['id_telephone'];
    $marque_telephone = $_POST['marque'];
    $matricule_telephone = $_POST['matricule'];
    $sql = null;
}


?>


<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form class="form-horizontal" data-toggle="validator" role="form" method="get" action="recherche_telephone.php">
                        <input type="text" class=" form-control" name="recherche_telephone" id="recherche_telephone">

                        <p>
                            <button type="submit" class="btn btn-primary">Recherche </button>
                        </p>

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>

                                    <th class=" col-sm-1 "> MATRICULE DU TELEPHONE</th>
                                    <th class=" col-sm-1">MARQUE DU TELEPHONE </th>

                                    <th class=" col-sm-3 ">Action</th>
                                </tr>
                            </thead>
                            <?php while ($row = $execution_req->fetch(PDO::FETCH_ASSOC)) : 
                                
                                ?>
                                <tbody>

                                    <tr>


                                        <td>
                                            <?php echo $row['matricule']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['marque']; ?>

                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifiertel.php?id_telephone=<?php echo $row['id_telephone']; ?>&matricule=<?php echo $row['matricule']; ?> &marque =<?php echo $row['marque']; ?> "><i class="fa fa-edit fa-lg"></i> Editer </a>
                                            <a type="button" class="btn btn-danger" href="deletes.php?id_telephone=<?php echo $row['id_telephone']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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