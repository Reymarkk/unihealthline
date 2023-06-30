<?php

if(isset($_POST["submit"])) {

    $message = $_POST["message"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    require_once 'dbh.inc.php'; //to connect in the database
    require_once 'functions.inc.php';

    //error handlers
    if (emptyRantMessage($message, $name, $email) !== false) {
        header("location: ../pages/login.php?error=emptyinput");
        exit();
    }

    saveRant($conn, $message, $name, $email);
}

else {
    header("location: ../pages/login.php");
    exit();
}