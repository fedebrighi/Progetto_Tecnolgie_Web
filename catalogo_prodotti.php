<?php
    require_once 'bootstrap.php';

    //Base Template
    $templateParams["titolo"] = "PHPint - Catalogo Prootti";
    $templateParams["birre"] = $dbh->getAllBeers();

    require 'template/catalogo.php';
?>
