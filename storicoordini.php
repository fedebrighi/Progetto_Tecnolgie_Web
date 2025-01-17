<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Storico Ordini";
$templateParams["nome"] = "orderhistory.php";
$templateParams["ordini"] = $dbh->getAllOrders();

require 'template/base.php';
