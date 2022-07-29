<?php
require_once "Connect.php";
require_once "template.php";
$tab = [];

$sql = "SELECT * FROM Services  ";

$stmt = $db->query($sql);





?>


<style>
    .recherche_service {

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
                    <form class="form-horizontal" data-toggle="validator" role="form" method="get" action="recherche_service.php">
                        <input type="text" class=" form-control" name="recherche_service" id="recherche_service">

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

                                    <th class=" col-sm-1 ">NOM SERVICE</th>
                                    <th class=" col-sm-2 ">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr>

                                        <td>
                                            <?php echo $row['nom_services']; ?>
                                        </td>
                                        <td>

                                            <a type="button" class="btn btn-warning" href="modifier_service.php?id_services=<?php echo $row['id_services']; ?>&nom_services=<?php echo $row['nom_services']; ?>"><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="deletes.php?id_services=<?php echo $row['id_services']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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
    </div>

