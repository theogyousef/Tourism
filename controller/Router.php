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

            $pattern = '/\/tourism\/views\/(deleteflight|edithotels|deletehotel|edituser|deleteuser|makeuser|makeadmin|hotel-details|editflight)\?id=(\d+)/';
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
        elseif ($path === '/tourism/views/users') {
            require '../views/users.php';
            exit();
        }
        elseif ($path === '/tourism/views/admindashboard') {
            require '../views/admindashboard.php';
            exit();
        }
        elseif ($path === '/tourism/views/admintrips') {
            require '../views/admintrips.php';
            exit();
        }
        elseif ($path === '/tourism/views/adduser') {
            require '../views/adduser.php';
            exit();
        }
        elseif ($path === '/tourism/views/adminflights') {
            require '../views/adminflights.php';
            exit();
        }
        elseif ($path === '/tourism/views/adminhotels') {
            require '../views/adminhotels.php';
            exit();
        }   elseif ($path === '/tourism/views/addhotels') {
            require '../views/addhotels.php';
            exit();
        }elseif ($path === '/tourism/views/cart') {
            require '../views/cart.php';
            exit();
        }
        elseif ($path === '/tourism/views/addflight') {
            require '../views/addflight.php';
            exit();
        }
        elseif ($path === '/tourism/views/Adminphotos?id=' . $id) {
            require '../views/Adminphotos.php';
            exit();
        }
        elseif ($path === '/tourism/views/hotel-details?id=' . $id) {
            require '../views/hotel-details.php';
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
        }  elseif ($path === '/tourism/views/edithotels?id=' . $id) {
            require '../views/edithotels.php';
            exit();
        }  elseif ($path === '/tourism/views/vieworder?id=' . $id) {
            require '../views/vieworder.php';
            exit();
        } elseif ($path === '/tourism/views/editflight?id=' . $id) {
            require '../views/editflight.php';
            exit();
        } elseif ($path === '/tourism/views/product?id=' . $id) {
            require '../views/product.php';
            exit();
        } elseif ($path === '/tourism/views/deleteflight?id=' . $id) {
            require '../views/deleteflight.php';
            exit();
        }elseif ($path === '/tourism/views/deletehotel?id=' . $id) {
            require '../views/deletehotel.php';
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
        }
        else {

            require '../views/404.php';
            exit();
        }
    }
}
