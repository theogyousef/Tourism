<?php
require "../model/Model.php"; 
 require_once '../controller/usercontroller.php';
class Registerationsystem extends Model{



public function signup()
{
$usercontroller = new usercontroller();
$conn = $usercontroller->getConn();


  $firstname = $_POST["fname"];
  $lastname = $_POST["lname"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];

  // making sure the useranme and email from registeration is unique 
  $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");
  //if you found any duplicate 
  if (mysqli_num_rows($duplicate) > 0) {
    echo "<script> alert(' email has already been taken ');</script> ";
  } else {
    // reaching here means email is unique so we check
    //if the password == confirm password 
    if ($password == $confirmpassword) {
      // we create a query with the inputs of the form to insert into the databse 
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO users (firstname, lastname , email , password ) VALUES ('$firstname' , '$lastname', '$email','$hashedPassword');";

      // we pass the connection of the database and the quarey 
      mysqli_query($conn, $query);
      // echo "<script> alert('Regsitered successfully');</script> ";

      $result = mysqli_query($conn, "SELECT * FROM users where email = '$email'");
      $row = mysqli_fetch_assoc($result);
      $id = $row['id']; 
      $query2 = "INSERT INTO addresses (user_id , governorates , city , street , house , postalcode) VALUES ('$id' , ' ' , ' ' , ' ' , ' ' , ' ')";
      $query3 = "INSERT INTO permissions (user_id) VALUES ('$id')";

      mysqli_query($conn, $query2);
      mysqli_query($conn, $query3);

      header("Location: login");

    } else {
      // echo "<script> alert('Passwords do not match');</script> ";
    }
  }

}

public function signin()
{
  // echo "ienvie";  //global $conn ;
  $usercontroller = new usercontroller();
  $conn = $usercontroller->getConn();
  
  $email = $_POST['email'];
  $password = $_POST["pass"];
  //echo $conn;
//searching for the uder by username or email
  $result = mysqli_query($conn, "SELECT * FROM users where email = '$email'");
  
  $row = mysqli_fetch_assoc($result);
  //if the user was found 
  if (mysqli_num_rows($result) > 0) {
    if (password_verify($password, $row["password"])) {
      $_SESSION["login"] = true;

      $_SESSION["id"] = $row["id"];
      header("Location: index");
    } else {

    }
  } else {
    echo "<script> alert('user not registered ');</script> ";

  }
}
}

?>