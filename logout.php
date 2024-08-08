<?php
require_once('storeClass.php');
$store->logout();
header("Location: login.php");