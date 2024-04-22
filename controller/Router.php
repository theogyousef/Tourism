<?php
class Routere
{
    public static function handle($path = '/')
    {
        /*for just testing
        $currentMethod = $_SERVER['REQUEST_METHOD'];
        $currentUri = $_SERVER['REQUEST_URI'];
         echo $currentUri;*/

        $path = '/' . ltrim($path, '/');
        $root = '/tourism/views/index';
        $id = null; // Initialize $id here

        if (strpos($path, '/tourism/views/cart_display?remove=') !== false) {
            $pattern = '/\/tourism\/views\/(cart_display(?:\?remove=)?)(\d*)/';
        } else {

            $pattern = '/\/tourism\/views\/(product|editproduct|deleteproduct|edituser|deleteuser|makeuser|makeadmin|editorder|editreview|vieworder|Adminphotos|cancelorder|changepictures)\?id=(\d+)/';
        }
        if (preg_match($pattern, $path, $matches)) {
            // Extract the 'id' value from the matched URL
            $action = $matches[1];
            $id = $matches[2];

            // echo "id = " . $id;
        }
        //  echo $path;
        //  echo "id = " .$id;
        session_start();




        if ($path === $root) {
            require '../views/index.php';
            exit();
        } elseif ($path === '/tourism/views/product') {
            require '../views/product.php';
            exit();
        } elseif ($path === '/tourism/views/collections') {
            require '../views/collections.php';
            exit();
        } elseif ($path === '/tourism/views/profilesettings') {
            require '../views/profilesettings.php';
            exit();
        }
        elseif ($path === '/tourism/views/writeareview') {
            require '../views/writeareview.php';
            exit();
        } elseif ($path === '/tourism/views/checkout') {
            require '../views/checkout.php';
            exit();
        } elseif ($path === '/tourism/views/orders') {
            require '../views/orders.php';
            exit();
        }elseif ($path === '/tourism/views/Adminorders') {
            require '../views/Adminorders.php';
            exit();
        }elseif ($path === '/tourism/views/Adminreviews') {
            require '../views/Adminreviews.php';
            exit();
        }elseif ($path === '/tourism/views/confirmaddress') {

            require '../views/confirmaddress.php';
            exit();

        } elseif ($path === '/tourism/views/photoselector') {
            require '../views/photoselector.php';
            exit();
        } elseif ($path === '/tourism/views/confirmation') {
            require '../views/confirmation.php';
            exit();
        } elseif ($path === '/tourism/views/payment') {
            require '../views/payment.php';
            exit();
        } elseif ($path === '/tourism/views/addoption') {
            require '../views/addoption.php';
            exit();
        }elseif ($path === '/tourism/views/addvaluetoOP') {
            require '../views/addvaluetoOP.php';
            exit();
        }elseif ($path === '/tourism/views/confirmorder') {
            require '../views/confirmorder.php';
            exit();
        } elseif ($path === '/tourism/views/logout') {
            require '../views/logout.php';
            exit();
        } elseif ($path === '/tourism/views/adminDashboard') {
            require '../views/adminDashboard.php';
            exit();
        } elseif ($path === '/tourism/views/wishlist') {
            require '../views/wishlist.php';
            exit();
        } elseif ($path === '/tourism/views/about') {
            require '../views/about.php';
            exit();
        }elseif ($path === '/tourism/views/signup') {
            require '../views/signup.php';
            exit();
        }   elseif ($path === '/tourism/views/tsales') {
            require '../views/tsales.php';
            exit();
        } elseif ($path === '/tourism/views/msales') {
            require '../views/msales.php';
            exit();
        }elseif ($path === '/tourism/views/qsales') {
            require '../views/qsales.php';
            exit();
        } elseif ($path === '/tourism/views/ysales') {
            require '../views/ysales.php';
            exit();
        }elseif ($path === '/tourism/views/login') {
            require '../views/login.php';
            exit();
        } elseif ($path === '/tourism/views/forgetpassword') {
            require '../views/forgetpassword.php';
            exit();
        } elseif ($path === '/tourism/views/users') {
            require '../views/users.php';
            exit();
        } elseif ($path === '/tourism/views/adduser') {
            require '../views/adduser.php';
            exit();
        } elseif ($path === '/tourism/views/products') {
            require '../views/products.php';
            exit();
        } elseif ($path === '/tourism/views/addproduct') {
            require '../views/addproduct.php';
            exit();
        } elseif ($path === '/tourism/views/forgetpass') {
            require '../views/forgetpass.php';
            exit();
        } elseif ($path === '/tourism/views/otp') {
            require '../views/otp.php';
            exit();
        } elseif ($path === '/tourism/views/newpassword') {
            require '../views/resetpassword.php';
            exit();
        } elseif ($path === '/tourism/views/deactivated') {
            require '../views/deactivated.php';
            exit();
        } elseif ($path === '/tourism/views/cart_display') {

            require '../views/cart_display.php';
            exit();
        }elseif ($path === '/tourism/views/Adminphotos?id=' . $id) {
            require '../views/Adminphotos.php';
            exit();
        } elseif ($path === '/tourism/views/cart_display?remove=' . $id) {
            require '../views/cart_display.php';
            exit();
        }elseif ($path === '/tourism/views/cancelorder?id=' . $id) {
            require '../views/cancelorder.php';
            exit();
        }elseif ($path === '/tourism/views/editreview?id=' . $id) {
            require '../views/editreview.php';
            exit();
        } elseif ($path === '/tourism/views/changepictures?id=' . $id) {
            require '../views/changepictures.php';
            exit();
        }  elseif ($path === '/tourism/views/editorder?id=' . $id) {
            require '../views/editorder.php';
            exit();
        }  elseif ($path === '/tourism/views/vieworder?id=' . $id) {
            require '../views/vieworder.php';
            exit();
        } elseif ($path === '/tourism/views/editproduct?id=' . $id) {
            require '../views/editproduct.php';
            exit();
        } elseif ($path === '/tourism/views/product?id=' . $id) {
            require '../views/product.php';
            exit();
        } elseif ($path === '/tourism/views/deleteproduct?id=' . $id) {
            require '../views/deleteproduct.php';
            exit();
        } elseif ($path === '/tourism/views/edituser?id=' . $id) {
            require '../views/edituser.php';
            exit();
        } elseif ($path === '/tourism/views/deleteuser?id=' . $id) {
            require '../views/deleteuser.php';
            exit();
        } elseif ($path === '/tourism/views/makeuser?id=' . $id) {
            require '../views/makeuser.php';
            exit();
        } elseif ($path === '/tourism/views/makeadmin?id=' . $id) {
            require '../views/makeadmin.php';
            exit();
        } else {

            require '../views/404.php';
            exit();
        }
    }
}
