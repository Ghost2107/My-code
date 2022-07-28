<?php
require_once "Connect.php";
require_once "template.php";
$req_sql = "SELECT * FROM Solde_restant  ";

$execution_req_sql = $db->query($req_sql);

if (isset($_POST['enregistrer'])) {

    $id_solde_rest = $_POST['id_solde_rest'];
    $cartesim = $_POST['carte_sim'];
    $data_initial_rest = $_POST['sr_data'];
    $sms_initial_rest = $_POST['sr_sms'];
    $minute_initial_rest = $_POST['sr_minute'];
    $credit_initial_rest = $_POST['sr_credit'];
    $dates = $_POST['dates'];

    $req_update_sql = null;
    if (
        isset($_POST['id_solde_rest']) && isset($_POST['carte_sim']) && isset($_POST['sr_data']) &&
        isset($_POST['sr_sms']) && isset($_POST['sr_minute']) && isset($_POST['sr_credit']) && isset($_POST['dates'])
    ) {

        $req_update_sql = " UPDATE  solde_restant  WHERE  (id_solde_rest ='" . $id_solde_rest . "') ";

        // utilise exec() car aucun résultat n'est renvoyé
        $db->exec($req_update_sql);
        //creation de l'enregistrement
        echo " Nouvel enregistrement crée avec success ";
    } else {
        echo " Nouvel enregistrement refusé   ";
    }
}

$req_sql_del_rest = "SELECT * FROM Solde_restant  ";

$stmt_del_rest = $db->query($req_sql_del_rest);


if (isset($_GET['id_solde_rest'])) {
    $id_solde_rest_delete = $_GET['id_solde_rest'];
    $req_sql_delete_rest = " DELETE FROM solde_restant WHERE (id_solde_rest ='" . $id_solde_rest_delete . "')";
    $db->exec($req_sql_delete_rest);
}


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
                                            <a type="button" class="btn btn-warning" href="modifiersolde_restant.php?id_solde_rest=<?php echo $row['id_solde_rest']; ?>&sr_credit=<?php echo $row['sr_credit']; ?>&sr_data=<?php echo $row['sr_data']; ?>&sr_sms= <?php echo $row['sr_sms']; ?>&sr_minute=<?php echo $row['sr_minute']; ?>&dates=<?php echo $row['created_at']; ?>&id_carte_sim=<?php echo $assoc_colone_carte_sim['numero_sim']; ?>"><i class="fa fa-edit fa-lg"></i> Editer</a>
                                            <a type="button" class="btn btn-danger" href="liste_solde_restant.php?id_solde_rest=<?php echo $row['id_solde_rest']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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