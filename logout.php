<?php 
session_start(); 
// Startar sessionen, behövs för att kunna hantera och ändra sessionens data

session_unset(); 
// Tar bort alla variabler från sessionen (raderar sessionens innehåll)

session_destroy(); 
// Förstör själva sessionen, så att den inte längre är giltig

header("Location: index.php"); 
// Omdirigerar användaren tillbaka till index.php (t.ex. inloggningssidan)
?>