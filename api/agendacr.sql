-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-04-2025 a las 21:13:08
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
  `hora` datetime NOT NULL,
  `lugar` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `enlace_virtual` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `asunto_actividad`, `convoca`, `participantes`, `hora`, `lugar`, `descripcion`, `enlace_virtual`) VALUES
(5, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-28 13:32:00', 'OFICINA DEL CR', 'ss', ''),
(6, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-28 01:32:00', 'OFICINA DEL CR', 'ss', ''),
(7, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-28 01:54:00', 'OFICINA DEL CR', 'ss', ''),
(8, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-29 11:53:00', 'OFICINA DEL CR', 'ss', ''),
(9, 'REGISTRO', 'DRE', 'DRE, DRA,GGR', '2025-04-29 11:54:00', 'OFICINA DEL CR', 'd', ''),
(10, 'REGISTRO', 'DRE', 'DRE, DRA,GGR', '2025-04-30 11:54:00', 'OFICINA DEL CR', 'd', ''),
(11, 'REGISTRO', 'DRE', 'DRE, DRA,GGR', '2025-04-22 11:59:00', 'OFICINA DEL CR', 'a', ''),
(12, 'REGISTRO', 'DRE', 'DRE, DRA,GGR', '2025-04-22 11:50:00', 'OFICINA DEL CR', 'f', ''),
(13, 'REGISTRO', 'DRE', 'DRE, DRA,GGR', '2025-04-22 11:08:00', 'OFICINA DEL CR', 'f', ''),
(14, 'REGISTRO', 'DRE', 'DRE, DRA,GGR', '2025-04-23 12:13:00', 'OFICINA DEL CR', 'd', ''),
(15, 'REGISTRO', 'DRE', 'DRE, DRA,GGR', '2025-04-26 12:13:00', 'OFICINA DEL CR', 'k', ''),
(16, 'REGISTRO', 'COI', 'DRE, DRA,GGR', '2025-04-24 12:19:00', 'OFICINA DEL CR', 'h', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
