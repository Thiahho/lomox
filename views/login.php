<?php

require("../models/conexion.php");
require("../models/usuario.php");
$conexion = new Conexion();

  if(isset($_POST['nickname']) && isset($_POST['password'])){
    if($_POST['nickname']=='' || $_POST['password']==''){
      $clase_formulario = 'error_formulario';
      $error = true;
    }else{
        $query = Usuario::login();
        $password = Usuario::hasheo($_POST['password']);
        $params_login = [$_POST['nickname'], $password];
        $smt = $conexion->ejecutarQuery($query, $params_login);
        $usuario = $smt->fetch();
        echo json_encode($password, JSON_PRETTY_PRINT);
        echo "\n holi else";

        if($usuario){
          echo "\n holi";
          session_start();
          $_SESSION['id_usuario'] = $usuario['id_usuario'];
          $_SESSION['id_tipo_usuario'] = $usuario['id_tipo_usuario'];
//          $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
//          $_SESSION['apellido_usuario'] = $usuario['apellido_usuario'];
          $_SESSION['nick_usuario'] = $usuario['nick_usuario'];
          $_SESSION['id_sucursal'] = $usuario['id_sucursal'];
          header("location: /lomox/inicio");
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style.css">
	<title>Document</title>
</head>
<body>

<div class="container-fluid ps-md-0">
	<div class="row g-0">
		<div class="d-none d-md-flex col-md-6 bg-image">
			<img src="https://www.designevo.com/res/templates/thumb_small/red-cow-and-white-fire.webp">
		</div>
		<div class="col-md-6">
			<div class="login d-flex align-items-center py-5">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-lg-8 mx-auto">
						<h3 class="login-heading mb-4">Iniciar Sesion</h3>

              <form method="post" action="#" >
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Ingrese su cuenta por favor.">
                  <label for="nickname">Cuenta</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="password" name="password" placeholder="********">
                  <label for="password">Contraseña</label>
                </div>

                <div class="d-grid">
                  <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Iniciar Sesion</button>
                  <div class="text-center">
                    <a class="small" href="#">Olvidate la contraseña?</a>
                  </div>
				  <div class="text-center">
                    <a class="small" href="registro_usuario">Registrarse</a>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
