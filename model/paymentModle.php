<?php
require_once "../model/Model.php";

class PaymentModle extends Model
{

    public  function checkpermissions($id)
    {        $conn = $this->getConn();

        $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
        return $result;
    }
    public  function makeorder($order_id, $user_id, $total)
    {          $conn = $this->getConn();

        date_default_timezone_set('Africa/Cairo');
        mysqli_query($conn, "INSERT into orders (order_id , user_id ) VALUES ('$order_id' , '$user_id')");
        $Date = date("Y-m-d");
        $time = date("h:i:sa");
        mysqli_query($conn, "INSERT into orders_details (order_id , status , Date , time , total ) VALUES ('$order_id' , 'Pending' , '$Date' , '$time', '$total' )");
    }
    public  function insertorders_details($order_id, $product_id, $quantity)
    { $conn = $this->getConn();
        mysqli_query($conn, "INSERT into  order_product_details  (order_id , product_id , quantity ) VALUES ('$order_id' , '$product_id' , '$quantity' )");
    }
    public  function managestock($product_id, $quantity)
    { $conn = $this->getConn();
        $result = mysqli_query($conn, "SELECT * from products where id = '$product_id'");
        $row = mysqli_fetch_assoc($result);

        if ($result) {
            $quantityfromdatabase = $row['stock']; 
            $quantityfromorder = $quantity;
            $finalquantity = $quantityfromdatabase - $quantityfromorder;
            
            $query = "UPDATE products SET stock ='$finalquantity' WHERE id = '$product_id'";
            
            mysqli_query($conn, $query);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    
}
