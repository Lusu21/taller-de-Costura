<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body style= "background-color:lightgray">
    
<ul class="nav justify-content-end bg-secondary">
  <li class="nav-item">
    <a class="nav-link active text-white" aria-current="page" href="dashboard.php">Dashboard</a>
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
    <h1>Editar Producto</h1>
</div>

<?php

$id_pro = base64_decode($_GET['id']);

$mysqli = new mysqli("localhost","root","","taller1bd");

$consulta_buscar="SELECT*FROM productos WHERE (id LIKE '$id_pro')";
$resultados_busqueda=$mysqli->query($consulta_buscar);
$filas_busqueda=$resultados_busqueda->fetch_assoc();

?>

<div class="container">

<div class="card">
<div class="card-body">

<?php
  
  if ($resultados_busqueda->num_rows == 1){ 
?>

<form action="editar.php" method="POST">

    <div class="container text-center">
    <div class="row">
        <div class="col">
        <label for=""><b>Producto</b></label>
        <input type="text" class="form-control" name="producto_pro" value="<?php echo $filas_busqueda['producto']?>" placeholder="Nombre" maxlength="100" required="">
        </div>
        <div class="col">
        <label for=""><b>Descripcion</b></label>
        <input type="text" class="form-control" name="descripcion_pro" value="<?php echo $filas_busqueda['descripcion']?>" placeholder="Descripcion" maxlength="100" required="">
      </div>
        
    </div>
    </div>

    <div class="container text-center">
    <div class="row">
        <div class="col-4">
        <label for=""><b>Precio</b></label>
        <div class="input-group">
        <span class="input-group-text">$</span>
        <input type="number" class="form-control" name="precio_pro" value="<?php echo $filas_busqueda['precio']?>" placeholder="Precio" maxlength="20" required="">
        </div>
        </div>
        <div class="col">
        <label for=""><b>Stock</b></label>
        <input type="number" class="form-control" name="stock_pro" value="<?php echo $filas_busqueda['stock']?>" placeholder="Stock" maxlength="40" required="">
        </div>
        
    </div>
    </div>

    <div class="container text-center">
    <div class="row">
        <div class="col">
        <label for=""><b>Categoria</b></label>
        <input type="text" class="form-control" name="categoria_pro" value="<?php echo $filas_busqueda['categoria']?>" placeholder="Categoria" maxlength="50" required="">
        </div>
        
        <div class="text-center mt-5">
        <a href="productos.php"><button type= "button"class="btn btn-danger">Cancelar</button></a>
        <button type= "reset"class="btn btn-secondary">Borrar</button>
        <button type= "submit"class="btn btn-dark">Actualizar</button>
        </div>


        <input type= "hidden" name="id_pro" value="<?php echo $id_pro;?>">

</form>

<?php
}else{
  echo "No se encontro los resultados";
}
?>

    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>