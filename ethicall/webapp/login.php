
<?PHP session_start(); 
if (isset($_COOKIE['id_user']) && $_COOKIE['id_user'] == -1) {
    // Reindirizza direttamente alla pagina admin.php
    header("Location: admin.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">

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
    <h2>Login</h2>
    
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        
       
        <input type="submit" value="Login" name="login">
        <p>Don't have an account? <a href="signup.php">Signup here</a></p>

   
    
        <p><img src="./captcha.php" /></p>
          <label>CAPTCHA <input type="text" name="captcha" /><br><br> 
            <input type="submit" name="submit">

    </form>
    <?php
  
 
require "connectiondb.php";

require_once 'config.php';


// Richiama la funzione connectionToDatabase per connetterti al database
$conn = connectToDatabase("localhost", "root", "", "job");

// Verifica delle credenziali e altre operazioni necessarie

        // Verifica delle credenziali
    if (isset($_POST['login'])) {
     
   // $username = $conn->real_escape_string($_POST['username']);
    //$password = $conn->real_escape_string($_POST['password']);
    //$password = hash('sha256',$_POST['password']);

    $username =($_POST['username']);
    $password = ($_POST['password']);

        }
    if (!empty($username) && !empty($password)) {

        if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
            setcookie('id_user', -1, time() + (86400 * 30), "/"); // Cookie valido per 30 giorni
            header("Location: admin.php");
        }

        

            // Query per verificare le credenziali e recuperare i dati dell'utente
            $sql = "SELECT * FROM users where name ='$username' AND password='$password' ";
            echo "<p>Query eseguita: $sql</p>"; // Stampa la query SQL
            $result = $conn->query($sql); //memorizza il risultato della query nella variabile $result.

            // Verifica dei risultati della query
            if ($result->num_rows > 0) {   //Se la query restituisce almeno una riga di risultato (ovvero se le credenziali sono corrette), viene avviata una sessione utilizzando session_start()


                 // Avvia la sessione
        //session_start();

        // Recupera l'ID dell'utente dalla riga restituita dalla query
        $row = $result->fetch_assoc();
        $id_user = $row['id'];

        // Memorizza l'ID dell'utente nella sessione
        $_SESSION['id_user'] = $id_user;


        // Imposta il cookie con l'ID dell'utente
        setcookie('id_user', $id_user, time() + (86400 * 30), "/"); // Cookie valido per 30 giorni


        

            // Mostra i dati dell'utente nella pagina HTML
               echo "<p>Login effettuato con successo!</p>";
                

                // Mostra i dati dell'utente nella pagina HTML
                echo "<p>Login effettuato con successo!</p>";
                //echo "<p>Benvenuto, $name!</p>"; // Utilizza la variabile $name invece di $username
                header("Location: homepage.html");
                exit; // Assicura che il codice successivo non venga eseguito dopo il reindirizzamento
            
            } else {
                // Credenziali errate, visualizza un messaggio di errore
                echo "<p class='error'>Username o password errati. Riprova.</p>";
            }
        }

        // Chiusura della connessione
        $conn->close();
    ?>
</div>
</body>
</html>
