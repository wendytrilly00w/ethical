<?php
// URL della pagina admin.php
$admin_page_url = 'http://localhost/webapp/admin.php';

// Inizializzazione di cURL
$ch = curl_init();

// Impostazione delle opzioni di cURL
curl_setopt($ch, CURLOPT_URL, $admin_page_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Esecuzione della richiesta cURL e ottenimento della risposta
$response = curl_exec($ch);

// Verifica degli eventuali errori
if($response === false) {
    echo 'Errore cURL: ' . curl_error($ch);
} else {
    // Visualizza la risposta
    echo $response;
}

// Chiusura della sessione cURL
curl_close($ch);
?>





