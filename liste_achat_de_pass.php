<?php
require_once "Connect.php";
require_once "template.php";

$sql = "SELECT * FROM achat_de_pass ";

$stmt = $db->query($sql);

?>



<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste d'achat de pass
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>

                                    <th class=" col-sm-2 ">CARTE SIM</th>
                                    <th class=" col-sm-1 ">VOLUME SMS</th>
                                    <th class=" col-sm-1 ">VOLUME DATA</th>
                                    <th class=" col-sm-1 ">VOLUME MINUTES</th>
                                    <th class=" col-sm-2 ">MONTANT</th>
                                    <th class=" col-sm-2 ">DATE</th>

                                    <th class=" col-sm-2 ">Action</th>
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
                                            <?php echo $row['vol_sms']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['vol_data']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['vol_min']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['montant_achat']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['created_at']; ?>
                                        </td>

                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifierachat_pass.php?id_achat=<?php echo $row['id_achat']; ?>&montant_achat=<?php echo $row['montant_achat']; ?>&created_at=<?php echo $row['created_at']; ?>  "><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="liste_achat_de_pass.php?id_achat=<?php echo $row['id_achat']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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