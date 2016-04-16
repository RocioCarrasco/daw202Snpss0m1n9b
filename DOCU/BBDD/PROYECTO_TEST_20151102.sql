-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-11-2015 a las 15:58:37
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `PROYECTO_TEST`
--
CREATE DATABASE IF NOT EXISTS `PROYECTO_TEST` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `PROYECTO_TEST`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FASE`
--

CREATE TABLE IF NOT EXISTS `FASE` (
  `proyecto` varchar(7) NOT NULL,
  `id` varchar(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `FASE`
--

INSERT INTO `FASE` (`proyecto`, `id`, `title`, `descripcion`, `fechaLimit`) VALUES
('PR00001', 'FA00000', 'DEFAULT', 'DEFAULT', NULL),
('PR00002', 'FA00000', 'DEFAULT', 'DEFAULT', NULL),
('PR00003', 'FA00000', 'DEFAULT', 'DEFAULT', NULL),
('PR00004', 'FA00000', 'DEFAULT', 'DEFAULT', NULL),
('PR00005', 'FA00000', 'DEFAULT', 'DEFAULT', NULL),
('PR00006', 'FA00000', 'DEFAULT', 'DEFAULT', NULL),
('PR00007', 'FA00000', 'DEFAULT', 'DEFAULT', NULL),
('PR00008', 'FA00000', 'DEFAULT', NULL, NULL),
('PR00009', 'FA00000', 'DEFAULT', NULL, NULL),
('PR00010', 'FA00001', 'DEFAULT', NULL, NULL),
('PR00011', 'FA00001', 'DEFAULT', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GRUPO`
--

CREATE TABLE IF NOT EXISTS `GRUPO` (
  `id` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROYECTO`
--

CREATE TABLE IF NOT EXISTS `PROYECTO` (
  `id` varchar(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PROYECTO`
--

INSERT INTO `PROYECTO` (`id`, `title`, `descripcion`, `fechaLimit`) VALUES
('PR00001', 'PROYECTO1', 'Lorem Ipsum Dolom', NULL),
('PR00002', 'PROYECTO2', 'Lorem Ipsum Dolom', NULL),
('PR00003', 'PROYECTO3', 'Lorem Ipsum Dolom', NULL),
('PR00004', 'PROYECTO4', 'Lorem Ipsum Dolom', NULL),
('PR00005', 'PROYECTO5', 'Lorem Ipsum Dolom', NULL),
('PR00006', 'PROYECTO6', 'Lorem Ipsum Dolom', NULL),
('PR00007', 'PROYECTO7', 'Lorem Ipsum Dolom', NULL),
('PR00008', 'NUEVO', 'KKKK', NULL),
('PR00009', 'proFFF', 'Esto es una prueba para comprobar como las cosas que en la lÃ³gica no funcionan al final funcionan por cuestiones que se me escapan...', NULL),
('PR00010', 'proGGG', 'alsfsdlkfjÃ±laksj', NULL),
('PR00011', 'proIII', 'Puedo incluir mÃ¡s de uno, por fi???', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA`
--

CREATE TABLE IF NOT EXISTS `TAREA` (
  `fase` varchar(7) NOT NULL,
  `id_proyecto` varchar(7) NOT NULL,
  `id` varchar(7) NOT NULL,
  `id_status` int(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `TAREA`
--

INSERT INTO `TAREA` (`fase`, `id_proyecto`, `id`, `id_status`, `title`, `descripcion`, `fechaLimit`) VALUES
('FA00000', 'PR00008', 'TA00000', 1, 'TASK1', 'DESC', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `id` varchar(7) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USER`
--

INSERT INTO `USER` (`id`, `nick`, `email`, `pass`) VALUES
('US00001', 'user1', 'none', ''),
('US00002', 'user2', 'none', ''),
('US00003', 'user3', 'none', ''),
('US00004', 'userdemo', 'x', 'b59c67bf196a4758191e42f76670ceba'),
('US00005', 'userdemo2', 'x', 'b59c67bf196a4758191e42f76670ceba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER_PROYECTO`
--

CREATE TABLE IF NOT EXISTS `USER_PROYECTO` (
  `id_proyecto` varchar(7) NOT NULL,
  `id_user` varchar(7) NOT NULL,
  `id_rango` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USER_PROYECTO`
--

INSERT INTO `USER_PROYECTO` (`id_proyecto`, `id_user`, `id_rango`) VALUES
('PR00001', 'US00001', 0),
('PR00001', 'US00004', 1),
('PR00002', 'US00002', 0),
('PR00002', 'US00003', 1),
('PR00003', 'US00003', 0),
('PR00003', 'US00004', 1),
('PR00004', 'US00001', 0),
('PR00004', 'US00003', 1),
('PR00005', 'US00001', 1),
('PR00005', 'US00002', 0),
('PR00006', 'US00002', 1),
('PR00006', 'US00003', 0),
('PR00007', 'US00004', 0),
('PR00008', 'US00005', 0),
('PR00009', 'US00004', 0),
('PR00010', 'US00004', 0),
('PR00011', 'US00004', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `user_proyecto_view`
--
CREATE TABLE IF NOT EXISTS `user_proyecto_view` (
`id_rango` int(11)
,`id_proyecto` varchar(7)
,`title_proyecto` varchar(50)
,`descripcion_proyecto` varchar(500)
,`fechaLimit_proyecto` date
,`id_user` varchar(7)
,`nick_user` varchar(20)
,`email_user` varchar(200)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `user_proyecto_view`
--
DROP TABLE IF EXISTS `user_proyecto_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proyecto_test`.`user_proyecto_view` AS select `proyecto_test`.`user_proyecto`.`id_rango` AS `id_rango`,`proyecto_test`.`proyecto`.`id` AS `id_proyecto`,`proyecto_test`.`proyecto`.`title` AS `title_proyecto`,`proyecto_test`.`proyecto`.`descripcion` AS `descripcion_proyecto`,`proyecto_test`.`proyecto`.`fechaLimit` AS `fechaLimit_proyecto`,`proyecto_test`.`user`.`id` AS `id_user`,`proyecto_test`.`user`.`nick` AS `nick_user`,`proyecto_test`.`user`.`email` AS `email_user` from (`proyecto_test`.`user_proyecto` join (`proyecto_test`.`user` join `proyecto_test`.`proyecto`) on(((`proyecto_test`.`user`.`id` = `proyecto_test`.`user_proyecto`.`id_user`) and (`proyecto_test`.`proyecto`.`id` = `proyecto_test`.`user_proyecto`.`id_proyecto`)))) order by `proyecto_test`.`user_proyecto`.`id_rango`;

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
