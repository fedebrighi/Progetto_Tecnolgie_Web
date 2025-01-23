<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Dettagli";
$templateParams["nome"] = "prodotto.php";
$templateParams["birra"] = $dbh->getBeerDetails($_POST["codice"]);
$templateParams["recensioni"] = $dbh->getReviewsByProduct($templateParams["birra"]["codProdotto"]);

if (isset($_SESSION["username"])) {
    $templateParams["codCarrello"] = $dbh->getCart($_SESSION["username"]);
}
require 'template/base.php';
