<?php
    include_once '../pages/header.php';
    include_once '../includes/dbh.inc.php';
    include_once '../includes/functions.inc.php';
?>    

<body>

<div class="wrapper">
    <div class="left">
        <?php
        $userId = $_SESSION['userid'];
        $sql = "SELECT * FROM userprofile WHERE profileId = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $profilePic = $row['profile_pic'];
                echo "<img src='../uploads/" . $profilePic . "' alt='user' width='200'>";
            } else {
                echo "<img src='../uploads/profiledefault.jpg' alt='user' width='200'>";
            }
            mysqli_stmt_close($stmt);
        }
        ?>
        <h4>Reymarkssss Calexterio</h4>
        <p>Back-end Developer</p>
    </div>
    <div class="right">
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Email</h4>
                    <p>reymarkcalexterio@gmail.com</p>
                 </div>
                 <div class="data">
                   <h4>Phone</h4>
                    <p>0001-213-998761</p>
              </div>
            </div>
        </div>
      
      <div class="projects">
            <h3>About</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Bio</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                 </div>
                 <div class="data">
                   <h4>User Status</h4>
                    <p>dolor sit amet.</p>
              </div>
            </div>
        </div>
      
        <div class="social_media">
            <ul>
              <li><a href="../pages/profile-update.php"><i class="uil uil-edit"></i></a></li>
              <li><a href="../pages/profile-delete.php"><i class="uil uil-trash"></i></a></li>
              <?php

              if ($_SESSION["userstatus"] == "Admin") {
                echo '<li><a href="../pages/dashboard.php"><i class="il uil-tachometer-fast-alt"></i></a></li>';
              }
              //for debug
              //echo "<p class=>Uy! Welcome ". $_SESSION["userstatus"] . "</p>";
              ?>
              
          </ul>
      </div>
    </div>
</div>

<?php
    include_once '../pages/footer.php';
?>   

</html>