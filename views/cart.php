<?php


// Include necessary files
require '../includes/config.php';
require '../includes/Dbh.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// include "header.php";
require_once '../model/fetchModle.php';
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();
$fetchModle = new fetchModle();
$conn = $usercontroller->getConn();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $result = mysqli_query($conn, " SELECT p.*, u.* FROM permissions p JOIN users u ON p.user_id = u.id WHERE p.guest = '1' ");
    $row = mysqli_fetch_assoc($result);
    $_SESSION["login"] = true;
    $_SESSION["id"] = $row["id"];
} else if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login");
}

if (isset($_GET['remove'])) {
    // Remove item from cart based on ID
    $id = $_GET['remove'];
    if (isset($_SESSION['products'])||isset($_SESSION['flights'])) {
        foreach ($_SESSION['products'] as $key => $product) {
            if ($product['id'] == $id) {
                unset($_SESSION['products'][$key]);
                break;
            }
        }
        foreach ($_SESSION['flights'] as $key => $flight) {
            if ($flight['id'] == $id) {
                unset($_SESSION['flights'][$key]);
                break;
            }
        }
        
        $_SESSION['products'] = array_values($_SESSION['products']);
        $_SESSION['flights'] = array_values($_SESSION['flights']);
    } 
    
    header('Location: cart.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <!-- Include CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="../public/css/cart.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>My Cart</h1>
        </div>
    </header>

    <div class="cart-wrap">
        <div class="container">
            <div class="row">
                <?php
                $total = 0;
                if (!empty($_SESSION['products'])) :
                    foreach ($_SESSION['products'] as $product) :
                        $total += $product['price'];
                ?>
                        <div class="col-md-12 mb-3">
                            <div class="card" style="width: 100%;">
                                <div class="row g-0">
                                    <div class="col-md-2">
                                        <?php if (isset($product['image'])) : ?>
                                            <img src="<?php echo $product['image']; ?>" class="img-fluid rounded-start" alt="...">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <?php if (isset($product['name'])) : ?>
                                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                                <h5 class="card-title"><a href="product?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h5>
                                            <?php endif; ?>
                                            <?php if (isset($product['price'])) : ?>
                                                <p class="card-text"><?php echo  number_format($product['price'],2); ?> EGP</p>
                                            <?php endif; ?>
                                            <?php if (isset($product['options'])) : ?>
                                                <p class="card-text"><?php echo $product['options']; ?></p>
                                            <?php endif; ?>
                                            <p class="card-text"><?php echo $product['price']; ?> EGP</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <a href="cart.php?remove=<?php echo $product['id']; ?>" class="trash-icon"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>

                <?php
                if (!empty($_SESSION['flights'])) :
                    foreach ($_SESSION['flights'] as $flight) :
                        $total += $flight['price'];
                ?>
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="row g-0">
                                    
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Flight: <?php echo $flight['dep'] . ' to ' . $flight['arr']; ?></h5>
                                            <p class="card-text"><?php echo $flight['price']; ?> EGP</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <a href="cart.php?remove=<?php echo $flight['id']; ?>" class="trash-icon"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>

                <?php if (empty($_SESSION['products']) && empty($_SESSION['flights'])) : ?>
                    <p class="p-cart text-center">Your cart is empty.</p>
                <?php endif; ?>
            </div>

            <div class="row mt-4">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h3>Total: <?php echo  number_format($total,2); ?> EGP</h3>
                    <?php $_SESSION['total'] = $total; ?>
                    <div>
                        <?php if (empty($_SESSION['products']) && empty($_SESSION['flights'])) : ?>
                            <a href="hotels.php" class="btn btn-primary">Discover More Hotels</a>
                            <a href="flights.php" class="btn btn-primary">Discover More Flights</a>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['products']) || !empty($_SESSION['flights'])) : ?>
                            <a href="checkout" class="btn btn-success">Proceed to Checkout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <!-- Include footer content -->
        <?php include "footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
