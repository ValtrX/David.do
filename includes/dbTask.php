<?php 

include_once 'dbh.php';

// Inserting Task data
$task = $_POST['addTask'];

$insertSql = "INSERT INTO tareas (id, Tarea, Fecha) VALUES (NULL, '$task', current_timestamp());";
$insertedResult = mysqli_query($conn, $insertSql);



header("Location: ../index.php?task=success");