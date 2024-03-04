<?php
ob_start();

require_once '../../dompdf/autoload.inc.php';

$mysqli = new mysqli("localhost","root","","taller1bd");

$consulta="SELECT*FROM productos";
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
                <th>PRODUCTO</th>
                <th>DESCRIPCION</th>
                <th>PRECIO</th>
                <th>EN STOCK</th>
                <th>CATEGORIA</h>
              </tr>
          </thead>
          <tbody>

            <?php
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

    $dompdf->stream('listado_productos',array('Attachment'=>false));
?>