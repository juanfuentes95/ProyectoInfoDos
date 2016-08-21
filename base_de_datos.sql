-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2016 a las 02:59:43
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_info_dos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `rut_administrador` int(11) NOT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `nombre_administrador` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `rut_alumno` int(11) NOT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `nombre_alumno` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `rut_apoderado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`rut_alumno`, `contrasena`, `nombre_alumno`, `tipo`, `rut_apoderado`) VALUES
(11, '123', 'Juan', NULL, NULL),
(12, '123', 'Kari', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anotaciones`
--

CREATE TABLE `anotaciones` (
  `codigo_anotacion` int(11) NOT NULL,
  `anotacion` varchar(250) DEFAULT NULL,
  `rut_alumno` varchar(250) NOT NULL,
  `rut_profesor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ape`
--

CREATE TABLE `ape` (
  `id` int(11) NOT NULL,
  `asignatura` int(11) DEFAULT NULL,
  `profesor` int(11) DEFAULT NULL,
  `edicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ape`
--

INSERT INTO `ape` (`id`, `asignatura`, `profesor`, `edicion`) VALUES
(0, 1, 111, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE `apoderado` (
  `rut_apoderado` int(11) NOT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `nombre_apoderado` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `nombre_asignatura`) VALUES
(1, 'Matemáticas'),
(2, 'Lenguaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `id_edicion` int(11) NOT NULL,
  `nombre_curso` varchar(250) DEFAULT NULL,
  `anio_curso` int(11) DEFAULT NULL,
  `rut_profesor_jefe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`id_edicion`, `nombre_curso`, `anio_curso`, `rut_profesor_jefe`) VALUES
(1, '2°', 2015, NULL),
(2, '3°', 2016, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `codigo_nota` int(11) NOT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`codigo_nota`, `id_registro`, `nota`) VALUES
(3, 2, 2.9),
(4, 2, 5.2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `rut_profesor` int(11) NOT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `nombre_profesor` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`rut_profesor`, `contrasena`, `nombre_profesor`, `tipo`) VALUES
(111, '123', 'Cami', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL,
  `id_edicion` int(11) DEFAULT NULL,
  `rut_alumno` int(11) DEFAULT NULL,
  `rut_profesor` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `x_mestre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id_registro`, `id_edicion`, `rut_alumno`, `rut_profesor`, `id_asignatura`, `x_mestre`) VALUES
(1, 1, 11, 111, 1, 1),
(2, 1, 12, 111, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`rut_administrador`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`rut_alumno`),
  ADD KEY `fk_alumno_apoderado` (`rut_apoderado`);

--
-- Indices de la tabla `anotaciones`
--
ALTER TABLE `anotaciones`
  ADD PRIMARY KEY (`codigo_anotacion`);

--
-- Indices de la tabla `ape`
--
ALTER TABLE `ape`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ape_asignatura` (`asignatura`),
  ADD KEY `fk_ape_profesor` (`profesor`),
  ADD KEY `fk_ape_edicion` (`edicion`);

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD PRIMARY KEY (`rut_apoderado`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indices de la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD PRIMARY KEY (`id_edicion`),
  ADD KEY `fk_edicion_curso` (`nombre_curso`),
  ADD KEY `fk_edicion_profesor` (`rut_profesor_jefe`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`codigo_nota`),
  ADD KEY `fk_notas_registro` (`id_registro`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`rut_profesor`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `fk_registro_edicion` (`id_edicion`),
  ADD KEY `fk_registro_alumno` (`rut_alumno`),
  ADD KEY `fk_registro_profesor` (`rut_profesor`),
  ADD KEY `fk_registro_asignatura` (`id_asignatura`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_apoderado` FOREIGN KEY (`rut_apoderado`) REFERENCES `apoderado` (`rut_apoderado`);

--
-- Filtros para la tabla `ape`
--
ALTER TABLE `ape`
  ADD CONSTRAINT `fk_ape_asignatura` FOREIGN KEY (`asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `fk_ape_edicion` FOREIGN KEY (`edicion`) REFERENCES `edicion` (`id_edicion`),
  ADD CONSTRAINT `fk_ape_profesor` FOREIGN KEY (`profesor`) REFERENCES `profesor` (`rut_profesor`);

--
-- Filtros para la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD CONSTRAINT `fk_edicion_profesor` FOREIGN KEY (`rut_profesor_jefe`) REFERENCES `profesor` (`rut_profesor`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_notas_registro` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_alumno` FOREIGN KEY (`rut_alumno`) REFERENCES `alumno` (`rut_alumno`),
  ADD CONSTRAINT `fk_registro_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `fk_registro_edicion` FOREIGN KEY (`id_edicion`) REFERENCES `edicion` (`id_edicion`),
  ADD CONSTRAINT `fk_registro_profesor` FOREIGN KEY (`rut_profesor`) REFERENCES `profesor` (`rut_profesor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
