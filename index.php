<?php
    include_once 'pages/header.php';
?>
<!-- CALL BUTTON TO AH POTANGINAMO REYMARK -->
    <!-- this call header file; makes the code shorter -->
    <a id="callbutton"></a>
    <section class="hero">
        <div class="streamers">
            <div class="streamer">
                <div class="icon"><img src="" alt="">
                </div>
                <p class="name"></p>
                <p class="number"></p>
            </div>
        </div>
    </section>
    
    <section class="hero">
        
        <div class="container">
            <div class="left-col">
            <p class="subhead" data-aos="fade-up" data-aos-delay="800">"The Bro Code of Coding"</p>
                <h1 data-aos="zoom-out" data-aos-delay="2000">An E-Learning Platform Service for Programming, Software/Web Development & more!</h1>
                <div class="hero-cta" >
                <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<p class='subhead' data-aos='fade-up' data-aos-delay='0'>Uy! Welcome ". $_SESSION["useruid"] . "</p>";
                    }
                    else {
                        echo "<a href='signup.php' class='primary-cta' data-aos='fade-up' data-aos-delay='3000'>Sign up now</a>";
                        echo "<a href='login.php' class='guest-login-cta' data-aos='zoom-out' data-aos-delay='3000'><img src='images/#' alt=''>Login</a>";
                    }
                ?>
                </div>
            </div>
            <!--
            <img src="" class="hero-img" alt="Illustration">-->
        </div>
    </section>
<!--   
    <img src="images/man-mobile-legit.png" class="man" alt="Illustration">
    </section>

    <a id="features"></a>
    <section class="features-section">
      <div class="container">
          <h1> Features </h1>
          <ul class="features-list">
              <li data-aos="fade-up-right" data-aos-delay=""> Start for Free with the 30-Day Free trial</li>
              <li data-aos="fade-up-right">At your service 24/7</li>
              <li data-aos="fade-up-right">Multiple Course Selections</li>
              <li data-aos="fade-up-right">Verified Certifications</li>
              <li data-aos="fade-up-right">Connect with a vast Community</li>
          </ul>

          <img src="images/mema2.svg" alt="Toilet paper">

      </div>

  </section>
  <a id="testimonials"></a>
  <section class="testimonials-section">
    <div class="container">
        <ul>
            <li>
                <img src="images/person.svg" alt="person">

                <blockquote>"broCode has helped me expand my programming skills and boosted my confidence in the industry. It has truly helped me during my university years. Now I am a Senior Developer at TeleHorizon Co."</blockquote>
                <cite>- Reymark Calexterio</cite>
            </li>
            <li>
                <img src="groupphoto/Rubi_MaryRose.png" alt="person">

                <blockquote>"Thanks to broCode I was able to land my job at MBI Industries, the courses provided are easy to understand and follow, I was able to master COBOL and C# in just 1 month. I was accepted immediately!."</blockquote>
                <cite>- Mary Rose Rubi</cite>
            </li>
            <li>
                <img src="groupphoto/Lauden_Timothy.jpg" alt="person">

                <blockquote>"I probably have failed my College Degree if it wasn't for broCode. Now I am a Game Developer and CEO of FLOW Games and we have just released our 3rd Installment of the Award Winning Series, "Need for Gas: High Prices".</blockquote>
                <cite>- Timothy Lauden</cite>
            </li>
        </ul>
    </div>
  </section>
 -->
  <a id="contact"></a>
  <section class="contact-section">
    <div class="container">
        <div class="contact-left">
            <h2>Contact Us</h2>

            <form action="../includes/contact-us.inc.php" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name">

                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Your Email">

                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>
                
                <button name="contact-us-submit" type="submit" value="">Submit</button>
            </form>
        </div>
        <div class="contact-right">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6490.42351550573!2d121.08292692557703!3d14.69964283048103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ba751aa45673%3A0xc97dd4e6435de50c!2sPUP%20Commonwealth%20Campus!5e0!3m2!1sen!2sph!4v1662042226948!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
  </section>
  <br>
  <br>
<?php
    include_once 'pages/footer.php';
?>            
