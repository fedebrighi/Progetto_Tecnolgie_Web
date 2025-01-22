<?php
require_once "../bootstrap.php";
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'error' => 'Metodo non valido']);
    exit;
}
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'error' => 'Utente non autenticato']);
    exit;
}
$username = $_SESSION['username'];
try {
    $count = $dbh->getUnreadNotificationsNum($username); 
    echo json_encode(['success' => true, 'count' => $count["numero"]]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Errore del database: ' . $e->getMessage()]);
}
?>
