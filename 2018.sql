-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-05-2018 a las 20:05:36
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `2018`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `salon` varchar(255) NOT NULL,
  `apertura` date NOT NULL,
  `cierre` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `con` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `carrera` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nit`, `nombre`, `apellido`, `ciudad`, `correo`, `con`, `tipo`, `estado`, `direccion`, `carrera`) VALUES
(3, '12123333', 'EDILBERTOewdwedwed', 'VASQUEZ', 'CARTAGENA', 'EDI@HOTMAIL.COM', 'ZGNjY2VmZmY=', 'alumno', 's', '3333', '7'),
(4, '123223445', 'IVANewrerf', 'GUITIERREZ NUÃ‘EZ', 'CARTAGENA-COLOMBIA', 'GUITIERREZ@HOTMAIL.COM', 'ZGNlZWRlZ2hp', 'alumno', 's', '3333', '7'),
(5, '11233212', 'MIGUEL', 'LAYUN', 'CARTAGENA ', 'MIGUE@HOTMAIL.COM', 'ZGJjZWZlY2M=', 'alumno', 's', '3333', '7'),
(6, '5454666', 'HOMERO', 'SIMPSONS', 'CARTAGENA', 'HOMEROSIP@HOTMAIL.COM', 'aGlpaWpsbA==', 'alumno', 's', '3333ewdwed', '7'),
(7, '1200', 'CASTRO', 'RICARDO', 'CARTAGENA', 'JL@HOTMAIL.COM', '1200', 'alumno', 's', '333', '7'),
(13, '22', 'sdsd', 'sd', 'dws', 'sdsd@hgh', '22', 'alumno', 's', '3333', '7'),
(14, '222222222', '222222s', '2222', '222222222', '22222222@222', '222222222', 'alumno', 's', '33333', '8'),
(15, '24234', 'sdf', 'sdsdf', 'wedw@sa', 'sdsd@trh', '24234', 'alumno', 's', 'sdsd', '7'),
(16, '56523', 'ASD', 'ASDAS', 'SADASD', 'ASDA@JFDM', '56523', 'alumno', 's', 'ASDASD', '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

DROP TABLE IF EXISTS `carreras`;
CREATE TABLE IF NOT EXISTS `carreras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `tipo`, `estado`) VALUES
(7, 'INDUSTRIAS ALIMENTARIAS', '2', 's'),
(8, 'ADMINISTRACION', '2', 's'),
(9, 'CONTABILIDAD', '2', 's'),
(10, 'MECANICA', '2', 's'),
(11, 'INFORMATICA', '2', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `materia` varchar(255) NOT NULL,
  `encargado` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `materia`, `encargado`, `estado`) VALUES
(5, 'CALCULO 1', '29', '112332233', 's'),
(8, 'CALCULO 2', '13', '1234499', 's'),
(9, 'FISICA 2', '29', '112332233', 's'),
(10, 'FISICA 1', '29', '1234499', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_carrera`
--

DROP TABLE IF EXISTS `detalle_carrera`;
CREATE TABLE IF NOT EXISTS `detalle_carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia` int(11) NOT NULL,
  `carrera` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_carrera`
--

INSERT INTO `detalle_carrera` (`id`, `materia`, `carrera`, `semestre`, `estado`) VALUES
(6, 12, 7, 1, 's'),
(7, 15, 7, 1, 's'),
(8, 14, 7, 1, 's'),
(9, 13, 7, 1, 's'),
(10, 13, 8, 1, 's'),
(11, 16, 8, 1, 's'),
(27, 12, 8, 1, 's'),
(28, 15, 8, 1, 's'),
(29, 29, 8, 1, 's'),
(30, 14, 8, 1, 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `materia` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id`, `nombre`, `materia`, `estado`) VALUES
(8, 'Contenido de Estudio Algoritmo', '12', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `creditos` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `director`, `creditos`, `valor`, `estado`) VALUES
(12, 'Algoritmos', '1128059636', 3, '0', 's'),
(13, 'IntroducciÃ³n a la programaciÃ³n', '112332233', 3, '0', 's'),
(14, 'COMUNICACION', '1128059636', 5, '0', 's'),
(15, 'Bases de datos bÃ¡sico', '1234499', 3, '0', 's'),
(16, 'FISICA', '458377289', 3, '0', 's'),
(29, 'CALCULO', '12345566', 5, '0', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `especialidad` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `correo` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `con` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `nit`, `nombre`, `localidad`, `especialidad`, `fecha`, `correo`, `celular`, `perfil`, `estado`, `tipo`, `usu`, `con`) VALUES
(1, '1234499', 'MINDA HERNANDEZ', 'CARTAGENA BOLIVAR', '', '0000-00-00', 'MINDA@HOTMAIL.COM', '3103857667', '', 's', 'p', 'mindah', 'mindah'),
(2, '112332233', 'FABIOLA HERNANDEZ', 'CARTAGENA - BOLIVAR', '', '0000-00-00', 'HUGOM@HOTMAIL.COM', '3100384776', '', 's', 'p', 'hugom', 'hugom'),
(3, '458377289', 'MAURA VASQUEZ', 'CARTAGENA - BOLIVAR', '', '0000-00-00', 'MAURAVASQUEZ@HOTMAIL.COM', '3002847387w', '', 's', 'p', 'maurav', 'maurav'),
(4, '1128059636', 'JORGE VASQUEZ JULIO', 'CARTAGENA BOLIVAR', '', '0000-00-00', 'JLVASQUEZ63@HOTMAIL.COM', '6679159', '', 's', 'a', 'u', 'u'),
(5, '12345566', 'EDILSON NUÃ‘EZ', 'COLOMBIA', '', '0000-00-00', 'EDILSON@HOTMAIL.COM45', '3333ss', '', 's', '', 'EDILSON', 'EDILSON'),
(6, '122222', 'MONICA CLARA', 'CARTAGENAeeewASSAS', '', '0000-00-00', 'JLVASQ@HOTMAIL.COM', '40000', '', 's', 'p', 'MONICA', 'MONICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salon_alum`
--

DROP TABLE IF EXISTS `salon_alum`;
CREATE TABLE IF NOT EXISTS `salon_alum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salon` varchar(255) NOT NULL,
  `alumno` varchar(255) NOT NULL,
  `semestre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `anno` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salon_alum`
--

INSERT INTO `salon_alum` (`id`, `salon`, `alumno`, `semestre`, `tipo`, `anno`) VALUES
(41, '5', '123223445', '1', 'S1', '2013'),
(42, '6', '123223445', '1', 'S1', '2013'),
(43, '7', '123223445', '1', 'S1', '2013'),
(44, '8', '123223445', '1', 'S1', '2013'),
(45, '5', '1234567', '1', 'S1', '2014'),
(46, '6', '1234567', '1', 'S1', '2014'),
(47, '7', '1234567', '1', 'S1', '2014'),
(48, '8', '1234567', '1', 'S1', '2014');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tactividad`
--

DROP TABLE IF EXISTS `tactividad`;
CREATE TABLE IF NOT EXISTS `tactividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tactividad`
--

INSERT INTO `tactividad` (`id`, `nombre`, `estado`) VALUES
(1, 'Actividad Numero 1', 's'),
(2, 'Actividad Numero 2', 's'),
(3, 'Actividad Numero 3', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcarrera`
--

DROP TABLE IF EXISTS `tcarrera`;
CREATE TABLE IF NOT EXISTS `tcarrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tcarrera`
--

INSERT INTO `tcarrera` (`id`, `nombre`, `estado`) VALUES
(1, 'Posgrado', 's'),
(2, 'Pregrado', 's'),
(5, 'Diplomado', 's'),
(6, 'Cursos Extras', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_asig`
--

DROP TABLE IF EXISTS `tmp_asig`;
CREATE TABLE IF NOT EXISTS `tmp_asig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno` varchar(255) NOT NULL,
  `mate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ya_matri`
--

DROP TABLE IF EXISTS `ya_matri`;
CREATE TABLE IF NOT EXISTS `ya_matri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mate` varchar(255) NOT NULL,
  `alumno` varchar(255) NOT NULL,
  `semestre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `anno` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `notaf` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ya_matri`
--

INSERT INTO `ya_matri` (`id`, `mate`, `alumno`, `semestre`, `tipo`, `anno`, `estado`, `notaf`) VALUES
(27, '12', '123223445', '1', 'S1', '2013', 'E', '0'),
(28, '15', '123223445', '1', 'S1', '2013', 'E', '0'),
(29, '14', '123223445', '1', 'S1', '2013', 'E', '0'),
(40, '12', '222222222', '1', 'S1', '2018', 'E', '0'),
(41, '15', '222222222', '1', 'S1', '2018', 'E', '0'),
(42, '14', '222222222', '1', 'S1', '2018', 'E', '0'),
(43, '13', '222222222', '1', 'S1', '2018', 'E', '0'),
(44, '12', '1200', '1', 'S1', '2018', 'E', '0'),
(45, '15', '1200', '1', 'S1', '2018', 'E', '0'),
(46, '16', '222222222', '1', 'S1', '2018', 'E', '0'),
(47, '29', '222222222', '1', 'S1', '2018', 'E', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
