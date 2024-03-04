<?php 

$mysqli = new mysqli("localhost","root","","taller1bd");

$id_pro = $_POST['id_pro'];
$producto_pro = $_POST['producto_pro'];
$descripcion_pro = $_POST['descripcion_pro'];
$precio_pro = $_POST['precio_pro'];
$stock_pro = $_POST['stock_pro'];
$categoria_pro = $_POST['categoria_pro'];

/*if (isset($mar) == NULL OR (isset($mod)) OR (isset($ser)) OR (isset($can))){
    echo '<script>alert("Debe Llenar Todos los Campos");window.location.href="productos.php";</script>';
}else{*/

$edicion="UPDATE productos SET
    
    producto= '$producto_pro',
    descripcion ='$descripcion_pro',
    precio = '$precio_pro',
    stock = '$stock_pro',
    categoria = '$categoria_pro'

    WHERE id=$id_pro
    ";
 $resultado = $mysqli->query($edicion); 

 if($resultado){
     echo '<script>alert("Producto Actualizado con Exito");window.location.href="productos.php";</script>';
 }else{
     echo '<script>alert("Hubo un error al agregar los datos");window.location.href="productos.php";</script>';
  }
//}
$mysqli->close();
?>