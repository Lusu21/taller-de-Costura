<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "taller1bd");

$consulta = "SELECT * FROM clientes";
$resultados = $mysqli->query($consulta);
$filas = $resultados->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['busqueda'])) {
    $termino_busqueda = $mysqli->real_escape_string($_POST['busqueda']);

    $consulta_buscar = "SELECT * FROM clientes WHERE (id LIKE '%$termino_busqueda%') OR (nombre LIKE '%$termino_busqueda%') OR (apellido LIKE '%$termino_busqueda%') OR (cedula LIKE '%$termino_busqueda%') OR (telefono LIKE '%$termino_busqueda%') OR (correo LIKE '%$termino_busqueda%')";
    $resultados_busqueda = $mysqli->query($consulta_buscar);
    $filas_busqueda = $resultados_busqueda->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background-color:lightgray">

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
            <a href="../logout.php" class="nav-link text-white" aria-disabled="true">Cerrar Sesion (<?php echo $_SESSION['nombre_usu']; ?>)</a>
        </li>
    </ul>

    <div class="container text-center mt-5">
        <h1>Lista de Clientes</h1>
    </div>

    <div class="container">

        <div class="card">
            <div class="card-header">

                <div class="container text-center mt-3">
                    <div class="row">
                        <div class="col">
                            <a href="agregar_cliente.php"><button class="btn btn-dark">Agregar Cliente</button></a>
                        </div>
                        <div class="col">
                            <form action="Clientes.php" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" name="busqueda" class="form-control" placeholder="Escribe para buscar" aria-label="Username" aria-describedby="basic-addon1">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                    &nbsp;
                                    <a href="Clientes.php"><button class="btn btn-secondary">Reset</button></a>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <a href="pdf_clientes.php" target="_blank"><button class="btn btn-danger">Descargar PDF</button></a>
                        </div>
                    </div>
                </form>
                <div class="container text-center">
                    <?php
                    if (isset($_POST['busqueda'])) {
                    ?>

                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <?php
                            echo "Resultado de búsqueda para: " . $_POST['busqueda'];
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
                            <th class="bg-secondary text-white">NOMBRE</th>
                            <th class="bg-secondary text-white">APELLIDO</th>
                            <th class="bg-secondary text-white">CEDULA</th>
                            <th class="bg-secondary text-white">TELEFONO</th>
                            <th class="bg-secondary text-white">CORREO</th>
                            <th class="bg-secondary text-white">ACCIONES</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $num = 1;
                        $resultados_mostrar = isset($filas_busqueda) ? $filas_busqueda : $filas;

                        foreach ($resultados_mostrar as $fila) {
                        ?>

                            <tr>
                                <td><?php echo $fila['id']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['apellido']; ?></td>
                                <td><?php echo $fila['cedula']; ?></td>
                                <td><?php echo $fila['telefono']; ?></td>
                                <td><?php echo $fila['correo']; ?></td>
                                <td>
                                    <a href="editarcl.php?id=<?php echo base64_encode($fila['id']); ?>"><button type="button" class="btn btn-warning">Editar</Button></a>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_eliminar_<?php echo $fila['id']; ?>">Eliminar</Button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal_eliminar_<?php echo $fila['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Cliente</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <h4>¿Seguro de que desea eliminar al cliente <?php echo $fila['nombre'] . ' ' . $fila['apellido'];?>?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <a href="borrar_cli.php?id=<?php echo base64_encode($fila['id']); ?>" class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php
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
