<?php
require_once "Connect.php";
require_once "template.php";
$req_sql = "SELECT * FROM Solde_restant  ";

$execution_req_sql = $db->query($req_sql);


?>



<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des soldes restants
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>

                                    <th class=" col-sm-1 ">CARTE SIM</th>
                                    <th class=" col-sm-1">SOLDE DATA RESTANT</th>
                                    <th class=" col-sm-1 ">SOLDE SMS RESTANT</th>
                                    <th class=" col-sm-1 ">SOLDE MINUTE RESTANT</th>
                                    <th class=" col-sm-1 ">SOLDE CREDIT RESTANT</th>
                                    <th class=" col-sm-2 ">DATE</th>

                                    <th class=" col-sm-3 ">Action</th>
                                </tr>
                            </thead>

                            <?php while ($row = $execution_req_sql->fetch(PDO::FETCH_ASSOC)) :


                            ?>
                                <tbody>

                                    <tr>

                                        <td>
                                            <?php

                                            $recup_id_carte_sim = $row['id_carte_sim'];
                                            $select_all_carte_sim = "SELECT * FROM `carte_sim`  where `id_carte_sim`=' $recup_id_carte_sim'";
                                            $excution_select = $db->query($select_all_carte_sim);
                                            $assoc_colone_carte_sim = $excution_select->fetch(PDO::FETCH_ASSOC);
                                            echo $assoc_colone_carte_sim['numero_sim']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sr_data']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sr_sms']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sr_minute']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sr_credit']; ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo $row['created_at'];
                                            ?>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifiersolde_restant.php?id_solde=<?php echo $row['id_solde_r']; ?>&sr_credit=<?php echo $row['sr_credit']; ?>&sr_data=<?php echo $row['sr_data']; ?>&sr_sms= <?php echo $row['sr_sms']; ?>&sr_minute=<?php echo $row['sr_minute']; ?>&dates=<?php echo $row['created_at']; ?>&id_carte_sim=<?php echo $row2['numero_sim']; ?>"><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="liste_solde_restant.php?id_solde_r=<?php echo $row['id_solde_r']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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