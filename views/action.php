<?php
session_start();

require '../includes/config.php';
require '../includes/Dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['hotel_id'])) {
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
    }}

    elseif (isset($_POST['flight_id'])) {
        $flight_id = $_POST['flight_id'];
        $flight_dep = $_POST['flight_dep'];
        $flight_arr = $_POST['flight_arr'];
        $flight_price = $_POST['flight_price'];
    
        // Initialize cart if it doesn't exist
        if (!isset($_SESSION['flights'])) {
            $_SESSION['flights'] = [];
        }
    
        // Add flight to session cart
        $_SESSION['flights'][] = [
            'id' => $flight_id,
            'dep' => $flight_dep,
            'arr' => $flight_arr,
            'price' => $flight_price
        ];
    
        // Redirect to cart page
        header('Location: cart.php');
        exit();
    }


    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

?>
