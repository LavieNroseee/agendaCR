SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Tabla actividades
--
CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `asunto_actividad` varchar(255) NOT NULL,
  `convoca` varchar(255) NOT NULL,
  `participantes` text,
  `hora` datetime NOT NULL,
  `lugar` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `enlace_virtual` varchar(255) DEFAULT NULL,
  `creado_por` VARCHAR(50) NOT NULL DEFAULT 'desconocido' -- Nuevo campo
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tabla usuarios
--
CREATE TABLE `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `rol` ENUM('admin', 'normal') NOT NULL,
  `sede` ENUM('CR', 'DRTC') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

COMMIT;
