<?php
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
