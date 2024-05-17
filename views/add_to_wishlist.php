<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $hotelId = $input['id'];
    $hotelName = $input['name'];
    $hotelPrice = $input['price'];
    $hotelImage = $input['image'];

    if (!isset($_SESSION['products'])) {
        $_SESSION['products'] = [];
    }

    $found = false;

    foreach ($_SESSION['products'] as &$product) {
        if ($product['id'] === $hotelId) {
            $product['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['products'][] = [
            'id' => $hotelId,
            'name' => $hotelName,
            'price' => $hotelPrice,
            'image' => $hotelImage,
            'quantity' => 1
        ];
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
