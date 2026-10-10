<?php

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;


if(!isset($_POST['btn_submit'])){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $from = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
    $to = "info@bhaishreegroup.com";

    // create object of PHPMailer class with boolean parameter which sets/unsets exception.
    $mail = new PHPMailer(true);                              
    try {
        $mail->isSMTP(); // using SMTP protocol                                     
        $mail->Host = 'relay-hosting.secureserver.net'; // SMTP host as gmail 
        $mail->SMTPAuth = false;  // enable smtp authentication                                                      
        $mail->SMTPSecure = 'none';  // for encrypted connection                           
        $mail->Port = 25;   // port for SMTP
		$mail->isHTML(true);

        $mail->setFrom($from, "Sender"); // sender's email and name
        $mail->addAddress($to, "Receiver");  // receiver's email and name

        $mail->Subject = $subject;
        $mail->Body    = "Name:- ".$name."<br/>Email:- ".$from."<br/>Subject:- ".$subject."<br/>Messege:- ".$message;

        $retval = $mail->send();
        if($retval == true){
            echo "OK";
          
        }
        else{
            echo "There is some error!";
        }
    
    } catch (Exception $e) { // handle error.
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

?>
