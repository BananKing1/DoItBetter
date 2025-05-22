<?php
session_start();
include "db_connect.php";

// Kontrollera inloggning
if(isset($_SESSION['id']) && isset($_SESSION['username'])){ 
    $username = $_SESSION['username'] ?? 0;
    $password = $_SESSION['password'] ?? 0;     
    $role = $_SESSION['role'] ?? 0;     
    $name = $_SESSION['name'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="vertical_align"></div>
            <img src="images/Logo.webp" alt="logo">
        
            <div class="filler"></div>
        
            <img src="images/Icons/task.png" alt="task" onclick="location.href='task.php'">
            <img src="images/Icons/home.png" alt="home" onclick="location.href='home.php'">
            <img src="images/Icons/bar-chart.png" alt="bar-chart" onclick="location.href='charts.php'">

            <div class="filler"></div>

            <img src="images/Icons/user.png" alt="user" onclick="location.href='Profile.php'">
        </div>
    </header>

    <div class="other">
        <?php                         
        if(intval($role) >= 10){ ?>
            <div class="cube">
            <img src="images/Icons/user.png" alt="user">
        <?php 
            echo "<h2>Din username: ". $username."</h2>";
            echo "<h2><br> Ditt namn: ".$name."</h2>";

            if(intval($role)==100){
                $rolename="Chef";
            }else{
                $rolename="Underarbetare";
        }            
            echo "<h2><br> Din position: ".$rolename."</h2>";
        }?>

    <br>
    <form action="logout.php" method="POST" class="login-form">
      <button type="submit">Logga ut</button>
    </form>

    <button onclick="location.href='create.php'"> Skapa användare</button>


    </div>
</div>
</body>
</html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>