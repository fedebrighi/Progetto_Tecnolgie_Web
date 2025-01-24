<?php
    require_once 'bootstrap.php';

    $templateParams["titolo"] = "PHPint - Catalogo Prootti";
    $templateParams["nome"] = "catalogo.php";
    $templateParams["birre"] = $dbh->getAllBeers();
    if(isset($_SESSION["username"])){
        $templateParams["codCarrello"] = $dbh->getCart($_SESSION["username"]);
    }
    require 'template/base.php';
?>
