<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../includes/dbh.inc.php'; // Include the database connection file

$userId = $_SESSION['userid'];

// Retrieve the profile picture filename from the database
$sql = "SELECT profile_pic FROM userprofile WHERE profileId = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $profilePic = $row['profile_pic'];

        // Delete the profile picture file from the server
        $filePath = "../uploads/" . $profilePic;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Update the database to remove the profile picture
        $sql = "UPDATE userprofile SET profile_pic = NULL WHERE profileId = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
        }
    }
    mysqli_stmt_close($stmt);
}

header("Location: ../pages/profile-update.php");
exit();

