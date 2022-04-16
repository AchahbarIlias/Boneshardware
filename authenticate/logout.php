<?php

  include "./AuthDependencies.php";

  $auth->logOutAndDestroySession();

  header('Location: ../index.php');

  exit();

?>