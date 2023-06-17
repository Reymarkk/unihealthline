<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<title>uniHealthline | Forgot Password</title>
</head>
<body>
    <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request!";
        }
        else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                <div class="container">
                    <form action="../includes/reset-password.inc.php" method="POST" class="form">
                        <p class="reset-text" style="font-size: 2rem; font-weight: 800;">Create new password</p>
                        <p class="reset-password-text">Your password must be different from previous used passwords</p>
                        <div class="">
                            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                        </div>
                        <div class="">
                            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                        </div>
                        <div class="input-box">
                            <input type="password" placeholder="New Password" name="pwd" value="" required>
                        </div>
                        <div class="input-box">
                            <input type="password" placeholder="Confirm New Password" name="pwd-repeat" value="" required>
                        </div>
                        
                        <button name="reset-password-submit" class="btn">Reset Password</button>
                         
                    </form>
                </div>
                <?php
            }
        }
    ?>
</body>
</html>