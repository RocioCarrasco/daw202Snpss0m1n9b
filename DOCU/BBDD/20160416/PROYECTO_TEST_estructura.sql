-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-04-2016 a las 22:26:08
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `PROYECTO_TEST`
--
CREATE DATABASE IF NOT EXISTS `PROYECTO_TEST` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `PROYECTO_TEST`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FASE`
--

DROP TABLE IF EXISTS `FASE`;
CREATE TABLE `FASE` (
  `proyecto` varchar(33) NOT NULL,
  `id` varchar(33) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` timestamp NULL DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GRUPO`
--

DROP TABLE IF EXISTS `GRUPO`;
CREATE TABLE `GRUPO` (
  `id` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROYECTO`
--

DROP TABLE IF EXISTS `PROYECTO`;
CREATE TABLE `PROYECTO` (
  `id` varchar(33) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` timestamp NULL DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `PROYECTO`
--
DROP TRIGGER IF EXISTS `crearDefaultFase`;
DELIMITER $$
CREATE TRIGGER `crearDefaultFase` AFTER INSERT ON `PROYECTO` FOR EACH ROW INSERT INTO FASE(proyecto, id, title, descripcion) VALUES (new.id,'FA00000','fase predefinida','fase predefinida')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA`
--

DROP TABLE IF EXISTS `TAREA`;
CREATE TABLE `TAREA` (
  `fase` varchar(33) NOT NULL,
  `id_proyecto` varchar(33) NOT NULL,
  `id` varchar(33) NOT NULL,
  `id_status` int(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` timestamp NULL DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER`
--

DROP TABLE IF EXISTS `USER`;
CREATE TABLE `USER` (
  `id` varchar(33) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER_PROYECTO`
--

DROP TABLE IF EXISTS `USER_PROYECTO`;
CREATE TABLE `USER_PROYECTO` (
  `id_proyecto` varchar(33) NOT NULL,
  `id_user` varchar(33) NOT NULL,
  `id_rango` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `user_proyecto_view`
--
DROP VIEW IF EXISTS `user_proyecto_view`;
CREATE TABLE `user_proyecto_view` (
`id_rango` int(11)
,`id_proyecto` varchar(33)
,`title_proyecto` varchar(50)
,`descripcion_proyecto` varchar(500)
,`fechaLimit_proyecto` timestamp
,`id_user` varchar(33)
,`nick_user` varchar(20)
,`email_user` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `user_proyecto_view`
--
DROP TABLE IF EXISTS `user_proyecto_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proyecto_test`.`user_proyecto_view`  AS  select `proyecto_test`.`user_proyecto`.`id_rango` AS `id_rango`,`proyecto_test`.`proyecto`.`id` AS `id_proyecto`,`proyecto_test`.`proyecto`.`title` AS `title_proyecto`,`proyecto_test`.`proyecto`.`descripcion` AS `descripcion_proyecto`,`proyecto_test`.`proyecto`.`fechaLimit` AS `fechaLimit_proyecto`,`proyecto_test`.`user`.`id` AS `id_user`,`proyecto_test`.`user`.`nick` AS `nick_user`,`proyecto_test`.`user`.`email` AS `email_user` from (`proyecto_test`.`user_proyecto` join (`proyecto_test`.`user` join `proyecto_test`.`proyecto`) on(((`proyecto_test`.`user`.`id` = `proyecto_test`.`user_proyecto`.`id_user`) and (`proyecto_test`.`proyecto`.`id` = `proyecto_test`.`user_proyecto`.`id_proyecto`)))) order by `proyecto_test`.`user_proyecto`.`id_rango` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `FASE`
--
ALTER TABLE `FASE`
  ADD PRIMARY KEY (`proyecto`,`id`);

--
-- Indices de la tabla `PROYECTO`
--
ALTER TABLE `PROYECTO`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `TAREA`
--
ALTER TABLE `TAREA`
  ADD PRIMARY KEY (`id_proyecto`,`id`);

--
-- Indices de la tabla `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `USER_PROYECTO`
--
ALTER TABLE `USER_PROYECTO`
  ADD PRIMARY KEY (`id_proyecto`,`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
