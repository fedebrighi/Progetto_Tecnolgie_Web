<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$codCarrello = $data["codCarrello"] ?? null;
$codProdotto = $data["codProdotto"] ?? null;
if (!empty($codCarrello) && !empty($codProdotto)) {
    try {
        $success = $dbh->removeProductFromCart($codCarrello, $codProdotto);
        echo json_encode(['success' => $success]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Parametri mancanti o non validi']);
}