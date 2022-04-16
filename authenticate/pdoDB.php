<?php

$servername = "localhost";
$username = "boneshar_6NI";
$password = "tilting";

try {
  $dbh = new PDO('mysql:host=' . $servername . ';dbname=boneshar_Login', $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}

?>