<?php
//Open a new connection to the MySQL server
$mysqli = new mysqli('localhost', 'root', '', 'perfectcup');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$message= mysqli_real_escape_string($mysqli, $_POST['message']);

$email2 = "shratikpunde42@gmail.com";//here yours website name
$subject = "Test Message";


if (strlen($fname) > 50) {
  echo 'fname_long';

} elseif (strlen($fname) < 2) {
  echo 'fname_short';

} elseif (strlen($email) > 50) {
  echo 'email_long';

} elseif (strlen($email) < 2) {
  echo 'email_short';

} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo 'eformat';

} elseif (strlen($message) > 500) {
  echo 'message_long';

} elseif (strlen($message) < 3) {
  echo 'message_short';

} else {

  //MAILER


  //Import PHPMailer classes into the global namespace
  //These must be at the top of your script, not inside a function

  
  require 'PHPMailer-master/src/Exception.php';
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';
  
  
   
  //Load Composer's autoloader
  // require 'vendor/autoload.php';
  include 'smtp/PHPMailerAutoload.php';
  
  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer;
  
  
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'shratikpunde42@gmail.com';                     //SMTP username
      $mail->Password   = 'Shratik@123';                               //SMTP password
      // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
      // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->addReplyTo($email);
      $mail->setFrom = ($email2);
      $mail->FromName = $fname;          //Name is optional
      $mail->addAddress($email2, 'Admin');     //Add a recipient
      
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
  
      if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'true';
    }

  }
?>