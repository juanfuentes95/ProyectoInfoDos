-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2016 a las 14:03:33
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

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `validate_rut` (`RUT` VARCHAR(12)) RETURNS INT(11) BEGIN
  DECLARE strlen INT;
  DECLARE i INT;
  DECLARE j INT;
  DECLARE suma NUMERIC;
  DECLARE temprut VARCHAR(12);
  DECLARE verify_dv CHAR(2);
  DECLARE DV CHAR(1);
  IF NOT(RUT like '%-%') THEN
    return 0;
  end if;
  
  SET RUT = REPLACE(REPLACE(RUT, '.', ''),'-','');
  SET DV = SUBSTR(RUT,-1,1);
  SET RUT = SUBSTR(RUT,1,LENGTH(RUT)-1);
  SET i = 1;
    SET strlen = LENGTH(RUT);
    SET j = 2;
    SET suma = 0;
  IF strlen = 8 OR strlen = 7 THEN
    SET temprut = REVERSE(RUT);
    moduloonce: LOOP
        IF i <= LENGTH(temprut) THEN
          SET suma = suma + (CONVERT(SUBSTRING(temprut, i, 1),UNSIGNED INTEGER) * j); 
            SET i = i + 1;
            IF j = 7 THEN
            SET j = 2;
          ELSE
            SET j = j + 1;
          END IF;
            ITERATE moduloonce;
        END IF;
        LEAVE moduloonce;
      END LOOP moduloonce;
      SET verify_dv = 11 - (suma % 11);
      IF verify_dv = 11 THEN
        SET verify_dv = 0;
      ELSEIF verify_dv = 10 THEN 
        SET verify_dv = 'K';
      END IF;
      IF DV = verify_dv THEN
        RETURN 1;
      ELSE 
        RETURN 0;
      END IF;
  END IF;
  RETURN 0;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `rut_administrador` varchar(12) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `nombre_administrador` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`rut_administrador`, `contrasena`, `nombre_administrador`) VALUES
('7832146-6', '123', 'Camila');

--
-- Disparadores `administrador`
--
DELIMITER $$
CREATE TRIGGER `validar_rut_administrador` BEFORE INSERT ON `administrador` FOR EACH ROW BEGIN
  declare variable varchar(11);
  IF validate_rut(new.rut_administrador)=0 THEN
      SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'RUT ISSUE';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `rut_alumno` varchar(12) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `nombre_alumno` varchar(250) NOT NULL,
  `rut_apoderado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`rut_alumno`, `contrasena`, `nombre_alumno`, `rut_apoderado`) VALUES
('11111111-1', '123', 'Eduardo', ''),
('18648731-1', '123', 'Karina', '');

--
-- Disparadores `alumno`
--
DELIMITER $$
CREATE TRIGGER `validar_rut_alumno` BEFORE INSERT ON `alumno` FOR EACH ROW BEGIN
  declare variable varchar(11);
  IF validate_rut(new.rut_alumno)=0 THEN
      SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'RUT ISSUE';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anotaciones`
--

CREATE TABLE `anotaciones` (
  `codigo_anotacion` int(11) NOT NULL,
  `anotacion` varchar(250) NOT NULL,
  `rut_alumno` varchar(250) NOT NULL,
  `rut_profesor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ape`
--

CREATE TABLE `ape` (
  `id` int(11) NOT NULL,
  `edicion` int(11) NOT NULL,
  `asignatura` int(11) NOT NULL,
  `profesor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ape`
--

INSERT INTO `ape` (`id`, `edicion`, `asignatura`, `profesor`) VALUES
(1, 1, 2, '18893542-7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE `apoderado` (
  `rut_apoderado` varchar(12) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `nombre_apoderado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `apoderado`
--
DELIMITER $$
CREATE TRIGGER `validar_rut_apoderado` BEFORE INSERT ON `apoderado` FOR EACH ROW BEGIN
  declare variable varchar(11);
  IF validate_rut(new.rut_apoderado)=0 THEN
      SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'RUT ISSUE';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `nombre_asignatura`) VALUES
(1, 'Matemática'),
(2, 'Lenguaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `id_edicion` int(11) NOT NULL,
  `nombre_curso` varchar(250) NOT NULL,
  `anio_curso` int(11) NOT NULL,
  `rut_profesor_jefe` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`id_edicion`, `nombre_curso`, `anio_curso`, `rut_profesor_jefe`) VALUES
(1, '3°', 2015, '18893542-7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3a87ad',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `codigo_nota` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`codigo_nota`, `id_registro`, `nota`) VALUES
(2, 1, 6.4),
(3, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `rut_profesor` varchar(12) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `nombre_profesor` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`rut_profesor`, `contrasena`, `nombre_profesor`, `tipo`) VALUES
('18893542-7', '123', 'Juan', '');

--
-- Disparadores `profesor`
--
DELIMITER $$
CREATE TRIGGER `validar_rut_profesor` BEFORE INSERT ON `profesor` FOR EACH ROW BEGIN
  declare variable varchar(11);
  IF validate_rut(new.rut_profesor)=0 THEN
      SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'RUT ISSUE';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL,
  `id_edicion` int(11) NOT NULL,
  `rut_alumno` varchar(12) NOT NULL,
  `rut_profesor` varchar(12) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `x_mestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id_registro`, `id_edicion`, `rut_alumno`, `rut_profesor`, `id_asignatura`, `x_mestre`) VALUES
(1, 1, '11111111-1', '18893542-7', 1, 1);

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
  ADD PRIMARY KEY (`rut_alumno`);

--
-- Indices de la tabla `anotaciones`
--
ALTER TABLE `anotaciones`
  ADD PRIMARY KEY (`codigo_anotacion`);

--
-- Indices de la tabla `ape`
--
ALTER TABLE `ape`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id_edicion`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`codigo_nota`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`rut_profesor`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anotaciones`
--
ALTER TABLE `anotaciones`
  MODIFY `codigo_anotacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ape`
--
ALTER TABLE `ape`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `edicion`
--
ALTER TABLE `edicion`
  MODIFY `id_edicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `codigo_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
