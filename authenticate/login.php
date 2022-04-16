<?php 
  include "./AuthDependencies.php";

  try {
    $auth->login($_POST['email'], $_POST['password']);

    // user is logged in
    header('Location: /index.php');
  }
  catch (\Delight\Auth\InvalidEmailException $e) {
      // wrong email address
      header('Location: '. $_GET['from'].'?login_error=WRONG_EMAIL');
  }
  catch (\Delight\Auth\InvalidPasswordException $e) {
      // wrong password
      header('Location: '. $_GET['from'].'?login_error=WRONG_PASSWORD');
  }
  catch (\Delight\Auth\EmailNotVerifiedException $e) {
      // email not verified
      header('Location: /error.php?type=EMAIL_NOT_VERIFIED');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
      // too many requests
      header('Location: /error.php?type=TOO_MANY_REQUESTS');
  }

  exit();
?>