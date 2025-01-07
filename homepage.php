<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Home";
$templateParams["birre"] = $dbh->getAllBeers();

require 'template/home.php';
?>
