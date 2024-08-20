<?php
require_once '../controller/storeClass.php';
$store->login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
<header>
        <div class="logo">
            <img src="/assets/e-commerce-logo.png" alt="Foodnautica E-Store">
            <h1>Foodnautica E-Store</h1>
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
                <h2>Log In</h2>
                <form action="" method="post">
                    <input type="text" name="email" placeholder="Username / Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="submit"</button>Log In</button>
                    <div class="form-links">
                        <a href="#">Forgot Password</a>
                        <a href="#">Log In with Phone Number</a>
                    </div>
                    <div class="or-separator">OR</div>
                    <div class="social-login">
                        <button class="facebook">Login with Facebook</button>
                        <button class="google">Login with Google</button>
                    </div>
                    <p>New to Foodnautica? <a href='../views/signUp.php'>Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>
    <?php 
        include "../../components/footer.component.php";
        echo callFooter();?>
</body>
</html>
