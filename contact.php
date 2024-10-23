<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'src/Exception.php';
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';
require_once 'lib/config.php';
require 'vendor/autoload.php';


$mail = new PHPMailer(true);

try {

    // Vérifie si le nom se termine par "Nor"
    $name = $_POST['name']; // ou récupère le nom de la personne
    if (preg_match('/Nor$/i', $name)) {
        // Si le nom se termine par "Nor", bloquer l'envoi et afficher un message d'erreur
        die("L'envoi du message est bloqué pour ce nom.");
    }

    // Configuration du serveur SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                          
    $mail->isSMTP(); 
    $mail->Host = MAIL_HOST; 
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = MAIL_USERNAME;
    $mail->Password   = MAIL_PASSWORD; 
    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = MAIL_ENCRYPTION;            
    $mail->Port       = MAIL_PORT;                                    
    // Destinataires
    $mail->setFrom($_POST['email'], 'Formulaire de Contact');
    $mail->addAddress('varachasjulien@gmail.com', 'Julien Varachas');     
    
    // Contenu    
    $mail->isHTML(true);                                
    $mail->Subject = 'Nouveau message du Portfolio';
    $mail->Body    = 'Prénom: ' . htmlspecialchars($_POST['firstname']) . '<br>Nom: ' . htmlspecialchars($_POST['name']) . '<br>Email: ' . htmlspecialchars($_POST['email']) . '<br>Message: ' . htmlspecialchars($_POST['message']);
    
    $mail->send();
    echo 'Le message a été envoyé.';
} catch (Exception $e) {
    echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
}
?>
