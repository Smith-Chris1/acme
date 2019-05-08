<?php
function acmeConnect(){
  $server = 'localhost';
  $database = 'acme';
  $username = 'iClient';
  $password = 'qdYlsNmnXwWoX9md';
  $dsn = 'mysql:host=' . $server . ';dbname=' . $database;
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  try {
    $db = new PDO($dsn, $username, $password, $options);
    return $db;
  } catch (PDOException $exc) {
    header('location: /acme/view/500.php');
    exit;
  }
}
acmeConnect();

 ?>