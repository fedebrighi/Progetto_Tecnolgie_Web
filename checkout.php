<?php
require_once 'bootstrap.php';
// Verifica se il carrello è vuoto
$carrello = isset($_SESSION['carrello']) ? $_SESSION['carrello'] : [];

//Base Template
$templateParams["titolo"] = "PHPint - Checkout";
$templateParams["nome"] = "payment.php";


require 'template/base.php';
?>