<?php
  $name = $_POST['naam'];
  $visitor_email = $_POST['email'];
  $message = $_POST['bericht'];

	$email_from = $visitor_email;

	$email_subject = "Nieuwe mail:";

	$email_body = "Je hebt een bericht ontvangen van $name.\n".
                            "Hier is het bericht:\n $message";

  $to = "contact@boneshardware.be";

  $headers = "From: $email_from \r\n";

  $headers .= "Reply-To: $visitor_email \r\n";

  mail($to,$email_subject,$email_body,$headers);


function IsInjected($str)
{
    $injections = array('(\n+)',
           '(\r+)',
           '(\t+)',
           '(%0A+)',
           '(%0D+)',
           '(%08+)',
           '(%09+)'
           );
               
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    
    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}

if(IsInjected($visitor_email))
{
    echo "Error!";
    exit;
}

header("Location: http://boneshardware.be/NavPages/Contact.php");

 ?>