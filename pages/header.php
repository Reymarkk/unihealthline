<?php
    session_start();
    
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>UniHealthline | I'm only one call away</title>
    <!--
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
    crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!--<link rel="shortcut icon" href="courses/images/BC.jpg"/>-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    
    <!--<script type="text/javascript" src="animation.js"></script>-->
    <!--<link rel="stylesheet" type="text/css" href="brocode_product.css">
    
-->
  </head>
  
  <body>
    <div class="navbar">
        <div class="container">
            <!--
            <a class="logo" href="index.php" data-aos="zoom-out" data-aos-delay="500">bro<span>Code</span></a>
            -->
            <a class="logo" href="../index.php">uni<span>Healthline</span></a>
            
            <img id="mobile-cta" class="mobile-menu" src="images/icons8-menu.svg" alt="open navigation" data-aos="zoom-out" data-aos-delay="2000">

            <nav class="">
                <img id="mobile-exit" class="mobile-menu-exit" src="images/exit.svg" alt="close navigation">
                <ul class="primary-nav">
                    <li><a href="../index.php">Home</a></li> <!--shift down arrow keys to duplicate-->
                    <li><a href="../pages/ranting.php">Ranting Page</a></li>
                    <li><a href="../pages/learnmore.php">Learn More</a></li> 
                </ul>

                <ul class="secondary-nav">
                    <li><a href="../pages/aboutus.php">About Us</a></li> <!--shift down arrow keys to duplicate-->
                    <li class='go-login-cta'><a href='../pages/support-us.php'>Support Us</a></li>
                    <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<li><a href='../pages/profile.php'>Profile</a></li>";
                        echo "<li><a href='../includes/logout.inc.php'>Logout</a></li>";
                    }
                    else {
                        echo "<li><a href='../pages/login.php'>Login</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>