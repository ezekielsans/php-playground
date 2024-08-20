<?php 

require_once '../controller/storeClass.php';

//$id = $_GET['id'];
$products = $store->getProducts();

print_r($products);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="/css/products.css">
</head>
<body>
    <nav class="navbar">
  <h1 id="title"</h1>Products Section</h1>
    <a href="./adminIndex.php">Return</a>

    </nav>
<div class="container">
<ul>

<?php foreach ($products as $product){?>

    <li><a href="productDetails.php?id=<?=$product['ID'];?>"><?= $product['product_name'];?>  |  <?=$product['min_stocks'];?> </a></li>

<?php } ?>




</ul>
</div>
<footer class="footer">
    Created <?php echo date("\nY");?>
</footer>
</body>
</html>