<?php

// Definicion de variablres para crear el contenido del correo
$nombreCabecera = $_GET["name"];
$nombre = $_GET["name"]; 
$mail = $_GET["mail"];
$telefono = $_GET["phone"];
$comentario = $_GET["message"];

// Creacion del cuerpo del correo
$cuerpo = "Nombre: " . $nombre . "<br>Correo: " . $mail .  "<br>Telefono: " . $telefono . "<br>Mensaje: " . $comentario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer/Exception.php';
require 'php/PHPMailer/PHPMailer.php';
require 'php/PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                               //Enable verbose debug output
    $mail->isSMTP();                                                    //Send using SMTP
    $mail->Host       = 'mail.sermecchile.com';                         //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
    $mail->Username   = 'cotizacionpagina@sermecchile.com';             //SMTP username
    $mail->Password   = 'khhwIwGi!]a3';                                 //SMTP password
    $mail->SMTPSecure = 'ssl';                                          //Enable implicit TLS encryption
    $mail->Port       = 465;                                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('cotizacionpagina@sermecchile.com', $nombreCabecera);             //que se envie desde el correo del hosting           
    $mail->addAddress('ventas@sermecchile.com');                                     //al correo de destino
    $mail->addCC('jose.escobar@sermecchile.com', $nombreCabecera);
    $mail->addBCC('katherine.leon.toledo@gmail.com');
    //$mail->addReplyTo('info@example.com', 'Information');

    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = 'Solicitud de informacion a traves de la pagina web';
    $mail->Body    = $cuerpo;
    $mail->Charset = 'UTF-8';

    $mail->send();
    echo 'Mensaje enviado';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}

?>


