-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2022 a las 15:10:24
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
(6, '2022-07-28 09:09:40', 'Hizo la siguiente busqueda: sin procesar en el listado de solicitud', 1);

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
(4, 4, 'Bolivar', 0, '0.00', 2022),
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
(7, 'Guayaquil', 50);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_direccion`
--

CREATE TABLE `solicitud_direccion` (
  `solicitud_direccion_id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `direccion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_gabinete`
--

CREATE TABLE `solicitud_gabinete` (
  `solicitud_gabinete_id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `gabinete_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  `usuario_tipo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_dni`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_direccion`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_estado`, `usuario_privilegio`, `usuario_imagen`, `usuario_tipo`) VALUES
(1, '16069854', 'Julian Amado', 'Caicaguare Caicaguan', '04248630834', 'Barcelona, Estado Anzoategui', 'caicaguarec@gmail.com', 'administrador', 'QmRqMEJ1UkhIQzAzbEFOVHNZaTVJUT09', 'Activa', 1, 'avatar.jpg', 1);

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
(46, 10133, 50),
(47, 10134, 56),
(48, 10135, 50);

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
(47, 10135, 7);

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
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `asignacion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `bitacora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `configuracion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cubiculo`
--
ALTER TABLE `cubiculo`
  MODIFY `cubiculo_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `grafica_solicitud_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_actividad`
--
ALTER TABLE `home_actividad`
  MODIFY `home_actividad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_direccion`
--
ALTER TABLE `home_direccion`
  MODIFY `home_direccion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_feedback`
--
ALTER TABLE `home_feedback`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_gabinete`
--
ALTER TABLE `home_gabinete`
  MODIFY `home_gabinete_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_indicador`
--
ALTER TABLE `home_indicador`
  MODIFY `home_indicador_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_operador`
--
ALTER TABLE `home_operador`
  MODIFY `home_operador_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `imagen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `indicador_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `paso_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pdf`
--
ALTER TABLE `pdf`
  MODIFY `pdf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `procesar`
--
ALTER TABLE `procesar`
  MODIFY `procesar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `solicitud_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_actividad`
--
ALTER TABLE `solicitud_actividad`
  MODIFY `sol_act_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_direccion`
--
ALTER TABLE `solicitud_direccion`
  MODIFY `solicitud_direccion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_gabinete`
--
ALTER TABLE `solicitud_gabinete`
  MODIFY `solicitud_gabinete_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turno_usuario`
--
ALTER TABLE `turno_usuario`
  MODIFY `turno_usuario_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10136;

--
-- AUTO_INCREMENT de la tabla `usuario_cargo`
--
ALTER TABLE `usuario_cargo`
  MODIFY `usuario_cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuario_parroquia`
--
ALTER TABLE `usuario_parroquia`
  MODIFY `usuario_parroquia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `usuario_sector`
--
ALTER TABLE `usuario_sector`
  MODIFY `usuario_sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
