<?php
    session_start();
    require_once '../includes/dbh.inc.php'; //to connect in the database
    require_once '../includes/functions.inc.php';
?>

<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../css/dashboard-style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
<!--
            <div class="logo-image">
                <img src="../imgs/logo.png" alt="">
            </div>
-->

            <a class="logo" href="../pages/dashboard.php">uni<span>Healthline</span></a>
            <!--
            <span class="logo_name">uniHealtline</span>
            -->
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Content</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-head-side"></i>
                    <span class="link-name">Users</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-clock"></i>
                    <span class="link-name">Activity</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-head-side"></i>
                    <span class="link-name">Members</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../includes/logout.inc.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <img src="../imgs/calexterio.jpg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-head-side"></i>
                        <span class="text">Total Users</span>
                        <?php
                            $result = tableShow($conn);
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $count = $count + 1;
                            }
                        ?>
                        
                        <span class="number"><?php echo $count; ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comparison"></i>
                        <span class="text">Average Users Age</span>
                        <?php $averageAge = averageUsersAge($conn);
                        echo "<span class='number'>" . $averageAge . "</span>";
                        ?>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-phone"></i>
                        <span class="text">Average Time Call (minutes)</span>
                        <span class="number">8</span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Name</span>
                        <?php
                            $result = tableShow($conn);
                            while($row = mysqli_fetch_assoc($result))
                            {
                        ?>
                        <span class="data-list"><?php echo $row['usersName'];?></span>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="data email">
                        <span class="data-title">Email</span>
                        <?php
                            $result = tableShow($conn);
                            while($row = mysqli_fetch_assoc($result))
                            {
                        ?>
                        <span class="data-list"><?php echo $row['usersEmail'];?></span>    
                        <?php
                            }
                        ?>
                    </div>
                    <div class="data status">
                        <span class="data-title">User Status</span>
                        <?php
                        $result = tableShow($conn);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userId = $row['usersId']; // Assuming the user ID is stored in the 'usersId' column
                            $userStatus = $row['usersStatus']; // Assuming the user status is stored in the 'usersStatus' column

                            // Print the user status
                            echo '<span class="data-list">' . $userStatus . '</span>';
                        }
                        ?>

                    </div>

                    <div class="data button">
                        <span class="data-title">Admin?</span>

                        <?php
                        ?>
                        <?php
                        // Assuming the form is submitted and the button is clicked
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                            $count = 0;
                            $result = tableShow($conn);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $count = $count + 1;
                                $checkboxId = 'checkbox' . $count;
                                $isChecked = isset($_POST['checkboxes'][$checkboxId]) && $_POST['checkboxes'][$checkboxId] === 'on';

                                $userId = $row['usersId']; // Assuming the user ID is stored in the 'usersId' column

                                // Update the user status in the database
                                $sql = "UPDATE users SET usersStatus = ? WHERE usersId = ?";
                                $stmt = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("location: ../subscription.php?error=stmtfailed");
                                    exit();
                                }

                                // Convert the checkbox state to 'Admin' or 'User'
                                $statusValue = $isChecked ? 'Admin' : 'User';

                                mysqli_stmt_bind_param($stmt, "ss", $statusValue, $userId);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                            }
                        }
                        ?>

                        <!-- Form Start -->
                        <form method="POST" class="checkbox" id="buttonform">
                            <?php
                            $count = 0;
                            $result = tableShow($conn);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $count = $count + 1;
                                $checkboxId = 'checkbox' . $count;
                                $isChecked = isset($_POST['checkboxes'][$checkboxId]) && $_POST['checkboxes'][$checkboxId] === 'on';

                                // Print the checkbox input
                                ?>
                                <span class="data-row">
                                    <label class="switch">
                                        <input type="checkbox" id="<?php echo $checkboxId; ?>" value="on" name="checkboxes[<?php echo $checkboxId; ?>]" <?php echo $isChecked ? 'checked' : ''; ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </span>
                                <?php
                            }
                            ?>
                            
                        </form>
            <div class="activity">
                <div class="title-update">
                    <button type="submit" name="submit" form="buttonform" class="save">Update User Status</button>
                </div>            

                </div>
            </div>
        </div>
    </section>

    <script src="../js/script.js"></script>
</body>
</html>