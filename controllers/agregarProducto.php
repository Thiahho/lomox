<?php

session_start();
require '../autoload_views.php';

// VALIDANDO SESION
if(!isset($_SESSION['id_usuario'])){
    header("Location: views/login.php");
}
$conexion = new Conexion();

$id_sucursal = $_SESSION['id_sucursal'];

$estado_producto = $_POST['cantidad_producto'] > 0;
$data_crear_producto = [
    $_POST['detalle_producto'],
    $_POST['precio_unitario_producto'],
    $estado_producto
];
$query_agregar_producto = Producto::registrarProducto();
$conexion->ejecutarQuery($query_agregar_producto, $data_crear_producto);
$id_producto = $conexion->getLastId();
$dara_crear_stock = [
    $id_sucursal,
    $id_producto,
    $_POST['cantidad_producto']
];
$query_agregar_stock = Producto::crearStockProducto();
$conexion->ejecutarQuery($query_agregar_stock, $dara_crear_stock);

header('Location: /lomox4/');


?>