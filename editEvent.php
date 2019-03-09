<?php
require('server.php');
$userId = $_SESSION['id'];


if($_POST['edit']){

    $oldTitle = mysqli_real_escape_string($db, $_POST['oldTitle']);
    $newTitle = mysqli_real_escape_string($db, $_POST['newTitle']);
    $newDesc = mysqli_real_escape_string($db, $_POST['newDescription']);
    $newColor = mysqli_real_escape_string($db, $_POST['newColor']);
    $newStart = mysqli_real_escape_string($db, $_POST['newSDay']);
    $newEnd = mysqli_real_escape_string($db, $_POST['newEDay']);

    $eventQuery = "UPDATE `events` SET `title` = '$newTitle', description = '$newDesc', color = '$newColor', 
    initialday = '$newStart', endday = '$newEnd' WHERE `user_id` = '$userId' and title = '$oldTitle'";
    $resultEvent = mysqli_query($db, $eventQuery);
    
    header('location: index.php');
}

?>