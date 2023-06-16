-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2023 a las 03:56:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lomox`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `detalle_producto` varchar(45) NOT NULL,
  `precio_unitario_producto` float NOT NULL DEFAULT 0,
  `unidad_producto` varchar(10) NOT NULL DEFAULT '',
  `estado_producto` tinyint(1) NOT NULL DEFAULT 1,
  `tipo_producto` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `detalle_producto`, `precio_unitario_producto`, `unidad_producto`, `estado_producto`, `tipo_producto`) VALUES
(1, 'bife', 10, 'unidadPRO', 1, 'vaca'),
(2, 'alitas de pollo', 10, 'unidadPRO', 1, 'pollo'),
(3, 'pierna', 11, 'unidadPRO', 1, 'cerdo'),
(4, 'pechuga', 22, 'unidadPRO', 1, 'pollo'),
(5, 'costeleta', 9, 'unidadPRO', 1, 'vaca'),
(6, 'pecho', 11, 'unidadPRO', 1, 'cerdo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_sucursal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_producto` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cantidad_producto` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_sucursal`, `id_producto`, `cantidad_producto`) VALUES
(4, 1, 100),
(4, 2, 100),
(5, 3, 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_actualiza`
--

CREATE TABLE `stock_actualiza` (
  `id_actualiza` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_sucursal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `fecha_actualiza` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `motivo_actualiza` varchar(15) NOT NULL DEFAULT '' COMMENT 'Compra | Faena | Ajuste stock.-',
  `estado_actualiza` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_actualiza_detalle`
--

CREATE TABLE `stock_actualiza_detalle` (
  `id_detalle_actualiza` int(10) UNSIGNED NOT NULL,
  `id_actualiza` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_producto` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cant_producto` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_pedidos`
--

CREATE TABLE `stock_pedidos` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_sucursal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `fecha_pedido` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_usuario_pedido` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_estado_pedido` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_usuario_gestion` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_pedidos_detalles`
--

CREATE TABLE `stock_pedidos_detalles` (
  `id_detalle_pedido` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_producto` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cant_producto` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_sucursal` int(10) UNSIGNED NOT NULL,
  `nombre_sucursal` varchar(45) NOT NULL DEFAULT '',
  `direccion_sucursal` varchar(100) NOT NULL DEFAULT '',
  `correo_sucursal` varchar(45) NOT NULL DEFAULT '',
  `tel_sucursal` varchar(20) NOT NULL DEFAULT '',
  `id_gerente (int)` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `estado_sucursal` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_sucursal`, `nombre_sucursal`, `direccion_sucursal`, `correo_sucursal`, `tel_sucursal`, `id_gerente (int)`, `estado_sucursal`) VALUES
(4, 'carniceria1', 'falsa132', 'carniceria1@gmail.com', '1123233434', 1, 1),
(5, 'carniceria2', 'real123', 'carniceria2@gmail.com', '1100223344', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales_stock`
--

CREATE TABLE `sucursales_stock` (
  `id_sucursal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_producto` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cant_producto` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_tipo_usuario` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nombre_usuario` varchar(45) NOT NULL DEFAULT '',
  `apellido_usuario` varchar(45) NOT NULL DEFAULT '',
  `direccion_usuario` varchar(50) DEFAULT NULL,
  `correo_usuario` varchar(60) NOT NULL DEFAULT '',
  `cp_usuario` varchar(10) DEFAULT NULL,
  `nick_usuario` varchar(10) NOT NULL DEFAULT '',
  `pass_usuario` varchar(255) NOT NULL DEFAULT '',
  `fecha_nac_usuario` datetime DEFAULT NULL,
  `tipo_doc_usuario` varchar(10) DEFAULT NULL,
  `doc_usuario` int(10) UNSIGNED DEFAULT NULL,
  `id_sucursal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tel_usuario` varchar(20) DEFAULT NULL,
  `estado_usuario` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_usuario`, `nombre_usuario`, `apellido_usuario`, `direccion_usuario`, `correo_usuario`, `cp_usuario`, `nick_usuario`, `pass_usuario`, `fecha_nac_usuario`, `tipo_doc_usuario`, `doc_usuario`, `id_sucursal`, `tel_usuario`, `estado_usuario`) VALUES
(3, 2, 'Aquiles', 'Vailollo', 'Av.Falsa 123', 'Vailollo@gmail.com', '4041', 'bart', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1992-11-18 17:56:42', 'DNI', 42889988, 4, '1122224444', 1),
(4, 1, 'admin', 'admin', 'admin123', 'admin@gmail.com', '1111', 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-05-23 23:50:15', 'DNI', 42119900, 5, '1123231212', 1),
(6, 3, 'CLIENTE', 'ApeCliente', '123cliente', 'cliente@gmail.com', '1010', 'cliente', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1990-10-21 00:00:00', 'DNI', 40121011, 4, '1134435768', 1),
(7, 4, 'VENDEDOR', 'ApeVendedor', '123vendedor', 'vendedor@gmail.com', '1001', 'vendedor', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1991-11-20 00:00:00', 'DNI', 40121000, 4, '1132074263', 1),
(8, 3, 'clientesuc2', 'clientesuc2', 'clientesuc2', 'clientesuc2@gmail.com', '1011', 'cliente2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1996-10-22 00:00:00', 'DNI', 40234432, 5, '1123452345', 1),
(9, 4, 'vendedorsuc2', 'vendedorsuc2', 'vendedorsuc2', 'vendedor2@gmail.com', '1020', 'vendedor2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1999-11-22 00:00:00', 'DNI', 40234429, 5, '1123452300', 1),
(11, 5, '', '', NULL, 'tu_carnicero@gmail.com', NULL, 'carni_carn', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, NULL, 5, NULL, 1),
(12, 5, '', '', NULL, 'tu_carnicero@gmail.com', NULL, 'carni_carn', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, NULL, 5, NULL, 1),
(13, 3, '', '', NULL, 'cliente@cliente.com', NULL, 'cliente_fa', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, NULL, 5, NULL, 1),
(15, 1, '', '', NULL, 'admin_carniceria2@admin.com', NULL, 'admin2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, NULL, 5, NULL, 1),
(16, 4, '', '', NULL, 'vendedor10@gmail.com', NULL, 'vendedor10', 'e8827f3c0bcc90509b7d6841d446b163a671cac807a5f1bf41218667546ce80b', NULL, NULL, NULL, 5, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tipos`
--

CREATE TABLE `usuarios_tipos` (
  `id_tipo_usuario` int(10) UNSIGNED NOT NULL,
  `detalle_tipo_usuario` varchar(15) NOT NULL DEFAULT 'Cliente' COMMENT 'Cliente | Socio | Admin | Vendedor | Carnicero.-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios_tipos`
--

INSERT INTO `usuarios_tipos` (`id_tipo_usuario`, `detalle_tipo_usuario`) VALUES
(1, 'Admin'),
(2, 'Socio'),
(3, 'Cliente'),
(4, 'Vendedor'),
(5, 'Carnicero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(10) UNSIGNED NOT NULL,
  `id_vendedor` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_cliente` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `fecha_venta` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tipo_venta` varchar(10) NOT NULL DEFAULT '' COMMENT 'Presencial | Web',
  `descuento_venta` float NOT NULL DEFAULT 0,
  `estado_venta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_vendedor`, `id_cliente`, `fecha_venta`, `tipo_venta`, `descuento_venta`, `estado_venta`) VALUES
(2, 7, 6, '2023-05-26 00:00:00', 'presencial', 0, 1),
(3, 9, 8, '0000-00-00 00:00:00', 'presencial', 0, 1),
(4, 4, 8, '2023-06-03 06:58:21', 'Web', 0, 1),
(5, 7, 6, '2023-05-26 00:00:00', 'web', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalles`
--

CREATE TABLE `ventas_detalles` (
  `id_detalle_venta` int(10) UNSIGNED NOT NULL,
  `id_venta` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_producto` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cant_producto` float NOT NULL DEFAULT 0,
  `precio_unitario_producto` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ventas_detalles`
--

INSERT INTO `ventas_detalles` (`id_detalle_venta`, `id_venta`, `id_producto`, `cant_producto`, `precio_unitario_producto`) VALUES
(1, 4, 3, 5, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_pagos`
--

CREATE TABLE `ventas_pagos` (
  `id_venta` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `detalle_forma_pago` varchar(10) NOT NULL DEFAULT '' COMMENT 'Efectivo | Credito | Debito | Etc.-',
  `monto_pago` float NOT NULL DEFAULT 0,
  `cupon_pago` double NOT NULL DEFAULT 0,
  `estado_pago` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_sucursal`,`id_producto`),
  ADD KEY `FK_stock_2` (`id_producto`);

--
-- Indices de la tabla `stock_actualiza`
--
ALTER TABLE `stock_actualiza`
  ADD PRIMARY KEY (`id_actualiza`),
  ADD KEY `FK_actualiza_stock_1` (`id_sucursal`),
  ADD KEY `FK_actualiza_stock_2` (`id_usuario`);

--
-- Indices de la tabla `stock_actualiza_detalle`
--
ALTER TABLE `stock_actualiza_detalle`
  ADD PRIMARY KEY (`id_detalle_actualiza`),
  ADD KEY `FK_actualiza_detalle_1` (`id_actualiza`),
  ADD KEY `FK_actualiza_detalle_2` (`id_producto`);

--
-- Indices de la tabla `stock_pedidos`
--
ALTER TABLE `stock_pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `FK_pedidos_1` (`id_sucursal`),
  ADD KEY `FK_pedidos_2` (`id_usuario_pedido`) USING BTREE,
  ADD KEY `FK_stock_pedidos_3` (`id_usuario_gestion`);

--
-- Indices de la tabla `stock_pedidos_detalles`
--
ALTER TABLE `stock_pedidos_detalles`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `FK_pedidos_detalles_1` (`id_pedido`),
  ADD KEY `FK_pedidos_detalles_2` (`id_producto`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_sucursal`),
  ADD KEY `FK_sucursales_1` (`id_gerente (int)`);

--
-- Indices de la tabla `sucursales_stock`
--
ALTER TABLE `sucursales_stock`
  ADD PRIMARY KEY (`id_sucursal`,`id_producto`),
  ADD KEY `FK_sucursal_stock_2` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_usuarios_1` (`id_sucursal`),
  ADD KEY `FK_usuarios_2` (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios_tipos`
--
ALTER TABLE `usuarios_tipos`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `FK_ventas_1` (`id_vendedor`),
  ADD KEY `FK_ventas_2` (`id_cliente`);

--
-- Indices de la tabla `ventas_detalles`
--
ALTER TABLE `ventas_detalles`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `FK_ventas_detalles_1` (`id_venta`),
  ADD KEY `FK_ventas_detalles_2` (`id_producto`);

--
-- Indices de la tabla `ventas_pagos`
--
ALTER TABLE `ventas_pagos`
  ADD KEY `FK_ventas_formas_pagos_1` (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `stock_actualiza`
--
ALTER TABLE `stock_actualiza`
  MODIFY `id_actualiza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock_actualiza_detalle`
--
ALTER TABLE `stock_actualiza_detalle`
  MODIFY `id_detalle_actualiza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock_pedidos`
--
ALTER TABLE `stock_pedidos`
  MODIFY `id_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock_pedidos_detalles`
--
ALTER TABLE `stock_pedidos_detalles`
  MODIFY `id_detalle_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_sucursal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios_tipos`
--
ALTER TABLE `usuarios_tipos`
  MODIFY `id_tipo_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas_detalles`
--
ALTER TABLE `ventas_detalles`
  MODIFY `id_detalle_venta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_stock_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `FK_stock_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `stock_actualiza`
--
ALTER TABLE `stock_actualiza`
  ADD CONSTRAINT `FK_actualiza_stock_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `FK_actualiza_stock_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `stock_actualiza_detalle`
--
ALTER TABLE `stock_actualiza_detalle`
  ADD CONSTRAINT `FK_actualiza_detalle_1` FOREIGN KEY (`id_actualiza`) REFERENCES `stock_actualiza` (`id_actualiza`),
  ADD CONSTRAINT `FK_actualiza_detalle_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `stock_pedidos`
--
ALTER TABLE `stock_pedidos`
  ADD CONSTRAINT `FK_pedidos_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `FK_stock_pedidos_2` FOREIGN KEY (`id_usuario_pedido`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `FK_stock_pedidos_3` FOREIGN KEY (`id_usuario_gestion`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `stock_pedidos_detalles`
--
ALTER TABLE `stock_pedidos_detalles`
  ADD CONSTRAINT `FK_pedidos_detalles_1` FOREIGN KEY (`id_pedido`) REFERENCES `stock_pedidos` (`id_pedido`),
  ADD CONSTRAINT `FK_pedidos_detalles_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `sucursales_stock`
--
ALTER TABLE `sucursales_stock`
  ADD CONSTRAINT `FK_sucursal_stock_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `FK_sucursal_stock_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `FK_usuarios_2` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `usuarios_tipos` (`id_tipo_usuario`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `FK_ventas_1` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `FK_ventas_2` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_detalles`
--
ALTER TABLE `ventas_detalles`
  ADD CONSTRAINT `FK_ventas_detalles_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `FK_ventas_detalles_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `ventas_pagos`
--
ALTER TABLE `ventas_pagos`
  ADD CONSTRAINT `FK_ventas_formas_pagos_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
