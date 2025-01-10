<?php
    require_once 'bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "PHPint - Catalogo Prootti";
    $templateParams["nome"] = "catalogo.php";
    $templateParams["birre"] = $dbh->getAllBeers();

    require 'template/base.php';
?>
