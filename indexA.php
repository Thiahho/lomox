<?php

require_once './autoload.php';
$conexion= new Conexion();


?>

<form action="#" method="POST">
  <input type="date" name="fecha" placeholder="Buscar">
  <input type="submit" value="Buscar">
</form>

<?php
    if(isset($_POST['fecha'])){
        $q_buscar = Venta::buscarPorFecha(); 
        $param=[$_POST['fecha']];
        $q_buscar = $conexion->ejecutarQuery($q_buscar,$param);
        $busca = $q_buscar->fetchAll();
        foreach ($busca as $buscar) {
            if($buscar['estado_venta']){
            ?>
            <tr>
                <td><?php echo $buscar['id_vendedor'] ;  ?></td>
                <td><?php echo $buscar['id_cliente'] ;  ?></td>
                <td><?php echo $buscar['fecha_venta'] ;  ?></td>
                <td><?php echo $buscar['tipo_venta'] ;  ?></td>
                <td><?php echo $buscar['descuento_venta'] ;  ?></td>
                <td><?php echo $buscar['estado_venta'] ;  ?></td>
                <td><a href="#">Editar</a></td>
                <td><a href="#">Eliminar</a></td>
                <td><?php echo $buscar['id_venta'] ;  ?></td>
            </tr>
            <?php
            }
    }
      }

?>