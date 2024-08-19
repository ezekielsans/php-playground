<?php
require_once 'storeClass.php';

$inventory_array = array();
// Ensure store class is instantiated
$store = new MyStore();
// Validate and sanitize the input
$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;
if (!$id) {
    echo "Invalid product ID.";
    exit();
}
// Fetch user details
$userDetails = $store->getUserData();
if (!$userDetails || $userDetails['access'] !== "administrator") {
    header("Location: login.php");
    exit();
}

// Fetch product details
$product = $store->getSingleProduct($id);
if (!$product) {
    echo "Product not found.";
    exit();
}

//echo "<br>" . "products" . "<br>" . print_r($product);

// Handle add stock if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stock'])) {
    $store->addStock();
}

// Fetch all stocks
$stocks = $store->viewAllStocks($id);

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
    <br>


    <hr>
    <div class="table-container">
        <h2 id="tc-title">Available Product Items</h2>


    <table border="1">
        <thead>
            <tr>
                <th>Action</th>
                <th>Base Stock Qty</th>
                <th>SRP</th>
                <th>Sales</th>
                <th>Total Sales</th>
                <th>Qty Remaining</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>



            <?php if ($stocks): ?>
                <?php foreach ($stocks as $stock): ?>
                    <?php $sum = $stock['qty'] - $stock['sale_qty'];
$inventory_array[] = $sum;

?>
                    <tr class="<?=($sum == 0) ? 'disabledButton' : '';?>"</tr>
                    <td>
                        <div id="parent_<?=$stock['ID']?>">
                            <label><?=htmlspecialchars($stock['vendor']);?> <strong>,</strong> <?=htmlspecialchars($stock['qty']);?></label>
                            <input type="number" name="qty[]" min="1" max="<?=$sum;?>" value="1"></input>
                            <input type="hidden" name="price[]" value="<?=$stock['price'];?>">
                            <input type="hidden" name="stock_id[]" value="<?=$stock['ID'];?>">
                            <button type="button" class="addToCart">Add to cart</button>
                            <button type="button" class="removeToCart" id="<?=$stock['ID']?>" disabled>Remove</button>
                        </div>
                    </td>
                    <td><?=$stock['qty'];?></td>
                    <td><?=sprintf('%01.2f', $stock['price']);?></td>
                    <td><?=$stock['sale_qty'];?></td>
                    <td><?=sprintf('%01.2f', $stock['total_sales']);?></td>
                    <td><?=$sum;?></td>
                    <td><?=($sum == 0) ? 'Out of stock' : 'Avaiable';?></td>

                </tr>
                <?php endforeach;?>
                <?php else: ?>
                    <p>No stocks available.</p>
                    <?php endif;?>


    </tbody>
</table>


<h4>Total: <?=htmlspecialchars($product['total']);?></h4>
<h4>Actual Inventory: <?=array_sum($inventory_array);?></h4>
<h4>Status: <?php if (array_sum($inventory_array) <= $product['min_stocks']) {
    echo "Low Inventory";
} elseif (array_sum($inventory_array) == 0) {
    echo "Out of Stocks";
}else{ echo "On Sale";}?></h4>

<br>

<div class="links">
    <a href="products.php">Products</a>
    <a href="addNewStocks.php?id=<?=$product['ID'];?>">Add new stocks</a>
    </div>
    </div>
    

    <hr>
    <h2>Cart</h2>
    <form action="checkout.php" method="post" id="checkout_form">
        <input type="hidden" name="customer_name" value="<?=htmlspecialchars($userDetails['fullname']);?>"/>
        <input type="hidden" name="product_id" value="<?=htmlspecialchars($product['ID']);?>"/>
    <br>
        <div class="form-group">
        <label><name="checkout_price" id ="checkout_price"  strong>Checkout price: </name=></label>
    </div>
        <button type="submit" id="checkout_button">Proceed to checkout</button>
    </form>

    <script src="/js/index.js"></script>
</body>
</html>
