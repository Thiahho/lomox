<?php
session_start();
require_once '../../autoload_aside_views.php';
// VALIDANDO SESION
if(!isset($_SESSION['id_usuario'])){
    header("Location: views/login.php");
}
$titutlo_pagina = 'LOMOX | VENTAS';
$conexion = new Conexion();

$id_sucursal = $_SESSION['id_sucursal'];
// BLOQUE OBTENIENDO REGISTROS DE PRODUCTOS START
// ADMIN
$q_productos = Producto::getProductosAdmin();
$q_productos = $conexion->ejecutarQuery($q_productos);
$productos = $q_productos->fetchAll();

$q_ventas = Venta::getVentas();
$q_ventas = $conexion->ejecutarQuery($q_ventas);
$ventas = $q_ventas->fetchAll();
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
<html>
<head>
    <!-- META TAGS START -->
    <?php MetaTag();?>
    <!-- META TAGS END -->

    <!-- TITLE START -->
    <title><?php echo $titutlo_pagina; ?></title>
    <!-- TITLE END -->

    <!-- LINKS START -->
    <?php Links();?>
    <!-- LINKS END -->

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
  <?php aside('ventas'); ?>
  <!-- ASIDE END -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ventas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Ventas</li>
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

        <!-- TABLA VENTAS START -->
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ventas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla-productos" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID Venta </th>
                    <th>ID Vendedor</th>
                    <th>ID Cliente</th>
                    <th>Fecha Venta</th>
                    <th>Tipo Venta </th>
                    <th>Descuento Venta </th>
                    <th>Estado Venta</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($ventas as $venta) {
                        if($venta['estado_venta']){
                        ?>
                        <tr>
                          <td><?php echo $venta['id_venta'] ;  ?></td>
                          <td><?php echo $venta['id_vendedor'] ;  ?></td>
                          <td><?php echo $venta['id_cliente'] ;  ?></td>
                          <td><?php echo $venta['fecha_venta'] ;  ?></td>
                          <td><?php echo $venta['tipo_venta'] ;  ?></td>
                          <td><?php echo $venta['descuento_venta'] ;  ?></td>
                          <td><?php echo $venta['estado_venta'] ;  ?></td>
                          <td><a href="#">Editar</a></td>
                          <td><a href="#">Eliminar</a></td>
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
          <!-- TABLA END -->

        </div>
        <!-- TABLA VENTAS END -->

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
