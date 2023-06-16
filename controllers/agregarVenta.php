<?php

session_start();
require '../autoload_views.php';

// VALIDANDO SESION
if(!isset($_SESSION['id_usuario'])){
    header("Location: views/login.php");
}
$conexion = new Conexion();

$id_sucursal = $_SESSION['id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];

$productos = $_POST['productos'];
$id_cliente = $_POST['id_cliente'];
$fecha_venta = date("Y-m-d H:i:s");

// Creando la venta
$q_agregar_venta = Venta::agregarVenta();
$q_agregar_venta = $conexion->ejecutarQuery($q_agregar_venta, [$id_usuario, $id_cliente, $fecha_venta]);
$id_venta = $conexion->getLastId();

foreach ($productos as $producto) {
    // Creando los detalles de la venta
    $detalle_venta = [intval($id_venta), intval($producto['id']), floatval($producto['cantidad']), floatval($producto['precio'])];

    $q_agregar_detalle_venta = Venta::agregarDetalleVenta();
    $q_agregar_detalle_venta = $conexion->ejecutarQuery($q_agregar_detalle_venta, $detalle_venta);

    // Actualizando el stock de los productos
    $q_stock_producto = Producto::getStockProductoPorSucursal();
    $q_stock_producto = $conexion->ejecutarQuery($q_stock_producto, [intval($id_sucursal), intval($producto['id'])]);
    $stock_producto = $q_stock_producto->fetch();
    $nuevo_stock = intval($stock_producto['cantidad_producto']) - intval($producto['cantidad']);
    $q_set_stock_producto = Producto::setStockProducto();
    $q_set_stock_producto = $conexion->ejecutarQuery($q_set_stock_producto, [$nuevo_stock, $id_sucursal, intval($producto['id'])]);
}



//echo json_encode($productos, JSON_PRETTY_PRINT);

/*$estado_producto = $_POST['cantidad_producto'] > 0;
$data_crear_producto = [
    $_POST['detalle_procucto'],
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

header('Location: /lomox4/');*/


?>