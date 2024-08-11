<?php
require_once('storeClass.php');
$store->login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">

    <h1>Login Page</h1>

<div class="form-container">

<form action="" method="post" >
<div class="form-input">
<label for="">Username</label>
<input type="text" name="email" id="email"/>
</div>
<div class="form-input">
<label for="">Password</label>
<input type="password" name="password" id="password"/>
</div>
<button type="submit" name="submit">Login</button>
</form>
</div>


    </div>
</body>
</html>
