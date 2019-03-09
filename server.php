<?php
session_start();


$username = "";
$email = "";
$errors = array();

//connect to database
$db = mysqli_connect('localhost', 'root', '', 'calendar');


//check form input
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if(count($errors) == 0){
        //encrypt password (really basic encryption)
        $password = md5($password_1);
        //Register user into the database and
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        mysqli_query($db, $sql);
        $_SESSION['username'] = $username;
        header('location: login.php');
    }
}

//also check form input
if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
    $query = "SELECT id FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($db, $query);

    //gets current user id and user name
    while ($sql2 = mysqli_fetch_array($result)) {
        $userId = $sql2['id'];
        $loggedName = $sql2['username'];
    }
    echo $userId;

    //if returns true, login
    if(mysqli_num_rows($result) == 1){
        $_SESSION['id'] = $userId;
        $_SESSION['username'] = $email;
        header('location: index.php');
    }

    else{
        //logout
        array_push($errors, "Wrong email or password");
        header('location: login.php');
    }
    

}

//logout button
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}

?>