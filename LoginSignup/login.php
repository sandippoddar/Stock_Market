<?php
require './LoginSignup/loginProcess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogIn</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
  <div class="container">
    <h1>LogIn Page</h1>
    <form action="/login" method="post">
      <div class="form-ele">
        <label for="emailUser">Enter Email Id here:</label>
        <input type="text" name="emailUser" placeholder="Username" id="emailUser">
      </div>
      <div class="form-ele">
        <label for="password">Enter Password here:</label>
        <input type="password" name="password" placeholder="Password" id="password">
      </div>
      <p class="SignIn">Dont Have account? <a href="/register">Create Account</a> Here</p>
      <input type="submit" value="Login" name="login">
    </form>
    <h1>
      <?php
        if (isset($_POST["login"]) && !$isSignup) {
          echo "Wrong Username or Password";
        }
      ?>
    </h1>
  </div>
</body>
</html>
