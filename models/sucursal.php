<?php

class Sucursal{

    private $table ="sucursales";
    private $idSucursal;
    private $NombreSucursal;
    private $direccionSucursal;
    private $correoSucursal;
    private $telSucursal;
    private $idGerente;
    private $estadoSucursal;

    //---------CONSTRUCTOR------------
     function __construct($idSucursal,$NombreSucursal,$direccionSucursal,$correoSucursal,$telSucursal,$idGerente,$estadoSucursal){
        $this->idSucursal=$idSucursal;
        $this->NombreSucursal=$NombreSucursal;
        $this->direccionSucursal=$direccionSucursal ;
        $this->correoSucursal=$correoSucursal ;
        $this->telSucursal=$telSucursal ;
        $this->idGerente=$idGerente ;
        $this->estadoSucursal=$estadoSucursal;

    }
    //--------GET------------

    public function getNombreSucursal(){
        return $this->NombreSucursal;
    }
    public function getdireccionSucursal(){
        return $this->direccionSucursal;
    }
    public function getcorreoSucursal(){
        return $this->correoSucursal;
    }
    public function gettelSucursal(){
        return $this->telSucursal;
    }
    public function getidGerente(){
        return $this->idGerente;
    }
    public function getestadoSucursal(){
        return $this->estadoSucursal;
    }

    //---------------SET--------------


    public function setNombreSucursal($NombreSucursal){
        $this->NombreSucursal=$NombreSucursal;
    }
    public function setDireccionSucursal($direccionSucursal){
        $this->direccionSucursal=$direccionSucursal;
    }
    public function setCorreoSucursal($correoSucursal){
        $this->correoSucursal=$correoSucursal;
    }
    public function setTelSucursal($telSucursal){
        $this->telSucursal=$telSucursal;
    }
    public function setIdGerente($idGerente){
        $this->idGerente=$idGerente;
    }
    public function setEstadoSucursal($estadoSucursal){
        $this->estadoSucursal=$estadoSucursal;
    }

    public function insert(){
        $query="INSERT INTO {$this->table}
        ( `nombre_sucursal`, `direccion_sucursal`, `correo_sucursal`, `tel_sucursal`, `estado_sucursal`)
         VALUES ('{$this->getNombreSucursal()}','{$this->getdireccionSucursal()}'
         ,'{$this->getcorreoSucursal()}','{$this->gettelSucursal()}','{$this->getestadoSucursal()}')";
    }

    public function select(){

    }

    public function update(){

    }

    public function delete(){

    }

    //-------------------Metodos-----------
    public static function getCantidadSucursales(){
        $query="SELECT count(*) FROM sucursales";
        return $query;
    }

    public static function getSucursales(){
        $query="SELECT * FROM sucursales";
        return $query;
    }
}   
    

?>