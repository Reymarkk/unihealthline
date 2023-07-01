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
        <header>Login</header>
		<form action="../includes/login.inc.php" method="POST" class="form">
            <div class="input-box">
                    <label>Username</label>
                    <input type="text" placeholder="Enter username/email" name="uid" value="" />
            </div>
            <div class="input-box">
                    <label>Password</label>
                    <input type="password" placeholder="Enter password" name="password" value="" />
            </div>
            <button name="submit">Login</button>
			<p class="login-register-text"><a href="reset-password.php">Forgot your password?</a></p>
            <p class="login-register-text">Don't have an account? <a href="signup.php">Register Here</a>.</p>
        </form>
    </section>

    
</body>
</html>