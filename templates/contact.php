<?php
require_once 'lib/security.php';

// Point d'entrée du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Vérification CSRF
        if (!verifyCSRFToken()) {
            throw new Exception('Accès non autorisé.');
        }

        // Vérification anti-spam
        if (isSpamSubmission()) {
            error_log("Tentative de spam détectée - IP: " . $_SERVER['REMOTE_ADDR']);
            throw new Exception("Trop de tentatives. Veuillez réessayer plus tard.");
        }

        // Nettoyage et validation des données
        $firstname = processName($_POST['firstname']);
        $name = processName($_POST['name']);
        $email = sanitizeUserInput($_POST['email']);
        $message = validateMessage($_POST['message']);

        // Validation email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format d'email invalide");
        }

        // Envoi de l'email
        $to = 'votre_email@example.com'; // Remplacez par votre email
        $subject = 'Nouveau message de contact';
        
        $email_body = "Nouveau message de contact :\n\n";
        $email_body .= "Prénom : " . $firstname . "\n";
        $email_body .= "Nom : " . $name . "\n";
        $email_body .= "Email : " . $email . "\n\n";
        $email_body .= "Message :\n" . $message . "\n";

        $headers = 'From: contact@votre-site.com' . "\r\n" .
                  'Reply-To: ' . $email . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();

        if (!mail($to, $subject, $email_body, $headers)) {
            throw new Exception("Erreur lors de l'envoi du message");
        }

        $_SESSION['form_success'] = "Message envoyé avec succès !";

    } catch (Exception $e) {
        $_SESSION['form_errors'] = [$e->getMessage()];
    }

    header('Location: contact.php');
    exit();
}

// Au chargement initial du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['form_time_start'] = time();
}

// Récupération des messages d'erreur/succès
$errors = $_SESSION['form_errors'] ?? [];
$success = $_SESSION['form_success'] ?? null;

// Nettoyage des messages
unset($_SESSION['form_errors']);
unset($_SESSION['form_success']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <!-- Vos styles CSS ici -->
</head>
<body>
    <h2 class="textCenter mb-5">CONTACT</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <p><?php echo htmlspecialchars($success); ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="contact.php" id="contactForm">
        <div class="row center">
            <div class="col-md-5 form">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="firstname" name="firstname" 
                           placeholder="Prénom" 
                           value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>"
                           required>
                    <label for="firstname" class="textToChange">Firstname</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" 
                           placeholder="Nom" 
                           value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                           required>
                    <label for="name" class="textToChange">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" 
                           placeholder="name@example.com" 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                           required>
                    <label for="email" class="textToChange">Email address</label>
                </div>
            </div>
            <div class="col-md-5">
                <textarea class="form-control textToChange" name="message" 
                          id="message" rows="8" 
                          required><?php 
                          echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : 'Leave a comment here...'; 
                          ?></textarea>
                <label for="message"></label>
            </div>
        </div>
        <div class="center">
            <?php addCSRFTokenToForm(); ?>
            <button type="submit" class="textToChange btn mt-3 mb-5 px-5">Submit</button>
        </div>
    </form>
</body>
</html>