<?php
require_once 'bootstrap.php';

// Creazione dell'istanza della classe DatabaseHelper
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "er_2phpint";
$port = 3306;

// Assicurati che il file bootstrap.php contenga già le credenziali del database.
// Altrimenti, aggiungile qui:
$databaseHelper = new DatabaseHelper($servername, $username, $password, $dbname, $port);

// Base Template
$templateParams = array();
$templateParams["titolo"] = "PHPint - Registrazione Cliente";
$templateParams["utente"] = null; // L'utente non ha effettuato il login

// Variabile per il messaggio di errore/successo
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = $databaseHelper->getDb();
        /*
        // Crea un nuovo carrello con ID univoco
        do {
            $carrelloId = uniqid();
            $queryVerifica = "SELECT COUNT(*) as count FROM carrello WHERE codCarrello = ?";
            $stmtVerifica = $db->prepare($queryVerifica);
            $stmtVerifica->bind_param('s', $carrelloId);
            $stmtVerifica->execute();
            $result = $stmtVerifica->get_result();
            $count = $result->fetch_assoc()['count'];
        } while ($count > 0);

        // Inserisci il nuovo carrello
        $queryCarrello = "INSERT INTO carrello (codCarrello, totale) VALUES (?, 0)";
        $stmtCarrello = $db->prepare($queryCarrello);
        $stmtCarrello->bind_param('s', $carrelloId);
        $stmtCarrello->execute();

        // Salva l'utente
        $databaseHelper->saveUserInfo(
            $_POST['nome'],
            $_POST['cognome'],
            $_POST['email'],
            $_POST['username'],
            $_POST['password'],
            $_POST['dataNascita'],
            $_POST['citta'],
            $_POST['cap'],
            $_POST['indirizzo'],
            $_POST['telefono'],

        );
        */
        // Reindirizzamento
        header("Location: homepage.php");
        exit();
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
// Aggiungi il messaggio al template se necessario
$templateParams["message"] = $message;

// Includi il template per la registrazione cliente
require 'template/registration.php';
?>