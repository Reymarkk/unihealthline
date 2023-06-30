<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["contact-us-submit"])) {
    require 'dbh.inc.php';
    require 'functions.inc.php';
    //to connect to db using dbh.inc.php
    $userName =$_POST["name"];
    $userEmail =$_POST["email"];
    $userFeedback =$_POST["message"];

    //error handlers
    if (emptyFeedbackMessage($userName, $userEmail, $userFeedback) !== false) {
        header("location: ../pages/login.php?error=emptyinput");
        exit();
    }

    saveFeedback($conn, $userName, $userEmail, $userFeedback);

    //Include required PHPMailer files
    require '../phpmailer/PHPMailer.php';
    require '../phpmailer/SMTP.php';
    require '../phpmailer/Exception.php';
    //Define name spaces
    //use PHPMailer\PHPMailer\PHPMailer;
    //use PHPMailer\PHPMailer\SMTP;
    //use PHPMailer\PHPMailer\Exception;
    //Create instance of PHPMailer
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //Define smtp host
    $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
    $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
    //Port to connect smtp
    $mail->Port = "587";
    //Set gmail username
    $mail->Username = "reymarkcalexterioo@gmail.com";
    //Set gmail password
    $mail->Password = "tiibdnxmhtpywukp";
    //Email subject
    $mail->Subject = "uniHealthline | Thank you for your feedback";
    //Set sender email
    $mail->setFrom('reymarkcalexterioo@gmail.com');
    //Enable HTML
    $mail->isHTML(true);
    //Attachment
    //	$mail->addAttachment('img/attachment.png');
    //Email body
    $mail->Body = '<h1>Dear ' . $userName. ',</h1></br>';
    $mail->Body = '
<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Feedback - uniHealthline</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <style>
        body {
            background-color: #171717;
            font-family: "Poppins";
            margin: 0;
            color: #CBE4DE;
        }
        
        h1 {
            color: #1f497d;
        }
        
        p {
            margin-bottom: 15px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo .uni {
            color: #171717;
        }

        .logo .healthline {
            color: #2FA561;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="logo"><span class="uni">uni</span><span class="healthline">Healthline</span></h1>
        <h1>Dear ' . $userName . ',</h1>
        <p>Thank you for providing your valuable feedback to uniHealthline.</p>
        <p>Your opinion and insights are highly appreciated and play a vital role in helping us improve our products and services.</p>
        <p>We are committed to delivering exceptional healthcare solutions that exceed your expectations, and your feedback is instrumental in making that happen.</p>
        <p>Once again, we sincerely thank you for taking the time to share your thoughts with us. We value your contribution and look forward to serving you better in the future.</p>
        <p>Best regards,</p>
        <p>The uniHealthline Team</p>
    </div>
</body>
</html>';
    //Add recipient
    $mail->addAddress($userEmail);
    if ( $mail->send() ) {
        header("Location: ../index.php?sent=success");
    }

}
else {
    header("location: ../index.php"); //the '..' means going back this folder to find where the index.php at
}
$mail->smtpClose();

//-----------------------------------------------------------
/*
//Include required PHPMailer files
require '..phpmailer/PHPMailer.php';
require '..phpmailer/SMTP.php';
require '..phpmailer/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//Define smtp host
$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "tls";
//Port to connect smtp
$mail->Port = "587";
//Set gmail username
$mail->Username = "reymarkcalexterioo@gmail.com";
//Set gmail password
$mail->Password = "tiibdnxmhtpywukp";
//Email subject
$mail->Subject = "broCode | Reset your password";
//Set sender email
$mail->setFrom('reymarkcalexterioo@gmail.com');
//Enable HTML
$mail->isHTML(true);
//Attachment
//	$mail->addAttachment('img/attachment.png');
//Email body
$mail->Body = "<h1>We received a password reset request.</h1></br>
<p>We received a password reset request. The link to reset your password is below if you did not make this request, you can ignore this email</p></br>
<p>Here is your password reset link: </br>
<a href="' . $url . '">' . $url . '</a></p>";
//Add recipient
$mail->addAddress('reymarkcalexterio@gmail.com');
//Finally send email
if ( $mail->send() ) {
    header("Location: ../reset-password.php?reset=success");
}
else {
    header("location: ../index.php"); //the '..' means going back this folder to find where the index.php at
}
//Closing smtp connection
$mail->smtpClose();
*/