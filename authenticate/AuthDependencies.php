<?php 
  include "pdoDB.php";

  require __DIR__ . '/vendor/autoload.php';

  $auth = new \Delight\Auth\Auth($dbh,null,null,false);
?>