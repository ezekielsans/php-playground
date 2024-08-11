<?php
require_once('storeClass.php');


$id = $_GET['id'];

//fetch
$product = $store -> getSingleProduct($id);

$stocks = $store->viewAllStocks($id);

//$total_qty = $store->getTotalQty($id);
print_r($product);
print_r($product['ID']);
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
    <h1>Product Name: <?=$product['product_name'];?></h1>
    <h2>Product Type: <?=$product['product_type'];?></h2>
    <h3>Stocks: <?=$product['min_stocks'];?></h3>
    <h4>Total: <?=$product['total'];?></h4>
<hr>

<?php foreach($stocks as $stock){?>

<p><?=$stock['vendor'];?>  <strong>,</strong>   <?=$stock['qty'];?></p> </p>



<?php }?>


    <a href="products.php">Products</a> 
    <a href="addNewStocks.php?id=<?=$product['ID'];?>">Add new stocks</a>
    
</body>
</html>