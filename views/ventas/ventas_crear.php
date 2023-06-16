<?php
session_start();
require_once '../../autoload_aside_views.php';
// VALIDANDO SESION
if(!isset($_SESSION['id_usuario'])){
    header("Location: views/login.php");
}
$titutlo_pagina = 'LOMOX | CREAR VENTA';
$conexion = new Conexion();

$id_sucursal = $_SESSION['id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];
// BLOQUE OBTENIENDO REGISTROS DE PRODUCTOS START
// ADMIN
$q_tipos_productos = Producto::getTiposProductos();
$q_tipos_productos = $conexion->ejecutarQuery($q_tipos_productos);
$tipos_productos = $q_tipos_productos->fetchAll();
$q_productos = Producto::getProductosSucursal();
$q_productos = $conexion->ejecutarQuery($q_productos, [$id_sucursal]);
$productos = $q_productos->fetchAll();
$q_clientes = Usuario::getClientesSucursal();
$q_clientes = $conexion->ejecutarQuery($q_clientes, [$id_sucursal]);
$clientes = $q_clientes->fetchAll();
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
            <h1 class="m-0 text-dark">Crear Venta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/lomox/ventas">Ventas</a></li>
              <li class="breadcrumb-item active">Crear Venta</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Ingresar una venta</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <h4>Agregar Productos</h4>
                <div class="accordion" id="accordionExample">
                  <?php
                  foreach ($tipos_productos as $tipo_producto) {
                    ?>
                    <div class="card" style="margin-bottom: 0;">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tipo-<?php echo $tipo_producto['tipo_producto']; ?>" aria-expanded="true" aria-controls="collapseOne" style="text-transform: uppercase;">
                          <?php echo strtoupper($tipo_producto['tipo_producto']); ?>
                        </button>
                      </h2>
                    </div>

                    <div id="tipo-<?php echo $tipo_producto['tipo_producto']; ?>"  class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body list-productos" style="padding: 0.5rem;">
                        <?php
                        foreach ($productos as $producto) {
                          if($producto['tipo_producto'] == $tipo_producto['tipo_producto']) {
                            ?>
                            <button type="button" class="btn btn-default btn-block d-flex justify-content-between item-producto"
                                    data-id="<?php echo $producto['id_producto'];?>"
                                    data-nombre="<?php echo $producto['detalle_producto'];?>"
                                    data-precio="<?php echo $producto['precio_unitario_producto'];?>"
                                    data-stock="<?php echo $producto['cantidad_producto'];?>"
                                    data-tipo="<?php echo $producto['tipo_producto']; ?>"><span><?php echo ucfirst($producto['detalle_producto']);  ?></span> <span>$ <?php echo $producto['precio_unitario_producto'];  ?></span></button>
                            <?php
                          }
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                    <?php
                  }
                  ?>
                </div>
                <div class="form-group mt-3">
                  <label>Seleccionar un cliente</label>
                  <select class="form-control select2" id="select-cliente" style="width:100%;">
                    <?php
                    foreach ($clientes as $cliente) {
                      ?>
                        <option value="<?php echo $cliente['id_usuario'];?>"><?php echo $cliente['nick_usuario'];?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>

              </div>
              <!-- /.col -->
              <div class="col-md-8">
                <h4>Detalle de Venta</h4>
                <table class="table table-bordered text-center tabla-productos">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>SubTotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- AQUI SE VAN AGREGANDO LOS PRODUCTOS -->
                  </tbody>
                </table>

                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Total</th>
                      <th class="total-venta">$ 0</th>
                    </tr>
                  </thead>
                </table>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary agregar-venta">Agregar Venta</button>
          </div>
        </div>

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

<script>
$(document).ready(function (){
  const detalleVenta = {
    productos: [],
    total: 0
  };

  const sePuedeAgregarProducto = function(listaProductos, productoAgregar) {
    let existeProducto = false,
      idProducto = false;

    listaProductos.forEach(function(producto){
      if(producto.id === productoAgregar.id){
        existeProducto = true;
        idProducto = producto.id;
      }
    });

    return {existeProducto, idProducto};
  };

  const actualizarCantidadProducto = function(detalleVenta, idProducto) {
    detalleVenta.productos.forEach(function (producto){
      if(producto.id === idProducto){
        if(producto.stock > producto.cantidad) {
          producto.cantidad++;
          detalleVenta.total += producto.precio;
        } else {
          toastr.error('Stock del producto alcanzado.')
        }
      }
    });
    limpiarVistaDetalle();
    dibujarVistaDetalle(detalleVenta)
  };

  const limpiarVistaDetalle = function() {
    const tablaProductos = document.querySelector('.tabla-productos tbody');
    while (tablaProductos.firstChild) {
      tablaProductos.removeChild(tablaProductos.firstChild);
    }
  };

  const dibujarVistaDetalle = function(detalleVenta) {
    const tablaProductos = document.querySelector('.tabla-productos tbody');
    detalleVenta.productos.forEach(function (producto){
      // Crear la fila del detalle de venta
      const fila = document.createElement("tr");
      const columnaNombre = document.createElement("td");
      const columnaCantidad = document.createElement("td");
      const columnaPrecio = document.createElement("td");
      const columnaSubTotal = document.createElement("td");
      const textColumnaNombre = document.createTextNode(`${producto.nombre} (${producto.tipo})`);
      const textColumnaCantidad = document.createTextNode(`${producto.cantidad}`);
      const textColumnaPrecio = document.createTextNode(`$ ${producto.precio}`);
      const textColumnaSubTotal = document.createTextNode(`$ ${producto.cantidad * producto.precio}`);
      columnaNombre.appendChild(textColumnaNombre);
      columnaCantidad.appendChild(textColumnaCantidad);
      columnaPrecio.appendChild(textColumnaPrecio);
      columnaSubTotal.appendChild(textColumnaSubTotal);
      fila.appendChild(columnaNombre);
      fila.appendChild(columnaCantidad);
      fila.appendChild(columnaPrecio);
      fila.appendChild(columnaSubTotal);
      tablaProductos.appendChild(fila);
    });
    const elementTotal = document.querySelector('.total-venta')
    elementTotal.innerHTML = `$ ${detalleVenta.total}`;
  };

  const agregarProducto = function (detalleVenta, producto) {
    detalleVenta.productos.push(producto);
    detalleVenta.total += producto.precio;
    limpiarVistaDetalle();
    dibujarVistaDetalle(detalleVenta);
  };

  $('.item-producto').on('click', function(e){
    e.preventDefault();
    let botonProducto;
    // Obtengo el boton que tiene los data
    if(e.target.classList.contains("item-producto")) {
      botonProducto = e.target;
    } else {
      botonProducto = e.target.parentElement;
    }

    // Obtengo los datos del producto que seleccione
    const producto = {
      nombre: botonProducto.dataset.nombre.charAt(0).toUpperCase() + botonProducto.dataset.nombre.slice(1),
      tipo: botonProducto.dataset.tipo.toUpperCase(),
      precio: parseFloat(botonProducto.dataset.precio),
      cantidad: 1,
      id: botonProducto.dataset.id,
      stock: parseInt(botonProducto.dataset.stock)
    }

    const {existeProducto, idProducto} = sePuedeAgregarProducto(detalleVenta.productos, producto);

    if(existeProducto) {
      // Le aumento la cantidad
      actualizarCantidadProducto(detalleVenta, idProducto)
    } else {
      // Le agrego el producto
      agregarProducto(detalleVenta, producto)
    }

  });

  $('.agregar-venta').on('click', function (e){
    e.preventDefault();
    const dataVenta = {
      productos: detalleVenta.productos,
      id_cliente: $('#select-cliente').val(),
    };
    $.ajax({
      data: dataVenta,
      url: `/lomox/controllers/agregarVenta.php`,
      method: 'POST',
      success: function() {
        window.location.href = '/lomox/';
      }
    })
  });

  $('.select2').select2({
    language: "es"
  });

});

</script>

</body>
</html>
