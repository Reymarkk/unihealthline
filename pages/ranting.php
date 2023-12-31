<?php
    include_once '../pages/header.php';
    require_once '../includes/dbh.inc.php'; //to connect in the database
    require_once '../includes/functions.inc.php';
?> 

<style>

    body {
        /*margin-left: 100px;
        margin-right: 100px;*/
    }
    p.courses { 
    	border-radius: 20px;
    	padding: 15px;
    	background-color: #064c6b;
        margin-left: 75px;
        margin-right: 5px;
        text-align: justify; }
    img {
        border-radius: 25px;
        background-color: #064c6b;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%; }        
    a {
    	font: #ff8b3d;
        text-align: justify;
		text-decoration: none;
	 }
    button {
    	margin-left: 25px;
		margin-right: 50px;
    	background-color: white;
    	border-radius: 40px;
    	color: white;
    	border-color: #064c6b;
    	padding: 15px;
    	text-align: center;
    	font-size: 30px;}
    li.ranting {
        margin-left: 100px;
        margin-right: 100px;
    }
    section.ranttitle {
        text-align: center;
    }
		
	
</style>

<body> 
    <link rel="stylesheet" href="css/main.css"> 
<section class="ranttitle">
    <div class="navbar">
            <div class="container">  
    </div>
    </head>
    <h3><a href="../index.php" class="logo">Speak it out with Uni<span>Healthline</span>!</a></h3>

    <table>
        <tr>
            <td rowspan="1" colspan="2">
            <ul>
                <li class="ranting"><font color="#FFFFFF">We at Unihealthline Group are willing to hear and accept your rants and thoughts about life. This System will aid you in sharing and expressing what you feel freely. Aiming to provide an open and freedom wall for every user. The informations that you inputs will remain confidential.</font></li>        
            </ul>
        </tr>
        </ul>         	
    </table>
</section>


<section class="contact-section">
    <div class="container">
        <div class="contact-left">
            <h2>Leave a Rant Message</h2>
            <?php
                if (isset($_SESSION["useruid"])) {
                    echo "<p class='subhead' data-aos='fade-up' data-aos-delay='0'>Uy! Welcome ". $_SESSION["useruid"] . "</p>";
                }
                else {
                    echo "<a href='signup.php' class='primary-cta' data-aos='fade-up' data-aos-delay='3000'>Sign up now</a>";
                    echo "<a href='login.php' class='guest-login-cta' data-aos='zoom-out' data-aos-delay='3000'><img src='images/#' alt=''>Login</a>";
                }
            ?>
            <form action="../includes/ranting.inc.php" method="POST">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>

                

                <label for="name">Name</label>
                <input type="name" id="name" name="name" placeholder="Your Name">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email">

                <button name="submit" type="submit" value="">Save Rant</button>
            </form>
        </div>
        <div class="contact-right">


        <?php
            $count = 0;
            $result = showRandomRant($conn);
            while (($row = mysqli_fetch_assoc($result)) && ($count < 3))
            {
                $count++;
        ?>
            <div class="comment-box">
                <div class="box-top">
                    <div class="Profile">
                        <div class="profile-image">
                            <img src="image/2.png">
                        </div>
                        <div class="Name">
                            <strong><?php echo $row['nameRant'];?></strong>
                            <span><?php echo $row['emailRant'];?></span>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p>
                    <?php echo $row['messageRant'];?>
                    </p>
                </div>
            </div>
        <?php
            }
        ?>
            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6490.42351550573!2d121.08292692557703!3d14.69964283048103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ba751aa45673%3A0xc97dd4e6435de50c!2sPUP%20Commonwealth%20Campus!5e0!3m2!1sen!2sph!4v1662042226948!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            -->
        </div>
    </div>
</section>
<br>
<br>
<?php
    include_once '../pages/footer.php';
?>    