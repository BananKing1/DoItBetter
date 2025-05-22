<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="stylesheet.css" />
</head>

<body>
    
<div class="background-blur"></div> <!-- Blurred background -->
<div class="login-container">
    <form action="login.php" method="POST" class="login-form">
      <h2>Login</h2>
      <?php if(isset($_GET['error'])) { ?>
        <p class="error"> <?php echo $_GET['error']; ?></p>

      <?php } ?>
      
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      
      <button type="submit">Login</button>
    </form>
  </div>

</body>
</html>
