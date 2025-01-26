<?php
require_once "../bootstrap.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$idProdotto = $data['codProdotto'];
$nome = $data['nome'];
$alc = $data['alc'];
$prezzo = $data['prezzo'];
$descrizione = $data['descrizione'];
$listaIngredienti = $data['listaIngredienti'];
$glutenFree = $data['glutenFree'];

try {
    $dbh->updateProduct($idProdotto, $nome, $alc, $prezzo, $descrizione, $listaIngredienti,  $glutenFree);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
