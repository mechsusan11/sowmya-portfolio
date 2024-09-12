<?php
session_start();

// $name = $_REQUEST['name'];
// $email = $_REQUEST['email'];
// $subject = $_REQUEST['subject'];
// $message = $_REQUEST['message'];

// // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// // Headers for email
// $headers  = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
// $headers .= "From: $email" . "\r\n";

// $mail_body = "Name : " . $name . "<br>";
// $mail_body .= "Email : " . $email . "<br>";
// $mail_body .= "Subject : " . $subject . "<br>";
// $mail_body .= "Message : " . $message . "<br>";

// if (mail("mechsusan123@gmail.com", "From: Contact Form Your name", $mail_body, $headers)) {
//     $thanks_mail_body = "Hello " . $name . "<br>";
//     $thanks_mail_body .= "Hey! Thanks for your email!<br>";
//     $thanks_mail_body .= "I will get back to you soon.<br>";
//     $thanks_mail_body .= "Thank You,<br>";
//     $thanks_mail_body .= "SUDARSHAN G";

//     if (mail($email, "Contact Request Notification Email", $thanks_mail_body, $headers)) {
//         echo "1";
//         die();
//     }
//     echo "1";
// } else {
//     echo "0";
// }


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submitContact'])) {

    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Subject = $_POST['Subject'];
    $Message = $_POST['message'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication

        $mail->Username = 'mechsusan123@gmail.com';                     //SMTP username
        $mail->Password = 'epnkssdtakgrszjx';                           //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($Email);
        // $mail->addAddress('mechsusan123@gmail.com', 'recipient');  //Add a recipient


        $mail->addAddress('mechsusan123@gmail.com');           //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                 //Set email format to HTML
        $mail->Subject = 'New Enquiry - From Portfolio Website';
        $mail->Body = '<h3>Hello, you got a new enquiry</h3>
        <h4>Name: ' . $Name . '</h4>
        <h4>Email: ' . $Email . '</h4>
        <h4>Subject: ' . $Subject . '</h4>
        <h4>Message: ' . $Message . '</h4>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            $_SESSION['status'] = "Will get back to you soon.";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    header('Location: index.php');
    exit(0);
}

?>