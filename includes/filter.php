<?php 

include_once 'dbh.php';

$filter = $_GET['filter'];

$filterDate = "SELECT * FROM tareas WHERE DATE(Fecha) = $filter;";

$sqlfilter = mysqli_query($conn, $filterDate);

header("Location: ../index.php?filtered=success");