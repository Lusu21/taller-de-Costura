<?php
$mysqli = new mysqli("localhost", "root", "", "taller1bd");

$id_cli = $_POST['id_cli'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$edicion = "UPDATE clientes SET
    nombre = '$nombre',
    apellido = '$apellido',
    cedula = '$cedula',
    telefono = '$telefono',
    correo = '$correo'
    WHERE id = $id_cli";

$resultado = $mysqli->query($edicion);

if ($resultado) {
    echo '<script>alert("Cliente actualizado con éxito");window.location.href="Clientes.php";</script>';
} else {
    echo '<script>alert("Hubo un error al actualizar los datos");window.location.href="Clientes.php";</script>';
}

$mysqli->close();
?>
