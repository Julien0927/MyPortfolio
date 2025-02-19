<?php

/* // Fonction pour générer un jeton CSRF
function generateCSRFToken() {
    try {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
} catch (Exception $e) {
    error_log('Erreur lors dela génération du token CSRF : ' . $e->getMessage());
}
}

// Fonction pour ajouter un champ CSRF à un formulaire
function addCSRFTokenToForm() {
    generateCSRFToken();
    if (!empty($_SESSION['csrf_token'])){
    echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
    }else {
        echo "Une erreur est survenue. Veuillez réessayer plus tard.";
    }
}
// Fonction pour vérifier le jeton CSRF
function verifyCSRFToken() {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        return true;
    }
    return false;
}

// Vérifier automatiquement le jeton CSRF pour chaque formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCSRFToken()) {
        die('Tentative d\'attaque CSRF détectée.');
    }
}

//Définition d'un gestionnaire d'erreur global
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
	echo "Nous sommes désolés, un problème vient de survenir :/ \nNous vous invitons à revenir plus tard." . PHP_EOL;
	if ($errno === E_WARNING)
		exit();
});
restore_error_handler();

//Définition d'un gestionnaire d'exception global
set_exception_handler(function(Exception $e){
	echo 'Une exception a été détectée. Nous mettons fin au programme.' .$e->getMessage() . PHP_EOL;
		exit();
});
restore_exception_handler();

// Fonction pour nettoyer les entrées utilisateur
function sanitizeUserInput($input) {
    if (is_string($input)) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    return $input;
}
// Nettoyer toutes les données POST
foreach ($_POST as $key => $value) {
    $_POST[$key] = sanitizeUserInput($value);
}

// Nettoyer toutes les données GET (si nécessaire)
foreach ($_GET as $key => $value) {
    $_GET[$key] = sanitizeUserInput($value);
}
 */

// Fonction pour générer un jeton CSRF
function generateCSRFToken() {
    try {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    } catch (Exception $e) {
        error_log('Erreur lors dela génération du token CSRF : ' . $e->getMessage());
    }
}

// Fonction pour ajouter un champ CSRF à un formulaire
function addCSRFTokenToForm() {
    generateCSRFToken();
    if (!empty($_SESSION['csrf_token'])) {
        echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
    } else {
        echo "Une erreur est survenue. Veuillez réessayer plus tard.";
    }
}

// Fonction pour vérifier le jeton CSRF
function verifyCSRFToken() {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        return true;
    }
    return false;
}

function validateName($name) {
    // Suppression des espaces en début et fin
    $name = trim($name);
    
    // Vérifications de base
    if (empty($name)) {
        return ['isValid' => false, 'error' => "Le nom ne peut pas être vide"];
    }

    // Longueur
    if (strlen($name) < 2 || strlen($name) > 50) {
        return ['isValid' => false, 'error' => "Le nom doit faire entre 2 et 50 caractères"];
    }

    // Regex plus stricte
    // - Commence et se termine par une lettre
    // - Autorise uniquement lettres, espaces, traits d'union et apostrophes
    // - Pas plus de 2 majuscules consécutives
    // - Pas plus de 2 lettres identiques consécutives
    if (!preg_match('/^[A-ZÀ-Ý](?!.*([A-ZÀ-Ý])\1{2})(?!.*(.)\2{2})[a-zà-ÿA-ZÀ-Ý\-\' ]+[a-zà-ÿ]$/ui', $name)) {
        return ['isValid' => false, 'error' => "Format de nom invalide"];
    }

    // Vérification du ratio de lettres
    $letterCount = preg_match_all('/[a-zà-ÿ]/ui', $name);
    $totalChars = strlen($name);
    
    if ($letterCount / $totalChars < 0.7) {
        return ['isValid' => false, 'error' => "Le nom doit contenir principalement des lettres"];
    }

    return ['isValid' => true, 'error' => null];
}
// Fonction améliorée pour nettoyer les entrées utilisateur
function sanitizeUserInput($input) {
    if (is_string($input)) {
        $input = trim($input);
        // Convertit les caractères spéciaux en entités HTML
        $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // Supprime les caractères invisibles
        $input = preg_replace('/[\x00-\x1F\x7F]/u', '', $input);
        return $input;
    }
    return $input;
}

// Fonction pour valider et nettoyer un nom/prénom
function processName($name) {
    $sanitizedName = sanitizeUserInput($name);
    $validation = validateName($sanitizedName);
    
    if (!$validation['isValid']) {
        throw new Exception($validation['error']);
    }
    
    return $sanitizedName;
}

// Vérifier automatiquement le jeton CSRF pour chaque formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCSRFToken()) {
        die('Tentative d\'attaque CSRF détectée.');
    }
}

// Nettoyer toutes les données POST
foreach ($_POST as $key => $value) {
    $_POST[$key] = sanitizeUserInput($value);
}

// Nettoyer toutes les données GET (si nécessaire)
foreach ($_GET as $key => $value) {
    $_GET[$key] = sanitizeUserInput($value);
}

//Définition d'un gestionnaire d'erreur global
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    echo "Nous sommes désolés, un problème vient de survenir :/ \nNous vous invitons à revenir plus tard." . PHP_EOL;
    if ($errno === E_WARNING)
        exit();
});
restore_error_handler();

//Définition d'un gestionnaire d'exception global
set_exception_handler(function(Exception $e){
    echo 'Une exception a été détectée. Nous mettons fin au programme.' .$e->getMessage() . PHP_EOL;
    exit();
});
restore_exception_handler();