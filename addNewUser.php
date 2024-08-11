<?php
require_once 'storeClass.php';

// Initialize the storeClass

$userDetails = $store->getUserData();
print_r($userDetails);

if (!$userDetails || $userDetails['access'] != "administrator") {
    header("Location: login.php");
    exit; // Always call exit after header redirection
}
$store->addUser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="/css/addNewUser.css">
</head>
<body>
    <nav class="navbar">
    <h1 id="title">Add New Customer/User</h1>
    <a href="index.php">return</a>
    </nav>
    <div class="container">

        <div class="form-container">

            <form action="" method="post">
                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"/>
                </div>
                <div class="form-input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"/>
                </div>
                <div class="form-input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName"/>
                </div>
                <div class="form-input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName"/>
                </div>
                <div class="form-input">
                    <label for="mobileNo">Mobile No.</label>
                    <input type="text" name="mobileNo" id="mobileNo"/>
                </div>
                <button type="submit" name="add">Add User</button>
            </form>
        </div>
    </div>
</body>
</html>
