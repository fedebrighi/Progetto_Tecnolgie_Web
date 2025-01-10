<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "PHPint - Area Personale";
$templateParams["nome"] = "home.php";
if(isUserLoggedIn()){
    $templateParams["cliente"] = $dbh->getClientByUsername($_SESSION["username"]);
    $templateParams["ordini"] = $dbh->getOrdersByClientUsername($_SESSION["username"]);
    require 'template/userarea.php';
}else{
    require 'template/base.php';
}

?>
