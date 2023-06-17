<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["reset-request-submit"])) {
    //this are the two tokens for authenticating and selecting from db.
    //selector token for 
    //token token is for authenticating the user, to make sure that this is the user
    //we use two different tokens to avoid timing attacks
    //timing attacks is a way for the hackers to brute force into website
    $selector = bin2hex(random_bytes(8));
    //random bytes is built in function in php
    //
    $token = random_bytes(32);
    //
    $url = "unihealthline.com/pages/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    //this will be the url for creating password
    //
    //bin2hex to convert bytes into hexadecimal
    $expires = date("U") + 1800;
    //date is a built in function in php
    //U means present date; 1800 seconds
    //1800 seconds ahead from present(U) the url will expires
    require 'dbh.inc.php';
    //to connect to db using dbh.inc.php

    $userEmail =$_POST["email"];
    //declare userEmail
    //calling the value inputed in the form named email
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
    //this reset/delete the existing token to avoid multiple tokens
    $stmt = mysqli_stmt_init($conn);
    // prepared statement to make the system secure
    if (!mysqli_stmt_prepare($stmt, $sql)) { //if the code didn't run it will print there was an error
        echo "There was an error!";
        exit();
    }
    else {//if not it will run the prepared statement to delete the previous token from the userEmail
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }
    else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    //mysqli_close();

    //require_once ('../PHPMailer/PHPMailerAutoload.php');

    



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
    $mail->Subject = "uniHealthline | Reset your password";
    //Set sender email
    $mail->setFrom('reymarkcalexterioo@gmail.com');
    //Enable HTML
    $mail->isHTML(true);
    //Attachment
    //	$mail->addAttachment('img/attachment.png');
    //Email body
    $mail->Body = '<h1>We received a password reset request.</h1></br>';
    $mail->Body .= '<p>The link to reset your password is below if you did not make this request, you can ignore this email</p></br>';
    $mail->Body .= '<p>Here is your password reset link: </br>';
    $mail->Body .= '<a href="' . $url . '">' . $url . '</a></p>';
    //Add recipient
    $mail->addAddress($userEmail);
    if ( $mail->send() ) {
        header("Location: ../pages/reset-password.php?reset=success");
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