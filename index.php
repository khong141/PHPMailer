<?php

session_start();
include_once "../Dao/d_user.php";
include_once "../Dao/pdo.php";
$email=$_SESSION["gmail"]["email"];
$var = rand(10000, 99999);
$mat="gửi mật khẩu mới";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'thinhlpps31603@fpt.edu.vn';                     //main của mình 
    $mail->Password   = 'grmv qnuy euqt gqdw';                               //code google
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('thinhlpps31603@fpt.edu.vn', 'Mailer'); // main của mình 
    $mail->addAddress($email, 'user');     //mail người nhận 
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $mat; // headder mail
    $mail->Body    ='<html><head><style>h1 {color: blue;}</style></head><body><h1>Đây là mật khẩu mới của bạn:' .$var.'. Bạn hãy đăng nhập và đổi mật khẩu lại nhé</h1><img src="cid:logo"></body></html>';; // nội dung
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    upload($var,$email);
    $_SESSION["dagui"]=1;
    header('Location:../index.php?pg=dangnhap');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
