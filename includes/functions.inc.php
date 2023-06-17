<?php

function emptyInputSignup($name, $email, $phonenumber, $bdate, $gender, $username, $password, $cpassword) {
    $result;
    if (empty($name) || empty($email) || empty($phonenumber) || empty($bdate) || empty($gender) || empty($username) || empty($password) || empty($cpassword)) {
        $result = true;
    }
    else {
        $result = false; // may error
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;// may error
    }
    return $result;
}

function pwdMatch($password, $cpassword) {
    $result;
    if ($password !== $cpassword) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed/usernameexists");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqlit_stmt_close($stmt);
}

/*
function subscriptionExists($conn, $accountemail) {
    $sql = "SELECT * FROM users WHERE usersEmail = ? AND usersStatus = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed/usernameexists");
        exit();
    }
    
    $accountstatus = "Subscribed";

    mysqli_stmt_bind_param($stmt, "ss", $accountemail, $accountstatus);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqlit_stmt_close($stmt);
}



function accountNumber($conn, $accountemail) {
    $sql = "SELECT * FROM subscribeaccounts WHERE accountEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed/usernameexists");
        exit();
    }
    
    $accountstatus = "Subscribed";

    mysqli_stmt_bind_param($stmt, "s", $accountemail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $accountnumber = mysqli_fetch_row($resultData);

    $accountnumber = $accountnumber[1];
    
    return $accountnumber;
    mysqlit_stmt_close($stmt);
    
}

*/

function createUser($conn, $name, $email, $phonenumber, $bdate, $gender, $username, $password) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersPhonenumber, usersBdate, usersGender, usersUid, usersPwd) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed");
        exit();
    }


    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $phonenumber, $bdate, $gender, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    //calculating age

    $sql = "UPDATE users SET usersAge = (DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), usersBdate)), '%Y') + 0);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    header("location: ../pages/login.php?error=none"); // to edit, login!
    exit();
}

function emptyInputLogin($username, $password) {
    $result;
    if (empty($username) || empty($password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password) {
    $uidExist = uidExists($conn, $username, $username);

    if ($uidExist === false) {
        header("location: ../pages/login.php?error=wronglogin");
        exit();
    }
    
    $passwordHashed = $uidExist["usersPwd"];
    $checkpassword = password_verify($password, $passwordHashed);

    if ($checkpassword === false) {
        header("location: ../pages/login.php?error=wronglogin");
        exit();
    }

    else if ($checkpassword === true) {
        session_start();
        $_SESSION["userid"] = $uidExist["usersId"];
        $_SESSION["useruid"] = $uidExist["usersUid"]; //use this mthfker
        $_SESSION["userstatus"] = $uidExist["usersStatus"]; // to check if admin or not
        
        header("location: ../index.php");
        exit();
    }
}

function emptyInputForm($baddress, $cnumber) {
    $result;
    if (empty($baddress) || empty($cnumber)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function subscribeUser($conn, $accountemail, $billingaddress, $contactnumber, $subscriptionstatus,) {
    $sql = "INSERT INTO subscribeaccounts (accountNumber, accountEmail, subscriptionStatus, billingAddress, contactNumber) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../subscription.php?error=stmtfailed");
        exit();
    }

    //for account number
    $code = rand(1, 99999);
    $accountNumber = "ACC_".$code."_brocode";
    //$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $accountNumber, $accountemail, $subscriptionstatus, $billingaddress, $contactnumber);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //verifiying user
    $sql = "UPDATE users SET usersStatus = ? WHERE usersEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../subscription.php?error=stmtfailed");
        exit();
    }

    $userStatus = "Subscribed";
    
    mysqli_stmt_bind_param($stmt, "ss", $userStatus, $accountemail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //header("location: ../subscription.php?error=none"); // to edit, login!
    //exit();
}

//--------- PROFILE FUNCTIONS -------------------------//
//not working, to edit
function profileimg($conn){
    $sql = "SELECT * FROM profile"; 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed/profileimgerror");
        exit();
    }

    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqlit_stmt_close($stmt);
}


//--------- DASHBOARD FUNCTIONS -------------------------//

function tableShow($conn) {
    $sql = "SELECT * FROM users";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed/tableshowerror");
        exit();
    }
    //mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqlit_stmt_close($stmt);
}

function averageUsersAge($conn) {
    $sql = "SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), usersBdate)), '%Y') + 0 AS age FROM users";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed/averageUserAgeerror"); //to edit
        exit();
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $totalAge = 0;
    $totalUsers = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $totalAge += $row['age'];
        $totalUsers++;
    }

    if ($totalUsers > 0) {
        $averageAge = $totalAge / $totalUsers;
        return round($averageAge,0);
    } else {
        return 0;
    }

    mysqli_stmt_close($stmt);
    mysqli_free_result($result);
}



//need to fix this!!!! pls lang oh parang gagi

/*
function averageAge($conn) {
    $sql = "SELECT * FROM users";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed/usernameexists");
        exit();
    }
    //mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $today = new Datetime(date('y.m.d'));
    $totalAge = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($resultData))
        {   
            $bdate = $row['usersBdate'];
            $bday = new DateTime ('$resultData');
            $interval = $today->diff($row['usersBdate']);
            $totalAge = $totalAge + $interval;
            $count = $count + 1;
        }
    $totalAveAge = $totalAge / $count;
    return $totalAveAge;
    mysqlit_stmt_close($stmt);
}

*/

//Updating user profile//
function updateUserProfile($conn, $email, $phone, $bio, $fileNameNew) {

    $result = tableShow($conn);
    while($row = mysqli_fetch_assoc($result)) {
        if($row['usersEmail'] == $email) {
            $profileId = $row['usersId'];

            $true_email = $row['usersEmail'];
            $sql = "UPDATE users SET usersEmail = ?, usersPhonenumber = ? WHERE usersEmail = ?";
            
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../pages/profile.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "sss", $email, $phone, $true_email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    $sql = "UPDATE userprofile SET profileId = ?, email = ?, phone = ?, bio = ?, profile_pic = ? WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../pages/profile.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "isssss", $profileId, $email, $phone, $bio, $fileNameNew, $true_email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}




