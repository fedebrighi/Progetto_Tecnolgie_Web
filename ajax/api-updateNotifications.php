<?php
    require_once "../bootstrap.php";
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'error' => 'Metodo non valido']);
        exit;
    }
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['id'])) {
        echo json_encode(['success' => false, 'error' => 'Dati mancanti']);
        exit;
    }
    $idNotifica = intval($input['id']);
    try {
        $result = $dbh->markAsRead($idNotifica);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Impossibile aggiornare la notifica']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Errore del database: ' . $e->getMessage()]);
    }
?>
