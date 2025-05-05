-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-05-2025 a las 05:00:06
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendacr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `asunto_actividad` varchar(255) NOT NULL,
  `convoca` varchar(255) NOT NULL,
  `participantes` text,
  `hora_inicio` datetime NOT NULL,
  `lugar` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `enlace_virtual` varchar(255) DEFAULT NULL,
  `creado_por` varchar(50) NOT NULL DEFAULT 'desconocido',
  `hora_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `asunto_actividad`, `convoca`, `participantes`, `hora_inicio`, `lugar`, `descripcion`, `enlace_virtual`, `creado_por`, `hora_fin`) VALUES
(28, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-15 18:56:00', 'OFICINA DEL CR', 'ss', '', 'admin', '2025-04-15 22:56:00'),
(29, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-07 18:58:00', 'OFICINA DEL CR', 'sds', '', 'admin', NULL),
(30, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-10 18:59:00', 'OFICINA DEL CR', 'ss', '', 'admin', NULL),
(31, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-23 21:36:00', 'OFICINA DEL CR', 's', '', 'drtc', '2025-04-23 19:57:00'),
(33, 'REGISTRO 2', 'DRE', 'DRE, DRA,GGR', '2025-04-01 00:24:00', 'OFICINA DEL CR', 's', '', 'admin', '2025-04-01 03:27:00'),
(44, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-04-17 22:29:00', 'OFICINA DEL CR', 'd', '', 'admin', '2025-04-17 12:29:00'),
(45, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-17 20:00:00', 'OFICINA DEL CR', 's', '', 'drtc', '2025-05-17 23:00:00'),
(46, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-16 12:50:00', 'OFICINA DEL CR', 's', '', 'desconocido', '2025-05-16 12:50:00'),
(47, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-15 22:54:00', 'OFICINA DEL CR', 's', '', 'desconocido', '2025-05-15 12:54:00'),
(48, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-18 13:37:00', 'OFICINA DEL CR', 'SSS', '', 'desconocido', '2025-05-18 13:37:00'),
(49, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-19 13:38:00', 'OFICINA DEL CR', 'll', '', 'consejo', '2025-05-19 17:38:00'),
(50, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-20 13:38:00', 'OFICINA DEL CR', 'dsada', '', 'desconocido', '2025-05-20 17:38:00'),
(51, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-21 13:42:00', 'OFICINA DEL CR', 'ii', '', 'desconocido', '2025-05-21 18:42:00'),
(52, 'REGISTRO 4', 'DRE', 'DRE, DRA,GGR', '2025-05-31 13:42:00', 'OFICINA DEL CR', 'llll', '', 'desconocido', '2025-05-31 18:42:00'),
(53, 'REGISTRO 10', 'DRE', 'DRE, DRA,GGR', '2025-05-26 13:44:00', 'OFICINA DEL CR', 'dd', '', 'drtc', '2025-05-26 17:44:00'),
(54, 'REGISTRO 10', 'DRE', 'DRE, DRA,GGR', '2025-05-14 13:54:00', 'OFICINA DEL CR', 'k', '', 'drtc', '2025-05-14 13:54:00'),
(55, 'REGISTRO 10', 'DRE', 'DRE, DRA,GGR', '2025-05-28 13:56:00', 'OFICINA DEL CR', 's', '', 'drtc', '2025-05-28 13:56:00'),
(58, 'REGISTRO 11', 'DRE', 'DRE, DRA,GGR', '2025-05-01 16:00:00', 'OFICINA DEL CR', 'l', '', 'drtc', '2025-05-01 17:00:00'),
(59, 'REGISTRO 11', 'DRE', 'DRE, DRA,GGR', '2025-05-01 17:00:00', 'OFICINA DEL CR', 'g', '', 'consejo', '2025-05-01 21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','normal') NOT NULL,
  `sede` enum('CR','DRTC') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `rol`, `sede`) VALUES
(13, 'admin', '$2y$10$840J306EU4Xd0uLWHKYEteUrH73XDyih94x7CY5gOS7Mr9rgKsPxG', 'admin', 'CR'),
(14, 'consejo', '$2y$10$42awO4eRFNC3pVWeuQ0.9uuNwQkKWP/mdgToF/Plwc2Rrd.EsjKUO', 'normal', 'CR'),
(15, 'drtc', '$2y$10$PPN.b34YcTSqQFPclaIiZeSnZDLYk8DR28BBTXbQswl1K22t4GvJq', 'normal', 'DRTC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
