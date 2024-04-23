<?php
// URL dell'endpoint di login
$login_url = 'http://localhost/ethical-main/webapp/login.php';

// Dati di accesso dell'admin
$username = 'admin';
$password = 'password';

// Dati da inviare al server
$data = array(
    'username' => $username,
    'password' => $password
);

// Inizializza cURL
$ch = curl_init($login_url);

// Imposta le opzioni di cURL
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Esegue la richiesta e ottiene la risposta
$response = curl_exec($ch);

// Verifica lo stato della richiesta
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Chiude la connessione cURL
curl_close($ch);

// Verifica se il login è riuscito
if ($http_status == 200) {
    echo "Login effettuato con successo!";
} else {
    echo "Errore durante il login.";
}
?>
