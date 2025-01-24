<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Carrello";
$templateParams["nome"] = "cart.php";

if (isUserLoggedIn()) {
    $templateParams["username"] = $_SESSION["username"];
} else {
    header("Location: login.php");
    exit();
}

$templateParams["elementicarrello"] = $dbh->getCartFromUser($templateParams["username"]);
$templateParams["codCarrello"] = $dbh->getCart($templateParams["username"]);

if (empty($templateParams["elementicarrello"])) {
    $templateParams["carrelloVuoto"] = true;
} else {
    $templateParams["carrelloVuoto"] = false;
}

require 'template/base.php';
