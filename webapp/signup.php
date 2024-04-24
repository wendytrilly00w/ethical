<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/signup.css">
    <style>
        body {
            background-image: url('a.jpg'); /* Percorso dell'immagine di sfondo */
            background-size: cover; /* Copre l'intera area del body */
            background-repeat: no-repeat; /* Impedisce la ripetizione dell'immagine */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Signup</h2>
    <form action="signup.php" method="post" enctype="multipart/form-data">
        <label for="name">Username:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <label for="photo">Upload Photo:</label><br>
        <input type="file" id="photo" name="photo" class="upload-btn">
        <input type="submit" value="Signup" name="signup">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
    <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include il file di connessione al database
require "connectiondb.php";

// Connessione al database
$conn = connectToDatabase("localhost", "root", "", "job");

// Gestione del modulo di registrazione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Verifica se è stata caricata un'immagine
    if(isset($_FILES['photo'])) {
        $file_name = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_size = $_FILES['photo']['size'];
        $file_error = $_FILES['photo']['error'];

        // Ottieni il tipo MIME del file
        $file_mime = $_FILES['photo']['type'];

        // Array dei tipi MIME consentiti
        $allowed_mime = array('image/jpeg', 'image/png', 'image/gif');

        // Controlla se non ci sono errori durante il caricamento del file
        if ($file_error === 0) {
            // Controlla se il tipo MIME del file è consentito
            if (in_array($file_mime, $allowed_mime)) {
                // Move l'immagine nella cartella di upload
                $file_destination = 'uploads/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {




                    // Query per inserire i dati del nuovo utente nel database
        $sql = "INSERT INTO users (name, email, password, photo) VALUES ('$username', '$email', '$password', '$file_name')";
        if ($conn->query($sql) === TRUE) {
             echo "<p>Registrazione avvenuta con successo!</p>";

        // Recupera l'ID dell'utente appena inserito nel database
         $new_user_id = $conn->insert_id;

            // Imposta il cookie con l'ID dell'utente
         setcookie('id_user', $new_user_id, time() + (86400 * 30), "/"); // Cookie valido per 30 giorni

    // Dopo che la registrazione è avvenuta con successo
    header("Location: homepage.html");

                        exit; // Assicura che il codice successivo non venga eseguito dopo il reindirizzamento

                    } else {
                        echo "<p class='error'>Errore durante la registrazione. Riprova più tardi.</p>";
                    }
                } else {
                    echo "<p class='error'>Si è verificato un errore durante il caricamento dell'immagine.</p>";
                }
            } else {
                echo "<p class='error'>Tipo di file non consentito. Sono consentiti solo file JPEG, PNG e GIF.</p>";
            }
        } else {
            echo "<p class='error'>Si è verificato un errore durante il caricamento del file.</p>";
        }
    }
}

// Chiusura della connessione al database
$conn->close();
?>

</div>
</body>
</html>



