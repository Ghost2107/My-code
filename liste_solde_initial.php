<?php
require_once "Connect.php";
require_once "template.php";
$sql = "SELECT * FROM Solde_initial  ";

$stmt = $db->query($sql);








?>



<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des soldes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                <th class=" col-sm-1 ">CARTE SIM</th>
                                <th class=" col-sm-1">SOLDE DATA</th>
                                <th class=" col-sm-1 ">SOLDE SMS</th>
                                <th class=" col-sm-1 ">SOLDE MINUTE</th>
                                <th class=" col-sm-1 ">SOLDE CREDIT</th>
                                <th class=" col-sm-2 ">DATE</th>
                                    
                                <th class=" col-sm-3 ">Action</th>
                                   
                                    
                                    
                                </tr>
                            </thead>

                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :


                            ?>
                                <tbody>

                                    <tr>

                                    <td>
                                            <?php  
                                            
                                            $nbr = $row['id_carte_sim'];
                                            $sql2 = "SELECT * FROM `carte_sim`  where `id_carte_sim`='$nbr'";
                                            $stmt2 = $db->query($sql2);
                                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                            echo $row2['numero_sim']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['s_data']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['s_sms']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['s_minute']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['s_credit']; ?>
                                        </td>
                                     
                                        <td>
                                            <?php
                                          echo $row['created_at']; 
                                            ?>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-warning" href="modifiersolde.php?id_solde=<?php echo $row['id_solde']; ?>&s_credit=<?php echo $row['s_credit']; ?>&s_data=<?php echo $row['s_data']; ?>&s_sms= <?php echo $row['s_sms']; ?>&s_minute=<?php echo $row['s_minute']; ?>&dates=<?php echo $row['created_at']; ?>&id_carte_sim=<?php echo $row2['numero_sim']; ?>"><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="liste_solde.php?id_solde=<?php echo $row['id_solde']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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