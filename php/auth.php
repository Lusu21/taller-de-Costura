<?php
session_start();

$usu = $_POST ['usuario'];
$pass = $_POST['pass'];

if (empty($usu) || empty($pass)) {
    echo "Por favor, ingrese su usuario y contraseña";
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "taller1bd");

if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

$query = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $usu);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($pass, $row['password'])) {
        $_SESSION['id_usu'] = $row['id'];
        $_SESSION['nombre_usu'] = $row['nombre_usuario'];
        $_SESSION['correo_usu'] = $row['correo_usuario'];
        $_SESSION['tipo_usu'] = $row['tipo_usuario'];

        header("Location:admin/dashboard.php");
        exit();

    } else {
        echo "Usuario o contraseña incorrectos";
        exit();
    }

} else {
    echo "Usuario no encontrado";
    exit();
}

$stmt->close();
$mysqli->close();
?>
