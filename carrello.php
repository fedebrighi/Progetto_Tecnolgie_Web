<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Carrello";

if (isUserLoggedIn()) {
    $templateParams["utente"] = $_SESSION["idutente"];
}else {
    header("Location: login.php");
}
/*
$templateParams["utente"] = "giovanni_rossi";
$templateParams["elementicarrello"] = $dbh->getCartFromUser($templateParams["utente"]);
*/
require 'template/carrel.php';
?>
