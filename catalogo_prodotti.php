<?php
    require_once 'bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "PHPint - Catalogo Prootti";
    $templateParams["nome"] = "catalogo.php";
    $templateParams["birre"] = $dbh->getAllBeers();
    $templateParams["codCarrello"] = $dbh->getCart($_SESSION["username"]);
    require 'template/base.php';
?>
