<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['name']) && isset($data['price']) && isset($data['image'])) {
    $product = [
        'id' => $data['id'],
        'name' => $data['name'],
        'price' => $data['price'],
        'image' => $data['image'],
        'quantity' => 1
    ];

    if (!isset($_SESSION['products'])) {
        $_SESSION['products'] = [];
    }

    $found = false;
    foreach ($_SESSION['products'] as &$item) {
        if ($item['id'] == $product['id']) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['products'][] = $product;
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
