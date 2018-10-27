<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(true);                              
try {
    //$mail->SMTPDebug = 4;                               // Habilitar el debug

    $mail->isSMTP();                                      // Usar SMTP
    $mail->Host = 'mail.grupoelectricopersa.com';  // Especificar el servidor SMTP reemplazando por el nombre del servidor donde esta alojada su cuenta
    $mail->SMTPAuth = true;                               // Habilitar autenticacion SMTP
    $mail->Username = 'ventas@grupoelectricopersa.com';                 // Nombre de usuario SMTP donde debe ir la cuenta de correo a utilizar para el envio
    $mail->Password = 'grupoele123*';                           // Clave SMTP donde debe ir la clave de la cuenta de correo a utilizar para el envio
    $mail->SMTPSecure = 'ssl';                            // Habilitar encriptacion
    $mail->Port = 465;                                    // Puerto SMTP                     
    $mail->Timeout       =   30;
    $mail->AuthType = 'LOGIN';

    //Recipients   
	$nombre=$_POST["Nombre"];
	$correo=$_POST["Correo"];
	$Asunto=$_POST["Asunto"];
	$Mensaje=$_POST["mensaje"];
	$contenido="Nombre: ".$nombre."\nCorreo: ".$correo."\Mensaje: ".$mensaje;
    $mail->setFrom('ventas@grupoelectricopersa.com');     //Direccion de correo remitente (DEBE SER EL MISMO "Username")
    $mail->addAddress($correo);     // Agregar el destinatario
    $mail->addReplyTo($correo);     //Direccion de correo para respuestas     

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $Asunto;
    $mail->Body    = $contenido;
    
    $mail->send();
    echo 'El mensaje ha sido enviado';

} catch (Exception $e) {
    echo 'El mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
}
?>