<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Carrello";

if (isUserLoggedIn()) {
    $templateParams["username"] = $_SESSION["username"];
}else {
    header("Location: login.php");
}

$templateParams["elementicarrello"] = $dbh->getCartFromUser($templateParams["username"]);

require 'template/cart.php';
?>
