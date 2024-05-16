<?php
require_once "../model/Model.php";

class adminModel extends Model
{
    public function addhotel($name, $governorate, $price , $fileUrl )
    {       $conn = $this->getConn();

        $query = "insert into hotels (name,location,price,photo) values (' $name','$governorate' ,'$price','$fileUrl')";

        mysqli_query($conn, $query);
    }
    public function updatehotel($id, $name, $price, $location)
    { $conn = $this->getConn();
        $query = "update hotels set name ='$name',price ='$price',location ='$location' where id = '$id'";

        mysqli_query($conn, $query);
    }

    public function deletehotel($id)
    { $conn = $this->getConn();
        $query = "DELETE FROM hotels WHERE id = '$id'";
        mysqli_query($conn, $query);
    }
    public function deleteflight($id)
    { $conn = $this->getConn();
        $query = "DELETE FROM flights WHERE id = '$id'";
        mysqli_query($conn, $query);
    }
    public function adduser($firstname, $lastname, $email, $hashedPassword)
    { $conn = $this->getConn();
        $query = "insert into users (firstname, lastname , email , password ) values ('$firstname' , '$lastname', '$email','$hashedPassword')";
        mysqli_query($conn, $query);
        $result = mysqli_query($conn, "SELECT * FROM users where email = '$email'");
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $query2 = "INSERT INTO addresses (user_id) VALUES ('$id')";
        $query3 = "INSERT INTO permissions (user_id) VALUES ('$id')";

        mysqli_query($conn, $query2);
        mysqli_query($conn, $query3);

    }
    public function checkduplicate($email)
    { $conn = $this->getConn();
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        return mysqli_num_rows($result) > 0; // Returns true if duplicate, false otherwise
    }
    public function updateuser($firstname, $lastname, $email, $id)
    { $conn = $this->getConn();
        $query = "update users set firstname ='$firstname',lastname ='$lastname',email ='$email'  where id = '$id'";
        mysqli_query($conn, $query);
    }
    public function deleteuser($id)
    { $conn = $this->getConn();
        $query = "DELETE FROM addresses WHERE user_id = '$id'";
        $query2 = "DELETE FROM permissions WHERE user_id = '$id'";
        $query3 = "DELETE FROM users WHERE id = '$id'";
        mysqli_query($conn, $query);
        mysqli_query($conn, $query2);
        mysqli_query($conn, $query3);

    }
    public function makeadmin($id)
    { $conn = $this->getConn();
        $query = "UPDATE permissions set admin = '1' WHERE user_id = '$id'";
        mysqli_query($conn, $query);
    }
    public function makeuser($id)
    {
        $conn = $this->getConn();
        $query = "UPDATE permissions set admin = '0' WHERE user_id = '$id'";
        mysqli_query($conn, $query);
    }
    public function activateaccount($id)
    { $conn = $this->getConn();

        $query = "UPDATE users SET deactivated = '0' WHERE  id = $id ";
        mysqli_query($conn, $query);
    }

    public function updateorder($id, $status)
    { $conn = $this->getConn();

        $query = "UPDATE orders_details SET status = '$status' WHERE order_id = $id ";
        mysqli_query($conn, $query);
    }

    public function updatereview($id, $status)
    { $conn = $this->getConn();
        $query = "UPDATE reviews SET status = '$status' WHERE review_id = $id ";
        mysqli_query($conn, $query);
    }
    public function updatephotos($id, $fileUrl, $fileUrl1, $fileUrl2, $fileUrl3)
    { $conn = $this->getConn();
        $result = mysqli_query($conn, "SELECT * from product_photos where product_id = '$id';");
        $row = mysqli_fetch_assoc($result);

        if (!empty($row)) {
            $query = "UPDATE products SET file = '$fileUrl' WHERE id = $id ";
            mysqli_query($conn, $query);
            $query2 = "UPDATE product_photos SET file1 = '$fileUrl1', file2 = '$fileUrl2', file3 = '$fileUrl3' WHERE product_id = $id ";
            mysqli_query($conn, $query2);
        } else if (empty($row)) {
            $query3 = "UPDATE products SET file = '$fileUrl' WHERE id = $id ";
            mysqli_query($conn, $query3);
            $query4 = "INSERT into product_photos (product_id, file1, file2, file3) VALUES ('$id', '$fileUrl1', '$fileUrl2', '$fileUrl3')";
            mysqli_query($conn, $query4);
        }
    }

    public function updateindexphotos( $id , $path , $photo){
        $conn = $this->getConn();
       $query = " UPDATE images set path = '$path ' , photo = '$photo'  where ID = '$id' " ;
       mysqli_query($conn, $query);
    }

}
