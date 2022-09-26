-- phpMyAdmin SQL Dump
-- version 5.1.1-1.fc14.al
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-04-2022 a las 16:53:02
-- Versión del servidor: 10.2.38-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tallerdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `Id` int(10) NOT NULL,
  `marca` varchar(80) NOT NULL,
  `modelo` varchar(80) NOT NULL,
  `equipo` varchar(80) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` varchar(80) NOT NULL,
  `disponibilidad` varchar(15) NOT NULL,
  `ubicacion` varchar(80) NOT NULL,
  `responsable` varchar(80) NOT NULL,
  `ultimo_job` varchar(80) NOT NULL,
  `fecha_instalacion` date NOT NULL,
  `fecha_ult_job` date NOT NULL,
  `tecnico_ult_job` varchar(100) NOT NULL,
  `desc_ult_job` varchar(200) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `serial_canal` varchar(200) NOT NULL,
  `serial_equipo` varchar(200) NOT NULL,
  `adjuntos` longblob NOT NULL,
  `manuales` longblob NOT NULL,
  `solicitud_repuesto` varchar(10) NOT NULL DEFAULT 'NO',
  `fecha_last_maintenance` date NOT NULL,
  `proveedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`Id`, `marca`, `modelo`, `equipo`, `nombre`, `estado`, `disponibilidad`, `ubicacion`, `responsable`, `ultimo_job`, `fecha_instalacion`, `fecha_ult_job`, `tecnico_ult_job`, `desc_ult_job`, `observaciones`, `serial_canal`, `serial_equipo`, `adjuntos`, `manuales`, `solicitud_repuesto`, `fecha_last_maintenance`, `proveedor`) VALUES
(1, 'HP', 'ZBook G2', 'LAPTOP', 'LAPTOP', 'Operativo', 'Ocupado', 'Taller de Ingenieria', 'Departamento Ingenieria', 'Eleccion Reina de Ambato 2021', '2014-08-08', '2021-02-11', 'Christian Mora', 'Se utilizo la laptop en la transmision para convertir los videos grabados para entregar en DVD', 'Se coloco un disco solido de 250GB para el sistema y hacer mas rapido el equipo y los programas.', 'QECENT008', 'CND4505VZT', '', '', 'No', '2020-08-23', ''),
(2, 'Panasonic', 'AG-HPX250P', 'CAMARA SDI HD', 'CAMARA SDI HD', 'Averiado', 'No disponible', 'Taller de ingenieria', 'Departamento de Ingenieria', 'Coberturas de camarografos de noticias', '2010-08-23', '2019-12-20', 'Mario Herrera', 'Cambio de motor de zoom y queda pendiente el switch de encendido.', 'Esta pendiente el switch de encendido.', 'ASA5656DSDSA', 'I2TCB0033', '', '', 'Si', '2020-02-11', ''),
(3, 'Dell', 'Force10', 'Switch Gigabit', 'Switch Gigabit', 'Operativo', 'Disponible', 'Taller de Ingenieria', 'Departamento de Ingenieria', 'Switch de core para sistema Diva & Aurora.', '2010-10-16', '2022-01-28', 'Christian Mora', 'Limpieza profunda tras migracion de edificio principal.', 'Se encuentra probado y funcionando.', 'FKDIEJI34K322', '759-000063-01', '', '', 'No', '2022-02-24', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojasdevida`
--

CREATE TABLE `hojasdevida` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `equipo` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `responsable` varchar(200) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_solucion` date NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `adjuntos` mediumblob NOT NULL,
  `tecnico_cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `Id` bigint(20) NOT NULL,
  `asunto` varchar(250) NOT NULL,
  `quien_reporta` varchar(80) NOT NULL,
  `responsable` varchar(80) NOT NULL,
  `fecha_reporte` date NOT NULL,
  `fecha_slocuion` date NOT NULL,
  `estado` varchar(80) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `adjuntos` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transmisiones`
--

CREATE TABLE `transmisiones` (
  `Id` int(10) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `ubicacion` varchar(120) NOT NULL,
  `tecnicos` varchar(250) NOT NULL,
  `unidad_movil` varchar(80) NOT NULL,
  `equipos` varchar(250) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `adjuntos` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(5) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` varchar(80) NOT NULL,
  `lastlogin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `nombre`, `apellido`, `email`, `nickname`, `password`, `rol`, `lastlogin`) VALUES
(1, 'Christian', 'Mora', 'cmora@teleamazonas.com', 'cmora', 'fea70675fc191d15acbdc49866fc758e', 'admin', '2021-05-17'),
(2, 'Santiago', 'Cabascango', 'scabascango@teleamazonas.com', 'scabascango', '4d00c1c9a19c6201a9cd838df16bb15c', 'super', '2022-04-18'),
(3, 'Antonio', 'Montalvo', 'amontalvo@teleamazonas.com', 'amontalvo', '2b07a05206ab1bea25ead15151b9b1d7', 'super', '2022-04-11'),
(4, 'Mario', 'Herrera', 'mherrera@teleamazonas.com', 'mherrera', '2e142ee14c717bbea2b289648004724f', 'normal', '2021-05-17'),
(5, 'Jaime', 'Garcia', 'jggarcia@teleamazonas.com', 'jgarcia', '51cf67b2c05db91987e53744d502af8b', 'normal', '2021-03-16'),
(6, 'Andres', 'Jativa', 'cjativa@teleamazonas.com', 'cjativa', '27f4f387fe707d2e2345e87c6e48be9c', 'normal', '2022-04-18'),
(7, 'Andres', 'Aguaisa', 'vaguaisa@teleamazonas.com', 'vaguaisa', 'ce2adca7038fb7366739b200b4963e8f', 'normal', '2021-05-17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `hojasdevida`
--
ALTER TABLE `hojasdevida`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `transmisiones`
--
ALTER TABLE `transmisiones`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hojasdevida`
--
ALTER TABLE `hojasdevida`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transmisiones`
--
ALTER TABLE `transmisiones`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
