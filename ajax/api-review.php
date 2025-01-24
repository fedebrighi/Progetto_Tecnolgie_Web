<?php
require_once '../bootstrap.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Utente non autenticato.']);
    exit();
}

$username = $_SESSION['username'];
$codProdotto = $data['codProdotto'] ?? null;
$valutazione = $data['valutazione'] ?? null;
$testo = $data['testo'] ?? null;

if (!$codProdotto || !$valutazione || $valutazione < 1 || $valutazione > 5) {
    echo json_encode(['success' => false, 'message' => 'Dati non validi.']);
    exit();
}

try {
    $result = $dbh->addReview($username, $codProdotto, $valutazione, $testo);
    $dbh->createNotification($_SESSION["username"], $_SESSION["venditore"]["username"], "Nuova recensione ricevuta", "prodotto_in_dettaglio.php", $codProdotto);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Recensione aggiunta con successo.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante l\'aggiunta della recensione.']);
    }
} catch (Exception $e) {
    error_log('Errore nell\'aggiunta della recensione: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore interno al server.']);
}
