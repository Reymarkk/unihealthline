<?php
    if(isset($_POST["submit"])) {
        // Retrieve form data
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $bio = $_POST["bio"];
        $file = $_FILES["file"];

        // Handle file upload
        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];
        $fileType = $_FILES["file"]["type"];

        // File validation
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        // Database connection and functions
        require_once 'dbh.inc.php'; // Include the database connection file
        require_once 'functions.inc.php'; // Include any necessary functions

        // Validate and process file upload
        if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    updateUserProfile($conn, $email, $phone, $bio, $fileNameNew); // Function to update user profile

                    // Redirect to profile page
                    header("Location: ../pages/profile.php?success=Profile Updated");
                    exit();
                } else {
                    echo "File size is too large.";
                }
            } else {
                echo "There was an error uploading your file! Error Code: " . $fileError;
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and PDF files are allowed.";
        }
    } else {
        echo "Form submission not detected.";
        header("Location: ../pages/login.php");
        exit();
    }
?>
