<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Checkout";
$templateParams["nome"] = "payment.php";
if(isset($_SESSION["username"])){
    $templateParams["carrello"] = $dbh->getCart($_SESSION["username"]);
}
require 'template/base.php';
?>
