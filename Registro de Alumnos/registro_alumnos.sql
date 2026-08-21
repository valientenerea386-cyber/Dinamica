-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2026 a las 16:30:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registro_alumnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `dni` varchar(15) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `apellido`, `nombre`, `dni`, `email`, `fecha_nacimiento`, `telefono`, `activo`, `curso_id`) VALUES
(1, 'González', 'María', '45123456', 'maria.gonzalez@email.com', '2008-03-15', '11-5555-1001', 1, 1),
(2, 'Rodríguez', 'Juan', '45234567', 'juan.rodriguez@email.com', '2008-07-22', '11-5555-1002', 1, 1),
(4, 'López', 'Martín', '45456789', 'martin.lopez@email.com', '2008-11-05', '11-5555-1004', 0, 2),
(5, 'Martínez', 'Sofía', '45567890', 'sofia.martinez@email.com', '2008-09-18', '11-5555-1005', 1, 2),
(6, 'Pérez', 'Tomás', '45678901', 'tomas.perez@email.com', '2009-04-30', '11-5555-1006', 1, 3),
(7, 'Sánchez', 'Valentina', '45789012', 'valentina.sanchez@email.com', '2009-06-12', '11-5555-1007', 1, 3),
(8, 'Ramírez', 'Diego', '45890123', 'diego.ramirez@email.com', '2009-02-25', '11-5555-1008', 1, 4),
(9, 'Torres', 'Camila', '45901234', 'camila.torres@email.com', '2010-08-08', '11-5555-1009', 1, 5),
(10, 'Flores', 'Agustín', '46012345', 'agustin.flores@email.com', '2010-12-01', '11-5555-1010', 0, 5),
(11, 'flores', 'nerea', '1234567890', 'nvaliente150@gmail.com', '2056-03-22', '542477363010', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `anio` int(11) NOT NULL,
  `division` varchar(10) NOT NULL,
  `turno` varchar(20) NOT NULL DEFAULT 'Mañana'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `anio`, `division`, `turno`) VALUES
(1, 'Sexto Año Informática', 6, 'A', 'Mañana'),
(2, 'Sexto Año Informática', 6, 'B', 'Tarde'),
(3, 'Quinto Año Informática', 5, 'A', 'Mañana'),
(4, 'Quinto Año Informática', 5, 'B', 'Tarde'),
(5, 'Cuarto Año Informática', 4, 'A', 'Mañana'),
(6, 'Sexto año en Informatica', 5, 'a', 'Mañana'),
(7, 'arquitectura', 5, 'C', 'Noche');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_alumno_curso` (`curso_id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumno_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
