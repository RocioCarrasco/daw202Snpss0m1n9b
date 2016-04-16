-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-04-2016 a las 18:45:52
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

--
-- 2016-04-16
-- Trigger de fase Default añadido
-- Fechas automáticas de creación TIMESTAMP para proyecto y fase
-- Fechas Límite en TIMESTAMP para proyecto y tarea
-- Posiblemente sea necesario crear datos nuevos
--
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
-- Estructura de tabla para la tabla `USER`
--
-- Creación: 22-03-2016 a las 12:49:52
--

DROP TABLE IF EXISTS `USER`;
CREATE TABLE IF NOT EXISTS `USER` (
  `id` varchar(7) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROYECTO`
--
-- Creación: 16-04-2016 a las 14:52:19
--

DROP TABLE IF EXISTS `PROYECTO`;
CREATE TABLE IF NOT EXISTS `PROYECTO` (
  `id` varchar(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` timestamp NULL DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Estructura de tabla para la tabla `FASE`
--
-- Creación: 16-04-2016 a las 15:03:48
--

DROP TABLE IF EXISTS `FASE`;
CREATE TABLE IF NOT EXISTS `FASE` (
  `proyecto` varchar(7) NOT NULL,
  `id` varchar(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` timestamp NULL DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`proyecto`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Estructura de tabla para la tabla `GRUPO`
--
-- Creación: 22-03-2016 a las 12:49:51
--

DROP TABLE IF EXISTS `GRUPO`;
CREATE TABLE IF NOT EXISTS `GRUPO` (
  `id` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `GRUPO`:
--

--
-- Estructura de tabla para la tabla `TAREA`
--
-- Creación: 16-04-2016 a las 15:05:32
--

DROP TABLE IF EXISTS `TAREA`;
CREATE TABLE IF NOT EXISTS `TAREA` (
  `fase` varchar(7) NOT NULL,
  `id_proyecto` varchar(7) NOT NULL,
  `id` varchar(7) NOT NULL,
  `id_status` int(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fechaLimit` timestamp NULL DEFAULT NULL,
  `fe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_proyecto`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `USER_PROYECTO`
--
-- Creación: 22-03-2016 a las 12:49:52
--

DROP TABLE IF EXISTS `USER_PROYECTO`;
CREATE TABLE IF NOT EXISTS `USER_PROYECTO` (
  `id_proyecto` varchar(7) NOT NULL,
  `id_user` varchar(7) NOT NULL,
  `id_rango` int(11) NOT NULL,
  PRIMARY KEY (`id_proyecto`,`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `USER_PROYECTO`:
--


--
-- Volcado de datos para la tabla `USER`
--

INSERT INTO `USER` (`id`, `nick`, `email`, `pass`) VALUES
('US00001', 'user1', 'none', 'b59c67bf196a4758191e42f76670ceba'),
('US00002', 'user2', 'none', 'b59c67bf196a4758191e42f76670ceba'),
('US00003', 'user3', 'none', 'b59c67bf196a4758191e42f76670ceba'),
('US00004', 'userdemo', 'x', 'b59c67bf196a4758191e42f76670ceba'),
('US00005', 'userdemo2', 'x', 'b59c67bf196a4758191e42f76670ceba');


--
-- Volcado de datos para la tabla `PROYECTO`
--

INSERT INTO `PROYECTO` (`id`, `title`, `descripcion`, `fechaLimit`, `fechaCreacion`) VALUES
('PR00001', 'PROYECTO1', 'Lorem Ipsum Dolom', NULL, '2016-04-16 14:52:19'),
('PR00002', 'PROYECTO2', 'Lorem Ipsum Dolom', NULL, '2016-04-16 14:52:19'),
('PR00003', 'PROYECTO3', 'Lorem Ipsum Dolom', NULL, '2016-04-16 14:52:19'),
('PR00004', 'PROYECTO4', 'Lorem Ipsum Dolom', NULL, '2016-04-16 14:52:19'),
('PR00005', 'PROYECTO5', 'Lorem Ipsum Dolom', NULL, '2016-04-16 14:52:19'),
('PR00006', 'PROYECTO6', 'Lorem Ipsum Dolom', NULL, '2016-04-16 14:52:19'),
('PR00007', 'PROYECTO7', 'Lorem Ipsum Dolom', NULL, '2016-04-16 14:52:19'),
('PR00008', 'NUEVO', 'KKKK', NULL, '2016-04-16 14:52:19'),
('PR00009', 'proFFF', 'Esto es una prueba para comprobar como las cosas que en la lÃ³gica no funcionan al final funcionan por cuestiones que se me escapan...', NULL, '2016-04-16 14:52:19'),
('PR00010', 'proGGG', 'alsfsdlkfjÃ±laksj', NULL, '2016-04-16 14:52:19'),
('PR00011', 'proIII', 'Puedo incluir mÃ¡s de uno, por fi???', NULL, '2016-04-16 14:52:19'),
('PR00012', 'galletas2', 'friendship', NULL, '2016-04-16 14:52:19'),
('PR00013', 'nuevoTrasActualizar', 'vamos a ver si lo hace bien', '2016-04-22 22:00:00', '2016-04-16 14:52:19');

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
('PR00011', 'US00004', 0),
('PR00012', 'US00004', 0),
('PR00013', 'US00002', 1),
('PR00013', 'US00003', 1),
('PR00013', 'US00004', 0);



--
-- Estructura Stand-in para la vista `user_proyecto_view`
--
DROP VIEW IF EXISTS `user_proyecto_view`;
CREATE TABLE IF NOT EXISTS `user_proyecto_view` (
`id_rango` int(11)
,`id_proyecto` varchar(7)
,`title_proyecto` varchar(50)
,`descripcion_proyecto` varchar(500)
,`fechaLimit_proyecto` timestamp
,`id_user` varchar(7)
,`nick_user` varchar(20)
,`email_user` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `user_proyecto_view`
--
DROP TABLE IF EXISTS `user_proyecto_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_proyecto_view`  AS  select `user_proyecto`.`id_rango` AS `id_rango`,`proyecto`.`id` AS `id_proyecto`,`proyecto`.`title` AS `title_proyecto`,`proyecto`.`descripcion` AS `descripcion_proyecto`,`proyecto`.`fechaLimit` AS `fechaLimit_proyecto`,`user`.`id` AS `id_user`,`user`.`nick` AS `nick_user`,`user`.`email` AS `email_user` from (`user_proyecto` join (`user` join `proyecto`) on(((`user`.`id` = `user_proyecto`.`id_user`) and (`proyecto`.`id` = `user_proyecto`.`id_proyecto`)))) order by `user_proyecto`.`id_rango` ;


--
-- Metadatos
--
USE `phpmyadmin`;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
