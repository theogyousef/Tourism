<?php
//include "config.php";
include "../model/adminModle.php";
// products funvtions
class AdminFunctions extends Model{



public function addhotel()
{
    $adminModel = new adminModel();
    $name = $_POST["name"];
    $governorate = $_POST["governorate"];
    $price = $_POST["price"];
    $file = $_FILES["file"];

    $uploadDirectory = '../public/photos/hotelPhotos/'; // Directory where you save the uploaded files

    // Check if the file was uploaded successfully
    if (move_uploaded_file($file["tmp_name"], $uploadDirectory . $file["name"])) {
        $uploadedFileName = $file["name"];
        $fileUrl = $uploadDirectory . $uploadedFileName;
        //echo "<script>alert('The URL is: " . $fileUrl . "'); </script>";
    } else {
        echo "<script>alert('File upload failed.'); </script>";
    }

    /// apply th query to db by pass to the handler func
   $adminModel->addhotel($name, $governorate, $price , $fileUrl );

    header("Location: adminhotels");


}
public function updatehotel()
{    $adminModel = new adminModel();


    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $location = $_POST["location"];
  
   
    /// apply th query to db by pass to the handler func
    $adminModel->updatehotel($id, $name, $price, $location);
    header("Location: adminhotels");


}
public function deletehotel()
{    $adminModel = new adminModel();



    $id = $_POST["id"];
    $adminModel->deletehotel($id);
    header("Location: adminhotels");

}

public function deleteflight()
{    $adminModel = new adminModel();



    $id = $_POST["id"];
    $adminModel->deleteflight($id);
    header("Location: adminflights");

}
// users public   functions 

public   function adduser()
{    $adminModel = new adminModel();


    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    // making sure the useranme and email from registeration is unique 
    //if you found any duplicate 
    if ( $adminModel->checkduplicate($email)) {
        echo "<script> alert(' email has already been taken ');</script> ";
    } else {
        // reaching here means email is unique so we check
        //if the password == confirm password 
        if ($password == $confirmpassword) {
            // we create a query with the inputs of the form to insert into the databse 
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $adminModel->adduser($firstname, $lastname, $email, $hashedPassword);
            // echo "<script> alert('Regsitered successfully');</script> ";
            header("Location: users");

        } else {
            echo "<script> alert('Passwords do not match');</script> ";
        }
    }

}

public   function updateuser()
{
    $adminModel = new adminModel();

    $id = $_POST["id"];
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];

    $adminModel->updateuser($firstname, $lastname, $email, $id);

    header("Location: users");

}

public   function deleteuser()
{    $adminModel = new adminModel();


    global $conn;
    $id = $_POST["id"];
    $adminModel->deleteuser($id);
    header("Location: users");

}

public   function makeadmin()
{
    $adminModel = new adminModel();

    $id = $_POST["id"];
    $adminModel->makeadmin($id);
    header("Location: users");

}

public   function makeuser()
{
    $adminModel = new adminModel();

    $id = $_POST["id"];
    $adminModel->makeuser($id);
    header("Location: users");

}

public   function reactivateaccount($id)
{    $adminModel = new adminModel();

    $adminModel->activateaccount($id);

}
public   function updateorder(){
    $adminModel = new adminModel();
    $id = $_POST["id"];
    $status = $_POST["status"];
    $adminModel->updateorder($id , $status);
}

public   function updatereview(){
    $adminModel = new adminModel();
    $id = $_POST["id"];
    $status = $_POST["status"];
    $adminModel->updatereview($id , $status);
}

public   function updatephotos(){
    $adminModel = new adminModel();

    // Retrieve each file
    $id = $_POST["id"];
    $file = $_FILES["file"];
    $file1 = $_FILES["file1"];
    $file2 = $_FILES["file2"];
    $file3 = $_FILES["file3"];

    $uploadDirectory = '../public/photos/productPhotos/'; // Directory where you save the uploaded files

    // Check if each file was uploaded successfully
    if (move_uploaded_file($file["tmp_name"], $uploadDirectory . $file["name"]) &&
        move_uploaded_file($file1["tmp_name"], $uploadDirectory . $file1["name"]) &&
        move_uploaded_file($file2["tmp_name"], $uploadDirectory . $file2["name"]) &&
        move_uploaded_file($file3["tmp_name"], $uploadDirectory . $file3["name"])) {

        $uploadedFileName = $file["name"];
        $uploadedFileName1 = $file1["name"];
        $uploadedFileName2 = $file2["name"];
        $uploadedFileName3 = $file3["name"];

        $fileUrl = $uploadDirectory . $uploadedFileName;
        $fileUrl1 = $uploadDirectory . $uploadedFileName1;
        $fileUrl2 = $uploadDirectory . $uploadedFileName2;
        $fileUrl3 = $uploadDirectory . $uploadedFileName3;

        // echo "<script>alert('The URLs are: " . $fileUrl . ", " . $fileUrl1 . ", " . $fileUrl2 . ", " . $fileUrl3 . "'); </script>";

    } else {
        echo "<script>alert('File upload failed.'); </script>";
    }

    $adminModel->updatephotos($id, $fileUrl, $fileUrl1 , $fileUrl2, $fileUrl3);

}

public function updateindexphotos()
{
    $adminModel = new adminModel();
    $id = $_POST["id"];
    $photo = $_POST["photo"];

    $file = $_FILES["file"];
    $uploadDirectory = '../public/photos/indexPhotos/'; // Directory where you save the uploaded files

    // Check if the file was uploaded successfully
    if (move_uploaded_file($file["tmp_name"], $uploadDirectory . $file["name"])) {
        $uploadedFileName = $file["name"];
        $fileUrl = $uploadDirectory . $uploadedFileName;
        // echo "<script>alert('The URL is: " . $fileUrl . "'); </script>";
        $path = $fileUrl ;

        // echo "<script>alert('The URL is: " . $fileUrl . "'); </script>";
        $adminModel->updateindexphotos($id,$path ,$photo);

     } else {
        echo "<script>alert('File upload failed.'); </script>";
    }
}
public function addflight()
{
    $adminModel = new adminModel();
    
    $flight_dep = $_POST["flight_dep"];
    $flight_arr = $_POST["flight_arr"];
    $eco_price = $_POST["eco_price"];
    $bus_price = $_POST["bus_price"];
    $dept_time = $_POST["dept_time"];
    $arr_time = $_POST["arr_time"];
    $flight_day = $_POST["flight_day"];

    $adminModel->addflight($flight_dep, $flight_arr, $eco_price, $bus_price, $dept_time, $arr_time, $flight_day);

    header("Location: flights.php");
    
}
public function updateFlight()
{
    $adminModel = new adminModel;

    $id = $_POST["id"];
    $flight_dep = $_POST["flight_dep"];
    $flight_arr = $_POST["flight_arr"];
    $eco_price = $_POST["eco_price"];
    $bus_price = $_POST["bus_price"];
    $dept_time = $_POST["dept_time"];
    $arr_time = $_POST["arr_time"];
    $flight_day = $_POST["flight_day"];

    $adminModel->updateFlight($id, $flight_dep, $flight_arr, $eco_price, $bus_price, $dept_time, $arr_time, $flight_day);

    header("Location: flights.php");
}
}

