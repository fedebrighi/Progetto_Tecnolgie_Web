<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Dettagli";
$templateParams["nome"] = "prodotto.php";
$templateParams["birra"] = $dbh->getBeerDetails($_POST["codice"]);
$templateParams["recensioni"] = $dbh->getReviewsByProduct($templateParams["birra"]["codProdotto"]);
$templateParams["isClientLogged"] = false;

if (isset($_SESSION["username"])) {
    $templateParams["codCarrello"] = $dbh->getCart($_SESSION["username"]);
    $templateParams["isClientLogged"] = $dbh->isClientLogged($_SESSION["username"]);
}
require 'template/base.php';
