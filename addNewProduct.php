<?php 
require_once('storeClass.php');

$store->addProduct();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
</head>
<body>
    
<form style="margin-top: 3rem; text-align:left; margin-left:35rem;" action="" method="post">
<label for="">Product Name</label>
<input type="text" name="productName" id="productName">
<br>
<label for="" name="product_type"  >Product Type</label>
<select name="productType" id="productType">
    <option value="">---</option>
    <option value="">Food</option>
    <option value="">Clothing</option>
    <option value="">Tools</option>
</select>
<br>
<label for="">Minimum Stocks</label>
<br>
<input type="number" name="minStock" id="minStock" min="1" value="1">
<br>
<button  type="submit" name="addProduct"> Add Product</button>


</form>
    
</body>
</html>