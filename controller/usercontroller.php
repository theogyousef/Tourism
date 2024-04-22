<?php
include "../model/userModel.php";

class usercontroller extends Model{
    public function checkLoginStatus() {
        if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
            $conn = $this->getConn();
            $result = mysqli_query($conn, "SELECT p.*, u.* FROM permissions p JOIN users u ON p.user_id = u.id WHERE p.guest = '1'");
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
            } else {
                // Handle the case when the user is not found or permissions are not valid.
                // You might want to redirect to a login page or handle it accordingly.
                // Example: header("Location: login.php");
                //          exit();
            }
        }
        else if (!empty($_SESSION["id"])) {
            $id = $_SESSION["id"];
            $conn = $this->getConn();
            $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
            $row = mysqli_fetch_assoc($result);
          } else {
            header("Location: login");
          }
    }

    // Add other controller methods as needed.
}