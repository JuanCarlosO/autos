-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2019 a las 04:58:17
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_vehicular`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(15) NOT NULL,
  `codigo_uni` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Listado de las áreas administrativas del organigrama';

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `codigo_uni`, `nombre`) VALUES
(1, '206C03010000000', 'UNIDAD DE ASUNTOS INTERNOS'),
(2, '206C0301000100S', 'UNIDAD DE NORMATIVIDAD Y APOYO JURÍDICO'),
(3, '206C0301000200S', 'ÓRGANO INTERNO DE CONTROL'),
(4, '206C0301000300S', 'UNIDAD DE APOYO ADMINISTRATIVO'),
(5, '206C0301010000L', 'DIRECCIÓN DE INVESTIGACIÓN'),
(6, '206C0301010001S', 'UNIDAD DE QUEJAS Y DENUNCIAS'),
(7, '206C0301010100L', 'SUBDIRECCIÓN DE OPERATIVOS VALLE DE MÉXICO'),
(8, '206C0301010101L', 'DEPARTAMENTO DE INSPECCIÓN, INVESTIGACIÓN Y SUPERVISIÓN ZONA NORORIENTE'),
(9, '206C0301010102L', 'DEPARTAMENTO DE INSPECCIÓN, INVESTIGACIÓN Y SUPERVISIÓN ZONA ORIENTE'),
(10, '206C0301010200L', 'SUBDIRECCIÓN DE OPERATIVOS VALLE DE TOLUCA'),
(11, '206C0301010201L', 'DEPARTAMENTO DE INSPECCIÓN, INVESTIGACIÓN Y SUPERVISIÓN ZONA NORTE'),
(12, '206C0301010202L', 'DEPARTAMENTO DE INSPECCIÓN, INVESTIGACIÓN Y SUPERVISIÓN ZONA SUR'),
(13, '206C0301020000L', 'DIRECCIÓN DE RESPONSABILIDADES'),
(14, '206C0301020100L', 'SUBDIRECCIÓN DE ANÁLISIS Y PROCEDIMIENTOS ADMINISTRATIVOS'),
(15, '206C0301020101L', 'DEPARTAMENTO DE ANÁLISIS E INTEGRACIÓN'),
(16, '206C0301020102L', 'DEPARTAMENTO DE PROCEDIMIENTOS A'),
(17, '206C0301020103L', 'DEPARTAMENTO DE PROCEDIMIENTOS B'),
(18, '206C0301020200L', 'SUBDIRECCIÓN DE LO CONTENCIOSO'),
(19, '206C0301020201L', 'DEPARTAMENTO DE MEDIOS DE IMPUGNACIÓN A'),
(20, '206C0301020202L', 'DEPARTAMENTO DE MEDIOS DE IMPUGNACIÓN B'),
(21, '206C0301030000L', 'DIRECCIÓN DE INFORMACIÓN, PLANEACIÓN, PROGRAMACIÓN Y EVALUACIÓN'),
(22, '206C0301030100L', 'SUBDIRECCIÓN DE INFORMACIÓN, PROGRAMACIÓN Y SEGUIMIENTO'),
(23, '206C0301030101L', 'DEPARTAMENTO DE INFORMACIÓN Y ESTADÍSTICA'),
(24, '206C0301030102L', 'DEPARTAMENTO DE PROGRAMACIÓN, SEGUIMIENTO Y EVALUACIÓN'),
(25, '206C0301030200L', 'SUBDIRECCIÓN DE TECNOLOGÍAS DE LA INFORMACIÓN'),
(26, '206C0301030201L', 'DEPARTAMENTO DE DESARROLLO DE SISTEMAS'),
(27, '206C0301030202L', 'DEPARTAMENTO DE SOPORTE TÉCNICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_fallas`
--

CREATE TABLE `catalogo_fallas` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `tipo_id` int(11) NOT NULL COMMENT 'FK de la tabla de tipo de fallas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catalogo_fallas`
--

INSERT INTO `catalogo_fallas` (`id`, `nombre`, `tipo_id`) VALUES
(1, 'Marcha', 1),
(2, 'Llave o Switch', 1),
(3, 'Batería y terminales', 1),
(4, 'Alternador', 1),
(5, 'Inyectores', 1),
(6, 'Bomba de Gasolina', 1),
(7, 'Sensores', 1),
(8, 'Bujías y Cables de Bujía', 1),
(9, 'Fusibles', 1),
(10, 'Bobinas', 1),
(11, 'Distribución General', 2),
(12, 'Bandas y Cadenas', 2),
(13, 'Poleas', 2),
(14, 'Bomba de Agua', 3),
(15, 'Radiador, tapón y motoventilador', 3),
(16, 'Depósito de Anticongelante y tapón', 3),
(17, 'Mangueras y Anticongelante', 3),
(18, 'Termostato', 3),
(19, 'Tomas de Agua', 3),
(20, 'Opcional combinable: Cambio total de anticongelante', 3),
(21, 'Horquillas, bujes, rótulas y bieletas', 4),
(22, 'Amortiguadores, resortes y bases de amortiguadores', 4),
(23, 'Espigas, terminales y brazos de dirección', 4),
(24, 'Barra estabilizadora y dirección (completa)', 4),
(25, 'Masas y baleros', 4),
(26, 'Licuadora', 4),
(27, 'Alineación y balanceo', 4),
(28, 'Piezas en general internas y externas del motor (cigüeñal, árbol de levas, juego de juntas, bomba de aceite, buzos, cabeza y válvulas, sellos de válvulas)', 5),
(29, 'Ajuste (pistones, anillos y metales)', 5),
(30, 'Cárter de motor', 5),
(31, 'Soportes de motor', 5),
(32, 'Opcional combinable: Cambio total de aceite', 5),
(33, 'Opcional combinable: Cambio total de anticongelante', 5),
(34, 'Caja de velocidades (cuerpo de válvulas, engranes y cárter de caja)', 6),
(35, 'Clutch (pastas, volanta, chicote y collarín)', 6),
(36, 'Cuerpo de aceleración', 7),
(37, 'Chicote de acelerador', 7),
(38, 'Sensores (MAF, MAP o TPS)', 7),
(39, 'Válvula PCV', 7),
(40, 'Cambio de neumáticos', 8),
(41, 'Rotación de neumáticos', 8),
(42, 'Reparación de algún neumático (talacha)', 8),
(43, 'Faros alta y baja (foco)', 9),
(44, 'Cuartos (foco)', 9),
(45, 'Cableado general', 9),
(46, 'Palanca de luces', 9),
(47, 'Relevadores y/o fusibles', 9),
(48, 'Stop (foco)', 9),
(49, 'Calaveras', 10),
(50, 'Faros (unidad completa)', 10),
(51, 'Rin de neumático', 10),
(52, 'Tapón de rin', 10),
(53, 'Birlos de rin', 10),
(54, 'Plumas (limpiaparabrisas)', 10),
(55, 'Cambio de balatas (delanteras y traseras)', 11),
(56, 'Cambio de discos y /o tambores', 11),
(57, 'Rectificado de discos y/o tambores', 11),
(58, 'Limpieza y ajuste de frenos', 11),
(59, 'Bases y pernos de balatas', 11),
(60, 'Chicote (freno de mano)', 11),
(61, 'Ajustadores y/o cilindros maestros de líquido de frenos', 11),
(62, 'Purgadores de líquido de frenos', 11),
(63, 'Booster', 11),
(64, 'Depósito de líquido de frenos y tubería', 11),
(65, 'Opcional combinable: Cambio total de líquido de frenos', 11),
(66, 'Cambio de Panel o Tablero completo', 12),
(67, 'Reseteo de indicadores de Panel', 12),
(68, 'Bujías', 13),
(69, 'Cambio de filtro (aceite, gasolina y aire)', 13),
(70, 'Cambio de aceite', 13),
(71, 'Lavado de inyectores y Cuerpo de aceleración', 13),
(72, 'Cambio de Aceite', 14),
(73, 'Cambio de Filtro de Aceite y Filtro de Aire', 14),
(74, '1er Semestre', 15),
(75, '2do Semestre', 15),
(76, 'Pintado general de vehículo', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_taller`
--

CREATE TABLE `ingreso_taller` (
  `id` int(11) NOT NULL,
  `solicitud` int(11) NOT NULL COMMENT 'FK de la tabla solicitudes',
  `taller` int(11) NOT NULL COMMENT 'FK de la tabla talleres',
  `f_ingreso` date NOT NULL COMMENT 'fecha de ingreso',
  `h_ingreso` time NOT NULL COMMENT 'hora de ingreso',
  `f_salida` date DEFAULT NULL COMMENT 'fecha de salida',
  `h_salida` time DEFAULT NULL COMMENT 'hora de salida',
  `p_recibe` varchar(255) NOT NULL COMMENT 'Persona que recibe unidad',
  `p_entrega` varchar(255) DEFAULT NULL COMMENT 'Persona que entrega unidad ',
  `estado` enum('Entregado','Reparación','Reparado') NOT NULL DEFAULT 'Entregado',
  `observaciones` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Seguimiento de la reparacion de la unidad ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL COMMENT 'nombre completo de la marca de vehiculo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de marca de vehiculos ';

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nom`) VALUES
(1, 'VOLKSWAGEN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL COMMENT 'PK',
  `n_short` varchar(50) NOT NULL COMMENT 'Nombre corto del modulo',
  `n_long` varchar(200) DEFAULT NULL COMMENT 'Nombre largo del modulo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de los módulos disponibles del sistema';

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `n_short`, `n_long`) VALUES
(1, 'list_car', 'Listar Autos'),
(2, 'add_car', 'Agregar autos'),
(3, 'add_sol', 'Agregar Solicitud'),
(4, 'list_sol', 'Listar Solicitudes'),
(5, 'add_taller', 'Agregar taller'),
(6, 'list_taller', 'Listar talleres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL COMMENT 'PK',
  `user_id` int(11) NOT NULL COMMENT 'FK de la tabla usuarios',
  `model_id` int(11) NOT NULL COMMENT 'FK de la tabla modelos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `user_id`, `model_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ap_pat` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ap_mat` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Clave de servidor público',
  `area_id` int(11) DEFAULT NULL COMMENT 'Clave foránea de la unidad administrativa',
  `status` enum('ALTA','BAJA') COLLATE utf8_spanish_ci DEFAULT NULL,
  `genero` enum('M','F') COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Sexo de la persona'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Se guardan los nombres de las personas que laboran en la UAI';

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `ap_pat`, `ap_mat`, `clave`, `area_id`, `status`, `genero`) VALUES
(1, 'ANGELICA', 'AGUILAR', 'GONZALEZ', NULL, 6, 'BAJA', 'F'),
(2, 'ROSALIO', 'AGUILAR', 'JUAN', NULL, 20, 'BAJA', NULL),
(3, 'KARLA', 'ALCANTARA', 'RIVERA', NULL, 1, 'BAJA', NULL),
(4, 'CEZANNE', 'ALVAREZ', 'SOTO', NULL, 4, 'BAJA', NULL),
(5, 'EVA', 'ANDRES', 'MARTINEZ', NULL, 5, 'BAJA', NULL),
(6, 'ERNESTO', 'ASPERA', 'URBINA', NULL, 6, 'BAJA', NULL),
(7, 'OSVALDO', 'BAEZ', 'CERVANTES', NULL, 17, 'BAJA', NULL),
(8, 'BRAULIO REYNALDO', 'BARROSO', 'MARTINEZ', NULL, 27, 'BAJA', NULL),
(9, 'SONIA', 'BECERRIL', 'FABELA', NULL, 8, 'BAJA', NULL),
(10, 'ALEJANDRO', 'BERNAL', 'GARDUÑO', NULL, 19, 'BAJA', NULL),
(11, 'ISAAC JACOB', 'CALLEJAS', 'DIAZ', NULL, 17, 'BAJA', NULL),
(12, 'EBELIA', 'CARDENAS', 'MORENO', NULL, 6, 'BAJA', NULL),
(13, 'MARICELA', 'CASTAÑEDA', 'GONZÁLEZ', NULL, 22, 'BAJA', NULL),
(14, 'MARCO ANTONIO', 'CASTILLO', 'ULLOA', NULL, 26, 'BAJA', NULL),
(15, 'ANDREA STEPHANY', 'CASTILLO', 'VALLEJO', NULL, 10, 'BAJA', NULL),
(16, 'MARIA DE LOURDES', 'CEJUDO', 'ESCOBAR', NULL, 6, 'BAJA', NULL),
(17, 'DANIEL', 'CHAVEZ', 'MIRAMON', NULL, 12, 'BAJA', NULL),
(18, 'JOSE', 'CHAVEZ', 'MUÑOZ', NULL, 6, 'BAJA', NULL),
(19, 'MIGUEL', 'CRUZ', 'GARRIDO', NULL, 5, 'BAJA', NULL),
(20, 'EMMANUEL', 'DIAZ', 'AVILA', NULL, 9, 'BAJA', NULL),
(21, 'BRENDA', 'DIAZ', 'SANCHEZ', NULL, 4, 'BAJA', NULL),
(22, 'MARIA DE LA LUZ', 'DOTOR', 'HIDALGO', NULL, 7, 'BAJA', NULL),
(23, 'IRVING', 'ELIVAR', 'MIGUEL', NULL, 9, 'BAJA', NULL),
(24, 'CESAR', 'ESTRADA', 'COLIN', NULL, 21, 'BAJA', NULL),
(25, 'ISRAEL', 'ESTRADA', 'GUTIERREZ', NULL, 11, 'BAJA', NULL),
(26, 'OSCAR MARIO', 'FLORES', 'GOMEZ', NULL, 21, 'BAJA', NULL),
(27, 'BERTHA', 'FLORES', 'VELAZQUEZ', NULL, 11, 'BAJA', NULL),
(28, 'PERLA ERIKA', 'FONSECA', 'RUBI', NULL, 23, 'BAJA', NULL),
(29, 'JHOANA JAZMIN', 'FRAGOSO', 'GOMEZ', NULL, 23, 'BAJA', NULL),
(30, 'ADAN', 'GAONA', 'VALLE', NULL, 10, 'BAJA', NULL),
(31, 'VICENTE', 'GARCIA', 'ALVAREZ', NULL, 11, 'BAJA', NULL),
(32, 'NELDA MARIELA', 'GARCIA', 'DOMINGUEZ', NULL, 3, 'BAJA', NULL),
(33, 'YOLANDA PATRICIA', 'GARCIA', 'GUEVARA', NULL, 4, 'BAJA', NULL),
(34, 'ANDRES ADALBERTO', 'GARCIA', 'MURILLO', NULL, 7, 'BAJA', NULL),
(35, 'OMAR DE JESUS', 'GARDUÑO', 'ARRIAGA', NULL, 12, 'BAJA', NULL),
(36, 'JOSE LUIS', 'GOMEZ', 'VEGA', NULL, 13, 'BAJA', NULL),
(37, 'DENISSE', 'GONZALEZ', 'ORNELAS', NULL, 1, 'BAJA', NULL),
(38, 'GABINO', 'HERNANDEZ', 'APARICIO', NULL, 4, 'BAJA', NULL),
(39, 'JUAN GERARDO', 'HERNANDEZ', 'PARRA', NULL, 8, 'BAJA', NULL),
(40, 'RODRIGO DE JESUS', 'HERNANDEZ', 'TORRES', NULL, 20, 'BAJA', NULL),
(41, 'JOSE LUIS', 'HERRERA', 'RANGEL', NULL, 11, 'BAJA', NULL),
(42, 'EDUARDO XAVIER', 'HINOJOSA', 'ORTIZ', NULL, 14, 'BAJA', NULL),
(43, 'CARLOS AMADOR', 'IGLESIAS', 'AGUILAR', NULL, 5, 'BAJA', NULL),
(44, 'JOSE LUIS', 'JARDON', 'VITAL', NULL, 10, 'BAJA', NULL),
(45, 'SILVERIO LAURENTINO', 'JIMENEZ', 'CASTILLO', NULL, 4, 'BAJA', NULL),
(46, 'TOMAS', 'LARA', 'LORANCA', NULL, 8, 'BAJA', NULL),
(47, 'GENARO', 'LARA', 'MEDELLIN', NULL, 11, 'BAJA', NULL),
(48, 'MARIA TERESA', 'LIMON', 'MONTERROSAS', NULL, 1, 'BAJA', NULL),
(49, 'ALEJANDRA', 'LOPEZ', 'DE LA CRUZ', NULL, 4, 'BAJA', NULL),
(50, 'NOELIA', 'LOPEZ', 'HERNANDEZ', NULL, 4, 'BAJA', NULL),
(51, 'ESTEFANY ARIADNA', 'MARIN', 'VILCHIS', NULL, 27, 'BAJA', NULL),
(52, 'JESUS', 'MARTINEZ', 'GALAN', NULL, 11, 'BAJA', NULL),
(53, 'ALAN FIDELIO', 'MATIAS', 'PANIAHUA', NULL, 17, 'BAJA', NULL),
(54, 'LUIS', 'MELGOZA', 'SARQUIS', NULL, 13, 'BAJA', NULL),
(55, 'VERONICA', 'MINQUINI', 'DEL CORRO', NULL, 15, 'BAJA', NULL),
(56, 'JUAN MANUEL', 'MONDRAGON', 'MENESES', NULL, 6, 'BAJA', NULL),
(57, 'JOSE LUIS', 'MONTERRUBIO', 'SANTANA', NULL, 22, 'BAJA', NULL),
(58, 'EMMANUEL', 'MONTES', 'LUGO', '997599406', 26, 'BAJA', 'M'),
(59, 'ISAEL T.', 'MONTOYA', 'ARCE', NULL, 1, 'BAJA', NULL),
(60, 'ABEL', 'MORA', 'ALEJANDRE', NULL, 23, 'BAJA', NULL),
(61, 'ANHAD DAVID', 'MORENO', 'ESCOBAR', NULL, 8, 'BAJA', NULL),
(62, 'ROSA DEL CARMEN', 'MUÑOZ', 'LOPEZ', NULL, 13, 'BAJA', NULL),
(63, 'FRANCISCO FLORENTINO', 'OROZCO', 'RAMIREZ', NULL, 8, 'BAJA', NULL),
(64, 'MARIA GUADALUPE JOSEFINA', 'PEÑA', 'DELGADO', NULL, 23, 'BAJA', NULL),
(65, 'ELVIRA', 'PEREZ', 'MONTES DE OCA', NULL, 16, 'BAJA', NULL),
(66, 'FERNANDO', 'PIÑA', 'SANCHEZ', NULL, 6, 'BAJA', NULL),
(67, 'KATIA', 'PUENTE', 'GARCIA', NULL, 21, 'BAJA', NULL),
(68, 'CLAUDIA', 'QUITERIO', 'MENDEZ', NULL, 13, 'BAJA', NULL),
(69, 'ALEJANDRO', 'REYES', 'CORTAZAR', NULL, 19, 'BAJA', NULL),
(70, 'HUMBERTO ALEJANDRO', 'REYES', 'NAJERA', NULL, 12, 'BAJA', NULL),
(71, 'KRISTIAN ADRIAN', 'RIVERA', 'RANGEL', NULL, 5, 'BAJA', NULL),
(72, 'SARAY', 'RODRIGUEZ', 'HERNANDEZ', NULL, 4, 'BAJA', NULL),
(73, 'RAFAEL', 'RODRIGUEZ', 'NUÑEZ', NULL, 27, 'BAJA', NULL),
(74, 'RAUL', 'ROJAS', 'VELAZQUEZ', NULL, 12, 'BAJA', NULL),
(75, 'ANA MARIA', 'ROMERO', 'CAMACHO', '', 25, 'BAJA', 'F'),
(76, 'JESUS', 'ROMERO', 'MENESES', NULL, 4, 'BAJA', NULL),
(77, 'REYNALDO', 'RUIZ', 'LOVERA', NULL, 4, 'BAJA', NULL),
(78, 'SALVADOR', 'RUIZ', 'MADRIZ', NULL, 22, 'BAJA', NULL),
(79, 'GUADALUPE', 'SALAS', 'CONTRERAS', NULL, 21, 'BAJA', NULL),
(80, 'MARIA LORENA', 'SALGADO', 'FRAGOSO', NULL, 10, 'BAJA', NULL),
(81, 'JENNIFER JAHEL', 'SALGADO', 'ROMERO', NULL, 11, 'BAJA', NULL),
(82, 'CLAUDIA YAZMIN', 'RODRIGUEZ', 'SAN JUAN', NULL, 2, 'BAJA', NULL),
(83, 'ISELA LORENA', 'SANCHEZ', 'MONROY', NULL, 18, 'BAJA', NULL),
(84, 'CARLOS', 'SANDOVAL', 'CUEVAS', NULL, 1, 'BAJA', NULL),
(85, 'GUSTAVO', 'SOLACHE', 'TORRES', NULL, 9, 'BAJA', NULL),
(86, 'ALEJANDRO CARLOS', 'TAPIA', 'IZQUIERDO', NULL, 4, 'BAJA', NULL),
(87, 'JOSE ALEJANDRO', 'TAPIA', 'TORRES', NULL, 4, 'BAJA', NULL),
(88, 'CLARETH YAZZMINN', 'VALDES', 'LOPEZ', NULL, 16, 'BAJA', NULL),
(89, 'ANTONIA ARACELI', 'VARGAS', 'MENDOZA', NULL, 14, 'BAJA', NULL),
(90, 'OSCAR', 'VEGA', 'HERNANDEZ', NULL, 27, 'BAJA', NULL),
(91, 'MARIA DEL ROSARIO', 'VELEZ', 'CAMACHO', NULL, 20, 'BAJA', NULL),
(92, 'ALFREDO', 'ZARZA', 'DELGADO', NULL, 21, 'BAJA', NULL),
(93, 'JULIO ARTURO', 'ZUÑIGA', 'GUTIÉRREZ', NULL, 24, 'BAJA', NULL),
(94, 'LILIANA ALEJANDRA', 'ITURBE', 'PADILLA', NULL, 6, 'BAJA', NULL),
(95, 'CLAUDIA ALEJANDRA', 'QUINTERO', 'COLIN', NULL, 4, 'BAJA', NULL),
(96, 'ANA KARINA', 'SANCHEZ', 'RODRIGUEZ', NULL, 15, 'BAJA', NULL),
(97, 'PEDRO', 'AMARO', 'GALINDO', NULL, 10, 'BAJA', NULL),
(98, 'ALEJANDRO', 'DE LA CRUZ', 'MARIN', NULL, 26, 'BAJA', NULL),
(99, 'CASANDRA YVETTE', 'GONZALEZ', 'GARCIA', NULL, 15, 'BAJA', NULL),
(100, 'SARA EDITH', 'PADUA', 'DIAZ', NULL, 19, 'BAJA', NULL),
(101, 'RAFAEL', 'PERALTA', 'PINEDA', NULL, 20, 'BAJA', NULL),
(102, 'OLGA ARACELI', 'RINCON', 'SALAS', NULL, 6, 'BAJA', NULL),
(103, 'CRISTIAN', 'TORRES', 'MORENO', NULL, 5, 'BAJA', NULL),
(104, 'LUIS ROGELIO', 'CRUZ', 'ESCAMILLA', NULL, 19, 'BAJA', NULL),
(105, 'DANIEL', 'QUINTERO', 'CONTRERAS', NULL, 11, 'BAJA', NULL),
(106, 'MARTHA PAMELA', 'GOMEZ', 'JIMENEZ', NULL, 15, 'BAJA', NULL),
(107, 'MAURICIO', 'NUÑEZ', 'COLIN', NULL, 6, 'BAJA', NULL),
(108, 'ARMANDO', 'CHAVEZ', 'GUERRERO', NULL, 6, 'BAJA', NULL),
(109, 'BEATRIZ', 'FLORES', 'GARCIA', NULL, 6, 'BAJA', NULL),
(110, 'JOSÉ FERNANDO', 'ADRÍAN', 'RUÍZ', NULL, 5, 'BAJA', NULL),
(111, 'DANIEL', 'SANCHEZ', 'PEREZ', NULL, 11, 'BAJA', NULL),
(112, 'VICTOR HUGO', 'SANCHEZ', 'REMIGIO', NULL, 9, 'BAJA', NULL),
(113, 'VALERIA', 'TOLEDO', 'FLORES', NULL, 16, 'BAJA', NULL),
(114, 'LUIS ARTURO', 'GOMEZ', 'ULLOA', NULL, 6, 'BAJA', NULL),
(115, 'ERNESTO ARMANDO', 'GALINDO', 'NAVA', NULL, 9, 'BAJA', NULL),
(116, 'MARCO ANTONIO', 'RAMIREZ', 'MARTÍNEZ', NULL, 1, 'BAJA', NULL),
(117, 'OSWALDO', 'ESPINOZA', 'HERNANDEZ', NULL, 9, 'BAJA', NULL),
(118, 'CARLOS IGNACIO', 'CASTAÑEDA', 'CASTAÑEDA', NULL, 9, 'BAJA', NULL),
(119, 'LUIS HUMBERTO', 'VILLEGAS', 'OLAVARRÍA', NULL, 1, 'BAJA', NULL),
(120, 'GUADALUPE MONTSERRAT', 'ECHEVERRI', 'TENORIO', NULL, 15, 'BAJA', NULL),
(121, 'TERESA DE LA CONCEPCION', 'ESTRADA', 'LOPEZ', NULL, 20, 'BAJA', NULL),
(122, 'MARIA MAGDALENA', 'FUENTES', 'GONZALEZ', NULL, 16, 'BAJA', NULL),
(123, 'MARIA NEUSFTALID', 'MANCILLA', 'PEREZ', NULL, 17, 'BAJA', NULL),
(124, 'ELY KATYA', 'MARES', 'JUAREZ', NULL, 15, 'BAJA', NULL),
(125, 'ARIANNA', 'ARRIAGA', 'VARGAS', NULL, 17, 'BAJA', NULL),
(126, 'LUIS ALBERTO', 'VELEZ', 'CASTILLO', NULL, 19, 'BAJA', NULL),
(127, 'JULIE ALEJANDRA', 'ROMO', 'MEJIA', NULL, 15, 'BAJA', NULL),
(128, 'BIANCA', 'MONTOYA', 'DÍAZ', NULL, 3, 'BAJA', NULL),
(129, 'GUSTAVO GABRIEL', 'GODINEZ', 'RIVAS', NULL, 3, 'BAJA', NULL),
(130, 'ALEJANDRA', 'ALCAYDE', 'CONTRERAS', NULL, 3, 'BAJA', NULL),
(131, 'MARCO ANTONIO', 'GUTIERREZ', 'GUTIERREZ', NULL, 3, 'BAJA', NULL),
(132, 'MARCO ANTONIO', 'SUAREZ', 'ISASSI', NULL, 15, 'BAJA', NULL),
(133, 'MARIANA JANETH', 'ESTRADA', 'CASTILLO', NULL, 6, 'BAJA', NULL),
(134, 'ESTHELA', 'HERNANDEZ', 'GONZALEZ', NULL, 3, 'BAJA', NULL),
(135, 'MIGUEL ANGEL', 'ISIDRO', 'TAPIA', NULL, 23, 'BAJA', NULL),
(136, 'MAYRA MARIELA', 'MORA', 'CARMONA', NULL, 17, 'BAJA', NULL),
(137, 'MIRIAM MONTSERRAT', 'LECHUGA', 'NOLASCO', NULL, 15, 'BAJA', NULL),
(138, 'ALEJANDRA', 'TERRAZAS', 'LOPEZ', NULL, 24, 'BAJA', NULL),
(139, 'ROMAN HECTOR', 'RODRIGUEZ', 'ADAN', NULL, 23, 'BAJA', NULL),
(140, 'RODOLFO ALEXANDER', 'NUÑEZ', 'ALVAREZ', NULL, 8, 'BAJA', NULL),
(141, 'GUADALUPE ARIANA', 'ARIZMENDI', 'ROMERO', NULL, 4, 'BAJA', NULL),
(142, 'JOSE SERGIO', 'LARA', 'AHUATZI', NULL, 4, 'BAJA', NULL),
(143, 'JOSUE WILEBALDO', 'LARA', 'SALINAS', NULL, 27, 'BAJA', 'M'),
(144, 'NOEMI', 'COVA', 'ESCALONA', NULL, 15, 'BAJA', NULL),
(145, 'ANDREA ELIZABETH', 'VILCHIS', 'ARROYO', NULL, 15, 'BAJA', NULL),
(146, 'FERMIN', 'DE LA CRUZ', 'CHIGORA', NULL, 13, 'BAJA', NULL),
(147, 'KAREN', 'GARCIA RIVAS', 'DIAZ GALINDO', NULL, 13, 'BAJA', NULL),
(148, 'MARIA YARED', 'REYES', 'ROMERO', NULL, 20, 'BAJA', NULL),
(149, 'EDUARDO', 'CANDIA', 'MORON ', NULL, 6, 'BAJA', NULL),
(150, 'VICENTE', 'DOMINGUEZ', 'GARCIA', NULL, 13, 'BAJA', NULL),
(151, 'ANUAR', 'MANJARREZ', 'CHAVEZ', NULL, 3, 'BAJA', NULL),
(152, 'JESUS ALEJANDRO', 'RESENDIZ', 'DIAZ', NULL, 6, 'BAJA', NULL),
(153, 'EFRAIN', 'SOLANO', 'ALEGRIA', NULL, 19, 'BAJA', NULL),
(154, 'MAURICIO HIRAM', 'ANDRADE', 'VACA', NULL, 19, 'BAJA', NULL),
(155, 'ALVARO', 'VALDESPINO', 'CHAVEZ', NULL, 17, 'BAJA', NULL),
(156, 'CARLOS GABRIEL', 'CASTRO', 'NUÑEZ', NULL, 15, 'BAJA', NULL),
(157, 'JOSE ANTONIO', 'MARTINEZ', 'ORIVE', NULL, 12, 'BAJA', NULL),
(158, 'CARMEN WENDY', 'REYES', 'HERRERA', NULL, 8, 'BAJA', NULL),
(159, 'KAREN', 'AYALA', 'CORRES', NULL, 8, 'BAJA', NULL),
(160, 'GIBRAN', 'MARTINEZ', 'ANDRES', NULL, 12, 'BAJA', NULL),
(161, 'JORGE', 'BAEZ', 'BECERRIL', NULL, 9, 'BAJA', NULL),
(162, 'BRANDON', 'HERNANDEZ', 'TREJO', NULL, 8, 'BAJA', NULL),
(163, 'ANTONIO ENRIQUE', 'MONDRAGON', 'DIAZ', NULL, 5, 'BAJA', NULL),
(164, 'EDUARDO', 'MILLAN', 'SANTOS', NULL, 5, 'BAJA', NULL),
(165, 'JERONIMO', 'PIÑA', 'CRISTOBAL', NULL, 5, 'BAJA', NULL),
(166, 'GUSTAVO', 'CALDERON', 'MARTINEZ', NULL, 5, 'BAJA', NULL),
(167, 'CARLOS FELIPE', 'FUENTES', 'DEL RIO', NULL, 13, 'BAJA', NULL),
(168, 'KARLA ISABEL', 'GARCIA RIVAS ', 'GARCIA', NULL, 23, 'BAJA', NULL),
(169, 'DULCE MELISSA', 'FLORES', 'ALVAREZ', NULL, 15, 'BAJA', NULL),
(170, 'YAIHVE', 'RAMIREZ', 'CAMACHO', NULL, 16, 'BAJA', NULL),
(171, 'ANA ISABEL', 'CAMBRON', 'LOPEZ', NULL, 20, 'BAJA', NULL),
(172, 'RAMON', 'RODRIGUEZ', 'DIAZ', NULL, 11, 'BAJA', NULL),
(173, 'ESMERALDA', 'SOLIS', 'CRUZ', NULL, 6, 'BAJA', NULL),
(174, 'RODOLFO', 'FIGUEROA', 'RIVAS', NULL, 3, 'BAJA', NULL),
(175, 'GASTON', 'GARCIA', 'GALINDO', NULL, 19, 'BAJA', NULL),
(176, 'CARLOS ALBERTO', 'PRADO', 'SANCHEZ', NULL, 20, 'BAJA', NULL),
(177, 'ESTEPHANI ALICIA', 'VIEYRA', 'MATIAS', NULL, 3, 'BAJA', NULL),
(178, 'ADALID LEONEL', 'DOMINGUEZ', 'MEJIA', NULL, 9, 'BAJA', NULL),
(179, 'ADULFO', 'GOMEZ', 'MACEDO', NULL, 12, 'BAJA', NULL),
(180, 'ULISES AGUSTIN', 'REYES', 'ANDRADE', NULL, 3, 'BAJA', NULL),
(181, 'MAURO', 'ENRIQUEZ', ' ZAMORA', NULL, 9, 'BAJA', NULL),
(182, 'DAVID HORACIO', 'AGRAMONTE', 'MORA', NULL, 11, 'BAJA', NULL),
(183, 'ELIZABETH', 'CASTILLO', 'COLIN', NULL, 16, 'BAJA', NULL),
(184, 'LIZETH ARIADNA', 'PEREZ', 'CASTILLO', NULL, 24, 'BAJA', NULL),
(185, 'JORGE', 'BAEZ', 'BECERRIL', NULL, 9, 'BAJA', NULL),
(186, 'JUAN CARLOS', 'OVANDO', 'QUINTANA', '210140086', 26, 'BAJA', 'M'),
(187, 'RICARDO', 'GARCIA', 'MOLINA', NULL, 23, 'BAJA', NULL),
(188, 'VICTORIA', 'ZUÑIGA', 'BURGOS', NULL, 6, 'BAJA', NULL),
(189, 'EZEQUIEL JESUS', 'MARTINEZ', 'SOTERO', NULL, 14, 'BAJA', NULL),
(190, 'JAVIER', 'TORRES', 'QUINTANILLA', NULL, 8, 'BAJA', NULL),
(191, 'ALFREDO', 'HERNANDEZ', 'ZAVALETA', NULL, 9, 'BAJA', NULL),
(192, 'NATALY', 'CORTEZ', 'CISNEROS', NULL, 6, 'BAJA', NULL),
(193, 'ELIZABETH', 'CASTILLO', 'COLIN', NULL, 16, 'BAJA', NULL),
(194, 'AMAYRANI ABIGAIL', 'OJEDA', 'ARMENTA', NULL, 8, 'BAJA', NULL),
(195, 'LUIS ANTONIO', 'AVILES', 'GONZALEZ', NULL, 3, 'BAJA', NULL),
(196, 'LUIS ALBERTO', 'CONTRERAS', 'FONSECA', NULL, 9, 'BAJA', NULL),
(197, 'VICTORIA', 'ZUÑIGA', 'BURGOS', NULL, 6, 'BAJA', NULL),
(198, ' DIANA LAURA', 'SANCHEZ', 'RUIZ', NULL, 4, 'BAJA', NULL),
(199, 'ALDO', 'AGUILAR', 'CARMONA', NULL, 7, 'BAJA', NULL),
(200, 'EZEQUIEL', 'MARTINEZ', 'SOTERO', NULL, 6, 'BAJA', NULL),
(201, 'GERARDO', 'LÓPEZ', 'SALAZAR', NULL, 4, 'BAJA', NULL),
(202, 'NATALY', 'CORTEZ', 'CISNEROS', NULL, 6, 'BAJA', NULL),
(203, 'VACANTE', 'Y', 'Z', NULL, 21, 'BAJA', NULL),
(204, 'ROMAN HECTOR', 'RODRIGUEZ', 'ADAN', NULL, 23, 'BAJA', NULL),
(205, 'MIGUEL', 'CRUZ', 'GARRIDO', NULL, 5, 'BAJA', NULL),
(206, 'OSCAR MARIO', 'FLORES', 'GOMEZ', NULL, 21, 'BAJA', NULL),
(207, 'CEZANNE', 'ALVAREZ', 'SOTO', NULL, 4, 'BAJA', NULL),
(208, 'MARIA LORENA', 'SALGADO', 'FRAGOSO', NULL, 10, 'BAJA', NULL),
(209, 'PEDRO', 'AMARO', 'GALINDO', NULL, 10, 'BAJA', NULL),
(210, 'ALEJANDRO', 'REYES', 'CORTAZAR', NULL, 19, 'BAJA', NULL),
(211, 'OSCAR', 'VEGA', 'HERNANDEZ', NULL, 27, 'BAJA', NULL),
(212, 'ALAN FIDELIO', 'MATIAS', 'PANIAHUA', NULL, 17, 'BAJA', NULL),
(213, 'EMMANUEL', 'MONTES', '', NULL, 26, 'BAJA', NULL),
(214, 'SERGIO', 'ARRIAGA', 'ARAUJO', NULL, 6, 'BAJA', NULL),
(215, 'CARLOS EDUARDO', 'HERNANDEZ', 'AGUILAR', NULL, 20, 'BAJA', NULL),
(216, 'DANIEL', 'QUINTERO', 'CONTRERAS', NULL, 11, 'BAJA', NULL),
(217, 'PEDRO', 'AMARO', 'GALINDO', NULL, 10, 'BAJA', NULL),
(218, 'CLAUDIA IVETTE', 'GONZÁLEZ', 'GONZÁLEZ', NULL, 13, 'BAJA', NULL),
(219, 'MARIA FERNANDA', 'ALCANTARA', 'MEDRANO', '210140101', 26, 'BAJA', 'F'),
(220, 'ALVARO', 'VALDESPINO', 'CHAVEZ', NULL, 17, 'BAJA', NULL),
(221, 'ADRIANA FABIOLA', 'PALLARES', 'MIRANDA', NULL, 3, 'BAJA', NULL),
(222, 'HERIBERTO', 'MENDEZ', 'CRUZ', NULL, 4, 'ALTA', 'M'),
(223, 'MARIA DE LA LUZ', 'NUÑEZ', 'CAMACHO', NULL, 1, 'ALTA', 'F'),
(224, 'BRENDA', 'HERNANDEZ', 'GARCIA', NULL, 2, 'ALTA', 'F'),
(225, 'MARIA DE LOS ANGELES', 'MORENO', 'ESTRADA', NULL, 1, 'ALTA', 'F'),
(226, 'SANDRA', 'ESQUIVEL', 'VILCHIS', NULL, 22, 'ALTA', 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_tecnico`
--

CREATE TABLE `personal_tecnico` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `siniestro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listao de las personas  responsables de lareparacion';

--
-- Volcado de datos para la tabla `personal_tecnico`
--

INSERT INTO `personal_tecnico` (`id`, `nombre`, `siniestro_id`) VALUES
(1, 'TEC 1 ', 3),
(2, 'TEC 2', 3),
(3, 'TEC 3', 3),
(4, 'TEC 1 ', 5),
(5, 'TEC 2', 5),
(6, 'TEC 3', 5),
(7, 'TEC 1 ', 6),
(8, 'TEC 2', 6),
(9, 'TEC 3', 6),
(10, 'QQQQ1', 7),
(11, 'EEEEEE2', 7),
(12, 'ASDASD', 8),
(13, 'ÑLKJHGFDS', 8),
(14, 'ZXCZXCZX', 9),
(15, 'ADASDASD', 9),
(16, 'POIUYTRE', 9),
(17, 'ANA', 10),
(18, 'MARIA', 10),
(19, 'ROMERO', 10),
(20, 'CAMACHO', 10),
(21, 'EMMANUEL', 11),
(22, 'MONTES ', 11),
(23, 'LUGO', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id` int(11) NOT NULL,
  `falla` int(11) NOT NULL COMMENT 'FK de la tabla de catalogo_fallas',
  `solicitud` int(11) NOT NULL COMMENT 'FK de la tabla de solicitudes',
  `taller` int(11) NOT NULL COMMENT 'FK de la tabla de talleres'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lista de reparaciones realizadas ';

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`id`, `falla`, `solicitud`, `taller`) VALUES
(1, 27, 1, 4),
(2, 6, 1, 3),
(6, 74, 1, 3),
(7, 74, 1, 3),
(8, 13, 1, 4),
(9, 69, 1, 4),
(10, 12, 1, 3),
(11, 57, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `siniestros`
--

CREATE TABLE `siniestros` (
  `id` int(11) NOT NULL,
  `aseguradora` varchar(255) NOT NULL,
  `f_hechos` date NOT NULL COMMENT 'Fecha en la que ocurrieron los hechos ',
  `f_entrada` date NOT NULL COMMENT 'Fecha en la que ingresa al taller el auto',
  `f_salida` date NOT NULL COMMENT 'Fecha en la que salio el auto del taller',
  `observaciones` text DEFAULT NULL,
  `solicitud_id` int(11) NOT NULL COMMENT 'FK de la tabla de solicitudes',
  `estatus` enum('Creada','En proceso','Finalizada') NOT NULL DEFAULT 'Creada' COMMENT 'Estado en el que se encuentra el siniestro',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de registro automatica'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de siniestros ';

--
-- Volcado de datos para la tabla `siniestros`
--

INSERT INTO `siniestros` (`id`, `aseguradora`, `f_hechos`, `f_entrada`, `f_salida`, `observaciones`, `solicitud_id`, `estatus`, `created_at`) VALUES
(10, 'SEGUROS ANA', '2019-10-01', '2019-10-16', '2019-10-08', 'SIN COMETARIOS ', 1, 'Creada', '2019-10-30 09:44:49'),
(11, 'SEGUROS AXA', '2019-10-02', '2019-10-09', '2019-10-30', 'SIN COMENTARIOS', 1, 'Creada', '2019-10-30 09:48:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL COMMENT 'PK',
  `folio` varchar(100) NOT NULL,
  `f_sol` date NOT NULL,
  `km` int(11) DEFAULT NULL,
  `solicitante` int(11) NOT NULL COMMENT 'FK de la tabla personal',
  `vehiculo` int(11) NOT NULL COMMENT 'FK de la  tabla vehiculos ',
  `estado` enum('Creada','Atendida') DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de solicitudes ';

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `folio`, `f_sol`, `km`, `solicitante`, `vehiculo`, `estado`, `descripcion`) VALUES
(1, '2019-001', '2019-10-04', 230510, 186, 3, 'Creada', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleres`
--

CREATE TABLE `talleres` (
  `id` int(11) NOT NULL,
  `r_social` varchar(255) NOT NULL COMMENT 'Nombre de la razón social',
  `contacto` varchar(255) NOT NULL COMMENT 'Nombre de la persona de contacto ',
  `telefono` varchar(20) NOT NULL COMMENT 'Telefono de contacto',
  `correo` varchar(255) DEFAULT NULL COMMENT 'Direccion de correo electronico',
  `domicilio` text NOT NULL COMMENT 'Ubicacion del lugar',
  `estado` enum('Activa','Baja') NOT NULL DEFAULT 'Activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Catalogo de talleres ';

--
-- Volcado de datos para la tabla `talleres`
--

INSERT INTO `talleres` (`id`, `r_social`, `contacto`, `telefono`, `correo`, `domicilio`, `estado`) VALUES
(3, 'COCA COLA SA DE CV ', 'JUAN QUINTANA', '(722) 235-2235', 'cocas@coca.com', 'AVENIDA ADOLFO LOPEZ MATEOS\r\n', 'Activa'),
(4, 'ISUZU SA DE CV', 'ARMANDO JIMENEZ', '(789) 512-5463', 'superescandalo_12@hotmail.com', 'SIN DIRECCIÓN ', 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_v`
--

CREATE TABLE `tipos_v` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL COMMENT 'Nombre del tipo de vehiculo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_v`
--

INSERT INTO `tipos_v` (`id`, `nom`) VALUES
(1, 'JETTA CLASICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_fallas`
--

CREATE TABLE `tipo_fallas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de tipos de fallas';

--
-- Volcado de datos para la tabla `tipo_fallas`
--

INSERT INTO `tipo_fallas` (`id`, `nombre`) VALUES
(1, 'Sistema de Arranque'),
(2, 'Revisión de Distribución'),
(3, 'Revisión de Sistema de Enfriamiento'),
(4, 'Revisión de Suspensión y Dirección'),
(5, 'Revisión de Motor'),
(6, 'Revisión de Transmisión y Clutch'),
(7, 'Revisión de Sistema de Aceleración'),
(8, 'Revisión de Neumáticos'),
(9, 'Revisión de Sistema Eléctrico'),
(10, 'Revisión de Partes Externas de la Unidad (Vehículo)'),
(11, 'Revisión de Frenos'),
(12, 'Revisión de Panel de Instrumentos (Tablero)e Indicadores y Odómetro'),
(13, 'Afinación Mayor'),
(14, 'Afinación Menor'),
(15, 'Verificaciones'),
(16, 'Hojalatería y Pintura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL COMMENT 'PK',
  `nick` varchar(100) NOT NULL COMMENT 'Nombre de la cuenta de usuario ',
  `pass` varchar(255) NOT NULL COMMENT 'Contraseña del usuario',
  `person_id` int(11) NOT NULL COMMENT 'FK de la tabla personal',
  `area_id` int(11) NOT NULL COMMENT 'FK de la tabla área',
  `perfil` enum('Solicitante','Habilitado','Vigilancia','Recursos Materiales','Directivo') NOT NULL,
  `status` enum('Activo','Baja') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de las cuentas de usuario';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nick`, `pass`, `person_id`, `area_id`, `perfil`, `status`) VALUES
(1, 'james', 'L3hDN1hsbVhkdzhLV2lEd1JGY09tdz09', 186, 26, 'Habilitado', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL COMMENT 'PK',
  `tipo` int(11) NOT NULL COMMENT 'Tipo de auto',
  `marca` int(11) NOT NULL COMMENT 'Nombre del fabricante',
  `placas` varchar(100) NOT NULL COMMENT 'Numero de las placas',
  `n_resguardo` varchar(100) NOT NULL COMMENT 'Numero de resguardo',
  `color` enum('ROJO','AZUL','NEGRO','GRIS','BLANCO','VINO','MORADO','NARANJA','VERDE','CAFE','AMARILLO','DORADO') NOT NULL COMMENT 'Color del carro',
  `niv` varchar(100) NOT NULL COMMENT 'Serie vehicular',
  `n_motor` varchar(100) NOT NULL COMMENT 'Numero del motor',
  `modelo` varchar(11) NOT NULL COMMENT 'año del auto',
  `cil` int(10) NOT NULL COMMENT 'Numero de cilindros',
  `resguardatario` int(11) NOT NULL COMMENT 'FK de la tabla de personal ',
  `estado` enum('ACTIVO','DESCOMPUESTO') NOT NULL,
  `observaciones` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha del alta del carro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de Vehículos';

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `tipo`, `marca`, `placas`, `n_resguardo`, `color`, `niv`, `n_motor`, `modelo`, `cil`, `resguardatario`, `estado`, `observaciones`, `created_at`) VALUES
(1, 1, 1, 'LXP8690', '123456789', 'ROJO', '0987654321', '7410852963', '2010', 4, 186, 'ACTIVO', 'SIN COMENTARIOS', '2019-10-04 10:33:48'),
(2, 1, 1, 'NGH8690', '23456789', 'ROJO', '987654321', '567892340987', '2010', 4, 67, 'ACTIVO', 'JASJASJASDJASJD', '2019-10-21 23:09:09'),
(3, 1, 1, 'MAL8690', '23456789', 'VINO', '987456321', '567892340987', '2010', 4, 51, 'ACTIVO', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-10-22 21:35:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `catalogo_fallas`
--
ALTER TABLE `catalogo_fallas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Indices de la tabla `ingreso_taller`
--
ALTER TABLE `ingreso_taller`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `model_id` (`model_id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clave` (`clave`),
  ADD KEY `ua_id` (`area_id`);

--
-- Indices de la tabla `personal_tecnico`
--
ALTER TABLE `personal_tecnico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `falla` (`falla`),
  ADD KEY `solicitud` (`solicitud`),
  ADD KEY `taller` (`taller`);

--
-- Indices de la tabla `siniestros`
--
ALTER TABLE `siniestros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_id` (`solicitud_id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitante` (`solicitante`),
  ADD KEY `vehiculo` (`vehiculo`);

--
-- Indices de la tabla `talleres`
--
ALTER TABLE `talleres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_v`
--
ALTER TABLE `tipos_v`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_fallas`
--
ALTER TABLE `tipo_fallas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca` (`marca`),
  ADD KEY `tipo` (`tipo`),
  ADD KEY `resguardatario` (`resguardatario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `catalogo_fallas`
--
ALTER TABLE `catalogo_fallas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `ingreso_taller`
--
ALTER TABLE `ingreso_taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT de la tabla `personal_tecnico`
--
ALTER TABLE `personal_tecnico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `siniestros`
--
ALTER TABLE `siniestros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `talleres`
--
ALTER TABLE `talleres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos_v`
--
ALTER TABLE `tipos_v`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_fallas`
--
ALTER TABLE `tipo_fallas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catalogo_fallas`
--
ALTER TABLE `catalogo_fallas`
  ADD CONSTRAINT `catalogo_fallas_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_fallas` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `modulos` (`id`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);

--
-- Filtros para la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD CONSTRAINT `reparaciones_ibfk_1` FOREIGN KEY (`falla`) REFERENCES `catalogo_fallas` (`id`),
  ADD CONSTRAINT `reparaciones_ibfk_2` FOREIGN KEY (`solicitud`) REFERENCES `solicitudes` (`id`),
  ADD CONSTRAINT `reparaciones_ibfk_3` FOREIGN KEY (`taller`) REFERENCES `talleres` (`id`);

--
-- Filtros para la tabla `siniestros`
--
ALTER TABLE `siniestros`
  ADD CONSTRAINT `siniestros_ibfk_1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`solicitante`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculos` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`marca`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`tipo`) REFERENCES `tipos_v` (`id`),
  ADD CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`resguardatario`) REFERENCES `personal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
