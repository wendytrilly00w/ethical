<?php
function connectToDatabase($servername, $username, $password, $dbname) {
    // Connessione al database
    $conn = new mysqli($servername, $username, $password, $dbname);
    //s$conn->set_charset("gbk");


    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    return $conn;
}

// Esempio di utilizzo della funzione
$servername = "localhost"; // Indirizzo del server MySQL
$username = "root"; // Nome utente del database
$password = ""; // Password del database
$dbname = "job"; // Nome del database

$conn = connectToDatabase($servername, $username, $password, $dbname);

?>
