<?php 

include_once 'dbh.php';

// Inserting ID Task data
$taskID = $_GET['id'];

$removeTask = "DELETE FROM `tareas` WHERE `tareas`.`id` = $taskID;";

$insertedResult = mysqli_query($conn, $removeTask);

header("Location: ../index.php?task=removed");