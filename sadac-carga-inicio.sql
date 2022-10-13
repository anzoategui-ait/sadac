-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2022 a las 15:37:57
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ssait`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `actividad_id` int(11) NOT NULL,
  `actividad_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `actividad_descripcion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `actividad_imagen` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `indicador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`actividad_id`, `actividad_nombre`, `actividad_descripcion`, `actividad_imagen`, `categoria_id`, `indicador_id`) VALUES
(1, 'primera actividad', 'primera activida registrada en el sistema', 'default.jpg', 1, 1),
(2, 'examen de laboratorio', 'realizar examenes', 'default.jpg', 1, 1),
(3, 'estudio especializado', 'realizacion de estudios especializados', 'default.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_usuario`
--

CREATE TABLE `activo_usuario` (
  `activo_usuario_id` int(11) NOT NULL,
  `activo_codigo` int(11) NOT NULL,
  `usuario_cedula` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `activo_usuario_concepto` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `activo_usuario_tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `activo_usuario_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_usuario_status`
--

CREATE TABLE `activo_usuario_status` (
  `activo_usuario_status_id` int(11) NOT NULL,
  `usuario_cedula` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo`
--

CREATE TABLE `anexo` (
  `anexo_id` int(11) NOT NULL,
  `anexo_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `anexo_archivo` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `paso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `asignacion_id` int(11) NOT NULL,
  `solicitud_actividad` int(11) NOT NULL,
  `asignado_a` int(11) NOT NULL,
  `asignado_por` int(11) NOT NULL,
  `asignacion_fecha` datetime NOT NULL,
  `asignacion_observacion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asignacion`
--

INSERT INTO `asignacion` (`asignacion_id`, `solicitud_actividad`, `asignado_a`, `asignado_por`, `asignacion_fecha`, `asignacion_observacion`) VALUES
(1, 1, 10137, 1, '2022-07-31 20:35:50', 'realizar tarea'),
(2, 11, 10137, 1, '2022-04-15 21:50:11', 'operador probar la fecha'),
(3, 13, 10137, 1, '2022-04-14 21:58:08', 'probando fecha final'),
(4, 14, 10137, 1, '2022-05-12 22:35:33', 'probando el mes de mayo'),
(5, 21, 10137, 1, '2022-02-11 00:53:43', 'primera prueba'),
(6, 20, 10137, 1, '2022-02-10 00:54:07', 'usuario pruieba febrero'),
(7, 19, 10137, 1, '2022-02-10 00:54:32', 'tercera pruena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `bitacora_id` int(11) NOT NULL,
  `bitacora_fecha` datetime NOT NULL,
  `bitacora_accion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`bitacora_id`, `bitacora_fecha`, `bitacora_accion`, `usuario_id`) VALUES
(1, '2022-07-28 09:07:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2, '2022-07-28 09:08:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3, '2022-07-28 09:08:13', 'Visualizo el listado de actividades', 1),
(4, '2022-07-28 09:08:20', 'Visualizo el listado de pasos', 1),
(5, '2022-07-28 09:09:38', 'Visualizo el listado de indicador', 1),
(6, '2022-07-28 09:09:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(7, '2022-07-28 09:27:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(8, '2022-07-30 08:05:25', 'Inicio de Sesion', 1),
(9, '2022-07-30 08:05:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(10, '2022-07-30 08:06:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(11, '2022-07-30 08:06:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(12, '2022-07-30 08:06:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(13, '2022-07-30 08:43:51', 'Inicio de Sesion', 1),
(14, '2022-07-30 08:43:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(15, '2022-07-30 08:44:02', 'Visualizo el listado de solicitud', 1),
(16, '2022-07-30 08:44:39', 'Visualizo el listado de solicitud', 1),
(17, '2022-07-30 08:45:20', 'Inicio de Sesion', 1),
(18, '2022-07-30 08:45:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(19, '2022-07-30 08:45:34', 'Visualizo el listado de asignaciones', 1),
(20, '2022-07-30 08:45:42', 'Visualizo el listado de asignaciones', 1),
(21, '2022-07-30 08:45:54', 'Visualizo el listado de anexo de asignaciones', 1),
(22, '2022-07-30 08:49:18', 'Visualizo el listado de anexo de asignaciones', 1),
(23, '2022-07-30 08:50:33', 'Inicio de Sesion', 1),
(24, '2022-07-30 08:50:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(25, '2022-07-30 08:51:31', 'Inicio de Sesion', 1),
(26, '2022-07-30 08:51:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(27, '2022-07-30 08:53:13', 'Inicio de Sesion', 10137),
(28, '2022-07-30 08:53:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(29, '2022-07-30 08:57:04', 'Inicio de Sesion', 10137),
(30, '2022-07-30 08:57:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(31, '2022-07-30 09:02:23', 'Visualizo el listado de sectors', 10137),
(32, '2022-07-30 09:06:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(33, '2022-07-30 09:06:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(34, '2022-07-30 09:07:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(35, '2022-07-30 09:09:00', 'Inicio de Sesion', 10137),
(36, '2022-07-30 09:09:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(37, '2022-07-30 09:09:38', 'Inicio de Sesion', 10137),
(38, '2022-07-30 09:09:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(39, '2022-07-30 09:12:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(40, '2022-07-30 09:12:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(41, '2022-07-30 09:12:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(42, '2022-07-30 09:13:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(43, '2022-07-30 09:15:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(44, '2022-07-30 09:16:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(45, '2022-07-30 09:18:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(46, '2022-07-30 09:19:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(47, '2022-07-30 09:21:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(48, '2022-07-30 09:22:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(49, '2022-07-30 09:25:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(50, '2022-07-30 09:28:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(51, '2022-07-30 09:31:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(52, '2022-07-30 09:34:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(53, '2022-07-30 09:37:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(54, '2022-07-30 09:40:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(55, '2022-07-30 09:43:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(56, '2022-07-30 09:45:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(57, '2022-07-30 09:46:39', 'Inicio de Sesion', 10137),
(58, '2022-07-30 09:46:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(59, '2022-07-30 19:50:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(60, '2022-07-30 19:51:20', 'Creacion de nueva categoria: categoria 1', 10137),
(61, '2022-07-30 19:52:18', 'Creacion de nuevo indicador: primer indicador', 10137),
(62, '2022-07-30 19:52:44', 'Creacion de nueva actividad: primera actividad', 10137),
(63, '2022-07-30 19:53:15', 'Creacion de un nuevo paso: descripcion', 10137),
(64, '2022-07-30 19:53:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(65, '2022-07-30 19:53:45', 'Actualizo la siguiente solicitud: nueva solicitud de medicamentos', 10137),
(66, '2022-07-30 19:53:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(67, '2022-07-31 12:08:55', 'Inicio de Sesion', 1),
(68, '2022-07-31 12:08:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(69, '2022-07-31 13:27:39', 'Creacion de nuevo sector: san cristobal centro', 1),
(70, '2022-07-31 13:28:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(71, '2022-07-31 13:28:24', 'Actualizo la siguiente solicitud: probando la fecha de nacimiento', 1),
(72, '2022-07-31 13:28:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(73, '2022-07-31 13:28:43', 'Actualizo la siguiente solicitud: probando el sistema', 1),
(74, '2022-07-31 13:28:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(75, '2022-07-31 13:29:03', 'Actualizo la siguiente solicitud: otra soliciutd', 1),
(76, '2022-07-31 13:29:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(77, '2022-07-31 19:25:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(78, '2022-07-31 19:25:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(79, '2022-07-31 19:25:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(80, '2022-07-31 19:25:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(81, '2022-07-31 19:25:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(82, '2022-07-31 19:28:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(83, '2022-07-31 19:31:55', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(84, '2022-07-31 19:34:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(85, '2022-07-31 19:37:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(86, '2022-07-31 19:40:58', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(87, '2022-07-31 19:43:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(88, '2022-07-31 19:47:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(89, '2022-07-31 19:50:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(90, '2022-07-31 19:53:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(91, '2022-07-31 19:56:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(92, '2022-07-31 19:59:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(93, '2022-07-31 20:02:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(94, '2022-07-31 20:05:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(95, '2022-07-31 20:08:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(96, '2022-07-31 20:11:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(97, '2022-07-31 20:14:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(98, '2022-07-31 20:17:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(99, '2022-07-31 20:20:12', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(100, '2022-07-31 20:23:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(101, '2022-07-31 20:26:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(102, '2022-07-31 20:29:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(103, '2022-07-31 20:32:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(104, '2022-07-31 20:34:06', 'Visualizo el listado de solicitud', 1),
(105, '2022-07-31 20:34:17', 'Visualizo el listado de asignaciones', 1),
(106, '2022-07-31 20:34:23', 'Visualizo el listado de asignaciones', 1),
(107, '2022-07-31 20:34:26', 'Visualizo el listado de asignaciones', 1),
(108, '2022-07-31 20:34:29', 'Visualizo el listado de asignaciones', 1),
(109, '2022-07-31 20:34:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(110, '2022-07-31 20:34:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(111, '2022-07-31 20:35:08', 'Actualizo la siguiente solicitud: probando otra soliciutd', 1),
(112, '2022-07-31 20:35:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(113, '2022-07-31 20:35:13', 'Visualizo el listado de solicitud', 1),
(114, '2022-07-31 20:35:50', 'Creacion de nueva asignacion: realizar tarea', 1),
(115, '2022-07-31 20:35:50', 'Visualizo el listado de solicitud', 1),
(116, '2022-07-31 20:35:54', 'Visualizo el listado de asignaciones', 1),
(117, '2022-07-31 20:36:07', 'Creacion de nuevo paso procesado: tarea realizada', 1),
(118, '2022-07-31 20:36:13', 'Asignacion finalizada: 1', 1),
(119, '2022-07-31 20:36:14', 'Visualizo el listado de asignaciones', 1),
(120, '2022-07-31 20:43:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(121, '2022-07-31 21:03:28', 'Creacion de nueva actividad: examen de laboratorio', 1),
(122, '2022-07-31 21:03:50', 'Creacion de nueva actividad: estudio especializado', 1),
(123, '2022-07-31 21:04:19', 'Creacion de un nuevo paso: descripcion tarea', 1),
(124, '2022-07-31 21:04:34', 'Creacion de un nuevo paso: descripcion examen', 1),
(125, '2022-07-31 21:04:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(126, '2022-07-31 21:14:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(127, '2022-07-31 21:14:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(128, '2022-07-31 21:15:10', 'Creacion de nuevo sector: valle soledad', 1),
(129, '2022-07-31 21:15:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(130, '2022-07-31 21:16:01', 'Inicio de Sesion', 1),
(131, '2022-07-31 21:16:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(132, '2022-07-31 21:16:13', 'Actualizo la siguiente solicitud: examenes de laboratorio', 1),
(133, '2022-07-31 21:16:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(134, '2022-07-31 21:16:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(135, '2022-07-31 21:16:38', 'Visualizo el listado de solicitud', 1),
(136, '2022-07-31 21:16:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(137, '2022-07-31 21:21:31', 'Creacion de nueva solicitud: REALIZANDO SOLICITUD NEW, PROBANDO DOS ACTIVIDADES EN LA MISMA SOLICITUD', 1),
(138, '2022-07-31 21:21:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(139, '2022-07-31 21:44:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(140, '2022-07-31 21:45:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(141, '2022-07-31 21:45:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(142, '2022-07-31 21:46:19', 'Creacion de nueva solicitud: solicitud para probar la fecha', 1),
(143, '2022-07-31 21:46:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(144, '2022-07-31 21:46:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(145, '2022-07-31 21:48:23', 'Actualizo la siguiente solicitud: solicitud para probar la fecha', 1),
(146, '2022-07-31 21:48:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(147, '2022-07-31 21:48:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(148, '2022-07-31 21:48:58', 'Visualizo el listado de solicitud', 1),
(149, '2022-07-31 21:49:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(150, '2022-07-31 21:49:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(151, '2022-07-31 21:49:41', 'Visualizo el listado de solicitud', 1),
(152, '2022-07-31 21:50:11', 'Creacion de nueva asignacion: operador probar la fecha', 1),
(153, '2022-07-31 21:50:11', 'Visualizo el listado de solicitud', 1),
(154, '2022-07-31 21:50:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(155, '2022-07-31 21:50:33', 'Visualizo el listado de asignaciones', 1),
(156, '2022-07-31 21:52:22', 'Creacion de nuevo paso procesado: finalizar actividad para probar la fecha', 1),
(157, '2022-07-31 21:52:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(158, '2022-07-31 21:53:53', 'Asignacion finalizada: 11', 1),
(159, '2022-07-31 21:54:40', 'Visualizo el listado de asignaciones', 1),
(160, '2022-07-31 21:54:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(161, '2022-07-31 21:55:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(162, '2022-07-31 21:56:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(163, '2022-07-31 21:56:39', 'Creacion de nueva solicitud: probando fecha final', 1),
(164, '2022-07-31 21:56:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(165, '2022-07-31 21:57:18', 'Actualizo la siguiente solicitud: probando fecha final', 1),
(166, '2022-07-31 21:57:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(167, '2022-07-31 21:57:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(168, '2022-07-31 21:57:45', 'Visualizo el listado de solicitud', 1),
(169, '2022-07-31 21:58:08', 'Creacion de nueva asignacion: probando fecha final', 1),
(170, '2022-07-31 21:58:08', 'Visualizo el listado de solicitud', 1),
(171, '2022-07-31 21:58:12', 'Visualizo el listado de asignaciones', 1),
(172, '2022-07-31 21:58:46', 'Creacion de nuevo paso procesado: resolviendo fecha final', 1),
(173, '2022-07-31 22:27:23', 'Asignacion finalizada: 13', 1),
(174, '2022-07-31 22:27:24', 'Visualizo el listado de asignaciones', 1),
(175, '2022-07-31 22:27:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(176, '2022-07-31 22:30:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(177, '2022-07-31 22:33:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(178, '2022-07-31 22:34:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(179, '2022-07-31 22:34:22', 'Actualizo la siguiente solicitud: probando solicitud el mes de mayo', 1),
(180, '2022-07-31 22:34:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(181, '2022-07-31 22:34:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(182, '2022-07-31 22:34:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(183, '2022-07-31 22:34:55', 'Visualizo el listado de solicitud', 1),
(184, '2022-07-31 22:35:33', 'Creacion de nueva asignacion: probando el mes de mayo', 1),
(185, '2022-07-31 22:35:33', 'Visualizo el listado de solicitud', 1),
(186, '2022-07-31 22:35:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(187, '2022-07-31 22:36:11', 'Visualizo el listado de solicitud', 1),
(188, '2022-07-31 22:36:26', 'Visualizo el listado de asignaciones', 1),
(189, '2022-07-31 22:36:52', 'Creacion de nuevo paso procesado: proban mes de mayo', 1),
(190, '2022-07-31 22:37:06', 'Asignacion finalizada: 14', 1),
(191, '2022-07-31 22:37:22', 'Visualizo el listado de asignaciones', 1),
(192, '2022-07-31 22:37:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(193, '2022-07-31 22:52:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(194, '2022-07-31 23:02:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(195, '2022-07-31 23:05:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(196, '2022-07-31 23:06:30', 'Visualizo el listado de asignaciones', 1),
(197, '2022-07-31 23:08:25', 'Inicio de Sesion', 10137),
(198, '2022-07-31 23:08:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(199, '2022-07-31 23:08:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(200, '2022-07-31 23:08:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(201, '2022-07-31 23:11:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(202, '2022-07-31 23:11:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(203, '2022-07-31 23:13:02', 'Inicio de Sesion', 1),
(204, '2022-07-31 23:13:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(205, '2022-07-31 23:13:52', 'Creacion de nuevo cubiculo: Cubiculo 1', 1),
(206, '2022-07-31 23:14:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(207, '2022-07-31 23:14:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(208, '2022-07-31 23:17:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(209, '2022-07-31 23:17:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(210, '2022-07-31 23:20:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(211, '2022-07-31 23:20:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(212, '2022-07-31 23:23:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(213, '2022-07-31 23:23:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(214, '2022-07-31 23:26:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(215, '2022-07-31 23:26:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(216, '2022-07-31 23:29:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(217, '2022-07-31 23:29:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(218, '2022-07-31 23:31:19', 'Inicio de Sesion', 10137),
(219, '2022-07-31 23:31:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(220, '2022-07-31 23:31:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(221, '2022-07-31 23:32:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(222, '2022-07-31 23:34:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(223, '2022-07-31 23:35:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(224, '2022-07-31 23:37:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(225, '2022-07-31 23:40:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(226, '2022-07-31 23:43:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(227, '2022-07-31 23:46:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(228, '2022-07-31 23:49:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(229, '2022-07-31 23:50:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(230, '2022-07-31 23:50:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(231, '2022-07-31 23:52:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(232, '2022-07-31 23:53:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(233, '2022-07-31 23:55:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(234, '2022-07-31 23:56:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(235, '2022-07-31 23:59:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(236, '2022-08-01 00:00:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10137),
(237, '2022-08-01 00:45:56', 'Inicio de Sesion', 1),
(238, '2022-08-01 00:45:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(239, '2022-08-01 00:46:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(240, '2022-08-01 00:48:01', 'Inicio de Sesion', 1),
(241, '2022-08-01 00:48:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(242, '2022-08-01 00:48:34', 'Creacion de nueva solicitud: primera actividad enero', 1),
(243, '2022-08-01 00:49:13', 'Creacion de nueva solicitud: segundo solicitud prueba', 1),
(244, '2022-08-01 00:49:36', 'Creacion de nueva solicitud: tercero febrero', 1),
(245, '2022-08-01 00:49:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(246, '2022-08-01 00:50:11', 'Creacion de nueva solicitud: cuarto prueba febrero', 1),
(247, '2022-08-01 00:50:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(248, '2022-08-01 00:50:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(249, '2022-08-01 00:51:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(250, '2022-08-01 00:52:03', 'Actualizo la siguiente solicitud: cuarto prueba febrero', 1),
(251, '2022-08-01 00:52:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(252, '2022-08-01 00:52:32', 'Actualizo la siguiente solicitud: tercero febrero', 1),
(253, '2022-08-01 00:52:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(254, '2022-08-01 00:52:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(255, '2022-08-01 00:52:59', 'Actualizo la siguiente solicitud: segundo solicitud prueba', 1),
(256, '2022-08-01 00:53:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(257, '2022-08-01 00:53:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(258, '2022-08-01 00:53:21', 'Visualizo el listado de solicitud', 1),
(259, '2022-08-01 00:53:43', 'Creacion de nueva asignacion: primera prueba', 1),
(260, '2022-08-01 00:53:43', 'Visualizo el listado de solicitud', 1),
(261, '2022-08-01 00:54:07', 'Creacion de nueva asignacion: usuario pruieba febrero', 1),
(262, '2022-08-01 00:54:07', 'Visualizo el listado de solicitud', 1),
(263, '2022-08-01 00:54:32', 'Creacion de nueva asignacion: tercera pruena', 1),
(264, '2022-08-01 00:54:32', 'Visualizo el listado de solicitud', 1),
(265, '2022-08-01 00:54:37', 'Visualizo el listado de asignaciones', 1),
(266, '2022-08-01 00:55:07', 'Creacion de nuevo paso procesado: probar', 1),
(267, '2022-08-01 00:55:21', 'Asignacion finalizada: 20', 1),
(268, '2022-08-01 00:55:22', 'Visualizo el listado de asignaciones', 1),
(269, '2022-08-01 00:55:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(270, '2022-08-01 00:55:40', 'Visualizo el listado de asignaciones', 1),
(271, '2022-08-01 00:55:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(272, '2022-08-01 00:56:08', 'Creacion de nuevo paso procesado: tercera febrero', 1),
(273, '2022-08-01 00:56:18', 'Asignacion finalizada: 19', 1),
(274, '2022-08-01 00:56:19', 'Visualizo el listado de asignaciones', 1),
(275, '2022-08-01 00:56:45', 'Creacion de nuevo paso procesado: tercera', 1),
(276, '2022-08-01 00:56:59', 'Asignacion finalizada: 21', 1),
(277, '2022-08-01 00:57:23', 'Visualizo el listado de asignaciones', 1),
(278, '2022-08-01 00:57:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(279, '2022-08-01 00:58:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(280, '2022-08-01 01:01:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cargo_id` int(11) NOT NULL,
  `cargo_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cargo_id`, `cargo_nombre`, `direccion_id`) VALUES
(1, 'USUARIO DEL SISTEMA', 4),
(2, 'USUARIO DEL SISTEMA', 11),
(3, 'USUARIO DEL SISTEMA', 10),
(4, 'USUARIO DEL SISTEMA', 7),
(5, 'USUARIO DEL SISTEMA', 1),
(6, 'USUARIO DEL SISTEMA', 8),
(7, 'USUARIO DEL SISTEMA', 6),
(8, 'USUARIO DEL SISTEMA', 5),
(9, 'USUARIO DEL SISTEMA', 18),
(10, 'USUARIO DEL SISTEMA', 40),
(11, 'USUARIO DEL SISTEMA', 29),
(12, 'USUARIO DEL SISTEMA', 17),
(13, 'USUARIO DEL SISTEMA', 32),
(14, 'USUARIO DEL SISTEMA', 36),
(15, 'USUARIO DEL SISTEMA', 30),
(16, 'USUARIO DEL SISTEMA', 31),
(17, 'USUARIO DEL SISTEMA', 20),
(18, 'USUARIO DEL SISTEMA', 28),
(19, 'USUARIO DEL SISTEMA', 3),
(20, 'USUARIO DEL SISTEMA', 15),
(21, 'USUARIO DEL SISTEMA', 25),
(22, 'USUARIO DEL SISTEMA', 2),
(23, 'USUARIO DEL SISTEMA', 38),
(24, 'USUARIO DEL SISTEMA', 37),
(25, 'USUARIO DEL SISTEMA', 9),
(26, 'USUARIO DEL SISTEMA', 13),
(27, 'USUARIO DEL SISTEMA', 12),
(28, 'USUARIO DEL SISTEMA', 27),
(29, 'USUARIO DEL SISTEMA', 35),
(30, 'USUARIO DEL SISTEMA', 16),
(31, 'USUARIO DEL SISTEMA', 23),
(32, 'USUARIO DEL SISTEMA', 19),
(33, 'USUARIO DEL SISTEMA', 21),
(34, 'USUARIO DEL SISTEMA', 22),
(35, 'USUARIO DEL SISTEMA', 14),
(36, 'USUARIO DEL SISTEMA', 34),
(37, 'USUARIO DEL SISTEMA', 26),
(38, 'USUARIO DEL SISTEMA', 24),
(39, 'USUARIO DEL SISTEMA', 33),
(40, 'USUARIO DEL SISTEMA', 41),
(41, 'USUARIO DEL SISTEMA', 42),
(42, 'USUARIO DEL SISTEMA', 43),
(43, 'USUARIO DEL SISTEMA', 44),
(44, 'ArcidesI', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_descripcion`) VALUES
(1, 'categoria 1', 'categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `configuracion_id` int(11) NOT NULL,
  `configuracion_descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `configuracion_valor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`configuracion_id`, `configuracion_descripcion`, `configuracion_valor`) VALUES
(1, 'encuesta seleccionada', '6'),
(4, 'mes grafica', '07'),
(5, 'extension_permitida', 'jpg, JPG, png, PNG, jpeg, JPEG'),
(6, 'size_permitido', '1024000'),
(8, 'extension_pago', 'pdf, PDF'),
(9, 'torneo_seleccionado', '1'),
(10, 'top_jugador_equipo', '14'),
(12, 'total_solicitud_diaria', '300'),
(13, 'total_solicitud_diaria_ciudadano', '3'),
(14, 'total_home_mostrar', '21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cubiculo`
--

CREATE TABLE `cubiculo` (
  `cubiculo_id` int(11) NOT NULL,
  `cubiculo_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cubiculo`
--

INSERT INTO `cubiculo` (`cubiculo_id`, `cubiculo_nombre`, `usuario_id`) VALUES
(1, 'Cubiculo 1', 10137);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `direccion_id` int(11) NOT NULL,
  `direccion_nombre` varchar(300) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion_imagen` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `gabinete_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`direccion_id`, `direccion_nombre`, `direccion_imagen`, `gabinete_id`) VALUES
(1, 'Automatizacion, Informatica y Telecomunicaciones', 'default.jpg', 2),
(2, 'Planificacion y Desarrollo', 'default.jpg', 2),
(3, 'Presupuesto', 'default.jpg', 2),
(4, 'Administracion y Finanzas', 'default.jpg', 2),
(5, 'Educacion', 'default.jpg', 1),
(6, 'Talento Humano', 'default.jpg', 2),
(7, 'Auditoria Interna', 'default.jpg', 2),
(8, 'Bienes Publicos', 'default.jpg', 2),
(9, 'Misiones Sociales (Dimisoc)', 'default.jpg', 1),
(10, 'Atencion al Ciudadano', 'default.jpg', 1),
(11, 'Archivo General de Gobierno', 'default.jpg', 2),
(12, 'Cultura', 'default.jpg', 1),
(13, 'Juventud', 'default.jpg', 1),
(14, 'Instituto Anzoatiguense de la salud (SALUDANZ)', 'default.jpg', 1),
(15, 'Policía del estado Anzoátegui (Polianzoátegui)', 'default.jpg', 3),
(16, 'Instituto Estadal de la mujer (IEMA)', 'default.jpg', 1),
(17, 'Sistema Integrado de Gestión de Riesgo y Administración de Emergencias de Carácter Civil y Desastres del estado Anzoátegui (Sigraed)', 'default.jpg', 3),
(18, 'Bomberos de Anzoátegui', 'default.jpg', 3),
(19, 'Instituto de Deporte y Actividad Física (IDANZ)', 'default.jpg', 1),
(20, 'Protección Civil', 'default.jpg', 3),
(21, 'Instituto Autónomo de la Secretaría de los Pueblos Indígenas (IASPI)', 'default.jpg', 1),
(22, 'Dirección de Seguridad Ciudadana', 'default.jpg', 3),
(23, 'Dirección de Salud Pública', 'default.jpg', 1),
(24, 'Fondo Administrado de Salud para la Gobernación del Estado Anzoátegui (FASGANZ)', 'default.jpg', 1),
(25, 'Corporación de Vialidad e Infraestructura Gobernación del Estado Anzoátegui (COVINEA)', 'default.jpg', 5),
(26, 'Empresa de Gestión Integral de Desechos Sólidos de Anzoátegui (EGIDSA)', 'default.jpg', 5),
(27, 'Instituto Socialista del Transporte del estado Anzoátegui (INSOTRANZ)', 'default.jpg', 5),
(28, 'Corporación de Turismo del estado Anzoátegui (CORANZTUR)', 'default.jpg', 6),
(29, 'Corporación Avícola del estado Anzoátegui (CORPOVANZ)', 'default.jpg', 6),
(30, 'Secretaría de Vivienda de la Gobernación del Estado Anzoátegui (Sevigea)', 'default.jpg', 5),
(31, 'Corporación de Minas del estado Anzoátegui (CORPOMINAS)', 'default.jpg', 6),
(32, 'Corporación Caupolicán Ovalles CAUPOCA', 'default.jpg', 5),
(33, 'EPS Viviendas de Mi Patria Querida', 'default.jpg', 5),
(34, 'Fondo de Economía Popular del estado Anzoátegui (FONDEPANZ)', 'default.jpg', 6),
(35, 'Dirección de Comunas y Poder Popular', 'default.jpg', 4),
(36, 'Servicio de Administración Tributaria del Estado Anzoátegui (SATEA)', 'default.jpg', 6),
(37, 'Corporación Regional De Abastecimiento Del Estado Anzoátegui (CREANZ)', 'default.jpg', 6),
(38, 'Corporación para el Desarrollo Rural Sustentable de Anzoátegui (CORDAGRO)', 'default.jpg', 6),
(39, 'Corporación de Pesca (COPESCA)', 'default.jpg', 6),
(40, 'Sociedad de Garantía Recíprocas', 'default.jpg', 6),
(41, 'Direccion de Comunicaciones', 'default.jpg', 2),
(42, 'Despacho del Gobernador', 'default.jpg', 2),
(43, 'Secretaria General de Gobierno', 'default.jpg', 2),
(44, 'Consultoria Juridica', 'default.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_actividad`
--

CREATE TABLE `equipo_actividad` (
  `equipo_actividad_id` int(11) NOT NULL,
  `sol_act_id` int(11) NOT NULL,
  `producto_codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `feedback_descripcion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `feedback_tiempo_respuesta` int(11) NOT NULL,
  `feedback_tipo_solucion` int(11) NOT NULL,
  `feedback_fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gabinete`
--

CREATE TABLE `gabinete` (
  `gabinete_id` int(11) NOT NULL,
  `gabinete_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `gabinete`
--

INSERT INTO `gabinete` (`gabinete_id`, `gabinete_nombre`) VALUES
(1, 'Gestion Social'),
(2, 'Gestion Interna'),
(3, 'Seguridad Ciudadana'),
(4, 'Organizacion Ciudadana y Comunal'),
(5, 'Servicios Publicos'),
(6, 'Economico y Productivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grafica_solicitud`
--

CREATE TABLE `grafica_solicitud` (
  `grafica_solicitud_id` int(11) NOT NULL,
  `grafica_solicitud_year` int(11) NOT NULL,
  `grafica_solicitud_mes_id` int(11) NOT NULL,
  `grafica_solicitud_solicitadas` int(11) NOT NULL,
  `grafica_solicitud_finalizadas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `grafica_solicitud`
--

INSERT INTO `grafica_solicitud` (`grafica_solicitud_id`, `grafica_solicitud_year`, `grafica_solicitud_mes_id`, `grafica_solicitud_solicitadas`, `grafica_solicitud_finalizadas`) VALUES
(1, 2022, 1, 0, 0),
(2, 2022, 2, 3, 2),
(3, 2022, 3, 0, 1),
(4, 2022, 4, 2, 1),
(5, 2022, 5, 1, 1),
(6, 2022, 6, 0, 0),
(7, 2022, 7, 7, 2),
(8, 2022, 8, 0, 0),
(9, 2022, 9, 0, 0),
(10, 2022, 10, 0, 0),
(11, 2022, 11, 0, 0),
(12, 2022, 12, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_actividad`
--

CREATE TABLE `home_actividad` (
  `home_actividad_id` int(11) NOT NULL,
  `home_actividad_year` int(11) NOT NULL,
  `home_actividad_cantidad` int(11) NOT NULL,
  `home_actividad_porcentaje` decimal(25,2) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `actividad_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `home_actividad`
--

INSERT INTO `home_actividad` (`home_actividad_id`, `home_actividad_year`, `home_actividad_cantidad`, `home_actividad_porcentaje`, `actividad_id`, `actividad_nombre`) VALUES
(1, 2022, 6, '46.15', 1, 'primera actividad'),
(2, 2022, 5, '38.46', 2, 'examen de laboratorio'),
(3, 2022, 2, '15.38', 3, 'estudio especializado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_direccion`
--

CREATE TABLE `home_direccion` (
  `home_direccion_id` int(11) NOT NULL,
  `home_direccion_year` int(11) NOT NULL,
  `home_direccion_cantidad` int(11) NOT NULL,
  `home_direccion_porcentaje` decimal(25,2) NOT NULL,
  `direccion_id` int(11) NOT NULL,
  `direccion_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `home_direccion`
--

INSERT INTO `home_direccion` (`home_direccion_id`, `home_direccion_year`, `home_direccion_cantidad`, `home_direccion_porcentaje`, `direccion_id`, `direccion_nombre`) VALUES
(1, 2022, 0, '0.00', 1, 'Automatizacion, Informatica y Telecomunicaciones'),
(2, 2022, 1, '7.69', 2, 'Planificacion y Desarrollo'),
(3, 2022, 1, '7.69', 3, 'Presupuesto'),
(4, 2022, 1, '7.69', 4, 'Administracion y Finanzas'),
(5, 2022, 0, '0.00', 5, 'Educacion'),
(6, 2022, 1, '7.69', 6, 'Talento Humano'),
(7, 2022, 0, '0.00', 7, 'Auditoria Interna'),
(8, 2022, 0, '0.00', 8, 'Bienes Publicos'),
(9, 2022, 0, '0.00', 9, 'Misiones Sociales (Dimisoc)'),
(10, 2022, 3, '23.08', 10, 'Atencion al Ciudadano'),
(11, 2022, 0, '0.00', 11, 'Archivo General de Gobierno'),
(12, 2022, 0, '0.00', 12, 'Cultura'),
(13, 2022, 0, '0.00', 13, 'Juventud'),
(14, 2022, 0, '0.00', 14, 'Instituto Anzoatiguense de la salud (SALUDANZ)'),
(15, 2022, 0, '0.00', 15, 'Policía del estado Anzoátegui (Polianzoátegui)'),
(16, 2022, 0, '0.00', 16, 'Instituto Estadal de la mujer (IEMA)'),
(17, 2022, 0, '0.00', 17, 'Sistema Integrado de Gestión de Riesgo y Administración de Emergencias de Carácter Civil y Desastres del estado Anzoátegui (Sigraed)'),
(18, 2022, 0, '0.00', 18, 'Bomberos de Anzoátegui'),
(19, 2022, 2, '15.38', 19, 'Instituto de Deporte y Actividad Física (IDANZ)'),
(20, 2022, 0, '0.00', 20, 'Protección Civil'),
(21, 2022, 0, '0.00', 21, 'Instituto Autónomo de la Secretaría de los Pueblos Indígenas (IASPI)'),
(22, 2022, 0, '0.00', 22, 'Dirección de Seguridad Ciudadana'),
(23, 2022, 0, '0.00', 23, 'Dirección de Salud Pública'),
(24, 2022, 0, '0.00', 24, 'Fondo Administrado de Salud para la Gobernación del Estado Anzoátegui (FASGANZ)'),
(25, 2022, 0, '0.00', 25, 'Corporación de Vialidad e Infraestructura Gobernación del Estado Anzoátegui (COVINEA)'),
(26, 2022, 0, '0.00', 26, 'Empresa de Gestión Integral de Desechos Sólidos de Anzoátegui (EGIDSA)'),
(27, 2022, 0, '0.00', 27, 'Instituto Socialista del Transporte del estado Anzoátegui (INSOTRANZ)'),
(28, 2022, 1, '7.69', 28, 'Corporación de Turismo del estado Anzoátegui (CORANZTUR)'),
(29, 2022, 1, '7.69', 29, 'Corporación Avícola del estado Anzoátegui (CORPOVANZ)'),
(30, 2022, 0, '0.00', 30, 'Secretaría de Vivienda de la Gobernación del Estado Anzoátegui (Sevigea)'),
(31, 2022, 1, '7.69', 31, 'Corporación de Minas del estado Anzoátegui (CORPOMINAS)'),
(32, 2022, 0, '0.00', 32, 'Corporación Caupolicán Ovalles CAUPOCA'),
(33, 2022, 0, '0.00', 33, 'EPS Viviendas de Mi Patria Querida'),
(34, 2022, 0, '0.00', 34, 'Fondo de Economía Popular del estado Anzoátegui (FONDEPANZ)'),
(35, 2022, 0, '0.00', 35, 'Dirección de Comunas y Poder Popular'),
(36, 2022, 0, '0.00', 36, 'Servicio de Administración Tributaria del Estado Anzoátegui (SATEA)'),
(37, 2022, 0, '0.00', 37, 'Corporación Regional De Abastecimiento Del Estado Anzoátegui (CREANZ)'),
(38, 2022, 0, '0.00', 38, 'Corporación para el Desarrollo Rural Sustentable de Anzoátegui (CORDAGRO)'),
(39, 2022, 0, '0.00', 39, 'Corporación de Pesca (COPESCA)'),
(40, 2022, 0, '0.00', 40, 'Sociedad de Garantía Recíprocas'),
(41, 2022, 1, '7.69', 41, 'Direccion de Comunicaciones'),
(42, 2022, 0, '0.00', 42, 'Despacho del Gobernador'),
(43, 2022, 0, '0.00', 43, 'Secretaria General de Gobierno'),
(44, 2022, 0, '0.00', 44, 'Consultoria Juridica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_feedback`
--

CREATE TABLE `home_feedback` (
  `home_id` int(11) NOT NULL,
  `home_year` int(11) NOT NULL,
  `porcentaje_tr_malo` decimal(25,2) NOT NULL,
  `porcentaje_tr_regular` decimal(25,2) NOT NULL,
  `porcentaje_tr_normal` decimal(25,2) NOT NULL,
  `porcentaje_tr_bueno` decimal(25,2) NOT NULL,
  `porcentaje_ts_malo` decimal(25,2) NOT NULL,
  `porcentaje_ts_regular` decimal(25,2) NOT NULL,
  `porcentaje_ts_normal` decimal(25,2) NOT NULL,
  `porcentaje_ts_bueno` decimal(25,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_gabinete`
--

CREATE TABLE `home_gabinete` (
  `home_gabinete_id` int(11) NOT NULL,
  `home_gabinete_year` int(11) NOT NULL,
  `home_gabinete_cantidad` int(11) NOT NULL,
  `home_gabinete_porcentaje` decimal(25,2) NOT NULL,
  `gabinete_id` int(11) NOT NULL,
  `gabinete_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `home_gabinete`
--

INSERT INTO `home_gabinete` (`home_gabinete_id`, `home_gabinete_year`, `home_gabinete_cantidad`, `home_gabinete_porcentaje`, `gabinete_id`, `gabinete_nombre`) VALUES
(1, 2022, 5, '38.46', 1, 'Gestion Social'),
(2, 2022, 5, '38.46', 2, 'Gestion Interna'),
(3, 2022, 0, '0.00', 3, 'Seguridad Ciudadana'),
(4, 2022, 0, '0.00', 4, 'Organizacion Ciudadana y Comunal'),
(5, 2022, 0, '0.00', 5, 'Servicios Publicos'),
(6, 2022, 3, '23.08', 6, 'Economico y Productivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_indicador`
--

CREATE TABLE `home_indicador` (
  `home_indicador_id` int(11) NOT NULL,
  `home_indicador_year` int(11) NOT NULL,
  `home_indicador_cantidad` int(11) NOT NULL,
  `home_indicador_porcentaje` decimal(25,2) NOT NULL,
  `indicador_id` int(11) NOT NULL,
  `indicador_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `home_indicador`
--

INSERT INTO `home_indicador` (`home_indicador_id`, `home_indicador_year`, `home_indicador_cantidad`, `home_indicador_porcentaje`, `indicador_id`, `indicador_nombre`) VALUES
(1, 2022, 13, '100.00', 1, 'primer indicador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_operador`
--

CREATE TABLE `home_operador` (
  `home_operador_id` int(11) NOT NULL,
  `home_operador_year` int(11) NOT NULL,
  `home_operador_cantidad_anual` int(11) NOT NULL,
  `home_operador_porcentaje_anual` decimal(25,2) NOT NULL,
  `home_operador_cantidad_mensual` int(11) NOT NULL,
  `home_operador_porcentaje_mensual` decimal(25,2) NOT NULL,
  `home_operador_cantidad_diario` int(11) NOT NULL,
  `home_operador_porcentaje_diario` decimal(25,2) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_imagen` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `home_operador_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `home_operador`
--

INSERT INTO `home_operador` (`home_operador_id`, `home_operador_year`, `home_operador_cantidad_anual`, `home_operador_porcentaje_anual`, `home_operador_cantidad_mensual`, `home_operador_porcentaje_mensual`, `home_operador_cantidad_diario`, `home_operador_porcentaje_diario`, `usuario_id`, `usuario_nombre`, `usuario_imagen`, `home_operador_fecha`) VALUES
(1, 2022, 7, '100.03', 1, '14.29', 2, '28.58', 10137, 'Duryenis, Brito', '1659184401 perfil002.png', '2022-03-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `imagen_id` int(11) NOT NULL,
  `asignacion_id` int(11) NOT NULL,
  `imagen_nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`imagen_id`, `asignacion_id`, `imagen_nombre`) VALUES
(1, 1, '1657557140 impresora.png'),
(2, 120, '1658975451 laptop.PNG'),
(3, 120, '1658975462 salon eventos ultra.png'),
(4, 121, '1658976144 002buengobierno.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE `indicador` (
  `indicador_id` int(11) NOT NULL,
  `indicador_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`indicador_id`, `indicador_nombre`) VALUES
(1, 'primer indicador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kategoria`
--

CREATE TABLE `kategoria` (
  `kategoria_id` int(7) NOT NULL,
  `kategoria_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `kategoria_ubicacion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `kategoria`
--

INSERT INTO `kategoria` (`kategoria_id`, `kategoria_nombre`, `kategoria_ubicacion`) VALUES
(2, 'Impresoras', ''),
(7, 'Computacion', ''),
(9, 'informaticos', 'sede gobernacion'),
(10, 'telematicos', 'direccion ait'),
(11, 'informaticos y eletrocnicos', 'tecnologia piso tres'),
(12, 'softaware', 'edif sede');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapa`
--

CREATE TABLE `mapa` (
  `mapa_id` int(11) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `municipio_nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `mapa_cantidad` int(11) NOT NULL,
  `mapa_porcentaje` decimal(25,2) NOT NULL,
  `mapa_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mapa`
--

INSERT INTO `mapa` (`mapa_id`, `municipio_id`, `municipio_nombre`, `mapa_cantidad`, `mapa_porcentaje`, `mapa_year`) VALUES
(1, 1, 'Anaco', 0, '0.00', 2022),
(2, 2, 'Aragua', 0, '0.00', 2022),
(3, 3, 'Sotillo', 0, '0.00', 2022),
(4, 4, 'Bolivar', 11, '84.62', 2022),
(5, 5, 'Bruzual', 0, '0.00', 2022),
(6, 6, 'Cajigal', 0, '0.00', 2022),
(7, 7, 'Carvajal', 0, '0.00', 2022),
(8, 8, 'Urbaneja', 0, '0.00', 2022),
(9, 9, 'Freites', 0, '0.00', 2022),
(10, 10, 'Guanipa', 0, '0.00', 2022),
(11, 11, 'Guanta', 0, '0.00', 2022),
(12, 12, 'Independencia', 2, '15.38', 2022),
(13, 13, 'Libertad', 0, '0.00', 2022),
(14, 14, 'Mcgregor', 0, '0.00', 2022),
(15, 15, 'Miranda', 0, '0.00', 2022),
(16, 16, 'Monagas', 0, '0.00', 2022),
(17, 17, 'Penalver', 0, '0.00', 2022),
(18, 18, 'Piritu', 0, '0.00', 2022),
(19, 19, 'Capistrano', 0, '0.00', 2022),
(20, 20, 'Santa_Ana', 0, '0.00', 2022),
(21, 21, 'Simon_Rodriguez', 0, '0.00', 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `multimedia_id` int(11) NOT NULL,
  `multimedia_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `multimedia_archivo` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `multimedia_extension` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `municipio_id` int(11) NOT NULL,
  `municipio_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`municipio_id`, `municipio_nombre`) VALUES
(1, 'Anaco'),
(2, 'Aragua'),
(3, 'Sotillo'),
(4, 'Bolivar'),
(5, 'Bruzual'),
(6, 'Cajigal'),
(7, 'Carvajal'),
(8, 'Urbaneja'),
(9, 'Freites'),
(10, 'Guanipa'),
(11, 'Guanta'),
(12, 'Independencia'),
(13, 'Libertad'),
(14, 'McGregor'),
(15, 'Miranda'),
(16, 'Monagas'),
(17, 'Peñalver'),
(18, 'Piritu'),
(19, 'San Juan de Capistrano'),
(20, 'Santa Ana'),
(21, 'Simon Rodriguez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `parroquia_id` int(11) NOT NULL,
  `parroquia_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `municipio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`parroquia_id`, `parroquia_nombre`, `municipio_id`) VALUES
(1, 'Anaco', 1),
(2, 'San Juaquin', 1),
(3, 'Buena Vista', 1),
(4, 'Cachipo', 2),
(5, 'Aragua de Barcelona', 2),
(6, 'Lecheria', 8),
(7, 'El Morro', 8),
(8, 'Puerto Piritu', 17),
(9, 'San Miguel', 17),
(10, 'Sucre', 17),
(11, 'Valle de Guanape', 7),
(12, 'Santa Barbara', 7),
(13, 'Atapirire', 15),
(14, 'Boca del Pao', 15),
(15, 'El Pao', 15),
(16, 'Pariaguan', 15),
(17, 'San Jose de Guanipa', 10),
(18, 'Guanta', 11),
(19, 'Chorreron', 11),
(20, 'Mamo', 12),
(21, 'Soledad', 12),
(22, 'Mapire', 16),
(23, 'Piar', 16),
(24, 'Santa Clara', 16),
(25, 'San Diego de Cabrutica', 16),
(26, 'Uverito', 16),
(27, 'Zuata', 16),
(28, 'Puerto La Cruz', 3),
(29, 'Pozuelos', 3),
(30, 'Onoto', 6),
(31, 'San Pablo', 6),
(32, 'San Mateo', 13),
(33, 'El Carito', 13),
(34, 'Santa Inés', 13),
(35, 'Clarines', 5),
(36, 'Guanape', 5),
(37, 'Sabana de Uchire', 5),
(38, 'Cantaura', 9),
(39, 'Libertador', 9),
(40, 'Santa Rosa', 9),
(41, 'Urica', 9),
(42, 'Píritu', 18),
(43, 'San Francisco', 18),
(44, 'Boca de Uchire', 19),
(45, 'Boca de Chávez', 19),
(46, 'Pueblo Nuevo', 20),
(47, 'Santa Ana', 20),
(48, 'Bergantín', 4),
(49, 'Caigua', 4),
(50, 'El Carmen', 4),
(51, 'El Pilar', 4),
(52, 'Naricual', 4),
(53, 'San Cristóbal', 4),
(54, 'Edmundo Barrios', 21),
(55, 'Miguel Otero Silva', 21),
(56, 'El Chaparro', 14),
(57, 'Tomás Alfaro Calatrava', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paso`
--

CREATE TABLE `paso` (
  `paso_id` int(11) NOT NULL,
  `paso_nombre` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `paso_duracion` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `paso`
--

INSERT INTO `paso` (`paso_id`, `paso_nombre`, `paso_duracion`, `actividad_id`) VALUES
(1, 'descripcion', 15, 1),
(2, 'descripcion tarea', 10, 3),
(3, 'descripcion examen', 12, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdf`
--

CREATE TABLE `pdf` (
  `pdf_id` int(11) NOT NULL,
  `asignacion_id` int(11) NOT NULL,
  `pdf_archivo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pdf`
--

INSERT INTO `pdf` (`pdf_id`, `asignacion_id`, `pdf_archivo`) VALUES
(2, 120, '1658975476 cedula rif elias jesus.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesar`
--

CREATE TABLE `procesar` (
  `procesar_id` int(11) NOT NULL,
  `asignacion_id` int(11) NOT NULL,
  `paso_id` int(11) NOT NULL,
  `procesar_observacion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `procesar`
--

INSERT INTO `procesar` (`procesar_id`, `asignacion_id`, `paso_id`, `procesar_observacion`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 1, 1, 'tarea realizada', '2022-07-31 20:36:07', '2022-07-31 20:36:07'),
(2, 2, 3, 'finalizar actividad para probar la fecha', '2022-04-15 21:52:22', '2022-04-16 21:52:22'),
(3, 3, 2, 'resolviendo fecha final', '2022-04-14 21:58:46', '2022-04-14 21:58:46'),
(4, 4, 3, 'proban mes de mayo', '2022-05-12 22:36:52', '2022-05-12 22:36:52'),
(5, 6, 3, 'probar', '2022-02-10 00:55:07', '2022-02-10 00:55:07'),
(6, 7, 3, 'tercera febrero', '2022-02-11 00:56:08', '2022-02-11 00:56:08'),
(7, 5, 2, 'tercera', '2022-02-11 00:56:45', '2022-02-11 00:56:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL,
  `producto_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_nombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_unidad` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_precio` decimal(30,2) NOT NULL,
  `producto_stock` decimal(30,2) NOT NULL,
  `producto_foto` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `kategoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `sector_id` int(11) NOT NULL,
  `sector_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `parroquia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_nombre`, `parroquia_id`) VALUES
(1, 'Edificio sede Gobernacion Anzoategui', 50),
(2, 'Avenida Caracas', 50),
(3, 'Centro de Barcelona', 50),
(4, 'Complejo Deportivo General Jose Antonio Anzoategui', 28),
(5, 'Edif. Sede Covinea', 6),
(6, 'casco central', 6),
(7, 'Guayaquil', 50),
(8, 'san cristobal centro', 53),
(9, 'valle soledad', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `solicitud_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `solicitud_inicio` datetime NOT NULL,
  `solicitud_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `solicitud_descripcion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`solicitud_id`, `usuario_id`, `solicitud_inicio`, `solicitud_estado`, `solicitud_descripcion`) VALUES
(1, 10136, '2022-07-30 07:56:00', 'procesando', 'examenes de laboratorio'),
(2, 10138, '2022-07-30 16:13:33', 'sin procesar', 'nueva solicitud'),
(3, 10139, '2022-07-30 16:14:30', 'sin procesar', 'tercera soliciut'),
(4, 10140, '2022-07-30 16:15:34', 'evaluar', 'nueva solicitud de medicamentos'),
(5, 10141, '2022-07-31 12:10:33', 'procesando', 'probando otra soliciutd'),
(6, 10142, '2022-07-31 12:11:39', 'procesando', 'otra soliciutd'),
(7, 10143, '2022-07-31 13:01:07', 'procesando', 'probando la fecha de nacimiento'),
(8, 10144, '2022-07-31 13:24:35', 'procesando', 'probando el sistema'),
(9, 10138, '2022-07-31 21:21:31', 'sin procesar', 'REALIZANDO SOLICITUD NEW, PROBANDO DOS ACTIVIDADES EN LA MISMA SOLICITUD'),
(10, 10145, '2022-04-07 21:46:19', 'evaluar', 'solicitud para probar la fecha'),
(11, 10145, '2022-04-06 21:56:39', 'evaluar', 'probando fecha final'),
(12, 10146, '2022-07-31 22:33:08', 'evaluar', 'probando solicitud el mes de mayo'),
(13, 10145, '2022-08-01 00:48:34', 'sin procesar', 'primera actividad enero'),
(14, 10145, '2022-02-09 00:49:12', 'evaluar', 'segundo solicitud prueba'),
(15, 10145, '2022-02-09 00:49:36', 'evaluar', 'tercero febrero'),
(16, 10145, '2022-02-10 00:50:11', 'evaluar', 'cuarto prueba febrero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_actividad`
--

CREATE TABLE `solicitud_actividad` (
  `sol_act_id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `solicitud_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `solicitud_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `solicitud_actividad`
--

INSERT INTO `solicitud_actividad` (`sol_act_id`, `solicitud_id`, `actividad_id`, `solicitud_estado`, `solicitud_fin`) VALUES
(1, 4, 1, 'finalizado', '2022-07-31 20:36:13'),
(2, 7, 1, 'sin asignar', '0000-00-00 00:00:00'),
(3, 8, 1, 'sin asignar', '0000-00-00 00:00:00'),
(4, 6, 1, 'sin asignar', '0000-00-00 00:00:00'),
(5, 5, 1, 'sin asignar', '0000-00-00 00:00:00'),
(6, 1, 2, 'sin asignar', '0000-00-00 00:00:00'),
(7, 1, 1, 'sin asignar', '0000-00-00 00:00:00'),
(8, 9, 2, 'sin asginar', '0000-00-00 00:00:00'),
(9, 9, 1, 'sin asginar', '0000-00-00 00:00:00'),
(11, 10, 2, 'finalizado', '2022-04-16 21:53:53'),
(13, 11, 3, 'finalizado', '2022-04-15 22:27:23'),
(14, 12, 2, 'finalizado', '2022-05-12 22:37:05'),
(15, 13, 3, 'sin asginar', '0000-00-00 00:00:00'),
(19, 16, 2, 'finalizado', '2022-02-11 00:56:18'),
(20, 15, 2, 'finalizado', '2022-02-10 00:55:21'),
(21, 14, 3, 'finalizado', '2022-03-11 00:56:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_direccion`
--

CREATE TABLE `solicitud_direccion` (
  `solicitud_direccion_id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `direccion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `solicitud_direccion`
--

INSERT INTO `solicitud_direccion` (`solicitud_direccion_id`, `solicitud_id`, `direccion_id`) VALUES
(1, 4, 28),
(2, 7, 3),
(3, 8, 29),
(4, 6, 31),
(5, 5, 41),
(6, 1, 19),
(7, 10, 4),
(8, 11, 10),
(9, 12, 6),
(10, 16, 2),
(11, 15, 10),
(12, 14, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_gabinete`
--

CREATE TABLE `solicitud_gabinete` (
  `solicitud_gabinete_id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `gabinete_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `solicitud_gabinete`
--

INSERT INTO `solicitud_gabinete` (`solicitud_gabinete_id`, `solicitud_id`, `gabinete_id`) VALUES
(1, 4, 6),
(2, 7, 2),
(3, 8, 6),
(4, 6, 6),
(5, 5, 2),
(6, 1, 1),
(7, 10, 2),
(8, 11, 1),
(9, 12, 2),
(10, 16, 2),
(11, 15, 1),
(12, 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `turno_id` int(11) NOT NULL,
  `turno_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `turno_descripcion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `turno_cedula` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `turno_fecha` datetime NOT NULL,
  `turno_fecha_login` date NOT NULL,
  `turno_estado` varchar(12) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`turno_id`, `turno_nombre`, `turno_descripcion`, `turno_cedula`, `turno_fecha`, `turno_fecha_login`, `turno_estado`) VALUES
(1, 'Felipe Guerra', 'exmanes medicos', '234324234232', '2022-07-30 09:06:37', '2022-07-30', 'finalizado'),
(2, 'Felipe Antonio', 'exmanes medicos', '432443223', '2022-07-30 09:07:53', '2022-07-30', 'finalizado'),
(3, 'Fermin Toro', 'nueva descripcion', '2344324324', '2022-07-31 19:24:21', '2022-07-31', 'finalizar'),
(4, 'Maricarmen Sabino', 'descripcion de la solicitur', '3213213213', '2022-07-31 19:24:44', '2022-07-31', 'finalizar'),
(5, 'Pedro Torres', 'descripcion', '323334432', '2022-07-31 19:24:59', '2022-07-31', 'finalizado'),
(6, 'Cristina Fabiola', 'descripcion de la solicitud', '444400900', '2022-07-31 19:25:19', '2022-07-31', 'finalizar'),
(7, 'Carlos Perez', 'medicamentos', '213332198', '2022-07-31 23:06:50', '2022-07-31', 'finalizar'),
(8, 'Maria Perez', 'examen de laboratorio', '899909889', '2022-07-31 23:07:31', '2022-07-31', 'finalizar'),
(9, 'Arnol Perez', 'solicitud medicamento', '44300909', '2022-07-31 23:29:25', '2022-07-31', 'atender'),
(10, 'Fernanda Guerra', 'Examen de laboratorio', '20090903', '2022-07-31 23:29:46', '2022-07-31', 'atender'),
(11, 'Cristina Caicaguare', 'solicitud de examen laboratorio', '899909093', '2022-07-31 23:30:26', '2022-07-31', 'atender');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno_usuario`
--

CREATE TABLE `turno_usuario` (
  `turno_usuario_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `turno_usuario_mostrar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `turno_usuario`
--

INSERT INTO `turno_usuario` (`turno_usuario_id`, `turno_id`, `usuario_id`, `turno_usuario_mostrar`) VALUES
(1, 1, 10137, 0),
(2, 2, 10137, 0),
(3, 3, 1, 0),
(4, 5, 10136, 0),
(5, 6, 1, 0),
(6, 4, 10137, 1),
(7, 7, 10137, 1),
(8, 8, 10137, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_dni` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_estado` varchar(17) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_privilegio` int(2) NOT NULL,
  `usuario_imagen` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_tipo` int(2) NOT NULL,
  `usuario_genero` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_fecha_nacimiento` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_dni`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_direccion`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_estado`, `usuario_privilegio`, `usuario_imagen`, `usuario_tipo`, `usuario_genero`, `usuario_fecha_nacimiento`) VALUES
(1, '16069854', 'Julian Amado', 'Caicaguare Caicaguan', '04248630834', 'Barcelona, Estado Anzoategui', 'caicaguarec@gmail.com', 'administrador', 'QmRqMEJ1UkhIQzAzbEFOVHNZaTVJUT09', 'Activa', 1, 'avatar.jpg', 1, 'MASCULINO', '1984-02-02'),
(10136, '213321321', 'Juan Perez', '', '034256665232', 'Valle de Soledad', 'cperez@gmail.com', 'ciudadano213321321', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Activa', 3, 'default.jpg', 4, 'MASCULINO', '2007-06-12'),
(10137, '142324423', 'Duryenis', 'Brito', '04223432432', 'Lecherias', 'duryenis@gmail.com', 'duryenis', 'bkNpZ2RSMUE1aHlHTnFzb3hRVFQ0UT09', 'Activa', 1, '1659184401 perfil002.png', 3, 'FEMENINO', '2006-07-13'),
(10138, '45543345345', 'pedro pereez', '', '2342342342', 'guanipa center', 'ereez@gmail.com', 'ciudadano45543345345', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'MASCULINO', '2018-03-08'),
(10139, '3123123231', 'carolinaa contreras', '', '0424889832', 'uchire casa grande', 'cassca@gmail.com', 'ciudadano3123123231', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'FEMENINO', '2017-06-13'),
(10140, '2278657657', 'jose contreras', '', '2342342342', 'sde', 'sdasda@gmil.com', 'ciudadano2278657657', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'MASCULINO', '2018-06-14'),
(10141, '243243243', 'andres garcia', '', '223434004324', 'el carmen 2', 'andres@gmail.com', 'ciudadano243243243', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'MASCULINO', '2013-01-08'),
(10142, '23432909', 'maria fernandez', '', '0212332323', 'calle nueva', 'acascs@gmail.com', 'ciudadano23432909', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'FEMENINO', '2015-02-10'),
(10143, '2199213321', 'maria julia', '', '0090324432', 'juan de urpin', 'julian@gmail.com', 'ciudadano2199213321', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'FEMENINO', '2016-06-08'),
(10144, '21330900', 'Felipe Guerra', '', '0242123211', 'las praderas', 'felipe@guerra.com', 'ciudadano21330900', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'MASCULINO', '2014-06-04'),
(10145, '21887900', 'Usuario', 'Prueba', '44324324324', 'barcelona', 'prueba@gmail.com', 'prueba', 'bkNpZ2RSMUE1aHlHTnFzb3hRVFQ0UT09', 'Activa', 3, '1659318169 capitan america.png', 4, 'MASCULINO', '2006-02-09'),
(10146, '32009883', 'LUis Guerra', '', '0344324998', 'san cristobal centro', 'guerra@gmail.com', 'ciudadano32009883', 'Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=', 'Deshabilitada', 3, 'default.jpg', 4, 'MASCULINO', '1998-02-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_cargo`
--

CREATE TABLE `usuario_cargo` (
  `usuario_cargo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_cargo`
--

INSERT INTO `usuario_cargo` (`usuario_cargo_id`, `usuario_id`, `cargo_id`) VALUES
(1, 10081, 5),
(2, 10082, 5),
(3, 10083, 5),
(4, 10084, 5),
(5, 10085, 5),
(6, 10086, 5),
(7, 10087, 5),
(8, 10088, 5),
(9, 10089, 5),
(10, 10090, 5),
(11, 10091, 5),
(12, 10092, 5),
(13, 10093, 5),
(14, 10094, 5),
(15, 10096, 5),
(16, 10097, 5),
(17, 10098, 5),
(18, 10099, 5),
(19, 10100, 5),
(20, 10101, 5),
(21, 10102, 5),
(22, 10103, 25),
(23, 10104, 22),
(24, 10105, 7),
(25, 10107, 1),
(26, 10117, 21),
(27, 10116, 32),
(28, 10108, 1),
(29, 10115, 2),
(30, 10114, 5),
(31, 10109, 1),
(32, 10110, 19),
(33, 10111, 41),
(34, 10112, 42),
(35, 10113, 40),
(36, 10123, 43),
(37, 10124, 44),
(38, 10127, 5),
(39, 10131, 5),
(40, 10133, 14),
(41, 10145, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_parroquia`
--

CREATE TABLE `usuario_parroquia` (
  `usuario_parroquia_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `parroquia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_parroquia`
--

INSERT INTO `usuario_parroquia` (`usuario_parroquia_id`, `usuario_id`, `parroquia_id`) VALUES
(1, 10081, 50),
(2, 10082, 50),
(3, 10083, 50),
(4, 10084, 50),
(5, 10085, 50),
(6, 10086, 50),
(7, 10087, 50),
(8, 10088, 50),
(9, 10089, 50),
(10, 10090, 50),
(11, 10091, 50),
(12, 10092, 50),
(13, 10093, 50),
(14, 10094, 50),
(15, 10095, 50),
(16, 10096, 50),
(17, 10098, 50),
(18, 10099, 50),
(19, 10100, 50),
(20, 10101, 50),
(21, 10102, 50),
(22, 10107, 50),
(23, 10103, 50),
(24, 10104, 50),
(25, 10105, 50),
(26, 10106, 50),
(27, 10108, 50),
(28, 10109, 50),
(29, 10110, 50),
(30, 10111, 50),
(31, 10112, 50),
(32, 10113, 50),
(33, 10114, 50),
(34, 10115, 50),
(35, 10116, 28),
(36, 10117, 6),
(37, 10118, 50),
(38, 10119, 50),
(39, 10120, 50),
(40, 10121, 50),
(41, 10122, 50),
(42, 10123, 50),
(43, 10124, 50),
(44, 10127, 50),
(45, 10132, 50),
(46, 10133, 50),
(47, 10134, 56),
(48, 10135, 50),
(49, 10136, 21),
(50, 10138, 17),
(51, 10139, 37),
(52, 10140, 50),
(53, 10141, 50),
(54, 10142, 53),
(55, 10143, 53),
(56, 10144, 53),
(57, 10145, 53),
(58, 10146, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sector`
--

CREATE TABLE `usuario_sector` (
  `usuario_sector_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_sector`
--

INSERT INTO `usuario_sector` (`usuario_sector_id`, `usuario_id`, `sector_id`) VALUES
(1, 10081, 3),
(2, 10082, 3),
(3, 10083, 3),
(4, 10084, 3),
(5, 10085, 3),
(6, 10086, 3),
(7, 10087, 3),
(8, 10088, 3),
(9, 10089, 3),
(10, 10090, 3),
(11, 10091, 3),
(12, 10092, 3),
(13, 10093, 3),
(14, 10094, 3),
(15, 10095, 3),
(16, 10096, 3),
(17, 10098, 3),
(18, 10099, 3),
(19, 10100, 3),
(20, 10101, 3),
(21, 10102, 3),
(22, 10107, 1),
(23, 10103, 1),
(24, 10104, 1),
(25, 10105, 1),
(26, 10106, 1),
(27, 10108, 1),
(28, 10109, 1),
(29, 10110, 1),
(30, 10111, 1),
(31, 10112, 1),
(32, 10113, 1),
(33, 10114, 1),
(34, 10115, 2),
(35, 10116, 4),
(36, 10117, 5),
(37, 10118, 1),
(38, 10119, 1),
(39, 10120, 1),
(40, 10121, 1),
(41, 10122, 1),
(42, 10123, 1),
(43, 10124, 1),
(44, 10127, 1),
(45, 10132, 1),
(46, 10133, 1),
(47, 10135, 7),
(48, 10140, 1),
(49, 10143, 8),
(50, 10144, 8),
(51, 10142, 8),
(52, 10141, 2),
(53, 10136, 9),
(54, 10145, 8),
(55, 10146, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`actividad_id`);

--
-- Indices de la tabla `activo_usuario`
--
ALTER TABLE `activo_usuario`
  ADD PRIMARY KEY (`activo_usuario_id`);

--
-- Indices de la tabla `activo_usuario_status`
--
ALTER TABLE `activo_usuario_status`
  ADD PRIMARY KEY (`activo_usuario_status_id`);

--
-- Indices de la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`anexo_id`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`asignacion_id`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`bitacora_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cargo_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`configuracion_id`);

--
-- Indices de la tabla `cubiculo`
--
ALTER TABLE `cubiculo`
  ADD PRIMARY KEY (`cubiculo_id`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`direccion_id`);

--
-- Indices de la tabla `equipo_actividad`
--
ALTER TABLE `equipo_actividad`
  ADD PRIMARY KEY (`equipo_actividad_id`);

--
-- Indices de la tabla `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indices de la tabla `gabinete`
--
ALTER TABLE `gabinete`
  ADD PRIMARY KEY (`gabinete_id`);

--
-- Indices de la tabla `grafica_solicitud`
--
ALTER TABLE `grafica_solicitud`
  ADD PRIMARY KEY (`grafica_solicitud_id`);

--
-- Indices de la tabla `home_actividad`
--
ALTER TABLE `home_actividad`
  ADD PRIMARY KEY (`home_actividad_id`);

--
-- Indices de la tabla `home_direccion`
--
ALTER TABLE `home_direccion`
  ADD PRIMARY KEY (`home_direccion_id`);

--
-- Indices de la tabla `home_feedback`
--
ALTER TABLE `home_feedback`
  ADD PRIMARY KEY (`home_id`);

--
-- Indices de la tabla `home_gabinete`
--
ALTER TABLE `home_gabinete`
  ADD PRIMARY KEY (`home_gabinete_id`);

--
-- Indices de la tabla `home_indicador`
--
ALTER TABLE `home_indicador`
  ADD PRIMARY KEY (`home_indicador_id`);

--
-- Indices de la tabla `home_operador`
--
ALTER TABLE `home_operador`
  ADD PRIMARY KEY (`home_operador_id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`imagen_id`);

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`indicador_id`);

--
-- Indices de la tabla `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kategoria_id`);

--
-- Indices de la tabla `mapa`
--
ALTER TABLE `mapa`
  ADD PRIMARY KEY (`mapa_id`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`multimedia_id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`municipio_id`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`parroquia_id`);

--
-- Indices de la tabla `paso`
--
ALTER TABLE `paso`
  ADD PRIMARY KEY (`paso_id`);

--
-- Indices de la tabla `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`pdf_id`);

--
-- Indices de la tabla `procesar`
--
ALTER TABLE `procesar`
  ADD PRIMARY KEY (`procesar_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`kategoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`solicitud_id`);

--
-- Indices de la tabla `solicitud_actividad`
--
ALTER TABLE `solicitud_actividad`
  ADD PRIMARY KEY (`sol_act_id`);

--
-- Indices de la tabla `solicitud_direccion`
--
ALTER TABLE `solicitud_direccion`
  ADD PRIMARY KEY (`solicitud_direccion_id`);

--
-- Indices de la tabla `solicitud_gabinete`
--
ALTER TABLE `solicitud_gabinete`
  ADD PRIMARY KEY (`solicitud_gabinete_id`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`turno_id`);

--
-- Indices de la tabla `turno_usuario`
--
ALTER TABLE `turno_usuario`
  ADD PRIMARY KEY (`turno_usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `usuario_cargo`
--
ALTER TABLE `usuario_cargo`
  ADD PRIMARY KEY (`usuario_cargo_id`);

--
-- Indices de la tabla `usuario_parroquia`
--
ALTER TABLE `usuario_parroquia`
  ADD PRIMARY KEY (`usuario_parroquia_id`);

--
-- Indices de la tabla `usuario_sector`
--
ALTER TABLE `usuario_sector`
  ADD PRIMARY KEY (`usuario_sector_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `activo_usuario`
--
ALTER TABLE `activo_usuario`
  MODIFY `activo_usuario_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `activo_usuario_status`
--
ALTER TABLE `activo_usuario_status`
  MODIFY `activo_usuario_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `anexo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `asignacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `bitacora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `configuracion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cubiculo`
--
ALTER TABLE `cubiculo`
  MODIFY `cubiculo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `direccion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `equipo_actividad`
--
ALTER TABLE `equipo_actividad`
  MODIFY `equipo_actividad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gabinete`
--
ALTER TABLE `gabinete`
  MODIFY `gabinete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grafica_solicitud`
--
ALTER TABLE `grafica_solicitud`
  MODIFY `grafica_solicitud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `home_actividad`
--
ALTER TABLE `home_actividad`
  MODIFY `home_actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `home_direccion`
--
ALTER TABLE `home_direccion`
  MODIFY `home_direccion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `home_feedback`
--
ALTER TABLE `home_feedback`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_gabinete`
--
ALTER TABLE `home_gabinete`
  MODIFY `home_gabinete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `home_indicador`
--
ALTER TABLE `home_indicador`
  MODIFY `home_indicador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `home_operador`
--
ALTER TABLE `home_operador`
  MODIFY `home_operador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `imagen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `indicador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kategoria_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `mapa`
--
ALTER TABLE `mapa`
  MODIFY `mapa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `multimedia_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `municipio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `parroquia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `paso`
--
ALTER TABLE `paso`
  MODIFY `paso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pdf`
--
ALTER TABLE `pdf`
  MODIFY `pdf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `procesar`
--
ALTER TABLE `procesar`
  MODIFY `procesar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `solicitud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `solicitud_actividad`
--
ALTER TABLE `solicitud_actividad`
  MODIFY `sol_act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `solicitud_direccion`
--
ALTER TABLE `solicitud_direccion`
  MODIFY `solicitud_direccion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `solicitud_gabinete`
--
ALTER TABLE `solicitud_gabinete`
  MODIFY `solicitud_gabinete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `turno_usuario`
--
ALTER TABLE `turno_usuario`
  MODIFY `turno_usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10147;

--
-- AUTO_INCREMENT de la tabla `usuario_cargo`
--
ALTER TABLE `usuario_cargo`
  MODIFY `usuario_cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `usuario_parroquia`
--
ALTER TABLE `usuario_parroquia`
  MODIFY `usuario_parroquia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `usuario_sector`
--
ALTER TABLE `usuario_sector`
  MODIFY `usuario_sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
