<?php

require_once '../controller/storeClass.php';

$users = $store->getUsers();
$userDetails = $store->getUserData();

//print_r($userDetails);
if(!$userDetails ){
    header("Location: login.php");
    exit; // Always call exit after head
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eugene's Store</title>
    <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
    <header>
    <div class="nav-container">
        <a  href='products.php'>See products<a/>
    <a href='addNewUser.php'>Add New User<a/>
    <a href='addNewProduct.php'>Add New Product<a/>
    <a  href='logout.php'>Logout<a/>
    </header>
</div>
<div class="content-container">
        <h1 style="text-align: center; font: size 2rem;">Welcome to my Store <?= $userDetails['fullname']?></h1>
        <h1>What's new?</h1>
    </div>
    <?php
      include "../../components/footer.component.php";
      echo callFooter();
    
    ?>
</body>
</html>
