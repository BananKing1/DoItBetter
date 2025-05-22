<?php 
session_start();
include "db_connect.php";

// Kontrollera inloggning
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $role = $_SESSION['role'] ?? 0;   
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
    <link href="https://fonts.googleapis.com/css2?family=Tienne:wght@400;700;900&display=swap" rel="stylesheet">
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
        Översikt på klarhanterade ärenden: <br>
        ____________________________________________________________
        <div class="chart">
            <canvas id="myChart"></canvas>
        </div>
    </div>

<script>
const ctx = document.getElementById('myChart');

fetch("get_chart_data.php")
.then((response) => response.json())
.then((data) => {
    createChart(data, 'bar')
})

function createChart(chartData, type){
    new Chart(ctx, {
        type: type,
        data: {
            labels: chartData.map(row=>row.date),
            datasets: [{
                label: '# Ärenden avklarade',
                data: chartData.map(row=>row.completed),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
</script>
</body>
</html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>