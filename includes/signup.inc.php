<?php

if (isset($_POST["submit"])){
    //this will go here if the user completed the signup form

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenum"];
    $bdate = $_POST["bdate"];
    $gender = $_POST["gender"];
    $username = $_POST["uid"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    require_once 'dbh.inc.php'; //start the connection to the database
    require_once 'functions.inc.php'; //

    //error handlers
    if (emptyInputSignup($name, $email, $phonenumber, $username, $bdate, $gender, $password, $cpassword) !== false) {
        header("location: ../pages/signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../pages/signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../pages/signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($password, $cpassword) !== false) {
        header("location: ../pages/signup.php?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../pages/signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $phonenumber, $bdate, $gender, $username, $password);

}
else {
    //user will throwback into the signup page again if they didn't properly fill up the sign up page.
    header("location: ../pages/signup?error=errorsataas.php");
}