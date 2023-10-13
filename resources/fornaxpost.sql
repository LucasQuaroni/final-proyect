-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2023 a las 23:10:17
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fornaxpost`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artefactos`
--

CREATE TABLE `artefactos` (
  `serial` varchar(15) NOT NULL,
  `modelo` varchar(30) DEFAULT NULL,
  `garantia` enum('S','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(8) NOT NULL,
  `nombreYapellido` varchar(60) NOT NULL,
  `domicilio` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `localidad` varchar(30) NOT NULL,
  `codpostal` varchar(15) NOT NULL,
  `obs` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestado` varchar(3) NOT NULL,
  `nombre` varchar(15) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fletes`
--

CREATE TABLE `fletes` (
  `idflete` int(11) NOT NULL,
  `idchofer` int(11) NOT NULL,
  `tipo` enum('R','D') DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `estado` enum('asignada','pendiente','completada','cancelada') DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `idreclamo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos`
--

CREATE TABLE `reclamos` (
  `id` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `serial` varchar(15) NOT NULL,
  `idadmin` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `adjuntos` varchar(1000) DEFAULT NULL,
  `idestado` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idserviciotecnico` int(11) NOT NULL,
  `idtecnico` int(11) NOT NULL,
  `tipo` enum('F','D') DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `estado` enum('asignada','pendiente','completada','cancelada') DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `idreclamo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `contra` varchar(30) DEFAULT NULL,
  `nombreYapellido` varchar(60) DEFAULT NULL,
  `rol` enum('A','C','T') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artefactos`
--
ALTER TABLE `artefactos`
  ADD PRIMARY KEY (`serial`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `fletes`
--
ALTER TABLE `fletes`
  ADD PRIMARY KEY (`idflete`),
  ADD KEY `idreclamo` (`idreclamo`),
  ADD KEY `idchofer` (`idchofer`);

--
-- Indices de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni` (`dni`),
  ADD KEY `idestado` (`idestado`),
  ADD KEY `serial` (`serial`),
  ADD KEY `idadmin` (`idadmin`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idserviciotecnico`),
  ADD KEY `idreclamo` (`idreclamo`),
  ADD KEY `idtecnico` (`idtecnico`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fletes`
--
ALTER TABLE `fletes`
  MODIFY `idflete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idserviciotecnico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fletes`
--
ALTER TABLE `fletes`
  ADD CONSTRAINT `fletes_ibfk_1` FOREIGN KEY (`idreclamo`) REFERENCES `reclamos` (`id`),
  ADD CONSTRAINT `fletes_ibfk_2` FOREIGN KEY (`idchofer`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD CONSTRAINT `reclamos_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `clientes` (`dni`),
  ADD CONSTRAINT `reclamos_ibfk_2` FOREIGN KEY (`idestado`) REFERENCES `estados` (`idestado`),
  ADD CONSTRAINT `reclamos_ibfk_3` FOREIGN KEY (`serial`) REFERENCES `artefactos` (`serial`),
  ADD CONSTRAINT `reclamos_ibfk_4` FOREIGN KEY (`idadmin`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`idreclamo`) REFERENCES `reclamos` (`id`),
  ADD CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`idtecnico`) REFERENCES `usuarios` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;