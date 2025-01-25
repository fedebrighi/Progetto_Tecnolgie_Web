<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

// Ottieni il dato inviato tramite POST
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';

if ($username) {
    $result = $dbh->getClientByUsername($username);
    if (sizeof($result) > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
    echo json_encode(['error' => 'Username non fornito']);
}
?>
