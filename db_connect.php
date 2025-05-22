<?php
    // Databasanslutningsuppgifter
    $host = "localhost";   // Databasvärd, oftast localhost vid lokal utveckling
    $user = "root";        // Användarnamn för databasen
    $pass = "";            // Lösenord för databasen (tomt vid standard XAMPP)
    $db = "supportflowab"; // Namnet på databasen som ska användas

    // Skapar en anslutning till MySQL-databasen med hjälp av mysqli_connect
    $conn = mysqli_connect($host, $user, $pass, $db);

    // Kontrollera om anslutningen misslyckades
    if (!$conn) {
        echo "Connection Failed";  // Skriv ut felmeddelande om anslutningen inte gick igenom
    }
?>