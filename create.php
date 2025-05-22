<?php
session_start();
include("db_connect.php"); 

if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $role = $_SESSION['role'] ?? 0;    

    if (isset($_POST['btnCreateUser'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $role = $_POST['role'];
    
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit();
        }
    
        $StrongPassword = md5($password);
    
        $sql = "INSERT INTO tbluser (username, password, name, role) VALUES ('$username', '$StrongPassword', '$name', '$role')";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            echo "";
        } else {
            echo "" . mysqli_error($conn);
        }
    }?>

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
        <div class="cube">
            <div class="form-container">
                <form action="create.php" method="POST" class="user-form">
                    <h2>Create User</h2>
                    <input type="text" name='name' placeholder="Full Name" required />
                    <input type="text" name='username' placeholder="Username" required />
                    <input type="password" name='password' placeholder="Password" required />
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
                    <select name="role">
                        <option value="100">Admin</option>
                        <option value="10">Underarbetare</option>
                    </select>

                    <input type="submit" name="btnCreateUser" id="btnLogout" value="Skapa användare">
                </form>
            </div>
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