<?php

require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();

$conn = $usercontroller->getConn();
require '../phpmailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submitemail']) && isset($_POST['email'])) {
    Mail::sendmail($_POST['email']);
}
class Mail{
public static function sendmail($email) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username   = 'mariamsamyeg@gmail.com';
        $mail->Password   = 'xtud dnit byen ledd';         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('mariamsamyeg@gmail.com', 'mariam');
        $mail->addAddress($email, "Hi " . $email); 

        $htmlContent = file_get_contents('../views/newsettler_mail.php');
        $htmlContent = str_replace('{{FirstName}}', "Hi " . $email, $htmlContent);
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Egypt Tourism!';
        $mail->Body = $htmlContent; 

        $mail->send();
        echo "Message has been sent to {$email}";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
}


?>