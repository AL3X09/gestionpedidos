-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2017 a las 23:33:22
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionproductos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_datos_usuario` (IN `s_usuario` VARCHAR(100), IN `s_contrasenia` VARCHAR(100))  NO SQL
    COMMENT 'procedimineto lista datos de un usuario logueado '
SELECT
 idusuario,
          U.nombre1,
          U.nombre2,
          U.apellido1,
          U.apellido2,
          U.identificacion,
          U.celular,
          U.usuario,
          R.nombre AS rol,
          IF(RP1.fkpermisos=1,1,0) as ver, 
          IF(RP2.fkpermisos=2,2,0) as crear,
          IF(RP3.fkpermisos=3,3,0) as editar,
          IF(RP4.fkpermisos=4,4,0) as eliminar
          FROM usuarios AS U
          INNER JOIN usuario_has_roles AS UR ON UR.fkusuario=U.idusuario
          INNER JOIN roles AS R ON R.idroles=UR.fkroles
          LEFT JOIN roles_has_permisos AS RP1 ON RP1.fkroles= UR.fkroles AND RP1.fkpermisos=1 
          LEFT JOIN roles_has_permisos AS RP2 ON RP2.fkroles= UR.fkroles AND RP2.fkpermisos=2
          LEFT JOIN roles_has_permisos AS RP3 ON RP3.fkroles= UR.fkroles AND RP3.fkpermisos=3
          LEFT JOIN roles_has_permisos AS RP4 ON RP4.fkroles= UR.fkroles AND RP4.fkpermisos=4
          WHERE flestado=1
          AND U.usuario=s_usuario
          AND U.contrasenia=s_contrasenia$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPinsertPedido` (IN `consecutivo` INT, IN `fkusuario` INT, IN `fkProducto` INT, IN `unidades_vendidas` INT, IN `fkFormaPago` INT, IN `fkTipoPago` INT, IN `totalPagado` INT, IN `diferidoAPagar` INT, IN `numeroPedido` INT)  BEGIN
INSERT INTO pedido
VALUES(NULL,
       consecutivo,
       fkusuario,
       fkProducto,
       unidades_vendidas,
       fkFormaPago,
       fkTipoPago,
       totalPagado,
       diferidoAPagar,
       numeroPedido,
       CURDATE(),
       1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPinsert_usuario_has_cuenta_pedido` (IN `fkusuario` INT, IN `fkpedido` INT, IN `numcuenta` INT)  NO SQL
INSERT INTO usuario_has_cuenta_pedido
VALUES(NULL,fkusuario,fkpedido,numcuenta,1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_estadoUsuario` (IN `pkusuario` INT)  NO SQL
UPDATE usuario AS U SET U.flestado=0
WHERE U.idusuario=pkusuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_old`
--

CREATE TABLE `clientes_old` (
  `idclientes` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `numer_tarjeta` bigint(20) NOT NULL,
  `fkrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabala datos clientes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `idcuenta` int(11) NOT NULL,
  `fkusuario` int(11) DEFAULT NULL,
  `num_tarjeta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla mantine la cuenta del usuario';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `idformapago` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `flEstado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='almacena el tipo de pagos';

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`idformapago`, `consecutivo`, `nombre`, `flEstado`) VALUES
(1, 1, 'Efectivo', 1),
(2, 2, 'Tarjeta de Credito', 1),
(3, 3, 'Credito Directo', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_forma_pago`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_forma_pago` (
`idformapago` int(11)
,`consecutivo` int(11)
,`nombre` varchar(50)
,`flEstado` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_pedidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_pedidos` (
`idpedido` int(11)
,`consecutivo` int(11)
,`fkUsuario` int(11)
,`fkProducto` int(11)
,`unidades_vendidas` int(11)
,`fkFormaPago` int(11)
,`fkTipoPago` int(11)
,`totalPagado` bigint(20)
,`diferidoAPagar` bigint(20)
,`numeroPedido` bigint(50)
,`fechaPedido` date
,`flEstado` int(11)
,`identificacion` bigint(20)
,`nombreUsuario` varchar(45)
,`apellido1` varchar(45)
,`nombreProducto` varchar(50)
,`presio_unidad` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_productos` (
`idproductos` int(11)
,`consecutivo` int(11)
,`nombre` varchar(50)
,`presio_unidad` bigint(20)
,`comision_venta` int(11)
,`imagen` varchar(100)
,`descripcion` text
,`cantidad` int(11)
,`flEstado` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_roles_permisos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_roles_permisos` (
`idroles` int(11)
,`nombre` varchar(45)
,`ver` int(1)
,`crear` int(1)
,`editar` int(1)
,`eliminar` int(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_tipo_pago`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_tipo_pago` (
`idtipopago` int(11)
,`consecutivo` int(11)
,`nombre` varchar(50)
,`num_dias` int(11)
,`flEstado` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_usuarios` (
`idusuario` int(11)
,`nombre1` varchar(45)
,`nombre2` varchar(45)
,`apellido1` varchar(45)
,`apellido2` varchar(45)
,`identificacion` bigint(20)
,`celular` int(11)
,`rol` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_vendedor`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_vendedor` (
`idvendedor` int(11)
,`consecutivo` int(11)
,`nobres` varchar(50)
,`aepellidos` varchar(50)
,`correo` varchar(50)
,`flEstado` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_vendedores_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_vendedores_productos` (
`idVendedor` int(11)
,`NomVendedor` varchar(50)
,`idproductos` int(11)
,`NomProducto` varchar(50)
,`comision_venta` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_vendedores_total_comision`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_vendedores_total_comision` (
`idVendedor` int(11)
,`NomVendedor` varchar(50)
,`total` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `fkProducto` int(11) NOT NULL,
  `unidades_vendidas` int(11) DEFAULT NULL,
  `fkFormaPago` int(11) DEFAULT NULL,
  `fkTipoPago` int(11) DEFAULT NULL,
  `totalPagado` bigint(20) DEFAULT NULL,
  `diferidoAPagar` bigint(20) DEFAULT NULL,
  `numeroPedido` bigint(50) DEFAULT NULL,
  `fechaPedido` date NOT NULL,
  `flEstado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='mantiene los datos del pedido';

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `consecutivo`, `fkUsuario`, `fkProducto`, `unidades_vendidas`, `fkFormaPago`, `fkTipoPago`, `totalPagado`, `diferidoAPagar`, `numeroPedido`, `fechaPedido`, `flEstado`) VALUES
(1, 1, 1, 1, 1, 2, 1, 120000, 2, 100001, '2017-05-23', 1),
(2, 2, 1, 2, 2, 2, 1, 120000, 2, 100002, '2017-05-23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermisos` int(11) NOT NULL,
  `cosecutivo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermisos`, `cosecutivo`, `nombre`) VALUES
(1, 1, 'ver'),
(2, 2, 'crear'),
(3, 3, 'editar'),
(4, 4, 'eliminar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproductos` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `presio_unidad` bigint(20) NOT NULL,
  `comision_venta` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` text,
  `cantidad` int(11) NOT NULL,
  `flEstado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla que almacena los productos a vender';

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproductos`, `consecutivo`, `nombre`, `presio_unidad`, `comision_venta`, `imagen`, `descripcion`, `cantidad`, `flEstado`) VALUES
(1, 1, 'Go-Pro mas celular', 120000, 10, '/img/elctronica.png', 'GO-Pro y celular', 8, 1),
(2, 2, 'NanoPod', 1000000, 5, '/img/nanopod.jpg', 'La ultima generacion de nanos para escuchar tu musica preferida', 7, 1),
(3, 3, 'Cafetera Digital', 5000000, 20, '/img/cafetera.jpg', 'Una cafera digitalizada, para preparara las vevidas calientes a su gusto', 2, 1),
(4, 4, 'Televisor 43\'\' 4UHD', 1230000, 20, '/img/televisor.jpeg', 'Increíble contraste con X-tended Dynamic Range PRO\r\nSoberbio realismo con el 4K HDR Processor X1™\r\nAmplia gama de colores con TRILUMINOS Display\r\nAndroid TV™ para películas, juegos y conectividad', 13, 1),
(5, 5, 'Lavadora Samsung', 1300000, 23, '/img/lavadora.jpeg', 'WD7000HK Combo con Big Capacity, 18 kg\r\n\r\nLavado en Frío (Eco Bubble)\r\nCon Lavado de vapor, mantiene tu ropa impecable y con un agradable aroma', 12, 1),
(6, 7, 'Computador Personal', 2500000, 15, '/img/pc.jpeg', ' \r\nProcesador: Intel Core i5 7200U\r\n\r\n  \r\nSistema Operativo: Windows 10\r\n\r\n  \r\nMemoria: 6GB\r\n\r\n  \r\nDisco Duro: 1TB\r\n\r\n  \r\nPantalla: 15.6\"', 26, 1),
(8, 8, 'Play 4', 1399000, 31, '/img/play.jpeg', 'La nueva consola de Sony contará en su interior con un chip personalizado AMD Jaguar x86-64 de ocho núcleos junto a un GPU capaz de generar 1.84 Teraflops de procesamiento a través de una AMD Radeon de \"nueva generación\". Su memoria RAM de 8GB utilizará GDDR5 para proporcionar 176 GB/segundo de ancho de banda.', 9, 1),
(9, 9, 'Nevera', 900000, 40, '/img/nevera.jpeg', '\r\nNevecón No Frost 687 Lt | Profile PSMS3KEFFSS', 6, 1),
(10, 10, 'Camara', 200000, 50, '/img/camara.jpeg', 'CAMARA REFLEX NIKOND-3300\r\n\r\nRESOLUCION:24.2 MP\r\n\r\nLENTE 18-55 AFP VR\r\n\r\nPANTALLA LCD:3.0 Pulgadas\r\n\r\nVIDEO:VIDEO FULL HD 1080p a 60/30/24p\r\n\r\nISO:100-12.800 A 25.600\r\n\r\nOTROS:5 CPS Disparo Continuo. MODO GUIA\r\n\r\nACCESORIOS:ESTUCHE + MEMORIA 8 GB', 10, 1),
(11, 11, 'Reloj Smart', 1500000, 10, '/img/reloj.jpeg', 'Reloj Gear S3 Frontier Negro\r\nTodas las conexiones disponibles.', 5, 1),
(12, 13, 'Parlante Sony torre', 1500000, 11, '/img/parlante.jpeg', 'Grandes fiestas necesitan un gran sistema de sonido. Con Sound Pressure Horn, el MHC-V7D puede entregar un nivel de presión de sonido de 1550 W2 (RMS 1440 W, SPL 105.5 dB) con un diseño de caja vertical de tamaño reducido. Ponle ritmo a la fiesta con un divertido control de gestos, cambia las luces LED de los parlantes, agrega efectos de DJ o simplemente salta a otra canción con un sencillo movimiento.', 16, 1),
(13, 13, 'PC TOUCH', 3000000, 20, '/img/lenovo.jpeg', 'Convertible 2 en 1 LENOVO Yoga 510 Ci5 15.6\" Negro', 6, 1),
(14, 14, 'iPhone 6', 1500000, 10, '/img/cel.jpeg', 'Pantalla: 4.7\"\r\nCámara Trasera: 8 MP 1.5 µ\r\nCámara Forntal: 1.2 MP\r\nSistema Operativo: IOS\r\nMemoria Interna: 32 GB \r\nBatería: ION Litio\r\nProcesador: A8', 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idroles` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idroles`, `consecutivo`, `nombre`) VALUES
(1, 1, 'Administrador'),
(2, 2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_has_permisos`
--

CREATE TABLE `roles_has_permisos` (
  `fkroles` int(11) NOT NULL,
  `fkpermisos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles_has_permisos`
--

INSERT INTO `roles_has_permisos` (`fkroles`, `fkpermisos`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `idtipopago` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `num_dias` int(11) NOT NULL,
  `flEstado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla el tipo de pago ';

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`idtipopago`, `consecutivo`, `nombre`, `num_dias`, `flEstado`) VALUES
(1, 1, 'quincenal', 15, 1),
(2, 2, 'mensual', 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `nombre1` varchar(45) NOT NULL,
  `nombre2` varchar(45) DEFAULT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(45) DEFAULT NULL,
  `identificacion` bigint(20) NOT NULL,
  `celular` int(11) DEFAULT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  `flestado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `consecutivo`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `identificacion`, `celular`, `usuario`, `contrasenia`, `flestado`) VALUES
(1, 1, 'ADMIN', '', '', '', 0, 0, 'ADMIN', '11223344', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_cuenta_pedido`
--

CREATE TABLE `usuario_has_cuenta_pedido` (
  `idUsuariCuentaPedido` int(11) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `fkPedido` int(11) NOT NULL,
  `numerocuenta` bigint(20) DEFAULT NULL,
  `flEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabala mantiene datos de pedido del usario y el pedido';

--
-- Volcado de datos para la tabla `usuario_has_cuenta_pedido`
--

INSERT INTO `usuario_has_cuenta_pedido` (`idUsuariCuentaPedido`, `fkUsuario`, `fkPedido`, `numerocuenta`, `flEstado`) VALUES
(1, 1, 0, 135453454, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_roles`
--

CREATE TABLE `usuario_has_roles` (
  `fkusuario` int(11) NOT NULL,
  `fkroles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_has_roles`
--

INSERT INTO `usuario_has_roles` (`fkusuario`, `fkroles`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `idvendedor` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `nobres` varchar(50) NOT NULL,
  `aepellidos` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `flEstado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla alacena los vendedores';

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`idvendedor`, `consecutivo`, `nobres`, `aepellidos`, `correo`, `flEstado`) VALUES
(1, 1, 'Alex', 'Cifuentes', 'acifuentes@gmail.com', 1),
(2, 2, 'Leidy', 'Leon', 'lleon@gmail.com', 1),
(3, 3, 'Yudy ', 'Aristizabal', 'yudykavana@gmail.com', 1),
(4, 4, 'Andres ', 'Aristizabal', 'daaristizabal@unipanamericana.edu.co', 1),
(5, 5, 'Adriana', 'Guluma', 'adrianaguluma@gmail.com', 1),
(6, 6, 'Sergio', 'Arcila', 'checho0516@gmail.com', 1),
(7, 7, 'Elkin', 'Alzate', 'kinoalgo222@gmail.com', 1),
(8, 8, 'Leider', 'Ramirez', 'leiderramirez@gmail.com', 1),
(9, 9, 'Gloria ', 'Serna', 'gloriaserna75@gmail.co', 1),
(10, 10, 'David', 'Aristizabal', 'davidar19997@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor_has_comision`
--

CREATE TABLE `vendedor_has_comision` (
  `idvendedor_has_comision` int(11) NOT NULL,
  `fkVendedor` int(11) NOT NULL,
  `fkProducto` int(11) NOT NULL,
  `comision_ganada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='guarda las comisiones ganadas para cada vendedor';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor_has_producto`
--

CREATE TABLE `vendedor_has_producto` (
  `idVendedor_producto` int(11) NOT NULL,
  `fkVendedor` int(11) NOT NULL,
  `fkProducto` int(11) NOT NULL COMMENT 'guarda la relacion producto vendedor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendedor_has_producto`
--

INSERT INTO `vendedor_has_producto` (`idVendedor_producto`, `fkVendedor`, `fkProducto`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5),
(5, 1, 6);

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_forma_pago`
--
DROP TABLE IF EXISTS `lista_forma_pago`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_forma_pago`  AS  select `forma_pago`.`idformapago` AS `idformapago`,`forma_pago`.`consecutivo` AS `consecutivo`,`forma_pago`.`nombre` AS `nombre`,`forma_pago`.`flEstado` AS `flEstado` from `forma_pago` where (`forma_pago`.`flEstado` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_pedidos`
--
DROP TABLE IF EXISTS `lista_pedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_pedidos`  AS  select `pedido`.`idpedido` AS `idpedido`,`pedido`.`consecutivo` AS `consecutivo`,`pedido`.`fkUsuario` AS `fkUsuario`,`pedido`.`fkProducto` AS `fkProducto`,`pedido`.`unidades_vendidas` AS `unidades_vendidas`,`pedido`.`fkFormaPago` AS `fkFormaPago`,`pedido`.`fkTipoPago` AS `fkTipoPago`,`pedido`.`totalPagado` AS `totalPagado`,`pedido`.`diferidoAPagar` AS `diferidoAPagar`,`pedido`.`numeroPedido` AS `numeroPedido`,`pedido`.`fechaPedido` AS `fechaPedido`,`pedido`.`flEstado` AS `flEstado`,`usuarios`.`identificacion` AS `identificacion`,`usuarios`.`nombre1` AS `nombreUsuario`,`usuarios`.`apellido1` AS `apellido1`,`productos`.`nombre` AS `nombreProducto`,`productos`.`presio_unidad` AS `presio_unidad` from ((`pedido` join `usuarios` on((`usuarios`.`idusuario` = `pedido`.`fkUsuario`))) join `productos` on((`productos`.`idproductos` = `pedido`.`fkProducto`))) where (`pedido`.`flEstado` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_productos`
--
DROP TABLE IF EXISTS `lista_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_productos`  AS  select `productos`.`idproductos` AS `idproductos`,`productos`.`consecutivo` AS `consecutivo`,`productos`.`nombre` AS `nombre`,`productos`.`presio_unidad` AS `presio_unidad`,`productos`.`comision_venta` AS `comision_venta`,`productos`.`imagen` AS `imagen`,`productos`.`descripcion` AS `descripcion`,`productos`.`cantidad` AS `cantidad`,`productos`.`flEstado` AS `flEstado` from `productos` where (`productos`.`flEstado` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_roles_permisos`
--
DROP TABLE IF EXISTS `lista_roles_permisos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_roles_permisos`  AS  select `r`.`idroles` AS `idroles`,`r`.`nombre` AS `nombre`,if((`rp1`.`fkpermisos` = 1),1,0) AS `ver`,if((`rp2`.`fkpermisos` = 2),2,0) AS `crear`,if((`rp3`.`fkpermisos` = 3),3,0) AS `editar`,if((`rp4`.`fkpermisos` = 4),4,0) AS `eliminar` from ((((`roles` `r` left join `roles_has_permisos` `rp1` on(((`rp1`.`fkroles` = `r`.`idroles`) and (`rp1`.`fkpermisos` = 1)))) left join `roles_has_permisos` `rp2` on(((`rp2`.`fkroles` = `r`.`idroles`) and (`rp2`.`fkpermisos` = 2)))) left join `roles_has_permisos` `rp3` on(((`rp3`.`fkroles` = `r`.`idroles`) and (`rp3`.`fkpermisos` = 3)))) left join `roles_has_permisos` `rp4` on(((`rp4`.`fkroles` = `r`.`idroles`) and (`rp4`.`fkpermisos` = 4)))) group by `r`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_tipo_pago`
--
DROP TABLE IF EXISTS `lista_tipo_pago`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_tipo_pago`  AS  select `tipo_pago`.`idtipopago` AS `idtipopago`,`tipo_pago`.`consecutivo` AS `consecutivo`,`tipo_pago`.`nombre` AS `nombre`,`tipo_pago`.`num_dias` AS `num_dias`,`tipo_pago`.`flEstado` AS `flEstado` from `tipo_pago` where (`tipo_pago`.`flEstado` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_usuarios`
--
DROP TABLE IF EXISTS `lista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_usuarios`  AS  select `u`.`idusuario` AS `idusuario`,`u`.`nombre1` AS `nombre1`,`u`.`nombre2` AS `nombre2`,`u`.`apellido1` AS `apellido1`,`u`.`apellido2` AS `apellido2`,`u`.`identificacion` AS `identificacion`,`u`.`celular` AS `celular`,`r`.`nombre` AS `rol` from ((((`usuarios` `u` join `usuario_has_roles` `ur` on((`ur`.`fkusuario` = `u`.`idusuario`))) join `roles` `r` on((`r`.`idroles` = `ur`.`fkroles`))) join `roles_has_permisos` `rp` on((`rp`.`fkroles` = `r`.`idroles`))) join `permisos` `p` on((`p`.`idpermisos` = `rp`.`fkpermisos`))) where (`u`.`flestado` = 1) group by `u`.`idusuario` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_vendedor`
--
DROP TABLE IF EXISTS `lista_vendedor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_vendedor`  AS  select `vendedor`.`idvendedor` AS `idvendedor`,`vendedor`.`consecutivo` AS `consecutivo`,`vendedor`.`nobres` AS `nobres`,`vendedor`.`aepellidos` AS `aepellidos`,`vendedor`.`correo` AS `correo`,`vendedor`.`flEstado` AS `flEstado` from `vendedor` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_vendedores_productos`
--
DROP TABLE IF EXISTS `lista_vendedores_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_vendedores_productos`  AS  select `vendedor`.`idvendedor` AS `idVendedor`,`vendedor`.`nobres` AS `NomVendedor`,`productos`.`idproductos` AS `idproductos`,`productos`.`nombre` AS `NomProducto`,`productos`.`comision_venta` AS `comision_venta` from ((`vendedor_has_producto` `vhp` join `vendedor` on((`vendedor`.`idvendedor` = `vhp`.`fkVendedor`))) join `productos` on((`productos`.`idproductos` = `vhp`.`fkProducto`))) where ((`productos`.`flEstado` = 1) and (`vendedor`.`flEstado` = 1)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_vendedores_total_comision`
--
DROP TABLE IF EXISTS `lista_vendedores_total_comision`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_vendedores_total_comision`  AS  select `vendedor`.`idvendedor` AS `idVendedor`,`vendedor`.`nobres` AS `NomVendedor`,sum(`vhc`.`comision_ganada`) AS `total` from ((`vendedor_has_comision` `vhc` join `vendedor` on((`vendedor`.`idvendedor` = `vhc`.`fkVendedor`))) join `pedido` on((`pedido`.`fkProducto` = `vhc`.`fkProducto`))) where (`vendedor`.`flEstado` = 1) group by `vhc`.`fkVendedor` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes_old`
--
ALTER TABLE `clientes_old`
  ADD PRIMARY KEY (`idclientes`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`idcuenta`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`idformapago`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermisos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproductos`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indices de la tabla `roles_has_permisos`
--
ALTER TABLE `roles_has_permisos`
  ADD PRIMARY KEY (`fkroles`,`fkpermisos`),
  ADD KEY `fk_roles_has_permisos_permisos1_idx` (`fkpermisos`),
  ADD KEY `fk_roles_has_permisos_roles_idx` (`fkroles`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`idtipopago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuario_has_cuenta_pedido`
--
ALTER TABLE `usuario_has_cuenta_pedido`
  ADD PRIMARY KEY (`idUsuariCuentaPedido`);

--
-- Indices de la tabla `usuario_has_roles`
--
ALTER TABLE `usuario_has_roles`
  ADD PRIMARY KEY (`fkusuario`,`fkroles`),
  ADD KEY `fk_usuario_has_roles_roles1_idx` (`fkroles`),
  ADD KEY `fk_usuario_has_roles_usuario1_idx` (`fkusuario`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`idvendedor`);

--
-- Indices de la tabla `vendedor_has_comision`
--
ALTER TABLE `vendedor_has_comision`
  ADD PRIMARY KEY (`idvendedor_has_comision`);

--
-- Indices de la tabla `vendedor_has_producto`
--
ALTER TABLE `vendedor_has_producto`
  ADD PRIMARY KEY (`idVendedor_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes_old`
--
ALTER TABLE `clientes_old`
  MODIFY `idclientes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `idcuenta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `idformapago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543245325;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `idtipopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario_has_cuenta_pedido`
--
ALTER TABLE `usuario_has_cuenta_pedido`
  MODIFY `idUsuariCuentaPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `idvendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;
--
-- AUTO_INCREMENT de la tabla `vendedor_has_comision`
--
ALTER TABLE `vendedor_has_comision`
  MODIFY `idvendedor_has_comision` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `vendedor_has_producto`
--
ALTER TABLE `vendedor_has_producto`
  MODIFY `idVendedor_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `roles_has_permisos`
--
ALTER TABLE `roles_has_permisos`
  ADD CONSTRAINT `fk_roles_has_permisos_permisos1` FOREIGN KEY (`fkpermisos`) REFERENCES `permisos` (`idpermisos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roles_has_permisos_roles` FOREIGN KEY (`fkroles`) REFERENCES `roles` (`idroles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_has_roles`
--
ALTER TABLE `usuario_has_roles`
  ADD CONSTRAINT `fk_usuario_has_roles_roles1` FOREIGN KEY (`fkroles`) REFERENCES `roles` (`idroles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_roles_usuario1` FOREIGN KEY (`fkusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
