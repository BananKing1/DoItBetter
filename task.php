<?php 
session_start();
include "db_connect.php";

// Kontrollera inloggning
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $id = intval($_SESSION['id']); // Gör $id till int, ifall någon injicerar

    if(isset($_POST['btnEnd'])) {
        $matter_id = $_POST['matter_id'];
    
        $sql = "UPDATE tblmatters SET status='complete', shared=$id, `update`=NOW() WHERE id=$matter_id";
        $result = mysqli_query($conn, $sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tienne:wght@400;700;900&display=swap" rel="style">
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

            <img src="images/Icons/user.png" alt="user" onclick="location.href='profile.php'">
        </div>
    </header>

    <div class="rest">
    Personliga ärenden <br>

    <br><br> Kritisk prioritering:
    <br>____________________________________________________________
        <div class="box">
        <?php
            $sql = "SELECT * FROM tblmatters WHERE status='ongoing' AND shared=$id AND priority='critical' ORDER BY created DESC";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){ 
            ?>                    
            <div class="StatusUpdate">
                <h2>Ärende: <?=$row['matters']?></h2>
                <h2>Status: <?=$row['status']?></h2>
                Av: <?=$row['rapport']?><br>
                Kontakt: <?=$row['contact']?><br>
                Skapad: <?=$row['created']?><br>
                Senast uppdaterad: <?=$row['update']?><br>
                <h2>Beskrivning:</h2> <?=$row['beskrivning']?>
                <div class="right">                                        
                    <form action="task.php" method="POST">
                        <input type="hidden" name="matter_id" value="<?=$row['id']?>">
                        <input type="submit" name="btnEnd" value="Slutföra">
                    </form>
                </div> 
            </div>       
            <?php }?>
        </div> 
    
        
    <br><br> Hög prioritering:
    <br>____________________________________________________________
        <div class="box">
        <?php
            $sql = "SELECT * FROM tblmatters WHERE status='ongoing' AND shared=$id AND priority='high' ORDER BY created DESC";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){ 
            ?>                    
            <div class="StatusUpdate">
                <h2>Ärende: <?=$row['matters']?></h2>
                <h2>Status: <?=$row['status']?></h2>
                Av: <?=$row['rapport']?><br>
                Kontakt: <?=$row['contact']?><br>
                Skapad: <?=$row['created']?><br>
                Senast uppdaterad: <?=$row['update']?><br>
                <h2>Beskrivning:</h2> <?=$row['beskrivning']?>
                <div class="right">                                        
                    <form action="task.php" method="POST">
                        <input type="hidden" name="matter_id" value="<?=$row['id']?>">
                        <input type="submit" name="btnEnd" value="Slutföra">
                    </form>
                </div> 
            </div>       
            <?php }?>
        </div> 

        
    <br><br> Medium prioritering:
    <br>____________________________________________________________
        <div class="box">
        <?php
            $sql = "SELECT * FROM tblmatters WHERE status='ongoing' AND shared=$id AND priority='medium' ORDER BY created DESC";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){ 
            ?>                    
            <div class="StatusUpdate">
                <h2>Ärende: <?=$row['matters']?></h2>
                <h2>Status: <?=$row['status']?></h2>
                Av: <?=$row['rapport']?><br>
                Kontakt: <?=$row['contact']?><br>
                Skapad: <?=$row['created']?><br>
                Senast uppdaterad: <?=$row['update']?><br>
                <h2>Beskrivning:</h2> <?=$row['beskrivning']?>
                <div class="right">                                        
                    <form action="task.php" method="POST">
                        <input type="hidden" name="matter_id" value="<?=$row['id']?>">
                        <input type="submit" name="btnEnd" value="Slutföra">
                    </form>
                </div> 
            </div>       
            <?php }?>
        </div> 

        
    <br><br> Låg prioritering:
    <br>____________________________________________________________
        <div class="box">
        <?php
            $sql = "SELECT * FROM tblmatters WHERE status='ongoing' AND shared=$id AND priority='low' ORDER BY created DESC";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){ 
            ?>                    
            <div class="StatusUpdate">
                <h2>Ärende: <?=$row['matters']?></h2>
                <h2>Status: <?=$row['status']?></h2>
                Av: <?=$row['rapport']?><br>
                Kontakt: <?=$row['contact']?><br>
                Skapad: <?=$row['created']?><br>
                Senast uppdaterad: <?=$row['update']?><br>
                <h2>Beskrivning:</h2> <?=$row['beskrivning']?>
                <div class="right">                                        
                    <form action="task.php" method="POST">
                        <input type="hidden" name="matter_id" value="<?=$row['id']?>">
                        <input type="submit" name="btnEnd" value="Slutföra">
                    </form>
                </div> 
            </div>       
            <?php }?>
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