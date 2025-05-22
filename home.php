<?php
session_start();
include "db_connect.php";

// Kontrollera inloggning
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $role = $_SESSION['role'] ?? 0;
    $id = $_SESSION['id'] ?? 0;

    
    // Hantera knapp "Påbörja" (btnStart)
    if(isset($_POST['btnStart'])) {
        $matter_id = $_POST['matter_id'];
    
        $sql = "UPDATE tblmatters SET status='ongoing', shared=$id, `update`=NOW() WHERE id=$matter_id";
        $result = mysqli_query($conn, $sql);
    
        if($result) {
            echo "Status uppdaterad!";
        } else {
            echo "Fel: " . mysqli_error($conn);
        }
    }

    if(isset($_POST['btnCreate'])){
        $matters = $_POST['matters'];
        $beskrivning = $_POST['beskrivning'];
        $status = $_POST['status'];
        $priority = $_POST['priority'];
        $rapport = $_POST['rapport'];
        $shared = $_POST['shared'];
        $contact = $_POST['contact'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO tblmatters(matters, beskrivning, status, priority, rapport, shared, contact, comment) VALUES ('$matters', '$beskrivning', '$status', '$priority', '$rapport', '$shared', '$contact', '$comment')";
        $result = mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
    <p class="message"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

    <header>
        <div class="vertical_align"></div>
            <img src="images/Logo.webp" alt="logo">
        
            <div class="filler"></div>
        
            <img src="images/Icons/task.png" alt="task" onclick="location.href='task.php'">
            <img src="images/Icons/home.png" alt="home" onclick="location.href='home.php'">
            <img src="images/Icons/bar-chart.png" alt="bar-chart" onclick="location.href='Charts.php'">

            <div class="filler"></div>

            <img src="images/Icons/user.png" alt="user" onclick="location.href='Profile.php'">
        </div>
    </header>

    <div class="rest">
<?php
    if(intval($role) == 100){ ?>
        Skapa ärenden: <br>
        ____________________________________________________________
        <form action="home.php" method="POST">
        <input type="text" name="matters" placeholder="Ärenden">
        <input type="text" name="beskrivning" placeholder="Beskrivning">
        <select name="status">
        <option value="open">Öppen</option>
        <option value="ongoing">Påbörjad</option>
        <option value="pending">Pausad</option>
        <option value="complete">Avslutad</option>
        </select>
        <select name="priority">
            <option value="critical">Kritisk</option>
            <option value="high">Hög</option>
            <option value="medium">Medium</option>
            <option value="low">Låg</option>
        </select>
        <input type="text" name="rapport" placeholder="Rapport">
        <input type="text" name="shared" placeholder="Dela">
        <input type="email" name="contact" placeholder="Kontakt">
        <input type="text" name="comment" placeholder="Kommentar">
        <input type="submit" name="btnCreate" value="Skapa ärenden">
    </form>
<?php } ?>
    
    ____________________________________________________________
    <br>Kritisk prioritering:
    <div class="box">
        <?php
        $sql = "SELECT * FROM tblmatters WHERE status='open' AND priority='critical' ORDER BY created DESC";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){ 
        ?>                    
                <div class="StatusUpdate">
                    <h2>Ärende: <?= htmlspecialchars($row['matters']) ?></h2>
                    <h2>Status: <?= htmlspecialchars($row['status']) ?></h2>
                    Av: <?= htmlspecialchars($row['rapport']) ?><br>                                    
                    Kontakt: <?= htmlspecialchars($row['contact']) ?><br>
                    Skapad: <?= htmlspecialchars($row['created']) ?><br>
                    Senast uppdaterad: <?= htmlspecialchars($row['update']) ?><br>
                    <h2>Beskrivning:</h2> <?= nl2br(htmlspecialchars($row['beskrivning'])) ?>
                    <div class="right">                                                
                        <form action="home.php" method="POST">
                            <input type="hidden" name="matter_id" value="<?= (int)$row['id'] ?>">
                            <input type="submit" name="btnStart" value="Påbörja">
                        </form>
                    </div>
                </div>       
        <?php
            }
        } else {
            echo "<p>Inga kritiska ärenden öppna just nu.</p>";
        }
        ?>
    </div>

    ____________________________________________________________
    <br>Hög prioritering:
    <div class="box">
        <?php
        $sql = "SELECT * FROM tblmatters WHERE status='open' AND priority='high' ORDER BY created DESC";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){ 
        ?>                    
                <div class="StatusUpdate">
                    <h2>Ärende: <?= htmlspecialchars($row['matters']) ?></h2>
                    <h2>Status: <?= htmlspecialchars($row['status']) ?></h2>
                    Av: <?= htmlspecialchars($row['rapport']) ?><br>                                    
                    Kontakt: <?= htmlspecialchars($row['contact']) ?><br>
                    Skapad: <?= htmlspecialchars($row['created']) ?><br>
                    Senast uppdaterad: <?= htmlspecialchars($row['update']) ?><br>
                    <h2>Beskrivning:</h2> <?= nl2br(htmlspecialchars($row['beskrivning'])) ?>
                    <div class="right">                                                
                        <form action="home.php" method="POST">
                            <input type="hidden" name="matter_id" value="<?= (int)$row['id'] ?>">
                            <input type="submit" name="btnStart" value="Påbörja">
                        </form>
                    </div>
                </div>       
        <?php
            }
        } else {
            echo "<p>Inga kritiska ärenden öppna just nu.</p>";
        }
        ?>
    </div>

    ____________________________________________________________
    <br>Medel prioritering:
    <div class="box">
        <?php
        $sql = "SELECT * FROM tblmatters WHERE status='open' AND priority='medium' ORDER BY created DESC";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){ 
        ?>                    
                <div class="StatusUpdate">
                    <h2>Ärende: <?= htmlspecialchars($row['matters']) ?></h2>
                    <h2>Status: <?= htmlspecialchars($row['status']) ?></h2>
                    Av: <?= htmlspecialchars($row['rapport']) ?><br>                                    
                    Kontakt: <?= htmlspecialchars($row['contact']) ?><br>
                    Skapad: <?= htmlspecialchars($row['created']) ?><br>
                    Senast uppdaterad: <?= htmlspecialchars($row['update']) ?><br>
                    <h2>Beskrivning:</h2> <?= nl2br(htmlspecialchars($row['beskrivning'])) ?>
                    <div class="right">                                                
                        <form action="home.php" method="POST">
                            <input type="hidden" name="matter_id" value="<?= (int)$row['id'] ?>">
                            <input type="submit" name="btnStart" value="Påbörja">
                        </form>
                    </div>
                </div>       
        <?php
            }
        } else {
            echo "<p>Inga kritiska ärenden öppna just nu.</p>";
        }
        ?>
    </div>

    ____________________________________________________________
    <br>Låg prioritering:
    <div class="box">
        <?php
        $sql = "SELECT * FROM tblmatters WHERE status='open' AND priority='low' ORDER BY created DESC";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){ 
        ?>                    
                <div class="StatusUpdate">
                    <h2>Ärende: <?= htmlspecialchars($row['matters']) ?></h2>
                    <h2>Status: <?= htmlspecialchars($row['status']) ?></h2>
                    Av: <?= htmlspecialchars($row['rapport']) ?><br>                                    
                    Kontakt: <?= htmlspecialchars($row['contact']) ?><br>
                    Skapad: <?= htmlspecialchars($row['created']) ?><br>
                    Senast uppdaterad: <?= htmlspecialchars($row['update']) ?><br>
                    <h2>Beskrivning:</h2> <?= nl2br(htmlspecialchars($row['beskrivning'])) ?>
                    <div class="right">                                                
                        <form action="home.php" method="POST">
                            <input type="hidden" name="matter_id" value="<?= (int)$row['id'] ?>">
                            <input type="submit" name="btnStart" value="Påbörja">
                        </form>
                    </div>
                </div>       
        <?php
            }
        } else {
            echo "<p>Inga kritiska ärenden öppna just nu.</p>";
        }
        ?>
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
