<?php

function aside($menu_seleccionado) {
    ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- LOGO -->        
        <a href="./inicio" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="Lomox Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">LOMOX</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- FOTO DEL ADMIN -->
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <!-- NOMBRE DEL ADMIN -->
                <a href="#" class="d-block"><?php echo $_SESSION['nick_usuario']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/lomox/sucursales" class="nav-link <?php if($menu_seleccionado== 'sucursales'){ echo 'active'; } ?>">
                        <i class="nav-icon fas fa-store-alt"></i>
                        <p>
                            Sucursales
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="/lomox/ventas" class="nav-link <?php if($menu_seleccionado== 'ventas'){ echo 'active'; } ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Ventas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/lomox/ventas" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ingreso Consulta/ventas</p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="crear_venta" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Ingresar Venta</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ventas" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Consultar Venta</p>
                                    </a>
                                </li>
                            </ul>                            
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Impuestos</p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="impuestosIVA" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>IVA</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="impuestosIIBB" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>IIBB</p>
                                    </a>
                                </li>
                            </ul>   
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Buscar Venta</p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="bVentaTotal" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Total</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="bVentaCliente" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Cliente</p>
                                    </a>
                                    <!--
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-circle"></i>
                                            <p>Total</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-circle"></i>
                                            <p>Mes</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-circle"></i>
                                            <p>Hoy</p>
                                            </a>
                                        </li>
                                    </ul>   
                                    -->                                    
                                </li>
                                <li class="nav-item">
                                    <a href="bVentaPromedio" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Promedio</p>
                                    </a>
                                </li>
                            </ul>   
                        </li>
                        <li class="nav-item">
                            <a href="stockVendidoHoy" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stock Vendido hoy</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="/lomox/productos" class="nav-link <?php if($menu_seleccionado== 'compras'){ echo 'active'; } ?>">
                    <i class="fa-solid fa-cart-shopping"></i>
                        <p>
                            Compras
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item has-treeview">
                        <a href="ingresoFacRem" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Ingreso Factura/remito
                        </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="pagoDeCompraProducto" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Pago de Compras/productos
                        </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="pagoSalarios" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Pago de Salarios
                        </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="pagoServicios" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Pago de Servicios
                        </p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/lomox/stock" class="nav-link <?php if($menu_seleccionado== 'stock'){ echo 'active'; } ?>">
                        <i class="nav-icon fas fa-drumstick-bite"></i>
                        <p>
                            Stock
                        </p>
                    </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="ingresoProducto" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Ingreso de Productos

                            </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="productoProveedores" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Productos y proveedores

                            </p>
                            </a>
                            <li class="nav-item">
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="consultaFrigorifico" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Consulta a Frigorifico

                            </p>
                            </a>
                            <li class="nav-item">
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="pedidoAbastecimiento" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                 Pedidos / abastecimientos

                            </p>
                            </a>
                            <li class="nav-item">
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="rendimientoRes" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Rendimiento 1/2 RES

                            </p>
                            </a>
                            <li class="nav-item">
                        </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href="administracion" class="nav-link <?php if($menu_seleccionado== 'administracion'){ echo 'active'; } ?>">
                        <i class="nav-icon fas fa-drumstick-bite"></i>
                        <p>
                            Administracion
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="estadistica" class="nav-link <?php if($menu_seleccionado== 'estadistica'){ echo 'active'; } ?>">
                        <i class="nav-icon fas fa-drumstick-bite"></i>
                        <p>
                            Estadistica
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/lomox/productos" class="nav-link <?php if($menu_seleccionado== 'productos'){ echo 'active'; } ?>">
                        <i class="nav-icon fas fa-drumstick-bite"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Level 1
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Level 2
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Level 3</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    </ul>
                </li>



                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Desplegable
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Simple Tables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DataTables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/jsgrid.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>jsGrid</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Comun
                    </p>
                    </a>
                </li>
                <form method="POST">
                <li>
                    <input type="submit" name="cerrar_sesion" class="btn btn-block btn-danger" value="Cerrar Session">

                </li>
                </form>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <?php
}
?>