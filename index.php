<?php 
    include_once 'includes/dbh.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>David.do</title>
    <link rel="stylesheet" href="includes/style.css">
    <link rel="icon" type="image" href="includes/img/David animado.png">
</head>

<body>
    <section>
        <div id="home-title" class="d-flex justify-center align-baseline">
            <h1><a href="index.php" style="text-decoration:none; color:black;">David.do</a></h1><img src="includes/img/David animado.png" alt="Davidson">
        </div>
    </section>

    <div class="forms">

            <form method="GET" class="txt-center">
                    <label for="filtrar">Filtrar por fecha:</label>
                    <input type="datetime-local" name="filter">
                    <button type="submit"> filtrar </button>
            </form>

            <br>

                <form method="GET" class="txt-center">

                    <label>Filtrar entre fechas:</label>

                    <input type="datetime-local" name="fechaInicial">

                    <input type="datetime-local" name="fechaFinal">

                    <button type="submit"> filtrar </button>
            </form>
            
        
            <form action="includes/dbTask.php" class="margin-center submit-task" method="POST">
                <input id="search" type="search" name="addTask" placeholder="Inserta tu tarea aqui..." autofocus required >
                <button type="submit" name="submit">Enviar</button>
            </form>  
        
        
    </div>
     
    <section id="columns">
        <div class="row">

        <?php 

        // Showing data & queries
        $sql = "SELECT id, DATE(Fecha) AS Fecha, Tarea FROM tareas ORDER BY id DESC;";
        
        $currentDate = date('y-m-d');
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        
        // Check if there's any result
        if (!$resultCheck > 0) { 
            echo "<h2 class='txt-center'>No hay datos/tareas asignadas :(</h2>";

         }
         
        // Check if there's a filtered date
         elseif (isset($_GET['filter'])){

            // Queries and time formatting
            $filter = $_GET['filter'];

            $fDate = date("Y-m-d", strtotime($filter));

            $dateQuery = "SELECT id, DATE(Fecha) AS Fecha, Tarea FROM tareas WHERE DATE(Fecha) = '$fDate';";

            $dateResult = mysqli_query($conn, $dateQuery);

            $dateResultCheck = mysqli_num_rows($dateResult);

                // Check if there's a task for an specific date
                if (!$dateResultCheck > 0) { 
                    echo "<h2 class='txt-center'>No hay Tareas de este dia :( intenta buscar otra fecha </h2>";
                } else{ //Shows data in html
                    while ($row = mysqli_fetch_assoc($dateResult)) {
                        
                       echo "
                       <div class='column'>
                           <div class='d-flex justify-space-between'>
                           <h6>". $row['Fecha'] . "</h6>
                               <a class= 'x-button' href='includes/deleteTask.php?id=" . $row['id'] . "'>&#x2716;</a>
                           </div>
                           <ul>
                               <li>" . $row['Tarea'] . "</li>
                           </ul>
                       </div>";

                        }
                    }
                }

            elseif (isset($_GET['fechaInicial'])) {

                $fechaIni = $_GET['fechaInicial'];

                $fechaFinal = $_GET['fechaFinal'];

                $fIni = date("Y-m-d", strtotime($fechaIni));

                $fFinal = date("Y-m-d", strtotime($fechaFinal));

                $betweenQuery = "SELECT id, DATE(Fecha) AS Fecha, Tarea FROM tareas WHERE (DATE(Fecha) BETWEEN '$fIni' AND '$fFinal') ORDER BY id ASC;";

                $bdatesResult = mysqli_query($conn, $betweenQuery);

                $bdatesCheck = mysqli_num_rows($bdatesResult);

                if (!$bdatesCheck > 0) {
                    echo "<h2 class='txt-center'>No hay Tareas entre estos dias:( intenta buscar otras fechas </h2>";
                } else{
                    
                    while ($row = mysqli_fetch_assoc($bdatesResult)) {
                        
                        echo "
                        <div class='column'>
                            <div class='d-flex justify-space-between'>
                            <h6>". $row['Fecha'] . "</h6>
                                <a class= 'x-button' href='includes/deleteTask.php?id=" . $row['id'] . "'>&#x2716;</a>
                            </div>
                            <ul>
                                <li>" . $row['Tarea'] . "</li>
                            </ul>
                        </div>";
 
                            }
                        }
                }

         
         else{ 

             while ($row = mysqli_fetch_assoc($result)) {
                 if ($currentDate) {
                     # Si la fecha es hoy colocar fecha igual a Hoy
                 }
                echo "
                <div class='column'>
                    <div class='d-flex justify-space-between'>
                    <h6>". $row['Fecha'] . "</h6>
                        <a class= 'x-button' href='includes/deleteTask.php?id=" . $row['id'] . "'>&#x2716;</a>
                    </div>
                    <ul>
                        <li>" . $row['Tarea'] . "</li>
                    </ul>
                </div>";

            }

            
            
            
        ?>
           

    <?php /* Else statement end */ } ?>

    </section>

</body>

</html>