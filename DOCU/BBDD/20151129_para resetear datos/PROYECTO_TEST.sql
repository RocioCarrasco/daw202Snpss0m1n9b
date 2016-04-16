-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-11-2015 a las 16:44:58
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
('PR00011', 'FA00001', 'DEFAULT', NULL, NULL),
('PR00012', 'FA00001', 'DEFAULT', NULL, NULL),
('PR00012', 'FA00002', 'DEFAULT', NULL, NULL),
('PR00012', 'FA00003', 'DEFAULT', NULL, NULL),
('PR00013', 'FA00001', 'DEFAULT', NULL, NULL),
('PR00013', 'FA00002', 'DEFAULT', NULL, NULL),
('PR00014', 'FA00001', 'DEFAULT', NULL, NULL);

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
('PR00011', 'proIII', 'Puedo incluir mÃ¡s de uno, por fi???', NULL),
('PR00012', 'collab a la de 3', 'kkkk', NULL);

--
-- Volcado de datos para la tabla `TAREA`
--

INSERT INTO `TAREA` (`fase`, `id_proyecto`, `id`, `id_status`, `title`, `descripcion`, `fechaLimit`) VALUES
('FA00000', 'PR00001', 'TA00001', 1, 'hsasd', 'Algo hay que hacer', NULL),
('FA00000', 'PR00001', 'TA00002', 1, 'tarea', 'nueva tarea', NULL),
('FA00000', 'PR00001', 'TA00003', 1, 'otra tarea', 'miau', NULL),
('FA00000', 'PR00003', 'TA00001', 1, 'patatas', 'fritas, please', NULL),
('FA00000', 'PR00008', 'TA00000', 1, 'TASK1', 'DESC', NULL);

--
-- Volcado de datos para la tabla `USER`
--

INSERT INTO `USER` (`id`, `nick`, `email`, `pass`) VALUES
('US00001', 'user1', 'none', ''),
('US00002', 'user2', 'none', ''),
('US00003', 'user3', 'none', 'b59c67bf196a4758191e42f76670ceba'),
('US00004', 'userdemo', 'x', 'b59c67bf196a4758191e42f76670ceba'),
('US00005', 'userdemo2', 'x', 'b59c67bf196a4758191e42f76670ceba');

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
('PR00012', 'US00003', 1),
('PR00012', 'US00005', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
