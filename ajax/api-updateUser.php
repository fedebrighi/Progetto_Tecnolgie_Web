<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

// Decodifica i dati inviati tramite POST
$data = json_decode(file_get_contents('php://input'), true);

$nome = $data['nome'] ?? null;
$cognome = $data['cognome'] ?? null;
$email = $data['email'] ?? null;
$pw = $data['pw'] ?? null;
$indirizzo = $data['indirizzo'] ?? null;
$citta = $data['citta'] ?? null;
$cap = $data['cap'] ?? null;
$telefono = $data['telefono'] ?? null;
$dataNascita = $data['dataNascita'] ?? null;

// Validazione dei dati
if ($nome && $cognome && $email && $pw && $indirizzo && $citta && $cap && $telefono && $dataNascita) {
    try {
        // Aggiorna i dati dell'utente nel database
        $dbh->updateUser($_SESSION['username'], $nome, $cognome, $email, $pw, $indirizzo, $citta, $cap, $telefono, $dataNascita);

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Per debug, mostra quali campi mancano o sono nulli
    echo json_encode([
        'success' => false,
        'error' => 'Dati mancanti o non validi.',
        'debug' => compact('nome', 'cognome', 'email', 'pw', 'indirizzo', 'citta', 'cap', 'telefono', 'dataNascita')
    ]);
}
