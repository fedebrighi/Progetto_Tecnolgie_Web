<?php

require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Login";
$templateParams["nome"] = "loginpage.php";
$_SESSION["venditore"] = $dbh->getSeller();

$result = [
    "logineseguito" => false,
    "errorelogin" => ""
];

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = $dbh->getUserIfRegistered($_POST["username"], $_POST["password"]);
    if (count($login_result) == 0) {
        $result["errorelogin"] = "Username e/o password errati, riprova";
        $templateParams["errorelogin"] = $result["errorelogin"];
    } else {
        registerLoggedUser($login_result[0]);
    }
}

if (isUserLoggedIn()) {

    $result["logineseguito"] = true;
    header("Location: homepage.php");
}

require 'template/base.php';

?>