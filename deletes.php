<?php
require_once "Connect.php";
require_once "template.php";

$select_all_from_solde_initial = "SELECT * FROM Solde_initial  ";

$eceution_select_solde_initial = $db->query($select_all_from_solde_initial);


if (isset($_GET['id_solde_ini'])) {
    $id_solde_ini_delete = $_GET['id_solde_ini'];
    $req_sql_delete_id_solde_ini = " DELETE FROM solde_initial WHERE (id_solde_ini ='" . $id_solde_ini_delete . "')";
   $delete_solde_initial = $db->query($req_sql_delete_id_solde_ini);


    echo "<div id='page-wrapper' style='min-height: 292px'>";
    echo " <div class='row'>";
    echo " <div class='col-lg-12'>";
    echo "<div class='alert alert-success'>";
    echo " <h3> Supprimé avec success </h3> ";
    echo " </div>";
    echo " </div>";
    echo " </div>";
    
}


$select_all_from_employe = "SELECT * FROM Employe ";

$execution_select_employe = $db->query($select_all_from_employe);

if (isset($_GET['id_employe'])) {
    $id_employe = $_GET['id_employe'];
    $req_sql_delete_employe = " DELETE FROM Employe WHERE (id_employe ='" . $id_employe . "')";
  $delete_id_employe =  $db->query($req_sql_delete_employe);
    echo "<div id='page-wrapper' style='min-height: 292px'>";
    echo " <div class='row'>";
    echo " <div class='col-lg-12'>";
    echo "<div class='alert alert-success'>";
    echo " <h3> Supprimé avec success </h3> ";
    echo " </div>";
    echo " </div>";
    echo " </div>";
}

$select_all_solde_restant = "SELECT * FROM Solde_restant  ";

$execution_select_solde_restant = $db->query($select_all_solde_restant);


if (isset($_GET['id_solde_rest'])) {
    $id_solde_rest_delete = $_GET['id_solde_rest'];
    $req_sql_delete_solde_restant = " DELETE FROM solde_restant WHERE (id_solde_rest ='" . $id_solde_rest_delete . "')";
   $delete_solde_restant = $db->query($req_sql_delete_solde_restant);

   echo "<div id='page-wrapper' style='min-height: 292px'>";
   echo " <div class='row'>";
   echo " <div class='col-lg-12'>";
   echo "<div class='alert alert-success'>";
   echo " <h3> Supprimé avec success </h3> ";
   echo " </div>";
   echo " </div>";
   echo " </div>";


}

$tab = [];

$select_all_from_service = "SELECT * FROM Services  ";

$execution_select_service = $db->query($select_all_from_service);



if (isset($_GET['id_services'])) {

    if (isset($_POST['recherche_service'])) {

        array_push($tab, 'Champ vide');
    } else {



        $id_service = $_GET['id_services'];
        $req_sql_del_service = "DELETE FROM Services WHERE (id_services ='" . $id_service . "')";
       $delete_service = $db->query($req_sql_del_service);


       echo "<div id='page-wrapper' style='min-height: 292px'>";
       echo " <div class='row'>";
       echo " <div class='col-lg-12'>";
       echo "<div class='alert alert-success'>";
       echo " <h3> Supprimé avec success </h3> ";
       echo " </div>";
       echo " </div>";
       echo " </div>";


    }
}

if ($tab) {
    var_dump($tab[0]);
    exit;
}

$select_all_telephone = "SELECT * FROM Telephone ";

$execution_select_telephone = $db->query($select_all_telephone);



if (isset($_GET['id_telephone'])) {
    $id_telephone = $_GET['id_telephone'];
    $req_sql_telephone = " DELETE FROM Telephone WHERE (id_telephone ='" . $id_telephone . "')";
  $delete_telephone = $db->query($req_sql_telephone);

  echo "<div id='page-wrapper' style='min-height: 292px'>";
  echo " <div class='row'>";
  echo " <div class='col-lg-12'>";
  echo "<div class='alert alert-success'>";
  echo " <h3> Supprimé avec success </h3> ";
  echo " </div>";
  echo " </div>";
  echo " </div>";


}


$select_all_carte_sim = "SELECT * FROM carte_sim  ";

$execution_select_carte_sim = $db->query($select_all_carte_sim);



if (isset($_GET['id_carte_sim'])) {
    $id_carte_sim = $_GET['id_carte_sim'];
    $req_sql_delete_id_carte_sim = " DELETE FROM carte_sim WHERE (id_carte_sim ='" . $id_carte_sim . "')";
  $delete_id_carte_sim =  $db->exec($req_sql_delete_id_carte_sim);


  echo "<div id='page-wrapper' style='min-height: 292px'>";
  echo " <div class='row'>";
  echo " <div class='col-lg-12'>";
  echo "<div class='alert alert-success'>";
  echo " <h3> Supprimé avec success </h3> ";
  echo " </div>";
  echo " </div>";
  echo " </div>";


}

$select_all_from_recharge = "SELECT * FROM Recharge ";

$execution_select_recharge = $db->query($select_all_from_recharge);




if (isset($_GET['id_recharge'])) {
    $id_recharge = $_GET['id_recharge'];
    $req_sql_delete_id_recharge = " DELETE FROM recharge WHERE (id_recharge ='" . $id_recharge . "')";
    $delete_id_recharge = $db->exec($req_sql_delete_id_recharge);

    echo "<div id='page-wrapper' style='min-height: 292px'>";
    echo " <div class='row'>";
    echo " <div class='col-lg-12'>";
    echo "<div class='alert alert-success'>";
    echo " <h3> Supprimé avec success </h3> ";
    echo " </div>";
    echo " </div>";
    echo " </div>";


}

$select_all_from_achat_de_pass = "SELECT * FROM achat_de_pass ";

$excution_select_achat_de_pass = $db->query($select_all_from_achat_de_pass);

if (isset($_GET['id_achat'])) {
    $id_achat = $_GET['id_achat'];
    $req_sql_delete_id_achat = " DELETE FROM achat_de_pass WHERE (id_achat ='" . $id_achat . "')";
    $delete_id_achat = $db->exec($req_sql_delete_id_achat);


    echo "<div id='page-wrapper' style='min-height: 292px'>";
    echo " <div class='row'>";
    echo " <div class='col-lg-12'>";
    echo "<div class='alert alert-success'>";
    echo " <h3> Supprimé avec success </h3> ";
    echo " </div>";
    echo " </div>";
    echo " </div>";


}
