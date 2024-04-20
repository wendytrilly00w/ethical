<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Avvia la sessione
session_start();

// Include il file di connessione al database
require "connectiondb.php";

// Verifica se il form è stato inviato tramite AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comments"])) {
    // Recupera il commento inviato dal modulo
    $comments = $_POST["comments"];

    // Verifica che il commento non sia vuoto
    if (!empty($comments)) {
        // Recupera l'ID dell'utente dalla sessione
        $id_user = $_SESSION['id_user'];

        // Escape delle variabili per prevenire SQL injection
        $comments = $conn->real_escape_string($comments);

        // Query per inserire il commento nel database insieme all'ID dell'utente
        $sql = "INSERT INTO comments (comments, id_user) VALUES ('$comments', '$id_user')";

        // Esegui la query
        if ($conn->query($sql) === TRUE) {
            // URL della pagina admin.php
            $admin_page_url = 'http://localhost/webapp/admin.php';

            // Inizializzazione di cURL
            $ch = curl_init();

            // Impostazione delle opzioni di cURL
            curl_setopt($ch, CURLOPT_URL, $admin_page_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Passaggio dei cookie alla richiesta cURL
            $cookies = array();
            foreach ($_COOKIE as $key => $value) {
                $cookies[] = $key . '=' . $value;
            }
            $cookies_string = implode('; ', $cookies);
            curl_setopt($ch, CURLOPT_COOKIE, $cookies_string);

            // Esecuzione della richiesta cURL
            $response = curl_exec($ch);
            
            // Verifica se ci sono stati errori durante la richiesta cURL
            if ($response === false) {
                echo "Errore cURL: " . curl_error($ch);
            } else {
                // Stampa un messaggio nel terminale del server
                echo "La pagina admin.php è stata aperta correttamente in background.";
            }
            
            // Chiusura della sessione cURL
            curl_close($ch);
            
            // Query per recuperare i commenti aggiornati dal database
            $sql = "SELECT * FROM comments WHERE comments IS NOT NULL ORDER BY id";
            $result = $conn->query($sql);

            // Costruisci l'HTML dei commenti aggiornati
            $html = "";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $html .= '<div class="comment">';
                    $html .= '<p>' . $row['comments'] . '</p>';
                    $html .= '</div>';
                }
            } else {
                $html .= '<p>No comments yet.</p>';
            }

            // Restituisci l'HTML dei commenti aggiornati come risposta
            echo $html;
        } else {
            // Restituisci un messaggio di errore se c'è un problema nell'inserimento del commento nel database
            echo "Errore durante l'inserimento del commento nel database: " . $conn->error;
        }

        // Chiudi la connessione al database
        $conn->close();
    } else {
        // Restituisci un messaggio di errore se il commento è vuoto
        echo "Il campo del commento è vuoto.";
    }
} else {
    // Restituisci un messaggio di errore se la richiesta non è stata inviata correttamente
    echo "Errore: richiesta non valida.";
}
?>