<?php
require_once '../bootstrap.php';

header('Content-Type: application/json');

// Recupera i dati dalla richiesta
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Utente non autenticato.']);
    exit();
}

$username = $_SESSION['username'];
$codProdotto = $data['codProdotto'] ?? null;
$valutazione = $data['valutazione'] ?? null;
$testo = $data['testo'] ?? null;

// Validazione dei dati
if (!$codProdotto || !$valutazione || $valutazione < 1 || $valutazione > 5) {
    echo json_encode(['success' => false, 'message' => 'Dati non validi.']);
    exit();
}

try {
    // Inserisce la recensione nel database
    $result = $dbh->addReview($username, $codProdotto, $valutazione, $testo);
    $dbh->createNotification($_SESSION["username"], $_SESSION["venditore"]["username"], "Nuova recensione ricevuta");
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Recensione aggiunta con successo.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante l\'aggiunta della recensione.']);
    }
} catch (Exception $e) {
    error_log('Errore nell\'aggiunta della recensione: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore interno al server.']);
}
?>
