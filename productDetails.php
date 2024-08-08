<?php
require_once('storeClass.php');


$id = $_GET['id'];

//fetch
$product = $store -> getSingleProduct($id);
//check  if array 
// if (is_array($product)){
//     echo "<h2>yes</h2>";
   
// }
// else{ echo "<h2>no</h2>"; 
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
    <?php print_r($product)?>
    <h1><?=$product['product_name'];?></h1>
    <h2><?=$product['product_type'];?></h2>
    <h3><?=$product['min_stocks'];?></h3>



    <a href="products.php">Products</a> 
    <a href="addNewStocks?id=<?=$product['ID']?>.php">Add new stocks</a>
    
</body>
</html>