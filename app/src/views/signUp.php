<?php
require_once '../controller/storeClass.php';
$store->registerUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link rel="stylesheet" href="../../css/signUp.css">
</head>
<body>
<header>
        <div class="logo">
            <img src="../../assets/e-commerce-logo.png" alt="Foodnautica E-Store">
            <a href="login.php"><h1>Foodnautica E-Store</h1></a>
        </div>
        <div class="help-link">
            <a href="#">Need help?</a>
        </div>
    </header>
    <div class="container">
        <div class="left">

        <h2>Your go-to online store for tools, foods, and clothing</h2>
        </div>

        <div class="right">
            <div class="login-box">
                <h2>Sign-up</h2>
                <form action="" method="post">
                    <div class="form-group">
                    <input type="text" name="lastName" placeholder="Enter Last Name" required>
                    <input type="text" name="firstName" placeholder="Enter First Name" required>
                    </div>
                    <input type="text" name="email" placeholder="Enter Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="text" name="mobileNo" placeholder="Enter Mobile no." required>
                    <input type="text" name="address" placeholder="Enter Address" required>
                    <button type="submit" name="submit"</button>Sign-up</button>
                    
                    <div class="or-separator">OR</div>
                    <div class="social-login">
                        <button class="facebook">Sign-up with Facebook</button>
                        <button class="google">Sign-up with Google</button>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer">
        <h4>
    Developed by Ezekiel Santos © <?php echo date('Y'); ?>
    </h4>
    </div>
    </footer>
</body>
</html>
