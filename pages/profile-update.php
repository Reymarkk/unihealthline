<?php
    include_once '../pages/header.php';
    require_once '../includes/dbh.inc.php'; // to connect to the database
    require_once '../includes/functions.inc.php';
?>

<body>
    <div class="wrapper">
    <div class="left">
    <?php
    $userId = $_SESSION['userid'];
    $sql = "SELECT profile_pic FROM userprofile WHERE profileId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $profilePic = $row['profile_pic'];
            if ($profilePic) {
                echo "<img src='../uploads/" . $profilePic . "' alt='user' width='200'>";
                echo "<a href='../includes/delete-profile-picture.php'>Delete Profile Picture</a>";
            } else {
                echo "<img src='../imgs/default.jpg' alt='user' width='200'>";
            }
        }
        mysqli_stmt_close($stmt);
    }
    ?>

            <?php
            if (isset($_SESSION["userid"])) {
                echo "You are logged in as " . $_SESSION["useruid"];
                echo "<h4>" . $_SESSION["useruid"] . "</h4>";
                echo "<p>Back Pain Developer</p>";
            } else {
                echo "You are not logged in";
            }
            ?>

            <!--
            <h4>Reymark Calexterio</h4>
            <p>Back Pain Developer</p>
            -->
        </div>
        <div class="right">
            <div class="info">
                <h3>Information</h3>
                <div class="info_data">
                    <div class="data">
                        <h4>Email</h4>
                        <form action="../includes/upload.inc.php" method="POST" class="form" enctype="multipart/form-data">
                            <div class="input-box">
                                <input type="text" placeholder="Enter email address" name="email" />
                            </div>
                    </div>
                    <div class="data">
                        <h4>Phone</h4>
                        <div class="input-box">
                            <input type="text" placeholder="Enter phone number" name="phone" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="projects">
                <h3>About</h3>
                <div class="projects_data">
                    <div class="data">
                        <h4>Bio</h4>
                        <div class="input-box">
                            <input type="text" placeholder="Enter short description of yourself" name="bio" required/>
                        </div>
                    </div>
                    <div class="data">
                        <h4>Update Profile</h4>
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>

            <button type="submit" name="submit">Save</button>
            </form>
        </div>
    </div>

<?php
    include_once '../pages/footer.php';
?>
