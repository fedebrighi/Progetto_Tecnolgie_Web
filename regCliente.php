<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "PHPint - Registrazione Cliente";
$templateParams["nome"] = "registration.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dataNascita = $_POST['dataNascita'];
    $citta = $_POST['citta'];
    $cap = $_POST['cap'];
    $indirizzo = $_POST['indirizzo'];
    $telefono = $_POST['telefono'];

    if ($dbh->saveNewUser($nome, $cognome, $email, $username, $password, $dataNascita, $citta, $cap, $indirizzo, $telefono)) {
        header("Location: simulation_registration.php");
        exit();
    } else {
        echo "Errore nella creazione dell'utente!";
    }
}
require 'template/base.php';
?>