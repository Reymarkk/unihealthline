<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="container">
        <header>Reset Password</header>
		<p class="reset-password-text">Enter the email associated with your account and we'll send an email with instructions to reset your password.</p>
		<form action="../includes/reset-request.inc.php" method="POST" class="form">
            <div class="input-box">
                    <?php
		            if (isset($_GET["reset"])) {
			        if ($_GET["reset"] == "success") {
				        echo '<center><p class="class="reset-password-text">Check your email!</p></center>';
			        }
		            }
		            ?>
                    <label>Email Address</label>
                    <input type="text" placeholder="Enter your email address" name="email" value="" required/>
            </div>
            <button name="reset-request-submit">Send Instructions</button>
        </form>
        
    </section>
    
</body>
</html>