<?php 

$mysqli = new mysqli("localhost","root","","taller1bd");

$id_cli=base64_decode($_GET['id']);

$eliminacion ="DELETE FROM clientes WHERE id=$id_cli";
$resultado = $mysqli->query($eliminacion);

if($resultado){
    echo '<script>alert("cliente Eliminado con Exito");window.location.href="Clientes.php";</script>';
}else{
    echo '<script>alert("Hubo un error al eliminar");window.location.href="Clientes.php";</script>';
}
$mysqli->close();
?>