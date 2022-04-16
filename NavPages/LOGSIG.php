
<!DOCTYPE html>
<html>

<title>Bones Hardware</title>
<head>
  <link rel="stylesheet" type="text/css" href="../layout.css">
  <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
</head>




<body id="signup" class="login-active">

<?php
 include_once '../Menu.php';
?>


<!--<script type="text/javascript">
    function closeLogin() {
        document.body.className = '';
    }
    function openLogin() {
        document.body.className = 'login-active';
    }
</script>

<div class="login-overlay">
    <div class="cancel-overlay" onclick="closeLogin();">
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        CLICK ME
    </div>

  Whatever derboven
</div> -->
<div class="signup-wrapper">
    <section class="signup-container">
        <div> 
            <h2>Vul hier in</h2>
            <form action="/authenticate/register.php" method="post" class="signup-form">
                  <input type="text" name="email" placeholder="gebruiker@example.com" value="" />
                  <input type="password" name="password" value="" placeholder="wachtwoord" />
                  <input type="submit" value="register" />
            </form>
        </div>
    </section>
</div>

</body>
</html>



