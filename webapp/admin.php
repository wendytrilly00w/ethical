



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
  
   

    <link rel="stylesheet" href="css/admin.css">
    <a href="logout.php">Logout</a>

  
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
        
        <div class="comments">+
        <?php
        // Include il file di connessione al database
        require "connectiondb.php";


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
