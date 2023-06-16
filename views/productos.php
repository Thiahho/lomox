<?php
session_start();
require_once '../autoload_views.php';
// VALIDANDO SESION
if(!isset($_SESSION['id_usuario'])){
    header("Location: views/login.php");
}
$titutlo_pagina = 'LOMOX | PRODUCTOS';
$conexion = new Conexion();

$id_sucursal = $_SESSION['id_sucursal'];
// BLOQUE OBTENIENDO REGISTROS DE PRODUCTOS START
// ADMIN
$q_productos = Producto::getProductosAdmin();
$q_productos = $conexion->ejecutarQuery($q_productos);
$productos = $q_productos->fetchAll();
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
  <?php aside('productos'); ?>
  <!-- ASIDE END -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
                          <td>$<?php echo $producto['precio_unitario_producto'] ;  ?></td>
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

        </div>
        <!-- TABLA PRODUCTOS END -->
        
        <!-- FORMULARIO CREAR PRODUCTO START -->
        <div class="col-8 offset-2">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Producto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/lomox/controllers/agregarProducto.php" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="detalle_procucto">Detalle Producto</label>
                        <input type="text" class="form-control" id="detalle_procucto" name="detalle_procucto" placeholder="Ingrese el detalle del producto.">
                    </div>
                    <div class="form-group">
                        <label for="precio_unitario_producto">Precio Unitario</label>
                        <input type="text" class="form-control" id="precio_unitario_producto" name="precio_unitario_producto" placeholder="Ingrese el precio del producto.">
                    </div>
                    <!-- AGREGAR CAMPO PARA UNIDAD_PRODUCTO -->
                    <div class="form-group">
                        <label for="cantidad_producto">Stock</label>
                        <input type="number" class="form-control" id="cantidad_producto" name="cantidad_producto" placeholder="Ingrese el stock del producto." min="0">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">CREAR</button>
                </div>
              </form>
            </div>
        </div>
        <!-- FORMULARIO CREAR PRODUCTO END -->


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
