-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2017 a las 03:49:45
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.0.15

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
(1, 1, 'no1', 120000, 10, '/img/logo.gif', 'un buen equipo', 2, 1),
(2, 2, 'mh', 1000000, 5, '/img/logo.gif', 'un buen tv', 1, 1),
(3, 3, 'fg', 5000000, 20, '/img/logo.gif', 'un buen teatro', 5, 1);

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

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_forma_pago`
--
DROP TABLE IF EXISTS `lista_forma_pago`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_forma_pago`  AS  select `forma_pago`.`idformapago` AS `idformapago`,`forma_pago`.`consecutivo` AS `consecutivo`,`forma_pago`.`nombre` AS `nombre`,`forma_pago`.`flEstado` AS `flEstado` from `forma_pago` where (`forma_pago`.`flEstado` = 1) ;

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
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `idvendedor` int(11) NOT NULL AUTO_INCREMENT;
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
