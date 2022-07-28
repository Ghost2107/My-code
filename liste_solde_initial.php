<?php
require_once "Connect.php";
require_once "template.php";
$sql = "SELECT * FROM Solde_initial  ";

$stmt = $db->query($sql);

if (isset($_POST['enregistrer'])) {

    $id_solde_ini = $_POST['id_solde_ini'];
    $cartesim = $_POST['carte_sim'];
    $data_initial = $_POST['s_data'];
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
        echo " Nouvel enregistrement crée avec success ";
    } else {
        echo " Nouvel enregistrement refusé   ";
    }
}

$req_sql_del_ini = "SELECT * FROM Solde_initial  ";

$stmt_del_ini = $db->query($req_sql_del_ini);


if (isset($_GET['id_solde_ini'])) {
    $id_solde_ini_delete = $_GET['id_solde_ini'];
    $req_sql_delete_ini = " DELETE FROM solde_initial WHERE (id_solde_ini ='" . $id_solde_ini_delete . "')";
    $db->exec($req_sql_delete_ini);
}


?>





<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des soldes initiaux
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
                                            <a type="button" class="btn btn-warning" href="modifiersolde_initial.php?id_solde_ini=<?php echo $row['id_solde_ini']; ?>&s_credit=<?php echo $row['s_credit']; ?>&s_data=<?php echo $row['s_data']; ?>&s_sms= <?php echo $row['s_sms']; ?>&s_minute=<?php echo $row['s_minute']; ?>&dates=<?php echo $row['created_at']; ?>&id_carte_sim=<?php echo $row2['numero_sim']; ?>"><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="liste_solde_initial.php?id_solde_ini=<?php echo $row['id_solde_ini']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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