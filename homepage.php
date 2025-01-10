<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Home";
$templateParams["nome"] = "home.php";
$templateParams["birre"] = $dbh->getAllBeers();

require 'template/base.php';
?>
