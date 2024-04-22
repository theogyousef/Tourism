<?php
require_once "../model/Model.php";
class UserModel extends Model
{


    public function uploadpic($fileUrl, $id)
    {
        $conn = $this->getConn();
        $query = "UPDATE users SET profilepicture = '$fileUrl' WHERE  id = $id ";
        mysqli_query($conn, $query);

    }
    public function editdetails($firstname, $lastname, $username, $email, $phone, $id)
    {
        $conn = $this->getConn();
        $query = "UPDATE users SET firstname = '$firstname' , lastname = '$lastname' ,username = '$username' , email = '$email' , phone = '$phone' WHERE  id = $id ";
        mysqli_query($conn, $query);

    }
    public  function updateaddress($governorates, $city, $street, $house, $postalcode, $id)
    {
        $conn = $this->getConn();
        $query = "UPDATE addresses SET governorates = '$governorates' , city = '$city' , street = '$street' ,house = '$house' , postalcode = '$postalcode'  WHERE  user_id = $id ";
        mysqli_query($conn, $query);

    }
    public  function updatephone($phone, $id)
    {
        $conn = $this->getConn();
        $query = "UPDATE users SET phone = '$phone' WHERE id = $id ";
        mysqli_query($conn, $query);

    }
    public  function updatesocials($github, $instagram, $id)
    {
        $conn = $this->getConn();
        $query = "UPDATE users SET github = '$github' , instagram = '$instagram' WHERE  id = $id ";
        mysqli_query($conn, $query);
    }
    public  function selectUser($id)
    {
        $conn = $this->getConn();
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'  ");
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    // public static function selectAddress($id)
    // {
    //     include "../controller/config.php";
    //     $result = mysqli_query($conn, "SELECT * FROM addresses WHERE user_id = '$id'  ");
    //     $row = mysqli_fetch_assoc($result);
    //     return $row;
    // }
    public  function UpdatePassword($hashedPassword, $id)
    {
        $conn = $this->getConn();
        $query = "UPDATE users SET password = '$hashedPassword' WHERE  id = $id ";
        mysqli_query($conn, $query);
    }

    public  function deactivateaccount($id)
    {
        $conn = $this->getConn();
        $query = "UPDATE users SET deactivated = '1' WHERE  id = $id ";
        mysqli_query($conn, $query);
    }
    public  function cancelorder($id)
    {
        $conn = $this->getConn();
        $query = "UPDATE orders_details SET status = 'Cancelled' WHERE  order_id = $id ";
        mysqli_query($conn, $query);
    }
}