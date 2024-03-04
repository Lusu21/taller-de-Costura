<?php 
session_start();

$mysqli = new mysqli("localhost","root","","taller1bd");
$consulta="SELECT * FROM productos";
$resultados = $mysqli->query($consulta);
$filas=$resultados->fetch_all(MYSQLI_ASSOC);

if(isset($_POST['busqueda'])){
    $termino_busqueda=$mysqli->real_escape_string($_POST['busqueda']);

    $consulta_buscar="SELECT * FROM productos WHERE (id LIKE '%$termino_busqueda%') OR (producto LIKE '%$termino_busqueda%') OR (descripcion LIKE '%$termino_busqueda%') OR (precio LIKE '%$termino_busqueda%') OR (categoria LIKE '%$termino_busqueda%')";
    $resultados_busqueda=$mysqli->query($consulta_buscar);
    $filas_busqueda=$resultados_busqueda->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body style="background-color: lightgray;">

<ul class="nav justify-content-end bg-secondary">
  <li class="nav-item">
  <a class="nav-link active text-white" aria-current="page" href="dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item">
  <a class="nav-link active text-white" aria-current="page" href="Clientes.php">Clientes</a>
  </li>
  <li class="nav-item">
  <a class="nav-link active text-white" aria-current="page" href="Productos.php">Productos</a>
  </li>
  <li class="nav-item">
    <a href="../logout.php" class="nav-link active text-white" aria-current="page">Cerrar Sesion(<?php echo $_SESSION['nombre_usu'];?>)</b></a>
  </li>
</ul>

<div class="container text-center mt-5">
    <h1>Listado de Productos en Stock</h1>
</div>

<div class="container">
  <div class="card">
     <div class="card-header">

    <div class="container text-center">
      <div class="row">
        <div class="col">
          <a href="agregar_producto.php"><button class="btn btn-dark"> Agregar Producto</button></a>
        </div>
        <div class="col">
        <form action="Productos.php" method="POST">
          <div class="input-group mb-2">
            <input type="text" name="busqueda" class="form-control" placeholder="Escribe para buscar" aria-describedby="basic-addon1">
            <button type="submit" class="btn btn-primary">Buscar</button>
            &nbsp;
            <a href="Productos.php"><button class="btn btn-secondary">Reset</button></a>
          </div>
        </form>
        </div>
        <div class="col">
          <a href="pdf_productos.php" target="_blank"><button class="btn btn-danger">Descargar PDF</button></a>
        </div>
      </div>
    </div>
    <div class="container text-center">
    <?php
      if(isset($_POST['busqueda'])){
     ?>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      <?php
      echo "Resultado de búsqueda para: ".$_POST['busqueda'];
     ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
    <?php
    }
    ?>
    </div>
     </div>
     <div class="card-body table-scroll">
        <table class="table table-ms text-center">
        <thead>
              <tr class="bg-secondary text-white">
              <th class="bg-secondary text-white">#</th>
              <th class="bg-secondary text-white">PRODUCTO</th>
              <th class="bg-secondary text-white">DESCRIPCION</th>
              <th class="bg-secondary text-white">PRECIO</th>
              <th class="bg-secondary text-white">EN STOCK</th>
              <th class="bg-secondary text-white">CATEGORIA</th>
              <th class="bg-secondary text-white">ACCIONES</th>
              </tr>
            </thead>
          
          <tbody>

          <?php 
          
          if(isset($_POST['busqueda'])){
            
            $num=1;
            foreach($filas_busqueda as $fila_busqueda){
          ?>
          <tr>
            <td><?php echo $num++;?></td>
            <td><?php echo $fila_busqueda["producto"];?></td>
            <td><?php echo $fila_busqueda["descripcion"];?></td>
            <td><?php echo '$' . number_format($fila_busqueda["precio"], 2);?></td>
            <td><?php echo $fila_busqueda["stock"];?></td>
            <td><?php echo $fila_busqueda["categoria"];?></td>
            <td>
                <a href="editarp.php?id=<?php echo base64_encode($fila_busqueda['id']);?>" class="btn btn-warning">Editar</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_eliminar_<?php echo $fila_busqueda['id'];?>">Eliminar</button>
                <!-- Modal -->
                <div class="modal fade" id="modal_eliminar_<?php echo $fila_busqueda['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar producto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>¿Seguro que quiere eliminar el producto <?php echo $fila_busqueda['producto'];?>?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <a href="borrar_pro.php?id=<?php echo base64_encode($fila_busqueda['id']);?>" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
          </tr>
          <?php    
            }
          }else{
            
            $num=1;
            foreach($filas as $fila){
          ?>
          <tr>
            <td><?php echo $num++;?></td>
            <td><?php echo $fila["producto"];?></td>
            <td><?php echo $fila["descripcion"];?></td>
            <td><?php echo '$' . number_format($fila["precio"], 2);?></td>
            <td><?php echo $fila["stock"];?></td>
            <td><?php echo $fila["categoria"];?></td>
            <td>
                <a href="editarp.php?id=<?php echo base64_encode($fila['id']);?>" class="btn btn-warning">Editar</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_eliminar_<?php echo $fila['id'];?>">Eliminar</button>
                <!-- Modal -->
                <div class="modal fade" id="modal_eliminar_<?php echo $fila['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Producto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>¿Seguro que quiere eliminar el producto <?php echo $fila['producto'];?>?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <a href="borrar_pro.php?id=<?php echo base64_encode($fila['id']);?>" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
          </tr>
          <?php    
            }

          }

          ?>
          </tbody>
        </table>
      </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
