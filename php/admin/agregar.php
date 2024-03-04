<?php

$mysqli = new mysqli("localhost","root","","taller1bd");

$nombre_cli = $_POST['nombre_cli'];
$apellido_cli = $_POST['apellido_cli'];
$cedula_cli = $_POST['cedula_cli'];
$correo_cli = $_POST['correo_cli'];
$telefono_cli = $_POST['telefono_cli'];

if (isset($nombre_cli)== null OR (isset($apellido_cli))) {
    $insercion ="INSERT clientes SET
    nombre = '$nombre_cli',
    apellido ='$apellido_cli',
    cedula = '$cedula_cli',
    correo = '$correo_cli',
    telefono = '$telefono_cli'";

$resultado = $mysqli->query($insercion);

if ($resultado) {
    echo '<script>alert("Cliente Agregado con exito");window.location.href="Agregar_Cliente.php";</script>';
} else {
    echo "Hubo un Problema al intentar guardar los datos";
}
} else {
    
}
$mysqli->close();

?>