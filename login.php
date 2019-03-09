<?php
include('server.php');
?>
<!--started server above here-->
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="loginRegister/style.css">

</head>
<body>
<!--login form-->
<form method="post" action="login.php">
  <div class="form-group loginWindow">
    <h2>Login</h2>
    <div class="loginPass">
        <input type="text" class="form-control" name="email" id="loginField" placeholder="Login" autofocus/>
    </div>
    <div class="loginPass">
        <input type="password" class="form-control" name="password" id="passwordField" placeholder="Password" />
    </div>
    <div>
        <button type="submit" name="login" class="btn btn-primary loginButton" disabled>Sign-in</button>
    </div>
    <div>
        <button type="button" class="btn btn-secondary registerButton" onclick="window.location = 'register.php';">Sign-up</button>
    </div>
  </div>
</form>
<!--loading js to block and enable buttons-->
<script src="loginRegister/main.js"></script>

</body>
</html>