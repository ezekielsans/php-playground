<?php
require_once 'storeClass.php';

$id = $_GET['id'];
$product = $store->getSingleProduct($id);
$userDetails = $store->getUserData();
$store->addStock();

if (isset($userDetails)) {

    if ($userDetails['access'] != "administrator") {
        header("Location:login.php");
    } 

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Stocks</title>
</head>
<body>
    <h1>Add New Stocks</h1>
    <form action="" method="post">
        <label for="">Brand Name</label>
        <input type="text" name="brand_name" id="brand_name" require>
        <label for="">Qty</label>
        <input type="number" name="qty" id="qty" min="1" value="1">
        <label for="">Batch Number</label>
        <input type="text" name="batch_number" id="batch_number" >
        <input type="hidden" name="product_id"  value="<?=$product['ID'];?>">
        <input type="hidden" name="added_by" value="<?=$userDetails['fullname']?>">


        <button type="submit" name="add_stock">Add New Stocks</button>
    </form>
</body>
</html>