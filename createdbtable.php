<?php
$servername = "127.0.0.1";
$dbname = "sot";
$username = "root";
$password = "";
$port = 3306;
$sql = null;
$sql1 = null;
$sql2 = null;
try {
  $conn = new PDO("mysql:host=$servername;$dbname=$dbname;port=$port", $username, $password);
  // définit le mode d'erreur PDO sur exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE sot";
  // utilise exec() car aucun résultat n'est renvoyé
  $conn->exec($sql);
  echo "Database created successfully<br>";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  /** create the multiples tables **/

  $sql1 = [

    'CREATE TABLE Telephone (
      id_telephone INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       matricule VARCHAR(50) NOT NULL,
       marque VARCHAR (50) NOT NULL,
      is_delete TINYINT(1),
      created_at TIMESTAMP
    );',

    'CREATE TABLE Services (
      id_services INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      nom_services VARCHAR(50) NULL,
      is_delete TINYINT(1),
      created_at TIMESTAMP
      );',

    'CREATE TABLE carte_sim (
  id_carte_sim INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  operateur VARCHAR (50) NOT NULL,
  numero_sim VARCHAR(50) NOT NULL,
  is_delete TINYINT(1),
  created_at TIMESTAMP
  );',

    'CREATE TABLE Employe (
  id_employe INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nom_employe VARCHAR(50) NOT NULL,
  prenom_employe VARCHAR (50) NOT NULL,
  matricule_employe VARCHAR (50) NOT NULL,
  poste VARCHAR (50) NULL,
  numero_associé INT (10) NULL ,
  is_delete TINYINT(1),
  created_at TIMESTAMP,
  id_services INT(6) UNSIGNED,
   CONSTRAINT fk_Services
    FOREIGN KEY(id_services)
    REFERENCES Services(id_services) 
    ON DELETE CASCADE,
    id_telephone INT(6) UNSIGNED,
    CONSTRAINT fk_Telephone
    FOREIGN KEY( id_telephone) 
    REFERENCES Telephone( id_telephone) 
    ON DELETE CASCADE,
    id_carte_sim INT(6) UNSIGNED,
    CONSTRAINT fc_carte_sim
    FOREIGN KEY( id_carte_sim) 
    REFERENCES carte_sim( id_carte_sim) 
    ON DELETE CASCADE
   

  );',



    'CREATE TABLE consommation (
  id_conso INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  c_credit VARCHAR(50) NOT NULL,
  c_data FLOAT (50) NOT NULL,
  c_sms INT (50) NOT NULL,
  c_minute FLOAT (50) NOT NULL,
  is_delete TINYINT(1),
  created_at TIMESTAMP,
  id_carte_sim INT(6) UNSIGNED,
        CONSTRAINT fkk_carte_sim
        FOREIGN KEY( id_carte_sim) 
        REFERENCES carte_sim( id_carte_sim) 
        ON DELETE CASCADE
  );',

    'CREATE TABLE Solde_initial (
        id_solde INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        s_credit VARCHAR(50) NOT NULL,
        s_data VARCHAR(50) NOT NULL,
        s_sms VARCHAR(50) NOT NULL,
        s_minute VARCHAR(50) NOT NULL, 
        is_delete TINYINT(1) ,
        created_at TIMESTAMP,
        id_carte_sim INT(6) UNSIGNED,
        CONSTRAINT fk_carte_sim
        FOREIGN KEY( id_carte_sim) 
        REFERENCES carte_sim( id_carte_sim) 
        ON DELETE CASCADE
         );',

    'CREATE TABLE Solde_restant (
  id_solde_r INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  sr_credit VARCHAR(50) NOT NULL,
  sr_data VARCHAR(50) NOT NULL,
  sr_sms VARCHAR(50) NOT NULL,
  sr_minute VARCHAR(50) NOT NULL,
  is_delete TINYINT(1),
  created_at TIMESTAMP,
  id_carte_sim INT(6) UNSIGNED,
  CONSTRAINT fkr_carte_sim
  FOREIGN KEY( id_carte_sim) 
  REFERENCES carte_sim( id_carte_sim) 
  ON DELETE CASCADE
   );',

    'CREATE TABLE Recharge (
        id_recharge INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         montant INT(50) NOT NULL,
         is_delete TINYINT(1),
         created_at TIMESTAMP,
         id_carte_sim INT(6) UNSIGNED,
        CONSTRAINT f_carte_sim
        FOREIGN KEY( id_carte_sim) 
        REFERENCES carte_sim( id_carte_sim) 
        ON DELETE CASCADE
         );',

    'CREATE TABLE User (
      id_user INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      nom VARCHAR (12) NOT NULL,
      prenom VARCHAR (100) NOT NULL,
      email  VARCHAR(50) UNIQUE NOT NULL,
      passwords VARCHAR (255) NOT NULL,
      type_user TINYINT (1) DEFAULT 1 NOT NULL,
      is_delete TINYINT(1),
      created_at TIMESTAMP
    );',


    'CREATE TABLE Achat_de_pass (
  id_achat INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  vol_sms INT (9) NULL,
  vol_min INT (9) NULL,
  vol_data INT (9) NULL,
  montant_achat INT(9) NULL ,
  is_delete TINYINT(1),
  created_at TIMESTAMP
);'




  ];

  foreach ($sql1 as $sql2) {
    $conn->exec($sql2);
  }
  echo "Tables created successfully";
} catch (PDOException $e) {
  echo $sql2 . "<br>" . $e->getMessage();
}

$conn = null;
