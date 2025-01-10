<?php
    require_once 'bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "PHPint - Dettagli";
    $templateParams["nome"] = "prodotto.php";
    $templateParams["birra"] = $dbh->getBeerDetails($_GET["id"]);
    $templateParams["ingredienti"] = $dbh->getIngredients($_GET["id"]);

    require 'template/base.php';
?>
