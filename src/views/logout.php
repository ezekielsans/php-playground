<?php
require_once '../controller/storeClass.php';
$store->logout();
header("Location: login.php");
?>