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
    // Vérifie si le formulaire a été soumis via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données du formulaire
        $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';

        // Vérifie si le champ "message" est vide
        if (empty($message)) {
            die("Erreur : Le champ message ne peut pas être vide.");
        }

        // Vérifie si le nom se termine par "Nor"
        if (preg_match('/Nor$/i', $name)) {
            die("Erreur : L'envoi du message est bloqué pour ce nom.");
        }

        // Configuration du serveur SMTP
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Désactiver le mode debug pour éviter les fuites d'informations sensibles
        $mail->isSMTP(); 
        $mail->Host = MAIL_HOST; 
        $mail->SMTPAuth = true;                                   
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD; 
        $mail->CharSet = 'UTF-8';
        $mail->SMTPSecure = MAIL_ENCRYPTION;            
        $mail->Port = MAIL_PORT;                                    

        // Configuration des destinataires
        $mail->setFrom($email, 'Formulaire de Contact');
        $mail->addAddress('varachasjulien@gmail.com', 'Julien Varachas');     

        // Contenu de l'email
        $mail->isHTML(true);                                
        $mail->Subject = 'Nouveau message du Portfolio';
        $mail->Body = 'Prénom: ' . htmlspecialchars($firstname) . 
                      '<br>Nom: ' . htmlspecialchars($name) . 
                      '<br>Email: ' . htmlspecialchars($email) . 
                      '<br>Message: ' . nl2br(htmlspecialchars($message));

        // Envoi de l'email
        if ($mail->send()) {
            echo 'Le message a été envoyé avec succès.';
        } else {
            echo 'Erreur : Une erreur s\'est produite lors de l\'envoi du message.';
        }
    } else {
        echo "Erreur : Aucune donnée n'a été soumise.";
    }
} catch (Exception $e) {
    echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
}
?>
