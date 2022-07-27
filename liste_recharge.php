<?php
require_once "Connect.php";
require_once "template.php";
$sql = "SELECT * FROM Recharge ";

$stmt = $db->query($sql);


if (isset($_POST['enregistrer'])) {


    $id = $_POST['id_solde'];
    $service = $_POST['s_credit'];
    $prenom = $_POST['s_data'];
    $maticule = $_POST['s_sms'];
    $poste1 = $_POST['s_minute'];
    $poste2 = $_POST['dates'];
    $poste3 = $_POST['carte_sim'];
    $sql = null;
    if (isset($_POST['id_solde']) && isset($_POST['s_credit']) && isset($_POST['s_data']) && isset($_POST['s_sms'])) {
        $sql = " UPDATE  Employe set nom_employe='" . $service . "'  where  (id_employe ='" . $id . "') ";

        // utilise exec() car aucun résultat n'est renvoyé
        $db->exec($sql);
        //creation de l'enregistrement
        echo " Nouvel enregistrement crée avec success ";
    } else {
        echo " Nouvel enregistrement refusé   ";
    }
}
$sql = "SELECT * FROM Recharge ";

$stmt = $db->query($sql);


if (isset($_GET['id_recharge'])) {
    $id = $_GET['id_recharge'];
    $req = " delete from Recharge where (id_recharge ='" . $id . "')";
    $db->exec($req);
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
                                            <a type="button" class="btn btn-danger" href="liste_recharge.php?id_recharge=<?php echo $row['id_recharge']; ?>"><i class="fa fa-trash fa-lg"></i> Supprimer</a>
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