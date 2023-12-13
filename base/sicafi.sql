-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2023 a las 23:26:12
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sicafi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_activo`
--

CREATE TABLE `asignacion_activo` (
  `id` bigint(20) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `codigo_institucional` varchar(225) NOT NULL,
  `encargado_bien` varchar(225) NOT NULL,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fk_ingreso_entradas` bigint(20) NOT NULL,
  `fk_usuarios` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignacion_activo`
--

INSERT INTO `asignacion_activo` (`id`, `fecha_asignacion`, `codigo_institucional`, `encargado_bien`, `estado`, `fk_ingreso_entradas`, `fk_usuarios`, `fecha_creacion`) VALUES
(4, '2023-07-26', '281520202178', 'Natalie Castillo', 'Activo', 60, 26, '2023-07-26 15:19:53'),
(5, '2023-07-26', '241530201176', 'Esteban Castillo', 'Activo', 1, 25, '2023-07-26 16:34:54'),
(6, '2023-07-27', '2610142669968', 'Oscar ', 'Activo', 62, 25, '2023-07-27 14:21:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` bigint(20) NOT NULL,
  `evento` text NOT NULL,
  `usuario` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) NOT NULL,
  `categoria` varchar(225) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha_creacion`) VALUES
(1, 'Maquinaria y Equipo de Oficina', '2023-05-15 13:28:47'),
(2, 'Equipo Informatico', '2023-05-16 01:35:32'),
(3, 'Aparatos de Servicios Electricos', '2023-06-02 16:47:48'),
(4, 'Transporte', '2023-07-26 15:05:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_suministros`
--

CREATE TABLE `categorias_suministros` (
  `categoria_id` int(11) NOT NULL,
  `nomb_categoria` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_entradas`
--

CREATE TABLE `ingreso_entradas` (
  `id` bigint(20) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `numero_factura` varchar(225) DEFAULT NULL,
  `costo_adquisicion` int(11) NOT NULL COMMENT 'esta columna guarda el costo en centavos de dolares',
  `nombre_adquisicion` varchar(250) NOT NULL,
  `serie_adquisicion` varchar(225) DEFAULT NULL,
  `marca` varchar(225) NOT NULL,
  `modelo` varchar(225) NOT NULL,
  `color` varchar(225) NOT NULL,
  `descripcion_adquisicion` varchar(225) DEFAULT NULL,
  `boolean_transporte` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'esto es para el switch de la vista',
  `numero_motor` varchar(225) DEFAULT NULL,
  `numero_placa` varchar(225) DEFAULT NULL,
  `numero_chasis` varchar(225) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `cargo` enum('Donado','Comprado') NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'esta sirve para cambiar el estado para saber si es verdadero o no',
  `vida_util` int(11) DEFAULT NULL,
  `fk_categoria` bigint(20) NOT NULL,
  `fk_proveedores` bigint(20) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso_entradas`
--

INSERT INTO `ingreso_entradas` (`id`, `fecha_adquisicion`, `numero_factura`, `costo_adquisicion`, `nombre_adquisicion`, `serie_adquisicion`, `marca`, `modelo`, `color`, `descripcion_adquisicion`, `boolean_transporte`, `numero_motor`, `numero_placa`, `numero_chasis`, `capacidad`, `cargo`, `estado`, `vida_util`, `fk_categoria`, `fk_proveedores`, `fecha_creacion`) VALUES
(1, '2023-05-15', '0001', 150, 'Silla ejecutiva', 'cxlmnlop', 'AQUILES', 'Ergoflex', 'Negro', 'sillas de Oficina Ejecutivas para la unidad de informatica                   ', 0, NULL, NULL, NULL, NULL, '', 1, 3, 1, 1, '2023-05-15 13:29:40'),
(60, '2023-06-18', '002', 410, 'Escritorio de Altura Ajustable', 'lmxcvf', 'KINEMA', 'NUX', 'azul', ' Mueble de escritorio para la unidad de infromatica                   ', 0, '', '', '', 0, 'Comprado', 1, 1, 1, 2, '2023-06-17 22:54:43'),
(62, '2023-06-18', '0003', 1774, 'Moto', '52WVC10338', 'HONDA', 'V-MEN A', 'Rojo', 'Compra para la unidad de medio ambiente                   ', 1, '9FMPCJ92', '589625', 'F15AEH', 2, 'Comprado', 1, 6, 4, 2, '2023-06-18 02:30:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_suministros`
--

CREATE TABLE `ingreso_suministros` (
  `id` bigint(20) NOT NULL,
  `fecha_suministro` date NOT NULL,
  `nombre_suministro` varchar(225) NOT NULL,
  `marca` varchar(225) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL COMMENT 'se manejara en centavos',
  `descripcion` varchar(225) DEFAULT NULL,
  `presentacion` varchar(50) DEFAULT NULL,
  `unidad_medida` varchar(225) DEFAULT NULL,
  `existencia_minima` int(11) DEFAULT NULL,
  `existencia_maxima` int(11) DEFAULT NULL,
  `almacen` varchar(50) DEFAULT NULL,
  `estante` varchar(25) DEFAULT NULL,
  `entrepaño` varchar(25) DEFAULT NULL,
  `casilla` varchar(25) DEFAULT NULL,
  `numero_tarjeta` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `stock_suministros` int(11) NOT NULL,
  `ubicacion` varchar(225) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `codigo_barra` varchar(225) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso_suministros`
--

INSERT INTO `ingreso_suministros` (`id`, `fecha_suministro`, `nombre_suministro`, `marca`, `cantidad`, `precio`, `descripcion`, `presentacion`, `unidad_medida`, `existencia_minima`, `existencia_maxima`, `almacen`, `estante`, `entrepaño`, `casilla`, `numero_tarjeta`, `codigo`, `stock_suministros`, `ubicacion`, `categoria_id`, `codigo_barra`, `fecha_creacion`) VALUES
(1, '0000-00-00', '', '', 0, 0, '                      ', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', 0, '', '2023-06-27 22:56:39'),
(2, '0000-00-00', '', '', 0, 0, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', 0, '', '2023-06-28 00:48:56'),
(1688304446, '0000-00-00', 'borrador ', '', 0, 0, NULL, 'caja', 'ddd', 3, 10, 'dddd', 'ddd', 'ddd', 'd', 0, 0, 0, NULL, 0, '0125879992', '2023-07-02 13:27:26'),
(1688307390, '0000-00-00', 'lapiceros', '', 0, 0, NULL, 'caja', 'caja', 2, 20, 'al', 'a', 'no se', 'no se', 0, 0, 0, NULL, 0, '054979797979797', '2023-07-02 14:16:30'),
(1688308015, '0000-00-00', 'clics', '', 0, 0, NULL, 'caja', 'caja', 10, 50, 'principal', 'b', 'no se', 'no se', 0, 0, 0, NULL, 0, '25252525', '2023-07-02 14:26:55'),
(1689628422, '0000-00-00', 'papel higienico', '', 0, 0, NULL, 'fardo', 'nos ', 10, 20, 'nose', 'nosr', 'nose', '10', 0, 0, 0, NULL, 0, '55125655225', '2023-07-17 21:13:42'),
(1689782653, '0000-00-00', 'asistin', '', 0, 0, NULL, 'bote', 'litro', 20, 30, 'uno', 'uno', 'uno', 'uno', 0, 0, 0, NULL, 0, '252544884445665', '2023-07-19 16:04:13'),
(1690467905, '0000-00-00', 'dfghjhj', '', 0, 0, NULL, 'ghjk', 'fghjk', 10, 20, 'fghjkl', 'hjk', 'ghjk', 'fgh', 0, 0, 0, NULL, 0, '555555555888', '2023-07-27 14:25:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `concepto` varchar(225) NOT NULL,
  `movimiento` int(11) NOT NULL,
  `cantidad_entrada` int(11) NOT NULL,
  `precio_entrada` int(11) NOT NULL,
  `cantidad_salida` int(11) NOT NULL,
  `saldo_articulos` int(11) NOT NULL,
  `fondos_procedencia` int(11) NOT NULL,
  `precio_salida` int(11) NOT NULL,
  `fk_ingreso_suministros` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id`, `fecha`, `concepto`, `movimiento`, `cantidad_entrada`, `precio_entrada`, `cantidad_salida`, `saldo_articulos`, `fondos_procedencia`, `precio_salida`, `fk_ingreso_suministros`, `fecha_creacion`) VALUES
(1688308123, '2023-07-02', 'asdfghjkl', 0, 2, 2, 0, 0, 0, 0, 1688308015, '2023-07-02 14:28:43'),
(1689628447, '2023-07-17', 'sdfghjklfdsdfghjkl', 0, 3, 5, 0, 0, 0, 0, 1689628422, '2023-07-17 21:14:07'),
(1689782680, '2023-07-19', 'se registro dos botes de asistin', 0, 6, 2, 0, 0, 0, 0, 1689782653, '2023-07-19 16:04:40'),
(1689782711, '2023-07-19', 'dfdfdfd', 0, 3, 2, 0, 0, 0, 0, 1689782653, '2023-07-19 16:05:11'),
(1690467942, '2023-07-27', 'fghjklññlkjhgfddfghjklñlkjh', 0, 2, 2, 0, 0, 0, 0, 1690467905, '2023-07-27 14:25:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_activos`
--

CREATE TABLE `mantenimiento_activos` (
  `id` bigint(20) NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `tipo_movimiento` enum('Prestamo','TrasladoDefinitivo','Reparacion','Inservible','Robo y/o Hurto','Obsoleto') NOT NULL,
  `observaciones` varchar(225) DEFAULT NULL,
  `tipo_registro` enum('mantenimiento','descargo') NOT NULL DEFAULT 'mantenimiento' COMMENT 'se usara para identificar entre moviminetos de activo y descargo de activo se tomara el nombre para indicar que es moviento de activo y para descargo de activo ',
  `fk_ingreso_entradas` bigint(20) NOT NULL,
  `fk_unidades` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint(20) NOT NULL,
  `proveedor` varchar(225) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `proveedor`, `fecha_creacion`) VALUES
(1, 'siman', '2023-05-15 13:27:45'),
(2, 'curacao', '2023-05-16 01:34:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisicion_suministros`
--

CREATE TABLE `requisicion_suministros` (
  `id` bigint(20) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `unidad_medida` varchar(225) DEFAULT NULL,
  `descripcion_suminstro` varchar(250) NOT NULL,
  `cantidad` int(11) NOT NULL COMMENT 'tiene que ser igual o menor que ingreso de suministros',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `aprobacion` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'siempre y cuando se tengan disponibles los suministros que se esten solicitando',
  `fk_unidades` bigint(20) NOT NULL,
  `fk_ingreso_suminitros` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` bigint(20) NOT NULL,
  `nombre_unidad` varchar(225) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre_unidad`, `fecha_creacion`) VALUES
(1, 'Recursos Humanos ', '2023-06-26 01:19:18'),
(2, 'Informatica', '2023-06-26 01:21:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(225) NOT NULL,
  `apellido` varchar(225) NOT NULL,
  `usuario` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `contrasena` varchar(225) NOT NULL,
  `rol` enum('Jefe','Administrador') DEFAULT NULL COMMENT 'esta columna se ingresa los roles ',
  `permisos` enum('Almacen','Activo Fijo','UACI') DEFAULT NULL COMMENT 'se le asignaran los permisos para generar las restricciones ',
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fk_unidades` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `email`, `contrasena`, `rol`, `permisos`, `estado`, `fk_unidades`, `fecha_creacion`) VALUES
(1, 'Juan ', 'Perez', 'juan.juan', 'natalie@gmail.com', 'hola', 'Jefe', NULL, 'Activo', 1, '2023-05-19 21:08:40'),
(2, 'Natalie', 'Castillo', 'Nat72', 'castillonatalie72@gmail.com', 'hola', 'Administrador', NULL, 'Activo', 1, '2023-06-03 01:57:42'),
(3, 'Hola', 'Maravilla', 'h.maravilla', 'maravilla@gmail.com', 'hola', 'Administrador', NULL, 'Inactivo', 2, '2023-06-03 02:01:39'),
(4, 'josabeth', 'fdfgkhdfgjf', 'fdgjkfdghdfg', 'skjhdfjfsdfh@gmail.com', '12345', 'Jefe', NULL, 'Activo', 1, '2023-06-03 02:04:44'),
(8, 'prueba del ', 'error', 'error', 'error@gmail.com', '12345', 'Jefe', NULL, 'Activo', 2, '2023-06-03 02:07:03'),
(25, 'Daniela', 'Castillo', 'dan14', 'daniela@gmail.com', '21d8485f74b7a8993d81f4b66dbb03b8', 'Jefe', NULL, 'Activo', 2, '2023-07-08 01:43:30'),
(26, 'Brenda ', 'Guillen', 'bren22', 'brenda@gmail.com', '6e6e2ddb6346ce143d19d79b3358c16a', 'Administrador', 'UACI', 'Activo', 2, '2023-07-08 03:25:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion_activo`
--
ALTER TABLE `asignacion_activo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignacion_activo_usuarios_id_fk` (`fk_usuarios`),
  ADD KEY `asignacion_activo_ingreso_entradas_id_fk` (`fk_ingreso_entradas`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_suministros`
--
ALTER TABLE `categorias_suministros`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `ingreso_entradas`
--
ALTER TABLE `ingreso_entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingreso_entradas_proveedores_id_fk` (`fk_proveedores`),
  ADD KEY `ingreso_entradas_categorias_id_fk` (`fk_categoria`);

--
-- Indices de la tabla `ingreso_suministros`
--
ALTER TABLE `ingreso_suministros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kardex_ingreso_suministros_id_fk` (`fk_ingreso_suministros`);

--
-- Indices de la tabla `mantenimiento_activos`
--
ALTER TABLE `mantenimiento_activos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mantenimiento_activos_unidades_id_fk` (`fk_unidades`),
  ADD KEY `mantenimiento_activos_ingreso_entradas_id_fk` (`fk_ingreso_entradas`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `requisicion_suministros`
--
ALTER TABLE `requisicion_suministros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisicion_suministros_unidades_id_fk` (`fk_unidades`),
  ADD KEY `requisicion_suministros_ingreso_suministros_id_fk` (`fk_ingreso_suminitros`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unidades_pk2` (`nombre_unidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_pk` (`email`),
  ADD KEY `usuarios_unidades_id_fk` (`fk_unidades`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion_activo`
--
ALTER TABLE `asignacion_activo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias_suministros`
--
ALTER TABLE `categorias_suministros`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso_entradas`
--
ALTER TABLE `ingreso_entradas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `ingreso_suministros`
--
ALTER TABLE `ingreso_suministros`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1690467906;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1690467943;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_activos`
--
ALTER TABLE `mantenimiento_activos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `requisicion_suministros`
--
ALTER TABLE `requisicion_suministros`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_activo`
--
ALTER TABLE `asignacion_activo`
  ADD CONSTRAINT `asignacion_activo_ingreso_entradas_id_fk` FOREIGN KEY (`fk_ingreso_entradas`) REFERENCES `ingreso_entradas` (`id`),
  ADD CONSTRAINT `asignacion_activo_usuarios_id_fk` FOREIGN KEY (`fk_usuarios`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `ingreso_entradas`
--
ALTER TABLE `ingreso_entradas`
  ADD CONSTRAINT `ingreso_entradas_categorias_id_fk` FOREIGN KEY (`fk_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `ingreso_entradas_proveedores_id_fk` FOREIGN KEY (`fk_proveedores`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ingreso_suministros_id_fk` FOREIGN KEY (`fk_ingreso_suministros`) REFERENCES `ingreso_suministros` (`id`);

--
-- Filtros para la tabla `mantenimiento_activos`
--
ALTER TABLE `mantenimiento_activos`
  ADD CONSTRAINT `mantenimiento_activos_ingreso_entradas_id_fk` FOREIGN KEY (`fk_ingreso_entradas`) REFERENCES `ingreso_entradas` (`id`),
  ADD CONSTRAINT `mantenimiento_activos_unidades_id_fk` FOREIGN KEY (`fk_unidades`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `requisicion_suministros`
--
ALTER TABLE `requisicion_suministros`
  ADD CONSTRAINT `requisicion_suministros_ingreso_suministros_id_fk` FOREIGN KEY (`fk_ingreso_suminitros`) REFERENCES `ingreso_suministros` (`id`),
  ADD CONSTRAINT `requisicion_suministros_unidades_id_fk` FOREIGN KEY (`fk_unidades`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_unidades_id_fk` FOREIGN KEY (`fk_unidades`) REFERENCES `unidades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
