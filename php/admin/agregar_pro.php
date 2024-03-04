<?php

$mysqli = new mysqli("localhost","root","","taller1bd");

$producto_pro = $_POST['producto_pro'];
$descripcion_pro = $_POST['descripcion_pro'];
$precio_pro = $_POST['precio_pro'];
$stock_pro = $_POST['stock_pro'];
$categoria_pro = $_POST['categoria_pro'];

if (isset($producto_pro)== null OR (isset($producto_pro))) {
    $insercion ="INSERT productos SET
    producto= '$producto_pro',
    descripcion ='$descripcion_pro',
    precio = '$precio_pro',
    stock = '$stock_pro',
    categoria = '$categoria_pro'";

$resultado = $mysqli->query($insercion);

if ($resultado) {
    echo '<script>alert("Producto Agregado con exito");window.location.href="productos.php";</script>';
} else {
    echo "Hubo un Problema al intentar guardar los datos";
}
} else {
    
}
$mysqli->close();

?>
