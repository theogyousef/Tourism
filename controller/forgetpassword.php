<?php
require_once '../model/Model.php';
require '../phpmailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Forgetpassword extends Model
{
    public function forgetpassword()
    {
        $conn = $this->getConn();

        global $email;

        if (isset($_REQUEST['submit'])) {

            $email = $_REQUEST['email'];
            $_SESSION['email'] = $email;

            $check_query = mysqli_query($conn, "SELECT * FROM users where email ='$email'");
            $rowCount = mysqli_num_rows($check_query);
            if ($rowCount > 0) {
                $data =  mysqli_fetch_assoc($check_query);
                $otp = rand(100000, 999999);
                $mail = new PHPMailer(true);

                try {

                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'mariamsamyeg@gmail.com';
                    $mail->Password   = 'xtud dnit byen ledd';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = 465;

                    $mail->setFrom('mariamsamyeg@gmail.com', 'mariam');
                    $mail->addAddress($email, 'user');

                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

                    $htmlContent = file_get_contents('password-recovery-email.php');
                    $htmlContent = str_replace('{{otp_code}}', $otp, $htmlContent);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Password Reset';
                    $mail->Body = $htmlContent; 
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if ($mail->send()) {
                        echo $email;
                        $query = "UPDATE users SET otp = '$otp' WHERE email = '$email'";
                        mysqli_query($conn, $query);
                        header("Location: otp.php");
                    }
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }


    public function otp()
    {
        $conn = $this->getConn();


        if (isset($_REQUEST['submitOTP'])) {
            $otp = $_REQUEST['otp'];
            $check_query = mysqli_query($conn, "SELECT * FROM users WHERE otp = '$otp'");
            $rowCount = mysqli_num_rows($check_query);

            if ($rowCount > 0) {
                $update_query = mysqli_query($conn, "UPDATE users SET otp = 0 WHERE otp = '$otp'");

                if ($update_query) {
                    header("Location: resetpassword");
                    echo "OTP successfully updated to 0.";
                } else {
                    echo "Error updating OTP: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Invalid OTP. Please try again.";
        }
    }


    public function newpassword()
    { echo '<script>alert(" wasal controlleer")</script>'; 
    
        $conn = $this->getConn();


        if (isset($_POST['submitpass'])) {
            $password = $_POST["password"];
            $confirmpassword = $_POST["confirmpassword"];

            $email = $_SESSION['email'];
            echo '<script>alert(" email : '. $email  . ' ")</script>'; 
    
           
            if ($password == $confirmpassword) {

                $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
                $row = mysqli_fetch_assoc($result);

                if ($result) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $update_query = mysqli_query($conn, "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'");

                    if ($update_query) {
                        header("Location: login.php");
                        unset($_SESSION['email']);
                    } else {
                        echo "Error updating password: " . mysqli_error($conn);
                    }
                } else {
                    echo "Email not found. Please try again.";
                }
            } else {
                echo "Passwords do not match. Please try again.";
            }
        }
    }
}
