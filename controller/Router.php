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
        } elseif ($path === '/tourism/views/index') {
            require '../views/index.php';
            exit();
        } elseif ($path === '/tourism/views/flights') {
            require '../views/flights.php';
            exit();
        }
        elseif ($path === '/tourism/views/login') {
            require '../views/login.php';
            exit();
        }
        elseif ($path === '/tourism/views/room-details') {
            require '../views/room-details.php';
            exit();
        }
        elseif ($path === '/tourism/views/signup') {
            require '../views/signup.php';
            exit();
        }
        elseif ($path === '/tourism/views/forgetpassword') {
            require '../views/forgetpassword.php';
            exit();
        }
        elseif ($path === '/tourism/views/otp') {
            require '../views/otp.php';
            exit();
        } elseif ($path === '/tourism/views/resetpassword') {
            require '../views/resetpassword.php';
            exit();
        }
        elseif ($path === '/tourism/views/logout') {
            require '../views/logout.php';
            exit();
        }
        elseif ($path === '/tourism/views/profilesettings') {
            require '../views/profilesettings.php';
            exit();
        }
        elseif ($path === '/tourism/views/hotels') {
            require '../views/hotels.php';
            exit();
        }
        elseif ($path === '/tourism/views/admindashboard') {
            require '../views/admindashboard.php';
            exit();
        }
        elseif ($path === '/tourism/views/Adminphotos?id=' . $id) {
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
