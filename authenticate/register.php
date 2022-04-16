<?php 
  include "./AuthDependencies.php";
  include "../mailThis.php";

  try {
    $userId = $auth->register($_POST['email'], $_POST['password'], null, function ($selector, $token) {

        sendMail(
            "contact@boneshardware.be",
            $_POST['email'],
            "Verify by Bones...",
            "
            <html>
              <head>
                <title>Boneshardware.be </title>
              </head>
              <body>
                <h1>Boneshardware verify mail</h1>
                <p>Klik op de onderstaande link om je account op boneshardware te verifiëren</p>
                <a href=\"http://www.boneshardware.be/authenticate/verify-email.php?selector=" . $selector . "&token=" . $token . "\" >GET VERIFIED</a>
              </body>
            </html>
            "
        );

    });
    
        
    // we have signed up a new user with the ID `$userId`

    // TODO : SHOULD BE ACTIVE WHEN EMAILS ARE SEND
    header('Location: https://boneshardware.be/NavPages/LOGSIG.php');
  }
  catch (\Delight\Auth\InvalidEmailException $e) {
      // invalid email address
      header('Location: /authenticate/error.php?type=INVALID_EMAIL');
  }
  catch (\Delight\Auth\InvalidPasswordException $e) {
      // invalid password
      header('Location: /authenticate/error.php?type=INVALID_PASSWORD');
  }
  catch (\Delight\Auth\UserAlreadyExistsException $e) {
      // user already exists
      header('Location: /authenticate/error.php?type=USER_ALREADY_EXISTS');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
      // too many requests
      header('Location: /authenticate/error.php?type=TOO_MANY_REQUESTS');
  }
  catch (Exception $e) {
      header('Location: /authenticate/error.php?type=UNKNOWN');
  }

  exit();

?>