<?php
require_once 'storeClass.php';

//session_start();

$userDetails = $store->getUserData();
print_r($userDetails);

if (!$userDetails || $userDetails['access'] == "administrator") {
        header("Location:login.php");
       exit();
    }
    $id = $_GET['id'];
    $product = $store->getSingleProduct($id);
    $store->addStock();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Stocks</title>
    <link rel="stylesheet" href="/css/addNewStocks.css">
</head>
<body>
    <nav class="navbar">
    <h1>Add New Stocks</h1>
    <a href="index.php">Return</a>
    </nav>
    <form action="" method="post">
        <div class="form-container">
        <label for="">Brand Name</label>
        <input type="text" name="brand_name" id="brand_name" require>
        </div>
        <div class="form-container">
        <label for="">Qty</label>
        <input type="number" name="qty" id="qty" min="1" value="1">
        </div> 
        <div class="form-container">
        <label for="">Price</label>
        <input type="text" name="price" id="price">
        </div>
        <div class="form-container">
        <label for="">Batch Number</label>
        <input type="text" name="batch_number" id="batch_number" >
        <input type="hidden" name="product_id"  value="<?=$product['ID'];?>">
        <input type="hidden" name="added_by" value="<?=$userDetails['fullname']?>">
        </div>
        <button type="submit" name="add_stock">Add New Stocks</button>

    </form>
</body>
</html>