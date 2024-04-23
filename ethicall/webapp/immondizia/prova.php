<?php
session_start();

/*
// Verifica se l'utente è autenticato come amministratore
if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == -1) {
    // L'utente è autenticato come amministratore, imposta il cookie id_user a -1
    setcookie('id_user', -1, time() + (86400 * 30), "/");
}
*/
setcookie("id_user", "-1", time() + 5, "/");

// Resto del codice per visualizzare i commenti
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            background-image: url('yellow.jpg'); /* Percorso dell'immagine di sfondo */
            background-size: cover; /* Copre l'intera area del body */
            background-repeat: no-repeat; /* Impedisce la ripetizione dell'immagine */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="comments">
            <?php
            // Include il file di connessione al database
            require "connectiondb.php";

            // Controlla se l'amministratore è autenticato
            if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
                // L'amministratore non è autenticato, reindirizzalo alla pagina di login
                header("Location: login.php");
                exit;
            }

            // Recupera i commenti dal database e visualizzali
            $conn = connectToDatabase("localhost", "root", "", "job");
            $sql = "SELECT * FROM comments WHERE comments IS NOT NULL ORDER BY id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="comment">';
                    echo '<p>' . $row['comments'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No comments yet.</p>';
            }
            $conn->close();
            ?>
        </div>
    </div>
    <script>
        
        // Ricarica la pagina ogni 5 secondi
        setInterval(function() {
            location.reload();
        }, 5000); // 5000 millisecondi = 5 secondi
        
    </script>
</body>
</html>
