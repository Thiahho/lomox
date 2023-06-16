<?php
session_start();
require_once './autoload.php';
if(!isset($_SESSION['id_usuario'])){
    header("location:views/componentes/login.php");
}
$titutlo_pagina = 'LOMOX | INICIO';
$conexion = new Conexion();
if(!isset($_SESSION['nick_usuario'])) {
    header('Location: ./login');
}
if(isset($_POST['cerrar_sesion'])) {
  session_destroy();
  session_unset();
  header('Location: /lomox/login');
}

// BLOQUE ASIGNAR CANTIDAD TOTAL DE REGISTROS START
$q_cant_total_productos = Producto::getCantidadTotalProductos();
$q_cant_total_productos = $conexion->ejecutarQuery($q_cant_total_productos);
$cant_total_productos = $q_cant_total_productos->fetch();

$q_cant_total_ventas = Venta::getCantidadTotalVentas();
$q_cant_total_ventas = $conexion->ejecutarQuery($q_cant_total_ventas);
$cant_total_ventas = $q_cant_total_ventas->fetch();

$q_cant_total_sucursales = Sucursal::getCantidadSucursales();
$q_cant_total_sucursales = $conexion->ejecutarQuery($q_cant_total_sucursales);
$cant_total_sucursales = $q_cant_total_sucursales->fetch();

$cant_total_sucursales = $cant_total_sucursales[0];
$cant_total_ventas = $cant_total_ventas[0];
$cant_total_productos = $cant_total_productos[0];
// BLOQUE ASIGNAR CANTIDAD TOTAL DE REGISTROS END

$id_sucursal = $_SESSION['id_sucursal'];
// BLOQUE OBTENIENDO REGISTROS DE PRODUCTOS START
// ADMIN
/**
 * Selecciona la sucursal y ahi tiene acceso a la vista de los productos de esa sucursal
 */
$q_productos = Producto::getProductosAdmin();
$q_productos = $conexion->ejecutarQuery($q_productos);
$productos = $q_productos->fetchAll();

$q_sucursales = Sucursal::getSucursales();
$q_sucursales = $conexion->ejecutarQuery($q_sucursales);
$sucursales = $q_sucursales->fetchAll();

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
    <!-- META TAGS START-->
      <?php MetaTag();?>
    <!--META TAGS END -->

    <!-- TITLE START -->
    <title><?php echo $titutlo_pagina; ?></title>
    <!-- TITLE END -->

    <!--LINK START-->
    <?php Links();?>
    <!--LINK END-->

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
            <h1 class="m-0 text-dark">Inicio</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Inicio</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $cant_total_sucursales;?></h3>

                <p>Cantidad total Sucursales</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-12 col-sm-6 col-md-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $cant_total_productos; ?></h3>

                <p>Cantidad Total de Productos</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-12 col-md-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $cant_total_ventas; ?></h3>

                <p>Cantidad Total de Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

        <!-- TABLA PRODUCTOS START -->
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla-productos" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <th>Unidad</th>
                    <th>Stock</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($productos as $producto) {
                        if($producto['estado_producto']){
                        ?>
                        <tr>
                          <td><?php echo $producto['id_producto'] ;  ?></td>
                          <td><?php echo $producto['detalle_producto'] ;  ?></td>
                          <td><?php echo $producto['precio_unitario_producto'] ;  ?></td>
                          <td><?php echo $producto['unidad_producto'] ;  ?></td>
                          <td><?php echo $producto['cantidad_producto'] ;  ?></td>
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
          <!-- TABLA PRODUCTOS END -->

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

          <!-- TABLA VENTAS START -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ventas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla-ventas" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID VENTA</th>
                      <th>ID VENDEDOR</th>
                      <th>ID CLIENTE</th>
                      <th>FECHA VENTA</th>
                      <th>TIPO VENTA</th>
                      <th>DESCUENTO VENTA</th>
                      <th>ESTADO VENTA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($ventas as $venta){
                      if($venta['estado_venta']){
                    ?>
                    <tr>
                    <td><?php echo $venta['id_venta']; ?></td>
                    <td><?php echo $venta['id_vendedor']; ?></td>
                    <td><?php echo $venta['id_cliente']; ?></td>
                    <td><?php echo $venta['fecha_venta']; ?></td>
                    <td><?php echo $venta['tipo_venta']; ?></td>
                    <td><?php echo $venta['descuento_venta']; ?></td>
                    <td><?php echo $venta['estado_venta']; ?></td>
                    </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- TABLA VENTAS END -->

        </div>
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
<?php Script(); ?>
<!--SCRIPTS END -->


</body>
</html>
