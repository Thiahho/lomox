<?php
session_start();
require_once '../../autoload_aside_views.php';
// VALIDANDO SESION
if(!isset($_SESSION['id_usuario'])){
    header("Location: views/login.php");
}
$titutlo_pagina = 'LOMOX | ADMINISTRACION';
$conexion = new Conexion();

$id_sucursal = $_SESSION['id_sucursal'];
// ADMIN




// SOCIO
// CLIENTE
// VENDEDOR
// CARNICERO
$conexion->desconectar();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- META TAGS START-->
      <?php MetaTag();?>

    <!-- TITLE START -->
    <title><?php echo $titutlo_pagina; ?></title>

    <!--LINK START-->
    <?php Links();?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

  <!-- ASIDE START -->
  <?php aside('ventas'); ?>
  <!-- ASIDE END -->











<!--SCRIPTS START-->
<?php Script();?>
<!--SCRIPTS END -->
</body>
</html>