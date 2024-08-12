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
    <link rel="stylesheet" href="/css/productDetails.css">
</head>
<body>
    <?php print_r($product)?>
    <h1>Product Name: <?=$product['product_name'];?></h1>
    <h2>Product Type: <?=$product['product_type'];?></h2>
    <h3>Stocks: <?=$product['min_stocks'];?></h3>
    <h4>Total: <?=$product['total'];?></h4>
    <hr>
    
    <h2>Available Product Items</h2>
<?php foreach($stocks as $stock){?>


    <div id="parent_<?=$stock['ID']?>">
<label><?=$stock['vendor'];?>  <strong>,</strong>   <?=$stock['qty'];?></label> </p>
<input type="number" name="stock_<?=$stock['ID'];?>" min="1" max="<?=$stock['qty']?>" value="1"></input>
<input type="hidden" name="price_" value="<?=$stock['price']?>">
<button type="button" class="addToCart"> Add to cart</button>
<button type="button" class="removeToCart" id="<?=$stock['ID']?>" disabled> Remove</button>
</div>
<?php }?>


    <a href="products.php">Products</a> 
    <a href="addNewStocks.php?id=<?=$product['ID'];?>">Add new stocks</a>
<hr>
<h2>Cart</h2>
    <form action="checkout.php" method="post" id="checkout_form">
<input type="hidden" name="product_id" value="<?=$product['ID'];?>"/>
<button type="submit" id="checkout_button">Proceed to checkout</button>

    </form>
<script src="/js/index.js"></script>
</body>
</html>