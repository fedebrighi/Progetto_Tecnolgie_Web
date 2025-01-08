<?php

require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Login";

$result = [
    "logineseguito" => false,
    "errorelogin" => ""
];

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = $dbh->getClientIfRegistered($_POST["username"], $_POST["password"]);

    if (count($login_result) == 0) {
        $login_result = $dbh->getSellerIfRegistered($_POST["username"], $_POST["password"]);
        if (count($login_result) == 0) {
            $result["errorelogin"] = "Username e/o password errati, riprova";
            $templateParams["errorelogin"] = $result["errorelogin"];
        } else {
            registerLoggedUser($login_result[0]);
        }
    } else {
        registerLoggedUser($login_result[0]);
        
    }
    
}

if (isUserLoggedIn()) {

    $result["logineseguito"] = true;
    header("Location: homepage.php");
}

require 'template/loginpage.php';

?>
