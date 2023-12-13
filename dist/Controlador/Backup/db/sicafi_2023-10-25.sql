SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS asignacion_activo CASCADE;

CREATE TABLE `asignacion_activo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_asignacion` date NOT NULL,
  `codigo_institucional` varchar(225) NOT NULL,
  `encargado_bien` varchar(225) NOT NULL,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `estado_bien` enum('Buen Estado','Descartado') DEFAULT 'Buen Estado',
  `fk_ingreso_entradas` bigint(20) NOT NULL,
  `fk_usuarios` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `asignacion_activo_pk` (`codigo_institucional`),
  KEY `asignacion_activo_usuarios_id_fk` (`fk_usuarios`),
  KEY `asignacion_activo_ingreso_entradas_id_fk` (`fk_ingreso_entradas`),
  CONSTRAINT `asignacion_activo_ingreso_entradas_id_fk` FOREIGN KEY (`fk_ingreso_entradas`) REFERENCES `ingreso_entradas` (`id`),
  CONSTRAINT `asignacion_activo_usuarios_id_fk` FOREIGN KEY (`fk_usuarios`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO asignacion_activo VALUES("32","2023-09-27","77-777-77-77-77","adolfo","Activo","Buen Estado","111","2","2023-09-27 09:06:45");
INSERT INTO asignacion_activo VALUES("33","2023-09-30","44-888-88-88-88undefined","probando limpiar campos","Activo","Buen Estado","113","2","2023-09-30 17:44:21");
INSERT INTO asignacion_activo VALUES("34","2023-09-30","77-555-55-55-555","prueba2","Activo","Buen Estado","114","8","2023-09-30 18:04:10");
INSERT INTO asignacion_activo VALUES("35","2023-10-02","10-888-88-88-666","PROBANDO TODO MOVIMIENTOS","Activo","Buen Estado","115","2","2023-10-01 16:26:51");
INSERT INTO asignacion_activo VALUES("36","2023-10-13","50-678-67-78-600","FFaustino","Activo","Buen Estado","117","57","2023-10-13 09:20:59");
INSERT INTO asignacion_activo VALUES("37","2023-10-25","44-666-66-77-555","Doris","Activo","Buen Estado","116","65","2023-10-25 09:17:35");


DROP TABLE IF EXISTS bitacora CASCADE;

CREATE TABLE `bitacora` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evento` text NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO bitacora VALUES("1","Inicio Sesión","Pedro Mora","2023-10-25 11:00:56");
INSERT INTO bitacora VALUES("2","Cerro Sesión","Pedro Mora","2023-10-25 11:01:02");
INSERT INTO bitacora VALUES("3","Inicio Sesión","Blanqui Melara","2023-10-25 11:01:07");
INSERT INTO bitacora VALUES("4","Cerro Sesión","Blanqui Melara","2023-10-25 14:44:26");
INSERT INTO bitacora VALUES("5","Inicio Sesión","Blanqui Melara","2023-10-25 14:44:34");


DROP TABLE IF EXISTS categorias CASCADE;

CREATE TABLE `categorias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(225) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `vida_util` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO categorias VALUES("1","Maquinaria y Equipo de Oficina","2023-05-15 07:28:47","5");
INSERT INTO categorias VALUES("2","Equipo Informatico","2023-05-15 19:35:32","0");
INSERT INTO categorias VALUES("3","Aparatos de Servicios Electricos","2023-06-02 10:47:48","0");
INSERT INTO categorias VALUES("4","Transporte","2023-07-26 09:05:22","0");
INSERT INTO categorias VALUES("5","Equipo Refrigerante","2023-08-10 09:45:45","0");
INSERT INTO categorias VALUES("6","Equipo Visual y Fotográfico","2023-08-10 09:48:33","0");
INSERT INTO categorias VALUES("7","Otra","2023-08-27 15:43:48","0");
INSERT INTO categorias VALUES("8","prueba15","2023-08-28 20:54:02","0");
INSERT INTO categorias VALUES("9","hola","2023-09-27 16:49:45","4");


DROP TABLE IF EXISTS categorias_suministros CASCADE;

CREATE TABLE `categorias_suministros` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomb_categoria` varchar(25) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO categorias_suministros VALUES("1","Alimentos");
INSERT INTO categorias_suministros VALUES("2","Materiales de Oficina");
INSERT INTO categorias_suministros VALUES("3","Materiales Pegamento");
INSERT INTO categorias_suministros VALUES("4","Papel");
INSERT INTO categorias_suministros VALUES("5","Desechables");


DROP TABLE IF EXISTS detalle_requisicion CASCADE;

CREATE TABLE `detalle_requisicion` (
  `id` bigint(20) NOT NULL,
  `requisicion_id` int(11) NOT NULL,
  `suministro_id` bigint(20) NOT NULL,
  `cantidad_solicitada` int(11) NOT NULL,
  `cantidad_aprobada` int(11) DEFAULT NULL,
  `cantidad_despachada` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `detalle_requisicion_id_uindex` (`id`),
  KEY `detalle_requisicion_ingreso_suministros_id_fk` (`suministro_id`),
  KEY `detalle_requisicion_requisicion_suministro_id_fk` (`requisicion_id`),
  CONSTRAINT `detalle_requisicion_ingreso_suministros_id_fk` FOREIGN KEY (`suministro_id`) REFERENCES `ingreso_suministros` (`id`),
  CONSTRAINT `detalle_requisicion_requisicion_suministro_id_fk` FOREIGN KEY (`requisicion_id`) REFERENCES `requisicion_suministro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO detalle_requisicion VALUES("1698074356770248","1698074356","1698073956","1","1","");
INSERT INTO detalle_requisicion VALUES("1698074356778172","1698074356","1698074028","1","1","");
INSERT INTO detalle_requisicion VALUES("1698074356781649","1698074356","1698073838","1","1","");
INSERT INTO detalle_requisicion VALUES("1698074725815170","1698074725","1698073956","2","2","2");
INSERT INTO detalle_requisicion VALUES("1698075848565550","1698075848","1698074028","1","1","1");
INSERT INTO detalle_requisicion VALUES("1698075848569505","1698075848","1698073838","1","1","1");
INSERT INTO detalle_requisicion VALUES("1698876210034324","1698876210","1698090849","5","5","5");


DROP TABLE IF EXISTS estado_requisicion CASCADE;

CREATE TABLE `estado_requisicion` (
  `id` int(11) NOT NULL,
  `nombre_estado` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `codigo` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `estado_requisicion_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO estado_requisicion VALUES("1","Pendiente de aprobación","pendiente.aprobacion");
INSERT INTO estado_requisicion VALUES("2","Pendiente de despacho","pendiente.despacho");
INSERT INTO estado_requisicion VALUES("3","Finalizado","finalizado");


DROP TABLE IF EXISTS ingreso_entradas CASCADE;

CREATE TABLE `ingreso_entradas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_adquisicion` date NOT NULL,
  `numero_factura` varchar(225) DEFAULT NULL,
  `costo_adquisicion` float NOT NULL COMMENT 'esta columna guarda el costo en centavos de dolares',
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
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor_rescate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ingreso_entradas_proveedores_id_fk` (`fk_proveedores`),
  KEY `ingreso_entradas_categorias_id_fk` (`fk_categoria`),
  CONSTRAINT `ingreso_entradas_categorias_id_fk` FOREIGN KEY (`fk_categoria`) REFERENCES `categorias` (`id`),
  CONSTRAINT `ingreso_entradas_proveedores_id_fk` FOREIGN KEY (`fk_proveedores`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO ingreso_entradas VALUES("111","2023-09-27","001","129","SILLA EJECUTIVA","SKU","PU","31796","NEGRA","undefined","0","","","","0","Comprado","1","","1","10","2023-09-27 07:22:25","2");
INSERT INTO ingreso_entradas VALUES("113","2023-09-27","002","200","Escritorio","defrrr","nueva","nuevo","azul","undefined","0","","","","0","Comprado","1","","9","2","2023-09-27 09:05:25","50");
INSERT INTO ingreso_entradas VALUES("114","2023-10-01","004","100","jjjj","jjjj","jjj","jj","jjj","undefined","0","","","","0","Comprado","1","","3","2","2023-09-30 17:54:32","0");
INSERT INTO ingreso_entradas VALUES("115","2023-10-02","004","149","TECLADO","KUPL","EPSON","31245","BLANCO","undefined","0","","","","0","Comprado","1","","2","9","2023-10-01 16:17:25","0");
INSERT INTO ingreso_entradas VALUES("116","2023-10-02","005","40.8","MOUSE","MLOP","HP","7896","NEGRO","undefined","0","","","","0","Comprado","1","0","2","1","2023-10-01 16:26:08","0");
INSERT INTO ingreso_entradas VALUES("117","2023-10-13","12","450","Escritorio","aqee","luxur","Imperial","negro","undefined","0","","","","0","Comprado","1","","1","2","2023-10-13 08:43:53","90");
INSERT INTO ingreso_entradas VALUES("118","2023-10-19","124","903.69","Silla","kjhikj","Failux","Ergomico 30","Negra","undefined","0","","","","0","Comprado","1","0","1","9","2023-10-18 16:30:31","180");
INSERT INTO ingreso_entradas VALUES("119","2023-10-19","asda","480.25","computadora","hjioo88888","Levono","seis","Negra","undefined","0","","","","0","Comprado","1","0","2","1","2023-10-18 16:40:48","0");
INSERT INTO ingreso_entradas VALUES("120","2023-10-25","1234","34.8","Teclado","12345","Dell","01g","Negro","undefined","0","","","","0","Comprado","1","","2","10","2023-10-25 09:57:01","0");
INSERT INTO ingreso_entradas VALUES("121","2023-10-25","1234","34.8","Teclado","12345","Dell","01g","Negro","undefined","0","","","","0","Comprado","1","","2","10","2023-10-25 09:57:09","0");
INSERT INTO ingreso_entradas VALUES("122","2023-10-25","12345","56000","Carro Hilux 4x4","123467","Toyota","Hilux 4x4","Gris plata","undefined","0","213234234","bvt555666","678","6","Comprado","1","0","4","11","2023-10-25 10:03:45","0");
INSERT INTO ingreso_entradas VALUES("123","2023-10-25","12355","400","Estante de 3 niveles","hilo","Plexon","sorioon","gris","undefined","0","","","","0","Comprado","1","0","1","9","2023-10-25 10:07:39","80");
INSERT INTO ingreso_entradas VALUES("124","2023-10-25","09890","250","Silla Ejecutiva","hilonnmm","Cosq","2000","Negra","undefined","0","","","","0","Comprado","1","","1","2","2023-10-25 10:09:57","50");
INSERT INTO ingreso_entradas VALUES("125","2023-10-25","34345345","30","Bocina","jol","sonic","model","negras","undefined","0","","","","0","Comprado","1","0","1","2","2023-10-25 10:19:31","6");
INSERT INTO ingreso_entradas VALUES("126","2023-10-25","123","200","Escritorio","thu","maxi","dersi","Madera","undefined","0","","","","0","Comprado","1","","1","2","2023-10-25 10:23:40","40");


DROP TABLE IF EXISTS ingreso_suministros CASCADE;

CREATE TABLE `ingreso_suministros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_suministro` date NOT NULL,
  `nombre_suministro` varchar(225) NOT NULL,
  `marca` varchar(225) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL COMMENT 'se manejara en centavos',
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
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1698090850 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO ingreso_suministros VALUES("1698073838","0000-00-00","Papel Bond","","0","0","","Resma","","10","40","","","","","0","0","0","","2","12345678900","2023-10-23 09:10:38");
INSERT INTO ingreso_suministros VALUES("1698073956","0000-00-00","Lapiceros Bic Azul","","0","0","","Caja","","10","30","","","","","0","0","0","","2","0098765432","2023-10-23 09:12:36");
INSERT INTO ingreso_suministros VALUES("1698074028","0000-00-00","Lapiceros Bic Negros","","0","0","","Caja","","10","30","","","","","0","0","0","","2","678901234501","2023-10-23 09:13:48");
INSERT INTO ingreso_suministros VALUES("1698090849","0000-00-00","Papel Higienico","","0","0","","Unidad","","10","50","","","","","0","0","0","","5","5643098322","2023-10-23 13:54:09");


DROP TABLE IF EXISTS kardex CASCADE;

CREATE TABLE `kardex` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `kardex_ingreso_suministros_id_fk` (`fk_ingreso_suministros`),
  CONSTRAINT `kardex_ingreso_suministros_id_fk` FOREIGN KEY (`fk_ingreso_suministros`) REFERENCES `ingreso_suministros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1698245295677198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO kardex VALUES("1698073913","2023-10-23","Compra de Unidad de Cmpras","0","30","8","0","0","0","0","1698073838","2023-10-23 09:11:53");
INSERT INTO kardex VALUES("1698073998","2023-10-23","Compras de Unidad de compras","0","30","6","0","0","0","0","1698073956","2023-10-23 09:13:18");
INSERT INTO kardex VALUES("1698074050","2023-10-23","Compras de Unidad","0","30","6","0","0","0","0","1698074028","2023-10-23 09:14:10");
INSERT INTO kardex VALUES("1698091013","2023-10-23","Compra","0","25","1","0","0","0","0","1698090849","2023-10-23 13:56:53");
INSERT INTO kardex VALUES("1698091861","2023-10-23","compra","0","10","1","0","0","0","0","1698090849","2023-10-23 14:11:01");
INSERT INTO kardex VALUES("1698074774074324","2023-10-23","Salida de requisicion: 1698074725","0","0","0","2","0","0","0","1698073956","2023-10-23 17:26:14");
INSERT INTO kardex VALUES("1698075933264022","2023-10-23","Salida de requisicion: 1698075848","0","0","0","1","0","0","0","1698073838","2023-10-23 17:45:33");
INSERT INTO kardex VALUES("1698075933271412","2023-10-23","Salida de requisicion: 1698075848","0","0","0","1","0","0","0","1698074028","2023-10-23 17:45:33");
INSERT INTO kardex VALUES("1698245295677197","2023-10-25","Salida de requisicion: 1698876210","0","0","0","5","0","0","0","1698090849","2023-10-25 16:48:15");


DROP TABLE IF EXISTS mantenimiento_activos CASCADE;

CREATE TABLE `mantenimiento_activos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_movimiento` date NOT NULL,
  `tipo_movimiento` enum('Prestamo','TrasladoDefinitivo','Reparacion','Inservible','Robo y/o Hurto','Obsoleto') NOT NULL,
  `observaciones` varchar(225) DEFAULT NULL,
  `tipo_registro` enum('mantenimiento','descargo') NOT NULL DEFAULT 'mantenimiento' COMMENT 'se usara para identificar entre moviminetos de activo y descargo de activo se tomara el nombre para indicar que es moviento de activo y para descargo de activo ',
  `fk_asignacion_activo` bigint(20) NOT NULL,
  `fk_unidades` bigint(20) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `mantenimiento_activos_unidades_id_fk` (`fk_unidades`),
  KEY `mantenimiento_activos_ingreso_entradas_id_fk` (`fk_asignacion_activo`),
  CONSTRAINT `mantenimiento_activos_asignacion_activo_id_fk` FOREIGN KEY (`fk_asignacion_activo`) REFERENCES `asignacion_activo` (`id`),
  CONSTRAINT `mantenimiento_activos_unidades_id_fk` FOREIGN KEY (`fk_unidades`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO mantenimiento_activos VALUES("1","2023-10-23","TrasladoDefinitivo","","mantenimiento","36","","2023-10-23 14:04:20");


DROP TABLE IF EXISTS mobiliario_otros CASCADE;

CREATE TABLE `mobiliario_otros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `nombre` varchar(225) NOT NULL,
  `modelo` varchar(225) NOT NULL,
  `valor` int(11) NOT NULL,
  `descripcion` varchar(225) NOT NULL,
  `estado_mobi` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO mobiliario_otros VALUES("17","2023-08-10","Silla Premiun","FQF153MBIN","160","Respaldo de maya color negro                      ","Activo","2023-08-31 20:00:44");
INSERT INTO mobiliario_otros VALUES("22","2023-08-28","vitrina","prueba","90","estoy probando","Activo","2023-08-28 20:50:34");


DROP TABLE IF EXISTS proveedores CASCADE;

CREATE TABLE `proveedores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(225) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO proveedores VALUES("1","siman","2023-05-15 07:27:45");
INSERT INTO proveedores VALUES("2","curacao","2023-05-15 19:34:50");
INSERT INTO proveedores VALUES("9","Prado","2023-08-27 15:42:15");
INSERT INTO proveedores VALUES("10","Freum","2023-08-28 21:15:58");
INSERT INTO proveedores VALUES("11","Toyota","2023-10-25 10:02:43");


DROP TABLE IF EXISTS requisicion_suministro CASCADE;

CREATE TABLE `requisicion_suministro` (
  `id` int(11) NOT NULL,
  `unidad_id` bigint(20) NOT NULL,
  `fecha_requisicion` datetime NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `requisicion_suministro_id_uindex` (`id`),
  KEY `requisicion_suministro_estado_requisicion_id_fk` (`estado_id`),
  KEY `requisicion_suministro_unidades_id_fk` (`unidad_id`),
  CONSTRAINT `requisicion_suministro_estado_requisicion_id_fk` FOREIGN KEY (`estado_id`) REFERENCES `estado_requisicion` (`id`),
  CONSTRAINT `requisicion_suministro_unidades_id_fk` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO requisicion_suministro VALUES("1698074356","2","2023-10-23 00:00:00","2023-10-23 17:19:16","0","3");
INSERT INTO requisicion_suministro VALUES("1698074725","2","2023-10-23 00:00:00","2023-10-23 17:25:25","0","3");
INSERT INTO requisicion_suministro VALUES("1698075848","5","2023-10-23 00:00:00","2023-10-23 17:44:08","0","3");
INSERT INTO requisicion_suministro VALUES("1698876210","7","2023-11-01 00:00:00","2023-11-01 23:03:30","0","3");


DROP TABLE IF EXISTS requisicion_suministros CASCADE;

CREATE TABLE `requisicion_suministros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_solicitud` datetime NOT NULL,
  `unidad_medida` varchar(225) DEFAULT NULL,
  `descripcion_suminstro` varchar(250) NOT NULL,
  `cantidad` int(11) NOT NULL COMMENT 'tiene que ser igual o menor que ingreso de suministros',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `aprobacion` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'siempre y cuando se tengan disponibles los suministros que se esten solicitando',
  `fk_unidades` bigint(20) NOT NULL,
  `fk_ingreso_suminitros` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `requisicion_suministros_unidades_id_fk` (`fk_unidades`),
  KEY `requisicion_suministros_ingreso_suministros_id_fk` (`fk_ingreso_suminitros`),
  CONSTRAINT `requisicion_suministros_ingreso_suministros_id_fk` FOREIGN KEY (`fk_ingreso_suminitros`) REFERENCES `ingreso_suministros` (`id`),
  CONSTRAINT `requisicion_suministros_unidades_id_fk` FOREIGN KEY (`fk_unidades`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS roles CASCADE;

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rol` enum('Administrador','Activo','Almacen','UACI','Unidad','Seguridad','Empleado') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO roles VALUES("1","Administrador");
INSERT INTO roles VALUES("2","Activo");
INSERT INTO roles VALUES("3","Almacen");
INSERT INTO roles VALUES("4","UACI");
INSERT INTO roles VALUES("5","Unidad");
INSERT INTO roles VALUES("6","Seguridad");
INSERT INTO roles VALUES("7","Empleado");


DROP TABLE IF EXISTS unidades CASCADE;

CREATE TABLE `unidades` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre_unidad` varchar(225) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unidades_pk2` (`nombre_unidad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO unidades VALUES("1","RRHH","2023-10-22 09:16:18");
INSERT INTO unidades VALUES("2","Gerencia","2023-10-23 09:16:18");
INSERT INTO unidades VALUES("3","Carnet de Minoridad","2023-10-23 09:42:37");
INSERT INTO unidades VALUES("4","Proyección Social","2023-10-23 09:42:50");
INSERT INTO unidades VALUES("5","Registro","2023-10-23 09:43:00");
INSERT INTO unidades VALUES("6","Cementerio","2023-10-23 09:43:08");
INSERT INTO unidades VALUES("7","Catastro","2023-10-23 09:43:16");
INSERT INTO unidades VALUES("8","Unidad de Compras","2023-10-23 09:52:02");


DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(225) NOT NULL,
  `apellido` varchar(225) NOT NULL,
  `usuario` varchar(225) NOT NULL,
  `email` varchar(225) DEFAULT NULL,
  `contrasena` tinytext NOT NULL,
  `fk_rol` bigint(20) DEFAULT NULL,
  `permisos` enum('Almacen','Activo Fijo','UACI') DEFAULT NULL COMMENT 'se le asignaran los permisos para generar las restricciones ',
  `activacion` int(11) DEFAULT NULL,
  `token` int(100) NOT NULL,
  `token_password` int(100) NOT NULL,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fk_unidades` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `password_request` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_pk` (`email`),
  KEY `usuarios_unidades_id_fk` (`fk_unidades`),
  KEY `usuarios_roles_id_fk` (`fk_rol`),
  CONSTRAINT `usuarios_roles_id_fk` FOREIGN KEY (`fk_rol`) REFERENCES `roles` (`id`),
  CONSTRAINT `usuarios_unidades_id_fk` FOREIGN KEY (`fk_unidades`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios VALUES("57","Blanqui","Melara","bmelz","483melz@gmail.com","$2y$10$2U2KMEy3Qytou4mrnZhHGuEELCKaxyi/n1n5DnK8aGI4p8lEjaqH2","1","Almacen","0","0","0","Activo","4","2023-10-12 11:25:35","0");
INSERT INTO usuarios VALUES("58","Lissette","Laínez","lila","lila@gmail.com","$2y$10$WXgjl96RtjOxYrIm.VLIUuRpJidLdI.A7R8UqgymArqWD.r3Qepka","2","Activo Fijo","0","0","0","Activo","4","2023-10-12 11:34:25","0");
INSERT INTO usuarios VALUES("59","Pedro","Mora","pmora","pmora@gmail.com","$2y$10$tlRKJnQXISDu6Pv1Gm3dHuMFXRAutHyDAk/8m45XS2Npe8TtJdmGi","3","Almacen","0","0","0","Activo","16","2023-10-12 15:20:38","0");
INSERT INTO usuarios VALUES("60","Harry","Potter","potter","potter@gmail.com","$2y$10$wjijyqzSd2cW6XPfxrFj6OHN.yaIb43LwQ0GK.fKckC2h..L5ClYq","7","Activo Fijo","0","0","0","Inactivo","4","2023-10-13 08:59:55","0");
INSERT INTO usuarios VALUES("63","Ronald","Wesley","ronwe","ronwe@gmail.com","$2y$10$ehjIV.cmOvCtWC2d9LSjjuhwgZ5Pup8rIaFmB8xm9sjNhcmfVN4vC","5","","","0","0","Activo","2","2023-10-23 09:17:34","0");
INSERT INTO usuarios VALUES("64","Benjamin","Melara","benja","benja@gmail.com","$2y$10$mqosrufZlnJOAWsPmz/ZX.A6EvqO8BGmHb.K6x0YGH0vbsnuvH8s2","4","","","0","0","Activo","8","2023-10-23 09:18:07","0");
INSERT INTO usuarios VALUES("65","Maria","Perez","maria","maria@gmail.com","$2y$10$8JlAPtv8NV63FE748mw4vOlaNl07TSg.FOVvY4vQzEDGT5tkYCFSS","5","","","0","0","Activo","5","2023-10-23 09:41:36","0");
INSERT INTO usuarios VALUES("66","Mercy","Gonzales","mercy","mercy@gmail.com","$2y$10$.s8O1aruqTkMAHRqbDEiUO7yozS2It7B42tDxs0XhLfzYGVh6kXyO","5","","","0","0","Activo","7","2023-10-23 15:53:25","0");


SET FOREIGN_KEY_CHECKS=1;

