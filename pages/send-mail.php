<?php

require_once('PHPMAILER/PHPMailerAutoload.php');
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'sportschoolbenno123@gmail.com';
$mail->Password = 'Benno123';
$mail->SetFrom('sportschoolbenno123@gmail.com');
$mail->Subject = 'Help!';
$mail->Body = 'Errrr!';
$mail->AddAddress('sportschoolbenno123@gmail.com');

try {$mail->Send();
    echo 'Message has been sent';

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>
