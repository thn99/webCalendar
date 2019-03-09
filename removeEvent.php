<?php
require('server.php');
$userId = $_SESSION['id'];

//receives data from the delete form based on the date name that the user wants to remove
if($_POST['delete']){

    $eventTitle = mysqli_real_escape_string($db, $_POST['title']);
    $eventQuery = "DELETE FROM `events` WHERE `title` = '$eventTitle' and `user_id` = '$userId'";
    $resultEvent = mysqli_query($db, $eventQuery);

    header('location: index.php');
}

?>