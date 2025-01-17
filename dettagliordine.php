<?php
require_once 'bootstrap.php';


$templateParams["titolo"] = "PHPint - ORDINE #" . $_POST["codiceOrdine"];
$templateParams["nome"] = "orderdetail.php";
$templateParams["infoordine"] = $dbh->getOrderByCod($_POST["codiceOrdine"]);
$templateParams["elementiordine"] = $dbh->getOrderElementsByCod($_POST["codiceOrdine"]);
$templateParams["clienteLoggato"] = $dbh->isClientLogged($_SESSION["username"]);

require 'template/base.php';
