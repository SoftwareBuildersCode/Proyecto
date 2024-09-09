<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

class Mailer {
    function enviarEmail($email, $asunto, $cuerpo){
        require_once __DIR__ . '/../config/config.php';
        require __DIR__ . '/../phpmailer/src/PHPMailer.php';
        require __DIR__ .'/../phpmailer/src/SMTP.php';
        require __DIR__ .'/../phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; // Desactiva la depuración SMTP
            $mail->isSMTP();                                            
            $mail->Host       = MAIL_HOST;                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = MAIL_USER;                     
            $mail->Password   = MAIL_PASS;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = MAIL_PORT;                                    

            //Recipients
            $mail->setFrom(MAIL_USER, 'Asset Store');
            $mail->addAddress($email);                 

            //Content
            $mail->isHTML(true);                                
            $mail->Subject = $asunto;
            $mail->Body    = utf8_decode($cuerpo);

            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php'); // Corregido método

            if($mail->send()){
                return true;
            } else {
                return false;
            }
        } catch(Exception $e) {
            echo "Error al enviar el correo de la compra: {$mail->ErrorInfo}";
            return false;
        }
    }
}
?>