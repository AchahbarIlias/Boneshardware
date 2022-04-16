<?php
  include "./AuthDependencies.php";

  try {
    $auth->confirmEmail($_GET['selector'], $_GET['token']);

    // email address has been verified
    header('Location: /index.php');
  }
  catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
    // invalid token
    header('Location: /authenticate/error.php?type=INVALID_TOKEN');
  }
  catch (\Delight\Auth\TokenExpiredException $e) {
    // token expired
    header('Location: /authenticate/error.php?type=TOKEN_EXPIRED');
  }
  catch (\Delight\Auth\UserAlreadyExistsException $e) {
    // email address already exists
    header('Location: /authenticate/error.php?type=USER_ALREADY_EXISTS');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
    // too many requests
    header('Location: /authenticate/error.php?type=TOO_MANY_REQUEST');
  }

  exit();

?>