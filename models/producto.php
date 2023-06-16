<?php

class Producto{

    private $id_producto;
    private $detalle_producto;
    private $precio_unitario_producto;
    private $unidad_producto;
    private $estado_producto;

    function __construct($id_producto,$detalle_producto,$precio_unitario_producto,$unidad_producto,$estado_producto){
        $this->id_producto=$id_producto;
        $this->detalle_producto=$detalle_producto;
        $this->precio_unitario_producto=$precio_unitario_producto;
        $this->unidad_producto=$unidad_producto;
        $this->estado_producto=$estado_producto;
    }
    //----------------------SET-----------------
    public function setIdProducto($id_producto){
        $this->id_producto=$id_producto;
    }
    public function setDetalleProducto($detalle_producto){
        $this->detalle_producto=$detalle_producto;
    }
    public function setPrecioUnitarioProducto($precio_unitario_producto){
        $this->precio_unitario_producto=$precio_unitario_producto;
    }
    public function setUnidadProducto($unidad_producto){
        $this->unidad_producto=$unidad_producto;
    }
    public function setEstadoProducto($estado_producto){
        $this->estado_producto=$estado_producto;
    }

    //-------------------GET----------------
    public function getIdProducto(){
        return $this->id_producto;
    }
    public function getDetalleProducto(){
        return $this->detalle_producto;
    }
    public function getPrecioUnitarioProducto(){
        return $this->precio_unitario_producto;
    }
    public function getUnidadProducto(){
        return $this->unidad_producto;
    }
    public function getEstadoProducto(){
        return $this->estado_producto;
    }

    //-------------METODOS---------------

    public static function getCantidadTotalProductos() {
        $query = "SELECT count(*) FROM productos";
        return $query;
    }
    public static function getProductosAdmin() {
        $query = "SELECT * FROM `productos` JOIN `stock` on productos.id_producto = stock.id_producto;";
        return $query;
    }
    public static function getTiposProductos() {
        $query = "SELECT tipo_producto FROM `productos` GROUP BY tipo_producto;";
        return $query;
    }
    public static function getProductosSucursal() {
        $query = "SELECT * FROM `productos` JOIN `stock` on productos.id_producto = stock.id_producto and stock.id_sucursal = ? and stock.cantidad_producto > 0;";
        return $query;
    }
    public static function getStockProductoPorSucursal() {
        $query = "SELECT * FROM `stock` WHERE `id_sucursal` = ? AND `id_producto` = ?";
        return $query;
    }
    public static function setStockProducto() {
        $query = "UPDATE `stock` SET `cantidad_producto` = ? WHERE `id_sucursal` = ? AND `id_producto` = ?";
        return $query;
    }


    // Validar existencia del producto en la sucursal
        // Si existe, actualizar stock
        // Si no existe, crear producto y crear stock
    public static function registrarProducto(){
        $query = "INSERT INTO productos
        (`detalle_procucto`,`precio_unitario_producto`, `estado_producto`)
        VALUES (?, ?, ?)";
        return $query;
    }
    public static function crearStockProducto() {
        $query = "INSERT INTO stock (`id_sucursal`,`id_producto`, `cantidad_producto`)
        VALUES (?, ?, ?)";
        return $query;
    }


/*
    public $id;
    public $nombre;
    public $precio;

    //------get------------

    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getPrecio(){
        return $this->precio;
    }

    //---------set--------

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setPrecio($precio){
        $this->precio=$precio;
    }

    //---------------Metodos------------


    public static function registrarProducto($nombre,$precio){
        $query = "INSERT INTO productos
        (`nombre`,`precio`)
        VALUES ('{$nombre}','{$precio}')";
        return $query;
    }
*/
}

?>