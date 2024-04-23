<?php
// Avvia la sessione
session_start();

// Include il file di connessione al database
require "connectiondb.php";

// Ricevi i dati del modulo
$comment = $_POST['comments'];



// Recupera l'ID dell'utente dalla sessione
$id_user = $_SESSION['id_user'];


// Escape delle variabili per prevenire SQL injection
$comment = $conn->real_escape_string($comment);

// Query per inserire il commento nel database insieme all'ID dell'utente
$sql = "INSERT INTO comments (comments, id_user) VALUES ('$comment', '$id_user')";

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
    echo "Errore durante l'inserimento del commento: " . $conn->error;
}

$conn->close();
?>