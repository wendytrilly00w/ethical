<?php
// Avvia la sessione
session_start();

// Include il file di connessione al database
require "connectiondb.php";


if (!isset($_SESSION['id_user']) || is_null($_SESSION['id_user'])) {

    header('Location: signup.php');
    exit; // Assicurati di terminare lo script dopo aver reindirizzato l'utente
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="stylesheet" href="commenti.css">
    <style>
        body {
            background-image: url('vr.jpg'); /* Percorso dell'immagine di sfondo */
            background-size: cover; /* Copre l'intera area del body */
            background-repeat: no-repeat; /* Impedisce la ripetizione dell'immagine */
        }
    </style>



    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
$(document).ready(function(){
    // Quando il modulo viene inviato
    $("form").submit(function(event){
        // Evita il comportamento predefinito del modulo
        event.preventDefault();
        
        // Invia i dati del modulo utilizzando AJAX
        $.ajax({
            url: "submit_comment.php",
            type: "post",
            data: $(this).serialize(), // Serializza i dati del modulo
            success: function(response){
                // Se l'inserimento del commento ha avuto successo, aggiorna i commenti
                $(".comments").html(response);
                
            }
        }); 
    });
});
</script>






</head>
<body>
    <div class="container">
        <h2>Leave a Comment</h2>
        <form>
            <textarea name="comments" placeholder="Write your comment here..." required></textarea><br>
            <input type="submit" value="Submit Comment">
        </form>
        <h2>Comments</h2>
        <div class="comments">
            <?php



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
</body>
</html>
