<?php
$host = 'localhost';
$dbname = 'sot';
$username = 'root';
$port = 3306;
$password = '';
try {

    $db = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    //echo "Connected to $dbname at $host successfuly.";
} catch (PDOException $pe) {

    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
