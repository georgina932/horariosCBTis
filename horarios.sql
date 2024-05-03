-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2024 a las 17:16:57
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `horarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `Clave` varchar(50) COLLATE utf8_bin NOT NULL,
  `HoraSemana` varchar(15) COLLATE utf8_bin NOT NULL,
  `disponible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `Clave`, `HoraSemana`, `disponible`) VALUES
(1, 'Ingles', 'Ingl2', '10', 0),
(2, 'lectura', 'lec1', '10', 1),
(5, 'matematicas', 'mat1', '10', 1),
(6, 'quimica', 'qui1', '67', 1),
(11, 'programacion', 'bd1', '10', 0),
(12, 'fisica ', 'fis1', '10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `clave` varchar(50) COLLATE utf8_bin NOT NULL,
  `carga` varchar(6) COLLATE utf8_bin NOT NULL,
  `descarga` varchar(6) COLLATE utf8_bin NOT NULL,
  `asignadas` varchar(6) COLLATE utf8_bin NOT NULL,
  `entrada` varchar(6) COLLATE utf8_bin NOT NULL,
  `salida` varchar(6) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `nombre`, `clave`, `carga`, `descarga`, `asignadas`, `entrada`, `salida`) VALUES
(2, 'Anevi Esmeralda', 'pendiente', '30', '3', '27', '7', '2'),
(3, 'Miguel Agel Moncada', 'pediente', '30', '4', '7', '9', '3'),
(4, 'Roberto', 'Robe10', '10', '3', '7', '9', '3'),
(21, 'Jose Refugio', 'cuco10', '10', '3', '7', '7', '2'),
(22, 'cristobal', 'cris10', '10', '2', '8', '7', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion`
--

CREATE TABLE `relacion` (
  `id` int(11) NOT NULL,
  `id_doc` int(50) NOT NULL,
  `id_asi` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salon`
--

CREATE TABLE `salon` (
  `id` int(15) NOT NULL,
  `especialidad` varchar(50) COLLATE utf8_bin NOT NULL,
  `clave` varchar(50) COLLATE utf8_bin NOT NULL,
  `grado` varchar(15) COLLATE utf8_bin NOT NULL,
  `grupo` varchar(15) COLLATE utf8_bin NOT NULL,
  `id_docente` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `salon`
--

INSERT INTO `salon` (`id`, `especialidad`, `clave`, `grado`, `grupo`, `id_docente`) VALUES
(1, 'ProgramaciÃ³n', 'PG1', '1', 'C', 0),
(2, 'Recursos Humanos ', 'RH1', '1', 'A', 0),
(4, 'soporte y mantenimiento', 'SYM1', '1', 'D', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `Correo` varchar(50) COLLATE utf8_bin NOT NULL,
  `Usuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `Contrasena` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Nombre`, `Correo`, `Usuario`, `Contrasena`) VALUES
(1, 'Administrador', 'admin@gmail.com', 'Admin', '12345'),
(7, 'gina', 'gina@gmail.com', 'practicante', '12345'),
(8, 'gaby', 'gabi@gmail.com', 'subdirectora', '123456'),
(11, 'Administrador', 'admin@gmail.com', 'Admin', '12345'),
(12, 'Administrador', 'admin@gmail.com', 'Admin', '12345'),
(13, 'jose Refugio', 'cuco@gmail.com', 'Asesor', '1234567');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `relacion`
--
ALTER TABLE `relacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`id`,`id_docente`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `relacion`
--
ALTER TABLE `relacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salon`
--
ALTER TABLE `salon`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
