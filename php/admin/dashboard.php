<?php
session_start();

$mysqli = new mysqli("localhost","root","","taller1bd");

$consulta = "SELECT*FROM clientes";
$resultados = $mysqli->query($consulta);
$filas = $resultados->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Iniciar Sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body style="background-color:lightgray">
    
<ul class="nav justify-content-end bg-secondary">
  <li class="nav-item">
    <a class="nav-link active text-white" aria-current="page" href="#">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="Clientes.php">Clientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="Productos.php">Productos</a>
  </li>
  <li class="nav-item">
    <a href="../logout.php" class="nav-link text-white" aria-disabled="true">Cerrar Sesion (<?php echo $_SESSION['nombre_usu'];?>)</a>
  </li>
</ul>

<div class="container text-center mt-5">
    <h1>Bienvenido <?php echo $_SESSION['nombre_usu'];?></h1>
</div>


            <div class="container text-center">
            <div class="row">
                <div class="col">
                <div class="container-fluid d-flex align-items-center justify-content-center"style="height:50vh;">

            <div class="card" style="width: 18rem;">
                <div class="card-header text-center fs-4 bg-warning text-white">Nuestros Clientes BD</div>
            <div class="card-body bg-warning">

            <h1>
                <?php echo count($filas);?>
            </h1>

                    </div>
                        </div>

                        </div>
             </div>
                <div class="col">
                <div class="container-fluid d-flex align-items-center justify-content-center"style="height:50vh;">

            <div class="card" style="width: 18rem;">
                <div class="card-header text-center fs-4 bg-warning text-white">Productos Disponibles</div>
            <div class="card-body bg-warning">


            <h1>
              3
            </h1>

                </div>
                    </div>
                        </div>
                                </div>
                                        </div> 
                                                </div>
                                                        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>