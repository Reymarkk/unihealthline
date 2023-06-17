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
        <header>Registration Form</header>
        <form action="../includes/signup.inc.php" method="POST" class="form">
            <div class="input-box">
                <label>Full Name</label>
                <input type="text" placeholder="Enter Full Name" name="name" required/>
            </div>

            <div class="input-box">
                <label>Email Address</label>
                <input type="text" placeholder="Enter email address" name="email" required/>
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Phone</label>
                    <input type="tel" placeholder="Enter phone number" name="phonenum" required/>
                </div>

                <div class="input-box">
                    <label>Birthdate</label>
                    <input type="date" placeholder="Enter birth date" name="bdate" required/>
                </div>
            </div>
            
            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" value="Male" />
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="Female" />
                        <label for="check-male">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-other" name="gender" value="Prefer not to say"/>
                        <label for="check-male">Prefer not to say</label>
                    </div>
                </div>
            </div>

            <br>
            <h3>Account Details</h3>
            <div class="input-box">
                    <label>Username</label>
                    <input type="text" placeholder="Enter username" name="uid"required/>
            </div>
            <div class="input-box">
                    <label>Password</label>
                    <input type="password" placeholder="Enter password" name="password" required/>
            </div>
            <div class="input-box">
                    <label>Confirm password</label>
                    <input type="password" placeholder="Confirm password" name="cpassword" required/>
            </div>

            <button name="submit">Register</button>
            <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
        </form>
    </section>
    
</body>
</html>