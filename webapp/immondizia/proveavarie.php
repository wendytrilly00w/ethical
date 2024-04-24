<?php
// URL di destinazione
$url = 'https://go81ykihust0bz507ypnyml3ouulii67.oastify.com';

// Cookie da inviare
$cookie = 'is_admin=-1';

// Inizializza una sessione cURL
$curl = curl_init();

// Imposta l'URL e altre opzioni
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookie);

// Esegui la richiesta, ottieni la risposta e gestisci eventuali errori
$response = curl_exec($curl);
if($response === false) {
    $error = curl_error($curl);
    echo "Errore cURL: " . $error;
}

// Chiudi la sessione cURL
curl_close($curl);

// Fai qualcosa con la risposta, ad esempio stampala
echo $response;
?>
