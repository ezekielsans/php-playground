<?php

require_once "storeClass.php";

$users = $store->getUsers();
$userDetails = $store->getUserData();

print_r($userDetails);
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
</head>
<body>
    <h1 style="text-align: center; font: size 2rem;">Welcome to my Store</h1>
    <a style='text-align:center;margin:3rem 35rem' href='products.php'>See products<a/>
    <a style='text-align:center;margin:3rem 35rem' href='logout.php'>logout<a/>
    <a style='text-align:center;margin:3rem 35rem' href='addNewUser.php'>Add New User<a/>
    <a style='text-align:center;margin:3rem 35rem' href='addNewProduct.php'>Add New Product<a/>

</body>
</html>
