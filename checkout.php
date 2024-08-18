<?php
include_once('storeClass.php');
$total = count($_POST['stock_id']);
print_r($_POST);
print_r($total);
sizeof(array($total));

for($i = 0; $i < $total; $i++) {  

    
  $store->insertSales($_POST['stock_id'][$i],$_POST['qty'][$i],$_POST['price'][$i],$_POST['product_id'],$_POST['customer_name']);

    
}


?>