<?php

class Usuario{
//ATRIBUTOS------------------------

    private $table = "usuarios";
    private $nombre;
    private $apellido;
    private $direccion;
    private $correo;
    private $cp;
    private $nick;
    private $password;
    private $fecha_nacimiento;
    private $tipo_documento;
    private $documento;
    private $telefono;
    private $estado;

    // VARIABLE GLOBAL -------------------
    //public $hash_password="sha256";
    //------------------------------------

    function __construct($nombre, $apellido, $direccion, $correo, $cp, $nick, $password, $fecha_nacimiento, $tipo_documento, $documento, $telefono, $estado){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->cp = $cp;
        $this->nick = $nick;
        $this->setPassowrd($password);
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->tipo_documento = $tipo_documento;
        $this->documento = $documento;
        $this->telefono = $telefono;
        $this->estado = $estado;

    }

    //HACER GET Y SET PARA TODO MENOS PASSWORD 
    //-----------------GET----------------------
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function getCp(){
        return $this->cp;
    }
    public function getNick(){
        return $this->nick;
    }
    public function getFechaNacimiento(){
        return $this->fecha_nacimiento;
    }
    public function getTipoDocumento(){
        return $this->tipo_documento;
    }
    public function getDocumento(){
        return $this->tipo_documento;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getEstado(){
        return $this->estado;
    }
    //----------------SET--------------------
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }
    public function setDireccion($direccion){
        $this->direccion=$direccion;
    }
    public function setCorreo($correo){
        $this->correo=$correo;
    }
    public function setCp($cp){
        $this->cp=$cp;
    }
    public function setNick($nick){
        $this->nick=$nick;
    }
    public function setFechaNacimiento($fecha_nacimiento){
        $this->fecha_nacimiento=$fecha_nacimiento;
    }
    public function setTipoDocumento($tipo_documento){
        $this->tipo_documento=$tipo_documento;
    }
    public function setDocumento($documento){
        $this->documento=$documento;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    public function setEstado($estado){
        $this->estado=$estado;
    }

    // Metodos statics
    public static function getClientesSucursal() {
        $query = "SELECT * FROM usuarios 
                    JOIN usuarios_tipos 
                        ON usuarios.id_tipo_usuario = usuarios_tipos.id_tipo_usuario 
                           AND usuarios_tipos.detalle_tipo_usuario = 'Cliente' 
                    WHERE usuarios.id_sucursal = ?;";
        return $query;
    }

    public static function getTiposUsuario() {
        $query = "SELECT * FROM usuarios_tipos;";
        return $query;
    }

    
    //PASSWORD-------------
    public function setPassowrd($password){

        $this->password = self::hasheo($password);


    }

    //interaccion con las base de datos (insert, select , update , delete)
    public function insert(){
        //AGREGAR ID_TIPOUSUARIo Id_sucursal
        $query= "INSERT INTO {$this->table} 
        ( `nombre_usuario`, `apellido_usuario`, `direccion_usuario`, `correo_usuario`,
         `cp_usuario`, `nick_usuario`, `pass_usuario`, `fecha_nac_usuario`, `tipo_doc_usuario`, `doc_usuario`, `tel_usuario`, `estado_usuario`)
         VALUES ('{$this->getNombre()}','{$this->getApellido()})','{$this->getDireccion()}','{$this->getCorreo()}','{$this->getCp()}',
         '{$this->getNick()}','{$this->password}','{$this->getFechaNacimiento()}','{$this->getTipoDocumento()}','{$this->getDocumento()}','{$this->getTelefono()}',
         '{$this->getEstado()}'";

    }
    //obtener id_tipoUsuario
    //obtener id_sucursal

    //MUESTRA 1  USUARIO
    public static function find($id){
        
        $query = "SELECT * FROM {self::table} WHERE id_usuario = {$id}";
        //conexion a BD 
        //instaciar un objeto usuario con self y retornarlo 
    }

    public static function delete($id){
        
        $query = "DELETE FROM {self::table} WHERE id_usuario={$id}";
        //conexion a BD 
        //retornar true en caso de Eliminar con exito
        if($query){
            echo "Usuario eliminado";
        }else{
            echo "usuario no eleminado";
        }
    }

    public static function update($id,$datos){
        $query = "UPDATE {self::table} SET `nombre_usuario`='{$datos['nombreUsuario']}', `apellido_usuario`='[value-4]',`direccion_usuario`='[value-5]',`correo_usuario`='[value-6]',`cp_usuario`='[value-7]',
        `nick_usuario`='[value-8]',`pass_usuario`='[value-9]',`fecha_nac_usuario`='[value-10]',`tipo_doc_usuario`='[value-11]',
        `doc_usuario`='[value-12]',`id_sucursal`='[value-13]',`tel_usuario`='[value-14]',`estado_usuario`='[value-15]'
         WHERE id_usuario = {$id}";
    }
    
    //ACCIONES/AUTHENTICACION----------------------------------

    public static function login(){
        // $pass_hash = self::hasheo($password);
        $query = "SELECT * FROM usuarios WHERE `nick_usuario` = ? AND `pass_usuario` = ? and estado_usuario = 1";
        return $query;
    }

    public static function registro(){
        $query= "INSERT INTO usuarios
        ( `nick_usuario`, `correo_usuario`, `pass_usuario`, `id_sucursal`, `id_tipo_usuario`)
         VALUES (?, ?, ?, ?, ?)";
         return $query;

    }


    //METODOS PRIVADOS (SOLO USARA LA CLASE )
    public static function hasheo($password){
        $hash_password="sha256";
        return hash($hash_password,$password);//hasheo de contraseña perro;
    }

    //-----------------------------------------------------
    public function MuestraDatosUsuario(){
        $usuLogueado=array("");
        printf("Usuario logueado : ");
    }
}


?>