<?php
ob_start();

require_once '../../dompdf/autoload.inc.php';

$mysqli = new mysqli("localhost","root","","taller1bd");

$consulta="SELECT*FROM clientes";
$resultados = $mysqli->query($consulta);
$filas=$resultados->fetch_all(MYSQLI_ASSOC);

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
   
   <style>
        thead{
            background-color:#00ffff;
        }
        table,th,td{
            border-collapse: collapse;
            border: 1px black solid;
            text-align: center;
            margin: 0 auto;
        }
        
   </style>
</head>
<body>
    <div align="center">
    <h1>Lista de Productos</h1>
    </div>

        <table border = "1">
            <thead>
              <tr align="center">
                <th>#</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>CEDULA</th>
                <th>TELEFONO</th>
                <th>CORREO</h>
              </tr>
          </thead>
          <tbody>

            <?php
            $num=1;
            foreach($filas as $fila){
          ?>
          <tr>
          <td><?php echo $fila['id']; ?></td>
               <td><?php echo $fila['nombre']; ?></td>
               <td><?php echo $fila['apellido']; ?></td>
               <td><?php echo $fila['cedula']; ?></td>
               <td><?php echo $fila['telefono']; ?></td>
               <td><?php echo $fila['correo']; ?></td>
            </tr>
         
         <?php    
            }
         ?>
          </tbody>
        </table>
</body>
</html>

<?php
    $html = ob_get_clean();
    
    use Dompdf\Dompdf;
    use Dompdf\Options;

    $opciones = new Options;
    $opciones->set('defaultfont','Courier');

    $dompdf = new Dompdf;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    $dompdf->render();

    $dompdf->stream('lista_clientes',array('Attachment'=>false));
?>