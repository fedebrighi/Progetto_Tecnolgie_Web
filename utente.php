<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Area Personale";
$templateParams["nome"] = "userarea.php";
if(isUserLoggedIn()){
    $templateParams["cliente"] = $dbh->getClientByUsername($_SESSION["username"]);
    $templateParams["ordini"] = $dbh->getOrdersByClientUsername($_SESSION["username"]);
}else{
    header("Location: homepage.php");
}
require 'template/base.php';
?>
