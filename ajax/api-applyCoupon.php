<?php
require_once '../bootstrap.php';

header('Content-Type: application/json');

// Decodifica il corpo della richiesta
$data = json_decode(file_get_contents('php://input'), true);
$couponCode = $data['couponCode'] ?? null;

if ($couponCode) {
    // Log per vedere cosa arriva
    error_log("Coupon code ricevuto: " . $couponCode);

    // Verifica il coupon nel database
    $discountAmount = $dbh->verifyAndApplyCoupon($_SESSION['username'], $couponCode);

    if ($discountAmount != 0) {
        // Se il coupon è valido, otteniamo l'importo dello sconto

        // Log per vedere il coupon
        error_log("Coupon valido, sconto: " . $discountAmount);

        echo json_encode([
            'success' => true,
            'discount_amount' => $discountAmount,
            'message' => 'Coupon applicato con successo!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Coupon non valido o già utilizzato.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Nessun coupon fornito.'
    ]);
}
?>
