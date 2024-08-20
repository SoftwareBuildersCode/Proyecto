<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'nachoserpa1@gmail.com';                     
    $mail->Password   = 'uusq qlbq aurd fvxg';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('nachoserpa1@gmail.com', 'Asset Store');
    $mail->addAddress('nachoserpa79@gmail.com', 'Joe User');                 

    //Content
    $mail->isHTML(true);                                
    $mail->Subject = 'Detalles de la compra';

    $cuerpo = '<h4> Gracias por su compra </h4>';
    $cuerpo .= '<p>El ID de su compra es <b>'. $id_transaccion . '</b></p>'; // Agregado punto y coma y etiqueta de cierre

    $mail->Body    = utf8_decode($cuerpo);
    $mail->AltBody = 'Le enviamos los detalles de su compra';

    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php'); // Corregido método

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo de la compra: {$mail->ErrorInfo}";
}
?>
