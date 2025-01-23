<?php
require_once 'bootstrap.php';


if (isset($_POST["codice"])) {
    $cod = $_POST["codice"];
}


$templateParams["titolo"] = "PHPint - ORDINE #" . $cod;
$templateParams["nome"] = "orderdetail.php";
$templateParams["infoordine"] = $dbh->getOrderByCod($cod);
$templateParams["elementiordine"] = $dbh->getOrderElementsByCod($cod);
$templateParams["clienteLoggato"] = $dbh->isClientLogged($_SESSION["username"]);

require 'template/base.php';
