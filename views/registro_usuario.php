<?php
require_once '../autoload_views.php';

$conexion = new Conexion();

if (isset($_POST['email']) && $_POST['email'] != '') {
    // VALIDAR LOS CAMPOS RECIBIDOS
    $password = Usuario::hasheo($_POST['password']);
    $data_registro = [
        $_POST['nickname'],
        $_POST['email'],
        $password,
        $_POST['sucursal'],
        $_POST['tipo-usuario']
    ];
    $q_registro_usuario = Usuario::registro();
    $q_registro_usuario = $conexion->ejecutarQuery($q_registro_usuario, $data_registro);
    header('Location: /lomox/login');
}

$q_sucursales = Sucursal::getSucursales();
$q_sucursales = $conexion->ejecutarQuery($q_sucursales);
$sucursales = $q_sucursales->fetchAll();

$q_tipos_usuario = Usuario::getTiposUsuario();
$q_tipos_usuario = $conexion->ejecutarQuery($q_tipos_usuario);
$tipos_usuario = $q_tipos_usuario->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    Links();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br><br>
<!-- general form elements -->
<div class="col-8 offset-2">
    <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registro de Usuario  </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="#" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="sucursal">Sucursal</label>
                            <select id="sucursal" class="form-control" name="sucursal">
                                <?php
                                foreach ($sucursales as $sucursal) {
                                    ?>
                                    <option value="<?php echo $sucursal['id_sucursal'] ?>"><?php echo $sucursal['nombre_sucursal'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tipo Usuario</label>
                            <select class="form-control" name="tipo-usuario">
                                <?php
                                foreach ($tipos_usuario as $tipo_usuario) {
                                    ?>
                                    <option value="<?php echo $tipo_usuario['id_tipo_usuario'] ?>"><?php echo $tipo_usuario['detalle_tipo_usuario'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electronico: </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo@gmail.com">
                        </div>

                        <div class="form-group">
                            <label for="nickname">Usuario</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nombre de pila">
                        </div>
                        <div class="form-group">
                            <label for="password">Constraseña </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña aquí">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
                </div>
                <!-- /.card -->    
</div>
</body>
</html>
