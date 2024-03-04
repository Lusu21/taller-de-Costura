<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="background-color: lightgray;">
    
<ul class="nav justify-content-end bg-secondary">
  <li class="nav-item">
    <a class="nav-link active text-white" aria-current="page" href="dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="Clientes.php">Clientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="productos.php">Productos</a>
  </li>
  <li class="nav-item">
    <a href="../logout.php" class="nav-link text-white" aria-disabled="true">Cerrar Sesion (<?php echo $_SESSION['nombre_usu'];?>)</a>
  </li>
</ul>

<div class="container text-center mt-5">
    <h1>Editar Clientes</h1>
</div>

<?php

$id_cli = base64_decode($_GET['id']);

$mysqli = new mysqli("localhost","root","","taller1bd");

$consulta_buscar = "SELECT * FROM clientes WHERE (id LIKE '$id_cli')";
$resultados_busqueda = $mysqli->query($consulta_buscar);
$filas_busqueda = $resultados_busqueda->fetch_assoc();

?>

<div class="container">
    <div class="card">
        <div class="card-body">

            <form action="editar2.php" method="POST">

                <!-- Agrega un campo oculto para el id_cli -->
                <input type="hidden" name="id_cli" value="<?php echo $id_cli; ?>">

                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <label for=""><b>Nombre</b></label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $filas_busqueda['nombre']?>" placeholder="Nombre" maxlength="50" required="">
                        </div>
                        <div class="col">
                            <label for=""><b>Apellido</b></label>
                            <input type="text" class="form-control" name="apellido" value="<?php echo $filas_busqueda['apellido']?>" placeholder="Apellido" maxlength="50" required="">
                        </div>
                    </div>
                </div>

                <div class="container text-center">
                    <div class="row">
                        <div class="col-4">
                            <label for=""><b>Cedula</b></label>
                            <input type="number" class="form-control" name="cedula" value="<?php echo $filas_busqueda['cedula']?>" placeholder="Cedula" maxlength="10" required="">
                        </div>
                        <div class="col">
                            <label for=""><b>Correo</b></label>
                            <input type="email" class="form-control" name="correo" value="<?php echo $filas_busqueda['correo']?>" placeholder="Correo" maxlength="40" required="">
                        </div>
                    </div>
                </div>

                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <label for=""><b>Telefono</b></label>
                            <input type="text" class="form-control" name="telefono" value="<?php echo $filas_busqueda['telefono']?>" placeholder="Telefono" maxlength="15" required="">
                        </div>
                    
                        <div class="text-center mt-5">
                            <a href="Clientes.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                            <button type="reset" class="btn btn-secondary">Borrar</button>
                            <button type="submit" class="btn btn-dark">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

