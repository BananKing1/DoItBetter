<?php
session_start();  // Startar sessionen för att kunna använda $_SESSION-variabler

include "db_connect.php";  // Inkluderar filen som ansluter till databasen

// Kontrollera att användarnamn och lösenord skickats via POST
if (isset($_POST['username']) && isset($_POST['password'])) {
    
    // Funktion för att validera och sanera indata
    function validate($data) {
        $data = trim($data);           // Tar bort mellanslag i början och slutet
        $data = stripslashes($data);   // Tar bort backslashes
        $data = htmlspecialchars($data); // Konverterar specialtecken till HTML-entiteter
        return $data;
    }

    // Validera användarnamn och lösenord
    $username = validate($_POST['username']); 
    $password = validate(md5($_POST['password'])); // Krypterar lösenordet med md5 och validerar

    // Kontrollera om användarnamn är tomt
    if (empty($username)) {
        header("Location: index.php?error=User Name is required");  // Skicka tillbaka till login med felmeddelande
        exit();
    }

    // Kontrollera om lösenord är tomt
    if (empty($password)) {
        header("Location: index.php?error=Password is required");  // Skicka tillbaka till login med felmeddelande
        exit();
    }

    // Förbered SQL-fråga för att hämta användare med matchande användarnamn och lösenord
    $sql = "SELECT * FROM tbluser WHERE username=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);                      // Förbered frågan
    mysqli_stmt_bind_param($stmt, "ss", $username, $password); // Binda parametrar (string, string)
    mysqli_stmt_execute($stmt);                                // Kör frågan
    $result = mysqli_stmt_get_result($stmt);                   // Hämta resultatet

    // Kontrollera om exakt en användare hittades
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);                    // Hämta användardata
        // Jämför inmatade uppgifter med databasen
        if ($row['username'] === $username && $row['password'] === $password) {
            // Sätt session-variabler för inloggad användare
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role']; 
            header("Location: home.php");  // Skicka vidare till skyddad sida
            exit();
        } else {
            // Fel användarnamn eller lösenord
            header("Location: index.php?error=Incorrect User Name or Password");
            exit();
        }
    } else {
        // Ingen användare hittades med dessa uppgifter
        header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }

} else {
    // Om POST-data saknas, skicka tillbaka till login-sidan
    header("Location: index.php");
    exit();
}
?>
