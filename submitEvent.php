<?php
require('server.php');
$userId = $_SESSION['id'];

if($_POST['submit']){

    //gets all the info from the date and inserts into the database
    $eventTitle = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $eventColor = mysqli_real_escape_string($db, $_POST['color']);
    $start = mysqli_real_escape_string($db, $_POST['startday']);
    $end = mysqli_real_escape_string($db, $_POST['endday']);

    $eventQuery = "INSERT INTO `events` (`id`, `user_id`, `title`, `color`, `initialday`, `endday`, `description`) VALUES (NULL, '$userId', '$eventTitle', '$eventColor', '$start', '$end', '$description')";
    $resultEvent = mysqli_query($db, $eventQuery);

    header('location: index.php');
}

?>