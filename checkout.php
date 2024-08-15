<?php
include_once('storeClass.php');
$total = count($_POST['stock_id']);
print_r($_POST);


for($i = 0; $i < $total; $i++) {  

    
   $store->insertSales($_POST['product_id'][$i], $_POST['stock_id'][$i], $_POST['qty'][$i], $_POST['price'][$i], $_POST['customer_name'][$i]);
    
}



?>