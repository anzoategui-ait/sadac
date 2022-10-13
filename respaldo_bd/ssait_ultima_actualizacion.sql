-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2022 a las 16:09:50
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
(1, 'Instalación de toner', 'Cambio, reemplazo de toner', 'default.jpg', 1, 1),
(2, 'Recarga de tinta', 'Recarga de tinta', 'default.jpg', 1, 1),
(3, 'instalacion de impresora', 'instalación de impresora', 'default.jpg', 1, 2),
(4, 'Instalación sistema operativo', 'Instalación sistema operativo', 'default.jpg', 2, 2),
(5, 'Desbloqueo de clave de S.O', 'Desbloqueo de clave de S.O', 'default.jpg', 2, 2),
(6, 'Corrección de hora y fecha', 'Corrección de hora y fecha', 'default.jpg', 2, 2),
(7, 'Atasco de papel en Impresora', 'Atasco de papel de impresora', 'default.jpg', 1, 1),
(8, 'Inducción de Aplicaciones', 'Inducción de Aplicaciones', 'default.jpg', 2, 2),
(9, 'Revisión de impresora', 'Revisión de impresora', 'default.jpg', 1, 1),
(10, 'Escaneo y liberacion de virus a trasves de software', 'Escaneo y liberacion de virus a trasves de software', 'default.jpg', 2, 2),
(11, 'Instalaciones de aplicaciones', 'Instalaciones de aplicaciones', 'default.jpg', 2, 2),
(12, 'Respaldo de informacion', 'Instalaciones de aplicaciones', 'default.jpg', 2, 2),
(13, 'Reconexión de Impresora', 'Reconexión de Impresora', 'default.jpg', 1, 1),
(14, 'Reparacion de Impresora', 'Reparación de Impresora', 'default.jpg', 1, 1),
(15, 'Punto de Red', 'Punto de Red', 'default.jpg', 3, 10),
(16, 'Elaboracion de cable de red', 'Elaboracion de cable de red', 'default.jpg', 3, 10),
(17, 'Verificacion de cable de red', 'Verificacion de cable de red', 'default.jpg', 3, 10),
(18, 'Instalacion de cable de red', 'Instalacion de cable de red', 'default.jpg', 3, 10),
(19, 'Revisión de Componentes', 'Revisión de Componentes', 'default.jpg', 5, 1),
(20, 'Reconectar cable de red', 'Reconectar cable de red', 'default.jpg', 3, 10),
(21, 'Reparacion de componentes electronicos', 'Reparacion de componentes electronicos', 'default.jpg', 5, 1),
(22, 'Apoyo a operativo tecnicos', 'Apoyo a operativo tecnicos', 'default.jpg', 5, 1),
(23, 'Peinado de cable UTP', 'Peinado de cable UTP', 'default.jpg', 5, 1),
(24, 'Tendido de cable UTP', 'Tendido de cable UTP', 'default.jpg', 5, 1),
(25, 'Configuración de Dispositivos Tecnológico', 'Configuración de Dispositivos Tecnológico', 'default.jpg', 5, 4),
(26, 'Ensamblar equipos de computacion', 'Ensamblar equipos de computacion', 'default.jpg', 5, 1),
(27, 'Adquisición de equipos tecnológicos', 'Adquisición de equipos tecnológicos', 'default.jpg', 5, 1),
(28, 'Diseño Grafico', 'Diseño Grafico', 'default.jpg', 2, 11),
(29, 'Apoyo a operaciones administrativas', 'Apoyo a operaciones administrativas', 'default.jpg', 6, 10),
(30, 'Levantamiento de informacion', 'Levantamiento de informacion', 'default.jpg', 2, 2),
(31, 'Acceso de conectividad de pfesente', 'Acceso de Conectividad de pfesente', 'default.jpg', 3, 10),
(32, 'Reuniones de trabajo', 'Reuniones de trabajo', 'default.jpg', 6, 12),
(33, 'Crear usuario en aplicaciónes', 'Crear usuario en aplicaciónes', 'default.jpg', 2, 10),
(34, 'Mantenimientos de aerea de trabajos', 'Mantenimientos de aerea de trabajos', 'default.jpg', 7, 13),
(35, 'Restablecer Conexión Internet', 'Restablecer Conexión Internet', 'default.jpg', 2, 10),
(36, 'Bloquear usuario a internet', 'Bloquear usuario a internet', 'default.jpg', 4, 10),
(37, 'Reparacion de Sistema Operativo', 'Todo aquello que se hace para mejorar el rendimiento de una unidad de sistema, sin tener que instalar o reinstalar el sistema operativo.', 'default.jpg', 2, 2),
(38, 'entrega de cable de red', 'entrega cable de red', 'default.jpg', 3, 1),
(39, 'apoyo de inventario', 'apoyo de inventario', 'default.jpg', 4, 2);

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

--
-- Volcado de datos para la tabla `activo_usuario`
--

INSERT INTO `activo_usuario` (`activo_usuario_id`, `activo_codigo`, `usuario_cedula`, `activo_usuario_concepto`, `activo_usuario_tipo`, `activo_usuario_fecha`) VALUES
(1, 992332, '18126146', 'para realizar operaciones de trabajo', '1', '2022-09-05'),
(2, 992332, '18126146', 'se va asignar a otra peroosona', '2', '2022-09-05'),
(3, 992332, '19013743', 'realizar nueva asignacion', '1', '2022-09-05');

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

--
-- Volcado de datos para la tabla `activo_usuario_status`
--

INSERT INTO `activo_usuario_status` (`activo_usuario_status_id`, `usuario_cedula`, `producto_codigo`, `estado`) VALUES
(1, '18126146', '0992332ASD', '2'),
(2, '19013743', '0992332ASD', '1');

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
(1, 2, 10092, 1, '2022-06-27 12:18:08', 'realizar cambio del toner'),
(2, 4, 10095, 1, '2022-06-12 09:40:51', 'ir a sitio y comprobar porque el equipo esta presentando esta anomalia.'),
(3, 8, 10095, 10082, '2022-06-12 09:40:51', 'Preséntese a tesorería y realice la creación de un cable de red'),
(4, 14, 10096, 10083, '2022-06-12 09:40:51', 'Se armo y preparo una PC antes perteneciente a Paulimer Brito'),
(5, 16, 10095, 10101, '2022-06-12 09:40:51', 'se le requiere agregar a pfsente con privilegio a redes sociales'),
(6, 18, 10096, 10083, '2022-06-12 09:40:51', 'Requiere datos de internet para administrarlos'),
(7, 26, 10096, 10083, '2022-06-12 09:40:51', 'Se creo un cable de red de 5 metros aproximadamente para tesoreria'),
(8, 21, 10095, 10101, '2022-06-12 09:40:51', 'Agregar a pfsente con privilegio a redes sociales'),
(9, 29, 10096, 10083, '2022-06-12 09:40:51', 'Se entrego un cable de red de 5 Metros en una PC de tesoreria'),
(10, 12, 10095, 10101, '2022-06-12 09:40:51', 'El equipo necesita un diagnostico'),
(13, 27, 10095, 10101, '2022-06-12 09:40:51', 'agregar a pfsente con privilegio a redes sociales'),
(14, 31, 10095, 10101, '2022-06-12 09:40:51', 'se necesita un diagnostico del equipo'),
(15, 33, 10095, 10101, '2022-06-12 09:40:51', 'realización de cable de red'),
(16, 37, 10096, 10083, '2022-06-12 09:40:51', 'Verificar los cables de red'),
(17, 38, 10096, 10083, '2022-06-12 09:40:51', 'Verificar los cables de red'),
(18, 42, 10096, 10083, '2022-06-12 09:40:51', 'Verificar cada punto o cable'),
(19, 44, 10095, 10101, '2022-06-12 09:40:51', 'entrega de cable de red'),
(20, 45, 10095, 10101, '2022-06-12 09:40:51', 'entrega de cable de red'),
(21, 43, 10094, 10101, '2022-06-12 09:40:51', 'entrega de cable de red'),
(22, 48, 10096, 10083, '2022-06-12 09:40:51', 'Se reviso el teclado se el cambio el conector'),
(23, 56, 10095, 10082, '2022-06-12 09:40:51', 'Verificar la conexión de Internet'),
(25, 58, 10095, 10101, '2022-06-12 09:40:51', 'servicio de conexión de cable de red'),
(26, 59, 10095, 10101, '2022-06-12 09:40:51', 'se conecto cable de red en la pc, se encontró problemas con el cable de red'),
(27, 46, 10095, 10101, '2022-06-12 09:40:51', 'entrega de cable de red'),
(30, 63, 10095, 10101, '2022-06-12 09:40:51', 'entrega de cable de red'),
(31, 61, 10095, 10101, '2022-06-12 09:40:51', 'servicio de coneccion de cable de red en la pc, encontro problemas con los cables de red'),
(32, 64, 10095, 10101, '2022-06-12 09:40:51', 'verificación de cable'),
(33, 66, 10095, 10081, '2022-06-12 09:40:51', 'Verificar Puntos de Internet'),
(34, 71, 10096, 10082, '2022-06-12 09:40:51', 'realiza mantenimiento preventivo al software de la computadora'),
(35, 70, 10091, 10101, '2022-06-12 09:40:51', 'se busco el punto de red y se le dio conectividad al cuarto de rack'),
(36, 67, 10095, 10081, '2022-06-12 09:40:51', 'Verificar puntos de internet'),
(37, 76, 10095, 10081, '2022-06-12 09:40:51', 'Equipo sin internet'),
(38, 77, 10095, 10081, '2022-06-12 09:40:51', 'Equipo sin internet'),
(39, 12, 10096, 10083, '2022-06-12 09:40:51', 'Se hizo revision'),
(40, 79, 10097, 10082, '2022-06-12 09:40:51', 'Por favor realizar la respectiva revisión al cable de red'),
(41, 81, 10096, 10083, '2022-06-12 09:40:51', 'Cambio de hora y fecha para poder establecer internet en la laptop'),
(42, 83, 10097, 10082, '2022-06-12 09:40:51', 'Por favor realizar las correcciones pertinentes para regularizar la hora y fecha'),
(43, 85, 10095, 10081, '2022-06-12 09:40:51', 'Equipo sin internet'),
(44, 86, 10095, 10081, '2022-06-12 09:40:51', 'Equipo sin internet'),
(45, 88, 10092, 10083, '2022-06-12 09:40:51', 'Camibiar toner de la impresora'),
(46, 90, 10097, 10082, '2022-06-12 09:40:51', 'Por favor revise la revisión a la impresora y su cable de red'),
(47, 93, 10092, 10083, '2022-06-12 09:40:51', 'Se compartio conexion de una impresora a una pc'),
(48, 94, 10097, 10101, '2022-06-12 09:40:51', 'la impresora no queria imprimir dando aviso de toner'),
(49, 96, 10092, 10083, '2022-06-12 09:40:51', 'Instalacion de paqueteria'),
(50, 102, 10097, 10083, '2022-06-12 09:40:51', 'El equipo presentaba hora y fecha erronea'),
(51, 99, 10097, 10082, '2022-06-12 09:40:51', 'Revisar y Colocar acceso a Internet'),
(52, 100, 10097, 10082, '2022-06-12 09:40:51', 'por favor realizar la evaluación pertinente para la instalación de programas'),
(53, 106, 10097, 10101, '2022-06-12 09:40:51', 'se creo contraseña de usuario al equipo solicitado de (Marielvys)'),
(54, 108, 10097, 10083, '2022-06-12 09:40:51', 'El equipo presentaba fallas'),
(55, 110, 10097, 10101, '2022-06-12 09:40:51', 'se requiere copia de seguridad de un disco duro a otro'),
(56, 114, 10091, 10081, '2022-06-12 09:40:51', 'Problemas de conexión con la impresora'),
(57, 116, 10091, 10083, '2022-06-12 09:40:51', 'Emsablaje y pruebas'),
(58, 120, 10091, 10083, '2022-06-12 09:40:51', 'Instalacion para video conferencias'),
(59, 122, 10096, 10101, '2022-06-12 09:40:51', 'se hizo reconexion del Internet a otra'),
(60, 124, 10091, 10101, '2022-06-12 09:40:51', 'reconexion a internet'),
(61, 127, 10091, 10083, '2022-06-12 09:40:51', 'Reparacion de S.O'),
(62, 128, 10091, 10081, '2022-06-12 09:40:51', 'Respaldo a los archivos, se instalo software y aplicaciones informaticas'),
(63, 131, 10091, 10083, '2022-06-12 09:40:51', 'Un agrego dos equipos al Pfsense'),
(64, 136, 10096, 10081, '2022-06-12 09:40:51', 'Se ha determinado que la tarjeta madre esta dañada'),
(65, 134, 10091, 10081, '2022-06-12 09:40:51', 'Se ubico el punto de red'),
(66, 54, 10096, 10101, '2022-06-12 09:40:51', 'se conecto una pc al Internet dándole al pfsente'),
(67, 139, 10096, 10081, '2022-06-12 09:40:51', 'Se cambio la clave al usuario'),
(68, 143, 10127, 10081, '2022-07-13 09:51:14', 'Configurar la fecha y hora'),
(69, 140, 10127, 10081, '2022-07-13 10:01:52', 'Configurar la fecha y hora'),
(70, 146, 10127, 10081, '2022-07-13 10:02:18', 'Configurar fecha y hora'),
(71, 147, 10132, 10101, '2022-07-13 10:04:03', 'apoyo a tecnosystem con el aleado utp'),
(72, 149, 10132, 10101, '2022-07-13 10:08:18', 'apoyo de revisión de los BIOS'),
(73, 152, 10132, 10101, '2022-07-13 10:12:19', 'apoyo de revisión de BIOS'),
(74, 156, 10127, 10081, '2022-07-13 10:19:31', 'Hacer respaldo de informacion'),
(75, 154, 10132, 10101, '2022-07-13 10:19:42', 'revisión de BIOS'),
(76, 160, 10132, 10101, '2022-07-13 10:24:32', 'acceso a internet'),
(77, 159, 10132, 10101, '2022-07-13 10:24:58', 'instalación de impresora'),
(78, 162, 10132, 10101, '2022-07-13 10:29:14', 'reparación de fuente de poder'),
(79, 164, 10132, 10101, '2022-07-13 10:34:34', 'dianostico de equipo de secretaria'),
(80, 168, 10129, 10081, '2022-07-13 10:40:09', 'Apoyo a tecnoSistem'),
(81, 170, 10129, 10083, '2022-07-13 10:47:18', 'Apoyo al mantenimiento de Hardware'),
(82, 167, 10129, 10081, '2022-07-13 10:52:02', 'Apoyo a Tecno sistem'),
(83, 173, 10129, 10083, '2022-07-13 10:52:21', 'Apoyo a inventario'),
(84, 175, 10132, 10101, '2022-07-13 10:55:15', 'apoyo e inventario  con yuber lara'),
(85, 177, 10132, 10083, '2022-07-13 10:55:25', 'Revision del equipo'),
(86, 182, 10132, 10101, '2022-07-13 11:02:05', 'se le agrego la direccion mac al pfsente'),
(87, 183, 10129, 10083, '2022-07-13 11:03:12', 'Se le desintalo  el equipo de oficce y se le instalo una version actualizada'),
(88, 188, 10129, 10083, '2022-07-13 11:07:29', 'Cambio de hora y fecha  ya que el sistema es un poco viejo y luego el S.O no conecta con red de internet'),
(89, 189, 10132, 10101, '2022-07-13 11:07:33', 'verificación de cable de red'),
(90, 186, 10132, 10101, '2022-07-13 11:07:53', 'verificación de cable de red'),
(91, 191, 10129, 10083, '2022-07-13 11:10:42', 'Cambio de hora y fecha'),
(92, 193, 10132, 10101, '2022-07-13 11:11:39', 'actualización de hora y fecha'),
(93, 195, 10129, 10081, '2022-07-13 11:12:59', 'Activar paquete office'),
(94, 198, 10129, 10083, '2022-07-13 11:13:57', 'Elaboracion de Cable de red'),
(95, 199, 10132, 10101, '2022-07-13 11:14:24', 'elaboración de cable de red'),
(96, 201, 10129, 10083, '2022-07-13 11:17:16', 'Respaldar informacion'),
(97, 205, 10129, 10083, '2022-07-13 11:19:37', 'Cambiar la fecha  y la hora para tener acceso a la red de internet'),
(98, 204, 10132, 10101, '2022-07-13 11:19:49', 'instalación de access 2010'),
(99, 207, 10129, 10083, '2022-07-13 11:22:23', 'Entrega de cable de 5 Metros para la conexión de Internet'),
(100, 209, 10132, 10101, '2022-07-13 11:32:18', 'mantenimiento de cpu se utilizo una sopladora'),
(101, 179, 10132, 10101, '2022-07-13 11:33:02', 'manteniento de cpu'),
(102, 211, 10130, 10083, '2022-07-13 11:34:52', 'Se realizo un cable UTP'),
(103, 213, 10132, 10101, '2022-07-13 11:39:25', 'configuración de fecha y hora'),
(104, 215, 10130, 10083, '2022-07-13 11:40:20', 'Apoyo para instalar un toner'),
(105, 217, 10132, 10101, '2022-07-13 11:41:32', 'actualización fecha y hora'),
(106, 219, 10130, 10083, '2022-07-13 11:43:00', 'Apoyo para instalar una impresora'),
(107, 221, 10132, 10101, '2022-07-13 11:46:58', 'mantenimiento a la area ait'),
(108, 223, 10132, 10101, '2022-07-13 11:52:41', 'revisión de componentes'),
(109, 225, 10132, 10101, '2022-07-13 11:53:02', 'revisión'),
(110, 227, 10129, 10081, '2022-07-13 11:55:47', 'Apoyo al ingeniero Luis Tapizque en instalacion de impresora'),
(111, 230, 10130, 10083, '2022-07-13 11:58:31', 'Desbloqueo de cuenta'),
(112, 232, 10129, 10081, '2022-07-13 12:03:26', 'Instalar sistema operativo LINUX en un disco duro de prueba'),
(113, 234, 10130, 10083, '2022-07-13 12:03:34', 'Conectar una laptop a una red de wifi'),
(114, 236, 10132, 10101, '2022-06-03 12:32:33', 'se desactivo y activo conectividad de internet'),
(115, 239, 10096, 10081, '2022-06-03 12:46:14', 'Remover atasco en la impresora'),
(116, 241, 10132, 10101, '2022-06-03 12:55:47', 'conectar equipos nuevo a impresoras'),
(117, 243, 10127, 10101, '2022-06-02 13:05:53', 'revision de impresora'),
(118, 245, 10091, 1, '2022-05-10 10:40:30', 'realizar solicitud'),
(119, 247, 10097, 1, '2022-04-15 12:48:39', 'realizar asignacion'),
(120, 249, 10132, 1, '2022-09-05 06:40:25', 'realizando chequeo de home, para saber cuantas actividades tiene asignadas'),
(121, 251, 10132, 1, '2022-09-05 07:08:24', 'probando asignacion');

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
(1, '2022-06-01 17:53:01', 'Inicio de Sesion', 1),
(2, '2022-07-06 13:12:56', 'Inicio de Sesion', 1),
(3, '2022-07-06 13:12:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(4, '2022-07-06 13:16:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(5, '2022-07-07 10:53:38', 'Inicio de Sesion', 1),
(6, '2022-07-07 10:53:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(7, '2022-07-07 11:42:28', 'Inicio de Sesion', 1),
(8, '2022-07-07 11:42:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(9, '2022-07-07 11:42:48', 'Visualizo el listado de actividades', 1),
(10, '2022-07-07 11:56:55', 'Visualizo el listado de actividades', 1),
(11, '2022-07-07 13:39:05', 'Inicio de Sesion', 1),
(12, '2022-07-07 13:39:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(13, '2022-07-07 13:39:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(14, '2022-07-07 13:50:33', 'Inicio de Sesion', 10081),
(15, '2022-07-07 13:50:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(16, '2022-07-07 13:53:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(17, '2022-07-07 13:54:29', 'Visualizo el listado de asignaciones', 1),
(18, '2022-07-07 13:54:30', 'Visualizo el listado de asignaciones', 1),
(19, '2022-07-07 13:54:32', 'Visualizo el listado de asignaciones', 1),
(20, '2022-07-07 13:55:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(21, '2022-07-07 13:57:02', 'Inicio de Sesion', 1),
(22, '2022-07-07 13:57:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(23, '2022-07-07 13:57:32', 'Inicio de Sesion', 1),
(24, '2022-07-07 13:57:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(25, '2022-07-07 14:01:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(26, '2022-07-07 15:06:35', 'Inicio de Sesion', 1),
(27, '2022-07-07 15:06:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(28, '2022-07-08 14:50:07', 'Inicio de Sesion', 1),
(29, '2022-07-08 14:50:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(30, '2022-07-08 14:52:47', 'Visualizo el listado de gabinete', 1),
(31, '2022-07-08 14:52:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(32, '2022-07-08 14:53:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(33, '2022-07-09 09:33:22', 'Inicio de Sesion', 1),
(34, '2022-07-09 09:33:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(35, '2022-07-09 09:33:33', 'Visualizo el listado de actividades', 1),
(36, '2022-07-09 10:08:56', 'Visualizo el listado de direcciones', 1),
(37, '2022-07-09 10:28:00', 'Inicio de Sesion', 1),
(38, '2022-07-09 10:28:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(39, '2022-07-09 10:28:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(40, '2022-07-09 10:28:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(41, '2022-07-09 10:45:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(42, '2022-07-09 10:48:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(43, '2022-07-09 10:48:45', 'Visualizo el listado de solicitud', 1),
(44, '2022-07-09 10:48:48', 'Visualizo el listado de solicitud', 1),
(45, '2022-07-09 10:50:21', 'Visualizo el listado de direcciones', 1),
(46, '2022-07-09 10:50:50', 'Creacion de nueva direccion: Automatizacion, Informatica y Telecomunicaciones', 1),
(47, '2022-07-09 10:51:08', 'Creacion de nueva direccion: Planificacion', 1),
(48, '2022-07-09 10:51:20', 'Creacion de nueva direccion: Presupuesto', 1),
(49, '2022-07-09 10:51:59', 'Creacion de nueva direccion: Administracion y Finanzas', 1),
(50, '2022-07-09 10:52:08', 'Creacion de nueva direccion: Educacion', 1),
(51, '2022-07-09 10:52:36', 'Creacion de nueva direccion: Talento Humano', 1),
(52, '2022-07-09 10:52:41', 'Visualizo el listado de direcciones', 1),
(53, '2022-07-09 10:53:20', 'Creacion de nueva direccion: Auditoria', 1),
(54, '2022-07-09 10:53:36', 'Creacion de nueva direccion: Bienes Publicos', 1),
(55, '2022-07-09 10:53:37', 'Visualizo el listado de direcciones', 1),
(56, '2022-07-09 10:53:50', 'Actualizo la siguiente direccion: Auditoria Interna', 1),
(57, '2022-07-09 10:54:31', 'Visualizo el listado de direcciones', 1),
(58, '2022-07-09 10:55:13', 'Creacion de nueva direccion: Dimisoc', 1),
(59, '2022-07-09 10:55:29', 'Creacion de nueva direccion: Atencion al Ciudadano', 1),
(60, '2022-07-09 10:55:57', 'Creacion de nueva direccion: Archivo General de Gobierno', 1),
(61, '2022-07-09 10:56:38', 'Creacion de nueva direccion: Cultura', 1),
(62, '2022-07-09 10:57:20', 'Visualizo el listado de direcciones', 1),
(63, '2022-07-09 10:57:40', 'Visualizo el listado de direcciones', 1),
(64, '2022-07-09 10:57:46', 'Visualizo el listado de direcciones', 1),
(65, '2022-07-09 13:20:50', 'Inicio de Sesion', 1),
(66, '2022-07-09 13:20:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(67, '2022-07-09 13:22:51', 'Actualizo la siguiente direccion: Planificacion y Desarrollo', 1),
(68, '2022-07-09 13:23:14', 'Visualizo el listado de direcciones', 1),
(69, '2022-07-09 13:23:35', 'Actualizo la siguiente direccion: Educacion', 1),
(70, '2022-07-09 13:23:48', 'Visualizo el listado de direcciones', 1),
(71, '2022-07-09 13:23:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(72, '2022-07-09 13:24:08', 'Creacion de nueva direccion: Juventud', 1),
(73, '2022-07-09 13:24:15', 'Visualizo el listado de direcciones', 1),
(74, '2022-07-09 13:24:19', 'Visualizo el listado de direcciones', 1),
(75, '2022-07-09 13:24:40', 'Actualizo la siguiente direccion: Misiones Sociales (Dimisoc)', 1),
(76, '2022-07-09 13:25:57', 'Creacion de nueva direccion: Instituto Anzoatiguense de la salud (SALUDANZ)', 1),
(77, '2022-07-09 13:27:40', 'Creacion de nueva direccion: Policía del estado Anzoátegui (Polianzoátegui)', 1),
(78, '2022-07-09 13:27:54', 'Creacion de nueva direccion: Instituto Estadal de la mujer (IEMA)', 1),
(79, '2022-07-09 13:28:01', 'Creacion de nueva direccion: Sistema Integrado de Gestión de Riesgo y Administración de Emergencias de Carácter Civil y Desastres del estado Anzoátegui (Sigraed)', 1),
(80, '2022-07-09 13:28:15', 'Creacion de nueva direccion: Bomberos de Anzoátegui', 1),
(81, '2022-07-09 13:28:38', 'Creacion de nueva direccion: Instituto de Deporte y Actividad Física (IDANZ)', 1),
(82, '2022-07-09 13:28:42', 'Creacion de nueva direccion: Protección Civil', 1),
(83, '2022-07-09 13:28:54', 'Creacion de nueva direccion: Instituto Autónomo de la Secretaría de los Pueblos Indígenas (IASPI)', 1),
(84, '2022-07-09 13:28:58', 'Creacion de nueva direccion: Dirección de Seguridad Ciudadana', 1),
(85, '2022-07-09 13:29:06', 'Creacion de nueva direccion: Dirección de Salud Pública', 1),
(86, '2022-07-09 13:29:22', 'Creacion de nueva direccion: Fondo Administrado de Salud para la Gobernación del Estado Anzoátegui (FASGANZ)', 1),
(87, '2022-07-09 13:29:57', 'Visualizo el listado de gabinete', 1),
(88, '2022-07-09 13:29:58', 'Creacion de nueva direccion: Corporación de Vialidad e Infraestructura Gobernación del Estado Anzoátegui (COVINEA)', 1),
(89, '2022-07-09 13:30:10', 'Actualizo el siguiente gabinete: Economico y Productivo', 1),
(90, '2022-07-09 13:30:14', 'Creacion de nueva direccion: Empresa de Gestión Integral de Desechos Sólidos de Anzoátegui (EGIDSA)', 1),
(91, '2022-07-09 13:30:28', 'Creacion de nueva direccion: Instituto Socialista del Transporte del estado Anzoátegui (INSOTRANZ)', 1),
(92, '2022-07-09 13:30:31', 'Creacion de nueva direccion: Corporación de Turismo del estado Anzoátegui (CORANZTUR)', 1),
(93, '2022-07-09 13:30:43', 'Creacion de nueva direccion: Corporación Avícola del estado Anzoátegui (CORPOVANZ)', 1),
(94, '2022-07-09 13:30:43', 'Creacion de nueva direccion: Secretaría de Vivienda de la Gobernación del Estado Anzoátegui (Sevigea)', 1),
(95, '2022-07-09 13:30:57', 'Creacion de nueva direccion: Corporación de Minas del estado Anzoátegui (CORPOMINAS)', 1),
(96, '2022-07-09 13:30:58', 'Creacion de nueva direccion: Corporación Caupolicán Ovalles CAUPOCA', 1),
(97, '2022-07-09 13:31:19', 'Creacion de nueva direccion: EPS Viviendas de Mi Patria Querida', 1),
(98, '2022-07-09 13:31:22', 'Creacion de nueva direccion: Fondo de Economía Popular del estado Anzoátegui (FONDEPANZ)', 1),
(99, '2022-07-09 13:32:11', 'Creacion de nueva direccion: Dirección de Comunas y Poder Popular', 1),
(100, '2022-07-09 13:32:15', 'Creacion de nueva direccion: Servicio de Administración Tributaria del Estado Anzoátegui (SATEA)', 1),
(101, '2022-07-09 13:32:52', 'Creacion de nueva direccion: Corporación Regional De Abastecimiento Del Estado Anzoátegui (CREANZ)', 1),
(102, '2022-07-09 13:33:14', 'Creacion de nueva direccion: Corporación para el Desarrollo Rural Sustentable de Anzoátegui (CORDAGRO)', 1),
(103, '2022-07-09 13:33:22', 'Creacion de nueva direccion: Corporación de Pesca (COPESCA)', 1),
(104, '2022-07-09 13:33:29', 'Creacion de nueva direccion: Sociedad de Garantía Recíprocas', 1),
(105, '2022-07-09 13:36:11', 'Visualizo el listado de categorias', 1),
(106, '2022-07-09 13:36:27', 'Creacion de nueva categoria: IMPRESORAS', 1),
(107, '2022-07-09 13:36:38', 'Creacion de nueva categoria: SOFTWARE', 1),
(108, '2022-07-09 13:36:50', 'Creacion de nueva categoria: REDES', 1),
(109, '2022-07-09 13:37:08', 'Creacion de nueva categoria: SEGURIDAD INFORMATICA', 1),
(110, '2022-07-09 13:37:25', 'Creacion de nueva categoria: HARDWARE', 1),
(111, '2022-07-09 13:38:41', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(112, '2022-07-09 13:38:53', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(113, '2022-07-09 13:39:16', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(114, '2022-07-09 13:39:25', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(115, '2022-07-09 13:39:36', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(116, '2022-07-09 13:39:45', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(117, '2022-07-09 13:43:10', 'Inicio de Sesion', 1),
(118, '2022-07-09 13:43:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(119, '2022-07-09 13:43:19', 'Visualizo el listado de cargos', 1),
(120, '2022-07-09 13:43:50', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(121, '2022-07-09 13:44:05', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(122, '2022-07-11 10:05:57', 'Inicio de Sesion', 1),
(123, '2022-07-11 10:05:58', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(124, '2022-07-11 10:06:41', 'Visualizo el listado de cargos', 1),
(125, '2022-07-11 10:07:20', 'Inicio de Sesion', 10101),
(126, '2022-07-11 10:07:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(127, '2022-07-11 10:08:03', 'Visualizo el listado de cargos', 10101),
(128, '2022-07-11 10:09:23', 'Visualizo el listado de cargos', 1),
(129, '2022-07-11 10:10:02', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(130, '2022-07-11 10:10:07', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(131, '2022-07-11 10:10:11', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(132, '2022-07-11 10:10:15', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(133, '2022-07-11 10:10:24', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(134, '2022-07-11 10:10:25', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(135, '2022-07-11 10:10:33', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(136, '2022-07-11 10:10:34', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(137, '2022-07-11 10:10:41', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(138, '2022-07-11 10:10:47', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(139, '2022-07-11 10:10:50', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(140, '2022-07-11 10:10:57', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(141, '2022-07-11 10:11:04', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(142, '2022-07-11 10:11:09', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(143, '2022-07-11 10:11:21', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(144, '2022-07-11 10:11:39', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(145, '2022-07-11 10:11:39', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(146, '2022-07-11 10:11:49', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(147, '2022-07-11 10:11:51', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(148, '2022-07-11 10:11:59', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(149, '2022-07-11 10:12:01', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(150, '2022-07-11 10:12:08', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(151, '2022-07-11 10:12:14', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(152, '2022-07-11 10:12:16', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(153, '2022-07-11 10:12:25', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(154, '2022-07-11 10:12:26', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(155, '2022-07-11 10:12:34', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(156, '2022-07-11 10:12:42', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(157, '2022-07-11 10:13:01', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(158, '2022-07-11 10:13:13', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(159, '2022-07-11 10:13:17', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 10101),
(160, '2022-07-11 10:15:03', 'Creacion de nuevo sector: Edificio sede Gobernacion Anzoategui', 1),
(161, '2022-07-11 10:15:59', 'Creacion de nuevo sector: Avenida Caracas', 1),
(162, '2022-07-11 10:16:19', 'Creacion de nuevo sector: Centro de Barcelona', 1),
(163, '2022-07-11 11:03:11', 'Inicio de Sesion', 10099),
(164, '2022-07-11 11:03:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10099),
(165, '2022-07-11 11:04:17', 'Visualizo el listado de asignaciones', 10099),
(166, '2022-07-11 11:04:21', 'Visualizo el listado de asignaciones', 10099),
(167, '2022-07-11 11:05:55', 'Visualizo el listado de asignaciones', 10099),
(168, '2022-07-11 11:06:07', 'Visualizo el listado de asignaciones', 10099),
(169, '2022-07-11 11:06:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10099),
(170, '2022-07-11 11:06:40', 'Inicio de Sesion', 10099),
(171, '2022-07-11 11:06:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10099),
(172, '2022-07-11 11:07:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10099),
(173, '2022-07-11 11:08:11', 'Inicio de Sesion', 10099),
(174, '2022-07-11 11:08:12', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10099),
(175, '2022-07-11 11:09:25', 'Inicio de Sesion', 10099),
(176, '2022-07-11 11:09:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10099),
(177, '2022-07-11 11:25:11', 'Visualizo el listado de categorias', 10099),
(178, '2022-07-11 11:26:22', 'Creacion de nueva categoria: ADMINISTRACION', 10099),
(179, '2022-07-11 11:29:42', 'Visualizo el listado de direcciones', 1),
(180, '2022-07-11 11:29:52', 'Hizo la siguiente busqueda: comunicacion en el listado de direcciones', 1),
(181, '2022-07-11 11:30:22', 'Creacion de nueva direccion: Direccion de Comunicaciones', 1),
(182, '2022-07-11 11:31:23', 'Visualizo el listado de direcciones', 1),
(183, '2022-07-11 11:31:24', 'Hizo la siguiente busqueda: comunicacion en el listado de direcciones', 1),
(184, '2022-07-11 11:31:34', 'Hizo la siguiente busqueda: gobernador en el listado de direcciones', 1),
(185, '2022-07-11 11:31:48', 'Creacion de nueva direccion: Despacho del Gobernador', 1),
(186, '2022-07-11 11:32:04', 'Visualizo el listado de cargos', 1),
(187, '2022-07-11 11:32:27', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(188, '2022-07-11 11:32:35', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(189, '2022-07-11 11:33:39', 'Creacion de nueva direccion: Secretaria General de Gobierno', 1),
(190, '2022-07-11 11:33:50', 'Visualizo el listado de cargos', 1),
(191, '2022-07-11 11:34:02', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(192, '2022-07-11 11:52:29', 'Visualizo el listado de categorias', 1),
(193, '2022-07-11 11:52:49', 'Visualizo el listado de indicador', 1),
(194, '2022-07-11 11:54:03', 'Creacion de nuevo indicador: Mantenimiento, rehabilitacion y mejora de equipos a nivel de hardware', 1),
(195, '2022-07-11 11:54:13', 'Creacion de nuevo indicador: Mantenimiento, rehabilitacion y mejora de equipos a nivel de software', 1),
(196, '2022-07-11 11:54:31', 'Creacion de nuevo indicador: Informes Tecnicos realizados', 1),
(197, '2022-07-11 11:54:51', 'Creacion de nuevo indicador: Inspecciones y diagnosticos tecnicos', 1),
(198, '2022-07-11 11:55:04', 'Creacion de nuevo indicador: Jornadas de formacion', 1),
(199, '2022-07-11 11:55:19', 'Creacion de nuevo indicador: Reuniones de trabajos realizadas', 1),
(200, '2022-07-11 11:55:39', 'Creacion de nuevo indicador: Sistematización y automatización de procesos', 1),
(201, '2022-07-11 11:55:50', 'Creacion de nuevo indicador: Aplicaciones y sistemas instalados', 1),
(202, '2022-07-11 11:56:07', 'Creacion de nuevo indicador: Procura, adquisicion de equipos y sistemas tecnologicos', 1),
(203, '2022-07-11 11:56:30', 'Creacion de nuevo indicador: Adminsitracion de sistemas de redes, plataformas y sistemas tecnologicos.', 1),
(204, '2022-07-11 12:02:50', 'Creacion de nueva actividad: Instalación de toner', 1),
(205, '2022-07-11 12:03:52', 'Creacion de un nuevo paso: Descripcion de la instalacion del toner', 1),
(206, '2022-07-11 12:03:55', 'Visualizo el listado de pasos', 1),
(207, '2022-07-11 12:05:56', 'Creacion de nueva solicitud: Cambio de toner de la impresora', 1),
(208, '2022-07-11 12:08:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(209, '2022-07-11 12:08:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(210, '2022-07-11 12:15:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(211, '2022-07-11 12:16:15', 'Actualizo la siguiente solicitud: Cambio de toner de la impresora', 1),
(212, '2022-07-11 12:16:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(213, '2022-07-11 12:17:27', 'Visualizo el listado de solicitud', 1),
(214, '2022-07-11 12:18:08', 'Creacion de nueva asignacion: realizar cambio del toner', 1),
(215, '2022-07-11 12:18:09', 'Visualizo el listado de solicitud', 1),
(216, '2022-07-11 12:18:14', 'Visualizo el listado de asignaciones', 1),
(217, '2022-07-11 12:19:58', 'Visualizo el listado de solicitud', 1),
(218, '2022-07-11 12:20:09', 'Visualizo el listado de asignaciones', 1),
(219, '2022-07-11 12:21:16', 'Visualizo el listado de asignaciones', 1),
(220, '2022-07-11 12:21:33', 'Visualizo el listado de asignaciones', 1),
(221, '2022-07-11 12:22:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(222, '2022-07-11 12:24:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(223, '2022-07-11 12:24:56', 'Visualizo el listado de asignaciones', 1),
(224, '2022-07-11 12:25:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(225, '2022-07-11 12:25:49', 'Visualizo el listado de asignaciones', 1),
(226, '2022-07-11 12:26:57', 'Creacion de nuevo paso procesado: se realizo el cambio de toner de manera satisfactoria', 1),
(227, '2022-07-11 12:29:54', 'Inicio de Sesion', 1),
(228, '2022-07-11 12:29:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(229, '2022-07-11 12:30:15', 'Visualizo el listado de asignaciones', 1),
(230, '2022-07-11 12:31:16', 'Visualizo el listado de asignaciones', 1),
(231, '2022-07-11 12:33:01', 'Asignacion finalizada: 2', 1),
(232, '2022-07-11 12:34:14', 'Visualizo el listado de asignaciones', 1),
(233, '2022-07-11 12:34:17', 'Visualizo el listado de anexo de asignaciones', 1),
(234, '2022-07-11 12:34:37', 'Visualizo el listado de anexo de asignaciones', 1),
(235, '2022-07-11 12:34:42', 'Visualizo el listado de anexo de asignaciones', 1),
(236, '2022-07-11 12:34:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(237, '2022-07-11 12:40:15', 'Visualizo el listado de solicitud', 1),
(238, '2022-07-11 12:41:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(239, '2022-07-11 12:41:54', 'Visualizo el listado de solicitud', 1),
(240, '2022-07-11 12:42:10', 'Visualizo el listado de solicitud', 1),
(241, '2022-07-11 12:42:35', 'Visualizo el listado de solicitud', 1),
(242, '2022-07-11 12:43:02', 'Visualizo el listado de solicitud', 1),
(243, '2022-07-11 12:43:17', 'Visualizo el listado de solicitud', 1),
(244, '2022-07-11 12:43:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(245, '2022-07-11 12:43:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(246, '2022-07-11 12:44:17', 'Visualizo el listado de solicitud', 1),
(247, '2022-07-11 12:44:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(248, '2022-07-11 12:45:29', 'Visualizo el listado de actividades', 1),
(249, '2022-07-11 12:52:18', 'Inicio de Sesion', 1),
(250, '2022-07-11 12:52:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(251, '2022-07-11 12:53:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(252, '2022-07-11 14:16:48', 'Inicio de Sesion', 1),
(253, '2022-07-11 14:16:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(254, '2022-07-11 14:20:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(255, '2022-07-11 14:24:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(256, '2022-07-11 14:27:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(257, '2022-07-11 14:30:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(258, '2022-07-11 14:33:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(259, '2022-07-11 14:35:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(260, '2022-07-12 08:24:04', 'Inicio de Sesion', 1),
(261, '2022-07-12 08:24:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(262, '2022-07-12 08:26:21', 'Visualizo el listado de actividades', 1),
(263, '2022-07-12 08:26:46', 'Creacion de nueva actividad: Recarga de tinta', 1),
(264, '2022-07-12 08:26:48', 'Visualizo el listado de actividades', 1),
(265, '2022-07-12 08:27:31', 'Creacion de un nuevo paso: Descripcion de recarga de tinta', 1),
(266, '2022-07-12 08:27:37', 'Visualizo el listado de pasos', 1),
(267, '2022-07-12 08:28:06', 'Inicio de Sesion', 10101),
(268, '2022-07-12 08:28:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(269, '2022-07-12 08:28:41', 'Visualizo el listado de cargos', 1),
(270, '2022-07-12 08:29:50', 'Inicio de Sesion', 10083),
(271, '2022-07-12 08:29:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(272, '2022-07-12 08:31:24', 'Creacion de nueva actividad: instalacion de impresora', 10101),
(273, '2022-07-12 08:31:27', 'Creacion de nueva actividad: Instalación sistema operativo', 10083),
(274, '2022-07-12 08:32:30', 'Creacion de un nuevo paso: Descripción de Instalación sistema operativo', 10083),
(275, '2022-07-12 08:32:42', 'Visualizo el listado de actividades', 10083),
(276, '2022-07-12 08:33:45', 'Creacion de un nuevo paso: Descripción de instalación de impresora', 10101),
(277, '2022-07-12 08:33:52', 'Creacion de nueva actividad: Desbloqueo de clave de S.O', 10083),
(278, '2022-07-12 08:34:32', 'Creacion de un nuevo paso: Descripción Desbloqueo de clave de S.O', 10083),
(279, '2022-07-12 08:35:29', 'Creacion de nueva actividad: Corrección de hora y fecha', 10083),
(280, '2022-07-12 08:35:55', 'Creacion de nueva actividad: Atasco de papel en Impresora', 10101),
(281, '2022-07-12 08:35:57', 'Creacion de un nuevo paso: Descripción Corrección de hora y fecha', 10083),
(282, '2022-07-12 08:36:41', 'Creacion de nueva actividad: Inducción de Aplicaciones', 10083),
(283, '2022-07-12 08:36:55', 'Creacion de un nuevo paso: Descripción de atasco de papel en impresora', 10101),
(284, '2022-07-12 08:37:20', 'Creacion de un nuevo paso: Descripción Inducción de Aplicaciones', 10083),
(285, '2022-07-12 08:38:03', 'Creacion de nueva actividad: Revisión de impresora', 10101),
(286, '2022-07-12 08:39:03', 'Creacion de nueva actividad: Escaneo y liberacion de virus a trasves de software', 10083),
(287, '2022-07-12 08:39:07', 'Visualizo el listado de pasos', 10101),
(288, '2022-07-12 08:39:52', 'Creacion de un nuevo paso: Descripción Escaneo y liberación de virus a trasvés de software', 10083),
(289, '2022-07-12 08:40:30', 'Creacion de nueva actividad: Instalaciones de aplicaciones', 10083),
(290, '2022-07-12 08:40:47', 'Visualizo el listado de actividades', 10101),
(291, '2022-07-12 08:40:59', 'Creacion de un nuevo paso: Descripción Instalaciones de aplicaciones', 10083),
(292, '2022-07-12 08:41:41', 'Creacion de nueva actividad: Respaldo de informacion', 10083),
(293, '2022-07-12 08:42:34', 'Visualizo el listado de actividades', 10101),
(294, '2022-07-12 08:42:46', 'Visualizo el listado de actividades', 10101),
(295, '2022-07-12 08:43:04', 'Hizo la siguiente busqueda: impresora en el listado de actividades', 10101),
(296, '2022-07-12 08:43:06', 'Creacion de un nuevo paso: Descripción Respaldo de informacion', 10083),
(297, '2022-07-12 08:43:22', 'Visualizo el listado de actividades', 10083),
(298, '2022-07-12 08:43:27', 'Visualizo el listado de actividades', 10083),
(299, '2022-07-12 08:44:18', 'Creacion de nueva actividad: Reconexión de Impresora', 10101),
(300, '2022-07-12 08:45:25', 'Creacion de un nuevo paso: Descripción de Reconexión de impresora', 10101),
(301, '2022-07-12 08:46:43', 'Creacion de nuevo sector: Complejo Deportivo General Jose Antonio Anzoategui', 1),
(302, '2022-07-12 08:46:53', 'Creacion de nueva actividad: Reparacion de Impresora', 10101),
(303, '2022-07-12 08:47:55', 'Creacion de un nuevo paso: Descripción de reparación de impresora', 10101),
(304, '2022-07-12 08:47:56', 'Creacion de nueva actividad: Punto de Red', 10083),
(305, '2022-07-12 08:48:34', 'Creacion de un nuevo paso: Descripcion Punto de Red', 10083),
(306, '2022-07-12 08:49:15', 'Creacion de nueva actividad: Elaboracion de cable de red', 10083),
(307, '2022-07-12 08:49:40', 'Creacion de un nuevo paso: Descripcion Elaboracion de cable de red', 10083),
(308, '2022-07-12 08:50:15', 'Creacion de nueva actividad: Verificacion de cable de red', 10083),
(309, '2022-07-12 08:50:38', 'Creacion de un nuevo paso: Descripcion Verificacion de cable de red', 10083),
(310, '2022-07-12 08:51:21', 'Creacion de nueva actividad: Instalacion de cable de red', 10083),
(311, '2022-07-12 08:51:28', 'Creacion de nuevo sector: Edif. Sede Covinea', 1),
(312, '2022-07-12 08:51:43', 'Creacion de un nuevo paso: Descripcion Instalacion de cable de red', 10083),
(313, '2022-07-12 08:52:07', 'Creacion de nueva actividad: Revisión de Componentes', 10101),
(314, '2022-07-12 08:52:32', 'Creacion de nueva actividad: Reconectar cable de red', 10083),
(315, '2022-07-12 08:52:59', 'Creacion de un nuevo paso: Descripcion Reconectar cable de red', 10083),
(316, '2022-07-12 08:54:32', 'Creacion de nueva actividad: Reparacion de componentes electronicos', 10083),
(317, '2022-07-12 08:55:36', 'Creacion de un nuevo paso: Descripcion Reparacion de componentes electronicos', 10083),
(318, '2022-07-12 08:55:47', 'Creacion de un nuevo paso: Descripción de Revisión de  componentes electrónico', 10101),
(319, '2022-07-12 08:56:34', 'Creacion de nueva actividad: Apoyo a operativo tecnicos', 10083),
(320, '2022-07-12 08:58:03', 'Creacion de un nuevo paso: Descripcion Apoyo a operativo tecnicos', 10083),
(321, '2022-07-12 08:58:51', 'Creacion de nueva actividad: Peinado de cable UTP', 10083),
(322, '2022-07-12 08:59:28', 'Creacion de un nuevo paso: Descripcion Peinado de cable UTP', 10083),
(323, '2022-07-12 09:00:10', 'Creacion de nueva actividad: Tendido de cable UTP', 10083),
(324, '2022-07-12 09:00:37', 'Creacion de un nuevo paso: Descripcion Tendido de cable UTP', 10083),
(325, '2022-07-12 09:00:45', 'Creacion de nueva actividad: Configuración de Dispositivos Tecnológico', 10101),
(326, '2022-07-12 09:01:39', 'Creacion de nueva actividad: Ensamblar equipos de computacion', 10083),
(327, '2022-07-12 09:01:54', 'Creacion de un nuevo paso: Descripcion de Configuración de Dispositivos Tecnológico', 10101),
(328, '2022-07-12 09:02:07', 'Creacion de un nuevo paso: Descripcion Ensamblar equipos de computacion', 10083),
(329, '2022-07-12 09:02:51', 'Creacion de nuevo indicador: Diseño Grafico', 10101),
(330, '2022-07-12 09:03:10', 'Creacion de nueva actividad: Adquisición de equipos tecnológicos', 10083),
(331, '2022-07-12 09:03:29', 'Creacion de un nuevo paso: Descripcion Adquisición de equipos tecnológicos', 10083),
(332, '2022-07-12 09:03:54', 'Creacion de nueva actividad: Diseño Grafico', 10101),
(333, '2022-07-12 09:05:05', 'Creacion de un nuevo paso: Descripción de Diseño Grafico', 10101),
(334, '2022-07-12 09:05:52', 'Creacion de nueva actividad: Apoyo a operaciones administrativas', 10083),
(335, '2022-07-12 09:06:21', 'Creacion de un nuevo paso: Descripcion Apoyo a operaciones administrativas', 10083),
(336, '2022-07-12 09:07:52', 'Creacion de nuevo indicador: Apoyo Administrativo', 1),
(337, '2022-07-12 09:08:03', 'Creacion de nuevo indicador: Apoyo Tecnico', 1),
(338, '2022-07-12 09:08:26', 'Creacion de nueva actividad: Levantamiento de informacion', 10083),
(339, '2022-07-12 09:08:30', 'Creacion de nueva actividad: Acceso de conectividad de pfesente', 10101),
(340, '2022-07-12 09:08:58', 'Creacion de un nuevo paso: Descripcion Levantamiento de informacion', 10083),
(341, '2022-07-12 09:09:11', 'Creacion de un nuevo paso: Desripcion de Acceso de conectividad de pfesente', 10101),
(342, '2022-07-12 09:09:45', 'Visualizo el listado de categorias', 1),
(343, '2022-07-12 09:09:51', 'Visualizo el listado de categorias', 1),
(344, '2022-07-12 09:10:09', 'Creacion de nueva categoria: MANTENIMIENTO', 1),
(345, '2022-07-12 09:10:12', 'Visualizo el listado de categorias', 1),
(346, '2022-07-12 09:10:51', 'Creacion de nueva actividad: Reuniones de trabajo', 10083),
(347, '2022-07-12 09:11:22', 'Creacion de nueva actividad: Crear usuario en aplicaciónes', 10101),
(348, '2022-07-12 09:12:01', 'Creacion de un nuevo paso: Descripcion Reuniones de trabajo', 10083),
(349, '2022-07-12 09:12:22', 'Creacion de un nuevo paso: Descripción de Crear usuario en aplicaciones', 10101),
(350, '2022-07-12 09:13:20', 'Creacion de nueva actividad: Mantenimientos de aerea de trabajos', 10083),
(351, '2022-07-12 09:13:50', 'Creacion de un nuevo paso: Descripcion Mantenimientos de aerea de trabajos', 10083),
(352, '2022-07-12 09:14:03', 'Creacion de nueva actividad: Restablecer Conexión Internet', 10101),
(353, '2022-07-12 09:14:57', 'Creacion de nueva actividad: Bloquear usuario a internet', 10083),
(354, '2022-07-12 09:15:19', 'Creacion de un nuevo paso: Descripcion Bloquear usuario a internet', 10083),
(355, '2022-07-12 09:15:20', 'Creacion de un nuevo paso: Descripción Restablecer Conexión Internet', 10101),
(356, '2022-07-12 09:15:43', 'Visualizo el listado de actividades', 1),
(357, '2022-07-12 09:15:52', 'Visualizo el listado de actividades', 1),
(358, '2022-07-12 09:15:56', 'Visualizo el listado de actividades', 1),
(359, '2022-07-12 09:16:07', 'Visualizo el listado de pasos', 10101),
(360, '2022-07-12 09:16:19', 'Visualizo el listado de pasos', 10101),
(361, '2022-07-12 09:16:24', 'Visualizo el listado de pasos', 10101),
(362, '2022-07-12 09:16:28', 'Visualizo el listado de pasos', 10101),
(363, '2022-07-12 09:16:30', 'Visualizo el listado de pasos', 10101),
(364, '2022-07-12 09:16:34', 'Visualizo el listado de pasos', 10101),
(365, '2022-07-12 09:16:37', 'Visualizo el listado de pasos', 10101),
(366, '2022-07-12 09:19:35', 'Visualizo el listado de actividades', 10083),
(367, '2022-07-12 09:19:38', 'Visualizo el listado de actividades', 10083),
(368, '2022-07-12 09:19:40', 'Visualizo el listado de actividades', 10083),
(369, '2022-07-12 09:19:42', 'Visualizo el listado de actividades', 10083),
(370, '2022-07-12 09:19:45', 'Visualizo el listado de actividades', 10083),
(371, '2022-07-12 09:19:45', 'Visualizo el listado de actividades', 10083),
(372, '2022-07-12 09:19:45', 'Visualizo el listado de actividades', 10083),
(373, '2022-07-12 09:19:48', 'Visualizo el listado de actividades', 10083),
(374, '2022-07-12 09:22:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(375, '2022-07-12 09:22:06', 'Visualizo el listado de solicitud', 1),
(376, '2022-07-12 09:22:14', 'Inicio de Sesion', 10083),
(377, '2022-07-12 09:22:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(378, '2022-07-12 09:23:10', 'Visualizo el listado de solicitud', 1),
(379, '2022-07-12 09:23:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(380, '2022-07-12 09:23:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(381, '2022-07-12 09:23:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(382, '2022-07-12 09:34:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(383, '2022-07-12 09:37:48', 'Visualizo el listado de actividades', 1),
(384, '2022-07-12 09:38:16', 'Visualizo el listado de actividades', 1),
(385, '2022-07-12 09:38:37', 'Visualizo el listado de actividades', 1),
(386, '2022-07-12 09:39:10', 'Visualizo el listado de actividades', 1),
(387, '2022-07-12 09:39:22', 'Visualizo el listado de actividades', 1),
(388, '2022-07-12 09:40:55', 'Creacion de nueva actividad: Reparacion de Sistema Operativo', 1),
(389, '2022-07-12 09:41:51', 'Creacion de nueva solicitud: Revision y reparacion de mi computadora, muestra mucha lentitud, mas de lo habitual', 1),
(390, '2022-07-12 09:42:00', 'Visualizo el listado de asignaciones', 1),
(391, '2022-07-12 09:42:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(392, '2022-07-12 09:42:52', 'Actualizo la siguiente solicitud: Revision y reparacion de mi computadora, muestra mucha lentitud, mas de lo habitual', 1),
(393, '2022-07-12 09:42:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(394, '2022-07-12 09:43:27', 'Visualizo el listado de solicitud', 1),
(395, '2022-07-12 09:47:37', 'Creacion de nueva asignacion: ir a sitio y comprobar porque el equipo esta presentando esta anomalia.', 1),
(396, '2022-07-12 09:47:37', 'Visualizo el listado de solicitud', 1),
(397, '2022-07-12 09:48:35', 'Visualizo el listado de asignaciones', 1),
(398, '2022-07-12 09:51:04', 'Creacion de un nuevo paso: Descripcion de reparacion de sistema operativo', 1),
(399, '2022-07-12 09:51:10', 'Visualizo el listado de asignaciones', 1),
(400, '2022-07-12 09:51:23', 'Creacion de nuevo paso procesado: Se desinstalaron varias aplicaciones no necesarias que estaban ejerciendo un alto consumo de recursos del equipo y esto influia en la rapidez del mismo, y con esto se mejoro la lentitud del equipo.', 1),
(401, '2022-07-12 09:51:55', 'Asignacion finalizada: 4', 1),
(402, '2022-07-12 09:51:58', 'Visualizo el listado de asignaciones', 1),
(403, '2022-07-12 09:52:17', 'Visualizo el listado de solicitud', 1),
(404, '2022-07-12 09:53:05', 'Visualizo el listado de solicitud', 1),
(405, '2022-07-12 10:05:30', 'Inicio de Sesion', 10082),
(406, '2022-07-12 10:05:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(407, '2022-07-12 10:08:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(408, '2022-07-12 10:12:12', 'Creacion de nueva solicitud: Necesito un cable de Red', 10082),
(409, '2022-07-12 10:12:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(410, '2022-07-12 10:12:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(411, '2022-07-12 10:14:02', 'Actualizo la siguiente solicitud: Necesito un cable de Red', 10082),
(412, '2022-07-12 10:14:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(413, '2022-07-12 10:14:12', 'Visualizo el listado de asignaciones', 10082),
(414, '2022-07-12 10:14:25', 'Visualizo el listado de asignaciones', 10082),
(415, '2022-07-12 10:14:35', 'Visualizo el listado de asignaciones', 10082),
(416, '2022-07-12 10:15:05', 'Visualizo el listado de actividades', 10082),
(417, '2022-07-12 10:15:17', 'Visualizo el listado de actividades', 10082),
(418, '2022-07-12 10:15:27', 'Visualizo el listado de actividades', 10082),
(419, '2022-07-12 10:15:41', 'Visualizo el listado de asignaciones', 10082),
(420, '2022-07-12 10:15:53', 'Visualizo el listado de asignaciones', 10082),
(421, '2022-07-12 10:16:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(422, '2022-07-12 10:16:18', 'Visualizo el listado de solicitud', 10082),
(423, '2022-07-12 10:16:57', 'Actualizo la siguiente solicitud: Necesito un cable de Red', 10082),
(424, '2022-07-12 10:16:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(425, '2022-07-12 10:17:09', 'Visualizo el listado de solicitud', 10082),
(426, '2022-07-12 10:17:45', 'Actualizo la siguiente solicitud: Necesito un cable de Red', 10082),
(427, '2022-07-12 10:17:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(428, '2022-07-12 10:17:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(429, '2022-07-12 10:18:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(430, '2022-07-12 10:18:08', 'Visualizo el listado de solicitud', 10082),
(431, '2022-07-12 10:18:36', 'Visualizo el listado de solicitud', 10082),
(432, '2022-07-12 10:20:08', 'Creacion de nueva asignacion: Preséntese a tesorería y realice la creación de un cable de red', 10082),
(433, '2022-07-12 10:20:08', 'Visualizo el listado de solicitud', 10082),
(434, '2022-07-12 10:20:29', 'Visualizo el listado de asignaciones', 10082),
(435, '2022-07-12 10:27:08', 'Creacion de un nuevo paso: Los cables de red pueden vincular dos equipos de manera directa o realizar la conexión entre un dispositivo y un router o un switch', 10082),
(436, '2022-07-12 10:27:17', 'Visualizo el listado de asignaciones', 10082),
(437, '2022-07-12 10:28:04', 'Creacion de nuevo paso procesado: Se procedió a la creación de un cable de red sin ninguna novedad ni contratiempo', 10082),
(438, '2022-07-12 10:28:19', 'Asignacion finalizada: 8', 10082),
(439, '2022-07-12 10:28:20', 'Visualizo el listado de asignaciones', 10082),
(440, '2022-07-12 10:28:30', 'Visualizo el listado de solicitud', 10082),
(441, '2022-07-12 10:29:03', 'Visualizo el listado de solicitud', 10082),
(442, '2022-07-12 10:34:05', 'Creacion de nueva solicitud: Requiero un chequeo de un punto de red', 10082),
(443, '2022-07-12 10:34:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(444, '2022-07-12 10:46:05', 'Inicio de Sesion', 10083),
(445, '2022-07-12 10:46:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(446, '2022-07-12 10:49:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(447, '2022-07-12 10:52:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(448, '2022-07-12 10:52:16', 'Inicio de Sesion', 10101),
(449, '2022-07-12 10:52:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(450, '2022-07-12 10:52:22', 'Visualizo el listado de solicitud', 10101),
(451, '2022-07-12 10:53:23', 'Actualizo la siguiente solicitud: Requiero de mantenimiento de hardware', 10101),
(452, '2022-07-12 10:53:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(453, '2022-07-12 10:53:44', 'Visualizo el listado de asignaciones', 10101),
(454, '2022-07-12 10:53:52', 'Visualizo el listado de solicitud', 10101),
(455, '2022-07-12 10:54:14', 'Actualizo la siguiente solicitud: Requiero de mantenimiento de hardware', 10101),
(456, '2022-07-12 10:54:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(457, '2022-07-12 10:54:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(458, '2022-07-12 10:54:36', 'Visualizo el listado de asignaciones', 10101),
(459, '2022-07-12 10:54:42', 'Visualizo el listado de solicitud', 10101),
(460, '2022-07-12 10:55:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(461, '2022-07-12 10:58:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(462, '2022-07-12 11:03:35', 'Creacion de nueva solicitud: Se requiere revisar equipos', 10083),
(463, '2022-07-12 11:03:39', 'Visualizo el listado de solicitud', 10083),
(464, '2022-07-12 11:04:22', 'Actualizo la siguiente solicitud: Se requiere revisar equipos', 10083),
(465, '2022-07-12 11:04:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(466, '2022-07-12 11:04:34', 'Creacion de nueva solicitud: se requiere recaudar datos del equipo', 10101),
(467, '2022-07-12 11:04:48', 'Visualizo el listado de solicitud', 10083),
(468, '2022-07-12 11:04:57', 'Visualizo el listado de asignaciones', 10101),
(469, '2022-07-12 11:05:03', 'Visualizo el listado de solicitud', 10083),
(470, '2022-07-12 11:05:04', 'Visualizo el listado de solicitud', 10101),
(471, '2022-07-12 11:05:10', 'Visualizo el listado de asignaciones', 10101),
(472, '2022-07-12 11:05:11', 'Visualizo el listado de asignaciones', 10083),
(473, '2022-07-12 11:05:17', 'Visualizo el listado de asignaciones', 10083),
(474, '2022-07-12 11:05:24', 'Visualizo el listado de solicitud', 10083),
(475, '2022-07-12 11:05:46', 'Visualizo el listado de asignaciones', 10101),
(476, '2022-07-12 11:06:12', 'Visualizo el listado de solicitud', 10101),
(477, '2022-07-12 11:07:39', 'Creacion de nueva asignacion: Se armo y preparo una PC antes perteneciente a Paulimer Brito', 10083),
(478, '2022-07-12 11:07:39', 'Visualizo el listado de solicitud', 10083),
(479, '2022-07-12 11:07:43', 'Inicio de Sesion', 1),
(480, '2022-07-12 11:07:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(481, '2022-07-12 11:07:46', 'Visualizo el listado de asignaciones', 10083),
(482, '2022-07-12 11:08:31', 'Creacion de nuevo paso procesado: Se armo y preparo una PC antes pertenecientes  a Paulimer Brito', 10083),
(483, '2022-07-12 11:08:32', 'Visualizo el listado de direcciones', 10101),
(484, '2022-07-12 11:08:38', 'Asignacion finalizada: 14', 10083),
(485, '2022-07-12 11:08:39', 'Visualizo el listado de asignaciones', 10083),
(486, '2022-07-12 11:08:41', 'Hizo la siguiente busqueda: cultura en el listado de direcciones', 10101),
(487, '2022-07-12 11:08:43', 'Visualizo el listado de asignaciones', 10083),
(488, '2022-07-12 11:09:08', 'Inicio de Sesion', 1),
(489, '2022-07-12 11:09:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(490, '2022-07-12 11:09:11', 'Visualizo el listado de asignaciones', 10101),
(491, '2022-07-12 11:09:32', 'Visualizo el listado de asignaciones', 10101),
(492, '2022-07-12 11:09:36', 'Visualizo el listado de solicitud', 10101),
(493, '2022-07-12 11:09:49', 'Visualizo el listado de solicitud', 10101),
(494, '2022-07-12 11:09:50', 'Visualizo el listado de solicitud', 10083),
(495, '2022-07-12 11:09:50', 'Visualizo el listado de solicitud', 10083),
(496, '2022-07-12 11:10:19', 'Visualizo el listado de solicitud', 10101),
(497, '2022-07-12 11:11:44', 'Actualizo la siguiente solicitud: se requiere recaudar datos del equipo', 10101),
(498, '2022-07-12 11:11:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(499, '2022-07-12 11:11:49', 'Visualizo el listado de solicitud', 10101),
(500, '2022-07-12 11:11:57', 'Visualizo el listado de solicitud', 10083),
(501, '2022-07-12 11:11:58', 'Visualizo el listado de asignaciones', 10101),
(502, '2022-07-12 11:12:03', 'Visualizo el listado de asignaciones', 10101),
(503, '2022-07-12 11:12:13', 'Visualizo el listado de asignaciones', 10101),
(504, '2022-07-12 11:12:23', 'Visualizo el listado de solicitud', 10101),
(505, '2022-07-12 11:12:33', 'Visualizo el listado de solicitud', 10101),
(506, '2022-07-12 11:13:48', 'Creacion de nueva solicitud: Recaulacion de datos de internet', 10083),
(507, '2022-07-12 11:13:53', 'Visualizo el listado de solicitud', 10083),
(508, '2022-07-12 11:14:14', 'Actualizo la siguiente solicitud: Recaulacion de datos de internet', 10083),
(509, '2022-07-12 11:14:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(510, '2022-07-12 11:14:23', 'Visualizo el listado de solicitud', 10083),
(511, '2022-07-12 11:14:28', 'Visualizo el listado de solicitud', 10083),
(512, '2022-07-12 11:15:18', 'Creacion de nueva asignacion: se le requiere agregar a pfsente con privilegio a redes sociales', 10101),
(513, '2022-07-12 11:15:18', 'Visualizo el listado de solicitud', 10101),
(514, '2022-07-12 11:15:30', 'Creacion de nueva asignacion: Requiere datos de internet para administrarlos', 10083),
(515, '2022-07-12 11:15:30', 'Visualizo el listado de solicitud', 10083),
(516, '2022-07-12 11:15:32', 'Visualizo el listado de solicitud', 10101),
(517, '2022-07-12 11:15:35', 'Visualizo el listado de asignaciones', 10083),
(518, '2022-07-12 11:15:39', 'Visualizo el listado de asignaciones', 10101),
(519, '2022-07-12 11:15:43', 'Visualizo el listado de asignaciones', 10083),
(520, '2022-07-12 11:16:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(521, '2022-07-12 11:16:22', 'Visualizo el listado de solicitud', 10101),
(522, '2022-07-12 11:16:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(523, '2022-07-12 11:16:49', 'Visualizo el listado de solicitud', 10101),
(524, '2022-07-12 11:16:57', 'Creacion de nuevo paso procesado: Se recolecta los datos relacionados al internet a la nueva PC del director', 10083),
(525, '2022-07-12 11:17:02', 'Asignacion finalizada: 18', 10083),
(526, '2022-07-12 11:17:04', 'Visualizo el listado de asignaciones', 10083),
(527, '2022-07-12 11:17:18', 'Visualizo el listado de asignaciones', 10083),
(528, '2022-07-12 11:17:23', 'Visualizo el listado de solicitud', 10083),
(529, '2022-07-12 11:17:24', 'Visualizo el listado de solicitud', 10101),
(530, '2022-07-12 11:17:41', 'Visualizo el listado de solicitud', 10083),
(531, '2022-07-12 11:18:09', 'Actualizo la siguiente solicitud: se requiere recaudar datos del equipo', 10101),
(532, '2022-07-12 11:18:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(533, '2022-07-12 11:18:15', 'Visualizo el listado de solicitud', 10101),
(534, '2022-07-12 11:18:22', 'Visualizo el listado de solicitud', 10101),
(535, '2022-07-12 11:18:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(536, '2022-07-12 11:18:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(537, '2022-07-12 11:18:49', 'Visualizo el listado de solicitud', 10101),
(538, '2022-07-12 11:19:13', 'Actualizo la siguiente solicitud: se requiere recaudar datos del equipo', 10101),
(539, '2022-07-12 11:19:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(540, '2022-07-12 11:19:29', 'Visualizo el listado de solicitud', 10101),
(541, '2022-07-12 11:19:31', 'Visualizo el listado de solicitud', 10101),
(542, '2022-07-12 11:19:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(543, '2022-07-12 11:19:45', 'Visualizo el listado de solicitud', 10101),
(544, '2022-07-12 11:20:13', 'Actualizo la siguiente solicitud: se requiere recaudar datos del equipo', 10101),
(545, '2022-07-12 11:20:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(546, '2022-07-12 11:20:26', 'Visualizo el listado de asignaciones', 10101),
(547, '2022-07-12 11:20:51', 'Visualizo el listado de asignaciones', 10101),
(548, '2022-07-12 11:21:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(549, '2022-07-12 11:21:31', 'Visualizo el listado de asignaciones', 10101),
(550, '2022-07-12 11:21:43', 'Visualizo el listado de asignaciones', 10101),
(551, '2022-07-12 11:21:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(552, '2022-07-12 11:22:22', 'Visualizo el listado de asignaciones', 10101),
(553, '2022-07-12 11:24:06', 'Creacion de nueva solicitud: Recaudacion de datos en equipos', 10101),
(554, '2022-07-12 11:24:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(555, '2022-07-12 11:24:30', 'Actualizo la siguiente solicitud: Recaudacion de datos en equipos', 10101),
(556, '2022-07-12 11:24:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(557, '2022-07-12 11:24:37', 'Visualizo el listado de solicitud', 10101),
(558, '2022-07-12 11:25:01', 'Actualizo la siguiente solicitud: Recaudacion de datos en equipos', 10101),
(559, '2022-07-12 11:25:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(560, '2022-07-12 11:25:06', 'Visualizo el listado de solicitud', 10101),
(561, '2022-07-12 11:25:14', 'Creacion de nueva solicitud: Realizacion de cable de red', 10083),
(562, '2022-07-12 11:25:19', 'Visualizo el listado de solicitud', 10083),
(563, '2022-07-12 11:25:36', 'Actualizo la siguiente solicitud: Realizacion de cable de red', 10083),
(564, '2022-07-12 11:25:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(565, '2022-07-12 11:25:45', 'Visualizo el listado de asignaciones', 10083),
(566, '2022-07-12 11:25:53', 'Visualizo el listado de asignaciones', 10083),
(567, '2022-07-12 11:25:56', 'Visualizo el listado de solicitud', 10083),
(568, '2022-07-12 11:25:59', 'Actualizo la siguiente solicitud: Recaudacion de datos en equipos', 10101),
(569, '2022-07-12 11:26:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101);
INSERT INTO `bitacora` (`bitacora_id`, `bitacora_fecha`, `bitacora_accion`, `usuario_id`) VALUES
(570, '2022-07-12 11:26:07', 'Visualizo el listado de asignaciones', 10101),
(571, '2022-07-12 11:26:11', 'Visualizo el listado de solicitud', 10101),
(572, '2022-07-12 11:27:10', 'Creacion de nueva asignacion: Se creo un cable de red de 5 metros aproximadamente para tesoreria', 10083),
(573, '2022-07-12 11:27:10', 'Visualizo el listado de solicitud', 10083),
(574, '2022-07-12 11:27:14', 'Visualizo el listado de asignaciones', 10083),
(575, '2022-07-12 11:27:20', 'Visualizo el listado de asignaciones', 10083),
(576, '2022-07-12 11:27:20', 'Creacion de nueva asignacion: Agregar a pfsente con privilegio a redes sociales', 10101),
(577, '2022-07-12 11:27:21', 'Visualizo el listado de solicitud', 10101),
(578, '2022-07-12 11:27:23', 'Visualizo el listado de asignaciones', 10083),
(579, '2022-07-12 11:27:33', 'Visualizo el listado de asignaciones', 10101),
(580, '2022-07-12 11:27:59', 'Creacion de nuevo paso procesado: Se creo un cable de 5 Metros para estar conectividad con la red', 10083),
(581, '2022-07-12 11:28:04', 'Asignacion finalizada: 26', 10083),
(582, '2022-07-12 11:28:06', 'Visualizo el listado de asignaciones', 10083),
(583, '2022-07-12 11:28:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(584, '2022-07-12 11:28:12', 'Visualizo el listado de solicitud', 10083),
(585, '2022-07-12 11:28:28', 'Visualizo el listado de solicitud', 10083),
(586, '2022-07-12 11:28:46', 'Creacion de nuevo paso procesado: se le agrego dirección mac al pfsente con privilegio a redes sociales', 10101),
(587, '2022-07-12 11:28:52', 'Asignacion finalizada: 21', 10101),
(588, '2022-07-12 11:28:53', 'Visualizo el listado de asignaciones', 10101),
(589, '2022-07-12 11:28:57', 'Visualizo el listado de solicitud', 10101),
(590, '2022-07-12 11:29:46', 'Visualizo el listado de solicitud', 10101),
(591, '2022-07-12 11:30:03', 'Inicio de Sesion', 1),
(592, '2022-07-12 11:30:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(593, '2022-07-12 11:30:05', 'Creacion de nueva solicitud: Entregas de cable de red', 10083),
(594, '2022-07-12 11:30:10', 'Visualizo el listado de solicitud', 10083),
(595, '2022-07-12 11:32:23', 'Actualizo la siguiente solicitud: Entregas de cable de red', 10083),
(596, '2022-07-12 11:32:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(597, '2022-07-12 11:32:28', 'Visualizo el listado de solicitud', 10083),
(598, '2022-07-12 11:32:39', 'Visualizo el listado de solicitud', 10083),
(599, '2022-07-12 11:32:53', 'Creacion de nueva solicitud: mantenimiento del equipo', 10101),
(600, '2022-07-12 11:33:01', 'Visualizo el listado de solicitud', 10101),
(601, '2022-07-12 11:33:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(602, '2022-07-12 11:33:19', 'Creacion de nueva asignacion: Se entrego un cable de red de 5 Metros en una PC de tesoreria', 10083),
(603, '2022-07-12 11:33:20', 'Visualizo el listado de solicitud', 10083),
(604, '2022-07-12 11:33:26', 'Actualizo la siguiente solicitud: mantenimiento del equipo', 10101),
(605, '2022-07-12 11:33:27', 'Visualizo el listado de asignaciones', 10083),
(606, '2022-07-12 11:33:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(607, '2022-07-12 11:33:30', 'Visualizo el listado de asignaciones', 10083),
(608, '2022-07-12 11:33:32', 'Visualizo el listado de solicitud', 10101),
(609, '2022-07-12 11:34:01', 'Creacion de nuevo paso procesado: Primero se habia hecho un cable de red', 10083),
(610, '2022-07-12 11:34:23', 'Creacion de nuevo paso procesado: Lo realice y lo coloque juntos', 10083),
(611, '2022-07-12 11:34:27', 'Creacion de nuevo paso procesado: ', 10083),
(612, '2022-07-12 11:34:30', 'Creacion de nuevo paso procesado: ', 10083),
(613, '2022-07-12 11:34:34', 'Creacion de nueva asignacion: El equipo necesita un diagnostico', 10101),
(614, '2022-07-12 11:34:36', 'Creacion de nueva asignacion: El equipo necesita un diagnostico', 10101),
(615, '2022-07-12 11:34:36', 'Visualizo el listado de solicitud', 10101),
(616, '2022-07-12 11:34:36', 'Visualizo el listado de solicitud', 10101),
(617, '2022-07-12 11:34:46', 'Visualizo el listado de asignaciones', 10101),
(618, '2022-07-12 11:34:49', 'Creacion de nuevo paso procesado: Fuimos a entregarlo fue de 5 Metros', 10083),
(619, '2022-07-12 11:34:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(620, '2022-07-12 11:34:54', 'Asignacion finalizada: 29', 10083),
(621, '2022-07-12 11:34:56', 'Visualizo el listado de asignaciones', 10083),
(622, '2022-07-12 11:35:00', 'Visualizo el listado de solicitud', 10101),
(623, '2022-07-12 11:35:01', 'Visualizo el listado de solicitud', 10083),
(624, '2022-07-12 11:35:20', 'Visualizo el listado de solicitud', 10101),
(625, '2022-07-12 11:35:22', 'Visualizo el listado de solicitud', 10083),
(626, '2022-07-12 11:35:27', 'Visualizo el listado de solicitud', 10101),
(627, '2022-07-12 11:35:52', 'Visualizo el listado de solicitud', 10101),
(628, '2022-07-12 11:36:17', 'Visualizo el listado de asignaciones', 10101),
(629, '2022-07-12 11:36:31', 'Actualizo la siguiente asignacion: El equipo necesita un diagnostico', 10101),
(630, '2022-07-12 11:36:35', 'Visualizo el listado de asignaciones', 10101),
(631, '2022-07-12 11:36:46', 'Visualizo el listado de solicitud', 10101),
(632, '2022-07-12 11:36:55', 'Visualizo el listado de solicitud', 10101),
(633, '2022-07-12 11:36:59', 'Visualizo el listado de solicitud', 10101),
(634, '2022-07-12 11:37:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(635, '2022-07-12 11:37:05', 'Visualizo el listado de asignaciones', 10101),
(636, '2022-07-12 11:37:12', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(637, '2022-07-12 11:37:17', 'Visualizo el listado de asignaciones', 10101),
(638, '2022-07-12 11:37:26', 'Visualizo el listado de solicitud', 10101),
(639, '2022-07-12 11:37:40', 'Visualizo el listado de solicitud', 10101),
(640, '2022-07-12 11:38:35', 'Creacion de nueva asignacion: Se le requiere acceso a redes sociales', 10101),
(641, '2022-07-12 11:38:36', 'Visualizo el listado de solicitud', 10101),
(642, '2022-07-12 11:38:40', 'Visualizo el listado de asignaciones', 10101),
(643, '2022-07-12 11:38:47', 'Visualizo el listado de asignaciones', 10101),
(644, '2022-07-12 11:39:18', 'Elimino el siguiente asignacion: El equipo necesita un diagnostico', 10101),
(645, '2022-07-12 11:39:20', 'Visualizo el listado de asignaciones', 10101),
(646, '2022-07-12 11:39:30', 'Elimino el siguiente asignacion: Se le requiere acceso a redes sociales', 10101),
(647, '2022-07-12 11:39:33', 'Visualizo el listado de asignaciones', 10101),
(648, '2022-07-12 11:39:52', 'Visualizo el listado de solicitud', 10101),
(649, '2022-07-12 11:39:55', 'Visualizo el listado de solicitud', 10101),
(650, '2022-07-12 11:40:00', 'Visualizo el listado de solicitud', 10101),
(651, '2022-07-12 11:40:16', 'Visualizo el listado de solicitud', 10101),
(652, '2022-07-12 11:40:46', 'Visualizo el listado de solicitud', 10101),
(653, '2022-07-12 11:40:53', 'Visualizo el listado de solicitud', 10101),
(654, '2022-07-12 11:40:57', 'Visualizo el listado de asignaciones', 10101),
(655, '2022-07-12 11:41:21', 'Visualizo el listado de asignaciones', 10101),
(656, '2022-07-12 11:41:25', 'Visualizo el listado de asignaciones', 10101),
(657, '2022-07-12 11:41:37', 'Visualizo el listado de asignaciones', 10101),
(658, '2022-07-12 11:41:50', 'Visualizo el listado de asignaciones', 10101),
(659, '2022-07-12 11:41:58', 'Actualizo la siguiente asignacion: El equipo necesita un diagnostico', 10101),
(660, '2022-07-12 11:42:05', 'Visualizo el listado de asignaciones', 10101),
(661, '2022-07-12 11:42:12', 'Visualizo el listado de asignaciones', 10101),
(662, '2022-07-12 11:42:20', 'Actualizo la siguiente asignacion: El equipo necesita un diagnostico', 10101),
(663, '2022-07-12 11:42:30', 'Visualizo el listado de asignaciones', 10101),
(664, '2022-07-12 11:42:35', 'Visualizo el listado de asignaciones', 10101),
(665, '2022-07-12 11:42:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(666, '2022-07-12 11:43:14', 'Visualizo el listado de solicitud', 10101),
(667, '2022-07-12 11:43:24', 'Visualizo el listado de solicitud', 10101),
(668, '2022-07-12 11:45:16', 'Creacion de nueva solicitud: Realización de punto de red', 10101),
(669, '2022-07-12 11:45:22', 'Visualizo el listado de solicitud', 10101),
(670, '2022-07-12 11:45:53', 'Actualizo la siguiente solicitud: Realización de punto de red', 10101),
(671, '2022-07-12 11:45:55', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(672, '2022-07-12 11:45:59', 'Visualizo el listado de solicitud', 10101),
(673, '2022-07-12 11:46:03', 'Visualizo el listado de solicitud', 10101),
(674, '2022-07-12 11:46:32', 'Visualizo el listado de asignaciones', 10101),
(675, '2022-07-12 11:46:35', 'Visualizo el listado de solicitud', 10101),
(676, '2022-07-12 11:47:15', 'Creacion de nueva asignacion: agregar a pfsente con privilegio a redes sociales', 10101),
(677, '2022-07-12 11:47:15', 'Visualizo el listado de solicitud', 10101),
(678, '2022-07-12 11:48:23', 'Creacion de nueva asignacion: se necesita un diagnostico del equipo', 10101),
(679, '2022-07-12 11:48:24', 'Visualizo el listado de solicitud', 10101),
(680, '2022-07-12 11:48:58', 'Creacion de nueva asignacion: realización de cable de red', 10101),
(681, '2022-07-12 11:48:58', 'Visualizo el listado de solicitud', 10101),
(682, '2022-07-12 11:49:05', 'Visualizo el listado de asignaciones', 10101),
(683, '2022-07-12 11:49:09', 'Visualizo el listado de asignaciones', 10101),
(684, '2022-07-12 11:50:49', 'Creacion de nuevo paso procesado: Realización de cable de red', 10101),
(685, '2022-07-12 11:50:56', 'Asignacion finalizada: 33', 10101),
(686, '2022-07-12 11:50:57', 'Visualizo el listado de asignaciones', 10101),
(687, '2022-07-12 11:52:01', 'Creacion de nueva solicitud: Verificación de cable de red', 10083),
(688, '2022-07-12 11:52:04', 'Creacion de nuevo paso procesado: Se requiere que le den acceso a redes sociales', 10101),
(689, '2022-07-12 11:52:05', 'Visualizo el listado de solicitud', 10083),
(690, '2022-07-12 11:52:10', 'Asignacion finalizada: 27', 10101),
(691, '2022-07-12 11:52:14', 'Visualizo el listado de asignaciones', 10101),
(692, '2022-07-12 11:53:01', 'Inicio de Sesion', 10082),
(693, '2022-07-12 11:53:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(694, '2022-07-12 11:54:11', 'Visualizo el listado de direcciones', 10083),
(695, '2022-07-12 11:54:31', 'Hizo la siguiente busqueda: dimisoc en el listado de direcciones', 10083),
(696, '2022-07-12 11:54:42', 'Visualizo el listado de solicitud', 10083),
(697, '2022-07-12 11:55:00', 'Creacion de nuevo paso procesado: Es urgente la revisión porque  presenta fallas electricas', 10101),
(698, '2022-07-12 11:55:06', 'Actualizo la siguiente solicitud: Verificación de cable de red', 10083),
(699, '2022-07-12 11:55:06', 'Asignacion finalizada: 31', 10101),
(700, '2022-07-12 11:55:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(701, '2022-07-12 11:55:08', 'Visualizo el listado de asignaciones', 10101),
(702, '2022-07-12 11:55:16', 'Visualizo el listado de solicitud', 10101),
(703, '2022-07-12 11:55:26', 'Visualizo el listado de solicitud', 10083),
(704, '2022-07-12 11:55:56', 'Visualizo el listado de solicitud', 10101),
(705, '2022-07-12 11:56:00', 'Creacion de nueva asignacion: Verificar los cables de red', 10083),
(706, '2022-07-12 11:56:00', 'Visualizo el listado de solicitud', 10083),
(707, '2022-07-12 11:56:05', 'Visualizo el listado de asignaciones', 10083),
(708, '2022-07-12 11:56:38', 'Visualizo el listado de solicitud', 10101),
(709, '2022-07-12 11:56:57', 'Visualizo el listado de asignaciones', 10083),
(710, '2022-07-12 11:57:03', 'Visualizo el listado de asignaciones', 10083),
(711, '2022-07-12 11:57:23', 'Visualizo el listado de solicitud', 10101),
(712, '2022-07-12 11:57:28', 'Visualizo el listado de solicitud', 10101),
(713, '2022-07-12 11:57:34', 'Visualizo el listado de solicitud', 10101),
(714, '2022-07-12 11:58:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(715, '2022-07-12 11:58:10', 'Visualizo el listado de asignaciones', 10083),
(716, '2022-07-12 11:58:15', 'Visualizo el listado de asignaciones', 10083),
(717, '2022-07-12 11:58:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(718, '2022-07-12 11:58:38', 'Visualizo el listado de solicitud', 10083),
(719, '2022-07-12 11:59:12', 'Visualizo el listado de solicitud', 10101),
(720, '2022-07-12 11:59:22', 'Actualizo la siguiente solicitud: Verificación de cable de red', 10083),
(721, '2022-07-12 11:59:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(722, '2022-07-12 11:59:29', 'Visualizo el listado de solicitud', 10083),
(723, '2022-07-12 11:59:40', 'Visualizo el listado de solicitud', 10101),
(724, '2022-07-12 12:00:01', 'Creacion de nueva asignacion: Verificar los cables de red', 10083),
(725, '2022-07-12 12:00:02', 'Visualizo el listado de solicitud', 10083),
(726, '2022-07-12 12:00:05', 'Visualizo el listado de asignaciones', 10083),
(727, '2022-07-12 12:00:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(728, '2022-07-12 12:01:47', 'Creacion de nueva solicitud: Busqueda de puntos de red', 10083),
(729, '2022-07-12 12:01:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(730, '2022-07-12 12:02:07', 'Creacion de nueva solicitud: Entrega de cable de red', 10101),
(731, '2022-07-12 12:02:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(732, '2022-07-12 12:02:19', 'Actualizo la siguiente solicitud: Busqueda de puntos de red', 10083),
(733, '2022-07-12 12:02:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(734, '2022-07-12 12:02:26', 'Elimino el siguiente solicitud: Entrega de cable de red', 10083),
(735, '2022-07-12 12:02:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(736, '2022-07-12 12:02:37', 'Visualizo el listado de solicitud', 10083),
(737, '2022-07-12 12:03:00', 'Actualizo la siguiente solicitud: Busqueda de puntos de red', 10083),
(738, '2022-07-12 12:03:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(739, '2022-07-12 12:03:03', 'Visualizo el listado de asignaciones', 10083),
(740, '2022-07-12 12:03:08', 'Visualizo el listado de asignaciones', 10083),
(741, '2022-07-12 12:03:11', 'Visualizo el listado de solicitud', 10101),
(742, '2022-07-12 12:03:17', 'Visualizo el listado de solicitud', 10083),
(743, '2022-07-12 12:03:27', 'Visualizo el listado de solicitud', 10101),
(744, '2022-07-12 12:03:46', 'Visualizo el listado de solicitud', 10101),
(745, '2022-07-12 12:03:46', 'Visualizo el listado de solicitud', 10083),
(746, '2022-07-12 12:03:47', 'Visualizo el listado de asignaciones', 10083),
(747, '2022-07-12 12:03:54', 'Visualizo el listado de solicitud', 10083),
(748, '2022-07-12 12:04:15', 'Creacion de nueva asignacion: Verificar cada punto o cable', 10083),
(749, '2022-07-12 12:04:15', 'Visualizo el listado de solicitud', 10083),
(750, '2022-07-12 12:04:17', 'Actualizo la siguiente solicitud: Entregas de cable de red', 10101),
(751, '2022-07-12 12:04:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(752, '2022-07-12 12:04:25', 'Visualizo el listado de solicitud', 10101),
(753, '2022-07-12 12:04:25', 'Visualizo el listado de asignaciones', 10083),
(754, '2022-07-12 12:04:39', 'Visualizo el listado de asignaciones', 10083),
(755, '2022-07-12 12:04:43', 'Visualizo el listado de asignaciones', 10083),
(756, '2022-07-12 12:04:52', 'Visualizo el listado de asignaciones', 10083),
(757, '2022-07-12 12:05:02', 'Visualizo el listado de asignaciones', 10083),
(758, '2022-07-12 12:05:15', 'Creacion de nueva asignacion: entrega de cable de red', 10101),
(759, '2022-07-12 12:05:16', 'Visualizo el listado de solicitud', 10101),
(760, '2022-07-12 12:05:41', 'Visualizo el listado de asignaciones', 10101),
(761, '2022-07-12 12:05:58', 'Visualizo el listado de asignaciones', 10101),
(762, '2022-07-12 12:06:00', 'Visualizo el listado de asignaciones', 10101),
(763, '2022-07-12 12:06:22', 'Creacion de nuevo paso procesado: entregar cable de red', 10101),
(764, '2022-07-12 12:06:34', 'Visualizo el listado de asignaciones', 10101),
(765, '2022-07-12 12:06:44', 'Visualizo el listado de solicitud', 10101),
(766, '2022-07-12 12:06:53', 'Visualizo el listado de solicitud', 10101),
(767, '2022-07-12 12:06:57', 'Visualizo el listado de asignaciones', 10083),
(768, '2022-07-12 12:06:59', 'Visualizo el listado de solicitud', 10101),
(769, '2022-07-12 12:07:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(770, '2022-07-12 12:07:45', 'Actualizo la siguiente solicitud: Requiero un chequeo de un punto de red', 10101),
(771, '2022-07-12 12:07:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(772, '2022-07-12 12:07:51', 'Visualizo el listado de solicitud', 10101),
(773, '2022-07-12 12:08:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(774, '2022-07-12 12:08:27', 'Visualizo el listado de solicitud', 10101),
(775, '2022-07-12 12:10:13', 'Visualizo el listado de solicitud', 10101),
(776, '2022-07-12 12:10:23', 'Visualizo el listado de solicitud', 10101),
(777, '2022-07-12 12:11:04', 'Visualizo el listado de solicitud', 10101),
(778, '2022-07-12 12:11:12', 'Creacion de nueva solicitud: Arreglo de teclado', 10083),
(779, '2022-07-12 12:11:17', 'Visualizo el listado de solicitud', 10083),
(780, '2022-07-12 12:11:24', 'Visualizo el listado de solicitud', 10083),
(781, '2022-07-12 12:11:36', 'Creacion de nueva asignacion: entrega de cable de red', 10101),
(782, '2022-07-12 12:11:37', 'Visualizo el listado de solicitud', 10101),
(783, '2022-07-12 12:11:47', 'Actualizo la siguiente solicitud: Arreglo de teclado', 10083),
(784, '2022-07-12 12:11:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(785, '2022-07-12 12:11:50', 'Visualizo el listado de solicitud', 10083),
(786, '2022-07-12 12:12:17', 'Creacion de nueva asignacion: entrega de cable de red', 10101),
(787, '2022-07-12 12:12:20', 'Visualizo el listado de solicitud', 10101),
(788, '2022-07-12 12:12:58', 'Visualizo el listado de asignaciones', 10101),
(789, '2022-07-12 12:12:58', 'Creacion de nueva asignacion: Se reviso el teclado se el cambio el conector', 10083),
(790, '2022-07-12 12:12:58', 'Visualizo el listado de solicitud', 10083),
(791, '2022-07-12 12:13:03', 'Visualizo el listado de asignaciones', 10083),
(792, '2022-07-12 12:13:18', 'Visualizo el listado de solicitud', 10101),
(793, '2022-07-12 12:13:21', 'Creacion de nueva solicitud: No tengo conexión a Internet', 10082),
(794, '2022-07-12 12:13:50', 'Actualizo la siguiente solicitud: Entregas de cable de red', 10101),
(795, '2022-07-12 12:13:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(796, '2022-07-12 12:13:55', 'Creacion de nuevo paso procesado: Se reviso el teclado se le cambio el conector pero a un asi esta defectuoso el teclado', 10083),
(797, '2022-07-12 12:13:59', 'Visualizo el listado de solicitud', 10101),
(798, '2022-07-12 12:14:00', 'Asignacion finalizada: 48', 10083),
(799, '2022-07-12 12:14:01', 'Visualizo el listado de asignaciones', 10083),
(800, '2022-07-12 12:14:07', 'Visualizo el listado de solicitud', 10083),
(801, '2022-07-12 12:14:24', 'Visualizo el listado de solicitud', 10082),
(802, '2022-07-12 12:14:35', 'Visualizo el listado de solicitud', 10083),
(803, '2022-07-12 12:14:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(804, '2022-07-12 12:14:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(805, '2022-07-12 12:14:39', 'Actualizo la siguiente solicitud: Entregas de cable de red', 10101),
(806, '2022-07-12 12:14:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(807, '2022-07-12 12:14:45', 'Visualizo el listado de asignaciones', 10101),
(808, '2022-07-12 12:14:56', 'Visualizo el listado de asignaciones', 10101),
(809, '2022-07-12 12:14:59', 'Visualizo el listado de asignaciones', 10101),
(810, '2022-07-12 12:15:17', 'Actualizo la siguiente solicitud: No tengo conexión a Internet', 10082),
(811, '2022-07-12 12:15:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(812, '2022-07-12 12:15:25', 'Visualizo el listado de solicitud', 10082),
(813, '2022-07-12 12:15:44', 'Visualizo el listado de asignaciones', 10101),
(814, '2022-07-12 12:16:17', 'Creacion de nueva asignacion: Verificar la conexión de Internet', 10082),
(815, '2022-07-12 12:16:18', 'Visualizo el listado de solicitud', 10082),
(816, '2022-07-12 12:16:29', 'Visualizo el listado de asignaciones', 10082),
(817, '2022-07-12 12:16:32', 'Visualizo el listado de pasos', 10101),
(818, '2022-07-12 12:16:58', 'Hizo la siguiente busqueda: cable de red en el listado de pasos', 10101),
(819, '2022-07-12 12:17:30', 'Visualizo el listado de solicitud', 10101),
(820, '2022-07-12 12:17:35', 'Creacion de nuevo paso procesado: Dirección MAC agregada en Pfsenser serial MXL1431JP6', 10082),
(821, '2022-07-12 12:17:58', 'Visualizo el listado de asignaciones', 10101),
(822, '2022-07-12 12:18:01', 'Asignacion finalizada: 56', 10082),
(823, '2022-07-12 12:18:03', 'Visualizo el listado de asignaciones', 10082),
(824, '2022-07-12 12:18:10', 'Visualizo el listado de solicitud', 10101),
(825, '2022-07-12 12:18:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(826, '2022-07-12 12:18:22', 'Visualizo el listado de solicitud', 10082),
(827, '2022-07-12 12:18:30', 'Creacion de nueva asignacion: entrega de cable de red', 10101),
(828, '2022-07-12 12:18:31', 'Visualizo el listado de solicitud', 10101),
(829, '2022-07-12 12:18:37', 'Visualizo el listado de asignaciones', 10101),
(830, '2022-07-12 12:18:41', 'Visualizo el listado de asignaciones', 10101),
(831, '2022-07-12 12:19:41', 'Visualizo el listado de solicitud', 10082),
(832, '2022-07-12 12:20:54', 'Creacion de nueva solicitud: verificación de cable de red', 10101),
(833, '2022-07-12 12:20:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(834, '2022-07-12 12:21:32', 'Actualizo la siguiente solicitud: verificación de cable de red', 10101),
(835, '2022-07-12 12:21:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(836, '2022-07-12 12:21:39', 'Visualizo el listado de solicitud', 10101),
(837, '2022-07-12 12:22:45', 'Creacion de nueva asignacion: servicio de conexión de cable de red', 10101),
(838, '2022-07-12 12:22:46', 'Visualizo el listado de solicitud', 10101),
(839, '2022-07-12 12:22:59', 'Visualizo el listado de asignaciones', 10101),
(840, '2022-07-12 12:23:14', 'Visualizo el listado de asignaciones', 10101),
(841, '2022-07-12 12:23:17', 'Visualizo el listado de asignaciones', 10101),
(842, '2022-07-12 12:23:42', 'Visualizo el listado de solicitud', 10101),
(843, '2022-07-12 12:24:27', 'Actualizo la siguiente solicitud: verificación de cable de red', 10101),
(844, '2022-07-12 12:24:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(845, '2022-07-12 12:24:32', 'Visualizo el listado de solicitud', 10101),
(846, '2022-07-12 12:25:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(847, '2022-07-12 12:25:19', 'Visualizo el listado de solicitud', 1),
(848, '2022-07-12 12:26:31', 'Creacion de nueva asignacion: se conecto cable de red en la pc, se encontró problemas con el cable de red', 10101),
(849, '2022-07-12 12:26:32', 'Visualizo el listado de solicitud', 10101),
(850, '2022-07-12 12:28:16', 'Creacion de nueva asignacion: entrega de cable de red', 10101),
(851, '2022-07-12 12:28:16', 'Visualizo el listado de solicitud', 10101),
(852, '2022-07-12 12:28:23', 'Visualizo el listado de asignaciones', 10101),
(853, '2022-07-12 12:28:31', 'Visualizo el listado de asignaciones', 10101),
(854, '2022-07-12 12:28:38', 'Visualizo el listado de asignaciones', 10101),
(855, '2022-07-12 12:28:42', 'Visualizo el listado de solicitud', 10101),
(856, '2022-07-12 12:28:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(857, '2022-07-12 12:28:57', 'Visualizo el listado de solicitud', 10101),
(858, '2022-07-12 12:29:43', 'Actualizo la siguiente solicitud: verificación de cable de red', 10101),
(859, '2022-07-12 12:29:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(860, '2022-07-12 12:29:48', 'Visualizo el listado de solicitud', 10101),
(861, '2022-07-12 12:30:06', 'Visualizo el listado de asignaciones', 10101),
(862, '2022-07-12 12:30:09', 'Visualizo el listado de solicitud', 10101),
(863, '2022-07-12 12:30:27', 'Creacion de nueva asignacion: entrega de cable de red', 10101),
(864, '2022-07-12 12:30:27', 'Visualizo el listado de solicitud', 10101),
(865, '2022-07-12 12:30:34', 'Visualizo el listado de asignaciones', 10101),
(866, '2022-07-12 12:30:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(867, '2022-07-12 12:31:03', 'Visualizo el listado de solicitud', 10101),
(868, '2022-07-12 12:31:35', 'Actualizo la siguiente solicitud: verificación de cable de red', 10101),
(869, '2022-07-12 12:31:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(870, '2022-07-12 12:31:41', 'Visualizo el listado de solicitud', 10101),
(871, '2022-07-12 12:32:10', 'Creacion de nueva asignacion: verificación de cable de red', 10101),
(872, '2022-07-12 12:32:10', 'Visualizo el listado de solicitud', 10101),
(873, '2022-07-12 12:32:15', 'Visualizo el listado de asignaciones', 10101),
(874, '2022-07-12 12:32:42', 'Creacion de nuevo paso procesado: entrega de cable de red', 10101),
(875, '2022-07-12 12:32:59', 'Creacion de nuevo paso procesado: entrega de cable de red', 10101),
(876, '2022-07-12 12:33:27', 'Creacion de nuevo paso procesado: entrega de cable de red', 10101),
(877, '2022-07-12 12:33:35', 'Creacion de nuevo paso procesado: entrega de cable de red', 10101),
(878, '2022-07-12 12:33:42', 'Creacion de nuevo paso procesado: entrega de cable de red', 10101),
(879, '2022-07-12 12:33:47', 'Asignacion finalizada: 46', 10101),
(880, '2022-07-12 12:33:48', 'Visualizo el listado de asignaciones', 10101),
(881, '2022-07-12 12:34:05', 'Visualizo el listado de solicitud', 10101),
(882, '2022-07-12 12:34:13', 'Visualizo el listado de solicitud', 10101),
(883, '2022-07-12 12:34:20', 'Visualizo el listado de asignaciones', 10101),
(884, '2022-07-12 12:35:17', 'Visualizo el listado de solicitud', 10101),
(885, '2022-07-12 12:35:27', 'Visualizo el listado de asignaciones', 10101),
(886, '2022-07-12 12:37:02', 'Creacion de nueva actividad: entrega de cable de red', 10101),
(887, '2022-07-12 12:37:44', 'Creacion de un nuevo paso: descripción entrega de cable de red', 10101),
(888, '2022-07-12 12:37:49', 'Visualizo el listado de solicitud', 10101),
(889, '2022-07-12 12:37:53', 'Visualizo el listado de asignaciones', 10101),
(890, '2022-07-12 12:38:07', 'Visualizo el listado de asignaciones', 10101),
(891, '2022-07-12 12:38:13', 'Visualizo el listado de solicitud', 10101),
(892, '2022-07-12 12:39:09', 'Visualizo el listado de asignaciones', 10101),
(893, '2022-07-12 12:39:17', 'Elimino el siguiente asignacion: verificación de cable de red', 10101),
(894, '2022-07-12 12:39:18', 'Visualizo el listado de asignaciones', 10101),
(895, '2022-07-12 12:39:35', 'Elimino el siguiente asignacion: entrega de cable de red', 10101),
(896, '2022-07-12 12:39:36', 'Visualizo el listado de asignaciones', 10101),
(897, '2022-07-12 12:39:45', 'Elimino el siguiente asignacion: entrega de cable de red', 10101),
(898, '2022-07-12 12:39:46', 'Visualizo el listado de asignaciones', 10101),
(899, '2022-07-12 12:40:36', 'Creacion de nueva solicitud: entrega de cable de red', 10101),
(900, '2022-07-12 12:40:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(901, '2022-07-12 12:41:05', 'Actualizo la siguiente solicitud: entrega de cable de red', 10101),
(902, '2022-07-12 12:41:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(903, '2022-07-12 12:41:09', 'Visualizo el listado de solicitud', 10101),
(904, '2022-07-12 12:41:26', 'Creacion de nueva asignacion: entrega de cable de red', 10101),
(905, '2022-07-12 12:41:27', 'Visualizo el listado de solicitud', 10101),
(906, '2022-07-12 12:41:37', 'Visualizo el listado de asignaciones', 10101),
(907, '2022-07-12 12:42:34', 'Hizo la siguiente busqueda: cable de red en el listado de pasos', 10101),
(908, '2022-07-12 12:42:53', 'Hizo la siguiente busqueda: cable de red en el listado de pasos', 10101),
(909, '2022-07-12 12:43:10', 'Hizo la siguiente busqueda: cable en el listado de pasos', 10101),
(910, '2022-07-12 12:43:30', 'Visualizo el listado de asignaciones', 10101),
(911, '2022-07-12 12:43:54', 'Visualizo el listado de solicitud', 10101),
(912, '2022-07-12 12:45:25', 'Creacion de nueva asignacion: servicio de coneccion de cable de red en la pc, encontro problemas con los cables de red', 10101),
(913, '2022-07-12 12:45:26', 'Visualizo el listado de solicitud', 10101),
(914, '2022-07-12 12:45:38', 'Visualizo el listado de solicitud', 10101),
(915, '2022-07-12 12:45:50', 'Visualizo el listado de asignaciones', 10101),
(916, '2022-07-12 12:46:09', 'Visualizo el listado de solicitud', 10101),
(917, '2022-07-12 12:46:13', 'Visualizo el listado de solicitud', 10101),
(918, '2022-07-12 12:46:50', 'Visualizo el listado de solicitud', 10082),
(919, '2022-07-12 12:48:12', 'Actualizo la siguiente solicitud: verificación de cable de red', 10101),
(920, '2022-07-12 12:48:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(921, '2022-07-12 12:48:16', 'Visualizo el listado de solicitud', 10101),
(922, '2022-07-12 12:48:39', 'Creacion de nueva asignacion: verificación de cable', 10101),
(923, '2022-07-12 12:48:39', 'Visualizo el listado de solicitud', 10101),
(924, '2022-07-12 12:48:43', 'Visualizo el listado de asignaciones', 10101),
(925, '2022-07-12 12:49:34', 'Inicio de Sesion', 10081),
(926, '2022-07-12 12:49:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(927, '2022-07-12 12:50:12', 'Visualizo el listado de asignaciones', 10082),
(928, '2022-07-12 12:50:44', 'Visualizo el listado de solicitud', 10082),
(929, '2022-07-12 12:50:55', 'Visualizo el listado de solicitud', 10082),
(930, '2022-07-12 12:51:49', 'Visualizo el listado de solicitud', 10082),
(931, '2022-07-12 12:51:56', 'Creacion de nueva solicitud: Verificar los Puntos de Internet', 10081),
(932, '2022-07-12 12:52:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(933, '2022-07-12 12:52:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(934, '2022-07-12 12:52:49', 'Actualizo la siguiente solicitud: Verificar los Puntos de Internet', 10081),
(935, '2022-07-12 12:52:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(936, '2022-07-12 12:53:00', 'Visualizo el listado de solicitud', 10081),
(937, '2022-07-12 12:53:30', 'Creacion de nueva asignacion: Verificar Puntos de Internet', 10081),
(938, '2022-07-12 12:53:30', 'Visualizo el listado de solicitud', 10081),
(939, '2022-07-12 12:53:39', 'Visualizo el listado de solicitud', 10081),
(940, '2022-07-12 12:54:07', 'Actualizo la siguiente solicitud: Verificar los Puntos de Internet', 10081),
(941, '2022-07-12 12:54:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(942, '2022-07-12 12:54:17', 'Visualizo el listado de asignaciones', 10081),
(943, '2022-07-12 12:54:26', 'Creacion de nueva solicitud: ubicación de punto de red', 10101),
(944, '2022-07-12 12:54:28', 'Visualizo el listado de solicitud', 10081),
(945, '2022-07-12 12:54:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(946, '2022-07-12 12:54:37', 'Creacion de nueva solicitud: Necesito una limpieza al sistema operativo de mi computador', 10082),
(947, '2022-07-12 12:54:40', 'Visualizo el listado de asignaciones', 10081),
(948, '2022-07-12 12:54:43', 'Visualizo el listado de solicitud', 10082),
(949, '2022-07-12 12:54:57', 'Visualizo el listado de asignaciones', 10081),
(950, '2022-07-12 12:55:08', 'Actualizo la siguiente solicitud: ubicación de punto de red', 10101),
(951, '2022-07-12 12:55:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(952, '2022-07-12 12:55:18', 'Visualizo el listado de solicitud', 10101),
(953, '2022-07-12 12:55:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(954, '2022-07-12 12:55:58', 'Actualizo la siguiente solicitud: Necesito una limpieza al sistema operativo de mi computador', 10082),
(955, '2022-07-12 12:56:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(956, '2022-07-12 12:56:04', 'Visualizo el listado de solicitud', 10082),
(957, '2022-07-12 12:57:10', 'Creacion de nueva asignacion: realiza mantenimiento preventivo al software de la computadora', 10082),
(958, '2022-07-12 12:57:10', 'Visualizo el listado de solicitud', 10082),
(959, '2022-07-12 12:57:15', 'Creacion de nueva asignacion: se busco el punto de red y se le dio conectividad al cuarto de rack', 10101),
(960, '2022-07-12 12:57:15', 'Visualizo el listado de solicitud', 10101),
(961, '2022-07-12 12:57:16', 'Visualizo el listado de asignaciones', 10082),
(962, '2022-07-12 12:57:26', 'Visualizo el listado de asignaciones', 10101),
(963, '2022-07-12 12:58:38', 'Creacion de nuevo paso procesado: se le busco el punto de red mas cercano al schich para dar conectividad al cuarto de rack', 10101),
(964, '2022-07-12 12:59:16', 'Creacion de nuevo paso procesado: ', 10101),
(965, '2022-07-12 12:59:22', 'Creacion de nuevo paso procesado: ', 10101),
(966, '2022-07-12 12:59:23', 'Creacion de un nuevo paso: Mantenimiento preventivo a equipos a nivel de software', 10082),
(967, '2022-07-12 12:59:31', 'Visualizo el listado de solicitud', 10082),
(968, '2022-07-12 12:59:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(969, '2022-07-12 12:59:40', 'Visualizo el listado de asignaciones', 10082),
(970, '2022-07-12 12:59:45', 'Visualizo el listado de solicitud', 10081),
(971, '2022-07-12 13:00:14', 'Creacion de nuevo paso procesado: se realizo respectivo mantenimiento de software a la computadora', 10082),
(972, '2022-07-12 13:00:17', 'Creacion de nueva asignacion: Verificar puntos de internet', 10081),
(973, '2022-07-12 13:00:17', 'Visualizo el listado de solicitud', 10081),
(974, '2022-07-12 13:00:23', 'Asignacion finalizada: 71', 10082),
(975, '2022-07-12 13:00:24', 'Visualizo el listado de asignaciones', 10082),
(976, '2022-07-12 13:00:26', 'Visualizo el listado de asignaciones', 10081),
(977, '2022-07-12 13:00:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(978, '2022-07-12 13:00:34', 'Visualizo el listado de solicitud', 10082),
(979, '2022-07-12 13:01:06', 'Creacion de nuevo paso procesado: Verificar los puntos los cuales no estan activos', 10081),
(980, '2022-07-12 13:01:14', 'Visualizo el listado de solicitud', 10082),
(981, '2022-07-12 13:01:19', 'Creacion de nuevo paso procesado: ', 10081),
(982, '2022-07-12 13:01:25', 'Creacion de nuevo paso procesado: ', 10081),
(983, '2022-07-12 13:01:32', 'Creacion de nuevo paso procesado: ', 10081),
(984, '2022-07-12 13:01:36', 'Creacion de nuevo paso procesado: ', 10081),
(985, '2022-07-12 13:01:44', 'Asignacion finalizada: 67', 10081),
(986, '2022-07-12 13:01:46', 'Visualizo el listado de asignaciones', 10081),
(987, '2022-07-12 13:01:58', 'Visualizo el listado de solicitud', 10081),
(988, '2022-07-12 13:02:11', 'Creacion de nuevo paso procesado: ', 10101),
(989, '2022-07-12 13:02:13', 'Creacion de nuevo paso procesado: ', 10101),
(990, '2022-07-12 13:02:17', 'Creacion de nuevo paso procesado: ', 10101),
(991, '2022-07-12 13:02:22', 'Asignacion finalizada: 70', 10101),
(992, '2022-07-12 13:02:24', 'Visualizo el listado de asignaciones', 10101),
(993, '2022-07-12 13:02:34', 'Visualizo el listado de solicitud', 10101),
(994, '2022-07-12 13:03:04', 'Visualizo el listado de solicitud', 10081),
(995, '2022-07-12 13:03:13', 'Visualizo el listado de solicitud', 10101),
(996, '2022-07-12 13:05:02', 'Visualizo el listado de asignaciones', 10101),
(997, '2022-07-12 13:05:22', 'Visualizo el listado de solicitud', 10101),
(998, '2022-07-12 13:05:25', 'Visualizo el listado de solicitud', 10101),
(999, '2022-07-12 13:05:28', 'Visualizo el listado de solicitud', 10101),
(1000, '2022-07-12 13:06:10', 'Visualizo el listado de asignaciones', 10101),
(1001, '2022-07-12 13:06:39', 'Visualizo el listado de pasos', 10101),
(1002, '2022-07-12 13:06:42', 'Hizo la siguiente busqueda: cable en el listado de pasos', 10101),
(1003, '2022-07-12 13:06:51', 'Hizo la siguiente busqueda: cable en el listado de pasos', 10101),
(1004, '2022-07-12 13:07:34', 'Visualizo el listado de asignaciones', 10101),
(1005, '2022-07-12 13:08:39', 'Creacion de un nuevo paso: descripción de Verificación de cable de red', 10101),
(1006, '2022-07-12 13:08:43', 'Visualizo el listado de asignaciones', 10101),
(1007, '2022-07-12 13:09:36', 'Creacion de nuevo paso procesado: ', 10101),
(1008, '2022-07-12 13:09:41', 'Asignacion finalizada: 64', 10101),
(1009, '2022-07-12 13:09:42', 'Visualizo el listado de asignaciones', 10101),
(1010, '2022-07-12 13:11:03', 'Hizo la siguiente busqueda: cable en el listado de pasos', 10101),
(1011, '2022-07-12 13:11:43', 'Hizo la siguiente busqueda: cable en el listado de pasos', 10101),
(1012, '2022-07-12 13:12:37', 'Creacion de nueva solicitud: Equipo sin internet', 10081),
(1013, '2022-07-12 13:12:41', 'Actualizo el siguiente paso: descripción de Verificación de cable de red', 10101),
(1014, '2022-07-12 13:12:43', 'Visualizo el listado de solicitud', 10081),
(1015, '2022-07-12 13:12:44', 'Visualizo el listado de pasos', 10101),
(1016, '2022-07-12 13:12:57', 'Visualizo el listado de pasos', 10101),
(1017, '2022-07-12 13:13:01', 'Visualizo el listado de pasos', 10101),
(1018, '2022-07-12 13:13:10', 'Hizo la siguiente busqueda: cable en el listado de pasos', 10101),
(1019, '2022-07-12 13:13:26', 'Actualizo el siguiente paso: descripción entrega de cable de red', 10101),
(1020, '2022-07-12 13:13:29', 'Visualizo el listado de asignaciones', 10101),
(1021, '2022-07-12 13:13:47', 'Visualizo el listado de asignaciones', 10101),
(1022, '2022-07-12 13:13:58', 'Visualizo el listado de asignaciones', 10101),
(1023, '2022-07-12 13:14:35', 'Creacion de un nuevo paso: entrega de cable de red', 10101),
(1024, '2022-07-12 13:14:39', 'Visualizo el listado de asignaciones', 10101),
(1025, '2022-07-12 13:14:46', 'Creacion de nuevo paso procesado: ', 10101),
(1026, '2022-07-12 13:14:52', 'Asignacion finalizada: 63', 10101),
(1027, '2022-07-12 13:14:53', 'Visualizo el listado de asignaciones', 10101),
(1028, '2022-07-12 13:15:30', 'Actualizo la siguiente solicitud: Equipo sin internet', 10081),
(1029, '2022-07-12 13:15:32', 'Creacion de un nuevo paso: Instalacion de cable de red', 10101),
(1030, '2022-07-12 13:15:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1031, '2022-07-12 13:15:36', 'Visualizo el listado de asignaciones', 10101),
(1032, '2022-07-12 13:15:41', 'Creacion de nuevo paso procesado: ', 10101),
(1033, '2022-07-12 13:15:46', 'Visualizo el listado de solicitud', 10081),
(1034, '2022-07-12 13:15:46', 'Asignacion finalizada: 45', 10101),
(1035, '2022-07-12 13:15:48', 'Visualizo el listado de asignaciones', 10101),
(1036, '2022-07-12 13:15:52', 'Visualizo el listado de solicitud', 10101),
(1037, '2022-07-12 13:15:55', 'Visualizo el listado de asignaciones', 10081),
(1038, '2022-07-12 13:16:06', 'Visualizo el listado de asignaciones', 10081),
(1039, '2022-07-12 13:16:12', 'Visualizo el listado de solicitud', 10081),
(1040, '2022-07-12 13:16:16', 'Visualizo el listado de solicitud', 10101),
(1041, '2022-07-12 13:16:29', 'Creacion de nueva solicitud: Necesito Instalar un toner', 10082),
(1042, '2022-07-12 13:16:33', 'Visualizo el listado de asignaciones', 10081),
(1043, '2022-07-12 13:16:36', 'Visualizo el listado de solicitud', 10101),
(1044, '2022-07-12 13:16:39', 'Visualizo el listado de solicitud', 10101),
(1045, '2022-07-12 13:16:41', 'Visualizo el listado de solicitud', 10101),
(1046, '2022-07-12 13:16:42', 'Visualizo el listado de solicitud', 10081),
(1047, '2022-07-12 13:16:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1048, '2022-07-12 13:16:53', 'Visualizo el listado de solicitud', 10101),
(1049, '2022-07-12 13:16:56', 'Visualizo el listado de solicitud', 10101),
(1050, '2022-07-12 13:16:58', 'Visualizo el listado de solicitud', 10101),
(1051, '2022-07-12 13:17:13', 'Actualizo la siguiente solicitud: Necesito Instalar un toner', 10082),
(1052, '2022-07-12 13:17:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1053, '2022-07-12 13:17:19', 'Visualizo el listado de solicitud', 10101),
(1054, '2022-07-12 13:17:21', 'Visualizo el listado de solicitud', 10082),
(1055, '2022-07-12 13:17:27', 'Actualizo la siguiente solicitud: Equipo sin internet', 10081),
(1056, '2022-07-12 13:17:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1057, '2022-07-12 13:17:36', 'Visualizo el listado de asignaciones', 10081),
(1058, '2022-07-12 13:17:54', 'Visualizo el listado de solicitud', 10081),
(1059, '2022-07-12 13:18:08', 'Visualizo el listado de solicitud', 10081),
(1060, '2022-07-12 13:18:15', 'Visualizo el listado de solicitud', 10081),
(1061, '2022-07-12 13:18:20', 'Visualizo el listado de solicitud', 10081),
(1062, '2022-07-12 13:18:26', 'Visualizo el listado de asignaciones', 10081),
(1063, '2022-07-12 13:18:31', 'Visualizo el listado de asignaciones', 10081),
(1064, '2022-07-12 13:18:37', 'Visualizo el listado de asignaciones', 10081),
(1065, '2022-07-12 13:18:43', 'Visualizo el listado de asignaciones', 10081),
(1066, '2022-07-12 13:19:02', 'Visualizo el listado de solicitud', 10081),
(1067, '2022-07-12 13:19:17', 'Visualizo el listado de solicitud', 10082),
(1068, '2022-07-12 13:19:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1069, '2022-07-12 13:19:27', 'Elimino el siguiente solicitud: Necesito Instalar un toner', 10082),
(1070, '2022-07-12 13:19:28', 'Visualizo el listado de solicitud', 10082),
(1071, '2022-07-12 13:19:33', 'Visualizo el listado de solicitud', 10081),
(1072, '2022-07-12 13:20:06', 'Creacion de nueva asignacion: Equipo sin internet', 10081),
(1073, '2022-07-12 13:20:06', 'Visualizo el listado de solicitud', 10081),
(1074, '2022-07-12 13:20:17', 'Visualizo el listado de solicitud', 10081),
(1075, '2022-07-12 13:20:21', 'Visualizo el listado de asignaciones', 10082),
(1076, '2022-07-12 13:20:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1077, '2022-07-12 13:20:42', 'Actualizo la siguiente solicitud: Equipo sin internet', 10081),
(1078, '2022-07-12 13:20:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1079, '2022-07-12 13:20:54', 'Visualizo el listado de asignaciones', 10081),
(1080, '2022-07-12 13:21:02', 'Visualizo el listado de asignaciones', 10081),
(1081, '2022-07-12 13:21:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1082, '2022-07-12 13:21:11', 'Visualizo el listado de solicitud', 10081),
(1083, '2022-07-12 13:22:20', 'Visualizo el listado de solicitud', 10081),
(1084, '2022-07-12 13:22:27', 'Visualizo el listado de solicitud', 10081),
(1085, '2022-07-12 13:22:56', 'Creacion de nueva asignacion: Equipo sin internet', 10081),
(1086, '2022-07-12 13:22:58', 'Visualizo el listado de solicitud', 10081),
(1087, '2022-07-12 13:23:05', 'Visualizo el listado de asignaciones', 10081),
(1088, '2022-07-12 13:23:25', 'Visualizo el listado de asignaciones', 10081),
(1089, '2022-07-12 13:24:03', 'Creacion de nuevo paso procesado: Equipo sin internet', 10081),
(1090, '2022-07-12 13:24:10', 'Asignacion finalizada: 77', 10081),
(1091, '2022-07-12 13:24:11', 'Visualizo el listado de asignaciones', 10081),
(1092, '2022-07-12 13:24:17', 'Visualizo el listado de asignaciones', 10081),
(1093, '2022-07-12 13:24:24', 'Visualizo el listado de solicitud', 10081),
(1094, '2022-07-12 13:24:37', 'Inicio de Sesion', 10082),
(1095, '2022-07-12 13:24:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1096, '2022-07-12 13:25:07', 'Visualizo el listado de solicitud', 10081),
(1097, '2022-07-12 13:27:59', 'Inicio de Sesion', 10083),
(1098, '2022-07-12 13:28:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1099, '2022-07-12 13:28:13', 'Visualizo el listado de asignaciones', 10083),
(1100, '2022-07-12 13:28:17', 'Creacion de nueva direccion: Consultoria Juridica', 10082),
(1101, '2022-07-12 13:28:18', 'Visualizo el listado de asignaciones', 10083),
(1102, '2022-07-12 13:28:24', 'Visualizo el listado de asignaciones', 10083),
(1103, '2022-07-12 13:28:30', 'Visualizo el listado de solicitud', 10083),
(1104, '2022-07-12 13:28:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1105, '2022-07-12 13:28:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1106, '2022-07-12 13:28:41', 'Visualizo el listado de asignaciones', 10083),
(1107, '2022-07-12 13:28:43', 'Visualizo el listado de asignaciones', 10083),
(1108, '2022-07-12 13:28:46', 'Visualizo el listado de solicitud', 10082),
(1109, '2022-07-12 13:28:46', 'Visualizo el listado de asignaciones', 10083),
(1110, '2022-07-12 13:28:50', 'Visualizo el listado de asignaciones', 10083),
(1111, '2022-07-12 13:28:59', 'Visualizo el listado de asignaciones', 10083),
(1112, '2022-07-12 13:28:59', 'Visualizo el listado de solicitud', 10082),
(1113, '2022-07-12 13:29:03', 'Visualizo el listado de solicitud', 10082),
(1114, '2022-07-12 13:29:11', 'Visualizo el listado de solicitud', 10082),
(1115, '2022-07-12 13:29:30', 'Creacion de nuevo paso procesado: Verificar cada proceso que hay con los cables', 10083),
(1116, '2022-07-12 13:29:36', 'Asignacion finalizada: 38', 10083),
(1117, '2022-07-12 13:29:38', 'Visualizo el listado de asignaciones', 10083),
(1118, '2022-07-12 13:29:57', 'Creacion de nuevo paso procesado: Verificar cada cable que permite acceso a un punto de red', 10083),
(1119, '2022-07-12 13:30:03', 'Asignacion finalizada: 42', 10083),
(1120, '2022-07-12 13:30:05', 'Visualizo el listado de asignaciones', 10083),
(1121, '2022-07-12 13:30:09', 'Visualizo el listado de asignaciones', 10083),
(1122, '2022-07-12 13:30:14', 'Visualizo el listado de solicitud', 10083),
(1123, '2022-07-12 13:30:33', 'Visualizo el listado de solicitud', 10083),
(1124, '2022-07-12 13:30:56', 'Visualizo el listado de solicitud', 10083),
(1125, '2022-07-12 13:31:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1126, '2022-07-12 13:31:04', 'Visualizo el listado de solicitud', 10083),
(1127, '2022-07-12 13:31:09', 'Visualizo el listado de solicitud', 10083),
(1128, '2022-07-12 13:31:21', 'Visualizo el listado de solicitud', 10083),
(1129, '2022-07-12 13:31:25', 'Visualizo el listado de solicitud', 10083),
(1130, '2022-07-12 13:31:29', 'Visualizo el listado de asignaciones', 10083),
(1131, '2022-07-12 13:31:31', 'Visualizo el listado de solicitud', 10083),
(1132, '2022-07-12 13:31:36', 'Creacion de nueva solicitud: Necesito la revisión de un cable de red', 10082),
(1133, '2022-07-12 13:31:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1134, '2022-07-12 13:32:13', 'Creacion de nueva asignacion: Se hizo revision', 10083),
(1135, '2022-07-12 13:32:13', 'Visualizo el listado de solicitud', 10083),
(1136, '2022-07-12 13:32:24', 'Visualizo el listado de solicitud', 10083),
(1137, '2022-07-12 13:32:27', 'Visualizo el listado de asignaciones', 10083),
(1138, '2022-07-12 13:32:30', 'Actualizo la siguiente solicitud: Necesito la revisión de un cable de red', 10082),
(1139, '2022-07-12 13:32:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1140, '2022-07-12 13:32:34', 'Visualizo el listado de asignaciones', 10083),
(1141, '2022-07-12 13:32:35', 'Visualizo el listado de solicitud', 10082),
(1142, '2022-07-12 13:32:38', 'Visualizo el listado de asignaciones', 10083),
(1143, '2022-07-12 13:33:05', 'Inicio de Sesion', 1),
(1144, '2022-07-12 13:33:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1145, '2022-07-12 13:33:05', 'Creacion de nuevo paso procesado: Colocor emsamblar los equipos', 10083),
(1146, '2022-07-12 13:33:08', 'Creacion de nueva asignacion: Por favor realizar la respectiva revisión al cable de red', 10082),
(1147, '2022-07-12 13:33:09', 'Visualizo el listado de solicitud', 10082),
(1148, '2022-07-12 13:33:11', 'Asignacion finalizada: 12', 10083),
(1149, '2022-07-12 13:33:13', 'Visualizo el listado de asignaciones', 10083),
(1150, '2022-07-12 13:33:14', 'Visualizo el listado de asignaciones', 10082),
(1151, '2022-07-12 13:33:20', 'Visualizo el listado de solicitud', 10083),
(1152, '2022-07-12 13:33:23', 'Visualizo el listado de solicitud', 10083),
(1153, '2022-07-12 13:33:55', 'Visualizo el listado de solicitud', 10083),
(1154, '2022-07-12 13:34:05', 'Creacion de nuevo paso procesado: la computadora no tenia acceso a Internet, el cable de red estaba flojo y se ajusto de forma manual', 10082),
(1155, '2022-07-12 13:34:13', 'Asignacion finalizada: 79', 10082),
(1156, '2022-07-12 13:34:14', 'Visualizo el listado de asignaciones', 10082),
(1157, '2022-07-12 13:34:21', 'Visualizo el listado de solicitud', 10082),
(1158, '2022-07-12 13:34:30', 'Creacion de nueva solicitud: Cambio de hora y fecha', 10083),
(1159, '2022-07-12 13:34:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1160, '2022-07-12 13:34:44', 'Visualizo el listado de solicitud', 10082),
(1161, '2022-07-12 13:34:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1162, '2022-07-12 13:35:21', 'Visualizo el listado de direcciones', 1),
(1163, '2022-07-12 13:35:36', 'Hizo la siguiente busqueda: consultoria en el listado de direcciones', 1);
INSERT INTO `bitacora` (`bitacora_id`, `bitacora_fecha`, `bitacora_accion`, `usuario_id`) VALUES
(1164, '2022-07-12 13:35:47', 'Hizo la siguiente busqueda: consultoria en el listado de direcciones', 1),
(1165, '2022-07-12 13:36:03', 'Actualizo la siguiente solicitud: Cambio de hora y fecha', 10083),
(1166, '2022-07-12 13:36:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1167, '2022-07-12 13:36:11', 'Visualizo el listado de solicitud', 10083),
(1168, '2022-07-12 13:36:14', 'Hizo la siguiente busqueda: crean en el listado de direcciones', 1),
(1169, '2022-07-12 13:37:06', 'Creacion de nueva asignacion: Cambio de hora y fecha para poder establecer internet en la laptop', 10083),
(1170, '2022-07-12 13:37:07', 'Visualizo el listado de solicitud', 10083),
(1171, '2022-07-12 13:37:11', 'Visualizo el listado de asignaciones', 10083),
(1172, '2022-07-12 13:37:16', 'Visualizo el listado de asignaciones', 10083),
(1173, '2022-07-12 13:37:59', 'Creacion de nueva solicitud: Tengo problemas con la hora y fecha', 10082),
(1174, '2022-07-12 13:38:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1175, '2022-07-12 13:38:40', 'Actualizo la siguiente solicitud: Tengo problemas con la hora y fecha', 10082),
(1176, '2022-07-12 13:38:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1177, '2022-07-12 13:38:45', 'Visualizo el listado de solicitud', 10082),
(1178, '2022-07-12 13:39:27', 'Creacion de nueva asignacion: Por favor realizar las correcciones pertinentes para regularizar la hora y fecha', 10082),
(1179, '2022-07-12 13:39:28', 'Visualizo el listado de solicitud', 10082),
(1180, '2022-07-12 13:39:33', 'Visualizo el listado de asignaciones', 10082),
(1181, '2022-07-12 13:39:58', 'Creacion de un nuevo paso: Corrección de hora y fecha', 10083),
(1182, '2022-07-12 13:40:02', 'Visualizo el listado de asignaciones', 10083),
(1183, '2022-07-12 13:40:05', 'Visualizo el listado de asignaciones', 10083),
(1184, '2022-07-12 13:40:13', 'Creacion de nuevo paso procesado: Corrección de hora y fecha', 10083),
(1185, '2022-07-12 13:40:18', 'Asignacion finalizada: 81', 10083),
(1186, '2022-07-12 13:40:19', 'Visualizo el listado de asignaciones', 10083),
(1187, '2022-07-12 13:40:24', 'Visualizo el listado de solicitud', 10083),
(1188, '2022-07-12 13:40:32', 'Creacion de un nuevo paso: Realizar cambio de bateria', 10082),
(1189, '2022-07-12 13:40:37', 'Visualizo el listado de solicitud', 10083),
(1190, '2022-07-12 13:40:38', 'Visualizo el listado de asignaciones', 10082),
(1191, '2022-07-12 13:40:39', 'Creacion de nueva solicitud: Equipo sin internet', 10081),
(1192, '2022-07-12 13:40:50', 'Visualizo el listado de solicitud', 10081),
(1193, '2022-07-12 13:40:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1194, '2022-07-12 13:41:16', 'Creacion de nuevo paso procesado: Se procede a reemplazar la batería de la tarjeta madre y a configurar la hora', 10082),
(1195, '2022-07-12 13:41:19', 'Actualizo la siguiente solicitud: Equipo sin internet', 10081),
(1196, '2022-07-12 13:41:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1197, '2022-07-12 13:41:32', 'Creacion de nuevo paso procesado: se realizo el cambio de bateria', 10082),
(1198, '2022-07-12 13:41:33', 'Visualizo el listado de solicitud', 10081),
(1199, '2022-07-12 13:41:38', 'Asignacion finalizada: 83', 10082),
(1200, '2022-07-12 13:41:40', 'Visualizo el listado de asignaciones', 10082),
(1201, '2022-07-12 13:41:43', 'Visualizo el listado de cargos', 1),
(1202, '2022-07-12 13:41:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1203, '2022-07-12 13:41:58', 'Creacion de nueva asignacion: Equipo sin internet', 10081),
(1204, '2022-07-12 13:41:58', 'Visualizo el listado de solicitud', 10081),
(1205, '2022-07-12 13:42:01', 'Creacion de nuevo cargo: USUARIO DEL SISTEMA', 1),
(1206, '2022-07-12 13:42:02', 'Visualizo el listado de solicitud', 10082),
(1207, '2022-07-12 13:42:02', 'Visualizo el listado de solicitud', 10081),
(1208, '2022-07-12 13:42:26', 'Actualizo la siguiente solicitud: Equipo sin internet', 10081),
(1209, '2022-07-12 13:42:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1210, '2022-07-12 13:42:35', 'Visualizo el listado de solicitud', 10081),
(1211, '2022-07-12 13:42:38', 'Creacion de nueva solicitud: Instalacion de Toner', 10083),
(1212, '2022-07-12 13:42:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1213, '2022-07-12 13:42:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1214, '2022-07-12 13:42:53', 'Creacion de nueva asignacion: Equipo sin internet', 10081),
(1215, '2022-07-12 13:42:53', 'Visualizo el listado de solicitud', 10081),
(1216, '2022-07-12 13:42:59', 'Visualizo el listado de asignaciones', 10081),
(1217, '2022-07-12 13:43:08', 'Actualizo la siguiente solicitud: Instalacion de Toner', 10083),
(1218, '2022-07-12 13:43:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1219, '2022-07-12 13:43:12', 'Visualizo el listado de solicitud', 10082),
(1220, '2022-07-12 13:43:13', 'Visualizo el listado de solicitud', 10083),
(1221, '2022-07-12 13:43:17', 'Visualizo el listado de solicitud', 10083),
(1222, '2022-07-12 13:43:38', 'Creacion de nuevo paso procesado: Se activo y desactivo conexión a internet en el equipo', 10081),
(1223, '2022-07-12 13:43:38', 'Inicio de Sesion', 10101),
(1224, '2022-07-12 13:43:46', 'Creacion de nueva asignacion: Camibiar toner de la impresora', 10083),
(1225, '2022-07-12 13:43:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1226, '2022-07-12 13:43:46', 'Visualizo el listado de solicitud', 10083),
(1227, '2022-07-12 13:43:49', 'Asignacion finalizada: 86', 10081),
(1228, '2022-07-12 13:43:51', 'Visualizo el listado de asignaciones', 10081),
(1229, '2022-07-12 13:43:53', 'Visualizo el listado de asignaciones', 10083),
(1230, '2022-07-12 13:43:56', 'Visualizo el listado de solicitud', 10081),
(1231, '2022-07-12 13:43:56', 'Visualizo el listado de asignaciones', 10083),
(1232, '2022-07-12 13:44:29', 'Creacion de nuevo paso procesado: Limpie el aerea de la impresora y instale el toner', 10083),
(1233, '2022-07-12 13:44:35', 'Creacion de nueva solicitud: La impresora no me da señal', 10082),
(1234, '2022-07-12 13:44:35', 'Asignacion finalizada: 88', 10083),
(1235, '2022-07-12 13:44:36', 'Visualizo el listado de asignaciones', 10083),
(1236, '2022-07-12 13:44:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1237, '2022-07-12 13:44:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1238, '2022-07-12 13:44:48', 'Visualizo el listado de solicitud', 10083),
(1239, '2022-07-12 13:45:05', 'Actualizo la siguiente solicitud: La impresora no me da señal', 10082),
(1240, '2022-07-12 13:45:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1241, '2022-07-12 13:45:08', 'Visualizo el listado de solicitud', 10083),
(1242, '2022-07-12 13:45:11', 'Visualizo el listado de solicitud', 10082),
(1243, '2022-07-12 13:45:47', 'Creacion de nueva asignacion: Por favor revise la revisión a la impresora y su cable de red', 10082),
(1244, '2022-07-12 13:45:47', 'Visualizo el listado de solicitud', 10082),
(1245, '2022-07-12 13:45:52', 'Visualizo el listado de asignaciones', 10082),
(1246, '2022-07-12 13:46:19', 'Creacion de nueva solicitud: revisión de impresora', 10101),
(1247, '2022-07-12 13:46:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1248, '2022-07-12 13:46:28', 'Creacion de nueva solicitud: Conexion de impresora a una pc', 10083),
(1249, '2022-07-12 13:46:32', 'Visualizo el listado de solicitud', 10083),
(1250, '2022-07-12 13:46:53', 'Actualizo la siguiente solicitud: Conexion de impresora a una pc', 10083),
(1251, '2022-07-12 13:46:54', 'Actualizo la siguiente solicitud: revisión de impresora', 10101),
(1252, '2022-07-12 13:46:55', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1253, '2022-07-12 13:46:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1254, '2022-07-12 13:46:58', 'Visualizo el listado de solicitud', 10083),
(1255, '2022-07-12 13:46:59', 'Visualizo el listado de solicitud', 10101),
(1256, '2022-07-12 13:47:35', 'Creacion de nueva asignacion: Se compartio conexion de una impresora a una pc', 10083),
(1257, '2022-07-12 13:47:36', 'Visualizo el listado de solicitud', 10083),
(1258, '2022-07-12 13:47:40', 'Visualizo el listado de asignaciones', 10083),
(1259, '2022-07-12 13:47:40', 'Creacion de nueva asignacion: la impresora no queria imprimir dando aviso de toner', 10101),
(1260, '2022-07-12 13:47:40', 'Creacion de nuevo paso procesado: la computadora que tiene acceso a la impresora no tenia red (conexion) el cable de red estaba flojo y una punta sin seguro se reemplazo la punta y se logro acceder a la impresora, con impresión lograda', 10082),
(1261, '2022-07-12 13:47:40', 'Visualizo el listado de solicitud', 10101),
(1262, '2022-07-12 13:47:45', 'Visualizo el listado de asignaciones', 10101),
(1263, '2022-07-12 13:47:46', 'Asignacion finalizada: 90', 10082),
(1264, '2022-07-12 13:47:48', 'Visualizo el listado de asignaciones', 10082),
(1265, '2022-07-12 13:47:48', 'Creacion de nuevo paso procesado: Se compartio conexion de una impresora a una pc', 10083),
(1266, '2022-07-12 13:47:52', 'Visualizo el listado de solicitud', 10082),
(1267, '2022-07-12 13:47:54', 'Asignacion finalizada: 93', 10083),
(1268, '2022-07-12 13:47:56', 'Visualizo el listado de asignaciones', 10083),
(1269, '2022-07-12 13:47:59', 'Visualizo el listado de solicitud', 10083),
(1270, '2022-07-12 13:48:16', 'Visualizo el listado de solicitud', 10083),
(1271, '2022-07-12 13:48:20', 'Visualizo el listado de solicitud', 10082),
(1272, '2022-07-12 13:48:25', 'Creacion de un nuevo paso: Revisión de impresora', 10101),
(1273, '2022-07-12 13:48:29', 'Visualizo el listado de asignaciones', 10101),
(1274, '2022-07-12 13:48:39', 'Creacion de nuevo paso procesado: ', 10101),
(1275, '2022-07-12 13:48:45', 'Asignacion finalizada: 94', 10101),
(1276, '2022-07-12 13:48:47', 'Visualizo el listado de asignaciones', 10101),
(1277, '2022-07-12 13:49:35', 'Creacion de nueva solicitud: Instalacion de paqueteria office 2010', 10083),
(1278, '2022-07-12 13:49:39', 'Visualizo el listado de solicitud', 10083),
(1279, '2022-07-12 13:49:43', 'Visualizo el listado de solicitud', 10083),
(1280, '2022-07-12 13:49:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1281, '2022-07-12 13:50:06', 'Actualizo la siguiente solicitud: Instalacion de paqueteria office 2010', 10083),
(1282, '2022-07-12 13:50:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1283, '2022-07-12 13:50:10', 'Visualizo el listado de solicitud', 10083),
(1284, '2022-07-12 13:50:35', 'Creacion de nueva solicitud: Necesito una revisión de conexión a Internet e instalación de programas', 10082),
(1285, '2022-07-12 13:50:38', 'Creacion de nueva asignacion: Instalacion de paqueteria', 10083),
(1286, '2022-07-12 13:50:39', 'Visualizo el listado de solicitud', 10083),
(1287, '2022-07-12 13:50:42', 'Visualizo el listado de asignaciones', 10083),
(1288, '2022-07-12 13:50:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1289, '2022-07-12 13:50:46', 'Visualizo el listado de asignaciones', 10083),
(1290, '2022-07-12 13:50:53', 'Creacion de nuevo paso procesado: ', 10083),
(1291, '2022-07-12 13:50:56', 'Creacion de nuevo paso procesado: ', 10083),
(1292, '2022-07-12 13:50:59', 'Creacion de nuevo paso procesado: ', 10083),
(1293, '2022-07-12 13:51:03', 'Creacion de nuevo paso procesado: ', 10083),
(1294, '2022-07-12 13:51:06', 'Creacion de nuevo paso procesado: ', 10083),
(1295, '2022-07-12 13:51:09', 'Actualizo la siguiente solicitud: Necesito una revisión de conexión a Internet e instalación de programas', 10082),
(1296, '2022-07-12 13:51:10', 'Creacion de nuevo paso procesado: ', 10083),
(1297, '2022-07-12 13:51:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(1298, '2022-07-12 13:51:38', 'Creacion de nuevo paso procesado: Desintalacion e instalacion de paqueteria de office a una nueva version', 10083),
(1299, '2022-07-12 13:51:44', 'Asignacion finalizada: 96', 10083),
(1300, '2022-07-12 13:51:45', 'Visualizo el listado de asignaciones', 10083),
(1301, '2022-07-12 13:51:48', 'Visualizo el listado de solicitud', 10083),
(1302, '2022-07-12 13:52:02', 'Visualizo el listado de solicitud', 10083),
(1303, '2022-07-12 13:52:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1304, '2022-07-12 13:52:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1305, '2022-07-12 13:52:56', 'Creacion de nueva solicitud: Correcion de hora y fecha', 10083),
(1306, '2022-07-12 13:53:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1307, '2022-07-12 13:53:29', 'Actualizo la siguiente solicitud: Correcion de hora y fecha', 10083),
(1308, '2022-07-12 13:53:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1309, '2022-07-12 13:53:34', 'Visualizo el listado de solicitud', 10083),
(1310, '2022-07-12 13:54:30', 'Creacion de nueva asignacion: El equipo presentaba hora y fecha erronea', 10083),
(1311, '2022-07-12 13:54:31', 'Visualizo el listado de solicitud', 10083),
(1312, '2022-07-12 13:54:36', 'Visualizo el listado de asignaciones', 10083),
(1313, '2022-07-12 13:54:40', 'Visualizo el listado de asignaciones', 10083),
(1314, '2022-07-12 13:54:47', 'Creacion de nuevo paso procesado: El equipo presentaba hora y fecha erronea', 10083),
(1315, '2022-07-12 13:54:56', 'Visualizo el listado de solicitud', 10082),
(1316, '2022-07-12 13:55:14', 'Visualizo el listado de solicitud', 10081),
(1317, '2022-07-12 13:55:33', 'Creacion de nuevo paso procesado: Se procedio a corregir mediante privilegios de administrador', 10083),
(1318, '2022-07-12 13:55:39', 'Asignacion finalizada: 102', 10083),
(1319, '2022-07-12 13:55:40', 'Visualizo el listado de asignaciones', 10083),
(1320, '2022-07-12 13:55:41', 'Creacion de nueva solicitud: crear contraseñas', 10101),
(1321, '2022-07-12 13:55:44', 'Visualizo el listado de solicitud', 10083),
(1322, '2022-07-12 13:55:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1323, '2022-07-12 13:55:51', 'Visualizo el listado de solicitud', 10082),
(1324, '2022-07-12 13:56:09', 'Actualizo la siguiente solicitud: crear contraseñas', 10101),
(1325, '2022-07-12 13:56:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1326, '2022-07-12 13:56:11', 'Visualizo el listado de solicitud', 10083),
(1327, '2022-07-12 13:56:15', 'Visualizo el listado de asignaciones', 10101),
(1328, '2022-07-12 13:56:20', 'Visualizo el listado de solicitud', 10101),
(1329, '2022-07-12 13:56:22', 'Creacion de nueva asignacion: Revisar y Colocar acceso a Internet', 10082),
(1330, '2022-07-12 13:56:22', 'Visualizo el listado de solicitud', 10082),
(1331, '2022-07-12 13:57:10', 'Creacion de nueva asignacion: por favor realizar la evaluación pertinente para la instalación de programas', 10082),
(1332, '2022-07-12 13:57:10', 'Visualizo el listado de solicitud', 10082),
(1333, '2022-07-12 13:57:20', 'Visualizo el listado de asignaciones', 10082),
(1334, '2022-07-12 13:58:27', 'Creacion de nueva asignacion: se creo contraseña de usuario al equipo solicitado de (Marielvys)', 10101),
(1335, '2022-07-12 13:58:27', 'Visualizo el listado de solicitud', 10101),
(1336, '2022-07-12 13:58:28', 'Creacion de nueva solicitud: Reinstalacion de windows 10 y respaldo', 10083),
(1337, '2022-07-12 13:58:31', 'Visualizo el listado de solicitud', 10083),
(1338, '2022-07-12 13:58:36', 'Visualizo el listado de asignaciones', 10101),
(1339, '2022-07-12 13:58:44', 'Creacion de nuevo paso procesado: ', 10101),
(1340, '2022-07-12 13:58:46', 'Creacion de nuevo paso procesado: se revisa la configuración de red a un equipo que no tenia conexión a Internet, se reinicia el dispositivo para obtener una nueva IP', 10082),
(1341, '2022-07-12 13:58:49', 'Asignacion finalizada: 106', 10101),
(1342, '2022-07-12 13:58:50', 'Visualizo el listado de asignaciones', 10101),
(1343, '2022-07-12 13:58:52', 'Visualizo el listado de solicitud', 10083),
(1344, '2022-07-12 13:58:56', 'Asignacion finalizada: 99', 10082),
(1345, '2022-07-12 13:58:57', 'Visualizo el listado de asignaciones', 10082),
(1346, '2022-07-12 13:59:21', 'Actualizo la siguiente solicitud: Reinstalacion de windows 10 y respaldo', 10083),
(1347, '2022-07-12 13:59:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1348, '2022-07-12 13:59:29', 'Visualizo el listado de asignaciones', 10083),
(1349, '2022-07-12 13:59:33', 'Visualizo el listado de asignaciones', 10083),
(1350, '2022-07-12 13:59:37', 'Visualizo el listado de asignaciones', 10083),
(1351, '2022-07-12 13:59:45', 'Visualizo el listado de solicitud', 10083),
(1352, '2022-07-12 14:00:04', 'Creacion de un nuevo paso: Instalación de Programas', 10082),
(1353, '2022-07-12 14:00:07', 'Creacion de nueva asignacion: El equipo presentaba fallas', 10083),
(1354, '2022-07-12 14:00:07', 'Visualizo el listado de solicitud', 10083),
(1355, '2022-07-12 14:00:10', 'Visualizo el listado de asignaciones', 10083),
(1356, '2022-07-12 14:00:11', 'Visualizo el listado de asignaciones', 10082),
(1357, '2022-07-12 14:00:16', 'Creacion de nuevo paso procesado: ', 10083),
(1358, '2022-07-12 14:00:18', 'Creacion de nuevo paso procesado: ', 10083),
(1359, '2022-07-12 14:00:22', 'Creacion de nuevo paso procesado: ', 10083),
(1360, '2022-07-12 14:00:26', 'Creacion de nuevo paso procesado: ', 10083),
(1361, '2022-07-12 14:00:26', 'Creacion de nueva solicitud: respaldo de información', 10101),
(1362, '2022-07-12 14:00:30', 'Creacion de nuevo paso procesado: ', 10083),
(1363, '2022-07-12 14:00:33', 'Visualizo el listado de solicitud', 10101),
(1364, '2022-07-12 14:00:33', 'Creacion de nuevo paso procesado: ', 10083),
(1365, '2022-07-12 14:00:37', 'Creacion de nuevo paso procesado: ', 10083),
(1366, '2022-07-12 14:00:40', 'Creacion de nuevo paso procesado: ', 10083),
(1367, '2022-07-12 14:00:46', 'Visualizo el listado de solicitud', 10101),
(1368, '2022-07-12 14:00:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1369, '2022-07-12 14:01:12', 'Creacion de nuevo paso procesado: Se instalo un sistema a petición del Director se necesitaban los privilegios de administración y se realizo satisfactoriamente', 10082),
(1370, '2022-07-12 14:01:14', 'Actualizo la siguiente solicitud: respaldo de información', 10101),
(1371, '2022-07-12 14:01:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1372, '2022-07-12 14:01:18', 'Asignacion finalizada: 100', 10082),
(1373, '2022-07-12 14:01:19', 'Visualizo el listado de solicitud', 10101),
(1374, '2022-07-12 14:01:19', 'Visualizo el listado de asignaciones', 10082),
(1375, '2022-07-12 14:01:26', 'Creacion de nuevo paso procesado: El equipo presentaba fallas al reiniciar el sistema operativo luego de intentar varios metodos', 10083),
(1376, '2022-07-12 14:01:32', 'Asignacion finalizada: 108', 10083),
(1377, '2022-07-12 14:01:33', 'Visualizo el listado de asignaciones', 10083),
(1378, '2022-07-12 14:01:35', 'Visualizo el listado de solicitud', 10082),
(1379, '2022-07-12 14:01:36', 'Visualizo el listado de solicitud', 10083),
(1380, '2022-07-12 14:01:55', 'Visualizo el listado de solicitud', 10083),
(1381, '2022-07-12 14:02:49', 'Visualizo el listado de solicitud', 10082),
(1382, '2022-07-12 14:03:13', 'Creacion de nueva asignacion: se requiere copia de seguridad de un disco duro a otro', 10101),
(1383, '2022-07-12 14:03:13', 'Visualizo el listado de solicitud', 10101),
(1384, '2022-07-12 14:03:18', 'Visualizo el listado de asignaciones', 10101),
(1385, '2022-07-12 14:03:42', 'Creacion de nueva solicitud: Revisión de impresora', 10081),
(1386, '2022-07-12 14:03:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1387, '2022-07-12 14:03:53', 'Creacion de un nuevo paso: Respaldo de informacion', 10101),
(1388, '2022-07-12 14:03:57', 'Visualizo el listado de asignaciones', 10101),
(1389, '2022-07-12 14:04:07', 'Creacion de nuevo paso procesado: Respaldo de informacion', 10101),
(1390, '2022-07-12 14:04:12', 'Asignacion finalizada: 110', 10101),
(1391, '2022-07-12 14:04:14', 'Visualizo el listado de actividades', 10082),
(1392, '2022-07-12 14:04:14', 'Visualizo el listado de asignaciones', 10101),
(1393, '2022-07-12 14:04:14', 'Actualizo la siguiente solicitud: Revisión de impresora', 10081),
(1394, '2022-07-12 14:04:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1395, '2022-07-12 14:04:20', 'Visualizo el listado de solicitud', 10081),
(1396, '2022-07-12 14:04:20', 'Visualizo el listado de solicitud', 10082),
(1397, '2022-07-12 14:05:13', 'Creacion de nueva asignacion: Problemas de conexión con la impresora', 10081),
(1398, '2022-07-12 14:05:14', 'Visualizo el listado de solicitud', 10081),
(1399, '2022-07-12 14:06:01', 'Visualizo el listado de solicitud', 10081),
(1400, '2022-07-12 14:06:10', 'Visualizo el listado de asignaciones', 10081),
(1401, '2022-07-12 14:06:18', 'Visualizo el listado de asignaciones', 10081),
(1402, '2022-07-12 14:06:40', 'Creacion de nuevo paso procesado: Problemas de conexión con la impresora', 10081),
(1403, '2022-07-12 14:06:47', 'Asignacion finalizada: 114', 10081),
(1404, '2022-07-12 14:06:48', 'Visualizo el listado de asignaciones', 10081),
(1405, '2022-07-12 14:06:52', 'Visualizo el listado de solicitud', 10081),
(1406, '2022-07-12 14:07:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1407, '2022-07-12 14:07:41', 'Creacion de nueva solicitud: Reparacion de impresora', 10083),
(1408, '2022-07-12 14:07:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1409, '2022-07-12 14:08:15', 'Actualizo la siguiente solicitud: Reparacion de impresora', 10083),
(1410, '2022-07-12 14:08:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1411, '2022-07-12 14:08:20', 'Visualizo el listado de solicitud', 10083),
(1412, '2022-07-12 14:08:41', 'Creacion de nueva asignacion: Emsablaje y pruebas', 10083),
(1413, '2022-07-12 14:08:41', 'Visualizo el listado de solicitud', 10083),
(1414, '2022-07-12 14:08:45', 'Visualizo el listado de asignaciones', 10083),
(1415, '2022-07-12 14:08:48', 'Visualizo el listado de asignaciones', 10083),
(1416, '2022-07-12 14:09:03', 'Creacion de nuevo paso procesado: Emsamblaje y pruebas', 10083),
(1417, '2022-07-12 14:09:06', 'Creacion de nueva solicitud: Instalar Software y respaldo a mi pc', 10081),
(1418, '2022-07-12 14:09:08', 'Asignacion finalizada: 116', 10083),
(1419, '2022-07-12 14:09:10', 'Visualizo el listado de asignaciones', 10083),
(1420, '2022-07-12 14:09:17', 'Visualizo el listado de asignaciones', 10083),
(1421, '2022-07-12 14:09:20', 'Visualizo el listado de asignaciones', 10083),
(1422, '2022-07-12 14:09:23', 'Visualizo el listado de asignaciones', 10083),
(1423, '2022-07-12 14:09:28', 'Visualizo el listado de solicitud', 10083),
(1424, '2022-07-12 14:09:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1425, '2022-07-12 14:10:42', 'Creacion de nueva solicitud: Instalacion de Router', 10083),
(1426, '2022-07-12 14:11:34', 'Visualizo el listado de solicitud', 10083),
(1427, '2022-07-12 14:11:57', 'Actualizo la siguiente solicitud: Instalacion de Router', 10083),
(1428, '2022-07-12 14:11:58', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1429, '2022-07-12 14:12:05', 'Visualizo el listado de solicitud', 10083),
(1430, '2022-07-12 14:12:13', 'Visualizo el listado de asignaciones', 10101),
(1431, '2022-07-12 14:12:26', 'Creacion de nueva asignacion: Instalacion para video conferencias', 10083),
(1432, '2022-07-12 14:12:26', 'Visualizo el listado de solicitud', 10083),
(1433, '2022-07-12 14:12:29', 'Visualizo el listado de asignaciones', 10083),
(1434, '2022-07-12 14:12:34', 'Visualizo el listado de asignaciones', 10083),
(1435, '2022-07-12 14:12:42', 'Creacion de nuevo paso procesado: Instalacion para video conferencias', 10083),
(1436, '2022-07-12 14:12:47', 'Asignacion finalizada: 120', 10083),
(1437, '2022-07-12 14:12:48', 'Visualizo el listado de asignaciones', 10083),
(1438, '2022-07-12 14:13:54', 'Creacion de nueva solicitud: Reconeccion de internet', 10101),
(1439, '2022-07-12 14:14:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1440, '2022-07-12 14:14:45', 'Actualizo la siguiente solicitud: Reconeccion de internet', 10101),
(1441, '2022-07-12 14:14:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1442, '2022-07-12 14:14:49', 'Visualizo el listado de solicitud', 10101),
(1443, '2022-07-12 14:15:19', 'Creacion de nueva solicitud: Reparacion de sistema operativo', 10083),
(1444, '2022-07-12 14:15:25', 'Visualizo el listado de solicitud', 10083),
(1445, '2022-07-12 14:15:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1446, '2022-07-12 14:15:52', 'Creacion de nueva asignacion: se hizo reconexion del Internet a otra', 10101),
(1447, '2022-07-12 14:15:52', 'Visualizo el listado de solicitud', 10101),
(1448, '2022-07-12 14:16:08', 'Visualizo el listado de solicitud', 10101),
(1449, '2022-07-12 14:16:12', 'Visualizo el listado de solicitud', 10081),
(1450, '2022-07-12 14:16:24', 'Visualizo el listado de solicitud', 10081),
(1451, '2022-07-12 14:16:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1452, '2022-07-12 14:16:43', 'Actualizo la siguiente solicitud: Reconeccion de internet', 10101),
(1453, '2022-07-12 14:16:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1454, '2022-07-12 14:16:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1455, '2022-07-12 14:16:53', 'Actualizo la siguiente solicitud: Instalar Software y respaldo a mi pc', 10081),
(1456, '2022-07-12 14:16:54', 'Visualizo el listado de solicitud', 10101),
(1457, '2022-07-12 14:17:06', 'Visualizo el listado de solicitud', 10101),
(1458, '2022-07-12 14:17:19', 'Visualizo el listado de solicitud', 10101),
(1459, '2022-07-12 14:17:22', 'Visualizo el listado de solicitud', 10101),
(1460, '2022-07-12 14:17:27', 'Visualizo el listado de solicitud', 10101),
(1461, '2022-07-12 14:17:33', 'Visualizo el listado de solicitud', 10083),
(1462, '2022-07-12 14:17:36', 'Visualizo el listado de solicitud', 10101),
(1463, '2022-07-12 14:17:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1464, '2022-07-12 14:17:49', 'Visualizo el listado de solicitud', 10101),
(1465, '2022-07-12 14:17:55', 'Visualizo el listado de asignaciones', 10101),
(1466, '2022-07-12 14:17:59', 'Visualizo el listado de solicitud', 10101),
(1467, '2022-07-12 14:18:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1468, '2022-07-12 14:18:11', 'Visualizo el listado de asignaciones', 10081),
(1469, '2022-07-12 14:18:17', 'Visualizo el listado de asignaciones', 10081),
(1470, '2022-07-12 14:18:24', 'Creacion de nueva asignacion: reconexion a internet', 10101),
(1471, '2022-07-12 14:18:25', 'Visualizo el listado de solicitud', 10101),
(1472, '2022-07-12 14:18:31', 'Actualizo la siguiente solicitud: Reparacion de sistema operativo', 10083),
(1473, '2022-07-12 14:18:32', 'Visualizo el listado de asignaciones', 10101),
(1474, '2022-07-12 14:18:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1475, '2022-07-12 14:18:35', 'Visualizo el listado de solicitud', 10081),
(1476, '2022-07-12 14:18:36', 'Visualizo el listado de solicitud', 10083),
(1477, '2022-07-12 14:18:43', 'Creacion de nuevo paso procesado: Descripción Restablecer Conexión Internet', 10101),
(1478, '2022-07-12 14:18:44', 'Visualizo el listado de asignaciones', 10081),
(1479, '2022-07-12 14:18:47', 'Asignacion finalizada: 124', 10101),
(1480, '2022-07-12 14:18:48', 'Visualizo el listado de asignaciones', 10101),
(1481, '2022-07-12 14:18:49', 'Visualizo el listado de solicitud', 10081),
(1482, '2022-07-12 14:18:53', 'Visualizo el listado de solicitud', 10101),
(1483, '2022-07-12 14:19:06', 'Creacion de nueva asignacion: Reparacion de S.O', 10083),
(1484, '2022-07-12 14:19:07', 'Visualizo el listado de solicitud', 10083),
(1485, '2022-07-12 14:19:10', 'Visualizo el listado de asignaciones', 10083),
(1486, '2022-07-12 14:19:13', 'Actualizo la siguiente solicitud: Instalar Software y respaldo a mi pc', 10081),
(1487, '2022-07-12 14:19:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1488, '2022-07-12 14:19:19', 'Visualizo el listado de solicitud', 10081),
(1489, '2022-07-12 14:19:30', 'Creacion de nuevo paso procesado: reparacion de sistema operativo', 10083),
(1490, '2022-07-12 14:19:34', 'Asignacion finalizada: 127', 10083),
(1491, '2022-07-12 14:19:36', 'Visualizo el listado de asignaciones', 10083),
(1492, '2022-07-12 14:19:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1493, '2022-07-12 14:20:14', 'Creacion de nueva asignacion: Respaldo a los archivos, se instalo software y aplicaciones informaticas', 10081),
(1494, '2022-07-12 14:20:14', 'Visualizo el listado de solicitud', 10081),
(1495, '2022-07-12 14:20:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1496, '2022-07-12 14:20:18', 'Visualizo el listado de asignaciones', 10081),
(1497, '2022-07-12 14:20:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1498, '2022-07-12 14:20:49', 'Visualizo el listado de solicitud', 10101),
(1499, '2022-07-12 14:20:50', 'Creacion de nuevo paso procesado: Realizar respaldo, instalar software y app informaticas', 10081),
(1500, '2022-07-12 14:20:56', 'Asignacion finalizada: 128', 10081),
(1501, '2022-07-12 14:20:57', 'Visualizo el listado de asignaciones', 10081),
(1502, '2022-07-12 14:21:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1503, '2022-07-12 14:21:02', 'Creacion de nueva solicitud: Configuracion de Red', 10083),
(1504, '2022-07-12 14:21:02', 'Visualizo el listado de solicitud', 10101),
(1505, '2022-07-12 14:21:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1506, '2022-07-12 14:21:10', 'Visualizo el listado de solicitud', 10083),
(1507, '2022-07-12 14:21:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1508, '2022-07-12 14:21:33', 'Actualizo la siguiente solicitud: Configuracion de Red', 10083),
(1509, '2022-07-12 14:21:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1510, '2022-07-12 14:21:40', 'Visualizo el listado de solicitud', 10083),
(1511, '2022-07-12 14:22:12', 'Creacion de nueva asignacion: Un agrego dos equipos al Pfsense', 10083),
(1512, '2022-07-12 14:22:12', 'Visualizo el listado de solicitud', 10083),
(1513, '2022-07-12 14:22:15', 'Visualizo el listado de asignaciones', 10083),
(1514, '2022-07-12 14:22:23', 'Creacion de nuevo paso procesado: Conectividad', 10083),
(1515, '2022-07-12 14:22:29', 'Asignacion finalizada: 131', 10083),
(1516, '2022-07-12 14:22:31', 'Visualizo el listado de asignaciones', 10083),
(1517, '2022-07-12 14:22:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1518, '2022-07-12 14:22:34', 'Visualizo el listado de solicitud', 1),
(1519, '2022-07-12 14:22:36', 'Visualizo el listado de solicitud', 10083),
(1520, '2022-07-12 14:22:49', 'Visualizo el listado de solicitud', 10083),
(1521, '2022-07-12 14:22:55', 'Creacion de nueva solicitud: Ubicar puntos de red', 10081),
(1522, '2022-07-12 14:23:03', 'Visualizo el listado de solicitud', 10083),
(1523, '2022-07-12 14:23:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1524, '2022-07-12 14:23:15', 'Visualizo el listado de solicitud', 10081),
(1525, '2022-07-12 14:23:22', 'Visualizo el listado de solicitud', 10083),
(1526, '2022-07-12 14:23:39', 'Visualizo el listado de solicitud', 10083),
(1527, '2022-07-12 14:23:55', 'Visualizo el listado de solicitud', 10083),
(1528, '2022-07-12 14:24:35', 'Visualizo el listado de solicitud', 10083),
(1529, '2022-07-12 14:24:48', 'Visualizo el listado de solicitud', 10083),
(1530, '2022-07-12 14:25:02', 'Visualizo el listado de solicitud', 10083),
(1531, '2022-07-12 14:25:05', 'Visualizo el listado de solicitud', 10083),
(1532, '2022-07-12 14:25:18', 'Visualizo el listado de solicitud', 10083),
(1533, '2022-07-12 14:25:21', 'Visualizo el listado de solicitud', 10083),
(1534, '2022-07-12 14:25:30', 'Visualizo el listado de solicitud', 10083),
(1535, '2022-07-12 14:25:33', 'Visualizo el listado de solicitud', 10083),
(1536, '2022-07-12 14:25:43', 'Visualizo el listado de solicitud', 10083),
(1537, '2022-07-12 14:25:45', 'Visualizo el listado de solicitud', 10083),
(1538, '2022-07-12 14:25:55', 'Visualizo el listado de solicitud', 10083),
(1539, '2022-07-12 14:25:58', 'Visualizo el listado de solicitud', 10083),
(1540, '2022-07-12 14:26:00', 'Visualizo el listado de solicitud', 10083),
(1541, '2022-07-12 14:26:02', 'Visualizo el listado de solicitud', 10083),
(1542, '2022-07-12 14:26:04', 'Visualizo el listado de solicitud', 10083),
(1543, '2022-07-12 14:26:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1544, '2022-07-12 14:26:46', 'Visualizo el listado de asignaciones', 10081),
(1545, '2022-07-12 14:27:19', 'Visualizo el listado de asignaciones', 10081),
(1546, '2022-07-12 14:27:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1547, '2022-07-12 14:27:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1548, '2022-07-12 14:27:42', 'Visualizo el listado de cargos', 10101),
(1549, '2022-07-12 14:27:52', 'Visualizo el listado de cargos', 10101),
(1550, '2022-07-12 14:28:08', 'Hizo la siguiente busqueda: compo en el listado de cargos', 10101),
(1551, '2022-07-12 14:28:21', 'Hizo la siguiente busqueda: com en el listado de cargos', 10101),
(1552, '2022-07-12 14:28:29', 'Actualizo la siguiente solicitud: Ubicar puntos de red', 10081),
(1553, '2022-07-12 14:28:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1554, '2022-07-12 14:28:36', 'Hizo la siguiente busqueda: co en el listado de cargos', 10101),
(1555, '2022-07-12 14:28:39', 'Visualizo el listado de asignaciones', 10081),
(1556, '2022-07-12 14:28:45', 'Visualizo el listado de asignaciones', 10081),
(1557, '2022-07-12 14:28:53', 'Hizo la siguiente busqueda: co en el listado de cargos', 10101),
(1558, '2022-07-12 14:28:56', 'Visualizo el listado de asignaciones', 10081),
(1559, '2022-07-12 14:28:59', 'Hizo la siguiente busqueda: co en el listado de cargos', 10101),
(1560, '2022-07-12 14:29:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1561, '2022-07-12 14:29:06', 'Visualizo el listado de solicitud', 10081),
(1562, '2022-07-12 14:29:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1563, '2022-07-12 14:29:30', 'Visualizo el listado de cargos', 10101),
(1564, '2022-07-12 14:29:40', 'Actualizo la siguiente solicitud: Ubicar puntos de red', 10081),
(1565, '2022-07-12 14:29:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1566, '2022-07-12 14:29:49', 'Visualizo el listado de asignaciones', 10081),
(1567, '2022-07-12 14:29:56', 'Visualizo el listado de asignaciones', 10081),
(1568, '2022-07-12 14:29:58', 'Hizo la siguiente busqueda: co en el listado de cargos', 10101),
(1569, '2022-07-12 14:30:10', 'Hizo la siguiente busqueda: corpo en el listado de cargos', 10101),
(1570, '2022-07-12 14:30:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1571, '2022-07-12 14:31:41', 'Creacion de nueva solicitud: chequeo de PC en secretaria', 10081),
(1572, '2022-07-12 14:31:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1573, '2022-07-12 14:32:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1574, '2022-07-12 14:32:14', 'Actualizo la siguiente solicitud: chequeo de PC en secretaria', 10081),
(1575, '2022-07-12 14:32:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1576, '2022-07-12 14:32:19', 'Visualizo el listado de solicitud', 10081),
(1577, '2022-07-12 14:32:37', 'Creacion de nuevo cargo: ArcidesI', 10101),
(1578, '2022-07-12 14:33:02', 'Creacion de nueva asignacion: Se ha determinado que la tarjeta madre esta dañada', 10081),
(1579, '2022-07-12 14:33:03', 'Visualizo el listado de solicitud', 10081),
(1580, '2022-07-12 14:33:27', 'Creacion de nueva asignacion: Se ubico el punto de red', 10081),
(1581, '2022-07-12 14:33:27', 'Visualizo el listado de solicitud', 10081),
(1582, '2022-07-12 14:33:31', 'Visualizo el listado de asignaciones', 10081),
(1583, '2022-07-12 14:33:44', 'Creacion de nuevo paso procesado: Se a determinado que la tarjeta madre esta dañada', 10081),
(1584, '2022-07-12 14:33:52', 'Asignacion finalizada: 136', 10081),
(1585, '2022-07-12 14:33:53', 'Visualizo el listado de asignaciones', 10081),
(1586, '2022-07-12 14:34:04', 'Creacion de nuevo paso procesado: ', 10081),
(1587, '2022-07-12 14:34:08', 'Creacion de nuevo paso procesado: ', 10081),
(1588, '2022-07-12 14:34:13', 'Creacion de nuevo paso procesado: ', 10081),
(1589, '2022-07-12 14:34:18', 'Creacion de nuevo paso procesado: ', 10081),
(1590, '2022-07-12 14:34:36', 'Creacion de nuevo paso procesado: Se ubico', 10081),
(1591, '2022-07-12 14:34:44', 'Asignacion finalizada: 134', 10081),
(1592, '2022-07-12 14:34:46', 'Visualizo el listado de asignaciones', 10081),
(1593, '2022-07-12 14:34:52', 'Visualizo el listado de solicitud', 10081),
(1594, '2022-07-12 14:35:08', 'Visualizo el listado de solicitud', 10081),
(1595, '2022-07-12 14:35:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1596, '2022-07-12 14:35:27', 'Visualizo el listado de solicitud', 10081),
(1597, '2022-07-12 14:35:45', 'Creacion de nueva solicitud: verificación de punto de red', 10101),
(1598, '2022-07-12 14:35:52', 'Visualizo el listado de solicitud', 10101),
(1599, '2022-07-12 14:36:35', 'Creacion de nueva solicitud: Cambiar clave', 10081),
(1600, '2022-07-12 14:36:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1601, '2022-07-12 14:36:56', 'Creacion de nueva asignacion: se conecto una pc al Internet dándole al pfsente', 10101),
(1602, '2022-07-12 14:36:56', 'Visualizo el listado de solicitud', 10101),
(1603, '2022-07-12 14:36:59', 'Visualizo el listado de asignaciones', 10101),
(1604, '2022-07-12 14:37:03', 'Actualizo la siguiente solicitud: Cambiar clave', 10081),
(1605, '2022-07-12 14:37:07', 'Creacion de nuevo paso procesado: ', 10101),
(1606, '2022-07-12 14:37:08', 'Visualizo el listado de solicitud', 10081),
(1607, '2022-07-12 14:37:23', 'Creacion de nuevo paso procesado: ', 10101),
(1608, '2022-07-12 14:37:26', 'Creacion de nuevo paso procesado: ', 10101),
(1609, '2022-07-12 14:37:29', 'Creacion de nuevo paso procesado: ', 10101),
(1610, '2022-07-12 14:37:32', 'Creacion de nueva asignacion: Se cambio la clave al usuario', 10081),
(1611, '2022-07-12 14:37:32', 'Visualizo el listado de solicitud', 10081),
(1612, '2022-07-12 14:37:32', 'Creacion de nuevo paso procesado: ', 10101),
(1613, '2022-07-12 14:37:37', 'Visualizo el listado de asignaciones', 10081),
(1614, '2022-07-12 14:37:40', 'Asignacion finalizada: 54', 10101),
(1615, '2022-07-12 14:37:41', 'Visualizo el listado de asignaciones', 10101),
(1616, '2022-07-12 14:37:43', 'Visualizo el listado de asignaciones', 10081),
(1617, '2022-07-12 14:37:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1618, '2022-07-12 14:37:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1619, '2022-07-12 14:38:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1620, '2022-07-12 14:38:25', 'Actualizo la siguiente solicitud: verificación de punto de red', 10101),
(1621, '2022-07-12 14:38:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1622, '2022-07-12 14:38:45', 'Visualizo el listado de asignaciones', 10101),
(1623, '2022-07-12 14:38:50', 'Visualizo el listado de solicitud', 10101),
(1624, '2022-07-12 14:38:55', 'Visualizo el listado de solicitud', 10101),
(1625, '2022-07-12 14:38:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1626, '2022-07-12 14:39:03', 'Visualizo el listado de solicitud', 10101),
(1627, '2022-07-12 14:39:06', 'Visualizo el listado de solicitud', 10101),
(1628, '2022-07-12 14:39:09', 'Visualizo el listado de solicitud', 10101),
(1629, '2022-07-12 14:39:11', 'Visualizo el listado de solicitud', 10101),
(1630, '2022-07-12 14:39:22', 'Creacion de un nuevo paso: Desbloqueo de clave de S.O', 10081),
(1631, '2022-07-12 14:39:26', 'Visualizo el listado de asignaciones', 10081),
(1632, '2022-07-12 14:39:45', 'Creacion de nuevo paso procesado: Se cambio la clave al usuario', 10081),
(1633, '2022-07-12 14:39:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1634, '2022-07-12 14:39:50', 'Asignacion finalizada: 139', 10081),
(1635, '2022-07-12 14:39:52', 'Visualizo el listado de asignaciones', 10081),
(1636, '2022-07-12 14:39:56', 'Visualizo el listado de solicitud', 10081),
(1637, '2022-07-12 14:40:08', 'Visualizo el listado de solicitud', 10081),
(1638, '2022-07-12 14:40:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1639, '2022-07-12 14:40:16', 'Visualizo el listado de solicitud', 1),
(1640, '2022-07-12 14:40:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1641, '2022-07-12 14:41:00', 'Visualizo el listado de asignaciones', 1),
(1642, '2022-07-12 14:41:10', 'Visualizo el listado de solicitud', 1),
(1643, '2022-07-12 14:41:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1644, '2022-07-12 14:41:21', 'Visualizo el listado de solicitud', 1),
(1645, '2022-07-12 14:41:29', 'Visualizo el listado de solicitud', 1),
(1646, '2022-07-12 14:41:32', 'Visualizo el listado de solicitud', 1),
(1647, '2022-07-12 14:41:35', 'Visualizo el listado de solicitud', 1),
(1648, '2022-07-12 14:41:40', 'Visualizo el listado de solicitud', 1),
(1649, '2022-07-12 14:41:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1650, '2022-07-12 14:42:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1651, '2022-07-12 14:42:29', 'Visualizo el listado de solicitud', 1),
(1652, '2022-07-12 14:42:36', 'Visualizo el listado de asignaciones', 1),
(1653, '2022-07-12 14:42:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1654, '2022-07-12 14:45:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1655, '2022-07-12 14:50:15', 'Visualizo el listado de solicitud', 1),
(1656, '2022-07-12 14:50:24', 'Visualizo el listado de solicitud', 1),
(1657, '2022-07-12 14:50:27', 'Visualizo el listado de solicitud', 1),
(1658, '2022-07-12 14:51:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1659, '2022-07-13 08:38:32', 'Inicio de Sesion', 1),
(1660, '2022-07-13 08:38:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1661, '2022-07-13 08:41:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1662, '2022-07-13 08:41:58', 'Inicio de Sesion', 10101),
(1663, '2022-07-13 08:41:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1664, '2022-07-13 08:45:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1665, '2022-07-13 08:47:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1666, '2022-07-13 08:55:25', 'Visualizo el listado de direcciones', 10101),
(1667, '2022-07-13 08:55:28', 'Visualizo el listado de direcciones', 10101),
(1668, '2022-07-13 09:38:51', 'Inicio de Sesion', 10081),
(1669, '2022-07-13 09:40:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1670, '2022-07-13 09:41:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1671, '2022-07-13 09:44:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1672, '2022-07-13 09:44:35', 'Creacion de nueva solicitud: Se me desconfiguro la fecha y hora', 10081),
(1673, '2022-07-13 09:44:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1674, '2022-07-13 09:46:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1675, '2022-07-13 09:46:21', 'Elimino el siguiente solicitud: Se me desconfiguro la fecha y hora', 10081),
(1676, '2022-07-13 09:46:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1677, '2022-07-13 09:46:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1678, '2022-07-13 09:47:17', 'Creacion de nueva solicitud: Se me desconfiguro la fecha y hora', 10081),
(1679, '2022-07-13 09:47:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1680, '2022-07-13 09:48:11', 'Actualizo la siguiente solicitud: Se me desconfiguro la fecha y hora', 10081),
(1681, '2022-07-13 09:48:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1682, '2022-07-13 09:48:18', 'Visualizo el listado de solicitud', 10081),
(1683, '2022-07-13 09:49:12', 'Visualizo el listado de solicitud', 1),
(1684, '2022-07-13 09:51:14', 'Creacion de nueva asignacion: Configurar la fecha y hora', 10081),
(1685, '2022-07-13 09:51:14', 'Visualizo el listado de solicitud', 10081),
(1686, '2022-07-13 09:51:20', 'Visualizo el listado de asignaciones', 10081),
(1687, '2022-07-13 09:51:25', 'Visualizo el listado de asignaciones', 10081),
(1688, '2022-07-13 09:51:51', 'Creacion de nuevo paso procesado: Se ingreso la contraseña para poder confirgurar la fecha y hora de la pc', 10081),
(1689, '2022-07-13 09:51:55', 'Creacion de nuevo paso procesado: ', 10081),
(1690, '2022-07-13 09:52:05', 'Asignacion finalizada: 143', 10081),
(1691, '2022-07-13 09:52:07', 'Visualizo el listado de asignaciones', 10081),
(1692, '2022-07-13 09:52:11', 'Visualizo el listado de asignaciones', 10081),
(1693, '2022-07-13 09:52:22', 'Visualizo el listado de solicitud', 10081),
(1694, '2022-07-13 09:52:40', 'Visualizo el listado de asignaciones', 10081),
(1695, '2022-07-13 09:52:46', 'Visualizo el listado de asignaciones', 10081),
(1696, '2022-07-13 09:52:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1697, '2022-07-13 09:52:58', 'Visualizo el listado de solicitud', 10081),
(1698, '2022-07-13 09:53:03', 'Visualizo el listado de solicitud', 10081),
(1699, '2022-07-13 09:53:54', 'Visualizo el listado de asignaciones', 10081),
(1700, '2022-07-13 09:54:07', 'Visualizo el listado de asignaciones', 10081),
(1701, '2022-07-13 09:54:16', 'Visualizo el listado de asignaciones', 10081),
(1702, '2022-07-13 09:54:21', 'Visualizo el listado de solicitud', 10081),
(1703, '2022-07-13 09:54:41', 'Visualizo el listado de asignaciones', 10081),
(1704, '2022-07-13 09:55:06', 'Visualizo el listado de solicitud', 10081),
(1705, '2022-07-13 09:55:12', 'Visualizo el listado de solicitud', 10081),
(1706, '2022-07-13 09:55:18', 'Visualizo el listado de solicitud', 10081),
(1707, '2022-07-13 09:55:21', 'Visualizo el listado de solicitud', 10081),
(1708, '2022-07-13 09:55:26', 'Visualizo el listado de solicitud', 10081),
(1709, '2022-07-13 09:55:32', 'Visualizo el listado de solicitud', 10081),
(1710, '2022-07-13 09:55:44', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10081),
(1711, '2022-07-13 09:55:57', 'Visualizo el listado de asignaciones', 10081),
(1712, '2022-07-13 09:56:07', 'Visualizo el listado de asignaciones', 10081),
(1713, '2022-07-13 09:56:20', 'Visualizo el listado de asignaciones', 1),
(1714, '2022-07-13 09:56:39', 'Visualizo el listado de asignaciones', 1),
(1715, '2022-07-13 09:57:28', 'Visualizo el listado de asignaciones', 1),
(1716, '2022-07-13 09:57:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1717, '2022-07-13 09:57:38', 'Visualizo el listado de solicitud', 1),
(1718, '2022-07-13 09:57:52', 'Visualizo el listado de asignaciones', 10081),
(1719, '2022-07-13 09:58:02', 'Visualizo el listado de solicitud', 10081),
(1720, '2022-07-13 09:58:41', 'Visualizo el listado de solicitud', 10081),
(1721, '2022-07-13 10:00:37', 'Creacion de nueva solicitud: Se me desconfiguro la fecha y hora', 10081),
(1722, '2022-07-13 10:00:39', 'Creacion de nueva solicitud: apoyo a los tecnicos de tecnosystem', 10101),
(1723, '2022-07-13 10:00:45', 'Visualizo el listado de solicitud', 10101),
(1724, '2022-07-13 10:00:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1725, '2022-07-13 10:01:14', 'Actualizo la siguiente solicitud: Se me desconfiguro la fecha y hora', 10081),
(1726, '2022-07-13 10:01:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1727, '2022-07-13 10:01:23', 'Visualizo el listado de solicitud', 10081),
(1728, '2022-07-13 10:01:49', 'Actualizo la siguiente solicitud: apoyo a los tecnicos de tecnosystem', 10101),
(1729, '2022-07-13 10:01:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1730, '2022-07-13 10:01:52', 'Creacion de nueva asignacion: Configurar la fecha y hora', 10081),
(1731, '2022-07-13 10:01:53', 'Visualizo el listado de solicitud', 10081),
(1732, '2022-07-13 10:01:56', 'Visualizo el listado de solicitud', 10101),
(1733, '2022-07-13 10:02:18', 'Creacion de nueva asignacion: Configurar fecha y hora', 10081),
(1734, '2022-07-13 10:02:19', 'Visualizo el listado de solicitud', 10081),
(1735, '2022-07-13 10:02:27', 'Visualizo el listado de solicitud', 10081),
(1736, '2022-07-13 10:02:35', 'Visualizo el listado de asignaciones', 10081),
(1737, '2022-07-13 10:02:41', 'Visualizo el listado de asignaciones', 10081),
(1738, '2022-07-13 10:03:14', 'Creacion de nuevo paso procesado: Se ingreso la contraseña para configurar la fecha y hora de la pc', 10081);
INSERT INTO `bitacora` (`bitacora_id`, `bitacora_fecha`, `bitacora_accion`, `usuario_id`) VALUES
(1739, '2022-07-13 10:03:24', 'Creacion de nuevo paso procesado: ', 10081),
(1740, '2022-07-13 10:03:35', 'Asignacion finalizada: 146', 10081),
(1741, '2022-07-13 10:03:37', 'Visualizo el listado de asignaciones', 10081),
(1742, '2022-07-13 10:03:44', 'Visualizo el listado de solicitud', 10081),
(1743, '2022-07-13 10:04:00', 'Visualizo el listado de solicitud', 10081),
(1744, '2022-07-13 10:04:03', 'Creacion de nueva asignacion: apoyo a tecnosystem con el aleado utp', 10101),
(1745, '2022-07-13 10:04:04', 'Visualizo el listado de solicitud', 10101),
(1746, '2022-07-13 10:04:09', 'Visualizo el listado de asignaciones', 10101),
(1747, '2022-07-13 10:04:13', 'Visualizo el listado de asignaciones', 10101),
(1748, '2022-07-13 10:04:28', 'Creacion de nuevo paso procesado: Apoyo a operativo tecnicos', 10101),
(1749, '2022-07-13 10:04:35', 'Asignacion finalizada: 147', 10101),
(1750, '2022-07-13 10:04:37', 'Visualizo el listado de asignaciones', 10101),
(1751, '2022-07-13 10:04:41', 'Visualizo el listado de solicitud', 10101),
(1752, '2022-07-13 10:05:02', 'Visualizo el listado de solicitud', 10101),
(1753, '2022-07-13 10:06:48', 'Creacion de nueva solicitud: revisión de equipos', 10101),
(1754, '2022-07-13 10:06:58', 'Visualizo el listado de solicitud', 10101),
(1755, '2022-07-13 10:07:30', 'Actualizo la siguiente solicitud: revisión de equipos', 10101),
(1756, '2022-07-13 10:07:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1757, '2022-07-13 10:07:36', 'Visualizo el listado de asignaciones', 10101),
(1758, '2022-07-13 10:07:42', 'Visualizo el listado de solicitud', 10101),
(1759, '2022-07-13 10:08:18', 'Creacion de nueva asignacion: apoyo de revisión de los BIOS', 10101),
(1760, '2022-07-13 10:08:19', 'Visualizo el listado de solicitud', 10101),
(1761, '2022-07-13 10:08:25', 'Visualizo el listado de solicitud', 10101),
(1762, '2022-07-13 10:08:53', 'Actualizo la siguiente solicitud: revisión de equipos', 10101),
(1763, '2022-07-13 10:08:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1764, '2022-07-13 10:08:57', 'Visualizo el listado de asignaciones', 10101),
(1765, '2022-07-13 10:09:04', 'Visualizo el listado de solicitud', 10101),
(1766, '2022-07-13 10:09:12', 'Visualizo el listado de asignaciones', 10101),
(1767, '2022-07-13 10:09:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1768, '2022-07-13 10:09:22', 'Visualizo el listado de asignaciones', 10101),
(1769, '2022-07-13 10:09:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1770, '2022-07-13 10:09:35', 'Visualizo el listado de solicitud', 10101),
(1771, '2022-07-13 10:09:55', 'Actualizo la siguiente solicitud: revisión de equipos', 10101),
(1772, '2022-07-13 10:09:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1773, '2022-07-13 10:10:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1774, '2022-07-13 10:10:07', 'Visualizo el listado de solicitud', 10101),
(1775, '2022-07-13 10:10:21', 'Visualizo el listado de asignaciones', 10101),
(1776, '2022-07-13 10:10:29', 'Visualizo el listado de solicitud', 10101),
(1777, '2022-07-13 10:10:59', 'Actualizo la siguiente solicitud: revisión de equipos', 10101),
(1778, '2022-07-13 10:11:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1779, '2022-07-13 10:11:06', 'Visualizo el listado de solicitud', 10101),
(1780, '2022-07-13 10:11:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1781, '2022-07-13 10:11:20', 'Visualizo el listado de solicitud', 10101),
(1782, '2022-07-13 10:12:19', 'Creacion de nueva asignacion: apoyo de revisión de BIOS', 10101),
(1783, '2022-07-13 10:12:19', 'Visualizo el listado de solicitud', 10101),
(1784, '2022-07-13 10:12:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1785, '2022-07-13 10:12:28', 'Visualizo el listado de solicitud', 10101),
(1786, '2022-07-13 10:13:17', 'Actualizo la siguiente solicitud: revisión de equipos', 10101),
(1787, '2022-07-13 10:13:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1788, '2022-07-13 10:13:23', 'Visualizo el listado de solicitud', 10101),
(1789, '2022-07-13 10:13:29', 'Visualizo el listado de asignaciones', 10101),
(1790, '2022-07-13 10:14:04', 'Visualizo el listado de solicitud', 10101),
(1791, '2022-07-13 10:14:43', 'Actualizo la siguiente solicitud: revisión de equipos', 10101),
(1792, '2022-07-13 10:14:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1793, '2022-07-13 10:15:05', 'Visualizo el listado de solicitud', 1),
(1794, '2022-07-13 10:15:09', 'Visualizo el listado de solicitud', 10101),
(1795, '2022-07-13 10:17:11', 'Visualizo el listado de solicitud', 10101),
(1796, '2022-07-13 10:17:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1797, '2022-07-13 10:17:22', 'Visualizo el listado de solicitud', 10101),
(1798, '2022-07-13 10:17:42', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(1799, '2022-07-13 10:18:04', 'Visualizo el listado de asignaciones', 1),
(1800, '2022-07-13 10:18:07', 'Visualizo el listado de asignaciones', 1),
(1801, '2022-07-13 10:18:24', 'Visualizo el listado de solicitud', 10101),
(1802, '2022-07-13 10:18:27', 'Visualizo el listado de asignaciones', 1),
(1803, '2022-07-13 10:18:30', 'Creacion de nueva solicitud: Respaldo de informacion', 10081),
(1804, '2022-07-13 10:18:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1805, '2022-07-13 10:18:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1806, '2022-07-13 10:18:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(1807, '2022-07-13 10:18:53', 'Visualizo el listado de solicitud', 1),
(1808, '2022-07-13 10:19:00', 'Actualizo la siguiente solicitud: Respaldo de informacion', 10081),
(1809, '2022-07-13 10:19:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1810, '2022-07-13 10:19:07', 'Visualizo el listado de solicitud', 10101),
(1811, '2022-07-13 10:19:11', 'Visualizo el listado de solicitud', 10081),
(1812, '2022-07-13 10:19:12', 'Visualizo el listado de asignaciones', 1),
(1813, '2022-07-13 10:19:23', 'Visualizo el listado de solicitud', 1),
(1814, '2022-07-13 10:19:31', 'Creacion de nueva asignacion: Hacer respaldo de informacion', 10081),
(1815, '2022-07-13 10:19:31', 'Visualizo el listado de solicitud', 10081),
(1816, '2022-07-13 10:19:41', 'Visualizo el listado de asignaciones', 10081),
(1817, '2022-07-13 10:19:42', 'Creacion de nueva asignacion: revisión de BIOS', 10101),
(1818, '2022-07-13 10:19:42', 'Visualizo el listado de solicitud', 10101),
(1819, '2022-07-13 10:19:48', 'Visualizo el listado de asignaciones', 10101),
(1820, '2022-07-13 10:19:55', 'Creacion de nuevo paso procesado: ', 10101),
(1821, '2022-07-13 10:20:00', 'Asignacion finalizada: 154', 10101),
(1822, '2022-07-13 10:20:02', 'Visualizo el listado de asignaciones', 10101),
(1823, '2022-07-13 10:20:03', 'Creacion de nuevo paso procesado: Se respaldo la info de un disco duro a un pendrive', 10081),
(1824, '2022-07-13 10:20:09', 'Asignacion finalizada: 156', 10081),
(1825, '2022-07-13 10:20:11', 'Visualizo el listado de asignaciones', 10081),
(1826, '2022-07-13 10:20:18', 'Visualizo el listado de solicitud', 10081),
(1827, '2022-07-13 10:20:19', 'Visualizo el listado de solicitud', 10101),
(1828, '2022-07-13 10:20:55', 'Visualizo el listado de solicitud', 10101),
(1829, '2022-07-13 10:22:34', 'Creacion de nueva solicitud: apoyo de instalación de impresora', 10101),
(1830, '2022-07-13 10:22:41', 'Visualizo el listado de solicitud', 10101),
(1831, '2022-07-13 10:23:12', 'Actualizo la siguiente solicitud: apoyo de instalación de impresora', 10101),
(1832, '2022-07-13 10:23:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1833, '2022-07-13 10:23:16', 'Visualizo el listado de solicitud', 10101),
(1834, '2022-07-13 10:23:37', 'Visualizo el listado de asignaciones', 10101),
(1835, '2022-07-13 10:23:42', 'Visualizo el listado de solicitud', 10101),
(1836, '2022-07-13 10:24:16', 'Visualizo el listado de solicitud', 10101),
(1837, '2022-07-13 10:24:32', 'Creacion de nueva asignacion: acceso a internet', 10101),
(1838, '2022-07-13 10:24:32', 'Visualizo el listado de solicitud', 10101),
(1839, '2022-07-13 10:24:59', 'Creacion de nueva asignacion: instalación de impresora', 10101),
(1840, '2022-07-13 10:24:59', 'Visualizo el listado de solicitud', 10101),
(1841, '2022-07-13 10:25:05', 'Visualizo el listado de asignaciones', 10101),
(1842, '2022-07-13 10:25:13', 'Creacion de nuevo paso procesado: ', 10101),
(1843, '2022-07-13 10:25:19', 'Asignacion finalizada: 160', 10101),
(1844, '2022-07-13 10:25:21', 'Visualizo el listado de asignaciones', 10101),
(1845, '2022-07-13 10:25:27', 'Creacion de nuevo paso procesado: ', 10101),
(1846, '2022-07-13 10:25:32', 'Asignacion finalizada: 159', 10101),
(1847, '2022-07-13 10:25:34', 'Visualizo el listado de asignaciones', 10101),
(1848, '2022-07-13 10:25:40', 'Visualizo el listado de solicitud', 10101),
(1849, '2022-07-13 10:25:45', 'Visualizo el listado de solicitud', 10101),
(1850, '2022-07-13 10:25:50', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(1851, '2022-07-13 10:26:05', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(1852, '2022-07-13 10:26:21', 'Visualizo el listado de solicitud', 10101),
(1853, '2022-07-13 10:26:26', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(1854, '2022-07-13 10:26:38', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(1855, '2022-07-13 10:27:53', 'Creacion de nueva solicitud: reparación de fuente de poder', 10101),
(1856, '2022-07-13 10:28:13', 'Visualizo el listado de solicitud', 10101),
(1857, '2022-07-13 10:28:39', 'Actualizo la siguiente solicitud: reparación de fuente de poder', 10101),
(1858, '2022-07-13 10:28:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1859, '2022-07-13 10:28:45', 'Visualizo el listado de solicitud', 10101),
(1860, '2022-07-13 10:29:14', 'Creacion de nueva asignacion: reparación de fuente de poder', 10101),
(1861, '2022-07-13 10:29:14', 'Visualizo el listado de solicitud', 10101),
(1862, '2022-07-13 10:29:19', 'Visualizo el listado de asignaciones', 10101),
(1863, '2022-07-13 10:30:08', 'Creacion de nuevo paso procesado: se reparo fuente de poder tenia condesadores abordados', 10101),
(1864, '2022-07-13 10:30:15', 'Asignacion finalizada: 162', 10101),
(1865, '2022-07-13 10:30:17', 'Visualizo el listado de asignaciones', 10101),
(1866, '2022-07-13 10:30:23', 'Visualizo el listado de solicitud', 10101),
(1867, '2022-07-13 10:30:39', 'Visualizo el listado de solicitud', 10101),
(1868, '2022-07-13 10:32:52', 'Creacion de nueva solicitud: mantenimiento de hardware', 10101),
(1869, '2022-07-13 10:33:00', 'Visualizo el listado de solicitud', 10101),
(1870, '2022-07-13 10:33:30', 'Actualizo la siguiente solicitud: mantenimiento de hardware', 10101),
(1871, '2022-07-13 10:33:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1872, '2022-07-13 10:33:37', 'Visualizo el listado de solicitud', 10101),
(1873, '2022-07-13 10:34:09', 'Visualizo el listado de solicitud', 10081),
(1874, '2022-07-13 10:34:34', 'Creacion de nueva asignacion: dianostico de equipo de secretaria', 10101),
(1875, '2022-07-13 10:34:34', 'Visualizo el listado de solicitud', 10101),
(1876, '2022-07-13 10:34:41', 'Visualizo el listado de asignaciones', 10101),
(1877, '2022-07-13 10:36:44', 'Creacion de nuevo paso procesado: Revisión de componentes electrónico', 10101),
(1878, '2022-07-13 10:36:51', 'Asignacion finalizada: 164', 10101),
(1879, '2022-07-13 10:36:52', 'Visualizo el listado de asignaciones', 10101),
(1880, '2022-07-13 10:36:56', 'Visualizo el listado de asignaciones', 10101),
(1881, '2022-07-13 10:37:09', 'Visualizo el listado de solicitud', 10101),
(1882, '2022-07-13 10:37:18', 'Creacion de nueva solicitud: Apoyo a Tecno Sistem', 10081),
(1883, '2022-07-13 10:37:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1884, '2022-07-13 10:37:39', 'Visualizo el listado de solicitud', 10101),
(1885, '2022-07-13 10:38:24', 'Actualizo la siguiente solicitud: Apoyo a Tecno Sistem', 10081),
(1886, '2022-07-13 10:38:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1887, '2022-07-13 10:39:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(1888, '2022-07-13 10:39:11', 'Visualizo el listado de solicitud', 10081),
(1889, '2022-07-13 10:40:09', 'Creacion de nueva asignacion: Apoyo a tecnoSistem', 10081),
(1890, '2022-07-13 10:40:10', 'Visualizo el listado de solicitud', 10081),
(1891, '2022-07-13 10:41:01', 'Visualizo el listado de actividades', 10101),
(1892, '2022-07-13 10:41:29', 'Hizo la siguiente busqueda: apoyo de inventario en el listado de actividades', 10101),
(1893, '2022-07-13 10:42:39', 'Inicio de Sesion', 10083),
(1894, '2022-07-13 10:42:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1895, '2022-07-13 10:43:24', 'Creacion de nueva actividad: apoyo de inventario', 10101),
(1896, '2022-07-13 10:44:24', 'Creacion de un nuevo paso: descripción apoyo de inventario', 10101),
(1897, '2022-07-13 10:46:09', 'Creacion de nueva solicitud: Mantenimiento de Hardware', 10083),
(1898, '2022-07-13 10:46:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1899, '2022-07-13 10:46:40', 'Actualizo la siguiente solicitud: Mantenimiento de Hardware', 10083),
(1900, '2022-07-13 10:46:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1901, '2022-07-13 10:46:46', 'Visualizo el listado de solicitud', 10083),
(1902, '2022-07-13 10:46:51', 'Visualizo el listado de solicitud', 10083),
(1903, '2022-07-13 10:47:18', 'Creacion de nueva asignacion: Apoyo al mantenimiento de Hardware', 10083),
(1904, '2022-07-13 10:47:19', 'Visualizo el listado de solicitud', 10083),
(1905, '2022-07-13 10:47:22', 'Visualizo el listado de asignaciones', 10083),
(1906, '2022-07-13 10:47:26', 'Visualizo el listado de asignaciones', 10083),
(1907, '2022-07-13 10:48:00', 'Creacion de nuevo paso procesado: Apoyar al mantenimiento de Hardware se utilizo una sopladora', 10083),
(1908, '2022-07-13 10:48:06', 'Asignacion finalizada: 170', 10083),
(1909, '2022-07-13 10:48:07', 'Visualizo el listado de asignaciones', 10083),
(1910, '2022-07-13 10:48:14', 'Visualizo el listado de solicitud', 10083),
(1911, '2022-07-13 10:48:17', 'Visualizo el listado de solicitud', 10083),
(1912, '2022-07-13 10:48:18', 'Visualizo el listado de solicitud', 10083),
(1913, '2022-07-13 10:48:33', 'Visualizo el listado de solicitud', 10083),
(1914, '2022-07-13 10:51:09', 'Creacion de nueva solicitud: Inventario Apoyo', 10083),
(1915, '2022-07-13 10:51:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1916, '2022-07-13 10:51:54', 'Actualizo la siguiente solicitud: Inventario Apoyo', 10083),
(1917, '2022-07-13 10:52:00', 'Actualizo la siguiente solicitud: Inventario Apoyo', 10083),
(1918, '2022-07-13 10:52:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1919, '2022-07-13 10:52:02', 'Creacion de nueva asignacion: Apoyo a Tecno sistem', 10081),
(1920, '2022-07-13 10:52:02', 'Visualizo el listado de solicitud', 10081),
(1921, '2022-07-13 10:52:03', 'Visualizo el listado de solicitud', 10083),
(1922, '2022-07-13 10:52:14', 'Visualizo el listado de asignaciones', 10081),
(1923, '2022-07-13 10:52:21', 'Creacion de nueva asignacion: Apoyo a inventario', 10083),
(1924, '2022-07-13 10:52:23', 'Creacion de nueva solicitud: apoyo de inventario', 10101),
(1925, '2022-07-13 10:52:25', 'Visualizo el listado de solicitud', 10083),
(1926, '2022-07-13 10:52:28', 'Visualizo el listado de asignaciones', 10083),
(1927, '2022-07-13 10:52:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1928, '2022-07-13 10:52:32', 'Visualizo el listado de asignaciones', 10083),
(1929, '2022-07-13 10:53:00', 'Creacion de nuevo paso procesado: Apoyo al mantenimiento de aerea de inventario', 10083),
(1930, '2022-07-13 10:53:05', 'Actualizo la siguiente solicitud: apoyo de inventario', 10101),
(1931, '2022-07-13 10:53:06', 'Asignacion finalizada: 173', 10083),
(1932, '2022-07-13 10:53:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1933, '2022-07-13 10:53:07', 'Visualizo el listado de asignaciones', 10083),
(1934, '2022-07-13 10:53:10', 'Visualizo el listado de solicitud', 10083),
(1935, '2022-07-13 10:53:19', 'Visualizo el listado de asignaciones', 10101),
(1936, '2022-07-13 10:53:24', 'Visualizo el listado de solicitud', 10083),
(1937, '2022-07-13 10:53:29', 'Visualizo el listado de solicitud', 10101),
(1938, '2022-07-13 10:53:36', 'Visualizo el listado de asignaciones', 10101),
(1939, '2022-07-13 10:54:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1940, '2022-07-13 10:54:06', 'Creacion de un nuevo paso: Reconectar cable de red', 10081),
(1941, '2022-07-13 10:54:10', 'Visualizo el listado de solicitud', 10101),
(1942, '2022-07-13 10:54:15', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(1943, '2022-07-13 10:54:19', 'Visualizo el listado de asignaciones', 10081),
(1944, '2022-07-13 10:54:30', 'Hizo la siguiente busqueda: evaluacion en el listado de solicitud', 10101),
(1945, '2022-07-13 10:54:33', 'Visualizo el listado de solicitud', 10101),
(1946, '2022-07-13 10:54:38', 'Creacion de nueva solicitud: Revision del equipo', 10083),
(1947, '2022-07-13 10:54:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1948, '2022-07-13 10:55:01', 'Actualizo la siguiente solicitud: Revision del equipo', 10083),
(1949, '2022-07-13 10:55:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1950, '2022-07-13 10:55:04', 'Visualizo el listado de solicitud', 10083),
(1951, '2022-07-13 10:55:15', 'Creacion de nueva asignacion: apoyo e inventario  con yuber lara', 10101),
(1952, '2022-07-13 10:55:15', 'Visualizo el listado de solicitud', 10101),
(1953, '2022-07-13 10:55:25', 'Creacion de nueva asignacion: Revision del equipo', 10083),
(1954, '2022-07-13 10:55:25', 'Visualizo el listado de solicitud', 10083),
(1955, '2022-07-13 10:55:29', 'Visualizo el listado de asignaciones', 10083),
(1956, '2022-07-13 10:55:30', 'Creacion de nuevo paso procesado: Colocar 3 cables de un FxB para darle conexión a 3 departamentos', 10081),
(1957, '2022-07-13 10:55:39', 'Visualizo el listado de solicitud', 10101),
(1958, '2022-07-13 10:55:40', 'Asignacion finalizada: 167', 10081),
(1959, '2022-07-13 10:55:46', 'Visualizo el listado de asignaciones', 10083),
(1960, '2022-07-13 10:55:49', 'Visualizo el listado de asignaciones', 10083),
(1961, '2022-07-13 10:55:51', 'Visualizo el listado de solicitud', 10101),
(1962, '2022-07-13 10:56:06', 'Visualizo el listado de solicitud', 10101),
(1963, '2022-07-13 10:56:07', 'Visualizo el listado de asignaciones', 10081),
(1964, '2022-07-13 10:56:42', 'Creacion de nuevo paso procesado: Colocar 3 cables de FxB para darle conexión a 3 dptos', 10081),
(1965, '2022-07-13 10:56:48', 'Asignacion finalizada: 168', 10081),
(1966, '2022-07-13 10:56:50', 'Visualizo el listado de asignaciones', 10081),
(1967, '2022-07-13 10:56:53', 'Visualizo el listado de solicitud', 10081),
(1968, '2022-07-13 10:57:00', 'Creacion de nuevo paso procesado: Revision de equipos tuvo un problema en la fuente de poder y se le hizo un cambio de fuente de poder', 10083),
(1969, '2022-07-13 10:57:04', 'Asignacion finalizada: 177', 10083),
(1970, '2022-07-13 10:57:06', 'Visualizo el listado de asignaciones', 10083),
(1971, '2022-07-13 10:57:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1972, '2022-07-13 10:57:11', 'Visualizo el listado de solicitud', 10083),
(1973, '2022-07-13 10:57:14', 'Visualizo el listado de solicitud', 10083),
(1974, '2022-07-13 10:57:16', 'Visualizo el listado de solicitud', 10083),
(1975, '2022-07-13 10:57:35', 'Creacion de nueva solicitud: recaudación de datos de internet', 10101),
(1976, '2022-07-13 10:57:45', 'Visualizo el listado de solicitud', 10101),
(1977, '2022-07-13 10:57:49', 'Visualizo el listado de solicitud', 10101),
(1978, '2022-07-13 10:57:51', 'Visualizo el listado de solicitud', 10081),
(1979, '2022-07-13 10:58:21', 'Actualizo la siguiente solicitud: recaudación de datos de internet', 10101),
(1980, '2022-07-13 10:58:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1981, '2022-07-13 10:58:27', 'Visualizo el listado de asignaciones', 10101),
(1982, '2022-07-13 10:58:33', 'Creacion de nuevo paso procesado: ', 10101),
(1983, '2022-07-13 10:58:39', 'Asignacion finalizada: 175', 10101),
(1984, '2022-07-13 10:58:40', 'Visualizo el listado de asignaciones', 10101),
(1985, '2022-07-13 10:58:44', 'Visualizo el listado de solicitud', 10101),
(1986, '2022-07-13 10:59:00', 'Visualizo el listado de solicitud', 10101),
(1987, '2022-07-13 10:59:20', 'Visualizo el listado de solicitud', 10083),
(1988, '2022-07-13 11:00:31', 'Creacion de nueva solicitud: instalación de cable de red', 10101),
(1989, '2022-07-13 11:00:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1990, '2022-07-13 11:01:13', 'Creacion de nueva solicitud: Cambio de paquete de Oficce', 10083),
(1991, '2022-07-13 11:01:18', 'Actualizo la siguiente solicitud: instalación de cable de red', 10101),
(1992, '2022-07-13 11:01:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(1993, '2022-07-13 11:01:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1994, '2022-07-13 11:01:26', 'Visualizo el listado de solicitud', 10101),
(1995, '2022-07-13 11:01:41', 'Actualizo la siguiente solicitud: Cambio de paquete de Oficce', 10083),
(1996, '2022-07-13 11:01:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(1997, '2022-07-13 11:01:45', 'Visualizo el listado de solicitud', 10083),
(1998, '2022-07-13 11:02:05', 'Creacion de nueva asignacion: se le agrego la direccion mac al pfsente', 10101),
(1999, '2022-07-13 11:02:06', 'Visualizo el listado de solicitud', 10101),
(2000, '2022-07-13 11:02:13', 'Visualizo el listado de asignaciones', 10101),
(2001, '2022-07-13 11:02:22', 'Creacion de nuevo paso procesado: ', 10101),
(2002, '2022-07-13 11:02:30', 'Asignacion finalizada: 182', 10101),
(2003, '2022-07-13 11:02:32', 'Visualizo el listado de asignaciones', 10101),
(2004, '2022-07-13 11:02:35', 'Visualizo el listado de solicitud', 10101),
(2005, '2022-07-13 11:02:50', 'Visualizo el listado de solicitud', 10101),
(2006, '2022-07-13 11:03:12', 'Creacion de nueva asignacion: Se le desintalo  el equipo de oficce y se le instalo una version actualizada', 10083),
(2007, '2022-07-13 11:03:12', 'Visualizo el listado de solicitud', 10083),
(2008, '2022-07-13 11:03:17', 'Visualizo el listado de asignaciones', 10083),
(2009, '2022-07-13 11:04:05', 'Creacion de nueva solicitud: verificación de cable de red', 10101),
(2010, '2022-07-13 11:04:18', 'Creacion de nuevo paso procesado: Se desisntalo el equipo de oficce por una version actualizada por que la version que tenia ocupaba mucho espacio y estaba un poco lenta', 10083),
(2011, '2022-07-13 11:04:23', 'Asignacion finalizada: 183', 10083),
(2012, '2022-07-13 11:04:26', 'Visualizo el listado de asignaciones', 10083),
(2013, '2022-07-13 11:04:29', 'Visualizo el listado de solicitud', 10083),
(2014, '2022-07-13 11:04:49', 'Visualizo el listado de solicitud', 10083),
(2015, '2022-07-13 11:05:09', 'Creacion de nueva solicitud: verificación de cable de red', 10101),
(2016, '2022-07-13 11:05:28', 'Visualizo el listado de solicitud', 10101),
(2017, '2022-07-13 11:05:50', 'Actualizo la siguiente solicitud: verificación de cable de red', 10101),
(2018, '2022-07-13 11:05:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2019, '2022-07-13 11:06:14', 'Creacion de nueva solicitud: Cambio de fecha y hora', 10083),
(2020, '2022-07-13 11:06:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2021, '2022-07-13 11:06:40', 'Actualizo la siguiente solicitud: Cambio de fecha y hora', 10083),
(2022, '2022-07-13 11:06:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2023, '2022-07-13 11:06:43', 'Actualizo la siguiente solicitud: verificación de cable de red', 10101),
(2024, '2022-07-13 11:06:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2025, '2022-07-13 11:06:44', 'Visualizo el listado de solicitud', 10083),
(2026, '2022-07-13 11:06:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2027, '2022-07-13 11:06:56', 'Visualizo el listado de asignaciones', 10101),
(2028, '2022-07-13 11:07:04', 'Visualizo el listado de solicitud', 10101),
(2029, '2022-07-13 11:07:30', 'Creacion de nueva asignacion: Cambio de hora y fecha  ya que el sistema es un poco viejo y luego el S.O no conecta con red de internet', 10083),
(2030, '2022-07-13 11:07:30', 'Visualizo el listado de solicitud', 10083),
(2031, '2022-07-13 11:07:33', 'Creacion de nueva asignacion: verificación de cable de red', 10101),
(2032, '2022-07-13 11:07:33', 'Visualizo el listado de solicitud', 10101),
(2033, '2022-07-13 11:07:48', 'Visualizo el listado de solicitud', 10083),
(2034, '2022-07-13 11:07:53', 'Creacion de nueva asignacion: verificación de cable de red', 10101),
(2035, '2022-07-13 11:07:53', 'Visualizo el listado de solicitud', 10101),
(2036, '2022-07-13 11:07:54', 'Visualizo el listado de asignaciones', 10083),
(2037, '2022-07-13 11:07:57', 'Visualizo el listado de asignaciones', 10083),
(2038, '2022-07-13 11:08:01', 'Visualizo el listado de asignaciones', 10101),
(2039, '2022-07-13 11:08:08', 'Creacion de nuevo paso procesado: ', 10101),
(2040, '2022-07-13 11:08:14', 'Asignacion finalizada: 189', 10101),
(2041, '2022-07-13 11:08:16', 'Visualizo el listado de asignaciones', 10101),
(2042, '2022-07-13 11:08:23', 'Creacion de nuevo paso procesado: ', 10101),
(2043, '2022-07-13 11:08:26', 'Creacion de nuevo paso procesado: El sistema operativa no conecto con una red de internet', 10083),
(2044, '2022-07-13 11:08:31', 'Asignacion finalizada: 186', 10101),
(2045, '2022-07-13 11:08:32', 'Visualizo el listado de asignaciones', 10101),
(2046, '2022-07-13 11:08:40', 'Visualizo el listado de solicitud', 10101),
(2047, '2022-07-13 11:08:48', 'Creacion de nuevo paso procesado: Tuvimos que prender y apagar y revisar a ver si no tenia otra falla', 10083),
(2048, '2022-07-13 11:08:53', 'Visualizo el listado de solicitud', 10101),
(2049, '2022-07-13 11:08:54', 'Asignacion finalizada: 188', 10083),
(2050, '2022-07-13 11:08:55', 'Visualizo el listado de asignaciones', 10083),
(2051, '2022-07-13 11:08:57', 'Visualizo el listado de solicitud', 10083),
(2052, '2022-07-13 11:09:07', 'Visualizo el listado de solicitud', 10101),
(2053, '2022-07-13 11:09:11', 'Visualizo el listado de solicitud', 10083),
(2054, '2022-07-13 11:09:12', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2055, '2022-07-13 11:09:53', 'Creacion de nueva solicitud: Cambio de fecha y  hora', 10083),
(2056, '2022-07-13 11:09:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2057, '2022-07-13 11:10:20', 'Actualizo la siguiente solicitud: Cambio de fecha y  hora', 10083),
(2058, '2022-07-13 11:10:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2059, '2022-07-13 11:10:23', 'Creacion de nueva solicitud: configuración de fecha y hora', 10101),
(2060, '2022-07-13 11:10:25', 'Visualizo el listado de solicitud', 10083),
(2061, '2022-07-13 11:10:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2062, '2022-07-13 11:10:42', 'Creacion de nueva asignacion: Cambio de hora y fecha', 10083),
(2063, '2022-07-13 11:10:43', 'Visualizo el listado de solicitud', 10083),
(2064, '2022-07-13 11:10:46', 'Visualizo el listado de asignaciones', 10083),
(2065, '2022-07-13 11:10:51', 'Actualizo la siguiente solicitud: configuración de fecha y hora', 10101),
(2066, '2022-07-13 11:10:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2067, '2022-07-13 11:10:55', 'Creacion de nuevo paso procesado: Cambio de fecha', 10083),
(2068, '2022-07-13 11:10:56', 'Visualizo el listado de solicitud', 10101),
(2069, '2022-07-13 11:11:03', 'Creacion de nuevo paso procesado: Cambio de hora', 10083),
(2070, '2022-07-13 11:11:09', 'Asignacion finalizada: 191', 10083),
(2071, '2022-07-13 11:11:11', 'Visualizo el listado de asignaciones', 10083),
(2072, '2022-07-13 11:11:17', 'Visualizo el listado de solicitud', 10083),
(2073, '2022-07-13 11:11:29', 'Visualizo el listado de solicitud', 10083),
(2074, '2022-07-13 11:11:40', 'Creacion de nueva asignacion: actualización de hora y fecha', 10101),
(2075, '2022-07-13 11:11:40', 'Visualizo el listado de solicitud', 10101),
(2076, '2022-07-13 11:11:44', 'Visualizo el listado de asignaciones', 10101),
(2077, '2022-07-13 11:11:51', 'Creacion de nuevo paso procesado: ', 10101),
(2078, '2022-07-13 11:11:55', 'Creacion de nuevo paso procesado: ', 10101),
(2079, '2022-07-13 11:12:00', 'Creacion de nueva solicitud: Actualizar office', 10081),
(2080, '2022-07-13 11:12:00', 'Asignacion finalizada: 193', 10101),
(2081, '2022-07-13 11:12:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2082, '2022-07-13 11:12:02', 'Visualizo el listado de asignaciones', 10101),
(2083, '2022-07-13 11:12:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2084, '2022-07-13 11:12:11', 'Visualizo el listado de solicitud', 10101),
(2085, '2022-07-13 11:12:25', 'Visualizo el listado de solicitud', 10101),
(2086, '2022-07-13 11:12:29', 'Actualizo la siguiente solicitud: Actualizar office', 10081),
(2087, '2022-07-13 11:12:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2088, '2022-07-13 11:12:34', 'Visualizo el listado de solicitud', 10081),
(2089, '2022-07-13 11:12:59', 'Creacion de nueva asignacion: Activar paquete office', 10081),
(2090, '2022-07-13 11:13:00', 'Visualizo el listado de solicitud', 10081),
(2091, '2022-07-13 11:13:06', 'Visualizo el listado de asignaciones', 10081),
(2092, '2022-07-13 11:13:09', 'Creacion de nueva solicitud: Cable de red', 10083),
(2093, '2022-07-13 11:13:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2094, '2022-07-13 11:13:30', 'Creacion de nueva solicitud: elaboración de cable de red', 10101),
(2095, '2022-07-13 11:13:34', 'Actualizo la siguiente solicitud: Cable de red', 10083),
(2096, '2022-07-13 11:13:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2097, '2022-07-13 11:13:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2098, '2022-07-13 11:13:42', 'Visualizo el listado de solicitud', 10083),
(2099, '2022-07-13 11:13:54', 'Actualizo la siguiente solicitud: elaboración de cable de red', 10101),
(2100, '2022-07-13 11:13:54', 'Creacion de nuevo paso procesado: Activamos el paquete office 2016 y le hicimos un cambio a la unid de sistemas', 10081),
(2101, '2022-07-13 11:13:55', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2102, '2022-07-13 11:13:57', 'Creacion de nueva asignacion: Elaboracion de Cable de red', 10083),
(2103, '2022-07-13 11:13:58', 'Visualizo el listado de solicitud', 10101),
(2104, '2022-07-13 11:13:58', 'Visualizo el listado de solicitud', 10083),
(2105, '2022-07-13 11:14:06', 'Asignacion finalizada: 195', 10081),
(2106, '2022-07-13 11:14:08', 'Visualizo el listado de asignaciones', 10081),
(2107, '2022-07-13 11:14:11', 'Visualizo el listado de asignaciones', 10083),
(2108, '2022-07-13 11:14:14', 'Visualizo el listado de solicitud', 10081),
(2109, '2022-07-13 11:14:25', 'Creacion de nueva asignacion: elaboración de cable de red', 10101),
(2110, '2022-07-13 11:14:25', 'Visualizo el listado de solicitud', 10101),
(2111, '2022-07-13 11:14:26', 'Creacion de nuevo paso procesado: Elaboracion de cable de red', 10083),
(2112, '2022-07-13 11:14:29', 'Visualizo el listado de solicitud', 10081),
(2113, '2022-07-13 11:14:30', 'Visualizo el listado de asignaciones', 10101),
(2114, '2022-07-13 11:14:44', 'Creacion de nuevo paso procesado: Luego entregar el cable de red a la direccion de AIT', 10083),
(2115, '2022-07-13 11:14:50', 'Creacion de nuevo paso procesado: elaboración de cable de red', 10101),
(2116, '2022-07-13 11:14:52', 'Asignacion finalizada: 198', 10083),
(2117, '2022-07-13 11:14:54', 'Creacion de nuevo paso procesado: ', 10101),
(2118, '2022-07-13 11:14:54', 'Visualizo el listado de asignaciones', 10083),
(2119, '2022-07-13 11:14:59', 'Visualizo el listado de solicitud', 10083),
(2120, '2022-07-13 11:14:59', 'Asignacion finalizada: 199', 10101),
(2121, '2022-07-13 11:15:01', 'Visualizo el listado de asignaciones', 10101),
(2122, '2022-07-13 11:15:11', 'Visualizo el listado de solicitud', 10101),
(2123, '2022-07-13 11:15:17', 'Visualizo el listado de solicitud', 10083),
(2124, '2022-07-13 11:15:27', 'Visualizo el listado de solicitud', 10101),
(2125, '2022-07-13 11:15:33', 'Hizo la siguiente busqueda: evaluacion en el listado de solicitud', 10101),
(2126, '2022-07-13 11:15:55', 'Hizo la siguiente busqueda: evaluacion en el listado de solicitud', 10101),
(2127, '2022-07-13 11:16:28', 'Creacion de nueva solicitud: Apoyo a respaldar una informacion', 10083),
(2128, '2022-07-13 11:16:33', 'Visualizo el listado de solicitud', 10083),
(2129, '2022-07-13 11:16:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2130, '2022-07-13 11:16:52', 'Actualizo la siguiente solicitud: Apoyo a respaldar una informacion', 10083),
(2131, '2022-07-13 11:16:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2132, '2022-07-13 11:16:56', 'Visualizo el listado de solicitud', 10083),
(2133, '2022-07-13 11:17:16', 'Creacion de nueva asignacion: Respaldar informacion', 10083),
(2134, '2022-07-13 11:17:16', 'Visualizo el listado de solicitud', 10083),
(2135, '2022-07-13 11:17:21', 'Visualizo el listado de asignaciones', 10083),
(2136, '2022-07-13 11:17:43', 'Creacion de nuevo paso procesado: Respaldar una informacion de una lapto', 10083),
(2137, '2022-07-13 11:17:51', 'Asignacion finalizada: 201', 10083),
(2138, '2022-07-13 11:17:52', 'Visualizo el listado de asignaciones', 10083),
(2139, '2022-07-13 11:17:54', 'Visualizo el listado de solicitud', 10083),
(2140, '2022-07-13 11:18:05', 'Visualizo el listado de solicitud', 10083),
(2141, '2022-07-13 11:18:25', 'Creacion de nueva solicitud: instalación de access 2010', 10101),
(2142, '2022-07-13 11:18:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2143, '2022-07-13 11:18:38', 'Creacion de nueva solicitud: Cambio fecha y hora', 10083),
(2144, '2022-07-13 11:18:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2145, '2022-07-13 11:18:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2146, '2022-07-13 11:19:01', 'Actualizo la siguiente solicitud: instalación de access 2010', 10101),
(2147, '2022-07-13 11:19:03', 'Actualizo la siguiente solicitud: Cambio fecha y hora', 10083),
(2148, '2022-07-13 11:19:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2149, '2022-07-13 11:19:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2150, '2022-07-13 11:19:06', 'Visualizo el listado de solicitud', 10101),
(2151, '2022-07-13 11:19:06', 'Visualizo el listado de solicitud', 10083),
(2152, '2022-07-13 11:19:37', 'Creacion de nueva asignacion: Cambiar la fecha  y la hora para tener acceso a la red de internet', 10083),
(2153, '2022-07-13 11:19:38', 'Visualizo el listado de solicitud', 10083),
(2154, '2022-07-13 11:19:41', 'Visualizo el listado de asignaciones', 10083),
(2155, '2022-07-13 11:19:44', 'Visualizo el listado de asignaciones', 10083),
(2156, '2022-07-13 11:19:49', 'Creacion de nueva asignacion: instalación de access 2010', 10101),
(2157, '2022-07-13 11:19:49', 'Visualizo el listado de solicitud', 10101),
(2158, '2022-07-13 11:20:02', 'Visualizo el listado de asignaciones', 10101),
(2159, '2022-07-13 11:20:06', 'Creacion de nuevo paso procesado: Cambiar hora y fecha para obtener internet', 10083),
(2160, '2022-07-13 11:20:11', 'Creacion de nuevo paso procesado: Cambiar la fecha  y la hora para tener acceso a la red de internet', 10083),
(2161, '2022-07-13 11:20:15', 'Asignacion finalizada: 205', 10083),
(2162, '2022-07-13 11:20:16', 'Visualizo el listado de asignaciones', 10083),
(2163, '2022-07-13 11:20:18', 'Visualizo el listado de solicitud', 10083),
(2164, '2022-07-13 11:20:29', 'Visualizo el listado de solicitud', 10083),
(2165, '2022-07-13 11:20:35', 'Creacion de nuevo paso procesado: instalar programa de access 2010', 10101),
(2166, '2022-07-13 11:20:41', 'Asignacion finalizada: 204', 10101),
(2167, '2022-07-13 11:20:43', 'Visualizo el listado de asignaciones', 10101),
(2168, '2022-07-13 11:21:14', 'Visualizo el listado de solicitud', 10101),
(2169, '2022-07-13 11:21:26', 'Creacion de nueva solicitud: Entrega de cable de red', 10083),
(2170, '2022-07-13 11:21:27', 'Visualizo el listado de solicitud', 10101),
(2171, '2022-07-13 11:21:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2172, '2022-07-13 11:21:47', 'Actualizo la siguiente solicitud: Entrega de cable de red', 10083),
(2173, '2022-07-13 11:21:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2174, '2022-07-13 11:21:51', 'Visualizo el listado de solicitud', 10083),
(2175, '2022-07-13 11:22:23', 'Creacion de nueva asignacion: Entrega de cable de 5 Metros para la conexión de Internet', 10083),
(2176, '2022-07-13 11:22:23', 'Visualizo el listado de solicitud', 10083),
(2177, '2022-07-13 11:22:26', 'Visualizo el listado de asignaciones', 10083),
(2178, '2022-07-13 11:22:31', 'Creacion de nuevo paso procesado: Entrega de cable de 5 Metros para la conexión de Internet', 10083),
(2179, '2022-07-13 11:22:37', 'Asignacion finalizada: 207', 10083),
(2180, '2022-07-13 11:22:38', 'Visualizo el listado de asignaciones', 10083),
(2181, '2022-07-13 11:22:41', 'Visualizo el listado de solicitud', 10083),
(2182, '2022-07-13 11:22:53', 'Visualizo el listado de solicitud', 10083),
(2183, '2022-07-13 11:23:32', 'Creacion de nueva solicitud: mantenimiento de hardware', 10101),
(2184, '2022-07-13 11:24:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2185, '2022-07-13 11:25:04', 'Actualizo la siguiente solicitud: mantenimiento de hardware', 10101),
(2186, '2022-07-13 11:28:40', 'Hizo la siguiente busqueda: Sateanz en el listado de direcciones', 10083),
(2187, '2022-07-13 11:28:43', 'Inicio de Sesion', 1),
(2188, '2022-07-13 11:28:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2189, '2022-07-13 11:28:58', 'Visualizo el listado de direcciones', 1),
(2190, '2022-07-13 11:29:51', 'Visualizo el listado de cargos', 1),
(2191, '2022-07-13 11:29:54', 'Visualizo el listado de cargos', 1),
(2192, '2022-07-13 11:30:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2193, '2022-07-13 11:31:15', 'Visualizo el listado de solicitud', 10101),
(2194, '2022-07-13 11:31:23', 'Visualizo el listado de solicitud', 10101),
(2195, '2022-07-13 11:31:39', 'Creacion de nueva solicitud: Apoyo a tecnosystem', 10083),
(2196, '2022-07-13 11:31:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2197, '2022-07-13 11:32:18', 'Creacion de nueva asignacion: mantenimiento de cpu se utilizo una sopladora', 10101),
(2198, '2022-07-13 11:32:19', 'Visualizo el listado de solicitud', 10101),
(2199, '2022-07-13 11:33:02', 'Creacion de nueva asignacion: manteniento de cpu', 10101),
(2200, '2022-07-13 11:33:03', 'Visualizo el listado de solicitud', 10101),
(2201, '2022-07-13 11:34:12', 'Actualizo la siguiente solicitud: Apoyo a tecnosystem', 10083),
(2202, '2022-07-13 11:34:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2203, '2022-07-13 11:34:18', 'Visualizo el listado de solicitud', 10083),
(2204, '2022-07-13 11:34:21', 'Visualizo el listado de solicitud', 10083),
(2205, '2022-07-13 11:34:40', 'Visualizo el listado de solicitud', 10101),
(2206, '2022-07-13 11:34:49', 'Visualizo el listado de asignaciones', 10101),
(2207, '2022-07-13 11:34:52', 'Creacion de nueva asignacion: Se realizo un cable UTP', 10083),
(2208, '2022-07-13 11:34:52', 'Visualizo el listado de solicitud', 10083),
(2209, '2022-07-13 11:34:55', 'Visualizo el listado de asignaciones', 10083),
(2210, '2022-07-13 11:34:56', 'Creacion de nuevo paso procesado: ', 10101),
(2211, '2022-07-13 11:35:02', 'Asignacion finalizada: 209', 10101),
(2212, '2022-07-13 11:35:04', 'Visualizo el listado de asignaciones', 10101),
(2213, '2022-07-13 11:35:07', 'Creacion de nuevo paso procesado: Se realizo un cable UTP', 10083),
(2214, '2022-07-13 11:35:12', 'Visualizo el listado de solicitud', 10101),
(2215, '2022-07-13 11:35:15', 'Asignacion finalizada: 211', 10083),
(2216, '2022-07-13 11:35:16', 'Visualizo el listado de asignaciones', 10101),
(2217, '2022-07-13 11:35:17', 'Visualizo el listado de asignaciones', 10083),
(2218, '2022-07-13 11:35:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2219, '2022-07-13 11:35:21', 'Visualizo el listado de solicitud', 10083),
(2220, '2022-07-13 11:35:22', 'Creacion de nuevo paso procesado: ', 10101),
(2221, '2022-07-13 11:35:27', 'Asignacion finalizada: 179', 10101),
(2222, '2022-07-13 11:35:28', 'Visualizo el listado de asignaciones', 10101),
(2223, '2022-07-13 11:35:32', 'Visualizo el listado de solicitud', 10101),
(2224, '2022-07-13 11:35:35', 'Visualizo el listado de solicitud', 10083),
(2225, '2022-07-13 11:36:00', 'Visualizo el listado de solicitud', 10101),
(2226, '2022-07-13 11:37:21', 'Creacion de nueva solicitud: configuración de hora y fecha', 10101),
(2227, '2022-07-13 11:37:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2228, '2022-07-13 11:38:49', 'Actualizo la siguiente solicitud: configuración de hora y fecha', 10101),
(2229, '2022-07-13 11:38:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2230, '2022-07-13 11:38:54', 'Visualizo el listado de solicitud', 10101),
(2231, '2022-07-13 11:39:25', 'Creacion de nueva asignacion: configuración de fecha y hora', 10101),
(2232, '2022-07-13 11:39:25', 'Visualizo el listado de solicitud', 10101),
(2233, '2022-07-13 11:39:29', 'Visualizo el listado de solicitud', 10101),
(2234, '2022-07-13 11:39:30', 'Creacion de nueva solicitud: Apoyo para instalar', 10083),
(2235, '2022-07-13 11:39:36', 'Visualizo el listado de solicitud', 10101),
(2236, '2022-07-13 11:39:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2237, '2022-07-13 11:39:54', 'Actualizo la siguiente solicitud: Apoyo para instalar', 10083),
(2238, '2022-07-13 11:39:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2239, '2022-07-13 11:39:58', 'Visualizo el listado de solicitud', 10083),
(2240, '2022-07-13 11:40:06', 'Actualizo la siguiente solicitud: configuración de hora y fecha', 10101),
(2241, '2022-07-13 11:40:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2242, '2022-07-13 11:40:11', 'Visualizo el listado de asignaciones', 10101),
(2243, '2022-07-13 11:40:20', 'Visualizo el listado de asignaciones', 10101),
(2244, '2022-07-13 11:40:21', 'Creacion de nueva asignacion: Apoyo para instalar un toner', 10083),
(2245, '2022-07-13 11:40:21', 'Visualizo el listado de solicitud', 10083),
(2246, '2022-07-13 11:40:24', 'Visualizo el listado de asignaciones', 10101),
(2247, '2022-07-13 11:40:27', 'Visualizo el listado de asignaciones', 10083),
(2248, '2022-07-13 11:40:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2249, '2022-07-13 11:40:35', 'Visualizo el listado de solicitud', 10101),
(2250, '2022-07-13 11:40:58', 'Actualizo la siguiente solicitud: configuración de hora y fecha', 10101),
(2251, '2022-07-13 11:41:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2252, '2022-07-13 11:41:01', 'Creacion de nuevo paso procesado: Se le hizo cambio de toner por uno nuevo de la impresora y se comprobo su funcion', 10083),
(2253, '2022-07-13 11:41:02', 'Visualizo el listado de solicitud', 10101),
(2254, '2022-07-13 11:41:06', 'Asignacion finalizada: 215', 10083),
(2255, '2022-07-13 11:41:08', 'Visualizo el listado de asignaciones', 10083),
(2256, '2022-07-13 11:41:10', 'Visualizo el listado de solicitud', 10083),
(2257, '2022-07-13 11:41:22', 'Visualizo el listado de solicitud', 10083),
(2258, '2022-07-13 11:41:32', 'Creacion de nueva asignacion: actualización fecha y hora', 10101),
(2259, '2022-07-13 11:41:33', 'Visualizo el listado de solicitud', 10101),
(2260, '2022-07-13 11:41:37', 'Visualizo el listado de solicitud', 10101),
(2261, '2022-07-13 11:41:42', 'Visualizo el listado de solicitud', 10101),
(2262, '2022-07-13 11:41:49', 'Visualizo el listado de asignaciones', 10101),
(2263, '2022-07-13 11:41:50', 'Visualizo el listado de asignaciones', 10101),
(2264, '2022-07-13 11:41:55', 'Creacion de nuevo paso procesado: ', 10101),
(2265, '2022-07-13 11:41:59', 'Creacion de nuevo paso procesado: ', 10101),
(2266, '2022-07-13 11:42:06', 'Asignacion finalizada: 217', 10101),
(2267, '2022-07-13 11:42:07', 'Visualizo el listado de asignaciones', 10101),
(2268, '2022-07-13 11:42:08', 'Creacion de nueva solicitud: Apoyo para impresora', 10083),
(2269, '2022-07-13 11:42:11', 'Visualizo el listado de solicitud', 10101),
(2270, '2022-07-13 11:42:21', 'Visualizo el listado de solicitud', 10083),
(2271, '2022-07-13 11:42:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2272, '2022-07-13 11:42:28', 'Visualizo el listado de solicitud', 10101),
(2273, '2022-07-13 11:42:40', 'Actualizo la siguiente solicitud: Apoyo para impresora', 10083),
(2274, '2022-07-13 11:42:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2275, '2022-07-13 11:42:43', 'Visualizo el listado de solicitud', 10083),
(2276, '2022-07-13 11:43:00', 'Creacion de nueva asignacion: Apoyo para instalar una impresora', 10083),
(2277, '2022-07-13 11:43:01', 'Visualizo el listado de solicitud', 10083),
(2278, '2022-07-13 11:43:03', 'Visualizo el listado de asignaciones', 10083),
(2279, '2022-07-13 11:43:04', 'Visualizo el listado de asignaciones', 10083),
(2280, '2022-07-13 11:43:30', 'Creacion de nuevo paso procesado: Se le dio conexion inalambrica a una pc', 10083),
(2281, '2022-07-13 11:43:35', 'Asignacion finalizada: 219', 10083),
(2282, '2022-07-13 11:43:37', 'Visualizo el listado de asignaciones', 10083),
(2283, '2022-07-13 11:43:39', 'Visualizo el listado de solicitud', 10083),
(2284, '2022-07-13 11:43:46', 'Creacion de nueva solicitud: apoyo de inventario', 10101),
(2285, '2022-07-13 11:43:51', 'Visualizo el listado de solicitud', 10101),
(2286, '2022-07-13 11:43:51', 'Visualizo el listado de solicitud', 10083),
(2287, '2022-07-13 11:43:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2288, '2022-07-13 11:46:22', 'Actualizo la siguiente solicitud: apoyo de inventario', 10101),
(2289, '2022-07-13 11:46:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2290, '2022-07-13 11:46:28', 'Visualizo el listado de solicitud', 10101),
(2291, '2022-07-13 11:46:58', 'Creacion de nueva asignacion: mantenimiento a la area ait', 10101),
(2292, '2022-07-13 11:46:58', 'Visualizo el listado de solicitud', 10101),
(2293, '2022-07-13 11:47:01', 'Visualizo el listado de asignaciones', 10101),
(2294, '2022-07-13 11:47:15', 'Creacion de nuevo paso procesado: apoyo de mantenimiento', 10101),
(2295, '2022-07-13 11:47:17', 'Creacion de nueva solicitud: revision de fuente de poder', 10083),
(2296, '2022-07-13 11:47:21', 'Asignacion finalizada: 221', 10101),
(2297, '2022-07-13 11:47:22', 'Visualizo el listado de asignaciones', 10101),
(2298, '2022-07-13 11:47:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2299, '2022-07-13 11:47:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2300, '2022-07-13 11:47:36', 'Visualizo el listado de solicitud', 10101),
(2301, '2022-07-13 11:47:42', 'Actualizo la siguiente solicitud: revision de fuente de poder', 10083),
(2302, '2022-07-13 11:47:50', 'Visualizo el listado de solicitud', 10101),
(2303, '2022-07-13 11:50:48', 'Creacion de nueva solicitud: revisión de cpu', 10101),
(2304, '2022-07-13 11:51:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2305, '2022-07-13 11:51:30', 'Actualizo la siguiente solicitud: revisión de cpu', 10101),
(2306, '2022-07-13 11:51:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2307, '2022-07-13 11:51:34', 'Visualizo el listado de solicitud', 10101),
(2308, '2022-07-13 11:52:20', 'Visualizo el listado de solicitud', 10101),
(2309, '2022-07-13 11:52:41', 'Creacion de nueva asignacion: revisión de componentes', 10101),
(2310, '2022-07-13 11:52:42', 'Visualizo el listado de solicitud', 10101),
(2311, '2022-07-13 11:53:02', 'Creacion de nueva asignacion: revisión', 10101),
(2312, '2022-07-13 11:53:03', 'Visualizo el listado de solicitud', 10101),
(2313, '2022-07-13 11:53:10', 'Visualizo el listado de asignaciones', 10101),
(2314, '2022-07-13 11:53:39', 'Creacion de nuevo paso procesado: revisar fuente de poder', 10101),
(2315, '2022-07-13 11:53:47', 'Asignacion finalizada: 223', 10101),
(2316, '2022-07-13 11:53:51', 'Visualizo el listado de asignaciones', 10101),
(2317, '2022-07-13 11:54:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2318, '2022-07-13 11:54:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2319, '2022-07-13 11:54:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083);
INSERT INTO `bitacora` (`bitacora_id`, `bitacora_fecha`, `bitacora_accion`, `usuario_id`) VALUES
(2320, '2022-07-13 11:54:09', 'Visualizo el listado de solicitud', 10083),
(2321, '2022-07-13 11:54:22', 'Visualizo el listado de solicitud', 10083),
(2322, '2022-07-13 11:54:25', 'Visualizo el listado de asignaciones', 10083),
(2323, '2022-07-13 11:54:26', 'Visualizo el listado de asignaciones', 10083),
(2324, '2022-07-13 11:54:33', 'Creacion de nueva solicitud: Instalar impresora por favor', 10081),
(2325, '2022-07-13 11:54:37', 'Creacion de nuevo paso procesado: revisar cpu caracte de urgenecia', 10101),
(2326, '2022-07-13 11:54:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2327, '2022-07-13 11:54:49', 'Asignacion finalizada: 225', 10101),
(2328, '2022-07-13 11:54:51', 'Visualizo el listado de asignaciones', 10101),
(2329, '2022-07-13 11:54:59', 'Actualizo la siguiente solicitud: Instalar impresora por favor', 10081),
(2330, '2022-07-13 11:55:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2331, '2022-07-13 11:55:07', 'Visualizo el listado de solicitud', 10081),
(2332, '2022-07-13 11:55:19', 'Visualizo el listado de solicitud', 10101),
(2333, '2022-07-13 11:55:45', 'Visualizo el listado de solicitud', 10101),
(2334, '2022-07-13 11:55:47', 'Creacion de nueva asignacion: Apoyo al ingeniero Luis Tapizque en instalacion de impresora', 10081),
(2335, '2022-07-13 11:55:47', 'Visualizo el listado de solicitud', 10081),
(2336, '2022-07-13 11:55:51', 'Visualizo el listado de asignaciones', 10081),
(2337, '2022-07-13 11:55:59', 'Visualizo el listado de solicitud', 10101),
(2338, '2022-07-13 11:56:05', 'Visualizo el listado de asignaciones', 10101),
(2339, '2022-07-13 11:56:07', 'Visualizo el listado de asignaciones', 10081),
(2340, '2022-07-13 11:56:59', 'Creacion de nueva solicitud: Desbloqueo de usuario', 10083),
(2341, '2022-07-13 11:57:06', 'Creacion de nuevo paso procesado: Se instalo una impresora y conexiones a red. Se tomaron las MAC de las pc para agregarlas a Pfsence', 10081),
(2342, '2022-07-13 11:57:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2343, '2022-07-13 11:57:14', 'Asignacion finalizada: 227', 10081),
(2344, '2022-07-13 11:57:15', 'Visualizo el listado de asignaciones', 10081),
(2345, '2022-07-13 11:57:30', 'Creacion de nuevo paso procesado: Configurar hora y fecha', 10081),
(2346, '2022-07-13 11:57:37', 'Creacion de nueva solicitud: problema de internet', 10101),
(2347, '2022-07-13 11:57:37', 'Creacion de nuevo paso procesado: ', 10081),
(2348, '2022-07-13 11:57:41', 'Creacion de nuevo paso procesado: ', 10081),
(2349, '2022-07-13 11:57:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2350, '2022-07-13 11:57:45', 'Creacion de nuevo paso procesado: ', 10081),
(2351, '2022-07-13 11:57:50', 'Creacion de nuevo paso procesado: ', 10081),
(2352, '2022-07-13 11:57:56', 'Asignacion finalizada: 140', 10081),
(2353, '2022-07-13 11:57:58', 'Visualizo el listado de asignaciones', 10081),
(2354, '2022-07-13 11:58:02', 'Visualizo el listado de solicitud', 10081),
(2355, '2022-07-13 11:58:15', 'Actualizo la siguiente solicitud: Desbloqueo de usuario', 10083),
(2356, '2022-07-13 11:58:15', 'Visualizo el listado de solicitud', 10083),
(2357, '2022-07-13 11:58:18', 'Visualizo el listado de solicitud', 10081),
(2358, '2022-07-13 11:58:22', 'Visualizo el listado de solicitud', 10081),
(2359, '2022-07-13 11:58:32', 'Creacion de nueva asignacion: Desbloqueo de cuenta', 10083),
(2360, '2022-07-13 11:58:32', 'Visualizo el listado de solicitud', 10083),
(2361, '2022-07-13 11:58:35', 'Visualizo el listado de asignaciones', 10083),
(2362, '2022-07-13 11:59:26', 'Visualizo el listado de direcciones', 10101),
(2363, '2022-07-13 11:59:35', 'Hizo la siguiente busqueda: compras en el listado de direcciones', 10101),
(2364, '2022-07-13 11:59:45', 'Creacion de nuevo paso procesado: Usuario no lograba desbloquear su computadora procedi a indicarle como debe hacer para desbloquear su cuenta', 10083),
(2365, '2022-07-13 11:59:57', 'Asignacion finalizada: 230', 10083),
(2366, '2022-07-13 11:59:59', 'Visualizo el listado de asignaciones', 10083),
(2367, '2022-07-13 12:00:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2368, '2022-07-13 12:00:13', 'Elimino el siguiente solicitud: problema de internet', 10083),
(2369, '2022-07-13 12:00:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2370, '2022-07-13 12:00:16', 'Visualizo el listado de solicitud', 10083),
(2371, '2022-07-13 12:00:23', 'Visualizo el listado de solicitud', 10101),
(2372, '2022-07-13 12:00:29', 'Visualizo el listado de asignaciones', 10101),
(2373, '2022-07-13 12:00:31', 'Visualizo el listado de solicitud', 10083),
(2374, '2022-07-13 12:00:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2375, '2022-07-13 12:00:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2376, '2022-07-13 12:00:40', 'Visualizo el listado de solicitud', 10101),
(2377, '2022-07-13 12:00:45', 'Visualizo el listado de asignaciones', 10101),
(2378, '2022-07-13 12:00:58', 'Visualizo el listado de asignaciones', 10101),
(2379, '2022-07-13 12:01:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2380, '2022-07-13 12:01:22', 'Hizo la siguiente busqueda: problemas en el listado de asignacions', 10101),
(2381, '2022-07-13 12:01:28', 'Visualizo el listado de solicitud', 10101),
(2382, '2022-07-13 12:01:32', 'Visualizo el listado de asignaciones', 10101),
(2383, '2022-07-13 12:02:14', 'Creacion de nueva solicitud: Instalar sistema operativo', 10081),
(2384, '2022-07-13 12:02:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2385, '2022-07-13 12:02:43', 'Actualizo la siguiente solicitud: Instalar sistema operativo', 10081),
(2386, '2022-07-13 12:02:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2387, '2022-07-13 12:02:45', 'Creacion de nueva solicitud: Conectar a laptop a red de wifi', 10083),
(2388, '2022-07-13 12:02:48', 'Visualizo el listado de solicitud', 10081),
(2389, '2022-07-13 12:02:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2390, '2022-07-13 12:03:06', 'Actualizo la siguiente solicitud: Conectar a laptop a red de wifi', 10083),
(2391, '2022-07-13 12:03:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10083),
(2392, '2022-07-13 12:03:09', 'Visualizo el listado de solicitud', 10083),
(2393, '2022-07-13 12:03:26', 'Creacion de nueva asignacion: Instalar sistema operativo LINUX en un disco duro de prueba', 10081),
(2394, '2022-07-13 12:03:26', 'Visualizo el listado de solicitud', 10081),
(2395, '2022-07-13 12:03:30', 'Visualizo el listado de asignaciones', 10081),
(2396, '2022-07-13 12:03:34', 'Creacion de nueva asignacion: Conectar una laptop a una red de wifi', 10083),
(2397, '2022-07-13 12:03:34', 'Visualizo el listado de solicitud', 10083),
(2398, '2022-07-13 12:03:37', 'Visualizo el listado de asignaciones', 10083),
(2399, '2022-07-13 12:03:39', 'Visualizo el listado de asignaciones', 10083),
(2400, '2022-07-13 12:03:55', 'Creacion de nuevo paso procesado: Se instalo un sistema operativo a disco duro de prueba', 10081),
(2401, '2022-07-13 12:04:01', 'Creacion de nuevo paso procesado: Se registro una laptop a la red de wifi de su departamento', 10083),
(2402, '2022-07-13 12:04:03', 'Visualizo el listado de solicitud', 10081),
(2403, '2022-07-13 12:04:06', 'Asignacion finalizada: 234', 10083),
(2404, '2022-07-13 12:04:08', 'Visualizo el listado de asignaciones', 10081),
(2405, '2022-07-13 12:04:08', 'Visualizo el listado de asignaciones', 10083),
(2406, '2022-07-13 12:04:11', 'Visualizo el listado de solicitud', 10083),
(2407, '2022-07-13 12:04:15', 'Asignacion finalizada: 232', 10081),
(2408, '2022-07-13 12:04:17', 'Visualizo el listado de asignaciones', 10081),
(2409, '2022-07-13 12:04:21', 'Visualizo el listado de solicitud', 10081),
(2410, '2022-07-13 12:04:22', 'Visualizo el listado de solicitud', 10083),
(2411, '2022-07-13 12:04:35', 'Visualizo el listado de solicitud', 10081),
(2412, '2022-07-13 12:11:21', 'Inicio de Sesion', 1),
(2413, '2022-07-13 12:11:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2414, '2022-07-13 12:15:13', 'Inicio de Sesion', 10101),
(2415, '2022-07-13 12:15:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2416, '2022-07-13 12:28:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2417, '2022-07-13 12:29:17', 'Creacion de nueva solicitud: problemas con internet', 10101),
(2418, '2022-07-13 12:29:30', 'Visualizo el listado de solicitud', 10101),
(2419, '2022-07-13 12:29:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2420, '2022-07-13 12:30:23', 'Actualizo la siguiente solicitud: problemas con internet', 10101),
(2421, '2022-07-13 12:30:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2422, '2022-07-13 12:31:05', 'Visualizo el listado de solicitud', 10101),
(2423, '2022-07-13 12:32:33', 'Creacion de nueva asignacion: se desactivo y activo conectividad de internet', 10101),
(2424, '2022-07-13 12:32:33', 'Visualizo el listado de solicitud', 10101),
(2425, '2022-07-13 12:32:45', 'Visualizo el listado de asignaciones', 10101),
(2426, '2022-07-13 12:35:12', 'Creacion de nueva solicitud: No tengo internet', 10081),
(2427, '2022-07-13 12:35:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2428, '2022-07-13 12:35:48', 'Creacion de nuevo paso procesado: ', 10101),
(2429, '2022-07-13 12:40:11', 'Asignacion finalizada: 236', 10101),
(2430, '2022-07-13 12:40:13', 'Visualizo el listado de asignaciones', 10101),
(2431, '2022-07-13 12:43:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2432, '2022-07-13 12:44:20', 'Creacion de nueva solicitud: La impresora esta atascada', 10081),
(2433, '2022-07-13 12:44:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2434, '2022-07-13 12:44:31', 'Elimino el siguiente solicitud: No tengo internet', 10081),
(2435, '2022-07-13 12:44:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2436, '2022-07-13 12:45:14', 'Actualizo la siguiente solicitud: La impresora esta atascada', 10081),
(2437, '2022-07-13 12:45:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2438, '2022-07-13 12:45:24', 'Visualizo el listado de solicitud', 10081),
(2439, '2022-07-13 12:45:27', 'Visualizo el listado de solicitud', 10101),
(2440, '2022-07-13 12:45:38', 'Visualizo el listado de asignaciones', 10101),
(2441, '2022-07-13 12:45:42', 'Visualizo el listado de solicitud', 10101),
(2442, '2022-07-13 12:45:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2443, '2022-07-13 12:45:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2444, '2022-07-13 12:46:00', 'Visualizo el listado de solicitud', 10101),
(2445, '2022-07-13 12:46:05', 'Visualizo el listado de asignaciones', 10101),
(2446, '2022-07-13 12:46:15', 'Creacion de nueva asignacion: Remover atasco en la impresora', 10081),
(2447, '2022-07-13 12:46:15', 'Visualizo el listado de solicitud', 10081),
(2448, '2022-07-13 12:46:22', 'Visualizo el listado de solicitud', 10101),
(2449, '2022-07-13 12:46:22', 'Visualizo el listado de solicitud', 10101),
(2450, '2022-07-13 12:46:24', 'Visualizo el listado de asignaciones', 10081),
(2451, '2022-07-13 12:46:34', 'Hizo la siguiente busqueda: evaluacion en el listado de solicitud', 10101),
(2452, '2022-07-13 12:46:38', 'Visualizo el listado de solicitud', 10101),
(2453, '2022-07-13 12:47:28', 'Visualizo el listado de asignaciones', 10101),
(2454, '2022-07-13 12:47:34', 'Creacion de nuevo paso procesado: Se removio papel en la impresora', 10081),
(2455, '2022-07-13 12:47:38', 'Visualizo el listado de solicitud', 10101),
(2456, '2022-07-13 12:47:41', 'Visualizo el listado de solicitud', 10101),
(2457, '2022-07-13 12:47:43', 'Asignacion finalizada: 239', 10081),
(2458, '2022-07-13 12:47:46', 'Hizo la siguiente busqueda: evaluacion en el listado de solicitud', 10101),
(2459, '2022-07-13 12:48:00', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2460, '2022-07-13 12:48:04', 'Visualizo el listado de asignaciones', 10081),
(2461, '2022-07-13 12:48:23', 'Visualizo el listado de solicitud', 10081),
(2462, '2022-07-13 12:48:45', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10081),
(2463, '2022-07-13 12:49:52', 'Visualizo el listado de solicitud', 10081),
(2464, '2022-07-13 12:51:45', 'Visualizo el listado de solicitud', 10101),
(2465, '2022-07-13 12:51:56', 'Visualizo el listado de solicitud', 10101),
(2466, '2022-07-13 12:52:03', 'Visualizo el listado de asignaciones', 10101),
(2467, '2022-07-13 12:52:05', 'Visualizo el listado de solicitud', 10101),
(2468, '2022-07-13 12:54:02', 'Creacion de nueva solicitud: apoyo para conectar impresora', 10101),
(2469, '2022-07-13 12:54:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2470, '2022-07-13 12:55:00', 'Actualizo la siguiente solicitud: apoyo para conectar impresora', 10101),
(2471, '2022-07-13 12:55:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2472, '2022-07-13 12:55:04', 'Visualizo el listado de solicitud', 10101),
(2473, '2022-07-13 12:55:47', 'Creacion de nueva asignacion: conectar equipos nuevo a impresoras', 10101),
(2474, '2022-07-13 12:55:48', 'Visualizo el listado de solicitud', 10101),
(2475, '2022-07-13 12:56:02', 'Visualizo el listado de solicitud', 10101),
(2476, '2022-07-13 12:56:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2477, '2022-07-13 12:56:09', 'Visualizo el listado de asignaciones', 10101),
(2478, '2022-07-13 12:56:14', 'Visualizo el listado de asignaciones', 10101),
(2479, '2022-07-13 12:57:08', 'Creacion de nuevo paso procesado: conectar impresoras', 10101),
(2480, '2022-07-13 12:57:21', 'Asignacion finalizada: 241', 10101),
(2481, '2022-07-13 12:57:22', 'Visualizo el listado de asignaciones', 10101),
(2482, '2022-07-13 12:57:26', 'Visualizo el listado de solicitud', 10101),
(2483, '2022-07-13 12:57:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2484, '2022-07-13 12:57:33', 'Visualizo el listado de solicitud', 10101),
(2485, '2022-07-13 12:57:36', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2486, '2022-07-13 12:57:47', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2487, '2022-07-13 12:58:16', 'Visualizo el listado de solicitud', 10101),
(2488, '2022-07-13 12:58:18', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2489, '2022-07-13 12:58:37', 'Visualizo el listado de solicitud', 10101),
(2490, '2022-07-13 12:58:43', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2491, '2022-07-13 12:58:59', 'Visualizo el listado de solicitud', 10101),
(2492, '2022-07-13 13:02:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2493, '2022-07-13 13:04:24', 'Creacion de nueva solicitud: revision de impresora', 10101),
(2494, '2022-07-13 13:04:47', 'Visualizo el listado de solicitud', 10101),
(2495, '2022-07-13 13:04:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2496, '2022-07-13 13:05:14', 'Actualizo la siguiente solicitud: revision de impresora', 10101),
(2497, '2022-07-13 13:05:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2498, '2022-07-13 13:05:18', 'Visualizo el listado de solicitud', 10101),
(2499, '2022-07-13 13:05:53', 'Creacion de nueva asignacion: revision de impresora', 10101),
(2500, '2022-07-13 13:05:53', 'Visualizo el listado de solicitud', 10101),
(2501, '2022-07-13 13:05:56', 'Visualizo el listado de asignaciones', 10101),
(2502, '2022-07-13 13:07:09', 'Creacion de nuevo paso procesado: Es necesario que revises la impresora', 10101),
(2503, '2022-07-13 13:07:23', 'Asignacion finalizada: 243', 10101),
(2504, '2022-07-13 13:07:24', 'Visualizo el listado de asignaciones', 10101),
(2505, '2022-07-13 13:07:29', 'Visualizo el listado de solicitud', 10101),
(2506, '2022-07-13 13:07:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2507, '2022-07-13 13:07:35', 'Visualizo el listado de solicitud', 10101),
(2508, '2022-07-13 13:07:37', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2509, '2022-07-13 13:08:01', 'Visualizo el listado de solicitud', 10101),
(2510, '2022-07-13 13:08:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2511, '2022-07-13 13:08:40', 'Visualizo el listado de solicitud', 10101),
(2512, '2022-07-13 13:08:42', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2513, '2022-07-13 13:08:53', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 10101),
(2514, '2022-07-13 13:09:00', 'Visualizo el listado de solicitud', 10101),
(2515, '2022-07-13 13:09:05', 'Visualizo el listado de asignaciones', 10101),
(2516, '2022-07-13 13:09:09', 'Visualizo el listado de asignaciones', 10101),
(2517, '2022-07-13 13:09:14', 'Visualizo el listado de asignaciones', 10101),
(2518, '2022-07-13 13:09:24', 'Visualizo el listado de asignaciones', 10101),
(2519, '2022-07-13 13:09:34', 'Visualizo el listado de asignaciones', 10101),
(2520, '2022-07-13 13:10:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2521, '2022-07-13 13:13:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2522, '2022-07-13 13:15:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2523, '2022-07-13 13:15:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2524, '2022-07-13 13:16:50', 'Visualizo el listado de solicitud', 10101),
(2525, '2022-07-13 13:16:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2526, '2022-07-13 13:16:57', 'Visualizo el listado de asignaciones', 10101),
(2527, '2022-07-13 13:19:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2528, '2022-07-13 13:21:48', 'Visualizo el listado de actividades', 10101),
(2529, '2022-07-13 13:21:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2530, '2022-07-13 13:21:58', 'Visualizo el listado de solicitud', 10101),
(2531, '2022-07-13 13:22:02', 'Visualizo el listado de solicitud', 10101),
(2532, '2022-07-13 13:22:06', 'Visualizo el listado de solicitud', 10101),
(2533, '2022-07-13 13:22:08', 'Visualizo el listado de solicitud', 10101),
(2534, '2022-07-13 13:22:10', 'Visualizo el listado de solicitud', 10101),
(2535, '2022-07-13 13:22:13', 'Visualizo el listado de solicitud', 10101),
(2536, '2022-07-13 13:22:16', 'Visualizo el listado de solicitud', 10101),
(2537, '2022-07-13 13:22:39', 'Visualizo el listado de solicitud', 10101),
(2538, '2022-07-13 13:22:41', 'Visualizo el listado de solicitud', 10101),
(2539, '2022-07-13 13:22:44', 'Visualizo el listado de solicitud', 10101),
(2540, '2022-07-13 13:22:48', 'Visualizo el listado de asignaciones', 10101),
(2541, '2022-07-13 13:22:52', 'Visualizo el listado de asignaciones', 10101),
(2542, '2022-07-13 13:22:55', 'Visualizo el listado de asignaciones', 10101),
(2543, '2022-07-13 13:22:57', 'Visualizo el listado de asignaciones', 10101),
(2544, '2022-07-13 13:23:00', 'Visualizo el listado de asignaciones', 10101),
(2545, '2022-07-13 13:23:02', 'Visualizo el listado de asignaciones', 10101),
(2546, '2022-07-13 13:23:04', 'Visualizo el listado de asignaciones', 10101),
(2547, '2022-07-13 13:23:07', 'Visualizo el listado de asignaciones', 10101),
(2548, '2022-07-13 13:23:09', 'Visualizo el listado de asignaciones', 10101),
(2549, '2022-07-13 13:23:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2550, '2022-07-13 13:26:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2551, '2022-07-13 13:29:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2552, '2022-07-13 13:32:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2553, '2022-07-13 13:35:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2554, '2022-07-13 13:38:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2555, '2022-07-13 13:41:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2556, '2022-07-13 13:44:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2557, '2022-07-13 13:47:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2558, '2022-07-13 13:50:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2559, '2022-07-13 13:53:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2560, '2022-07-13 13:56:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2561, '2022-07-13 13:59:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2562, '2022-07-13 14:02:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2563, '2022-07-13 14:05:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2564, '2022-07-13 14:06:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2565, '2022-07-13 14:09:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2566, '2022-07-13 14:12:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2567, '2022-07-13 14:15:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2568, '2022-07-13 14:18:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2569, '2022-07-13 14:21:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2570, '2022-07-13 14:24:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2571, '2022-07-13 14:27:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2572, '2022-07-13 14:30:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2573, '2022-07-13 14:33:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10101),
(2574, '2022-07-13 15:03:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2575, '2022-07-13 15:06:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2576, '2022-07-13 15:09:12', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2577, '2022-07-13 15:12:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2578, '2022-07-13 15:15:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2579, '2022-07-14 08:45:08', 'Inicio de Sesion', 10082),
(2580, '2022-07-14 08:45:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2581, '2022-07-14 08:45:57', 'Visualizo el listado de solicitud', 10082),
(2582, '2022-07-14 08:46:23', 'Visualizo el listado de solicitud', 10082),
(2583, '2022-07-14 08:47:27', 'Visualizo el listado de solicitud', 10082),
(2584, '2022-07-14 08:48:48', 'Visualizo el listado de solicitud', 10082),
(2585, '2022-07-14 08:48:54', 'Visualizo el listado de solicitud', 10082),
(2586, '2022-07-14 08:49:01', 'Visualizo el listado de solicitud', 10082),
(2587, '2022-07-14 08:49:06', 'Visualizo el listado de solicitud', 10082),
(2588, '2022-07-14 08:49:12', 'Visualizo el listado de solicitud', 10082),
(2589, '2022-07-14 08:49:19', 'Visualizo el listado de solicitud', 10082),
(2590, '2022-07-14 08:49:25', 'Visualizo el listado de solicitud', 10082),
(2591, '2022-07-14 08:49:37', 'Visualizo el listado de solicitud', 10082),
(2592, '2022-07-14 08:49:43', 'Visualizo el listado de solicitud', 10082),
(2593, '2022-07-14 08:49:49', 'Visualizo el listado de solicitud', 10082),
(2594, '2022-07-14 08:49:55', 'Visualizo el listado de solicitud', 10082),
(2595, '2022-07-14 08:50:01', 'Visualizo el listado de solicitud', 10082),
(2596, '2022-07-14 08:50:07', 'Visualizo el listado de solicitud', 10082),
(2597, '2022-07-14 08:50:13', 'Visualizo el listado de solicitud', 10082),
(2598, '2022-07-14 08:50:18', 'Visualizo el listado de solicitud', 10082),
(2599, '2022-07-14 08:50:23', 'Visualizo el listado de solicitud', 10082),
(2600, '2022-07-14 08:50:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2601, '2022-07-14 08:50:40', 'Visualizo el listado de solicitud', 10082),
(2602, '2022-07-14 08:50:45', 'Visualizo el listado de solicitud', 10082),
(2603, '2022-07-14 08:50:50', 'Visualizo el listado de solicitud', 10082),
(2604, '2022-07-14 08:50:54', 'Visualizo el listado de solicitud', 10082),
(2605, '2022-07-14 08:50:59', 'Visualizo el listado de solicitud', 10082),
(2606, '2022-07-14 08:51:11', 'Visualizo el listado de solicitud', 10082),
(2607, '2022-07-14 08:51:17', 'Visualizo el listado de solicitud', 10082),
(2608, '2022-07-14 08:51:23', 'Visualizo el listado de solicitud', 10082),
(2609, '2022-07-14 08:51:28', 'Visualizo el listado de solicitud', 10082),
(2610, '2022-07-14 08:51:33', 'Visualizo el listado de solicitud', 10082),
(2611, '2022-07-14 08:51:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2612, '2022-07-14 08:52:15', 'Visualizo el listado de asignaciones', 10082),
(2613, '2022-07-14 08:52:36', 'Visualizo el listado de asignaciones', 10082),
(2614, '2022-07-14 08:52:55', 'Visualizo el listado de asignaciones', 10082),
(2615, '2022-07-14 08:53:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2616, '2022-07-14 08:53:39', 'Visualizo el listado de asignaciones', 10082),
(2617, '2022-07-14 08:53:51', 'Visualizo el listado de asignaciones', 10082),
(2618, '2022-07-14 08:54:25', 'Visualizo el listado de asignaciones', 10082),
(2619, '2022-07-14 08:54:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2620, '2022-07-14 08:57:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2621, '2022-07-14 09:00:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2622, '2022-07-14 09:03:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2623, '2022-07-14 09:06:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2624, '2022-07-14 09:10:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2625, '2022-07-14 09:13:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2626, '2022-07-14 09:16:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2627, '2022-07-14 09:19:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2628, '2022-07-14 09:22:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2629, '2022-07-14 09:25:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2630, '2022-07-14 09:28:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2631, '2022-07-14 09:32:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2632, '2022-07-14 09:35:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2633, '2022-07-14 09:38:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2634, '2022-07-14 09:41:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2635, '2022-07-14 09:44:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2636, '2022-07-14 09:47:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2637, '2022-07-14 09:50:55', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2638, '2022-07-14 09:53:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2639, '2022-07-14 09:56:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2640, '2022-07-14 10:00:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2641, '2022-07-14 10:03:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2642, '2022-07-14 10:06:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2643, '2022-07-14 10:09:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2644, '2022-07-14 10:12:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2645, '2022-07-14 10:15:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2646, '2022-07-14 10:18:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2647, '2022-07-14 10:21:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2648, '2022-07-14 10:24:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2649, '2022-07-14 10:27:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2650, '2022-07-14 10:30:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2651, '2022-07-14 10:33:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2652, '2022-07-14 10:36:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2653, '2022-07-14 10:39:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2654, '2022-07-14 10:42:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2655, '2022-07-14 10:45:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2656, '2022-07-14 10:49:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2657, '2022-07-14 10:52:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2658, '2022-07-14 10:55:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2659, '2022-07-14 11:47:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2660, '2022-07-14 11:51:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2661, '2022-07-14 11:55:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2662, '2022-07-14 11:58:03', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2663, '2022-07-14 12:01:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2664, '2022-07-14 12:04:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2665, '2022-07-14 12:07:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2666, '2022-07-14 12:10:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2667, '2022-07-14 12:13:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2668, '2022-07-14 12:16:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2669, '2022-07-14 12:19:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2670, '2022-07-14 12:22:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2671, '2022-07-14 12:25:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2672, '2022-07-14 12:28:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2673, '2022-07-14 12:31:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2674, '2022-07-14 12:34:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2675, '2022-07-14 12:37:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2676, '2022-07-14 12:40:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2677, '2022-07-14 12:43:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2678, '2022-07-14 12:46:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10082),
(2679, '2022-07-20 13:48:43', 'Inicio de Sesion', 1),
(2680, '2022-07-20 13:48:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2681, '2022-07-20 13:51:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2682, '2022-07-20 13:54:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2683, '2022-07-20 13:57:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2684, '2022-07-20 13:58:22', 'Inicio de Sesion', 1),
(2685, '2022-07-20 13:58:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2686, '2022-07-20 14:02:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2687, '2022-07-20 14:26:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2688, '2022-07-20 14:28:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2689, '2022-07-20 14:29:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2690, '2022-07-20 14:32:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2691, '2022-07-20 14:35:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2692, '2022-07-20 14:38:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2693, '2022-07-20 14:41:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2694, '2022-07-21 15:34:43', 'Inicio de Sesion', 1),
(2695, '2022-07-21 15:34:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2696, '2022-07-21 15:37:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2697, '2022-07-21 15:38:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2698, '2022-07-21 15:41:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2699, '2022-07-21 15:44:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2700, '2022-07-21 15:47:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2701, '2022-07-21 15:50:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2702, '2022-07-21 15:53:58', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2703, '2022-07-21 15:54:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2704, '2022-07-21 15:55:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2705, '2022-07-21 16:56:37', 'Inicio de Sesion', 1),
(2706, '2022-07-21 16:56:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2707, '2022-07-22 06:29:58', 'Inicio de Sesion', 1),
(2708, '2022-07-22 06:29:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2709, '2022-07-22 09:34:53', 'Inicio de Sesion', 10081),
(2710, '2022-07-22 09:34:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2711, '2022-07-22 09:40:49', 'Inicio de Sesion', 10081),
(2712, '2022-07-22 09:40:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10081),
(2713, '2022-07-25 09:03:45', 'Inicio de Sesion', 1),
(2714, '2022-07-25 09:03:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2715, '2022-07-25 09:06:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2716, '2022-07-25 09:09:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2717, '2022-07-25 09:12:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2718, '2022-07-25 09:15:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2719, '2022-07-25 09:18:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2720, '2022-07-25 09:20:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2721, '2022-07-25 09:20:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2722, '2022-07-25 09:21:56', 'Creacion de nueva solicitud: Revision de la hora en mi computadora', 1),
(2723, '2022-07-25 09:22:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2724, '2022-07-25 09:26:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2725, '2022-07-25 09:29:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2726, '2022-07-25 09:32:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2727, '2022-07-25 09:35:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2728, '2022-07-25 09:38:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2729, '2022-07-25 09:39:38', 'Actualizo la siguiente solicitud: Revision de la hora en mi computadora', 1),
(2730, '2022-07-25 09:39:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2731, '2022-07-25 09:39:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2732, '2022-07-25 10:39:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2733, '2022-07-25 10:40:05', 'Visualizo el listado de solicitud', 1),
(2734, '2022-07-25 10:40:30', 'Creacion de nueva asignacion: realizar solicitud', 1),
(2735, '2022-07-25 10:40:30', 'Visualizo el listado de solicitud', 1),
(2736, '2022-07-25 10:40:33', 'Visualizo el listado de asignaciones', 1),
(2737, '2022-07-25 10:41:03', 'Creacion de nuevo paso procesado: actividad realizada con exito', 1),
(2738, '2022-07-25 10:41:51', 'Creacion de nuevo paso procesado: listo', 1),
(2739, '2022-07-25 10:42:06', 'Asignacion finalizada: 245', 1),
(2740, '2022-07-25 10:43:32', 'Visualizo el listado de asignaciones', 1),
(2741, '2022-07-25 12:39:36', 'Inicio de Sesion', 1),
(2742, '2022-07-25 12:39:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2743, '2022-07-25 14:38:23', 'Inicio de Sesion', 1),
(2744, '2022-07-25 14:38:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2745, '2022-07-25 14:39:09', 'Inicio de Sesion', 1),
(2746, '2022-07-25 14:39:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2747, '2022-07-25 14:48:43', 'Inicio de Sesion', 10089),
(2748, '2022-07-25 14:48:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2749, '2022-07-25 14:51:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2750, '2022-07-25 14:54:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2751, '2022-07-25 14:57:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2752, '2022-07-25 15:00:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2753, '2022-07-25 15:03:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2754, '2022-07-25 15:06:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2755, '2022-07-25 15:09:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2756, '2022-07-25 15:12:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2757, '2022-07-25 15:37:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2758, '2022-07-25 15:40:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2759, '2022-07-25 15:43:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2760, '2022-07-25 15:46:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2761, '2022-07-25 15:49:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2762, '2022-07-25 15:52:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2763, '2022-07-25 15:55:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2764, '2022-07-25 15:58:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2765, '2022-07-25 16:01:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2766, '2022-07-25 16:04:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2767, '2022-07-25 16:07:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2768, '2022-07-25 16:10:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2769, '2022-07-25 16:11:48', 'Inicio de Sesion', 1),
(2770, '2022-07-25 16:11:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2771, '2022-07-25 16:17:33', 'Inicio de Sesion', 10107),
(2772, '2022-07-25 16:17:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10107),
(2773, '2022-07-25 16:18:39', 'Visualizo el listado de solicitud', 10107),
(2774, '2022-07-25 16:19:01', 'Hizo la siguiente busqueda: hora en el listado de solicitud', 10107),
(2775, '2022-07-25 16:19:49', 'Inicio de Sesion', 10089),
(2776, '2022-07-25 16:19:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2777, '2022-07-25 16:20:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2778, '2022-07-25 16:20:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10089),
(2779, '2022-07-25 16:21:02', 'Visualizo el listado de solicitud', 10089),
(2780, '2022-07-25 18:01:40', 'Inicio de Sesion', 1),
(2781, '2022-07-25 18:01:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2782, '2022-07-26 15:15:11', 'Inicio de Sesion', 1),
(2783, '2022-07-26 15:15:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2784, '2022-07-26 15:15:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2785, '2022-07-26 15:18:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2786, '2022-07-26 15:20:55', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2787, '2022-07-26 15:21:10', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2788, '2022-07-26 15:21:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2789, '2022-07-26 15:22:04', 'Inicio de Sesion', 1),
(2790, '2022-07-26 15:22:04', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2791, '2022-07-26 15:23:30', 'Inicio de Sesion', 1),
(2792, '2022-07-26 15:23:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2793, '2022-07-26 15:23:42', 'Inicio de Sesion', 1),
(2794, '2022-07-26 15:23:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2795, '2022-07-26 15:23:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2796, '2022-07-26 15:25:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2797, '2022-07-26 15:25:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2798, '2022-07-26 15:28:35', 'Visualizo el listado de solicitud', 1),
(2799, '2022-07-26 16:10:04', 'Visualizo el listado de turnoes', 1),
(2800, '2022-07-26 22:26:35', 'Inicio de Sesion', 1),
(2801, '2022-07-26 22:26:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2802, '2022-07-26 22:26:51', 'Inicio de Sesion', 1),
(2803, '2022-07-26 22:26:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2804, '2022-07-26 22:30:26', 'Inicio de Sesion', 1),
(2805, '2022-07-26 22:30:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2806, '2022-07-26 22:50:23', 'Visualizo el listado de cargos', 1),
(2807, '2022-07-26 23:06:35', 'Creacion de nuevo cubiculo: Puesto Numero 1', 1),
(2808, '2022-07-27 11:55:38', 'Inicio de Sesion', 1),
(2809, '2022-07-27 11:55:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2810, '2022-07-27 11:56:11', 'Inicio de Sesion', 1),
(2811, '2022-07-27 11:56:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2812, '2022-07-27 11:57:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2813, '2022-07-27 12:00:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2814, '2022-07-27 12:03:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2815, '2022-07-27 12:03:35', 'Creacion de nuevo cubiculo: cubiculo 20', 1),
(2816, '2022-07-27 12:03:50', 'Creacion de nuevo cubiculo: cubiculo 5', 1),
(2817, '2022-07-27 12:03:54', 'Visualizo el listado de cubiculos', 1),
(2818, '2022-07-27 12:04:08', 'Hizo la siguiente busqueda: maria en el listado de cubiculos', 1),
(2819, '2022-07-27 12:04:11', 'Visualizo el listado de cubiculos', 1),
(2820, '2022-07-27 12:04:15', 'Hizo la siguiente busqueda: maria en el listado de cubiculos', 1),
(2821, '2022-07-27 12:04:23', 'Hizo la siguiente busqueda: 20 en el listado de cubiculos', 1),
(2822, '2022-07-27 12:43:02', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2823, '2022-07-27 12:44:31', 'Creacion de nueva solicitud: hablar con el gobernador', 1),
(2824, '2022-07-27 12:44:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2825, '2022-07-27 12:47:25', 'Creacion de nuevo sector: casco central', 1),
(2826, '2022-07-27 12:47:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2827, '2022-07-27 12:48:14', 'Actualizo la siguiente solicitud: hablar con el gobernador', 1),
(2828, '2022-07-27 12:48:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2829, '2022-07-27 12:48:21', 'Visualizo el listado de solicitud', 1),
(2830, '2022-07-27 12:48:39', 'Creacion de nueva asignacion: realizar asignacion', 1),
(2831, '2022-07-27 12:48:39', 'Visualizo el listado de solicitud', 1),
(2832, '2022-07-27 12:48:43', 'Visualizo el listado de asignaciones', 1),
(2833, '2022-07-27 12:49:14', 'Creacion de nuevo paso procesado: asginacion realizada', 1),
(2834, '2022-07-27 12:49:29', 'Asignacion finalizada: 247', 1),
(2835, '2022-07-27 12:49:30', 'Visualizo el listado de asignaciones', 1),
(2836, '2022-07-27 12:49:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2837, '2022-07-27 12:50:01', 'Visualizo el listado de solicitud', 1),
(2838, '2022-07-27 12:50:07', 'Visualizo el listado de solicitud', 1),
(2839, '2022-07-27 12:50:18', 'Hizo la siguiente busqueda: evaluar en el listado de solicitud', 1),
(2840, '2022-07-27 12:50:31', 'Visualizo el listado de solicitud', 1),
(2841, '2022-07-27 12:50:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2842, '2022-07-27 12:53:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2843, '2022-07-27 12:56:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2844, '2022-07-27 12:59:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2845, '2022-07-27 13:02:36', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2846, '2022-07-27 13:05:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2847, '2022-07-27 13:08:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2848, '2022-07-27 13:11:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2849, '2022-07-27 13:14:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2850, '2022-07-27 13:17:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2851, '2022-07-27 13:20:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2852, '2022-07-27 13:23:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2853, '2022-07-27 13:26:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2854, '2022-07-27 14:38:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2855, '2022-07-27 14:41:37', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2856, '2022-07-27 14:44:38', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2857, '2022-07-27 14:47:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2858, '2022-07-27 14:50:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2859, '2022-07-27 15:23:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2860, '2022-07-27 15:26:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2861, '2022-07-27 15:29:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2862, '2022-07-27 16:05:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2863, '2022-07-27 16:06:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2864, '2022-07-27 16:09:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2865, '2022-07-27 16:11:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2866, '2022-07-27 16:11:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2867, '2022-07-27 16:11:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1);
INSERT INTO `bitacora` (`bitacora_id`, `bitacora_fecha`, `bitacora_accion`, `usuario_id`) VALUES
(2868, '2022-07-27 16:11:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2869, '2022-07-27 16:14:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2870, '2022-07-27 16:17:51', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2871, '2022-07-27 16:20:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2872, '2022-07-27 16:23:53', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2873, '2022-07-27 16:26:54', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2874, '2022-07-27 16:29:55', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2875, '2022-07-27 16:32:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2876, '2022-07-27 16:35:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2877, '2022-07-27 16:38:58', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2878, '2022-07-27 16:41:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2879, '2022-07-27 16:45:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2880, '2022-07-27 16:48:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2881, '2022-07-27 16:50:56', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2882, '2022-07-27 16:51:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2883, '2022-07-27 16:54:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2884, '2022-07-27 16:57:12', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2885, '2022-07-27 17:00:12', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2886, '2022-07-27 17:03:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2887, '2022-07-27 17:06:14', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2888, '2022-07-27 17:09:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2889, '2022-07-27 17:12:16', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2890, '2022-07-27 17:15:17', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2891, '2022-07-27 17:18:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2892, '2022-07-27 17:21:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2893, '2022-07-27 17:24:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2894, '2022-07-27 17:27:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2895, '2022-07-27 17:30:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2896, '2022-07-27 17:33:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2897, '2022-07-27 17:36:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2898, '2022-07-27 17:37:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2899, '2022-07-27 17:37:18', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2900, '2022-07-27 17:37:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2901, '2022-07-27 17:37:35', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2902, '2022-07-27 17:38:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2903, '2022-07-27 17:41:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2904, '2022-07-27 17:44:23', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2905, '2022-07-27 17:47:24', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2906, '2022-07-27 17:50:25', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2907, '2022-07-27 17:53:26', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2908, '2022-07-27 17:56:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2909, '2022-07-27 17:59:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2910, '2022-07-27 18:02:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2911, '2022-07-27 18:05:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2912, '2022-07-27 18:29:21', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2913, '2022-07-27 18:30:27', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2914, '2022-07-27 18:33:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2915, '2022-07-27 18:36:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2916, '2022-07-27 18:39:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2917, '2022-09-04 18:34:45', 'Inicio de Sesion', 1),
(2918, '2022-09-04 18:34:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2919, '2022-09-04 18:37:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2920, '2022-09-04 18:40:48', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2921, '2022-09-05 05:44:05', 'Inicio de Sesion', 1),
(2922, '2022-09-05 05:44:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2923, '2022-09-05 05:47:06', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2924, '2022-09-05 05:50:07', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2925, '2022-09-05 05:53:08', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2926, '2022-09-05 05:55:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2927, '2022-09-05 06:12:30', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2928, '2022-09-05 06:15:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2929, '2022-09-05 06:18:32', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2930, '2022-09-05 06:21:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2931, '2022-09-05 06:24:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2932, '2022-09-05 06:25:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2933, '2022-09-05 06:28:58', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2934, '2022-09-05 06:31:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2935, '2022-09-05 06:35:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2936, '2022-09-05 06:36:15', 'Creacion de nueva solicitud: para probar las asignaciones que estan pendiente', 1),
(2937, '2022-09-05 06:36:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2938, '2022-09-05 06:37:16', 'Actualizo la siguiente solicitud: para probar las asignaciones que estan pendiente', 1),
(2939, '2022-09-05 06:37:19', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2940, '2022-09-05 06:39:28', 'Visualizo el listado de solicitud', 1),
(2941, '2022-09-05 06:39:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2942, '2022-09-05 06:40:25', 'Creacion de nueva asignacion: realizando chequeo de home, para saber cuantas actividades tiene asignadas', 1),
(2943, '2022-09-05 06:40:25', 'Visualizo el listado de solicitud', 1),
(2944, '2022-09-05 06:42:41', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2945, '2022-09-05 06:43:33', 'Visualizo el listado de asignaciones', 1),
(2946, '2022-09-05 06:43:43', 'Creacion de nuevo paso procesado: listo asignacion', 1),
(2947, '2022-09-05 06:44:00', 'Asignacion finalizada: 249', 1),
(2948, '2022-09-05 06:44:01', 'Visualizo el listado de asignaciones', 1),
(2949, '2022-09-05 06:45:42', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2950, '2022-09-05 06:48:43', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2951, '2022-09-05 06:51:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2952, '2022-09-05 06:54:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2953, '2022-09-05 07:02:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2954, '2022-09-05 07:04:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2955, '2022-09-05 07:07:40', 'Creacion de nueva solicitud: probar asignacion', 1),
(2956, '2022-09-05 07:07:46', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2957, '2022-09-05 07:07:52', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2958, '2022-09-05 07:07:59', 'Actualizo la siguiente solicitud: probar asignacion', 1),
(2959, '2022-09-05 07:08:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2960, '2022-09-05 07:08:03', 'Visualizo el listado de solicitud', 1),
(2961, '2022-09-05 07:08:24', 'Creacion de nueva asignacion: probando asignacion', 1),
(2962, '2022-09-05 07:08:24', 'Visualizo el listado de solicitud', 1),
(2963, '2022-09-05 07:08:28', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2964, '2022-09-05 07:10:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2965, '2022-09-05 07:32:29', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2966, '2022-09-05 07:33:02', 'Creacion de nueva solicitud: probando nueva solicitud', 1),
(2967, '2022-09-05 07:33:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2968, '2022-09-05 07:46:57', 'Creacion de nueva solicitud: revision de mi conexion a internet', 1),
(2969, '2022-09-05 07:47:25', 'Creacion de nueva solicitud: agregar nueva solicitud de actividad, conexion a internet', 1),
(2970, '2022-09-05 07:50:39', 'Creacion de nueva solicitud: agregar nueva solicitud de actividad, conexion a internet', 1),
(2971, '2022-09-05 07:50:49', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2972, '2022-09-05 07:51:08', 'Actualizo la siguiente solicitud: revision de mi conexion a internet', 1),
(2973, '2022-09-05 07:51:09', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2974, '2022-09-05 07:51:13', 'Visualizo el listado de solicitud', 1),
(2975, '2022-09-05 09:39:05', 'Inicio de Sesion', 1),
(2976, '2022-09-05 09:39:05', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2977, '2022-09-05 12:28:48', 'Creacion de nueva solicitud: solicitud de prueba', 1),
(2978, '2022-09-05 12:28:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2979, '2022-09-05 12:35:11', 'Inicio de Sesion', 10102),
(2980, '2022-09-05 12:35:11', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10102),
(2981, '2022-09-05 12:35:55', 'Visualizo el listado de solicitud', 10102),
(2982, '2022-09-05 12:36:21', 'Inicio de Sesion', 10102),
(2983, '2022-09-05 12:36:22', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10102),
(2984, '2022-09-05 12:37:55', 'Creacion de nueva solicitud: realizar prueba angel', 10102),
(2985, '2022-09-05 12:37:57', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 10102),
(2986, '2022-09-06 06:02:40', 'Inicio de Sesion', 1),
(2987, '2022-09-06 06:02:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2988, '2022-09-06 06:07:01', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2989, '2022-09-06 06:08:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2990, '2022-09-06 08:02:33', 'Inicio de Sesion', 1),
(2991, '2022-09-06 08:02:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2992, '2022-09-06 08:05:34', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2993, '2022-09-06 12:36:44', 'Inicio de Sesion', 1),
(2994, '2022-09-06 12:36:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2995, '2022-09-06 12:39:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2996, '2022-09-06 12:42:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2997, '2022-09-06 12:45:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2998, '2022-09-06 12:48:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(2999, '2022-09-06 12:51:44', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3000, '2022-09-06 12:54:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3001, '2022-09-06 12:57:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3002, '2022-09-06 16:46:59', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3003, '2022-09-07 07:48:20', 'Inicio de Sesion', 1),
(3004, '2022-09-07 07:48:20', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3005, '2022-09-07 11:22:33', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3006, '2022-09-07 21:14:58', 'Inicio de Sesion', 1),
(3007, '2022-09-07 21:14:58', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3008, '2022-09-07 21:16:00', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3009, '2022-09-07 21:18:15', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3010, '2022-09-09 08:42:37', 'Inicio de Sesion', 1),
(3011, '2022-09-09 08:42:39', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3012, '2022-09-09 11:48:11', 'Visualizo el listado de gabinete', 1),
(3013, '2022-09-09 11:48:22', 'Visualizo el listado de estudio', 1),
(3014, '2022-09-09 11:51:37', 'Visualizo el listado de estudio', 1),
(3015, '2022-09-11 02:31:12', 'Inicio de Sesion', 1),
(3016, '2022-09-11 02:31:13', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3017, '2022-09-11 12:02:45', 'Inicio de Sesion', 1),
(3018, '2022-09-11 12:02:45', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3019, '2022-09-11 16:10:50', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3020, '2022-09-11 16:11:17', 'Creacion de nueva solicitud: chequeando', 1),
(3021, '2022-09-11 20:54:40', 'Visualizo el listado de estudio', 1),
(3022, '2022-09-11 20:55:12', 'Hizo la siguiente busqueda: 21389116 en el listado de estudio', 1),
(3023, '2022-09-11 20:55:18', 'Hizo la siguiente busqueda: 21389116 en el listado de estudio', 1),
(3024, '2022-09-11 20:55:22', 'Visualizo el listado de estudio', 1),
(3025, '2022-09-11 21:04:21', 'Visualizo el listado de estudio', 1),
(3026, '2022-09-11 21:04:53', 'Visualizo el listado de estudio', 1),
(3027, '2022-09-11 21:05:23', 'Visualizo el listado de estudio', 1),
(3028, '2022-09-11 21:05:40', 'Visualizo el listado de estudio', 1),
(3029, '2022-09-11 21:06:26', 'Visualizo el listado de estudio', 1),
(3030, '2022-09-11 21:07:29', 'Hizo la siguiente busqueda: 21389116 en el listado de estudio', 1),
(3031, '2022-09-11 21:07:47', 'Hizo la siguiente busqueda: 21389129 en el listado de estudio', 1),
(3032, '2022-09-11 21:10:54', 'Hizo la siguiente busqueda: 21389129 en el listado de estudio', 1),
(3033, '2022-09-11 21:27:54', 'Visualizo el listado de estudio', 1),
(3034, '2022-09-11 21:28:01', 'Visualizo el listado de estudio', 1),
(3035, '2022-09-11 21:28:09', 'Visualizo el listado de estudio', 1),
(3036, '2022-09-11 21:28:15', 'Visualizo el listado de estudio', 1),
(3037, '2022-09-11 21:28:22', 'Visualizo el listado de estudio', 1),
(3038, '2022-09-11 21:28:28', 'Visualizo el listado de estudio', 1),
(3039, '2022-09-11 21:28:33', 'Visualizo el listado de estudio', 1),
(3040, '2022-09-11 21:28:41', 'Visualizo el listado de estudio', 1),
(3041, '2022-09-11 21:28:45', 'Visualizo el listado de estudio', 1),
(3042, '2022-09-12 07:48:47', 'Inicio de Sesion', 1),
(3043, '2022-09-12 07:48:47', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3044, '2022-09-12 07:48:51', 'Visualizo el listado de estudio', 1),
(3045, '2022-09-12 07:48:58', 'Visualizo el listado de estudio', 1),
(3046, '2022-09-12 07:49:03', 'Visualizo el listado de estudio', 1),
(3047, '2022-09-12 07:49:07', 'Visualizo el listado de estudio', 1),
(3048, '2022-09-12 08:00:52', 'Visualizo el listado de estudio', 1),
(3049, '2022-09-12 08:00:54', 'Visualizo el listado de estudio', 1),
(3050, '2022-09-12 08:31:46', 'Visualizo el listado de estudio', 1),
(3051, '2022-09-12 08:31:49', 'Visualizo el listado de estudio', 1),
(3052, '2022-09-12 08:32:24', 'Visualizo el listado de estudio', 1),
(3053, '2022-09-12 08:32:26', 'Visualizo el listado de estudio', 1),
(3054, '2022-09-12 09:07:26', 'Visualizo el listado de estudio', 1),
(3055, '2022-09-12 09:15:20', 'Visualizo el listado de estudio', 1),
(3056, '2022-09-12 09:15:25', 'Visualizo el listado de estudio', 1),
(3057, '2022-09-12 09:15:30', 'Visualizo el listado de estudio', 1),
(3058, '2022-09-12 09:15:32', 'Visualizo el listado de estudio', 1),
(3059, '2022-09-12 09:16:09', 'Visualizo el listado de estudio', 1),
(3060, '2022-09-12 09:17:06', 'Visualizo el listado de estudio', 1),
(3061, '2022-09-12 09:17:27', 'Hizo la siguiente busqueda: 21389116 en el listado de estudio', 1),
(3062, '2022-09-12 09:26:31', 'Inicio de Sesion', 1),
(3063, '2022-09-12 09:26:31', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1),
(3064, '2022-09-12 09:26:36', 'Visualizo el listado de estudio', 1),
(3065, '2022-09-12 09:47:20', 'Visualizo el listado de estudio', 1),
(3066, '2022-09-12 09:49:43', 'Visualizo el listado de estudio', 1),
(3067, '2022-09-12 09:50:31', 'Visualizo el listado de estudio', 1);

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
(1, 'IMPRESORAS', 'IMPRESORAS'),
(2, 'SOFTWARE', 'SOFTWARE'),
(3, 'REDES', 'REDES'),
(4, 'SEGURIDAD INFORMATICA', 'SEGURIDAD INFORMATICA'),
(5, 'HARDWARE', 'HARDWARE'),
(6, 'ADMINISTRACION', 'ADMINISTRACION'),
(7, 'MANTENIMIENTO', 'MANTENIMIENTO');

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
(1, 'Puesto Numero 1', 10099),
(2, 'cubiculo 20', 10097),
(3, 'cubiculo 5', 1);

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
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `estudio_id` int(11) NOT NULL,
  `estudio_nombre_solicitante` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_tipo_documento` varchar(3) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_cedula_solicitante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_nacionalidad` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_estado_civil` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_telefono` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_lugar_nacimiento` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_estado_solicitante` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_fecha_nacimiento` date NOT NULL,
  `estudio_genero` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_direccion_permanente` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_municipio` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_parroquia` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_estado_direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_grado_instruccion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_trabaja` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_profesion` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_institucion_empresa` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_ocupacion` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_telefono_trabajo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_direccion_laboral` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_ingreso_familiar` decimal(25,2) NOT NULL,
  `estudio_observaciones` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_tipo_vivienda` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_tenencia_vivienda` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_tipo_ayuda` text COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_sintesis` text COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_area_socioeconomica` text COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_conclusion` text COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_planilla_solicitud` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_copia_cedula` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_informe_medico` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_rif` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_presupuesto` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_orden_medica` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_carta_gobernador` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_acta_nacimiento` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_elaborado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_nombre_elaborado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_cedula_elaborado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_supervisado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_nombre_supervisado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_cedula_supervisado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_aprobado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_nombre_aprobado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_cedula_aprobado` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estudio_fecha_solicitud` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE `familiar` (
  `familiar_id` int(11) NOT NULL,
  `estudio_cedula_solicitante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `familiar_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `familiar_cedula` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `familiar_lugar_nacimiento` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `familiar_fecha_nacimiento` date NOT NULL DEFAULT '1990-02-01',
  `familiar_genero` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `familiar_ocupacion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `familiar_filiacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
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

--
-- Volcado de datos para la tabla `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `usuario_id`, `solicitud_id`, `feedback_descripcion`, `feedback_tiempo_respuesta`, `feedback_tipo_solucion`, `feedback_fecha`) VALUES
(1, 10107, 1, 'Buena respuesta', 3, 3, 2022),
(2, 10107, 2, 'buena solucion', 3, 3, 2022),
(3, 10107, 3, 'Excelente trabajo y en corto tiempo', 4, 4, 2022),
(4, 10106, 6, 'Excelente', 3, 3, 2022),
(5, 10121, 8, 'Bien', 3, 3, 2022),
(6, 10114, 10, 'Normal', 3, 3, 2022),
(7, 10121, 7, 'buena respuesta', 3, 3, 2022),
(8, 10107, 11, 'Bien', 4, 4, 2022),
(9, 10114, 13, 'buen resutado', 3, 3, 2022),
(10, 10112, 12, 'buena respuesta', 3, 3, 2022),
(11, 10121, 9, 'buena respuesta', 3, 3, 2022),
(12, 10120, 17, 'Mal', 3, 3, 2022),
(13, 10120, 18, 'Muy buen servicio', 4, 4, 2022),
(14, 10107, 4, 'Revisión Oportuna y buena asistencia', 4, 4, 2022),
(15, 10107, 23, 'En realidad fue muy acertada el trabajo del tecnico', 4, 4, 2022),
(16, 10120, 21, 'Verificacion de puntos de internet, bueno', 4, 4, 2022),
(17, 10103, 22, 'respuesta buena', 3, 3, 2022),
(18, 10107, 20, 'buena respuesta', 3, 3, 2022),
(19, 10103, 19, 'buena', 3, 3, 2022),
(20, 10107, 4, 'buena', 3, 3, 2022),
(21, 10108, 24, 'Muy bueno, se activo la conexion a internet', 4, 4, 2022),
(22, 10105, 15, 'Bueno', 4, 4, 2022),
(23, 10103, 14, 'Excelentee', 4, 4, 2022),
(24, 10112, 5, 'Bueno', 3, 3, 2022),
(25, 10122, 26, 'Rapida y eficiente', 4, 4, 2022),
(26, 10112, 27, 'malo', 2, 1, 2022),
(27, 10120, 28, 'fue muy buena la solucion', 3, 4, 2022),
(28, 10108, 29, 'Buena', 4, 4, 2022),
(29, 10107, 30, 'Mas o menos', 3, 4, 2022),
(30, 10107, 33, 'Bien', 3, 4, 2022),
(31, 10123, 31, 'La solución fue muy rápida. gracias', 4, 4, 2022),
(32, 10112, 34, 'BIEN', 3, 3, 2022),
(33, 10111, 44, 'buena', 3, 3, 2022),
(34, 10105, 46, 'Malo', 2, 2, 2022),
(35, 10113, 45, 'Mas o menos', 2, 2, 2022),
(36, 10112, 43, 'Bien', 3, 3, 2022),
(37, 10120, 41, 'Malo', 2, 3, 2022),
(38, 10115, 38, 'Bien', 3, 3, 2022),
(39, 10105, 42, 'Bien', 3, 3, 2022),
(40, 10110, 39, 'Mal', 1, 1, 2022),
(41, 10105, 40, 'Mas o menos', 2, 2, 2022),
(42, 10106, 37, 'Mas o menos', 3, 3, 2022),
(43, 10106, 32, 'Bien', 3, 2, 2022),
(44, 10118, 36, 'Bine', 1, 3, 2022),
(45, 10110, 35, 'Mas o menos', 3, 2, 2022),
(46, 10120, 47, 'bien', 3, 3, 2022),
(47, 10112, 48, 'mas o menos', 2, 2, 2022),
(48, 10105, 50, 'Bueno', 3, 4, 2022),
(49, 10118, 52, 'Bueno', 4, 4, 2022),
(50, 10120, 53, 'Buena', 4, 4, 2022),
(51, 10132, 54, 'buena', 3, 3, 2022),
(52, 10107, 11, 'buena', 3, 3, 2022),
(53, 10110, 56, 'Bien', 4, 4, 2022),
(54, 10112, 55, 'buena', 3, 3, 2022),
(55, 10105, 57, 'buena', 3, 3, 2022),
(56, 10103, 58, 'buena', 3, 3, 2022),
(57, 10112, 59, 'buena', 3, 3, 2022),
(58, 10105, 61, 'Bien', 3, 3, 2022),
(59, 10105, 62, 'Mas o menos', 2, 2, 2022),
(60, 10114, 60, 'buena', 3, 3, 2022),
(61, 10114, 60, 'Bueno', 4, 4, 2022),
(62, 10103, 64, 'BIEN', 4, 4, 2022),
(63, 10114, 63, 'buena', 3, 3, 2022),
(64, 10107, 66, 'buena', 3, 3, 2022),
(65, 10112, 67, 'Mas o menos', 2, 2, 2022),
(66, 10103, 69, 'buena', 3, 3, 2022),
(67, 10103, 68, 'buena', 3, 3, 2022),
(68, 10105, 70, 'Bien', 3, 3, 2022),
(69, 10120, 71, 'Bien', 2, 1, 2022),
(70, 10118, 72, 'buena', 3, 3, 2022),
(71, 10118, 73, 'bueno', 4, 4, 2022),
(72, 10114, 74, 'Bien', 2, 2, 2022),
(73, 10114, 75, 'buena', 3, 3, 2022),
(74, 10121, 76, 'Mal', 1, 1, 2022),
(75, 10105, 78, 'Bien', 3, 3, 2022),
(76, 10110, 77, 'buena', 3, 3, 2022),
(77, 10107, 79, 'Mas o menos', 1, 2, 2022),
(78, 10133, 81, 'Mas o menos', 2, 2, 2022),
(79, 10105, 80, 'buena', 3, 3, 2022),
(80, 10107, 83, 'Bien', 4, 4, 2022),
(81, 10112, 82, 'buena', 3, 3, 2022),
(82, 10107, 84, 'Bien', 3, 3, 2022),
(83, 10089, 85, 'buena', 3, 3, 2022),
(84, 10103, 87, 'mala', 2, 2, 2022),
(85, 10103, 86, 'buena', 2, 3, 2022),
(86, 10105, 88, 'Buena', 4, 4, 2022),
(87, 10113, 89, 'Bien', 2, 2, 2022),
(88, 10112, 92, 'Bien', 3, 2, 2022),
(89, 10114, 91, 'Bueno', 4, 4, 2022),
(90, 10106, 95, 'Se removio papel atascado en la impresora', 4, 4, 2022),
(91, 10108, 93, 'problemas con internet', 2, 2, 2022),
(92, 10111, 96, 'bueno', 4, 3, 2022),
(93, 10121, 65, 'buena', 3, 3, 2022),
(94, 10120, 49, 'buena', 2, 2, 2022),
(95, 10109, 97, 'tardo en responder', 3, 3, 2022),
(96, 10121, 99, 'fino', 3, 3, 2022);

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
(2, 2022, 2, 0, 0),
(3, 2022, 3, 0, 0),
(4, 2022, 4, 0, 0),
(5, 2022, 5, 1, 0),
(6, 2022, 6, 101, 101),
(7, 2022, 7, 1, 2),
(8, 2022, 8, 0, 0),
(9, 2022, 9, 3, 1),
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
(1, 2022, 3, '2.10', 1, 'Instalación de toner'),
(2, 2022, 4, '2.80', 37, 'Reparacion de Sistema Operativo'),
(3, 2022, 7, '4.90', 16, 'Elaboracion de cable de red'),
(4, 2022, 4, '2.80', 26, 'Ensamblar equipos de computacion'),
(5, 2022, 19, '13.29', 31, 'Acceso de conectividad de pfesente'),
(6, 2022, 2, '1.40', 30, 'Levantamiento de informacion'),
(7, 2022, 11, '7.69', 15, 'Punto de Red'),
(8, 2022, 3, '2.10', 20, 'Reconectar cable de red'),
(9, 2022, 13, '9.09', 17, 'Verificacion de cable de red'),
(10, 2022, 6, '4.20', 18, 'Instalacion de cable de red'),
(11, 2022, 1, '0.70', 21, 'Reparacion de componentes electronicos'),
(12, 2022, 8, '5.59', 35, 'Restablecer Conexión Internet'),
(13, 2022, 2, '1.40', 38, 'entrega de cable de red'),
(14, 2022, 1, '0.70', 10, 'Escaneo y liberacion de virus a trasves de software'),
(15, 2022, 13, '9.09', 6, 'Corrección de hora y fecha'),
(16, 2022, 5, '3.50', 3, 'instalacion de impresora'),
(17, 2022, 3, '2.10', 9, 'Revisión de impresora'),
(18, 2022, 4, '2.80', 4, 'Instalación sistema operativo'),
(19, 2022, 5, '3.50', 11, 'Instalaciones de aplicaciones'),
(20, 2022, 2, '1.40', 12, 'Respaldo de informacion'),
(21, 2022, 1, '0.70', 13, 'Reconexión de Impresora'),
(22, 2022, 1, '0.70', 14, 'Reparacion de Impresora'),
(23, 2022, 2, '1.40', 25, 'Configuración de Dispositivos Tecnológico'),
(24, 2022, 1, '0.70', 5, 'Desbloqueo de clave de S.O'),
(25, 2022, 2, '1.40', 22, 'Apoyo a operativo tecnicos'),
(26, 2022, 12, '8.39', 19, 'Revisión de Componentes'),
(27, 2022, 4, '2.80', 39, 'apoyo de inventario'),
(28, 2022, 1, '0.70', 29, 'Apoyo a operaciones administrativas'),
(29, 2022, 1, '0.70', 36, 'Bloquear usuario a internet'),
(30, 2022, 1, '0.70', 27, 'Adquisición de equipos tecnológicos'),
(31, 2022, 1, '0.70', 7, 'Atasco de papel en Impresora');

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
(1, 2022, 12, '8.39', 1, 'Automatizacion, Informatica y Telecomunicaciones'),
(2, 2022, 3, '2.10', 2, 'Planificacion y Desarrollo'),
(3, 2022, 5, '3.50', 3, 'Presupuesto'),
(4, 2022, 34, '23.78', 4, 'Administracion y Finanzas'),
(5, 2022, 12, '8.39', 5, 'Educacion'),
(6, 2022, 18, '12.59', 6, 'Talento Humano'),
(7, 2022, 4, '2.80', 7, 'Auditoria Interna'),
(8, 2022, 0, '0.00', 8, 'Bienes Publicos'),
(9, 2022, 15, '10.49', 9, 'Misiones Sociales (Dimisoc)'),
(10, 2022, 0, '0.00', 10, 'Atencion al Ciudadano'),
(11, 2022, 1, '0.70', 11, 'Archivo General de Gobierno'),
(12, 2022, 10, '6.99', 12, 'Cultura'),
(13, 2022, 0, '0.00', 13, 'Juventud'),
(14, 2022, 0, '0.00', 14, 'Instituto Anzoatiguense de la salud (SALUDANZ)'),
(15, 2022, 0, '0.00', 15, 'Policía del estado Anzoátegui (Polianzoátegui)'),
(16, 2022, 0, '0.00', 16, 'Instituto Estadal de la mujer (IEMA)'),
(17, 2022, 0, '0.00', 17, 'Sistema Integrado de Gestión de Riesgo y Administración de Emergencias de Carácter Civil y Desastres del estado Anzoátegui (Sigraed)'),
(18, 2022, 0, '0.00', 18, 'Bomberos de Anzoátegui'),
(19, 2022, 0, '0.00', 19, 'Instituto de Deporte y Actividad Física (IDANZ)'),
(20, 2022, 0, '0.00', 20, 'Protección Civil'),
(21, 2022, 0, '0.00', 21, 'Instituto Autónomo de la Secretaría de los Pueblos Indígenas (IASPI)'),
(22, 2022, 0, '0.00', 22, 'Dirección de Seguridad Ciudadana'),
(23, 2022, 0, '0.00', 23, 'Dirección de Salud Pública'),
(24, 2022, 0, '0.00', 24, 'Fondo Administrado de Salud para la Gobernación del Estado Anzoátegui (FASGANZ)'),
(25, 2022, 0, '0.00', 25, 'Corporación de Vialidad e Infraestructura Gobernación del Estado Anzoátegui (COVINEA)'),
(26, 2022, 0, '0.00', 26, 'Empresa de Gestión Integral de Desechos Sólidos de Anzoátegui (EGIDSA)'),
(27, 2022, 0, '0.00', 27, 'Instituto Socialista del Transporte del estado Anzoátegui (INSOTRANZ)'),
(28, 2022, 0, '0.00', 28, 'Corporación de Turismo del estado Anzoátegui (CORANZTUR)'),
(29, 2022, 0, '0.00', 29, 'Corporación Avícola del estado Anzoátegui (CORPOVANZ)'),
(30, 2022, 0, '0.00', 30, 'Secretaría de Vivienda de la Gobernación del Estado Anzoátegui (Sevigea)'),
(31, 2022, 0, '0.00', 31, 'Corporación de Minas del estado Anzoátegui (CORPOMINAS)'),
(32, 2022, 0, '0.00', 32, 'Corporación Caupolicán Ovalles CAUPOCA'),
(33, 2022, 0, '0.00', 33, 'EPS Viviendas de Mi Patria Querida'),
(34, 2022, 0, '0.00', 34, 'Fondo de Economía Popular del estado Anzoátegui (FONDEPANZ)'),
(35, 2022, 2, '1.40', 35, 'Dirección de Comunas y Poder Popular'),
(36, 2022, 1, '0.70', 36, 'Servicio de Administración Tributaria del Estado Anzoátegui (SATEA)'),
(37, 2022, 0, '0.00', 37, 'Corporación Regional De Abastecimiento Del Estado Anzoátegui (CREANZ)'),
(38, 2022, 0, '0.00', 38, 'Corporación para el Desarrollo Rural Sustentable de Anzoátegui (CORDAGRO)'),
(39, 2022, 0, '0.00', 39, 'Corporación de Pesca (COPESCA)'),
(40, 2022, 0, '0.00', 40, 'Sociedad de Garantía Recíprocas'),
(41, 2022, 2, '1.40', 41, 'Direccion de Comunicaciones'),
(42, 2022, 4, '2.80', 42, 'Despacho del Gobernador'),
(43, 2022, 19, '13.29', 43, 'Secretaria General de Gobierno'),
(44, 2022, 1, '0.70', 44, 'Consultoria Juridica');

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
(1, 2022, 37, '25.87', 1, 'Gestion Social'),
(2, 2022, 103, '72.03', 2, 'Gestion Interna'),
(3, 2022, 0, '0.00', 3, 'Seguridad Ciudadana'),
(4, 2022, 2, '1.40', 4, 'Organizacion Ciudadana y Comunal'),
(5, 2022, 0, '0.00', 5, 'Servicios Publicos'),
(6, 2022, 1, '0.70', 6, 'Economico y Productivo');

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
(1, 2022, 31, '21.68', 1, 'Mantenimiento, rehabilitacion y mejora de equipos a nivel de hardware'),
(2, 2022, 41, '28.67', 2, 'Mantenimiento, rehabilitacion y mejora de equipos a nivel de software'),
(3, 2022, 0, '0.00', 3, 'Informes Tecnicos realizados'),
(4, 2022, 2, '1.40', 4, 'Inspecciones y diagnosticos tecnicos'),
(5, 2022, 0, '0.00', 5, 'Jornadas de formacion'),
(6, 2022, 0, '0.00', 6, 'Reuniones de trabajos realizadas'),
(7, 2022, 0, '0.00', 7, 'Sistematización y automatización de procesos'),
(8, 2022, 0, '0.00', 8, 'Aplicaciones y sistemas instalados'),
(9, 2022, 0, '0.00', 9, 'Procura, adquisicion de equipos y sistemas tecnologicos'),
(10, 2022, 69, '48.25', 10, 'Adminsitracion de sistemas de redes, plataformas y sistemas tecnologicos.');

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
(1, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10084, 'Yubiri, Fernandez', '1657373762 perfil maria alejandra.png', '2022-07-11'),
(2, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10085, 'Jesus, Villafranca', '1657373858 capitan america.png', '2022-07-11'),
(3, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10087, 'Indira, Mejias', '1657374056 perfil maria alejandra.png', '2022-07-11'),
(4, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10088, 'Alejandra, Maia', '1657374198 mujer.png', '2022-07-11'),
(5, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10090, 'Marcos, Arriojas', '1657374356 perfilthor.png', '2022-07-11'),
(6, 2022, 10, '9.60', 10, '9.60', 1, '0.96', 10091, 'Luis, Tapisquen', '1657374422 iron.png', '2022-07-25'),
(7, 2022, 4, '3.84', 4, '3.84', 3, '2.88', 10092, 'Kendrys, Garcias', '1657374577 capitan america.png', '2022-07-12'),
(8, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10093, 'Thaymi, Cisneros', '1657374889 perfill001.png', '2022-07-11'),
(9, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10094, 'Anyali, Gamardo', '1657374954 perfil002.png', '2022-07-11'),
(10, 2022, 14, '13.44', 14, '13.44', 14, '13.44', 10095, 'Edward, Guaramata', '1657375030 perfil004.png', '2022-07-12'),
(11, 2022, 14, '13.44', 14, '13.44', 1, '0.96', 10096, 'Jesus, Tocuyo', '1657375086 perfil005.png', '2022-07-13'),
(12, 2022, 11, '10.56', 11, '10.56', 1, '0.96', 10097, 'Rosalba, Matiguan', '1657375148 perfill001.png', '2022-07-27'),
(13, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10098, 'Jose, Caicaguare', '1657375299 perfil00556.png', '2022-07-11'),
(14, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10100, 'Mariana, Maestre', '1657375449 perfil0003.png', '2022-07-11'),
(15, 2022, 0, '0.00', 0, '0.00', 0, '0.00', 10102, 'Angel, Garcia', '1657375699 perfilthor.png', '2022-07-11'),
(16, 2022, 5, '4.80', 5, '4.80', 5, '4.80', 10127, 'Gabriela, Puente', '1657717581 images (1).png', '2022-07-13'),
(17, 2022, 23, '22.08', 1, '0.96', 1, '0.96', 10132, 'jesus, curbata', '1657719877 buyer-persona-termino.jpg', '2022-09-05'),
(18, 2022, 14, '13.44', 14, '13.44', 14, '13.44', 10129, 'jesus, arevalo', '1657717950 buyer-persona-termino.jpg', '2022-07-13'),
(19, 2022, 5, '4.80', 5, '4.80', 5, '4.80', 10130, 'edwin, mora', '1657718851 buyer-persona-termino.jpg', '2022-07-13');

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
(1, 1, '1657557140 impresora.png');

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
(1, 'Mantenimiento, rehabilitacion y mejora de equipos a nivel de hardware'),
(2, 'Mantenimiento, rehabilitacion y mejora de equipos a nivel de software'),
(3, 'Informes Tecnicos realizados'),
(4, 'Inspecciones y diagnosticos tecnicos'),
(5, 'Jornadas de formacion'),
(6, 'Reuniones de trabajos realizadas'),
(7, 'Sistematización y automatización de procesos'),
(8, 'Aplicaciones y sistemas instalados'),
(9, 'Procura, adquisicion de equipos y sistemas tecnologicos'),
(10, 'Adminsitracion de sistemas de redes, plataformas y sistemas tecnologicos.'),
(11, 'Diseño Grafico'),
(12, 'Apoyo Administrativo'),
(13, 'Apoyo Tecnico');

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
(4, 4, 'Bolivar', 143, '100.00', 2022),
(5, 5, 'Bruzual', 0, '0.00', 2022),
(6, 6, 'Cajigal', 0, '0.00', 2022),
(7, 7, 'Carvajal', 0, '0.00', 2022),
(8, 8, 'Urbaneja', 0, '0.00', 2022),
(9, 9, 'Freites', 0, '0.00', 2022),
(10, 10, 'Guanipa', 0, '0.00', 2022),
(11, 11, 'Guanta', 0, '0.00', 2022),
(12, 12, 'Independencia', 0, '0.00', 2022),
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
(1, 'Descripcion de la instalacion del toner', 10, 1),
(2, 'Descripcion de recarga de tinta', 45, 2),
(3, 'Descripción de Instalación sistema operativo', 25, 4),
(4, 'Descripción de instalación de impresora', 10, 3),
(5, 'Descripción Desbloqueo de clave de S.O', 20, 4),
(6, 'Descripción Corrección de hora y fecha', 18, 4),
(7, 'Descripción de atasco de papel en impresora', 15, 7),
(8, 'Descripción Inducción de Aplicaciones', 35, 4),
(9, 'Descripción Escaneo y liberación de virus a trasvés de software', 30, 4),
(10, 'Descripción Instalaciones de aplicaciones', 20, 4),
(11, 'Descripción Respaldo de informacion', 20, 4),
(12, 'Descripción de Reconexión de impresora', 45, 13),
(13, 'Descripción de reparación de impresora', 45, 14),
(14, 'Descripcion Punto de Red', 24, 15),
(15, 'Descripcion Elaboracion de cable de red', 30, 15),
(16, 'Descripcion Verificacion de cable de red', 30, 15),
(17, 'Descripcion Instalacion de cable de red', 20, 15),
(18, 'Descripcion Reconectar cable de red', 10, 15),
(19, 'Descripcion Reparacion de componentes electronicos', 20, 21),
(20, 'Descripción de Revisión de  componentes electrónico', 45, 19),
(21, 'Descripcion Apoyo a operativo tecnicos', 20, 22),
(22, 'Descripcion Peinado de cable UTP', 20, 23),
(23, 'Descripcion Tendido de cable UTP', 20, 24),
(24, 'Descripcion de Configuración de Dispositivos Tecnológico', 30, 25),
(25, 'Descripcion Ensamblar equipos de computacion', 20, 26),
(26, 'Descripcion Adquisición de equipos tecnológicos', 25, 27),
(27, 'Descripción de Diseño Grafico', 130, 28),
(28, 'Descripcion Apoyo a operaciones administrativas', 30, 29),
(29, 'Descripcion Levantamiento de informacion', 25, 30),
(30, 'Desripcion de Acceso de conectividad de pfesente', 35, 31),
(31, 'Descripcion Reuniones de trabajo', 35, 32),
(32, 'Descripción de Crear usuario en aplicaciones', 45, 33),
(33, 'Descripcion Mantenimientos de aerea de trabajos', 20, 34),
(34, 'Descripcion Bloquear usuario a internet', 10, 36),
(35, 'Descripción Restablecer Conexión Internet', 45, 35),
(36, 'Descripcion de reparacion de sistema operativo', 45, 37),
(37, 'Los cables de red pueden vincular dos equipos de manera directa o realizar la conexión entre un dispositivo y un router o un switch', 15, 16),
(38, 'descripción entrega de cable de red', 10, 16),
(39, 'Mantenimiento preventivo a equipos a nivel de software', 25, 10),
(40, 'descripción de Verificación de cable de red', 20, 17),
(41, 'entrega de cable de red', 10, 38),
(42, 'Instalacion de cable de red', 45, 18),
(43, 'Corrección de hora y fecha', 10, 6),
(44, 'Realizar cambio de bateria', 15, 6),
(45, 'Revisión de impresora', 10, 9),
(46, 'Instalación de Programas', 25, 11),
(47, 'Respaldo de informacion', 30, 12),
(48, 'Desbloqueo de clave de S.O', 10, 5),
(49, 'descripción apoyo de inventario', 34, 39),
(50, 'Reconectar cable de red', 20, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdf`
--

CREATE TABLE `pdf` (
  `pdf_id` int(11) NOT NULL,
  `asignacion_id` int(11) NOT NULL,
  `pdf_archivo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(1, 1, 1, 'se realizo el cambio de toner de manera satisfactoria', '2022-06-27 12:26:20', '2022-06-27 12:26:57'),
(2, 2, 36, 'Se desinstalaron varias aplicaciones no necesarias que estaban ejerciendo un alto consumo de recursos del equipo y esto influia en la rapidez del mismo, y con esto se mejoro la lentitud del equipo.', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(3, 3, 37, 'Se procedió a la creación de un cable de red sin ninguna novedad ni contratiempo', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(4, 4, 25, 'Se armo y preparo una PC antes pertenecientes  a Paulimer Brito', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(5, 6, 29, 'Se recolecta los datos relacionados al internet a la nueva PC del director', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(6, 7, 37, 'Se creo un cable de 5 Metros para estar conectividad con la red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(7, 8, 30, 'se le agrego dirección mac al pfsente con privilegio a redes sociales', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(8, 9, 14, 'Primero se habia hecho un cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(9, 9, 15, 'Lo realice y lo coloque juntos', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(10, 9, 16, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(11, 9, 17, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(12, 9, 18, 'Fuimos a entregarlo fue de 5 Metros', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(13, 15, 37, 'Realización de cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(14, 13, 30, 'Se requiere que le den acceso a redes sociales', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(15, 14, 25, 'Es urgente la revisión porque  presenta fallas electricas', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(16, 19, 14, 'entregar cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(17, 22, 19, 'Se reviso el teclado se le cambio el conector pero a un asi esta defectuoso el teclado', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(18, 23, 35, 'Dirección MAC agregada en Pfsenser serial MXL1431JP6', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(19, 27, 14, 'entrega de cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(20, 27, 15, 'entrega de cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(21, 27, 16, 'entrega de cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(22, 27, 17, 'entrega de cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(23, 27, 18, 'entrega de cable de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(24, 35, 14, 'se le busco el punto de red mas cercano al schich para dar conectividad al cuarto de rack', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(25, 35, 15, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(26, 35, 16, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(27, 34, 39, 'se realizo respectivo mantenimiento de software a la computadora', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(28, 36, 14, 'Verificar los puntos los cuales no estan activos', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(29, 36, 15, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(30, 36, 16, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(31, 36, 17, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(32, 36, 18, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(33, 35, 17, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(34, 35, 17, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(35, 35, 18, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(36, 32, 40, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(37, 30, 41, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(38, 20, 42, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(39, 38, 30, 'Equipo sin internet', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(40, 17, 40, 'Verificar cada proceso que hay con los cables', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(41, 18, 40, 'Verificar cada cable que permite acceso a un punto de red', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(42, 39, 25, 'Colocor emsamblar los equipos', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(43, 40, 40, 'la computadora no tenia acceso a Internet, el cable de red estaba flojo y se ajusto de forma manual', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(44, 41, 43, 'Corrección de hora y fecha', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(45, 42, 43, 'Se procede a reemplazar la batería de la tarjeta madre y a configurar la hora', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(46, 42, 44, 'se realizo el cambio de bateria', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(47, 44, 30, 'Se activo y desactivo conexión a internet en el equipo', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(48, 45, 1, 'Limpie el aerea de la impresora y instale el toner', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(49, 46, 40, 'la computadora que tiene acceso a la impresora no tenia red (conexion) el cable de red estaba flojo y una punta sin seguro se reemplazo la punta y se logro acceder a la impresora, con impresión lograda', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(50, 47, 4, 'Se compartio conexion de una impresora a una pc', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(51, 48, 45, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(52, 49, 3, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(53, 49, 5, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(54, 49, 6, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(55, 49, 8, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(56, 49, 9, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(57, 49, 10, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(58, 49, 11, 'Desintalacion e instalacion de paqueteria de office a una nueva version', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(59, 50, 43, 'El equipo presentaba hora y fecha erronea', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(60, 50, 44, 'Se procedio a corregir mediante privilegios de administrador', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(61, 53, 35, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(62, 51, 30, 'se revisa la configuración de red a un equipo que no tenia conexión a Internet, se reinicia el dispositivo para obtener una nueva IP', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(63, 54, 3, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(64, 54, 3, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(65, 54, 3, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(66, 54, 5, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(67, 54, 6, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(68, 54, 8, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(69, 54, 9, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(70, 54, 10, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(71, 52, 46, 'Se instalo un sistema a petición del Director se necesitaban los privilegios de administración y se realizo satisfactoriamente', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(72, 54, 11, 'El equipo presentaba fallas al reiniciar el sistema operativo luego de intentar varios metodos', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(73, 55, 47, 'Respaldo de informacion', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(74, 56, 45, 'Problemas de conexión con la impresora', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(75, 57, 13, 'Emsamblaje y pruebas', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(76, 58, 42, 'Instalacion para video conferencias', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(77, 60, 35, 'Descripción Restablecer Conexión Internet', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(78, 61, 36, 'reparacion de sistema operativo', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(79, 62, 24, 'Realizar respaldo, instalar software y app informaticas', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(80, 63, 30, 'Conectividad', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(81, 64, 36, 'Se a determinado que la tarjeta madre esta dañada', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(82, 65, 14, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(83, 65, 15, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(84, 65, 16, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(85, 65, 17, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(86, 65, 18, 'Se ubico', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(87, 66, 14, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(88, 66, 15, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(89, 66, 16, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(90, 66, 17, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(91, 66, 18, '', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(92, 67, 48, 'Se cambio la clave al usuario', '2022-06-12 09:49:51', '2022-06-12 09:58:51'),
(93, 68, 43, 'Se ingreso la contraseña para poder confirgurar la fecha y hora de la pc', '2022-07-13 09:51:28', '2022-07-13 09:51:51'),
(94, 68, 44, '', '2022-07-13 09:51:52', '2022-07-13 09:51:55'),
(95, 70, 43, 'Se ingreso la contraseña para configurar la fecha y hora de la pc', '2022-07-13 10:02:48', '2022-07-13 10:03:14'),
(96, 70, 44, '', '2022-07-13 10:03:20', '2022-07-13 10:03:24'),
(97, 71, 21, 'Apoyo a operativo tecnicos', '2022-07-13 10:04:17', '2022-07-13 10:04:28'),
(98, 75, 20, '', '2022-07-13 10:19:52', '2022-07-13 10:19:55'),
(99, 74, 47, 'Se respaldo la info de un disco duro a un pendrive', '2022-07-13 10:19:44', '2022-07-13 10:20:02'),
(100, 76, 35, '', '2022-07-13 10:25:09', '2022-07-13 10:25:12'),
(101, 77, 4, '', '2022-07-13 10:25:24', '2022-07-13 10:25:27'),
(102, 78, 20, 'se reparo fuente de poder tenia condesadores abordados', '2022-07-13 10:29:22', '2022-07-13 10:30:08'),
(103, 79, 20, 'Revisión de componentes electrónico', '2022-07-13 10:36:34', '2022-07-13 10:36:44'),
(104, 81, 20, 'Apoyar al mantenimiento de Hardware se utilizo una sopladora', '2022-07-13 10:47:30', '2022-07-13 10:48:00'),
(105, 83, 49, 'Apoyo al mantenimiento de aerea de inventario', '2022-07-13 10:52:41', '2022-07-13 10:52:59'),
(106, 82, 50, 'Colocar 3 cables de un FxB para darle conexión a 3 departamentos', '2022-07-13 10:54:54', '2022-07-13 10:55:30'),
(107, 80, 35, 'Colocar 3 cables de FxB para darle conexión a 3 dptos', '2022-07-13 10:56:16', '2022-07-13 10:56:41'),
(108, 85, 36, 'Revision de equipos tuvo un problema en la fuente de poder y se le hizo un cambio de fuente de poder', '2022-07-13 10:55:53', '2022-07-13 10:57:00'),
(109, 84, 49, '', '2022-07-13 10:58:30', '2022-07-13 10:58:33'),
(110, 86, 42, '', '2022-07-13 11:02:18', '2022-07-13 11:02:22'),
(111, 87, 46, 'Se desisntalo el equipo de oficce por una version actualizada por que la version que tenia ocupaba mucho espacio y estaba un poco lenta', '2022-07-13 11:03:21', '2022-07-13 11:04:17'),
(112, 89, 40, '', '2022-07-13 11:08:05', '2022-07-13 11:08:08'),
(113, 90, 40, '', '2022-07-13 11:08:19', '2022-07-13 11:08:23'),
(114, 88, 43, 'El sistema operativa no conecto con una red de internet', '2022-07-13 11:08:06', '2022-07-13 11:08:26'),
(115, 88, 44, 'Tuvimos que prender y apagar y revisar a ver si no tenia otra falla', '2022-07-13 11:08:27', '2022-07-13 11:08:48'),
(116, 91, 43, 'Cambio de fecha', '2022-07-13 11:10:50', '2022-07-13 11:10:55'),
(117, 91, 44, 'Cambio de hora', '2022-07-13 11:10:57', '2022-07-13 11:11:03'),
(118, 92, 43, '', '2022-07-13 11:11:48', '2022-07-13 11:11:51'),
(119, 92, 44, '', '2022-07-13 11:11:52', '2022-07-13 11:11:55'),
(120, 93, 46, 'Activamos el paquete office 2016 y le hicimos un cambio a la unid de sistemas', '2022-07-13 11:13:09', '2022-07-13 11:13:54'),
(121, 94, 37, 'Elaboracion de cable de red', '2022-07-13 11:14:16', '2022-07-13 11:14:26'),
(122, 94, 38, 'Luego entregar el cable de red a la direccion de AIT', '2022-07-13 11:14:27', '2022-07-13 11:14:44'),
(123, 95, 37, 'elaboración de cable de red', '2022-07-13 11:14:34', '2022-07-13 11:14:50'),
(124, 95, 38, '', '2022-07-13 11:14:51', '2022-07-13 11:14:54'),
(125, 96, 29, 'Respaldar una informacion de una lapto', '2022-07-13 11:17:24', '2022-07-13 11:17:43'),
(126, 97, 43, 'Cambiar hora y fecha para obtener internet', '2022-07-13 11:19:47', '2022-07-13 11:20:06'),
(127, 97, 44, 'Cambiar la fecha  y la hora para tener acceso a la red de internet', '2022-07-13 11:20:07', '2022-07-13 11:20:11'),
(128, 98, 46, 'instalar programa de access 2010', '2022-07-13 11:20:06', '2022-07-13 11:20:35'),
(129, 99, 41, 'Entrega de cable de 5 Metros para la conexión de Internet', '2022-07-13 11:22:28', '2022-07-13 11:22:31'),
(130, 100, 20, '', '2022-07-13 11:34:54', '2022-07-13 11:34:56'),
(131, 102, 21, 'Se realizo un cable UTP', '2022-07-13 11:34:57', '2022-07-13 11:35:07'),
(132, 101, 35, '', '2022-07-13 11:35:19', '2022-07-13 11:35:22'),
(133, 104, 28, 'Se le hizo cambio de toner por uno nuevo de la impresora y se comprobo su funcion', '2022-07-13 11:40:30', '2022-07-13 11:41:01'),
(134, 105, 43, '', '2022-07-13 11:41:52', '2022-07-13 11:41:55'),
(135, 105, 44, '', '2022-07-13 11:41:56', '2022-07-13 11:41:59'),
(136, 106, 4, 'Se le dio conexion inalambrica a una pc', '2022-07-13 11:43:07', '2022-07-13 11:43:30'),
(137, 107, 49, 'apoyo de mantenimiento', '2022-07-13 11:47:03', '2022-07-13 11:47:15'),
(138, 108, 20, 'revisar fuente de poder', '2022-07-13 11:53:15', '2022-07-13 11:53:38'),
(139, 109, 20, 'revisar cpu caracte de urgenecia', '2022-07-13 11:53:55', '2022-07-13 11:54:37'),
(140, 110, 4, 'Se instalo una impresora y conexiones a red. Se tomaron las MAC de las pc para agregarlas a Pfsence', '2022-07-13 11:56:16', '2022-07-13 11:57:06'),
(141, 69, 14, 'Configurar hora y fecha', '2022-07-13 11:57:18', '2022-07-13 11:57:30'),
(142, 69, 15, '', '2022-07-13 11:57:32', '2022-07-13 11:57:37'),
(143, 69, 16, '', '2022-07-13 11:57:39', '2022-07-13 11:57:41'),
(144, 69, 17, '', '2022-07-13 11:57:43', '2022-07-13 11:57:45'),
(145, 69, 18, '', '2022-07-13 11:57:46', '2022-07-13 11:57:50'),
(146, 111, 34, 'Usuario no lograba desbloquear su computadora procedi a indicarle como debe hacer para desbloquear su cuenta', '2022-07-13 11:58:38', '2022-07-13 11:59:45'),
(147, 112, 46, 'Se instalo un sistema operativo a disco duro de prueba', '2022-07-13 12:03:33', '2022-07-13 12:03:55'),
(148, 113, 26, 'Se registro una laptop a la red de wifi de su departamento', '2022-07-13 12:03:41', '2022-07-13 12:04:01'),
(149, 114, 35, '', '2022-06-01 12:35:48', '2022-06-03 12:35:48'),
(150, 115, 7, 'Se removio papel en la impresora', '2022-06-03 12:47:34', '2022-06-03 12:47:34'),
(151, 116, 4, 'conectar impresoras', '2022-06-03 12:57:08', '2022-06-03 12:57:08'),
(152, 117, 45, 'Es necesario que revises la impresora', '2022-06-02 13:07:09', '2022-06-02 13:07:09'),
(153, 118, 43, 'actividad realizada con exito', '2022-05-10 10:41:03', '2022-05-10 10:41:03'),
(154, 118, 44, 'listo', '2022-05-10 10:41:51', '2022-05-10 10:41:51'),
(155, 119, 30, 'asginacion realizada', '2022-05-15 12:49:14', '2022-05-15 12:49:14'),
(156, 120, 30, 'listo asignacion', '2022-09-05 06:43:43', '2022-09-05 06:43:43');

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

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_unidad`, `producto_precio`, `producto_stock`, `producto_foto`, `kategoria_id`, `usuario_id`) VALUES
(1, '0992332ASD', 'impresora', 'und', '230.00', '1.00', '', 2, 1);

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
(6, 'casco central', 6);

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
(1, 10107, '2022-06-27 12:05:56', 'finalizado', 'Cambio de toner de la impresora'),
(2, 10107, '2022-06-12 09:41:51', 'finalizado', 'Revision y reparacion de mi computadora, muestra mucha lentitud, mas de lo habitual'),
(3, 10107, '2022-06-12 09:41:51', 'finalizado', 'Necesito un cable de Red'),
(4, 10107, '2022-06-12 09:41:51', 'finalizado', 'Requiero un chequeo de un punto de red'),
(5, 10112, '2022-06-12 09:41:51', 'finalizado', 'Requiero de mantenimiento de hardware'),
(6, 10106, '2022-06-12 09:41:51', 'finalizado', 'Se requiere revisar equipos'),
(7, 10121, '2022-06-12 09:41:51', 'finalizado', 'se requiere recaudar datos del equipo'),
(8, 10121, '2022-06-12 09:41:51', 'finalizado', 'Recaulacion de datos de internet'),
(9, 10121, '2022-06-12 09:41:51', 'finalizado', 'Recaudacion de datos en equipos'),
(10, 10114, '2022-06-12 09:41:51', 'finalizado', 'Realizacion de cable de red'),
(11, 10107, '2022-06-12 09:41:51', 'finalizado', 'Entregas de cable de red'),
(12, 10112, '2022-06-12 09:41:51', 'finalizado', 'mantenimiento del equipo'),
(13, 10114, '2022-06-12 09:41:51', 'finalizado', 'Realización de punto de red'),
(14, 10103, '2022-06-12 09:41:51', 'finalizado', 'Verificación de cable de red'),
(15, 10105, '2022-06-12 09:41:51', 'finalizado', 'Busqueda de puntos de red'),
(17, 10120, '2022-06-12 09:41:51', 'finalizado', 'Arreglo de teclado'),
(18, 10120, '2022-06-12 09:41:51', 'finalizado', 'No tengo conexión a Internet'),
(19, 10103, '2022-06-12 09:41:51', 'finalizado', 'verificación de cable de red'),
(20, 10107, '2022-06-12 09:41:51', 'finalizado', 'entrega de cable de red'),
(21, 10120, '2022-06-12 09:41:51', 'finalizado', 'Verificar los Puntos de Internet'),
(22, 10103, '2022-06-12 09:41:51', 'finalizado', 'ubicación de punto de red'),
(23, 10107, '2022-06-12 09:41:51', 'finalizado', 'Necesito una limpieza al sistema operativo de mi computador'),
(24, 10108, '2022-06-12 09:41:51', 'finalizado', 'Equipo sin internet'),
(26, 10122, '2022-06-12 09:41:51', 'finalizado', 'Necesito la revisión de un cable de red'),
(27, 10112, '2022-06-12 09:41:51', 'finalizado', 'Cambio de hora y fecha'),
(28, 10120, '2022-06-12 09:41:51', 'finalizado', 'Tengo problemas con la hora y fecha'),
(29, 10108, '2022-06-12 09:41:51', 'finalizado', 'Equipo sin internet'),
(30, 10107, '2022-06-12 09:41:51', 'finalizado', 'Instalacion de Toner'),
(31, 10123, '2022-06-12 09:41:51', 'finalizado', 'La impresora no me da señal'),
(32, 10106, '2022-06-12 09:41:51', 'finalizado', 'revisión de impresora'),
(33, 10107, '2022-06-12 09:41:51', 'finalizado', 'Conexion de impresora a una pc'),
(34, 10112, '2022-06-12 09:41:51', 'finalizado', 'Instalacion de paqueteria office 2010'),
(35, 10110, '2022-06-12 09:41:51', 'finalizado', 'Necesito una revisión de conexión a Internet e instalación de programas'),
(36, 10118, '2022-06-12 09:41:51', 'finalizado', 'Correcion de hora y fecha'),
(37, 10106, '2022-06-12 09:41:51', 'finalizado', 'crear contraseñas'),
(38, 10115, '2022-06-12 09:41:51', 'finalizado', 'Reinstalacion de windows 10 y respaldo'),
(39, 10110, '2022-06-12 09:41:51', 'finalizado', 'respaldo de información'),
(40, 10105, '2022-06-12 09:41:51', 'finalizado', 'Revisión de impresora'),
(41, 10120, '2022-06-12 09:41:51', 'finalizado', 'Reparacion de impresora'),
(42, 10105, '2022-06-12 09:41:51', 'finalizado', 'Instalar Software y respaldo a mi pc'),
(43, 10112, '2022-06-12 09:41:51', 'finalizado', 'Instalacion de Router'),
(44, 10111, '2022-06-12 09:41:51', 'finalizado', 'Reconeccion de internet'),
(45, 10113, '2022-06-12 09:41:51', 'finalizado', 'Reparacion de sistema operativo'),
(46, 10105, '2022-06-12 09:41:51', 'finalizado', 'Configuracion de Red'),
(47, 10120, '2022-06-12 09:41:51', 'finalizado', 'Ubicar puntos de red'),
(48, 10112, '2022-06-12 09:41:51', 'finalizado', 'chequeo de PC en secretaria'),
(49, 10120, '2022-06-12 09:41:51', 'finalizado', 'verificación de punto de red'),
(50, 10105, '2022-06-12 09:41:51', 'finalizado', 'Cambiar clave'),
(52, 10118, '2022-07-13 09:47:17', 'finalizado', 'Se me desconfiguro la fecha y hora'),
(53, 10120, '2022-07-13 10:00:37', 'finalizado', 'Se me desconfiguro la fecha y hora'),
(54, 10132, '2022-07-13 10:00:39', 'finalizado', 'apoyo a los tecnicos de tecnosystem'),
(55, 10112, '2022-07-13 10:06:47', 'finalizado', 'revisión de equipos'),
(56, 10110, '2022-07-13 10:18:30', 'finalizado', 'Respaldo de informacion'),
(57, 10105, '2022-07-13 10:22:34', 'finalizado', 'apoyo de instalación de impresora'),
(58, 10103, '2022-07-13 10:27:53', 'finalizado', 'reparación de fuente de poder'),
(59, 10112, '2022-07-13 10:32:52', 'finalizado', 'mantenimiento de hardware'),
(60, 10114, '2022-07-13 10:37:17', 'finalizado', 'Apoyo a Tecno Sistem'),
(61, 10105, '2022-07-13 10:46:09', 'finalizado', 'Mantenimiento de Hardware'),
(62, 10105, '2022-07-13 10:51:09', 'finalizado', 'Inventario Apoyo'),
(63, 10114, '2022-07-13 10:52:22', 'finalizado', 'apoyo de inventario'),
(64, 10103, '2022-07-13 10:54:38', 'finalizado', 'Revision del equipo'),
(65, 10121, '2022-07-13 10:57:35', 'finalizado', 'recaudación de datos de internet'),
(66, 10107, '2022-07-13 11:00:31', 'finalizado', 'instalación de cable de red'),
(67, 10112, '2022-07-13 11:01:13', 'finalizado', 'Cambio de paquete de Oficce'),
(68, 10103, '2022-07-13 11:04:05', 'finalizado', 'verificación de cable de red'),
(69, 10103, '2022-07-13 11:05:09', 'finalizado', 'verificación de cable de red'),
(70, 10105, '2022-07-13 11:06:14', 'finalizado', 'Cambio de fecha y hora'),
(71, 10120, '2022-07-13 11:09:53', 'finalizado', 'Cambio de fecha y  hora'),
(72, 10118, '2022-07-13 11:10:23', 'finalizado', 'configuración de fecha y hora'),
(73, 10118, '2022-07-13 11:11:59', 'finalizado', 'Actualizar office'),
(74, 10114, '2022-07-13 11:13:09', 'finalizado', 'Cable de red'),
(75, 10114, '2022-07-13 11:13:30', 'finalizado', 'elaboración de cable de red'),
(76, 10121, '2022-07-13 11:16:28', 'finalizado', 'Apoyo a respaldar una informacion'),
(77, 10110, '2022-07-13 11:18:24', 'finalizado', 'instalación de access 2010'),
(78, 10105, '2022-07-13 11:18:38', 'finalizado', 'Cambio fecha y hora'),
(79, 10107, '2022-07-13 11:21:26', 'finalizado', 'Entrega de cable de red'),
(80, 10105, '2022-07-13 11:23:32', 'finalizado', 'mantenimiento de hardware'),
(81, 10133, '2022-07-13 11:31:39', 'finalizado', 'Apoyo a tecnosystem'),
(82, 10112, '2022-07-13 11:37:20', 'finalizado', 'configuración de hora y fecha'),
(83, 10107, '2022-07-13 11:39:30', 'finalizado', 'Apoyo para instalar'),
(84, 10107, '2022-07-13 11:42:07', 'finalizado', 'Apoyo para impresora'),
(85, 10089, '2022-07-13 11:43:46', 'finalizado', 'apoyo de inventario'),
(86, 10103, '2022-07-13 11:47:17', 'finalizado', 'revision de fuente de poder'),
(87, 10103, '2022-07-13 11:50:47', 'finalizado', 'revisión de cpu'),
(88, 10105, '2022-07-13 11:54:33', 'finalizado', 'Instalar impresora por favor'),
(89, 10113, '2022-07-13 11:56:59', 'finalizado', 'Desbloqueo de usuario'),
(91, 10114, '2022-07-13 12:02:14', 'finalizado', 'Instalar sistema operativo'),
(92, 10112, '2022-07-13 12:02:45', 'finalizado', 'Conectar a laptop a red de wifi'),
(93, 10108, '2022-06-03 12:29:17', 'finalizado', 'problemas con internet'),
(95, 10106, '2022-06-03 12:44:20', 'finalizado', 'La impresora esta atascada'),
(96, 10111, '2022-06-03 12:54:02', 'finalizado', 'apoyo para conectar impresora'),
(97, 10109, '2022-06-02 13:04:23', 'finalizado', 'revision de impresora'),
(98, 10107, '2022-05-10 09:21:56', 'evaluar', 'Revision de la hora en mi computadora'),
(99, 10121, '2022-04-14 12:44:31', 'finalizado', 'hablar con el gobernador'),
(100, 10107, '2022-09-05 06:36:15', 'evaluar', 'para probar las asignaciones que estan pendiente'),
(101, 10107, '2022-09-05 07:07:40', 'procesando', 'probar asignacion'),
(102, 10107, '2022-09-05 07:33:02', 'sin procesar', 'probando nueva solicitud'),
(103, 10108, '2022-09-05 07:46:57', 'procesando', 'revision de mi conexion a internet'),
(104, 10107, '2022-09-05 07:47:25', 'sin procesar', 'agregar nueva solicitud de actividad, conexion a internet'),
(105, 10107, '2022-09-05 07:50:39', 'sin procesar', 'agregar nueva solicitud de actividad, conexion a internet'),
(106, 10092, '2022-09-05 12:28:48', 'sin procesar', 'solicitud de prueba'),
(107, 10107, '2022-09-05 12:37:55', 'sin procesar', 'realizar prueba angel'),
(108, 10097, '2022-09-11 16:11:17', 'sin procesar', 'chequeando');

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
(2, 1, 1, 'finalizado', '2022-06-12 09:45:51'),
(4, 2, 37, 'finalizado', '2022-06-12 09:45:51'),
(8, 3, 16, 'finalizado', '2022-06-12 09:45:51'),
(12, 5, 26, 'finalizado', '2022-06-12 09:45:51'),
(14, 6, 26, 'finalizado', '2022-06-12 09:45:51'),
(18, 8, 30, 'finalizado', '2022-06-12 09:45:51'),
(21, 7, 31, 'finalizado', '2022-06-12 09:45:51'),
(26, 10, 16, 'finalizado', '2022-06-12 09:45:51'),
(27, 9, 31, 'finalizado', '2022-06-12 09:45:51'),
(31, 12, 26, 'finalizado', '2022-06-12 09:45:51'),
(33, 13, 16, 'finalizado', '2022-06-12 09:45:51'),
(38, 14, 17, 'finalizado', '2022-06-12 09:45:51'),
(42, 15, 17, 'finalizado', '2022-06-12 09:45:51'),
(45, 4, 18, 'finalizado', '2022-06-12 09:45:51'),
(46, 4, 15, 'finalizado', '2022-06-12 09:45:51'),
(48, 17, 21, 'finalizado', '2022-06-12 09:45:51'),
(53, 11, 18, 'finalizado', '2022-06-12 09:45:51'),
(54, 11, 15, 'finalizado', '2022-06-12 09:45:51'),
(55, 18, 31, 'finalizado', '2022-06-12 09:45:51'),
(56, 18, 35, 'finalizado', '2022-06-12 09:45:51'),
(63, 20, 38, 'finalizado', '2022-06-12 09:45:51'),
(64, 19, 17, 'finalizado', '2022-06-12 09:45:51'),
(67, 21, 15, 'finalizado', '2022-06-12 09:45:51'),
(70, 22, 15, 'finalizado', '2022-06-12 09:45:51'),
(71, 23, 10, 'finalizado', '2022-06-12 09:45:51'),
(77, 24, 31, 'finalizado', '2022-06-12 09:45:51'),
(79, 26, 17, 'finalizado', '2022-06-12 09:45:51'),
(81, 27, 6, 'finalizado', '2022-06-12 09:45:51'),
(83, 28, 6, 'finalizado', '2022-06-12 09:45:51'),
(86, 29, 31, 'finalizado', '2022-06-12 09:45:51'),
(88, 30, 1, 'finalizado', '2022-06-12 09:45:51'),
(90, 31, 17, 'finalizado', '2022-06-12 09:45:51'),
(93, 33, 3, 'finalizado', '2022-06-12 09:45:51'),
(94, 32, 9, 'finalizado', '2022-06-12 09:45:51'),
(96, 34, 4, 'finalizado', '2022-06-12 09:45:51'),
(99, 35, 31, 'finalizado', '2022-06-12 09:45:51'),
(100, 35, 11, 'finalizado', '2022-06-12 09:45:51'),
(102, 36, 6, 'finalizado', '2022-06-12 09:45:51'),
(105, 37, 20, 'finalizado', '2022-06-12 09:45:51'),
(106, 37, 35, 'finalizado', '2022-06-12 09:45:51'),
(108, 38, 4, 'finalizado', '2022-06-12 09:45:51'),
(110, 39, 12, 'finalizado', '2022-06-12 09:45:51'),
(113, 40, 13, 'finalizado', '2022-06-12 09:45:51'),
(114, 40, 9, 'finalizado', '2022-06-12 09:45:51'),
(116, 41, 14, 'finalizado', '2022-06-12 09:45:51'),
(120, 43, 18, 'finalizado', '2022-06-12 09:45:51'),
(124, 44, 35, 'finalizado', '2022-06-12 09:45:51'),
(127, 45, 37, 'finalizado', '2022-06-12 09:45:51'),
(128, 42, 25, 'finalizado', '2022-06-12 09:45:51'),
(129, 42, 4, 'finalizado', '2022-06-12 09:45:51'),
(131, 46, 31, 'finalizado', '2022-06-12 09:45:51'),
(134, 47, 15, 'finalizado', '2022-06-12 09:45:51'),
(136, 48, 37, 'finalizado', '2022-06-12 09:45:51'),
(139, 50, 5, 'finalizado', '2022-06-12 09:45:51'),
(140, 49, 15, 'finalizado', '2022-07-13 11:57:56'),
(143, 52, 6, 'finalizado', '2022-07-13 09:52:05'),
(146, 53, 6, 'finalizado', '2022-07-13 10:03:35'),
(147, 54, 22, 'finalizado', '2022-07-13 10:04:34'),
(154, 55, 19, 'finalizado', '2022-07-13 10:20:00'),
(156, 56, 12, 'finalizado', '2022-07-13 10:20:09'),
(159, 57, 3, 'finalizado', '2022-07-13 10:25:32'),
(160, 57, 35, 'finalizado', '2022-07-13 10:25:18'),
(162, 58, 19, 'finalizado', '2022-07-13 10:30:15'),
(164, 59, 19, 'finalizado', '2022-07-13 10:36:50'),
(167, 60, 20, 'finalizado', '2022-07-13 10:55:40'),
(168, 60, 35, 'finalizado', '2022-07-13 10:56:47'),
(170, 61, 19, 'finalizado', '2022-07-13 10:48:05'),
(173, 62, 39, 'finalizado', '2022-07-13 10:53:05'),
(175, 63, 39, 'finalizado', '2022-07-13 10:58:39'),
(177, 64, 37, 'finalizado', '2022-07-13 10:57:04'),
(179, 65, 35, 'finalizado', '2022-07-13 11:35:26'),
(182, 66, 18, 'finalizado', '2022-07-13 11:02:30'),
(183, 67, 11, 'finalizado', '2022-07-13 11:04:23'),
(186, 69, 17, 'finalizado', '2022-07-13 11:08:30'),
(188, 70, 6, 'finalizado', '2022-07-13 11:08:53'),
(189, 68, 17, 'finalizado', '2022-07-13 11:08:13'),
(191, 71, 6, 'finalizado', '2022-07-13 11:11:08'),
(193, 72, 6, 'finalizado', '2022-07-13 11:12:00'),
(195, 73, 11, 'finalizado', '2022-07-13 11:14:05'),
(198, 74, 16, 'finalizado', '2022-07-13 11:14:51'),
(199, 75, 16, 'finalizado', '2022-07-13 11:14:59'),
(201, 76, 30, 'finalizado', '2022-07-13 11:17:50'),
(204, 77, 11, 'finalizado', '2022-07-13 11:20:40'),
(205, 78, 6, 'finalizado', '2022-07-13 11:20:15'),
(207, 79, 38, 'finalizado', '2022-07-13 11:22:37'),
(209, 80, 19, 'finalizado', '2022-07-13 11:35:02'),
(211, 81, 22, 'finalizado', '2022-07-13 11:35:14'),
(215, 83, 29, 'finalizado', '2022-07-13 11:41:06'),
(217, 82, 6, 'finalizado', '2022-07-13 11:42:05'),
(219, 84, 3, 'finalizado', '2022-07-13 11:43:35'),
(221, 85, 39, 'finalizado', '2022-07-13 11:47:20'),
(223, 86, 19, 'finalizado', '2022-07-13 11:53:46'),
(225, 87, 19, 'finalizado', '2022-07-13 11:54:48'),
(227, 88, 3, 'finalizado', '2022-07-13 11:57:13'),
(230, 89, 36, 'finalizado', '2022-07-13 11:59:57'),
(232, 91, 11, 'finalizado', '2022-07-13 12:04:14'),
(234, 92, 27, 'finalizado', '2022-07-13 12:04:06'),
(236, 93, 35, 'finalizado', '2022-06-03 12:40:10'),
(239, 95, 7, 'finalizado', '2022-07-13 12:47:42'),
(241, 96, 3, 'finalizado', '2022-06-03 12:57:20'),
(243, 97, 9, 'finalizado', '2022-06-02 13:07:22'),
(245, 98, 6, 'finalizado', '2022-05-10 10:42:06'),
(247, 99, 31, 'finalizado', '2022-04-15 12:49:29'),
(249, 100, 31, 'finalizado', '2022-09-05 06:43:59'),
(251, 101, 31, 'asignado', '0000-00-00 00:00:00'),
(252, 102, 31, 'sin asginar', '0000-00-00 00:00:00'),
(253, 103, 31, 'sin asignar', '0000-00-00 00:00:00'),
(254, 108, 31, 'sin asginar', '0000-00-00 00:00:00');

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
(1, 1, 4),
(2, 2, 4),
(3, 3, 2),
(4, 5, 43),
(5, 6, 4),
(6, 7, 12),
(7, 8, 12),
(8, 9, 12),
(9, 10, 1),
(10, 11, 4),
(11, 12, 43),
(12, 13, 1),
(13, 14, 9),
(14, 15, 6),
(15, 4, 4),
(16, 17, 5),
(17, 18, 5),
(18, 19, 9),
(19, 20, 4),
(20, 21, 5),
(21, 22, 9),
(22, 23, 4),
(23, 24, 4),
(24, 25, 4),
(25, 26, 35),
(26, 27, 43),
(27, 28, 5),
(28, 29, 4),
(29, 30, 4),
(30, 31, 35),
(31, 33, 4),
(32, 32, 4),
(33, 34, 43),
(34, 35, 3),
(35, 36, 7),
(36, 37, 4),
(37, 38, 11),
(38, 39, 3),
(39, 40, 6),
(40, 41, 5),
(41, 43, 43),
(42, 44, 42),
(43, 42, 6),
(44, 45, 41),
(45, 46, 6),
(46, 47, 5),
(47, 48, 43),
(48, 50, 6),
(49, 49, 5),
(50, 52, 7),
(51, 53, 5),
(52, 54, 1),
(53, 55, 43),
(54, 56, 3),
(55, 57, 6),
(56, 58, 9),
(57, 59, 43),
(58, 60, 1),
(59, 61, 44),
(60, 62, 6),
(61, 63, 1),
(62, 64, 9),
(63, 65, 12),
(64, 66, 4),
(65, 67, 43),
(66, 69, 9),
(67, 70, 6),
(68, 68, 9),
(69, 71, 5),
(70, 72, 7),
(71, 73, 7),
(72, 74, 1),
(73, 75, 1),
(74, 76, 12),
(75, 77, 3),
(76, 78, 6),
(77, 79, 4),
(78, 80, 6),
(79, 81, 36),
(80, 82, 43),
(81, 83, 4),
(82, 84, 4),
(83, 85, 1),
(84, 86, 9),
(85, 87, 9),
(86, 88, 6),
(87, 89, 41),
(88, 91, 1),
(89, 92, 43),
(90, 93, 4),
(91, 95, 4),
(92, 96, 42),
(93, 97, 4),
(94, 98, 4),
(95, 99, 42),
(96, 100, 1),
(97, 101, 1),
(98, 103, 4);

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
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 5, 2),
(5, 6, 2),
(6, 7, 1),
(7, 8, 1),
(8, 9, 1),
(9, 10, 2),
(10, 11, 2),
(11, 12, 2),
(12, 13, 2),
(13, 14, 1),
(14, 15, 2),
(15, 4, 2),
(16, 17, 1),
(17, 18, 1),
(18, 19, 1),
(19, 20, 2),
(20, 21, 1),
(21, 22, 1),
(22, 23, 2),
(23, 24, 2),
(24, 25, 2),
(25, 26, 4),
(26, 27, 2),
(27, 28, 1),
(28, 29, 2),
(29, 30, 2),
(30, 31, 4),
(31, 33, 2),
(32, 32, 2),
(33, 34, 2),
(34, 35, 2),
(35, 36, 2),
(36, 37, 2),
(37, 38, 2),
(38, 39, 2),
(39, 40, 2),
(40, 41, 1),
(41, 43, 2),
(42, 44, 2),
(43, 42, 2),
(44, 45, 2),
(45, 46, 2),
(46, 47, 1),
(47, 48, 2),
(48, 50, 2),
(49, 49, 1),
(50, 52, 2),
(51, 53, 1),
(52, 54, 2),
(53, 55, 2),
(54, 56, 2),
(55, 57, 2),
(56, 58, 1),
(57, 59, 2),
(58, 60, 2),
(59, 61, 2),
(60, 62, 2),
(61, 63, 2),
(62, 64, 1),
(63, 65, 1),
(64, 66, 2),
(65, 67, 2),
(66, 69, 1),
(67, 70, 2),
(68, 68, 1),
(69, 71, 1),
(70, 72, 2),
(71, 73, 2),
(72, 74, 2),
(73, 75, 2),
(74, 76, 1),
(75, 77, 2),
(76, 78, 2),
(77, 79, 2),
(78, 80, 2),
(79, 81, 6),
(80, 82, 2),
(81, 83, 2),
(82, 84, 2),
(83, 85, 2),
(84, 86, 1),
(85, 87, 1),
(86, 88, 2),
(87, 89, 2),
(88, 91, 2),
(89, 92, 2),
(90, 93, 2),
(91, 95, 2),
(92, 96, 2),
(93, 97, 2),
(94, 98, 2),
(95, 99, 2),
(96, 100, 2),
(97, 101, 2),
(98, 103, 2);

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
(1, 'Angelica Delgado', 'Solicitud de Medicamentos', '21389116', '2022-07-26 16:01:45', '2022-07-26', 'finalizado'),
(2, 'Angelica Delgado', 'Solicitud de Audiencia con el director de atencion al ciudadano', '21389116', '2022-07-26 16:02:16', '2022-07-26', 'finalizado'),
(4, 'ANgelica Delgado', 'realizar solicitud', '21389116', '2022-07-27 16:07:11', '2022-07-27', 'finalizar'),
(5, 'dfsdfsdf', 'fdsfsdfsf', '213889123', '2022-07-26 22:27:54', '2022-07-26', 'finalizado'),
(7, 'Juan Garcia', 'visita a la gobernacion', '23324324', '2022-07-26 22:37:28', '2022-07-26', 'atender'),
(8, 'Pedro Perez', 'visita', '3344322432', '2022-07-26 22:37:55', '2022-07-26', 'finalizar'),
(9, '432432', 'dfsdfsdf', '4324234', '2022-07-27 12:07:28', '2022-07-27', 'finalizar'),
(10, 'carlos reyes', 'solicitud', '44324324324', '2022-07-27 15:30:37', '2022-07-27', 'finalizar'),
(11, 'fsdfsdfsdf', 'fsdfsdfsdf', '3234324234', '2022-07-27 15:31:34', '2022-07-27', 'atender'),
(12, 'df fdsfdsdf', 'sdfsdfsd', '345543543', '2022-07-27 15:31:43', '2022-07-27', 'finalizar'),
(13, 'wererw fsfsdf', 'fsd sdfsdfsdf sfd', '33452237', '2022-07-27 15:31:55', '2022-07-27', 'atender'),
(14, 'fsdfsdffds', 'sdffdsfds', 'sffdsdsf dfs', '2022-07-27 15:32:06', '2022-07-27', 'atender'),
(15, 'sdfsdfsdf fdsfsdf', 'sdfsdfsdfsf', '324324', '2022-07-27 15:32:29', '2022-07-27', 'atender'),
(16, 'sdfsdf sdf s', 'sddfsd fds', '3424324234', '2022-07-27 16:03:38', '2022-07-27', 'atender'),
(17, 'sdsfs fdsfds', 'dfsdfs dsfs dfsdfsdfsdf', '3337878879', '2022-07-27 16:03:48', '2022-07-27', 'atender'),
(18, 'sdf fdsfsdf', 'dsfsdfsdf', '334348797887', '2022-07-27 16:03:57', '2022-07-27', 'atender');

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
(1, 9, 1, 0),
(2, 10, 1, 0),
(3, 4, 1, 0),
(4, 12, 1, 1);

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
  `usuario_fecha_nacimiento` date NOT NULL DEFAULT '1984-02-02',
  `usuario_genero` varchar(20) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'MASCULINO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_dni`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_direccion`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_estado`, `usuario_privilegio`, `usuario_imagen`, `usuario_tipo`, `usuario_fecha_nacimiento`, `usuario_genero`) VALUES
(1, '16069854', 'Julian Amado', 'Caicaguare Caicaguan', '04248630834', 'Barcelona, Estado Anzoategui', 'caicaguarec@gmail.com', 'administrador', 'QmRqMEJ1UkhIQzAzbEFOVHNZaTVJUT09', 'Activa', 1, 'avatar.jpg', 1, '1984-02-02', 'MASCULINO'),
(10081, '26449141', 'Saulina', 'Pietrucci', '132131231231', 'Barcelona', 'saulina@gmail.com', 'saulina', 'WEM5V0UycDZGYmRERWlJUEpXY01zZz09', 'Activa', 1, '1657216193 perfil maria alejandra.png', 1, '1984-02-02', 'MASCULINO'),
(10082, '15706756', 'Beatriz', 'Guerra', '434234243234', 'Barcelona', 'beatriz@gmail.com', 'beatriz', 'OThmOHpUeHFuMTdJWExJWGpOQ2p5UT09', 'Activa', 1, '1657216813 saulina.PNG', 1, '1984-02-02', 'MASCULINO'),
(10083, '30701620', 'Dairy', 'Cacharuco', '343234234234', 'Barcelona', 'dairy@gmail.com', 'dairy', 'Ynd1MFBRNmVFclNaQ2ZRTnc1UkNhZz09', 'Activa', 1, '1657216864 perfil maria alejandra.png', 1, '1984-02-02', 'MASCULINO'),
(10084, '11968446', 'Yubiri', 'Fernandez', '', 'Puerto la Cruz', 'yubiri@gmail.com', 'yubirif', 'M2lzSlgzYkViRGx0UlRabXpEQnFCUT09', 'Activa', 2, '1657373762 perfil maria alejandra.png', 3, '1984-02-02', 'MASCULINO'),
(10085, '8288551', 'Jesus', 'Villafranca', '', '', 'jesus@gmail.com', 'jesusv', 'Y2wzdktTTWtyaGVtYnhsN0JGaUxYQT09', 'Activa', 2, '1657373858 capitan america.png', 3, '1984-02-02', 'MASCULINO'),
(10086, '14841577', 'DURYENIS', 'BRITO', '', '', 'duryenis@gmail.com', 'duryenisb', 'UnlNQ3g4d3pPaTdjS01xS2dGMTZDdz09', 'Activa', 1, '1657373933 mujer.png', 1, '1984-02-02', 'MASCULINO'),
(10087, '8264107', 'Indira', 'Mejias', '', '', 'indira@gmail.com', 'indiram', 'eWtxbk9wNjFLQTNuR2tHZWp0d0puUT09', 'Activa', 3, '1657374056 perfil maria alejandra.png', 3, '1984-02-02', 'MASCULINO'),
(10088, '18126146', 'Alejandra', 'Maia', '', '', 'alejandra@gmail.com', 'alejandram', 'dzJSMGZCSzlLWHl5Z1hBZ2xxTGNUQT09', 'Activa', 2, '1657374198 mujer.png', 3, '1984-02-02', 'MASCULINO'),
(10089, '21051100', 'Yuber', 'Lara', '', '', 'yuber@gmail.com', 'yuberl', 'bkNpZ2RSMUE1aHlHTnFzb3hRVFQ0UT09', 'Activa', 2, '1657374257 iron.png', 2, '1984-02-02', 'MASCULINO'),
(10090, '21069781', 'Marcos', 'Arriojas', '', '', 'marcos@gmail.com', 'marcosa', 'ZG9pNDl1N2hUcHZOT21OZVE3N0krQT09', 'Activa', 3, '1657374356 perfilthor.png', 3, '1984-02-02', 'MASCULINO'),
(10091, '14477982', 'Luis', 'Tapisquen', '', '', 'luis@gmail.com', 'luist', 'NkZ5dGE0RS9RZzNqS2pmZHd4S29RQT09', 'Activa', 2, '1657374422 iron.png', 3, '1984-02-02', 'MASCULINO'),
(10092, '27685128', 'Kendrys', 'Garcias', '', '', 'kendrys@gmail.com', 'kendrysg', 'UkhJWjl3VHZUOGlLUSthQWZTZFhSZz09', 'Activa', 3, '1657374577 capitan america.png', 3, '1984-02-02', 'MASCULINO'),
(10093, '17236037', 'Thaymi', 'Cisneros', '', '', 'thaymi@gmail.com', 'thaymic', 'dlJiVkZyWTVpYVltSFR5bzJZdGxIZz09', 'Activa', 3, '1657374889 perfill001.png', 3, '1984-02-02', 'MASCULINO'),
(10094, '21173274', 'Anyali', 'Gamardo', '', '', 'anyali@gmail.com', 'anyalig', 'SGlUTlJhV05LZWxXdEkxTnd1M1Y1Zz09', 'Activa', 3, '1657374954 perfil002.png', 3, '1984-02-02', 'MASCULINO'),
(10095, '28649957', 'Edward', 'Guaramata', '', '', 'edward@gmail.com', 'edwardg', 'Q1k5WUtWSitZV0xmdE1QdjlwblBzdz09', 'Activa', 3, '1657375030 perfil004.png', 3, '1984-02-02', 'MASCULINO'),
(10096, '19496342', 'Jesus', 'Tocuyo', '', '', 'jesust@gmail.com', 'jesust', 'QUowSDNIcWxNZG8zd2Q2aU4rditTUT09', 'Activa', 2, '1657375086 perfil005.png', 3, '1984-02-02', 'MASCULINO'),
(10097, '17733145', 'Rosalba', 'Matiguan', '', '', 'rosalba@gmail.com', 'rosalbam', 'ekFDMjZlQ2M3TXRjaG1SdDkrREdaQT09', 'Activa', 3, '1657375148 perfill001.png', 3, '1984-02-02', 'MASCULINO'),
(10098, '30465960', 'Jose', 'Caicaguare', '', '', 'jose@gmail.com', 'josec', 'OGpSa1ZTbC84UGh5VnpBejczQTRxUT09', 'Activa', 3, '1657375299 perfil00556.png', 3, '1984-02-02', 'MASCULINO'),
(10099, '26947860', 'Maria Alejandra', 'Rojas', '', '', 'maria@gmail.com', 'mariar', 'bFNqdXNlUDl0SnBXUmYxYjNwSDhsQT09', 'Activa', 1, '1657375368 perfil002.png', 1, '1984-02-02', 'MASCULINO'),
(10100, '21173890', 'Mariana', 'Maestre', '', '', 'mariana@gmail.com', 'marianam', 'MkYrVThmMGtKVmg2ek8zMmhUcFVLZz09', 'Activa', 3, '1657375449 perfil0003.png', 3, '1984-02-02', 'MASCULINO'),
(10101, '20361429', 'Sachy', 'Montilla', '', '', 'sachy@gmail.com', 'sachym', 'MUQwVnI4NmNYYUZuVlhtMytKc0l2dz09', 'Activa', 1, '1657375526 perfill001.png', 1, '1984-02-02', 'MASCULINO'),
(10102, '19013743', 'Angel', 'Garcia', '', '', 'angel@gmail.com', 'angelg', 'bkNpZ2RSMUE1aHlHTnFzb3hRVFQ0UT09', 'Activa', 3, '1657375699 perfilthor.png', 3, '1984-02-02', 'MASCULINO'),
(10103, '11111111', 'Mirlian', 'Rodriguez', '', '', 'MirlianR@gmail.com', 'MirlianR', 'N0E4anRuQy91eUFDcmVxM0ZhVENLZz09', 'Activa', 3, '1657549917 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10104, '22222222', 'Alexander', 'Contreras', '', '', 'AlexanderC@gmail.com', 'AlexanderC', 'YnJOWEdaWGI0R2gyODZNVlBnQTh6QT09', 'Activa', 3, '1657550101 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10105, '33333333', 'Iliana', 'Pietrucci', '', '', 'IlianaP@gmail.com', 'IlianaP', 'RjVTcjJmRW1LbGlvU2JoWHE4ek8rdz09', 'Activa', 3, '1657550365 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10106, '44444444', 'Antonio', 'Guzman', '', '', 'AntonioG@gmail.com', 'AntonioG', 'VDNIa2JndDJtcnNXb20yVFZVeHduUT09', 'Activa', 3, '1657550511 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10107, '55555555', 'Yaneth', 'Reyes', '', '', 'YanethR@gmail.com', 'YanethR', 'bkNpZ2RSMUE1aHlHTnFzb3hRVFQ0UT09', 'Activa', 3, '1657550657 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10108, '66666666', 'Jaquelin', 'Querecuto', '', '', 'JaquelinQ@gmail.com', 'JaquelinQ', 'T2lITEFQbWFyMEF5eXJETThtNlNrUT09', 'Activa', 3, '1657550817 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10109, '77777777', 'Luis', 'Cozzz', '', '', 'LuisC@gimail.com', 'LuisC', 'S3BKbVo3V3BwMHozNHd4K1BBTEgyQT09', 'Activa', 3, '1657551567 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10110, '88888888', 'Cesar', 'Hernansez', '', '', 'CesarH@gmail.com', 'CesarH', 'WW5GR0s4VnlzUlJtUkpMckNnMGx5Zz09', 'Activa', 3, '1657551676 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10111, '99999999', 'Rossana', 'Goyo', '', '', 'RosarioG@gmail.com', 'RosarioG', 'c1NHSE9iVEJ5RmYvUmhPSDZrVU9VZz09', 'Activa', 3, '1657551789 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10112, '10101010', 'Yolimar', 'Ledezma', '', '', 'YolimarL@gmail.com', 'YolimarL', 'U0kwTG5hYmlMa1pNRzNlZVZmckpzdz09', 'Activa', 3, '1657551939 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10113, '12121212', 'Frank', 'Valera', '', '', 'FrankV@gmail.com', 'FrankV', 'TzloMDZXS2ZMRGsvRTkvajBPeDFaQT09', 'Activa', 3, '1657552053 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10114, '13131313', 'Julian', 'Caicaguare', '', '', 'JulianC@gmail.com', 'JulianC', 'ekoxRnJHNThvUHpaYlZkMHlZZ3pvZz09', 'Activa', 3, '1657552164 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10115, '14141414', 'wilfredo', 'Pino', '', '', 'WilfredoP@gmail.com', 'WilfredoP', 'bjZsWWc5TmxzY0N2ckRlNE5LUGIrdz09', 'Activa', 3, '1657552255 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10116, '15151515', 'Daniel', 'Atay', '', '', 'DanielA@gmil.com', 'DanielA', 'QUJtTk1wMTZheURQSmd4Unp4aE1UQT09', 'Activa', 3, '1657552344 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10117, '16161616', 'Katiuska', 'Hosmi', '', '', 'KatiuskaH@gmil.com', 'KatiuskaH', 'SnlJdmcxbTNBNUVBZDMyRVdrdllzUT09', 'Activa', 3, '1657552487 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10118, '17171717', 'Arly', 'Guarapana', '', '', 'ArlyG@gmail.com', 'ArlyG', 'eVMvQUpLelRSVzVRdVF0MzVkOXFwdz09', 'Activa', 3, '1657552622 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10119, '18181818', 'Rainier', 'Garcias', '', '', 'RainierG@gmail.com', 'RainierG', 'b1FHcVJZWkhVZXpxN1N2bnZCUVQxdz09', 'Activa', 3, '1657552728 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10120, '19191919', 'Mireya', 'Molero', '', '', 'MireyaM@gmail.com', 'MireyaM', 'amRuRFJmSGRua2NDZnoreWRLYVVjZz09', 'Activa', 3, '1657552831 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10121, '20202020', 'Jesus', 'Fermin', '', '', 'JesusF@gmail.com', 'JesusF', 'WGp0REJaTitpdGF2Z3ptbVlBNEk5Zz09', 'Activa', 3, '1657552915 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10122, '21212121', 'Jose', 'Velazquez', '', '', 'JoseV@gmail.com', 'JoseV', 'RWE0cUZxZzhsV2puTzc4MjdMdlZJQT09', 'Activa', 3, '1657553009 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10123, '4433443344', 'Sergio', 'Millan', '', '', 'sergio@gmail.com', 'sergiom', 'em91bEtzZktZcXAyOXFtR2lDZ29ndz09', 'Activa', 3, '1657647607 perfil004.png', 4, '1984-02-02', 'MASCULINO'),
(10124, '34343434', 'Arcide', 'Infante', '', '', 'ArcidesI@gmail.com', 'Arcidesl', 'QWVoZWhxZytxeVZWWEFGa3NNSlFrdz09', 'Activa', 3, '1657650345 Desert.jpg', 4, '1984-02-02', 'MASCULINO'),
(10125, '210511000', 'yuber', 'lara', '', '', 'yuberla@gmail.com', 'yuberla', 'OFVRRDc4VE00VHpZc2J2L09QZDZWUT09', 'Activa', 3, '1657716619 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10126, '021051100', 'yubert', 'lara', '', '', 'yubertla@gmail.com', 'yubertla', 'YUl5eXk1T25wd2NFY2ZhTFpnRHcvZz09', 'Activa', 3, '1657716870 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10127, '45454545', 'Gabriela', 'Puente', '', '', 'Gabrielap@gmail.com', 'Gabrielap', 'eHBNU2E1QktwcXcvVzFvcHdUMm1IQT09', 'Activa', 3, '1657717581 images (1).png', 3, '1984-02-02', 'MASCULINO'),
(10128, '54545454', 'gabriela', 'puente', '', '', 'gabrielapast@gmail.com', 'gabrielapast', 'RS90SzZQU2hvOHVRci9wNG1HRkZtZz09', 'Activa', 3, '1657717814 images (1).png', 4, '1984-02-02', 'MASCULINO'),
(10129, '64646464', 'jesus', 'arevalo', '', '', 'jesuspast@gmail.com', 'jesuspast', 'cFlHYmdiYU9PNGExd0NJVkgza0RuZz09', 'Activa', 3, '1657717950 buyer-persona-termino.jpg', 3, '1984-02-02', 'MASCULINO'),
(10130, '74747474', 'edwin', 'mora', '', '', 'edwinpast@gmail.com', 'edwinpast', 'cHpWcENpRTBPeGZWRVdsRVBpQ25nQT09', 'Activa', 3, '1657718851 buyer-persona-termino.jpg', 3, '1984-02-02', 'MASCULINO'),
(10131, '84848484', 'jesus', 'curbata', '', '', 'jesusspast@gmail.com', 'jesusspast', 'RGY3NjFoSXhabExzZVM1bzROZEQ4UT09', 'Activa', 3, '1657719747 buyer-persona-termino.jpg', 4, '1984-02-02', 'MASCULINO'),
(10132, '123123123', 'jesus', 'curbata', '', '', 'jesuspaste@gmail.com', 'jesuspaste', 'NmwxNklMRWVCU3BJa2lyb01JSnFrUT09', 'Activa', 3, '1657719877 buyer-persona-termino.jpg', 3, '1984-02-02', 'MASCULINO'),
(10133, '1234567', 'Isamar', 'romero', '', '', 'IsamarR@gmail.com', 'IsamarR', 'ZzdSY0pxWVA4MHo3YnhwQkdrS28yUT09', 'Activa', 3, '1657725991 Chrysanthemum.jpg', 4, '1984-02-02', 'MASCULINO');

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
(40, 10133, 14);

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
(46, 10133, 50);

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
(46, 10133, 1);

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
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`estudio_id`);

--
-- Indices de la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`familiar_id`);

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
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `activo_usuario`
--
ALTER TABLE `activo_usuario`
  MODIFY `activo_usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `activo_usuario_status`
--
ALTER TABLE `activo_usuario_status`
  MODIFY `activo_usuario_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `anexo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `asignacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `bitacora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3068;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `configuracion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cubiculo`
--
ALTER TABLE `cubiculo`
  MODIFY `cubiculo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
  MODIFY `estudio_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `familiar`
--
ALTER TABLE `familiar`
  MODIFY `familiar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
  MODIFY `home_actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  MODIFY `home_indicador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `home_operador`
--
ALTER TABLE `home_operador`
  MODIFY `home_operador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `imagen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `indicador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `paso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `pdf`
--
ALTER TABLE `pdf`
  MODIFY `pdf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `procesar`
--
ALTER TABLE `procesar`
  MODIFY `procesar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `solicitud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `solicitud_actividad`
--
ALTER TABLE `solicitud_actividad`
  MODIFY `sol_act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT de la tabla `solicitud_direccion`
--
ALTER TABLE `solicitud_direccion`
  MODIFY `solicitud_direccion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `solicitud_gabinete`
--
ALTER TABLE `solicitud_gabinete`
  MODIFY `solicitud_gabinete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `turno_usuario`
--
ALTER TABLE `turno_usuario`
  MODIFY `turno_usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10134;

--
-- AUTO_INCREMENT de la tabla `usuario_cargo`
--
ALTER TABLE `usuario_cargo`
  MODIFY `usuario_cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuario_parroquia`
--
ALTER TABLE `usuario_parroquia`
  MODIFY `usuario_parroquia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `usuario_sector`
--
ALTER TABLE `usuario_sector`
  MODIFY `usuario_sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
