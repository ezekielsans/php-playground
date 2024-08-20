<?php
require_once '../controller/storeClass.php';

$users = $store->getUsers();
$userDetails = $store->getUserData();

print_r($userDetails);

if (!$userDetails || $userDetails['access'] != "administrator") {

    header("Location: loginError.php");
    exit; // Always call exit after header redirection

}
$store->addProduct();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
    <link rel="stylesheet" href="/css/addNewProduct.css">
</head>
<body>

<div class="form-wrapper">
    <h1>Add New Product</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" name="productName" id="productName" required>
        </div>
        <div class="form-group">
            <label for="productType">Product Type</label>
            <select name="productType" id="productType" required>
                <option value="">---</option>
                <option value="Food">Food</option>
                <option value="Clothing">Clothing</option>
                <option value="Tools">Tools</option>
            </select>
        </div>
        <div class="form-group">
            <label for="minStock">Minimum Stocks</label>
            <input type="number" name="minStock" id="minStock" min="1" value="1" required>
            <input type="hidden" name="addedBy" id="addedBy" value="<?=$userDetails['fullname']?>">
        </div>
        <div class="form-group">
            <button type="submit" name="addProduct">Add Product</button>
        </div>  
        <div class="form-group">
            <a href="./adminIndex.php" name="return" >Return</a> 
        </div> 
       
    </form>
</div>

</body>
</html>

