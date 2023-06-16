<?php
session_start();
require_once '../autoload_views.php';
// VALIDANDO SESION
if(!isset($_SESSION['id_usuario'])){
    header("Location: views/login.php");
}
$titutlo_pagina = 'LOMOX | SUCURSALES';
$conexion = new Conexion();

$id_sucursal = $_SESSION['id_sucursal'];
// BLOQUE OBTENIENDO REGISTROS DE PRODUCTOS START
// ADMIN
$q_sucursales = Sucursal::getSucursales();
$q_sucursales = $conexion->ejecutarQuery($q_sucursales);
$sucursales= $q_sucursales->fetchAll();
// SOCIO
// CLIENTE
// VENDEDOR
// CARNICERO
// BLOQUE OBTENIENDO REGISTROS DE PRODUCTOS END

/*
OBTENIENDO DATOS DE LA SUCURSAL
 */
$conexion->desconectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- METAS -->
    <?php MetaTag(); ?>
    <!-- TITLE START -->
    <title><?php echo $titutlo_pagina; ?></title>
    <!-- LINKS -->
    <?php links();?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- ASIDE START -->
  <?php aside('sucursales'); ?>
  <!-- ASIDE END -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sucursales</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Sucursales</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

          <!-- TABLA SUCURSALES START -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sucursales</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla-sucursales" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id_Sucursal</th>
                    <th>NombreSucursal</th>
                    <th>DireccioDeSucursal</th>
                    <th>correoSucursal</th>
                    <th>TelSucursal</th>
                    <th>IdGerente</th>
                    <th>EstadoSucursal</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($sucursales as $sucursal){
                        if($sucursal['estado_sucursal']){
                    ?><tr>
                        <td><?php echo $sucursal['id_sucursal'] ?></td>
                        <td><?php echo $sucursal['nombre_sucursal'] ?></td>
                        <td><?php echo $sucursal['direccion_sucursal'] ?></td>
                        <td><?php echo $sucursal['correo_sucursal'] ?></td>
                        <td><?php echo $sucursal['tel_sucursal'] ?></td>
                        <td><?php echo $sucursal['id_gerente (int)'] ?></td>
                        <td><?php echo $sucursal['estado_sucursal'] ?></td>
                      </tr>
                    <?php      
                        }
                      }
                    ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- TABLA SUCURSALES END -->

        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- FOOTER START-->
<?php Footer(); ?>
  <!-- FOOTER END-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!--SCRIPTS START-->
<?php Script();?>
<!--SCRIPTS END -->
</body>
</html>
