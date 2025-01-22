<?php
require_once 'bootstrap.php';

// Base Template
$templateParams["titolo"] = "PHPint - Carrello";
$templateParams["nome"] = "cart.php";

// Controlla se l'utente è loggato
if (isUserLoggedIn()) {
    $templateParams["username"] = $_SESSION["username"];
} else {
    header("Location: login.php");
    exit();
}

// Recupera i prodotti nel carrello
$templateParams["elementicarrello"] = $dbh->getCartFromUser($templateParams["username"]);
$templateParams["codCarrello"] = $dbh->getCart($templateParams["username"]);

// Se il carrello è vuoto
if (empty($templateParams["elementicarrello"])) {
    $templateParams["carrelloVuoto"] = true;
} else {
    $templateParams["carrelloVuoto"] = false;
}



// Mostra il template del carrello
require 'template/base.php';
