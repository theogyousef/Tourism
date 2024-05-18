
 ===========================================
 <?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['type']) && ($data['type'] === 'flight' || $data['type'] === 'hotel')) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if an item of the same type already exists in the cart
    $foundSameType = false;
    foreach ($_SESSION['cart'] as $cartItem) {
        if ($cartItem['type'] === $data['type']) {
            $foundSameType = true;
            break;
        }
    }

    if ($foundSameType) {
        echo json_encode(['status' => 'error', 'message' => 'You can only add one flight and one hotel to the cart.']);
    } else {
        $item = [
            'id' => $data['id'],
            'type' => $data['type'],
            'price' => $data['price'],
            'quantity' => 1,
        ];

        if ($data['type'] === 'flight') {
            $item['dep'] = $data['dep'];
            $item['arr'] = $data['arr'];
            $item['day'] = $data['day'];
            $item['deptime'] = $data['deptime'];
            $item['arrtime'] = $data['arrtime'];
            $item['duration'] = $data['duration'];
        } elseif ($data['type'] === 'hotel') {
            $item['name'] = $data['name'];
            $item['image'] = $data['image'];
        }

        $_SESSION['cart'][] = $item;

        echo json_encode(['status' => 'success', 'message' => ucfirst($data['type']) . ' added to cart successfully']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data or item type']);
}
?>
