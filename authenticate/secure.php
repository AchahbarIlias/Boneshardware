<?php 
  include "./AuthDependencies.php";

  if ($auth->isLoggedIn()) {

  }
  else {
    header('Location: /home.php');
    header("HTTP/1.1 401 Unauthorized");
    exit();
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>title</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script> -->
  </head>
  <body>
    Welcome on the secured page
  </body>
</html>