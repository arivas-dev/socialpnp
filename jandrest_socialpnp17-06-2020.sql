-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-06-2020 a las 12:30:02
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jandrest_socialpnp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action_type`
--

CREATE TABLE `action_type` (
  `id` int(11) NOT NULL,
  `action_name` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `action_type`
--

INSERT INTO `action_type` (`id`, `action_name`, `estado`) VALUES
(1, 'CREATE', 1),
(2, 'UPDATE', 1),
(3, 'SHOW', 1),
(4, 'DELETE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `nombre`) VALUES
(6, 'resources/files/post_image/35_logoItca.png'),
(7, 'resources/files/post_image/33_D5E.jpg'),
(8, 'resources/files/post_image/33_bd.jpeg'),
(9, 'resources/files/post_image/2_Dragon Ball (7).jpg'),
(10, 'resources/files/post_image/39_IMG-20200410-WA0011.jpg'),
(11, 'resources/files/post_image/40_shoes nautica doradas.webp'),
(12, 'resources/files/post_image/41_CERRADO.png'),
(13, 'resources/files/post_image/43_2019-Jeep-Cherokee-Limited-Editions-Altitude.jpg.image.1440.jpg'),
(14, 'resources/files/post_image/59_JEEP GRAND CHEROKEE TRACKHAWK 4dr x4x.jpg'),
(15, 'resources/files/post_image/2_Allen_Walker,_D.Gray-man,_Manga.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_servicios`
--

CREATE TABLE `area_servicios` (
  `id` int(11) NOT NULL,
  `nombre_area` varchar(150) DEFAULT NULL,
  `descripcion` text,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `estado`) VALUES
(1, 'Vehiculo', 1),
(2, 'Prueba 1', 1),
(3, 'Prueba 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_empresa`
--

CREATE TABLE `categoria_empresa` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_empresa`
--

INSERT INTO `categoria_empresa` (`id`, `nombre`, `estado`) VALUES
(39, 'Tecnologia', 1),
(40, 'Economia', 1),
(41, 'Comida rapida', 1),
(42, 'Costillas a la barbacoa', 1),
(43, 'Pupuseria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_grupo`
--

CREATE TABLE `categoria_grupo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `grupo_id` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_habilidad`
--

CREATE TABLE `categoria_habilidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `habilidades_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_titulo`
--

CREATE TABLE `categoria_titulo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `titulos_id` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(15) NOT NULL,
  `nombre_ciudad` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `departamento_estado_provincia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre_ciudad`, `estado`, `departamento_estado_provincia_id`) VALUES
(0, 'Ciudad de Chimaltenango', 1, 3),
(1, 'Chiltiupan', 1, 1),
(2, 'Teotepeque', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` bigint(20) NOT NULL,
  `nombre_cliente` varchar(150) DEFAULT NULL,
  `ctl_usuario_id` int(11) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `perfil_facebook` varchar(300) DEFAULT NULL,
  `perfil_instagram` varchar(300) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `ciudad_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `code_reset_password`
--

CREATE TABLE `code_reset_password` (
  `cod_id` int(11) NOT NULL,
  `cod_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cod_codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cod_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `code_reset_password`
--

INSERT INTO `code_reset_password` (`cod_id`, `cod_email`, `cod_codigo`, `cod_date`) VALUES
(11, 'virgilio.antonioramos@gmail.com', '4q7ahr', '2020-02-14'),
(8, 'virgilio@visionalweb.com', '453vn3', '2020-02-14'),
(9, 'virgilio1994@outlook.com', '45qj4h', '2020-02-14'),
(10, 'virgilio.antonioramos@gmail.com.com', 'mq0eza', '2020-02-14'),
(12, 'virgilio@visionalweb.com', 'le5caw', '2020-02-17'),
(13, 'virgilio.antonioramos@gmail.com', 'l5tp6k', '2020-02-17'),
(14, 'guillermo.jandres@gmail.com', 'zgeoyw', '2020-02-20'),
(15, 'guillermo.jandres@gmail.com', 'e4j4ml', '2020-02-20'),
(16, 'rgrevelo@gmail.com', 'v3hw8r', '2020-04-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctl_rol`
--

CREATE TABLE `ctl_rol` (
  `id` int(11) NOT NULL,
  `rol` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ctl_rol`
--

INSERT INTO `ctl_rol` (`id`, `rol`) VALUES
(1, 'ROLE_FREELANCER'),
(2, 'ROLE_ADMIN'),
(3, 'ROLE_ENTERPRISE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctl_rol_usuario`
--

CREATE TABLE `ctl_rol_usuario` (
  `ctl_rol_id` int(11) NOT NULL,
  `ctl_usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ctl_rol_usuario`
--

INSERT INTO `ctl_rol_usuario` (`ctl_rol_id`, `ctl_usuario_id`) VALUES
(1, 4),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(3, 42),
(3, 43),
(3, 44),
(3, 45),
(3, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(3, 52),
(3, 53),
(3, 54),
(3, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 68),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(3, 79),
(1, 80),
(3, 81),
(1, 82),
(3, 83),
(3, 84),
(1, 85),
(1, 86),
(1, 87),
(3, 88),
(1, 89),
(1, 90),
(3, 91),
(3, 92),
(3, 93),
(3, 94),
(3, 95),
(3, 96),
(3, 97),
(1, 98),
(1, 110),
(3, 111),
(3, 112),
(1, 113),
(3, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(3, 134),
(1, 135),
(1, 136),
(1, 149),
(3, 150),
(1, 151),
(3, 152);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctl_usuario`
--

CREATE TABLE `ctl_usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT 'sirve para saber si el usuario esta activo o no',
  `tipo_registro` varchar(45) DEFAULT NULL COMMENT '1-Registro desde Sitio 2-Faceebook 3-Twitter',
  `auth_id` varchar(100) DEFAULT NULL,
  `nameft` varchar(70) DEFAULT NULL,
  `active_on_off` int(11) DEFAULT '1' COMMENT 'servira para validar si esta online u offline'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ctl_usuario`
--

INSERT INTO `ctl_usuario` (`id`, `username`, `password`, `salt`, `estado`, `tipo_registro`, `auth_id`, `nameft`, `active_on_off`) VALUES
(3, 'administracion', 'DXdBJbWxz1+bYMApzxPrv8mFaTwMWHdULMsu5x5F7uOeTqgZnaaXeuwC6x/JMBBdYYcZg/3St7RfM+Xk6BWuxw==', '3150e4bc29b3e130d03a2c00f519c630', 1, NULL, NULL, NULL, 0),
(4, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, NULL, NULL, NULL, 0),
(15, 'guillermo.jandres', 'cd958c95bc4aedf7bd088a66b72728a4546168d5', 'e2ff4ba4f3319d2642f601ea32d284f3c18e7a54fda7c8032d5d0b65fb7d151607f5dea9877dbef08b9c2c22f760ce7237afd449f8e5ec16b8184e89e8007a2b', 1, NULL, NULL, NULL, 0),
(16, 'giovanni.tzec', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 1, '1', NULL, NULL, 1),
(17, 'rolando', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(18, 'luzmenendez', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(19, 'crisia', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(20, 'dayana.iraheta', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(21, 'jaime0407', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(22, 'avenmiguel', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(23, 'tiburonazul', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(24, 'tiburonazul', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(25, 'tiburonazul', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(26, 'edgarfg4', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(27, 'javier', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(28, 'restaurante cihuatal', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(29, 'restaurante cihuatan', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(30, 'Comedor Conchita de Citala ', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(31, 'doctora Laura Valle', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(32, 'Andre Shop', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(33, 'EmpresaE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(34, 'EmpresaE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(35, 'PruebaE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(36, 'PruebaE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(37, 'PruebaE2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(38, 'PruebaE2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(39, 'PruebaE2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(40, 'PruebaE2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(41, 'Prueba3E', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(42, 'dianaE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(43, 'dianaE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(44, 'dianaA', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(45, 'lido', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(46, 'lidoA', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(47, 'lidoB', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(48, 'bimbo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(49, 'pupuseria el rosario ', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(50, 'pupuseria el rosario ', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(51, 'pupuseria el rosario ', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(52, 'Pupusería Lili', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(53, 'Postres Ladoratasv', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(54, 'tacos Guzmán ', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(55, 'Vidrieria La Roca', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(56, 'Marlocito', '031c1fef576ededf4db725655ff890d30a323216', '785303961f84c0fed14509727c3841d8b05b2ba61ab544d8d697d9cc06d40ea0780d14bb8a0c01b34cffcfaf6b6cebe76db9875d029685186c56a02c71fd2828', 1, '1', NULL, NULL, 0),
(57, 'Marlocito', '031c1fef576ededf4db725655ff890d30a323216', '785303961f84c0fed14509727c3841d8b05b2ba61ab544d8d697d9cc06d40ea0780d14bb8a0c01b34cffcfaf6b6cebe76db9875d029685186c56a02c71fd2828', 1, '1', NULL, NULL, 0),
(58, 'Marlocito', '031c1fef576ededf4db725655ff890d30a323216', '785303961f84c0fed14509727c3841d8b05b2ba61ab544d8d697d9cc06d40ea0780d14bb8a0c01b34cffcfaf6b6cebe76db9875d029685186c56a02c71fd2828', 1, '1', NULL, NULL, 0),
(59, 'virgilio.ramosssss', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(60, 'virgilio4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(61, 'virgilio4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(62, 'juan.perex', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(63, 'juan.pere2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(64, 'juan.pere2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(65, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(66, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(67, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(68, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(69, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(70, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(71, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(72, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(73, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(74, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(75, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(76, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(77, 'erick.valdez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(78, 'virgilio.ramos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 1),
(79, 'visional.web', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 1),
(80, 'pedro25', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(81, 'netocars', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(82, 'luisl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(83, 'itca', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(84, 'empresaC', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(85, 'rmeltrozo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(86, 'operez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(87, 'operez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(88, 'empresa123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(89, 'gperez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(90, 'sape.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(91, 'PuercoRico', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(92, 'Coca Cola', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(93, 'Tiburon Azul', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(94, 'JANDRES', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(95, 'Ron', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(96, 'Pupuseria San Rafael', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(97, 'treboldigital', '153b10f58bdce41e7409645fe5ca674dd501bc23', '0c07c38248c0e0fd454518dbf121e09da4e030ef8d1b4414ff110e3956f4c5deb7442676821071318d079e5318d23fcb5ef58f07cd4b7a1bbcda2c2bedd9deae', 1, '1', NULL, NULL, 0),
(98, 'martha.flores', 'cd958c95bc4aedf7bd088a66b72728a4546168d5', 'e2ff4ba4f3319d2642f601ea32d284f3c18e7a54fda7c8032d5d0b65fb7d151607f5dea9877dbef08b9c2c22f760ce7237afd449f8e5ec16b8184e89e8007a2b', 1, '1', NULL, NULL, 0),
(110, 'test1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(111, 'empresa.test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(112, 'pupuseria olocuilta', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(113, 'jandres.guillermo', 'cd958c95bc4aedf7bd088a66b72728a4546168d5', 'e2ff4ba4f3319d2642f601ea32d284f3c18e7a54fda7c8032d5d0b65fb7d151607f5dea9877dbef08b9c2c22f760ce7237afd449f8e5ec16b8184e89e8007a2b', 1, NULL, NULL, NULL, 0),
(114, 'sportgym', 'cd958c95bc4aedf7bd088a66b72728a4546168d5', 'e2ff4ba4f3319d2642f601ea32d284f3c18e7a54fda7c8032d5d0b65fb7d151607f5dea9877dbef08b9c2c22f760ce7237afd449f8e5ec16b8184e89e8007a2b', 1, '1', NULL, NULL, 0),
(115, 'Cindy', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(116, 'Borjas17', 'b05044c3ead83694b5d0ed7e196c7857c213a084', '03d59b3e6c9eff34dba11677eb83c32cabf9ec240d955dc4140909abf2fda14563864ba5bf26b215771b7d0ddd467761285758ec697c02d36b6b1de8030d0e74', 1, '1', NULL, NULL, 0),
(117, 'sergioisrael', 'e2681df9525e9b5c9ad69095a0219b5d4ad7b9a7', 'ce16ff0b79fa8d9fee5a112746f0a20df209f0506ead70947a11c6676a02962b61176099c464d7f1c3db62cda514609ff521e79c76221246c6b33a431157fcaa', 1, '1', NULL, NULL, 0),
(118, 'Emenendez', 'bc8d0b8bfda99b4416fa62f549f065fc0dd026fe', 'b42fde0a40ebc134daae204667d4ad341fd9d4e8a45d68b51bf5231e18e30fc783842aa40cdcfe1eb87eedabe84d558073246268ae871549577c8a7b1a911a5e', 1, '1', NULL, NULL, 1),
(119, 'Edwin', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(120, 'Inji', '489b1ea04b1845894c188884fb35f6be237b1ae5', '6a9de5304184f651dee8e97192ace27160e04b4eea1cd839288c167d6b2a68812306b3a83c20f12760b22f6187a2f2eb589d81b7bfcc2c637dc9f1a8eb9d62b0', 1, '1', NULL, NULL, 1),
(121, 'griselzamora', 'b354d3755000081908c6d19b01bbc4ad62391954', 'ad2aa678e873204c4036d4d94dfdc6b35ab6310f4154d61918813e63d901950b71eeede30190744aba2366301fcb816fee0baa9ea15794cff9e2f1cf1096f3cb', 1, '1', NULL, NULL, 1),
(122, 'jbaldelicias', '1ec4f8dfcf3190dca17503778ab78420c570eb20', 'bc7a1980beda3bd72a9538ed3be5ebca1464505b31a41733b01dfdd1ff5cfccb91d9dbfb785a446e4d6ae09c78fd7d29bb5725461eaa056df28ae6835265521b', 1, '1', NULL, NULL, 0),
(123, 'douglascastro', '62514c3acbe88d1bd7cf94c49571347e8d4ccb06', '08de7d59e171687b8382eb455d09d8a0bc8f42cac4ff438fde30f98197891179ef3aac3738be28d9d22eb984db19c65c668bee13988679de2e41229a4069ad1e', 1, '1', NULL, NULL, 0),
(124, 'julio', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(125, 'Ismael ', '8cb2237d0679ca88db6464eac60da96345513964', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 1, '1', NULL, NULL, 1),
(126, 'Vero.dd2', 'da04e0f8469058e0a9c805941fdf671e782f4faf', 'c522837f4f8d9ab60911bfd4ae0be688fcc024d5d1b17d8ddacb64128a9404189a4b58a627de241f8f856dc1eec467bf069d3e73af53c99103b07df1888f9a6f', 1, '1', NULL, NULL, 1),
(127, 'Krissia', 'a5eafbdbff5f42edd7abf7020d46e0c65298c586', '2e06e391672fb241ff67aca9e513d7264cb93acf53306e22150f7fa64e994a7511f3b66838dd7f138d96f7327b336221281cd8e94f99ee9ec8627495faf5693e', 1, '1', NULL, NULL, 1),
(128, 'Samuel_Angulo', 'c6de8da1a99408c791b1d8d22fd39dc7be983aa4', 'fb0b14b1f7b7dbe06fd8808b105e2352251774c156ba6e3dd93515e6a6dabfb68ca6a0724e9eae1d5238c27ee94a2268bfc431aa141a272589646b0f077c7457', 1, '1', NULL, NULL, 1),
(129, 'Almiita', '1966e694bad90686516f99cdf432800fdca39290', 'a543e8fcda2f0b318826667effe4e4b3ac22705112f9470d7e3d07c71ca1025d235e6d361160b5b2b0b61f7121b84234dd0ddbd00d206f8f4805fef04f595193', 1, '1', NULL, NULL, 1),
(130, 'Faty Pal', 'd4a430121e318bf90622d0332a10e0d6661c3445', '208dfbf1f21bf84ee9af8456d1a0801f8831dc133a0fdd5a81509b6dcc909ab72d09d424beb786d80dfbdfe008d45ed6a9061290832a0f8bf2f25da7fb5563c5', 1, '1', NULL, NULL, 1),
(131, 'Mike Rodriguez', 'e2ca3bf213f215d92d861ed96687d97dfa921512', 'f400e58df56766362af10718a7295a19d9a8f0387cb601f0cd0fb52768776144811a8858f4e016c43e6cdab535d24d6305545318e7d57d67bf2d46832eef09a9', 1, '1', NULL, NULL, 1),
(132, 'douglas.castro', '0d8fe332f07365615478253cc5476ec04f13dfa9', '12873e27df5238a34bc0a7f7055a63dae6370a40bc516e6bf3a424d742023a73b79393048f8c906b834c9577cfd02e3a5894029e5e7193d65b62efe6810409f2', 1, '1', NULL, NULL, 0),
(133, 'Annete', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0),
(134, 'ramos.lopez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(135, 'nuevo.lopez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '1', NULL, NULL, 0),
(136, 'JVILLATORO', 'fa9aaac376ec191abacabaaa8d03940cd19bd3ac', 'b5124a9bec3c1ef27b298f4043dc4dce4c228d4b64f30e68c07a60e6207ca2815eb52d5b419b91370d2e44bc51c0b93f1da20019c5866df526b7c2fc50b0fc06', 1, '1', NULL, NULL, 0),
(149, '3016346251778330', '4faff95a39766bdb3124e892dd41587b319be230', '3828c1d10533c3b82661b8d02db6636f73f1fe1de4cc5b783bf5f73c9c6955e114c2e68f209c308fad8793974b18d6019b2c30b0d91bd459a6cd4deb61d85065', 1, '2', '3016346251778330', 'Giovanni Chavez', 1),
(150, '1587191718107558', '1d69c373790ac78452bf90bcec73cd0f12682df1', 'f7b7f7d12ceef77e7251be1a4bbd1911472e414ac317c2b52130d81a2de26747cc1cb2b1efc079540fbc8fef68f6099904b161481c785a750ab90cb1a4f90d94', 1, '2', '1587191718107558', 'Virgilio Lopez', 0),
(151, '10207273780718256', '835139bbd5c985ebcdcb36131dbef691b1fe79f6', 'b1dbb2d62c03544f3502358a6058bac1646738254424f44ca72861a70f84577d4f092a23f539176c1b51209bce90476b7673950b1f50dd8c65930e5cb21f3467', 1, '2', '10207273780718256', 'Rolando Guzmán Revelo', 0),
(152, 'FUDESAL', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 1, '1', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_logs_action`
--

CREATE TABLE `data_logs_action` (
  `id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `ctl_usuario_id` int(11) NOT NULL,
  `action_type_id` int(11) NOT NULL,
  `action_date` datetime NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `cliente_id` bigint(20) DEFAULT NULL,
  `habilidades_id` int(11) DEFAULT NULL,
  `paises_por_region_id` int(11) DEFAULT NULL,
  `regiones_por_pais_id` int(11) DEFAULT NULL,
  `ciudad_id` int(15) DEFAULT NULL,
  `detalle_habilidades_id` int(11) DEFAULT NULL,
  `categoria_habilidad_id` int(11) DEFAULT NULL,
  `detalle_grupo_id` int(11) DEFAULT NULL,
  `freelancer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ctl_rol_id` int(11) DEFAULT NULL,
  `ctl_rol_usuario_ctl_usuario_id` int(11) DEFAULT NULL,
  `ctl_rol_usuario_ctl_rol_id` int(11) DEFAULT NULL,
  `solicitud_servicio_empresa_id` bigint(100) DEFAULT NULL,
  `detalle_area_servicios_freelance_id` bigint(20) DEFAULT NULL,
  `relaciones_amigos_id1` int(11) DEFAULT NULL,
  `area_servicios_id` int(11) DEFAULT NULL,
  `fotos_servicios_freelancer_empresa_id` bigint(100) DEFAULT NULL,
  `servicios_freelancer_id` bigint(20) DEFAULT NULL,
  `categoria_titulo_id` int(11) DEFAULT NULL,
  `empresa_id` bigint(20) DEFAULT NULL,
  `mensaje_id` bigint(20) DEFAULT NULL,
  `detalle_area_servicios_empresa_id` bigint(20) DEFAULT NULL,
  `servicios_empresa_id` bigint(20) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `solicitud_servicio_freelancer_id` bigint(100) DEFAULT NULL,
  `categoria_grupo_id` int(11) DEFAULT NULL,
  `titulos_id` int(11) DEFAULT NULL,
  `departamento_estado_provincia_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `data_logs_action`
--

INSERT INTO `data_logs_action` (`id`, `ctl_usuario_id`, `action_type_id`, `action_date`, `grupo_id`, `cliente_id`, `habilidades_id`, `paises_por_region_id`, `regiones_por_pais_id`, `ciudad_id`, `detalle_habilidades_id`, `categoria_habilidad_id`, `detalle_grupo_id`, `freelancer_id`, `ctl_rol_id`, `ctl_rol_usuario_ctl_usuario_id`, `ctl_rol_usuario_ctl_rol_id`, `solicitud_servicio_empresa_id`, `detalle_area_servicios_freelance_id`, `relaciones_amigos_id1`, `area_servicios_id`, `fotos_servicios_freelancer_empresa_id`, `servicios_freelancer_id`, `categoria_titulo_id`, `empresa_id`, `mensaje_id`, `detalle_area_servicios_empresa_id`, `servicios_empresa_id`, `pais_id`, `solicitud_servicio_freelancer_id`, `categoria_grupo_id`, `titulos_id`, `departamento_estado_provincia_id`) VALUES
(1, 4, 1, '2019-11-26 09:20:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento_estado_provincia`
--

CREATE TABLE `departamento_estado_provincia` (
  `id` int(11) NOT NULL,
  `nombre_depto_region_provincia` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `regiones_por_pais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento_estado_provincia`
--

INSERT INTO `departamento_estado_provincia` (`id`, `nombre_depto_region_provincia`, `estado`, `regiones_por_pais_id`) VALUES
(1, 'LA LIBERTAD', 1, 1),
(3, 'CHIMALTENANGO', 1, 2),
(4, 'BAJA VERAPAZ', 1, 2),
(5, 'CHIMALTENANGO', 1, 2),
(6, 'CHIQUIMULA', 1, 2),
(7, 'EL PROGRESO', 1, 2),
(8, 'ESCUINTLA', 1, 2),
(9, 'GUATEMALA', 1, 2),
(10, 'HUEHUETENANGO', 1, 2),
(11, 'IZABAL', 1, 2),
(12, 'JALAPA', 1, 2),
(13, 'JUTIAPA', 1, 2),
(14, 'PETÉN', 1, 2),
(15, 'QUETZALTENANGO', 1, 2),
(16, 'QUICHÉ', 1, 2),
(17, 'RETALHULEU', 1, 2),
(18, 'SACATEPÉQUEZ', 1, 2),
(19, 'SAN MARCOS', 1, 2),
(20, 'SANTA ROSA', 1, 2),
(21, 'SOLOLÁ', 1, 2),
(22, 'SUCHITEPÉQUEZ', 1, 2),
(23, 'TOTONICAPÁN', 1, 2),
(24, 'ZACAPA', 1, 2),
(25, 'AHUACHAPÁN', 1, 4),
(26, 'SANTA ANA', 1, 4),
(27, 'SONSONATE', 1, 4),
(28, 'CHALATENANGO', 1, 1),
(29, 'SAN SALVADOR', 1, 1),
(30, 'CUSCATLÁN', 1, 1),
(31, 'LA PAZ', 1, 5),
(32, 'SAN VICENTE', 1, 5),
(33, 'CABAÑAS', 1, 5),
(34, 'USULUTÁN', 1, 3),
(35, 'SAN MIGUEL', 1, 3),
(36, 'MORAZÁN', 1, 3),
(37, 'LA UNIÓN', 1, 3),
(38, 'ALTA VERAPAZ', 1, 2),
(39, 'ISLAS DE LA BAHÍA', 1, 13),
(40, 'CORTÉS', 1, 13),
(41, 'ATLÁNTIDA', 1, 13),
(42, 'CHOLUTECA', 1, 13),
(43, 'VALLE', 1, 13),
(44, 'LA PAZ', 1, 13),
(45, 'EL PARAÍSO', 1, 13),
(46, 'FRANCISCO MORAZÁN', 1, 13),
(47, 'COMAYAGUA', 1, 13),
(48, 'INTIBUCÁ', 1, 13),
(49, 'LEMPIRA', 1, 13),
(50, 'OCOTEPEQUE', 1, 13),
(51, 'OLANCHO', 1, 13),
(52, 'YORO', 1, 13),
(53, 'SANTA BÁRBARA', 1, 13),
(54, 'COPÁN', 1, 13),
(55, 'GRACIAS A DIOS', 1, 13),
(56, 'COLÓN', 1, 13),
(57, 'CARIBE NORTE', 1, 14),
(58, 'CARIBE SUR', 1, 14),
(59, 'BOACO', 1, 14),
(60, 'CARAZO', 1, 14),
(61, 'CHINANDEGA', 1, 14),
(62, 'CHONTALES', 1, 14),
(63, 'ESTELÍ', 1, 14),
(64, 'GRANADA', 1, 14),
(65, 'JINOTEGA', 1, 14),
(66, 'LEÓN', 1, 14),
(67, 'MADRIZ', 1, 14),
(68, 'MANAGUA', 1, 14),
(69, 'MASAYA', 1, 14),
(70, 'MATAGALPA', 1, 14),
(71, 'NUEVA SEGOVIA', 1, 14),
(72, 'RÍO SAN JUAN', 1, 14),
(73, 'RIVAS', 1, 14),
(74, 'DARIÉN', 1, 15),
(75, 'VERAGUAS', 1, 15),
(76, 'PANAMÁ', 1, 15),
(77, 'CHIRIQUÍ', 1, 15),
(78, 'COCLÉ', 1, 15),
(79, 'COLÓN', 1, 15),
(80, 'BOCAS DEL TORO', 1, 15),
(81, 'LOS SANTOS', 1, 15),
(82, 'PANAMÁ OESTE', 1, 15),
(83, 'HERRERA', 1, 15),
(84, 'NGÄBE-BUGLÉ', 1, 15),
(85, 'EMBERÁ-WOUNAAN', 1, 15),
(86, 'GUNA YALA', 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_area_servicios_empresa`
--

CREATE TABLE `detalle_area_servicios_empresa` (
  `id` bigint(20) NOT NULL,
  `empresa_id` bigint(20) DEFAULT NULL,
  `area_servicios_id` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_area_servicios_freelance`
--

CREATE TABLE `detalle_area_servicios_freelance` (
  `id` bigint(20) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL,
  `area_servicios_id` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_categoria_post`
--

CREATE TABLE `detalle_categoria_post` (
  `id` bigint(20) NOT NULL,
  `id_post` bigint(20) DEFAULT NULL,
  `id_tipo_categoria` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo`
--

CREATE TABLE `detalle_grupo` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `ctl_usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_habilidades`
--

CREATE TABLE `detalle_habilidades` (
  `id` int(11) NOT NULL,
  `habilidades_id` int(11) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_subcategoria_empresa`
--

CREATE TABLE `detalle_subcategoria_empresa` (
  `id` bigint(20) NOT NULL,
  `id_empresa` bigint(20) DEFAULT NULL,
  `Id_subcategoria` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_subcategoria_empresa`
--

INSERT INTO `detalle_subcategoria_empresa` (`id`, `id_empresa`, `Id_subcategoria`, `estado`) VALUES
(29, 35, 8, 0),
(30, 35, 9, 0),
(31, 40, 10, 1),
(34, 35, 8, 1),
(35, 35, 11, 0),
(36, 35, 12, 1),
(37, 56, 13, 1);


--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `ctl_usuario_id` int(11) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `ciudad_id` int(15) DEFAULT NULL,
  `perfil_facebook` varchar(450) DEFAULT NULL,
  `perfil_instagram` varchar(450) DEFAULT NULL,
  `perfil_twiter` varchar(450) DEFAULT NULL,
  `acerca_de_ti` text DEFAULT NULL,
  `ocupation` varchar(160) DEFAULT NULL,
  `experiencia` text DEFAULT NULL,
  `ubicacion` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `foto_portada` varchar(255) DEFAULT NULL,
  `servicio_domicilio` varchar(150) DEFAULT NULL,
  `nombre_contacto` varchar(150) DEFAULT NULL,
  `horario_atencion` varchar(250) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `ctl_usuario_id`, `direccion`, `telefono1`, `telefono2`, `email`, `ciudad_id`, `perfil_facebook`, `perfil_instagram`, `perfil_twiter`, `acerca_de_ti`, `ocupation`, `experiencia`, `ubicacion`, `estado`, `foto_perfil`, `foto_portada`, `servicio_domicilio`, `nombre_contacto`, `horario_atencion`, `url`) VALUES
(12, 'Diana', 44, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Lido', 45, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Bimbo', 48, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'pupuseria el rosario', 49, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Pupusería Lili', 52, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Postres La Dorata SV', 53, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'tacos Guzmán', 54, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Vidrieria La Roca', 55, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Marlon', 56, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'juan', 64, 'perez', NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'erick', 65, 'valdez', NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Visional web', 79, '1', '2345-74635', '7354-3652', 'virgilio@visionalweb.com', 1, ' www.facebook.com/visionalweb', NULL, NULL, 'Empresa dedicada a la venta de servicios atravez de software empresarial nnn', 'Venta de software', 'Agregar la experiencia de tu empresa.llll', ' municipio de chiltiupan.', 1, 'resources/files/enterprise/35_Logotipo 01-100x100.jpg', 'resources/files/enterprise/portada/wallpaper.jpg', 'Si', 'Virgilio Ramos', 'Se atiende de lunes a viernes de 8:00 AM a 4:00PM.\nSabado y Domingo cerrado.', 'www.visionalweb.com'),
(36, 'netocars', 81, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Itca', 83, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'EmpresaC', 84, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'empresa789', 88, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Puerco', 91, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Comida rapida', NULL, 'Costillas', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Coca Cola Company', 92, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Tiburon Azul', 93, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'JANDRES R.L', 94, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Pupuseria San Rafael', 96, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Departamento de la Paz', 1, 'resources/files/enterprise/IMG_20171027_193331.jpg', 'resources/files/enterprise/portada/853626470_894510edd0_b.jpg', NULL, NULL, NULL, NULL),
(49, 'Trebol Digital', 97, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'pupuseria olocuilta', 112, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'SportGym', 114, NULL, '2525-7858', '7895-7858', 'guillermo.jandres@gmail.com', 1, 'sportgym', NULL, NULL, 'Prueba de empresa', 'Gym', 'Experiencia prueba', 'OK', 1, 'resources/files/enterprise/56_a0917962024_10.jpg', 'resources/files/enterprise/portada/56_Fondos de pantalla.jpg', 'No', 'Carlos Perez', '7:00 a.m -5:30p.m', 'www.sportgym.com'),
(57, 'prueba virgilio', 134, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'venta de fuentes', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Virgilio Lopez', 150, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'https://graph.facebook.com/1587191718107558/picture?type=large', NULL, NULL, NULL, NULL, NULL),
(59, 'FUDESAL', 152, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Desarrollo Social y Económico', NULL, NULL, 1, NULL, NULL, 'No', 'Rolando Guzmán Revelo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_freelancer`
--

CREATE TABLE `experiencia_freelancer` (
  `id` bigint(20) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Titulo de la experiencia',
  `descripcion` text COLLATE utf8_unicode_ci COMMENT 'descripción del tipo de experiencia',
  `estado` int(11) DEFAULT NULL,
  `id_freelancer` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `experiencia_freelancer`
--

INSERT INTO `experiencia_freelancer` (`id`, `titulo`, `descripcion`, `estado`, `id_freelancer`) VALUES
(12, 'Docente', 'Centro Escolar Cuervo Arribaas.', 0, 1),
(11, 'Programador', 'MVAgency.', 0, 1),
(14, 'qsasas', 'asasasas1212121212', 0, 1),
(13, 'titulo1', 'las marcas mas sape', 0, 29),
(15, 'asasas', '11212121212asdasdasdasdasdasdsda', 0, 1),
(16, 'jandres', 'sape', 0, 29),
(17, 'prueba 2', 'prueba 2 descripcion', 0, 29),
(18, 'Consultor', 'ISO 9001\r\nKAIZEN', 0, 3),
(19, 'prueba', 'proyecto uno', 0, 22),
(20, 'Docente at ITCA-FEPADE', 'Prueba de descripcion. ', 0, 33),
(21, 'Ingeniero Mecánico', 'Experiencia en Maquinaría de Terracería, Aire Acondicionado', 0, 3),
(22, 'Supervisor de Maquinaria pesada', 'Desde 1996 hasta el 2001', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_servicios_freelancer_empresa`
--

CREATE TABLE `fotos_servicios_freelancer_empresa` (
  `id` bigint(100) NOT NULL,
  `foto_name` varchar(250) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '1 Activo, 0 Inactivo 2 No Autorizado\n',
  `servicios_freelancer_id` bigint(20) DEFAULT NULL,
  `servicios_empesa_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `freelancer`
--

CREATE TABLE `freelancer` (
  `id` bigint(20) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `ctl_usuario_id` int(11) NOT NULL,
  `ciudad_id` int(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `direccion` varchar(400) DEFAULT NULL,
  `perfil_facebook` varchar(300) DEFAULT NULL,
  `perfil_twiter` varchar(300) DEFAULT NULL,
  `perfil_instagram` varchar(300) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `acerca_de_ti` text,
  `ocupacion` varchar(250) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `foto_portada` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(150) DEFAULT NULL,
  `tags` varchar(550) DEFAULT NULL,
  `profesion` varchar(160) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `freelancer`
--

INSERT INTO `freelancer` (`id`, `nombres`, `apellidos`, `ctl_usuario_id`, `ciudad_id`, `email`, `telefono1`, `telefono2`, `direccion`, `perfil_facebook`, `perfil_twiter`, `perfil_instagram`, `url`, `estado`, `acerca_de_ti`, `ocupacion`, `foto_perfil`, `foto_portada`, `fecha_nacimiento`, `genero`, `tags`, `profesion`) VALUES
(1, 'Guillermo', 'Jandres', 15, 1, NULL, NULL, NULL, 'Barrio san Marcos, calle la ronda, chiltiupan, la libertad.', 'https://www.facebook.com/guillermo.jandres', 'https://twitter.com/guillejandres', 'https://www.instagram.com/ariastoresv/?hl=es-la', '', 1, 'Esta es el parrafo acerca de mi, alv prros!', 'Prueba', 'resources/files/freelancer/1_d1ee39d5015db8958801ecbfda5846fb.jpg', 'resources/files/freelancer/portada/1_Fondos de pantalla.jpg', '1995-06-11', 'M', 'PHP,JS,Angular,Vue,React,JAVA,CodeIgniter,Symfony4,Symfony3', ''),
(2, 'Giovanni', 'Tzec', 16, 1, NULL, NULL, NULL, NULL, 'https://www.facebook.com/giovannichavez2016', '  Ingresarfadsfdasfdasrerererererererererer', ' Ingresarfdsafdasfdsa', '', 1, 'fadsfdasfdasfdasfads', NULL, 'resources/files/freelancer/2_Dragon Ball _32).jpg', 'resources/files/freelancer/portada/2_Dragon Ball _7).jpg', NULL, NULL, NULL, ''),
(3, 'Rolando', 'Guzmán Revelo', 17, 1, 'rgrevelo@gmail.com', '22375000', '1234567898', 'Barrio El Calvario\r\n3a Ave. Nte, entre la 2a y 4a Calle Pte. #10', NULL, '@rolando1210', NULL, '', 1, 'Trabajo actualmente en la Seguridad y Salud Ocupacional de la Dirección General de Aduanas', 'Consultor', 'resources/files/freelancer/3_ROLANDO.JPG', 'resources/files/freelancer/portada/3_853626470_894510edd0_b.jpg', '1968-10-12', 'M', 'Trabajo en equipo,Disciplina', ''),
(4, 'Luz de María', 'Menéndez', 18, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, 'resources/files/freelancer/4_20200419_184505.jpg', NULL, NULL, NULL, NULL, ''),
(5, 'Crisia María', 'Rodriguez', 19, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(6, 'Dayana', 'Iraheta', 20, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(7, 'Jaime', 'Argueta', 21, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(8, 'Miguel Alejandro', 'Avendaño', 22, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(9, 'Eder', 'Escalante', 23, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(11, 'Eder', 'Escalante', 25, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, '2020-01-30', NULL, NULL, ''),
(12, 'Edgardo ', 'Figueroa', 26, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(13, 'Javier', 'Claros', 27, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(15, 'restaurante', 'cihuatan ', 29, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(16, 'Comedor', 'Conchita', 30, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(17, 'Laura', 'Valle ', 31, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(18, 'Andrea', 'Ramírez', 32, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(19, 'erick', 'valdez', 75, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(22, 'Virgilio', 'Ramos', 78, 1, 'virgilio.antonioramos@gmail.com', '23456-1234', '7656-6789', NULL, 'mi facebook', 'mi twitter', 'mi instagram', 'https://www.virgilioramos.com', 1, NULL, 'Web Developer', 'resources/files/freelancer/22_trelloperfil.jpg', 'resources/files/freelancer/portada/22_cusca.jpg', '1994-12-06', 'M', 'javascript,sapeee', ''),
(23, 'pedro', 'suarez', 80, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(24, 'Luis', 'Lopez', 82, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(25, 'Rosa Maritza', 'Meltrozo Smith', 85, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(28, 'Giovanni', 'Perez', 89, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(29, 'Jandres', 'Sapee', 90, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 'Hablanos de ti  y sobre lo que te dedicas.ss', 'Web developer', NULL, NULL, NULL, NULL, NULL, ''),
(30, 'Martha', 'Flores', 98, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, 'resources/files/freelancer/30_final.png', NULL, NULL, NULL, NULL, ''),
(33, 'Guillermo', 'Jandres', 113, 1, 'guillermo.jandres@gmail.com', '2338-8912', '7043-1575', 'Barrio San Marcos, Calle La Ronda, Chiltiupan, La Libertad.', NULL, NULL, NULL, '', 0, 'Esta es una prueba de acerca de ti....', 'Docente ITCA-FEPADE', 'resources/files/freelancer/33_24d802e86396ce2810fd8beb325a7ecd.jpg', 'resources/files/freelancer/portada/33_Fondos de pantalla.jpg', '1995-06-11', 'M', 'PHP,JS,Symfony3.2,JAVA,Hibernate,JSF,SPRINGMVC', ''),
(34, 'Sindy', 'Alvarenga', 115, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(35, 'Carlos', 'Borjas', 116, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(36, 'Sergio', 'Iraheta', 117, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, 'M', NULL, ''),
(37, 'Erika', 'Menendez', 118, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(38, 'Elmer', 'Paredes', 119, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(39, 'Yasira', 'Cerón', 120, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, 'F', NULL, ''),
(40, 'grisel', 'zamora', 121, 1, NULL, NULL, '7053-1384', NULL, NULL, NULL, NULL, '', 1, NULL, 'Emprendedora', 'resources/files/freelancer/40_shoes nautica white.webp', NULL, NULL, 'F', NULL, ''),
(41, 'Julio Balmore', 'Rivas', 122, 0, 'jbalmore.rivas@gmail.com', '+503 2305-5810', '+503 6037-7223', NULL, 'https://www.facebook.com/santateresadelicias', NULL, NULL, '', 1, NULL, NULL, 'resources/files/freelancer/41_Logo Delicias - 17102018.png', 'resources/files/freelancer/portada/41_Delicias2020.jpg', '1968-03-28', 'M', NULL, ''),
(42, 'Douglas Mauricio', 'Castro', 123, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, 'resources/files/freelancer/42_IMG_20160710_142704.jpg', 'resources/files/freelancer/portada/42_IMG-20171023-WA0003.jpg', NULL, NULL, NULL, ''),
(43, 'Julio Ernesto', 'Revelo', 124, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(44, 'Ismael ', 'Camacho ', 125, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, 'resources/files/freelancer/44_FB_IMG_1586925064409.jpg', NULL, NULL, 'M', NULL, ''),
(45, 'Diana ', 'Dominguez', 126, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, 'resources/files/freelancer/45_IMG_71wet9.jpg', NULL, '1989-03-21', 'F', NULL, ''),
(46, 'Krissia ', 'Merino ', 127, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(47, 'Samuel', 'Angulo', 128, 1, 'samuelangulo80@gmail.com', NULL, NULL, NULL, 'Samuel Angulo', '@Samuel_Angulo', '@angulosamuel', '', 1, NULL, NULL, 'resources/files/freelancer/47_FB_IMG_15783682377691439.jpg', NULL, NULL, 'M', NULL, ''),
(48, 'Alma', 'Hernández ', 129, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, 'F', NULL, ''),
(49, 'Fátima', 'Palacios', 130, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(50, 'Mike', 'Rodriguez', 131, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(51, 'douglas mauricio', 'castro flores', 132, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(52, 'Annete', 'Menjivar', 133, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(53, 'nuevo', 'apellido', 135, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, 'venta de titilcuite', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'JUAN', 'VILLATORO', 136, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, 'INGENIERO EN COMPUTACION', NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'Giovanni Chavez', NULL, 149, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, 'https://graph.facebook.com/3016346251778330/picture?type=large', NULL, NULL, NULL, NULL, NULL),
(68, 'Rolando Guzmán Revelo', NULL, 151, 1, 'rgrevelo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'www.socialpnp.com', 1, NULL, NULL, 'https://graph.facebook.com/10207273780718256/picture?type=large', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `tipo_grupo` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades`
--

CREATE TABLE `habilidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(125) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` bigint(20) NOT NULL,
  `mensaje` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ctl_usuario_id` int(11) DEFAULT NULL,
  `relaciones_amigos_id` int(11) DEFAULT NULL,
  `detalle_grupo_id` int(11) DEFAULT NULL,
  `date_mensaje` datetime NOT NULL,
  `estado` int(11) DEFAULT '1' COMMENT '1=no leido, 0= leido'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `mensaje`, `ctl_usuario_id`, `relaciones_amigos_id`, `detalle_grupo_id`, `date_mensaje`, `estado`) VALUES
(3, 'que hondas pues', 15, 5, NULL, '2020-02-28 06:14:47', NULL),
(4, 'Hola Guillermo', 17, 7, NULL, '2020-03-01 08:45:25', NULL),
(5, 'Hola Guillermo', 17, 7, NULL, '2020-03-01 08:46:05', NULL),
(6, 'Hola', 15, 7, NULL, '2020-03-01 08:57:33', NULL),
(7, 'Hola buenas noches', 78, 9, NULL, '2020-03-02 08:13:41', NULL),
(8, 'todo tranquilo zorra aqui haciendo pruebas', 78, 5, NULL, '2020-03-03 06:58:27', NULL),
(9, 'Hola', 17, 7, NULL, '2020-03-03 08:37:46', NULL),
(10, '', 17, 7, NULL, '2020-03-03 08:37:55', NULL),
(11, 'Jandres Escobar', 16, 12, NULL, '2020-03-03 08:58:06', NULL),
(12, 'Hola', 15, 12, NULL, '2020-03-03 08:59:17', NULL),
(13, 'prueba de envío desde la vista de mensajes', 78, 5, NULL, '2020-03-03 09:22:07', NULL),
(14, 'Hola papu', 78, 1, NULL, '2020-03-04 01:05:14', NULL),
(15, 'Que tal mister', 79, 1, NULL, '2020-03-04 03:11:42', NULL),
(16, 'este es un mensaje para la empresa', 78, 1, NULL, '2020-03-04 03:15:48', NULL),
(17, 'confirmamos que hemos recibido su mensaje', 79, 1, NULL, '2020-03-04 03:18:36', NULL),
(18, 'hola', 17, 7, NULL, '2020-03-05 03:28:05', NULL),
(19, 'veo que funciona, jajaj', 17, 7, NULL, '2020-03-05 03:28:38', NULL),
(20, 'hola', 17, 14, NULL, '2020-03-06 07:59:05', NULL),
(21, 'que ondas', 17, 14, NULL, '2020-03-06 08:00:00', NULL),
(22, 'test', 117, 14, NULL, '2020-03-06 08:01:57', NULL),
(23, '', 117, 14, NULL, '2020-03-06 08:01:57', NULL),
(24, '', 117, 14, NULL, '2020-03-06 08:01:59', NULL),
(25, 'que te parece?', 17, 14, NULL, '2020-03-06 08:02:35', NULL),
(26, 'enviaste dos mensajes en blanco', 17, 14, NULL, '2020-03-06 08:02:57', NULL),
(27, 'Hola Guillermo,  realizando pruebas', 17, 7, NULL, '2020-03-06 08:44:11', 1),
(28, 'Me gusta el color naranja del fondo de los mensajes', 17, 7, NULL, '2020-03-06 08:45:08', NULL),
(29, '', 17, 7, NULL, '2020-03-06 08:45:11', NULL),
(30, 'Ya vi que puedes mandar mensajes en blanco jajja', 17, 7, NULL, '2020-03-06 08:45:52', NULL),
(31, 'Hola ', 17, 7, NULL, '2020-03-07 05:35:49', NULL),
(32, 'Hola', 17, 20, NULL, '2020-03-07 07:19:26', NULL),
(33, 'Que tal la Expo ', 17, 20, NULL, '2020-03-07 07:25:38', NULL),
(34, 'Cómo estamos', 17, 7, NULL, '2020-03-09 06:34:18', NULL),
(35, 'Listo para el jueves', 17, 7, NULL, '2020-03-14 10:38:53', NULL),
(36, 'Hola', 17, 7, NULL, '2020-03-24 02:40:05', NULL),
(37, 'Hola Virgilio, que tal la cuarentena?', 17, 9, NULL, '2020-03-31 02:29:05', NULL),
(38, 'Hola Virgilio, estoy pendiente de lo conversado hace dos días', 17, 9, NULL, '2020-04-11 04:45:07', NULL),
(39, 'Hola Yasira', 17, 22, NULL, '2020-04-11 04:45:33', NULL),
(40, 'falta algunos detalles, pero en eso estamos', 17, 22, NULL, '2020-04-11 04:50:00', NULL),
(41, 'Hola Rolando', 120, 22, NULL, '2020-04-11 04:53:24', NULL),
(42, 'Cómo esto es algo nuevo me está costando ', 120, 22, NULL, '2020-04-11 04:53:59', NULL),
(43, 'Y que tan seguro es este medio para la correspondencia ', 120, 22, NULL, '2020-04-11 04:54:35', NULL),
(44, 'la idea de este chat, es para apoyar a las y los microempresarios a que los controlen y puedan hacer negocios por medio de esta plataforma', 17, 22, NULL, '2020-04-11 04:55:03', NULL),
(45, 'si tu ves en la parte del sitio dice https. la s significa que es un sitio seguro. esto se consigue, cancelando un poco más de dinero para que tanto la información que tu me envías como la que yo te estoy enviando en este momento, vaya encriptada, ess decir codificada', 17, 22, NULL, '2020-04-11 04:57:00', NULL),
(46, 'si un hacker la lograra capturar, no sabría que es porque va en clave que solo un programa propio de este sitio lo tiene', 17, 22, NULL, '2020-04-11 04:58:24', NULL),
(47, 'solo vería simbolos raros que parecería como si fuera un virus que ha descargado', 17, 22, NULL, '2020-04-11 04:58:59', NULL),
(48, 'Hola', 17, 23, NULL, '2020-04-11 07:39:35', NULL),
(49, 'Por ejemplo acá te podrían solicitar tus productos', 17, 23, NULL, '2020-04-11 07:40:13', NULL),
(50, 'hi Rolando  hoy si me permite chatear', 121, 23, NULL, '2020-04-11 07:48:58', NULL),
(51, 'si tu estas interesado en mi producto de esta manera interactuo con el cliente  ', 121, 23, NULL, '2020-04-11 07:50:12', NULL),
(52, 'Y como me encuentran los clientes ademas de mis compañeros  de Acacehmia', 121, 23, NULL, '2020-04-11 07:51:17', NULL),
(53, 'Tengo una observacion, quise publicar los 5 estilos de zapatos y no me permite, seria bueno poder hacerlo ', 121, 23, NULL, '2020-04-11 07:52:39', NULL),
(54, 'Esta in teresante esta herramienta primero Dios nos funcione', 121, 23, NULL, '2020-04-11 07:55:11', NULL),
(55, 'Gracias x permitirnos tener esta oportunidad. Bendiciones ', 121, 23, NULL, '2020-04-11 07:56:16', NULL),
(56, 'Hola', 17, 7, NULL, '2020-04-14 10:00:00', NULL),
(57, 'Hola', 17, 7, NULL, '2020-04-14 10:00:01', NULL),
(58, 'Hola Balmore', 17, 54, NULL, '2020-04-14 10:08:18', NULL),
(59, 'Estás en el trabajo o en casa? ', 17, 54, NULL, '2020-04-14 10:08:47', NULL),
(60, 'Estamos en pruebas, les compartiré esta información a los desarrolladores', 17, 23, NULL, '2020-04-14 02:16:14', NULL),
(61, 'Gracias por compartir sus inquietudes', 17, 23, NULL, '2020-04-14 02:22:38', NULL),
(62, '', 17, 23, NULL, '2020-04-14 02:22:40', NULL),
(63, 'Hola', 17, 23, NULL, '2020-04-16 09:22:03', NULL),
(64, 'Hola ', 17, 61, NULL, '2020-04-16 09:31:31', NULL),
(65, 'Hola ', 17, 61, NULL, '2020-04-16 09:31:32', NULL),
(66, 'Qué tal?', 17, 61, NULL, '2020-04-16 09:31:56', NULL),
(67, 'Hola ', 126, 61, NULL, '2020-04-16 09:32:34', NULL),
(68, 'Hola Fátima ', 17, 70, NULL, '2020-04-16 02:16:07', NULL),
(69, 'Me podrías ayudar haciendo pruebas', 17, 70, NULL, '2020-04-16 02:16:41', NULL),
(70, 'Me podrías ayudar haciendo pruebas', 17, 70, NULL, '2020-04-16 02:16:41', NULL),
(71, 'Gracias ', 17, 70, NULL, '2020-04-16 02:16:51', NULL),
(72, 'Favor realizar las funcionalidades y me dices que es lo que funciona y que no funciona. Tus sugerencias son bienvenidas', 17, 61, NULL, '2020-04-16 08:02:11', NULL),
(73, 'De preferencia trabaja en la PC ', 17, 61, NULL, '2020-04-16 08:02:57', NULL),
(74, 'Realiza capturas de pantallas y me los envías al correo electrónico rgrevelo@gmail.com ', 17, 61, NULL, '2020-04-16 08:03:41', NULL),
(75, 'Realiza capturas de pantallas y me los envías al correo electrónico rgrevelo@gmail.com2020-', 17, 70, NULL, '2020-04-16 08:05:30', NULL),
(76, 'rgrevelo@gmail.com ', 17, 70, NULL, '2020-04-16 08:06:09', NULL),
(77, 'Hola Almita. Favor probar las funciones del sistema desde tu PC y me haces capturas de pantallas y me los envías al correo electrónico rgrevelo@gmail.com ', 17, 64, NULL, '2020-04-17 08:50:08', NULL),
(78, 'Hola', 17, 7, NULL, '2020-04-17 12:54:06', NULL),
(79, 'Avísame cuando estés en el chat', 17, 54, NULL, '2020-04-17 07:09:16', NULL),
(80, 'Hola', 17, 71, NULL, '2020-04-19 06:30:56', NULL),
(81, 'Este es el chat', 17, 71, NULL, '2020-04-19 06:32:53', NULL),
(82, 'Hola ing', 18, 71, NULL, '2020-04-19 06:33:16', NULL),
(83, 'Seguiremos mañana. Cuídate', 17, 71, NULL, '2020-04-19 06:35:06', NULL),
(84, 'Agrega foto a tu perfil', 17, 71, NULL, '2020-04-19 06:35:41', NULL),
(85, 'Agrega foto a tu perfil', 17, 71, NULL, '2020-04-19 06:35:42', NULL),
(86, 'Agrega foto a tu perfil', 17, 71, NULL, '2020-04-19 06:35:43', NULL),
(87, 'Seguiremos mañana', 17, 71, NULL, '2020-04-19 06:35:58', NULL),
(88, 'Esta bien, seguimos mañana ', 18, 71, NULL, '2020-04-19 06:38:42', NULL),
(89, 'hola Lucita, podrías realizar pruebas, ver que campos funcionan y cuáles no y me haces capturas de pantalla ', 17, 71, NULL, '2020-04-22 11:16:02', NULL),
(90, 'me las envías al correo rgrevelo@gmail.com', 17, 71, NULL, '2020-04-22 11:16:33', NULL),
(91, 'Hola', 17, 73, NULL, '2020-04-24 01:59:48', NULL),
(92, 'Hola', 17, 73, NULL, '2020-04-27 11:18:41', NULL),
(93, 'Hola Annete, me dicen que ya no estás viniendo a la Aduana, que paso?', 17, 73, NULL, '2020-04-30 03:04:44', NULL),
(94, 'Hola ', 17, 73, NULL, '2020-05-05 11:15:16', NULL),
(95, 'Hola buenas tardes ya se estan trabajando en los cambios', 78, 9, NULL, '2020-05-06 05:16:28', NULL),
(96, 'Buenas tardes', 78, 41, NULL, '2020-05-06 05:20:06', NULL),
(97, 'en perfil se encuentra una nueva funcion para profesion u oficio', 78, 41, NULL, '2020-05-06 05:21:22', NULL),
(98, 'probando enviar mensajes desde la lista de socios', 78, 5, NULL, '2020-05-07 04:49:33', NULL),
(99, 'que hay', 78, 1, NULL, '2020-05-07 06:19:19', NULL),
(100, 'todo al suave men', 79, 1, NULL, '2020-05-07 06:20:28', NULL),
(101, 'me llega solo estoy haciendo pruebas', 79, 1, NULL, '2020-05-07 06:21:41', NULL),
(102, 'va ta bueno hay tamos entonces', 78, 1, NULL, '2020-05-07 06:22:15', NULL),
(103, 'realizando una prueba', 78, 1, NULL, '2020-05-13 03:11:18', NULL),
(104, 'Que onda Don Rolando', 15, 7, NULL, '2020-05-14 10:02:06', 1),
(105, 'Que onda Don Rolando', 15, 7, NULL, '2020-05-14 10:02:07', 1),
(106, 'Que hay como estas?', 15, 7, NULL, '2020-05-14 10:02:19', 1),
(107, 'Que onda', 15, 12, NULL, '2020-05-14 10:05:31', 1),
(108, 'Vegueta, sos ing va', 15, 12, NULL, '2020-05-14 10:05:46', 1),
(109, 'Buenos días Grizel, ya no has seguido probando el sitio, saludos', 17, 23, NULL, '2020-05-19 09:56:26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre_pais` varchar(100) DEFAULT NULL,
  `codigo_area_pais` varchar(10) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `paises_por_region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre_pais`, `codigo_area_pais`, `estado`, `paises_por_region_id`) VALUES
(1, 'El Salvador', '+503', 1, 1),
(2, 'Honduras', '+504', 1, 1),
(3, 'Guatemala', '+502', 1, 1),
(4, 'Costa Rica', '+506', 1, 1),
(8, 'Nicaragua', '+505', 1, 1),
(9, 'Panamá', '+507', 1, 1),
(10, 'Colombia', '+57', 1, 3),
(11, 'Perú', '+51', 1, 3),
(12, 'Bolivia', '+591', 1, 3),
(13, 'Venezuela', '+58', 1, 3),
(14, 'Uruguay', '+598', 1, 3),
(15, 'Brasil', '+55', 1, 3),
(16, 'Argentina', '+54', 1, 3),
(17, 'Paraguay', '+595', 1, 3),
(18, 'Chile', '+56', 1, 3),
(19, 'Ecuador', '+593', 1, 3),
(20, 'República dominicana', '+1', 1, 7),
(21, 'Haiti', '+509', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises_por_region`
--

CREATE TABLE `paises_por_region` (
  `id` int(11) NOT NULL,
  `nombre_paises_por_region` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises_por_region`
--

INSERT INTO `paises_por_region` (`id`, `nombre_paises_por_region`, `estado`) VALUES
(1, 'Centro América', 1),
(2, 'Norte América', 1),
(3, 'Sur América', 1),
(6, 'Zona central de las Antillas', 1),
(7, 'Caribe', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portafolio_empresa`
--

CREATE TABLE `portafolio_empresa` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_empresa` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `portafolio_empresa`
--

INSERT INTO `portafolio_empresa` (`id`, `nombre`, `tipo`, `id_empresa`) VALUES
(16, 'resources/files/enterprise/portafolio/organic_bule.529.jpg', 'imagen', 35),
(17, 'resources/files/enterprise/portafolio/DragonBall-Super-Broly-6.jpg', 'imagen', 35),
(18, 'resources/files/enterprise/portafolio/wallpaper.jpg', 'imagen', 35),
(21, 'resources/files/enterprise/portafolio/atico3.jpg', 'imagen', 35),
(22, 'resources/files/enterprise/portafolio/logo-atico.jpg', 'imagen', 35),
(23, 'resources/files/enterprise/portafolio/office.jpg', 'imagen', 35),
(24, 'resources/files/enterprise/portafolio/56_background-cool-wallpapers-dark-linux.jpg', 'imagen', 56),
(25, 'resources/files/enterprise/portafolio/56_a0917962024_10.jpg', 'imagen', 56),
(26, 'resources/files/enterprise/portafolio/56_bd.jpeg', 'imagen', 56),
(27, 'resources/files/enterprise/portafolio/56_D5E.jpg', 'imagen', 56),
(28, 'resources/files/enterprise/portafolio/56_developer-javascript-codes-coding-web-development-technology-6492.jpg', 'imagen', 56),
(31, 'resources/files/enterprise/video/35_video-prueba.mp4', 'video', 35),
(32, 'resources/files/enterprise/portafolio/35_Guia-Practica-SIS01V-Grupo_C.pdf', 'PDF', 35),
(33, 'resources/files/enterprise/portafolio/35_cemita pacha.docx', 'word', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portafolio_freelancer`
--

CREATE TABLE `portafolio_freelancer` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'imagen',
  `id_freelancer` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `portafolio_freelancer`
--

INSERT INTO `portafolio_freelancer` (`id`, `nombre`, `tipo`, `id_freelancer`) VALUES
(11, 'resources/files/freelancer/portafolio/atico1.jpg', 'imagen', 22),
(12, 'resources/files/freelancer/portafolio/atico2.jpg', 'imagen', 22),
(13, 'resources/files/freelancer/portafolio/logo-atico.jpg', 'imagen', 22),
(14, 'resources/files/freelancer/portafolio/visa-mastercard-logo.png', 'imagen', 22),
(15, 'resources/files/freelancer/portafolio/goku_vs_jiren_doctrina_egoista_by_lucario_strike-dbq39rg.png', 'imagen', 1),
(16, 'resources/files/freelancer/portafolio/24d802e86396ce2810fd8beb325a7ecd.jpg', 'imagen', 1),
(17, 'resources/files/freelancer/portafolio/D5E.jpg', 'imagen', 1),
(18, 'resources/files/freelancer/portafolio/office.jpg', 'imagen', 22),
(19, 'resources/files/freelancer/portafolio/bd.jpeg', 'imagen', 1),
(20, 'resources/files/freelancer/portafolio/wallpaper_php_programming_by_artgh-d6sf4bg.jpg', 'imagen', 1),
(21, 'resources/files/freelancer/portafolio/30_blob', 'imagen', 30),
(22, 'resources/files/freelancer/portafolio/30_leon.jpg', 'imagen', 30),
(23, 'resources/files/freelancer/portafolio/30_developer-javascript-codes-coding-web-development-technology-6492.jpg', 'imagen', 30),
(24, 'resources/files/freelancer/portafolio/30_Fondos de pantalla.jpg', 'imagen', 30),
(25, 'resources/files/freelancer/portafolio/33_background-cool-wallpapers-dark-linux.jpg', 'imagen', 33),
(26, 'resources/files/freelancer/portafolio/33_a0917962024_10.jpg', 'imagen', 33),
(27, 'resources/files/freelancer/portafolio/33_D5E.jpg', 'imagen', 33),
(28, 'resources/files/freelancer/portafolio/33_bd.jpeg', 'imagen', 33),
(29, 'resources/files/freelancer/portafolio/33_developer-javascript-codes-coding-web-development-technology-6492.jpg', 'imagen', 33),
(30, 'resources/files/freelancer/portafolio/41_DeliciasST.png', 'imagen', 41),
(31, 'resources/files/freelancer/portafolio/3_2019-lamborghini-urus.jpg', 'imagen', 3),
(32, 'resources/files/freelancer/portafolio/3_2019-Jeep-Cherokee-Limited-Editions-Altitude.jpg.image.1440.jpg', 'imagen', 3),
(33, 'resources/files/freelancer/portafolio/41_A.png', 'imagen', 41),
(34, 'resources/files/freelancer/portafolio/41_blob', 'imagen', 41),
(35, 'resources/files/freelancer/portafolio/41_B.png', 'imagen', 41),
(36, 'resources/files/freelancer/portafolio/41_C.png', 'imagen', 41),
(37, 'resources/files/freelancer/portafolio/41_ENCARGA TUS ALMUERZOS 20022019.png', 'imagen', 41),
(38, 'resources/files/freelancer/portafolio/41_Hamburguesa 09122018.png', 'imagen', 41),
(39, 'resources/files/freelancer/portafolio/41_Publicidad BANANA SPLIT - 31012019.png', 'imagen', 41),
(40, 'resources/files/freelancer/portafolio/41_D.png', 'imagen', 41),
(41, 'resources/files/freelancer/portafolio/3_blob', 'imagen', 3),
(42, 'resources/files/freelancer/portafolio/3_2019-audi-q8-pricing.jpg', 'imagen', 3),
(43, 'resources/files/freelancer/portafolio/3_JEEP GRAND CHEROKEE TRACKHAWK 4dr x4x.jpg', 'imagen', 3),
(44, 'resources/files/freelancer/portafolio/3_MERCEDES BENZ GLA 2019.jpg', 'imagen', 3),
(45, 'resources/files/freelancer/portafolio/68_2019-lamborghini-urus.jpg', 'imagen', 68),
(46, 'resources/files/freelancer/portafolio/68_2020-bmw-x6.jpg', 'imagen', 68),
(47, 'resources/files/freelancer/portafolio/68_2019-Jeep-Cherokee-Limited-Editions-Altitude.jpg.image.1440.jpg', 'imagen', 68),
(48, 'resources/files/freelancer/portafolio/68_2019-audi-q8-pricing.jpg', 'imagen', 68),
(49, 'resources/files/freelancer/portafolio/22_cemita pacha.docx', 'word', 22),
(53, 'resources/files/freelancer/portafolio/22_Guia-Practica-SIS01V-Grupo_C.pdf', 'PDF', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_freelancer_empresa`
--

CREATE TABLE `post_freelancer_empresa` (
  `id` bigint(20) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Titulo del post',
  `descripcion` text COLLATE utf8_unicode_ci COMMENT 'descripción del post',
  `opcion_tiempo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tiempo a invertir en el trabajo',
  `precio` double DEFAULT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `hora_post` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_tags` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_archivo` bigint(20) DEFAULT NULL,
  `id_usuario` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `post_freelancer_empresa`
--

INSERT INTO `post_freelancer_empresa` (`id`, `titulo`, `descripcion`, `opcion_tiempo`, `precio`, `latitud`, `longitud`, `hora_post`, `post_tags`, `estado`, `id_archivo`, `id_usuario`) VALUES
(1, 'Prueba titulo', 'Haciendo una pueba de insersion de post', 'Lunes a Viernes de 8:30AM-4:30PM', 20, NULL, NULL, '2020-02-19 22:40:39', 'hola,mundo', 1, NULL, 78),
(6, 'Venta de cositas', 'test test test test test tes', 'pruebitas', 10, NULL, NULL, '2020-02-22 21:48:25', 'nueva,dos,test', 1, NULL, 78),
(17, 'preuba 1', 'prueba de insert para post', 'holis aqui le atendemos', 10, NULL, NULL, '2020-02-22 20:59:15', 'papaya,mosca,pecho', 0, NULL, 79),
(18, 'Venta de almuerzos', 'ya me aburri de escribir para pruebas', 'lunes a viernes sin almuerzo', 4, NULL, NULL, '2020-02-22 21:39:29', 'melon,tacua,goku', 1, NULL, 79),
(38, 'Desalloro de Paginas Web', 'aqui ira la descripcion de la publicacion', 'De lunes a viernes sin cerrar al medio dia', 5, NULL, NULL, '2020-02-22 21:17:23', 'PHP,CSS3', 1, 6, 79),
(39, 'Prueba', 'Esta es una prueba de post.', '7:00 am a 11:50 pm', 15, NULL, NULL, '2020-02-22 13:28:42', 'PHP,JS,MongoDB', 0, 7, 113),
(40, 'Creacion de pagina web.', 'Esta es una prueba de descripción.', 'A iniciar lo más pronto posible.', 1500, NULL, NULL, '2020-02-22 13:31:45', 'PHP,JS,JAVA', 1, 8, 113),
(41, 'Programador', 'fdfdsafdsa', 'dsads', 25, NULL, NULL, '2020-03-03 14:56:47', 'fdsfds', 1, 9, 16),
(42, 'Consultoría en Seguridad y Salud Ocupacional El Salvador', 'Acompañamiento para la implementación del Sistema de Gestión de la Seguridad y Salud Ocupacional en su empresa', '4:00 PM en adelante', 0, NULL, NULL, '2020-04-20 19:49:26', 'Implementación de un Sistema de Gestión en SSO', 0, NULL, 17),
(43, 'Implementación de la ISO 9001', 'Asesoría e implementación de la norma ISO 9001 en su negocio', 'de 4:00 pm en adelante', 0, NULL, NULL, '2020-03-25 10:39:58', 'Trabajo en equipo', 1, NULL, 17),
(44, 'Clases de baile', '', '', 25, NULL, NULL, '2020-04-12 01:55:31', '', 0, 10, 120),
(45, 'Zapatillas para mujer Nautica orginales.', 'Zapatillas para mujer  Nautica, tallas 6 al 10. Variedad de estilos. Contactanos por wsap 7053-1384. ', '9:am a 6:pm', 65, NULL, NULL, '2020-04-11 12:22:39', 'Confortables ,Sport,Diseños Fashion,Originales', 1, 11, 121),
(46, 'CERRADO POR PREVENCION COVID-19', 'Gracias por  la comprensión', 'Cerrado', 0, NULL, NULL, '2020-04-12 15:12:06', 'Respetando las disposiciones guvernamentales', 1, 12, 122),
(47, 'ejemplo 1', 'especialidades en almuerzos', 'de 8 a 5', 200, NULL, NULL, '2020-04-15 06:16:32', 'trabajo en equipo', 1, 13, 124),
(48, 'sdsd', 'sdsds', 'sdsds', 0, NULL, NULL, '2020-05-02 03:34:19', 'hzjhcjzhxjc', 0, NULL, 17),
(49, 'Prueba', '', '', 0, NULL, NULL, '2020-05-14 15:04:53', 'PHP,JS,CSS', 1, NULL, 15),
(50, 'Capacitaciones a los emprendedores de la Libertad, El Salvador', 'Se desarrollará un taller para emprendedores/as del departamento de La Libertad del 18 al 22 de mayo de 2020, en nuestro centro de capacitaciones, en el tercer nivel, del edificio 4.\r\nContactarse con el Encargado de dicho evento\r\nCódigo del evento: FE-010 \r\n\r\nNota: La inversión de US$500.00 será aportada por la Fundación', 'de 8:00 am a 4:00 pm', 500, NULL, NULL, '2020-05-17 00:10:30', 'No aplica', 1, 14, 152),
(51, 'XD', 'XD', '7:00 -12:00 p.m', 25, NULL, NULL, '2020-05-23 09:12:42', 'Solo uno', 1, 15, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones_por_pais`
--

CREATE TABLE `regiones_por_pais` (
  `id` int(11) NOT NULL,
  `nombre_region_por_pais` varchar(100) DEFAULT NULL,
  `pais_id` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `regiones_por_pais`
--

INSERT INTO `regiones_por_pais` (`id`, `nombre_region_por_pais`, `pais_id`, `estado`) VALUES
(1, 'EL SALVADOR CENTRAL', 1, 1),
(2, 'GUATEMALA CENTRAL', 3, 1),
(3, 'EL SALVADOR ORIENTAL', 1, 1),
(4, 'EL SALVADOR OCCIDENTAL', 1, 1),
(5, 'EL SALVADOR PARA-CENTRAL', 1, 1),
(6, 'COSTA RICA CR-SJ', 4, 1),
(7, 'COSTA RICA CR-A', 4, 1),
(8, 'COSTA RICA CR-C', 4, 1),
(9, 'COSTA RICA CR-H', 4, 1),
(10, 'COSTA RICA CR-G', 4, 1),
(11, 'COSTA RICA CR-P', 4, 1),
(12, 'COSTA RICA CR-L', 4, 1),
(13, 'HONDURAS CENTRAL', 2, NULL),
(14, 'NICARAGUA CENTRAL', 8, NULL),
(15, 'PANAMÁ CENTRAL', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relaciones_amigos`
--

CREATE TABLE `relaciones_amigos` (
  `id` int(11) NOT NULL,
  `ctl_usuario_id` int(11) NOT NULL,
  `ctl_usuario_amigo` int(11) NOT NULL,
  `date_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'fecha en la que se envió la solicitud',
  `estado` int(11) DEFAULT '1' COMMENT '0=aceptado,1=enviado, 2=eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `relaciones_amigos`
--

INSERT INTO `relaciones_amigos` (`id`, `ctl_usuario_id`, `ctl_usuario_amigo`, `date_solicitud`, `estado`) VALUES
(1, 79, 78, '2020-03-03 14:06:55', 0),
(5, 15, 78, '2020-02-28 21:40:19', 0),
(7, 15, 17, '2020-03-02 02:43:14', 0),
(8, 16, 17, '2020-05-16 22:19:55', 0),
(9, 78, 17, '2020-03-03 01:40:25', 0),
(10, 44, 17, '2020-03-02 12:27:26', 1),
(11, 44, 17, '2020-03-02 12:27:26', 1),
(12, 15, 16, '2020-03-03 14:57:37', 0),
(13, 16, 78, '2020-05-16 22:19:58', 0),
(14, 17, 117, '2020-03-06 13:58:04', 0),
(15, 19, 17, '2020-03-06 07:14:40', 1),
(16, 20, 17, '2020-03-06 07:14:51', 1),
(17, 21, 17, '2020-03-06 07:14:55', 1),
(18, 22, 17, '2020-03-06 07:15:00', 1),
(19, 115, 17, '2020-03-06 07:15:37', 1),
(20, 17, 118, '2020-03-08 01:18:23', 0),
(21, 93, 17, '2020-03-07 15:36:07', 1),
(22, 120, 17, '2020-04-11 22:44:34', 0),
(23, 17, 121, '2020-04-12 01:37:06', 0),
(24, 121, 17, '2020-04-11 12:26:53', 1),
(25, 15, 121, '2020-05-14 16:02:58', 0),
(26, 16, 121, '2020-05-16 22:20:01', 0),
(27, 18, 121, '2020-04-11 12:53:07', 1),
(28, 19, 121, '2020-04-11 12:53:08', 1),
(29, 20, 121, '2020-04-11 12:53:12', 1),
(30, 21, 121, '2020-04-11 12:53:15', 1),
(31, 22, 121, '2020-04-11 12:53:16', 1),
(32, 23, 121, '2020-04-11 12:53:18', 1),
(33, 25, 121, '2020-04-11 12:53:20', 1),
(34, 26, 121, '2020-04-11 12:53:21', 1),
(35, 27, 121, '2020-04-11 12:53:22', 1),
(36, 29, 121, '2020-04-11 12:53:24', 1),
(37, 30, 121, '2020-04-11 12:53:25', 1),
(38, 31, 121, '2020-04-11 12:53:28', 1),
(39, 32, 121, '2020-04-11 12:53:30', 1),
(40, 75, 121, '2020-04-11 12:53:31', 1),
(41, 78, 121, '2020-05-06 23:17:49', 0),
(42, 80, 121, '2020-04-11 12:53:35', 1),
(43, 82, 121, '2020-04-11 12:53:36', 1),
(44, 85, 121, '2020-04-11 12:53:38', 1),
(45, 89, 121, '2020-04-11 12:53:41', 1),
(46, 90, 121, '2020-04-11 12:53:42', 1),
(47, 98, 121, '2020-04-11 12:53:44', 1),
(48, 115, 121, '2020-04-11 12:53:46', 1),
(49, 116, 121, '2020-04-11 12:53:47', 1),
(50, 117, 121, '2020-04-11 12:53:49', 1),
(51, 118, 121, '2020-04-11 12:53:51', 1),
(52, 119, 121, '2020-04-11 12:53:53', 1),
(53, 120, 121, '2020-04-11 12:53:54', 1),
(54, 17, 122, '2020-04-14 16:06:26', 0),
(55, 21, 122, '2020-04-12 14:28:18', 1),
(56, 120, 122, '2020-04-12 14:28:46', 1),
(57, 123, 17, '2020-04-14 06:40:50', 1),
(58, 17, 124, '2020-04-16 15:35:14', 0),
(59, 123, 124, '2020-04-15 06:17:38', 1),
(60, 125, 17, '2020-04-15 14:21:36', 1),
(61, 126, 17, '2020-04-16 15:30:40', 0),
(62, 127, 17, '2020-04-16 14:34:18', 1),
(63, 17, 128, '2020-04-16 15:37:12', 0),
(64, 17, 129, '2020-04-16 15:37:14', 0),
(65, 18, 129, '2020-04-16 14:36:10', 1),
(66, 19, 129, '2020-04-16 14:36:16', 1),
(67, 20, 129, '2020-04-16 14:36:19', 1),
(68, 20, 128, '2020-04-16 14:36:22', 1),
(69, 128, 129, '2020-04-16 14:37:02', 1),
(70, 130, 17, '2020-04-16 15:40:01', 0),
(71, 18, 17, '2020-04-20 00:29:40', 0),
(72, 131, 17, '2020-04-19 10:44:29', 1),
(73, 17, 133, '2020-04-24 19:59:19', 0),
(74, 132, 17, '2020-04-28 07:55:26', 1),
(75, 25, 17, '2020-04-28 07:56:10', 1),
(76, 126, 78, '2020-05-06 10:17:39', 1),
(77, 18, 15, '2020-05-14 15:07:19', 1),
(78, 19, 15, '2020-05-14 15:07:22', 1),
(79, 44, 78, '2020-05-29 11:36:09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_empresa`
--

CREATE TABLE `servicios_empresa` (
  `id` bigint(20) NOT NULL,
  `nombre_servicio` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `estado` int(11) DEFAULT NULL,
  `detalle_area_servicios_empresa_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_freelancer`
--

CREATE TABLE `servicios_freelancer` (
  `id` bigint(20) NOT NULL,
  `nombre_servicio` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `estado` int(11) DEFAULT NULL COMMENT '1 Activo, 2 Inactivo,  0 No autorizado',
  `detalle_area_servicios_freelance_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_servicio_empresa`
--

CREATE TABLE `solicitud_servicio_empresa` (
  `id` bigint(100) NOT NULL,
  `fecha_solicitud_servicio` datetime DEFAULT NULL,
  `comentarios` text,
  `calificacion` int(5) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `servicios_empesa_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_servicio_freelancer`
--

CREATE TABLE `solicitud_servicio_freelancer` (
  `id` bigint(100) NOT NULL,
  `fecha_solicitud_servicio` datetime DEFAULT NULL,
  `comentarios` text,
  `calificacion` int(5) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `servicios_freelancer_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria_empresa`
--

CREATE TABLE `subcategoria_empresa` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `id_empresa_categoria` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategoria_empresa`
--

INSERT INTO `subcategoria_empresa` (`id`, `nombre`, `estado`, `id_empresa_categoria`) VALUES
(8, 'Analisis de datos', 1, 39),
(9, 'Marketing digital', 1, 40),
(10, 'Puercos', 1, 41),
(11, 'Base de Datos', 1, 39),
(12, 'HTML5', 1, 39),
(13, 'Café', 1, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_categoria`
--

CREATE TABLE `tipo_categoria` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_categoria` bigint(20) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_categoria`
--

INSERT INTO `tipo_categoria` (`id`, `nombre`, `id_categoria`, `estado`) VALUES
(1, 'Puerta', 1, 1),
(2, 'Ventana', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos`
--

CREATE TABLE `titulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_titulacion` datetime DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `freelancer_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `titulos`
--

INSERT INTO `titulos` (`id`, `nombre`, `fecha_titulacion`, `descripcion`, `estado`, `freelancer_id`) VALUES
(1, 'Bachillerato.', '2013-12-28 00:00:00', 'Bachillerato Opción Contaduría.', 1, 1),
(2, 'Guillermo AdalbertoJosue', '2013-12-11 00:00:00', 'Jandres............................asdasdasd', 1, 1),
(3, 'Bachilleratoasasasas123123123213hjkhlhjkhjkhj', '2013-12-12 00:00:00', 'Bachillerato técnico opción Contaduría.', 1, 1),
(4, 'Bachillerato123p12i3p1i23oi123oi123poi1231231', '1995-06-11 00:00:00', 'Bachillerato técnico opción Contaduría. o12u3oi123uo12i3uoi123uoi12u3123', 1, 1),
(5, 'Bachilleratoasasasas12123123123132', '2013-12-12 00:00:00', 'Bachillerato técnico opción Conasdasdasdasdasdasdtaduría. asdsadasdasdasdasdasdasdasd', 1, 1),
(6, 'Tecnico En sistemas', '2019-12-13 00:00:00', 'por ahi', 1, 29),
(7, 'asdadsdsk', '1995-06-11 00:00:00', 'awpdkasdkljasdjadljsd09u9eque0q9euw9uqewwqe', 1, 1),
(8, 'Hola mundo', '2019-12-11 00:00:00', 'descricion de prueba', 1, 29),
(9, 'prueba 3', '2019-12-24 00:00:00', 'descripcion de prueba 4', 1, 29),
(10, 'Tec. En. Ing Sistemas Informaticos', '2016-06-27 00:00:00', 'Culminado.', 1, 33),
(11, 'Ingeniero Mecánico', '1997-10-12 00:00:00', 'Graduado de Ingeniero Mecánico.', 1, 3),
(12, 'Diplomado en Seguridad y Salud Ocupacional', '2018-04-12 00:00:00', 'Graduado del Diplomado en Seguridad y Salud Ocupacional', 1, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `action_type`
--
ALTER TABLE `action_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `area_servicios`
--
ALTER TABLE `area_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_empresa`
--
ALTER TABLE `categoria_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_grupo`
--
ALTER TABLE `categoria_grupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_grupo_grupo1_idx` (`grupo_id`);

--
-- Indices de la tabla `categoria_habilidad`
--
ALTER TABLE `categoria_habilidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_habilidad_habilidades1_idx` (`habilidades_id`);

--
-- Indices de la tabla `categoria_titulo`
--
ALTER TABLE `categoria_titulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_titulo_titulos1_idx` (`titulos_id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ciudad_departamento_estado_provincia1_idx` (`departamento_estado_provincia_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_ctl_usuario1_idx` (`ctl_usuario_id`),
  ADD KEY `fk_cliente_ciudad1_idx` (`ciudad_id`);

--
-- Indices de la tabla `code_reset_password`
--
ALTER TABLE `code_reset_password`
  ADD PRIMARY KEY (`cod_id`);

--
-- Indices de la tabla `ctl_rol`
--
ALTER TABLE `ctl_rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ctl_rol_usuario`
--
ALTER TABLE `ctl_rol_usuario`
  ADD PRIMARY KEY (`ctl_usuario_id`,`ctl_rol_id`),
  ADD KEY `IDX_A20FFECDA5E6E6A4` (`ctl_usuario_id`),
  ADD KEY `IDX_A20FFECD93B471B9` (`ctl_rol_id`);

--
-- Indices de la tabla `ctl_usuario`
--
ALTER TABLE `ctl_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `data_logs_action`
--
ALTER TABLE `data_logs_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_data_logs_action_ctl_usuario1_idx` (`ctl_usuario_id`),
  ADD KEY `fk_data_logs_action_action_type1_idx` (`action_type_id`),
  ADD KEY `fk_data_logs_action_grupo1_idx` (`grupo_id`),
  ADD KEY `fk_data_logs_action_cliente1_idx` (`cliente_id`),
  ADD KEY `fk_data_logs_action_habilidades1_idx` (`habilidades_id`),
  ADD KEY `fk_data_logs_action_paises_por_region1_idx` (`paises_por_region_id`),
  ADD KEY `fk_data_logs_action_regiones_por_pais1_idx` (`regiones_por_pais_id`),
  ADD KEY `fk_data_logs_action_ciudad1_idx` (`ciudad_id`),
  ADD KEY `fk_data_logs_action_detalle_habilidades1_idx` (`detalle_habilidades_id`),
  ADD KEY `fk_data_logs_action_categoria_habilidad1_idx` (`categoria_habilidad_id`),
  ADD KEY `fk_data_logs_action_detalle_grupo1_idx` (`detalle_grupo_id`),
  ADD KEY `fk_data_logs_action_freelancer1_idx` (`freelancer_id`),
  ADD KEY `fk_data_logs_action_ctl_rol1_idx` (`ctl_rol_id`),
  ADD KEY `fk_data_logs_action_ctl_rol_usuario1_idx` (`ctl_rol_usuario_ctl_usuario_id`,`ctl_rol_usuario_ctl_rol_id`),
  ADD KEY `fk_data_logs_action_solicitud_servicio_empresa1_idx` (`solicitud_servicio_empresa_id`),
  ADD KEY `fk_data_logs_action_detalle_area_servicios_freelance1_idx` (`detalle_area_servicios_freelance_id`),
  ADD KEY `fk_data_logs_action_relaciones_amigos2_idx` (`relaciones_amigos_id1`),
  ADD KEY `fk_data_logs_action_area_servicios1_idx` (`area_servicios_id`),
  ADD KEY `fk_data_logs_action_fotos_servicios_freelancer_empresa1_idx` (`fotos_servicios_freelancer_empresa_id`),
  ADD KEY `fk_data_logs_action_servicios_freelancer1_idx` (`servicios_freelancer_id`),
  ADD KEY `fk_data_logs_action_categoria_titulo1_idx` (`categoria_titulo_id`),
  ADD KEY `fk_data_logs_action_empresa1_idx` (`empresa_id`),
  ADD KEY `fk_data_logs_action_mensaje1_idx` (`mensaje_id`),
  ADD KEY `fk_data_logs_action_detalle_area_servicios_empresa1_idx` (`detalle_area_servicios_empresa_id`),
  ADD KEY `fk_data_logs_action_servicios_empresa1_idx` (`servicios_empresa_id`),
  ADD KEY `fk_data_logs_action_pais1_idx` (`pais_id`),
  ADD KEY `fk_data_logs_action_solicitud_servicio_freelancer1_idx` (`solicitud_servicio_freelancer_id`),
  ADD KEY `fk_data_logs_action_categoria_grupo1_idx` (`categoria_grupo_id`),
  ADD KEY `fk_data_logs_action_titulos1_idx` (`titulos_id`),
  ADD KEY `fk_data_logs_action_departamento_estado_provincia1_idx` (`departamento_estado_provincia_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indices de la tabla `departamento_estado_provincia`
--
ALTER TABLE `departamento_estado_provincia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_departamento_estado_provincia_regiones_por_pais1_idx` (`regiones_por_pais_id`);

--
-- Indices de la tabla `detalle_area_servicios_empresa`
--
ALTER TABLE `detalle_area_servicios_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_area_servicios_empresa_empresa1_idx` (`empresa_id`),
  ADD KEY `fk_detalle_area_servicios_empresa_area_servicios1_idx` (`area_servicios_id`);

--
-- Indices de la tabla `detalle_area_servicios_freelance`
--
ALTER TABLE `detalle_area_servicios_freelance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_area_servicios_freelance_freelancer1_idx` (`freelancer_id`),
  ADD KEY `fk_detalle_area_servicios_freelance_area_servicios1_idx` (`area_servicios_id`);

--
-- Indices de la tabla `detalle_categoria_post`
--
ALTER TABLE `detalle_categoria_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_id` (`id_post`),
  ADD KEY `fk_tipo_categoria` (`id_tipo_categoria`);

--
-- Indices de la tabla `detalle_grupo`
--
ALTER TABLE `detalle_grupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupos_clases_sociedades_grupo1_idx` (`grupo_id`),
  ADD KEY `fk_detalle_grupo_ctl_usuario1_idx` (`ctl_usuario_id`);

--
-- Indices de la tabla `detalle_habilidades`
--
ALTER TABLE `detalle_habilidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_habilidades_habilidades1_idx` (`habilidades_id`),
  ADD KEY `fk_detalle_habilidades_freelancer1_idx` (`freelancer_id`);

--
-- Indices de la tabla `detalle_subcategoria_empresa`
--
ALTER TABLE `detalle_subcategoria_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `Id_subcategoria` (`Id_subcategoria`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empresa_ctl_usuario1_idx` (`ctl_usuario_id`),
  ADD KEY `fk_empresa_ciudadid` (`ciudad_id`);

--
-- Indices de la tabla `experiencia_freelancer`
--
ALTER TABLE `experiencia_freelancer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_freelancer` (`id_freelancer`);

--
-- Indices de la tabla `fotos_servicios_freelancer_empresa`
--
ALTER TABLE `fotos_servicios_freelancer_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fotos_servicios_freelancer_servicios_freelancer1_idx` (`servicios_freelancer_id`),
  ADD KEY `fk_fotos_servicios_freelancer_empresa_servicios_empesa1_idx` (`servicios_empesa_id`);

--
-- Indices de la tabla `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_freelancer_ctl_usuario1_idx` (`ctl_usuario_id`),
  ADD KEY `fk_freelancer_ciudad1_idx` (`ciudad_id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mensaje_ctl_usuario1_idx` (`ctl_usuario_id`),
  ADD KEY `fk_mensaje_relaciones_amigos1_idx` (`relaciones_amigos_id`),
  ADD KEY `fk_mensaje_detalle_grupo1_idx` (`detalle_grupo_id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pais_paises_por_region1_idx` (`paises_por_region_id`);

--
-- Indices de la tabla `paises_por_region`
--
ALTER TABLE `paises_por_region`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `portafolio_empresa`
--
ALTER TABLE `portafolio_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `portafolio_freelancer`
--
ALTER TABLE `portafolio_freelancer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_freelancer_portafolio` (`id_freelancer`);

--
-- Indices de la tabla `post_freelancer_empresa`
--
ALTER TABLE `post_freelancer_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `fk_id_archivo` (`id_archivo`);

--
-- Indices de la tabla `regiones_por_pais`
--
ALTER TABLE `regiones_por_pais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_regiones_por_pais_pais1_idx` (`pais_id`);

--
-- Indices de la tabla `relaciones_amigos`
--
ALTER TABLE `relaciones_amigos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_relaciones_amigos_ctl_usuario1_idx` (`ctl_usuario_id`),
  ADD KEY `fk_relaciones_amigos_ctl_usuario2_idx` (`ctl_usuario_amigo`);

--
-- Indices de la tabla `servicios_empresa`
--
ALTER TABLE `servicios_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicios_empesa_detalle_area_servicios_empresa1_idx` (`detalle_area_servicios_empresa_id`);

--
-- Indices de la tabla `servicios_freelancer`
--
ALTER TABLE `servicios_freelancer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicios_freelancer_detalle_area_servicios_freelance1_idx` (`detalle_area_servicios_freelance_id`);

--
-- Indices de la tabla `solicitud_servicio_empresa`
--
ALTER TABLE `solicitud_servicio_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitud_servicio_empresa_cliente1_idx` (`cliente_id`),
  ADD KEY `fk_solicitud_servicio_empresa_servicios_empesa1_idx` (`servicios_empesa_id`);

--
-- Indices de la tabla `solicitud_servicio_freelancer`
--
ALTER TABLE `solicitud_servicio_freelancer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitud_servicio_freelancer_cliente1_idx` (`cliente_id`),
  ADD KEY `fk_solicitud_servicio_freelancer_servicios_freelancer1_idx` (`servicios_freelancer_id`);

--
-- Indices de la tabla `subcategoria_empresa`
--
ALTER TABLE `subcategoria_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa_categoria` (`id_empresa_categoria`);

--
-- Indices de la tabla `tipo_categoria`
--
ALTER TABLE `tipo_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_categoria` (`id_categoria`);

--
-- Indices de la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_titulos_freelancer1_idx` (`freelancer_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `action_type`
--
ALTER TABLE `action_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `area_servicios`
--
ALTER TABLE `area_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_empresa`
--
ALTER TABLE `categoria_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `categoria_grupo`
--
ALTER TABLE `categoria_grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_habilidad`
--
ALTER TABLE `categoria_habilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_titulo`
--
ALTER TABLE `categoria_titulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `code_reset_password`
--
ALTER TABLE `code_reset_password`
  MODIFY `cod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ctl_rol`
--
ALTER TABLE `ctl_rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ctl_usuario`
--
ALTER TABLE `ctl_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT de la tabla `departamento_estado_provincia`
--
ALTER TABLE `departamento_estado_provincia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `detalle_area_servicios_empresa`
--
ALTER TABLE `detalle_area_servicios_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_area_servicios_freelance`
--
ALTER TABLE `detalle_area_servicios_freelance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_categoria_post`
--
ALTER TABLE `detalle_categoria_post`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_grupo`
--
ALTER TABLE `detalle_grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_habilidades`
--
ALTER TABLE `detalle_habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_subcategoria_empresa`
--
ALTER TABLE `detalle_subcategoria_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `experiencia_freelancer`
--
ALTER TABLE `experiencia_freelancer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `paises_por_region`
--
ALTER TABLE `paises_por_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `portafolio_empresa`
--
ALTER TABLE `portafolio_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `portafolio_freelancer`
--
ALTER TABLE `portafolio_freelancer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `post_freelancer_empresa`
--
ALTER TABLE `post_freelancer_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `regiones_por_pais`
--
ALTER TABLE `regiones_por_pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `relaciones_amigos`
--
ALTER TABLE `relaciones_amigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `servicios_empresa`
--
ALTER TABLE `servicios_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios_freelancer`
--
ALTER TABLE `servicios_freelancer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategoria_empresa`
--
ALTER TABLE `subcategoria_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo_categoria`
--
ALTER TABLE `tipo_categoria`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `titulos`
--
ALTER TABLE `titulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria_grupo`
--
ALTER TABLE `categoria_grupo`
  ADD CONSTRAINT `fk_categoria_grupo_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categoria_habilidad`
--
ALTER TABLE `categoria_habilidad`
  ADD CONSTRAINT `fk_categoria_habilidad_habilidades1` FOREIGN KEY (`habilidades_id`) REFERENCES `habilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categoria_titulo`
--
ALTER TABLE `categoria_titulo`
  ADD CONSTRAINT `fk_categoria_titulo_titulos1` FOREIGN KEY (`titulos_id`) REFERENCES `titulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciudad_departamento_estado_provincia1` FOREIGN KEY (`departamento_estado_provincia_id`) REFERENCES `departamento_estado_provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ctl_rol_usuario`
--
ALTER TABLE `ctl_rol_usuario`
  ADD CONSTRAINT `fk_ctl_rol_has_ctl_usuario_ctl_rol1` FOREIGN KEY (`ctl_rol_id`) REFERENCES `ctl_rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ctl_rol_has_ctl_usuario_ctl_usuario1` FOREIGN KEY (`ctl_usuario_id`) REFERENCES `ctl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `data_logs_action`
--
ALTER TABLE `data_logs_action`
  ADD CONSTRAINT `fk_data_logs_action_action_type1` FOREIGN KEY (`action_type_id`) REFERENCES `action_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_area_servicios1` FOREIGN KEY (`area_servicios_id`) REFERENCES `area_servicios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_categoria_grupo1` FOREIGN KEY (`categoria_grupo_id`) REFERENCES `categoria_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_categoria_habilidad1` FOREIGN KEY (`categoria_habilidad_id`) REFERENCES `categoria_habilidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_categoria_titulo1` FOREIGN KEY (`categoria_titulo_id`) REFERENCES `categoria_titulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_ciudad1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_ctl_rol1` FOREIGN KEY (`ctl_rol_id`) REFERENCES `ctl_rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_ctl_rol_usuario1` FOREIGN KEY (`ctl_rol_usuario_ctl_usuario_id`,`ctl_rol_usuario_ctl_rol_id`) REFERENCES `ctl_rol_usuario` (`ctl_usuario_id`, `ctl_rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_ctl_usuario1` FOREIGN KEY (`ctl_usuario_id`) REFERENCES `ctl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_departamento_estado_provincia1` FOREIGN KEY (`departamento_estado_provincia_id`) REFERENCES `departamento_estado_provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_detalle_area_servicios_empresa1` FOREIGN KEY (`detalle_area_servicios_empresa_id`) REFERENCES `detalle_area_servicios_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_detalle_area_servicios_freelance1` FOREIGN KEY (`detalle_area_servicios_freelance_id`) REFERENCES `detalle_area_servicios_freelance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_detalle_grupo1` FOREIGN KEY (`detalle_grupo_id`) REFERENCES `detalle_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_detalle_habilidades1` FOREIGN KEY (`detalle_habilidades_id`) REFERENCES `detalle_habilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `fk_data_logs_action_fotos_servicios_freelancer_empresa1` FOREIGN KEY (`fotos_servicios_freelancer_empresa_id`) REFERENCES `fotos_servicios_freelancer_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_habilidades1` FOREIGN KEY (`habilidades_id`) REFERENCES `habilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_mensaje1` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_pais1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_paises_por_region1` FOREIGN KEY (`paises_por_region_id`) REFERENCES `paises_por_region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_regiones_por_pais1` FOREIGN KEY (`regiones_por_pais_id`) REFERENCES `regiones_por_pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_relaciones_amigos2` FOREIGN KEY (`relaciones_amigos_id1`) REFERENCES `relaciones_amigos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_servicios_empresa1` FOREIGN KEY (`servicios_empresa_id`) REFERENCES `servicios_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_servicios_freelancer1` FOREIGN KEY (`servicios_freelancer_id`) REFERENCES `servicios_freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_solicitud_servicio_empresa1` FOREIGN KEY (`solicitud_servicio_empresa_id`) REFERENCES `solicitud_servicio_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_solicitud_servicio_freelancer1` FOREIGN KEY (`solicitud_servicio_freelancer_id`) REFERENCES `solicitud_servicio_freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_logs_action_titulos1` FOREIGN KEY (`titulos_id`) REFERENCES `titulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamento_estado_provincia`
--
ALTER TABLE `departamento_estado_provincia`
  ADD CONSTRAINT `fk_departamento_estado_provincia_regiones_por_pais1` FOREIGN KEY (`regiones_por_pais_id`) REFERENCES `regiones_por_pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_area_servicios_empresa`
--
ALTER TABLE `detalle_area_servicios_empresa`
  ADD CONSTRAINT `fk_detalle_area_servicios_empresa_area_servicios1` FOREIGN KEY (`area_servicios_id`) REFERENCES `area_servicios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_area_servicios_empresa_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `detalle_area_servicios_freelance`
--
ALTER TABLE `detalle_area_servicios_freelance`
  ADD CONSTRAINT `fk_detalle_area_servicios_freelance_area_servicios1` FOREIGN KEY (`area_servicios_id`) REFERENCES `area_servicios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_area_servicios_freelance_freelancer1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_categoria_post`
--
ALTER TABLE `detalle_categoria_post`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`id_post`) REFERENCES `post_freelancer_empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_categoria` FOREIGN KEY (`id_tipo_categoria`) REFERENCES `tipo_categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_grupo`
--
ALTER TABLE `detalle_grupo`
  ADD CONSTRAINT `fk_detalle_grupo_ctl_usuario1` FOREIGN KEY (`ctl_usuario_id`) REFERENCES `ctl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupos_clases_sociedades_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_habilidades`
--
ALTER TABLE `detalle_habilidades`
  ADD CONSTRAINT `fk_detalle_habilidades_freelancer1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_habilidades_habilidades1` FOREIGN KEY (`habilidades_id`) REFERENCES `habilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_subcategoria_empresa`
--
ALTER TABLE `detalle_subcategoria_empresa`
  ADD CONSTRAINT `fk_detalle_empresaid` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_subcategoriaid` FOREIGN KEY (`Id_subcategoria`) REFERENCES `subcategoria_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_ctl_usuario1` FOREIGN KEY (`ctl_usuario_id`) REFERENCES `ctl_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_empresa_ciudadid` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;;

--
-- Filtros para la tabla `fotos_servicios_freelancer_empresa`
--
ALTER TABLE `fotos_servicios_freelancer_empresa`
  ADD CONSTRAINT `fk_fotos_servicios_freelancer_empresa_servicios_empesa1` FOREIGN KEY (`servicios_empesa_id`) REFERENCES `servicios_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fotos_servicios_freelancer_servicios_freelancer1` FOREIGN KEY (`servicios_freelancer_id`) REFERENCES `servicios_freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `freelancer`
--
ALTER TABLE `freelancer`
  ADD CONSTRAINT `fk_freelancer_ciudad1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_freelancer_ctl_usuario1` FOREIGN KEY (`ctl_usuario_id`) REFERENCES `ctl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_ctl_usuario1` FOREIGN KEY (`ctl_usuario_id`) REFERENCES `ctl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensaje_detalle_grupo1` FOREIGN KEY (`detalle_grupo_id`) REFERENCES `detalle_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensaje_relaciones_amigos1` FOREIGN KEY (`relaciones_amigos_id`) REFERENCES `relaciones_amigos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `fk_pais_paises_por_region1` FOREIGN KEY (`paises_por_region_id`) REFERENCES `paises_por_region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `portafolio_empresa`
--
ALTER TABLE `portafolio_empresa`
  ADD CONSTRAINT `fk_empresa_portafolio` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `portafolio_freelancer`
--
ALTER TABLE `portafolio_freelancer`
  ADD CONSTRAINT `fk_freelancer_portafolio` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `post_freelancer_empresa`
--
ALTER TABLE `post_freelancer_empresa`
  ADD CONSTRAINT `fk_id_archivo` FOREIGN KEY (`id_archivo`) REFERENCES `archivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `regiones_por_pais`
--
ALTER TABLE `regiones_por_pais`
  ADD CONSTRAINT `fk_regiones_por_pais_pais1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `relaciones_amigos`
--
ALTER TABLE `relaciones_amigos`
  ADD CONSTRAINT `fk_relaciones_amigos_ctl_usuario1` FOREIGN KEY (`ctl_usuario_id`) REFERENCES `ctl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_relaciones_amigos_ctl_usuario2` FOREIGN KEY (`ctl_usuario_amigo`) REFERENCES `ctl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicios_empresa`
--
ALTER TABLE `servicios_empresa`
  ADD CONSTRAINT `fk_servicios_empesa_detalle_area_servicios_empresa1` FOREIGN KEY (`detalle_area_servicios_empresa_id`) REFERENCES `detalle_area_servicios_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicios_freelancer`
--
ALTER TABLE `servicios_freelancer`
  ADD CONSTRAINT `fk_servicios_freelancer_detalle_area_servicios_freelance1` FOREIGN KEY (`detalle_area_servicios_freelance_id`) REFERENCES `detalle_area_servicios_freelance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud_servicio_empresa`
--
ALTER TABLE `solicitud_servicio_empresa`
  ADD CONSTRAINT `fk_solicitud_servicio_empresa_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_servicio_empresa_servicios_empesa1` FOREIGN KEY (`servicios_empesa_id`) REFERENCES `servicios_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud_servicio_freelancer`
--
ALTER TABLE `solicitud_servicio_freelancer`
  ADD CONSTRAINT `fk_solicitud_servicio_freelancer_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_servicio_freelancer_servicios_freelancer1` FOREIGN KEY (`servicios_freelancer_id`) REFERENCES `servicios_freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcategoria_empresa`
--
ALTER TABLE `subcategoria_empresa`
  ADD CONSTRAINT `fk_id_categoria_empresa` FOREIGN KEY (`id_empresa_categoria`) REFERENCES `categoria_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipo_categoria`
--
ALTER TABLE `tipo_categoria`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD CONSTRAINT `fk_titulos_freelancer1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
