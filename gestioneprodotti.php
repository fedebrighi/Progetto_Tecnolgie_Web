<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Gestione Prootti";
$templateParams["nome"] = "productmanagement.php";
$templateParams["birre"] = $dbh->getAllBeers();


require 'template/base.php';
