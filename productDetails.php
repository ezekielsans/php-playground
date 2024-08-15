<?php
require_once 'storeClass.php';

// Ensure store class is instantiated
$store = new MyStore();

// Validate and sanitize the input
$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

if (!$id) {
    echo "Invalid product ID.";
    exit();
}

// Fetch product details
$product = $store->getSingleProduct($id);
if (!$product) {
    echo "Product not found.";
    exit();
}


echo "<br>"."products"."<br>".print_r($product);
// Fetch user details
$userDetails = $store->getUserData();
if (!$userDetails || $userDetails['access'] !== "administrator") {
    header("Location: login.php");
    exit();
}

// Handle add stock if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stock'])) {
    $store->addStock();
}

// Fetch all stocks
$stocks = $store->viewAllStocks($id);

echo "<br>"."Stocks"."<br>".print_r($stocks);

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

    <h1>Product Name: <?=htmlspecialchars($product['product_name']);?></h1>
    <h2>Product Type: <?=htmlspecialchars($product['product_type']);?></h2>
    <h3>Stocks: <?=htmlspecialchars($product['min_stocks']);?></h3>
    <h4>Total: <?=htmlspecialchars($product['total']);?></h4>
    <hr>

    <h2>Available Product Items</h2>
    <?php if ($stocks): ?>
        <?php foreach ($stocks as $stock): ?>
            <div id="parent_<?=$stock['ID']?>">
                <label><?=htmlspecialchars($stock['vendor']);?> <strong>,</strong> <?=htmlspecialchars($stock['qty']);?></label>
                <input type="number" name="qty[]" min="1" max="<?=$stock['qty'];?>" value="1"></input>
                <input type="hidden" name="price[]" value="<?=$stock['price'];?>">
                <input type="hidden" name="stock_id[]" value="<?=$stock['ID'];?>">
                <button type="button" class="addToCart">Add to cart</button>
                <button type="button" class="removeToCart" id="<?=$stock['ID']?>" disabled>Remove</button>
            </div>
        <?php endforeach;?>
    <?php else: ?>
        <p>No stocks available.</p>
    <?php endif;?>

    <a href="products.php">Products</a>
    <a href="addNewStocks.php?id=<?=$product['ID'];?>">Add new stocks</a>
    <hr>

    <h2>Cart</h2>
    <form action="checkout.php" method="post" id="checkout_form">
        <input type="hidden" name="customer_name" value="<?=htmlspecialchars($userDetails['fullname']);?>"/>
        <input type="hidden" name="product_id" value="<?=htmlspecialchars($product['ID']);?>"/>

    <?php echo "<h1> {$product['ID']} </h1>"."<br>" .print_r($product['ID'])."<br>";?>
        <button type="submit" id="checkout_button">Proceed to checkout</button>
    </form>

    <script src="/js/index.js"></script>
</body>
</html>
