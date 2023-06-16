<?php

class Venta{

    private $idVenta;
    private $idVendedor;
    private $idCliente;
    private $fechaVenta;
    private $tipoVenta;
    private $descuentoVenta;
    private $estadoVenta;

    function __construct($idVenta,$idVendedor,$idCliente,$fechaVenta,$tipoVenta,$descuentoVenta,$estadoVenta){
        $this->idVenta=$idVenta;
        $this->idVendedor=$idVendedor;
        $this->idCliente=$idCliente;
        $this->fechaVenta=$fechaVenta;
        $this->tipoVenta=$tipoVenta;
        $this->descuentoVenta=$descuentoVenta;
        $this->estadoVenta=$estadoVenta;
    }

    //------------------GET----------------
    
    public function getIdVenta(){
        return $this->idVenta;
    }
    public function getIdVendedor(){
        return $this->idVendedor;
    }
    public function getIdcliente(){
        return $this->idCliente;
    }
    public function getFechaVenta(){
        return $this->fechaVenta;
    }
    public function getTipoVenta(){
        return $this->tipoVenta;
    }
    public function getDescuentoVenta(){
        return $this->descuentoVenta;
    }
    public function getEstadoVenta(){
        return $this->estadoVenta;
    }


    //------------------SET---------------

    public function setIdVenta($idVenta){
        $this->idVenta=$idVenta;
    }
    public function setIdVendedor($idVendedor){
        $this->idVendedor=$idVendedor;
    }
    public function setIdCliente($idCliente){
        $this->idCliente=$idCliente;
    }
    public function setFechaVenta($fechaVenta){
        $this->fechaVenta=$fechaVenta;
    }
    public function setTipoVenta($tipoVenta){
        $this->tipoVenta=$tipoVenta;
    }
    public function setDescuentoVenta($descuentoVenta){
        $this->descuentoVenta=$descuentoVenta;
    }
    public function setEstadoVenta($estadoVenta){
        $this->estadoVenta=$estadoVenta;
    }

    //-----------------METODOS--------------
    
    public static function getCantidadTotalVentas() {
        $query = "SELECT count(*) FROM ventas";
        return $query;
    }

    public static function getVentas(){
        $query = "SELECT * FROM  ventas";
        return $query;
    }

    public static function agregarVenta(){
        $query = "INSERT INTO `ventas`(`id_vendedor`, `id_cliente`, `fecha_venta`, `tipo_venta`, `descuento_venta`, `estado_venta`) 
                VALUES (?,?,?,'Web', 0, 1)";
        return $query;
    }

    public static function agregarDetalleVenta(){
//        $query = "INSERT INTO `ventas_detalles`('id_venta', 'id_producto', 'cant_producto', 'precio_unitario_producto') VALUES (?, ?, ?, ?)";
        $query = "INSERT INTO `ventas_detalles`(`id_venta`, `id_producto`, `cant_producto`, `precio_unitario_producto`) VALUES (?, ?, ?, ?)";
        return $query;
    }

    public static function buscarPorFecha(){
        $query = "SELECT * FROM ventas WHERE `fecha_venta` = ? ";
        return $query;
    }

}

?>
