<?php 

require_once('storeClass.php');
$products = $store->getProducts();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>

<ul>

<?php 

foreach ($products as $product){?>

    <li><a href="productDetails.php?id=<?=$product['ID'];?>"><?= $product['product_name'];?> | <?=$product['min_stocks'];?> </a></li>

<?php } ?>




</ul>
    
</body>
</html>