<?php
    
    
    function sendMail(string $from, string $to, string $subject, string $message) {
        
        $headers = "From: " . $from . " \r\n";
        $headers .= "Reply-To: " . $from . " \r\n";
        $headers .= "X-Mailer: PHP/".phpversion()." \r\n";
        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
    
    
        mail($to,$subject,$message,$headers,"-f " . $from);


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

        if(IsInjected($from))
        {
            return "Error!";
            exit;
        } else {
            return null;
        }
    }


 ?>