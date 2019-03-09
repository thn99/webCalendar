<?php
  include('server.php');
?>
<!--started server above here-->

<!DOCTYPE html>
<html>
<head>
  <!--Loading jquery, bootstrap and css file-->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="loginRegister/style.css">
</head>
<body>
<!--register form-->
<form method="post" action="register.php">
  <div class="form-group registerWindow">
    <h2>Register</h2>
    <div class="register">
        <input type="text" class="form-control" name="username" id="regName" placeholder="Name" autofocus />
    </div>
    <div class="register">
        <input type="text" class="form-control" name="email" id="regEmail" placeholder="E-mail" />
    </div>
    <div class="register">
        <input type="password" class="form-control" name="password_1" id="regPass" placeholder="Password" pattern=".{6,}" title="Password should have at least six characters" required/>
    </div>
    <div class="register">
        <input type="password" class="form-control" name="password_2" id="regConfirmPass" placeholder="Confirm password"  />
    </div>
    <div>
        <button type="submit" name="register" class="btn btn-primary finishRegisterButton" disabled >Register</button>
    </div>
    <div>
        <button type="button" class="btn btn-secondary Back" onclick="window.location = 'login.php'">Login</button>
    </div>
  </div>
</form>
</body>
<!--loading js to block and enable buttons-->
<script src="loginRegister/main.js"></script>
</html>