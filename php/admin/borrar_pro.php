<?php 

$mysqli = new mysqli("localhost","root","","taller1bd");

$id_pro=base64_decode($_GET['id']);

$eliminacion ="DELETE FROM productos WHERE id=$id_pro";
$resultado = $mysqli->query($eliminacion);

if($resultado){
    echo '<script>alert("producto Eliminado con Exito");window.location.href="productos.php";</script>';
}else{
    echo '<script>alert("Hubo un error al eliminar");window.location.href="productos.php";</script>';
}
$mysqli->close();
?>