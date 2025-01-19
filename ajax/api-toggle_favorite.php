<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

// Decodifica il corpo della richiesta JSON
$data = json_decode(file_get_contents('php://input'), true);

// Estrai il codice prodotto dalla richiesta
$codProdotto = $data['codProdotto'] ?? null;

// Controlla se l'utente è autenticato e se il codice prodotto è fornito
if (!isset($_SESSION["username"]) || !$codProdotto) {
    echo json_encode([
        'success' => false,
        'message' => isset($_SESSION["username"]) ? 'Codice prodotto non fornito.' : 'Utente non autenticato.'
    ]);
    exit();
}

$username = $_SESSION["username"];

try {
    // Verifica se il prodotto è già nei preferiti
    $isFavorite = $dbh->isProductFavorite($username, $codProdotto);

    if ($isFavorite) {
        // Rimuovi il prodotto dai preferiti
        $dbh->removeFavorite($username, $codProdotto);
        echo json_encode([
            'success' => true,
            'action' => 'removed',
            'message' => 'Prodotto rimosso dai preferiti.'
        ]);
    } else {
        // Aggiungi il prodotto ai preferiti
        $dbh->addFavorite($username, $codProdotto);
        echo json_encode([
            'success' => true,
            'action' => 'added',
            'message' => 'Prodotto aggiunto ai preferiti.'
        ]);
    }
} catch (Exception $e) {
    // In caso di errore, restituisci un messaggio di errore e loggalo
    echo json_encode([
        'success' => false,
        'message' => 'Errore nella gestione dei preferiti.',
        'error' => $e->getMessage()
    ]);
    error_log("Errore nella gestione dei preferiti per l'utente $username: " . $e->getMessage());
    exit();
}
?>
