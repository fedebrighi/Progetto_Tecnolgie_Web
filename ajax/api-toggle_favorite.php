<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$codProdotto = $data['codProdotto'] ?? null;

if (!isset($_SESSION["username"]) || !$codProdotto) {
    echo json_encode([
        'success' => false,
        'message' => isset($_SESSION["username"]) ? 'Codice prodotto non fornito.' : 'Utente non autenticato.'
    ]);
    exit();
}

$username = $_SESSION["username"];

try {
    $isFavorite = $dbh->isProductFavorite($username, $codProdotto);

    if ($isFavorite) {
        $dbh->removeFavorite($username, $codProdotto);
        echo json_encode([
            'success' => true,
            'action' => 'removed',
            'message' => 'Prodotto rimosso dai preferiti.'
        ]);
    } else {
        $dbh->addFavorite($username, $codProdotto);
        echo json_encode([
            'success' => true,
            'action' => 'added',
            'message' => 'Prodotto aggiunto ai preferiti.'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Errore nella gestione dei preferiti.',
        'error' => $e->getMessage()
    ]);
    error_log("Errore nella gestione dei preferiti per l'utente $username: " . $e->getMessage());
    exit();
}
