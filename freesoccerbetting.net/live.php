<?php
require_once 'phpmailer/class.phpmailer.php';
    
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "soccer@ticket1x2.com";
    $mail->Password = "roletna1";
    $mail->SMTPSecure = "ssl";  
    $mail->Host = "mail.ticket1x2.com";
    $mail->Port = "465";
 
    $mail->setFrom('soccer@ticket1x2.com', 'rade');
    $mail->AddAddress('umetnikcvele@gmail.com', 'receivers name');
 
    $mail->Subject  =  'using PHPMailer';
    $mail->IsHTML(true);
    $mail->Body    = 'Hi there ,
                      <br />
                      this mail was sent using PHPMailer...
                      <br />
                      cheers... :)';
        
    if($mail->Send())
    {
        echo "Message was Successfully Send :)";
    }
    else
    {
        echo "Mail Error - >".$mail->ErrorInfo;
    }
?>