<?php
// Inizializza la sessione
session_start();

// Distrugge tutte le variabili di sessione
$_SESSION = array(); // Svuota l'array delle sessioni

if (isset($_COOKIE['id_user'])) {
    unset($_COOKIE['id_user']); 
    setcookie('id_user', '', -1, '/'); 
} 
// Cancella il cookie di sessione
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
    
    
}

// Distrugge la sessione
session_destroy();




// Rigenera l'ID di sessione
session_regenerate_id(true);


// Reindirizza l'utente alla pagina di login o ad altre pagine
header("Location: login.php"); // Cambia "login.php" con il percorso della tua pagina di login





exit();




?>
