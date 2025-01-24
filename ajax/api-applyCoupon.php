<?php
require_once '../bootstrap.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$couponCode = $data['couponCode'] ?? null;

if ($couponCode) {
    error_log("Coupon code ricevuto: " . $couponCode);

    $discountAmount = $dbh->verifyAndApplyCoupon($_SESSION['username'], $couponCode);

    if ($discountAmount != 0) {
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
