<?php
// Includi il file di configurazione delle credenziali
require_once 'config.php';

// Verifica se l'amministratore è già loggato
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == -1) {
    // L'amministratore è già loggato, reindirizza direttamente alla pagina admin.php
    header("Location: admin.php");
    exit;
}

// Verifica le credenziali dell'amministratore
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verifica se le credenziali corrispondono a quelle dell'amministratore
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        // Login dell'amministratore riuscito, imposta la sessione e il cookie
        $_SESSION['id_user'] = -1;
        setcookie('id_user', -1, time() + (86400 * 30), "/"); // Cookie valido per 30 giorni

        // Reindirizza alla pagina admin.php
        header("Location: admin.php");
        exit;
    } else {
        // Credenziali errate, reindirizza alla pagina di login con un messaggio di errore
        header("Location: login.php?error=1");
        exit;
    }
} else {
    // Richiesta GET o dati di login mancanti, reindirizza alla pagina di login
    header("Location: login.php");
    exit;
}
?>
