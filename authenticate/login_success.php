<?php 
  include "./AuthDependencies.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Bones Hardware</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script> -->
  </head>
  <body>
    GREAT SUCCESS: 
    <?php 
    if ($auth->isLoggedIn()) {
      echo('User logged in');
    }
    else {
      echo('User not logged in');
    }
    ?>
  </body>
</html>