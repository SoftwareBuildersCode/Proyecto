-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2024 a las 11:00:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(11) NOT NULL,
  `caracteristica` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `caracteristica`, `activo`) VALUES
(1, 'talla', 1),
(2, 'color', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(1, '5UB282306W0965058', '2024-08-15 21:38:44', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 31449.90),
(2, '9KU38278TK639712V', '2024-08-15 22:29:46', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(3, '1LC05018XD467241J', '2024-08-15 22:30:19', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(4, '7UC19742X2527931H', '2024-08-15 22:33:04', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(5, '9GL94772R2219112P', '2024-08-15 22:34:54', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(6, '43U35415VW2801641', '2024-08-15 22:36:59', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(7, '7ML89457K3027220F', '2024-08-15 22:38:14', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(8, '41125657KW627451A', '2024-08-15 22:39:13', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(9, '9UG5749504662812C', '2024-08-15 22:42:37', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(10, '9TK6872928786983V', '2024-08-15 22:43:54', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(11, '2DF52185UP082330M', '2024-08-15 22:44:40', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(12, '42K46385N8115245T', '2024-08-15 22:47:47', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(13, '47E37443FK105541M', '2024-08-15 23:03:23', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(14, '28717454SS851632F', '2024-08-15 23:07:23', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(15, '1CL98970712622312', '2024-08-15 23:23:21', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(16, '6XH66066LD133203F', '2024-08-15 23:25:53', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(17, '56V72320LF712021T', '2024-08-15 23:27:32', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(18, '6J637726DC612103L', '2024-08-15 23:33:03', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(19, '0J404240NV699914V', '2024-08-16 19:29:31', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(20, '0T2617141N372412G', '2024-08-16 19:35:42', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30450.00),
(21, '7BA78776SF792493R', '2024-08-16 19:39:27', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 1350.00),
(22, '7XW35381SD873494W', '2024-08-16 20:52:16', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 1350.00),
(23, '4W112980XS000080J', '2024-08-16 20:53:08', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 900.00),
(24, '95H95878P6370761V', '2024-08-16 20:59:39', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 99.90),
(25, '5VK94410JK531832C', '2024-08-16 22:57:21', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 900.00),
(26, '57W25628NS700661P', '2024-08-16 23:03:58', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(27, '5JB70033LF791723J', '2024-08-16 23:10:49', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 99.90),
(28, '14C837116R011753L', '2024-08-16 23:15:55', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(29, '8PA64384F0800960W', '2024-08-16 23:22:01', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(30, '15D74693W6466013X', '2024-08-16 23:22:42', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(31, '36M40489TN511742E', '2024-08-16 23:26:44', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 30000.00),
(32, '1N934355S5174150G', '2024-08-16 23:34:15', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 99.90),
(33, '78S98565UP318190H', '2024-08-16 23:57:12', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 199.80),
(34, '7SG31138T3141194X', '2024-08-17 00:11:28', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 99.90),
(35, '8GF52934HS5253635', '2024-08-19 20:04:08', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 900.00),
(36, '8XP84972ML763035X', '2024-08-19 20:12:08', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 999.90),
(37, '07358683774022830', '2024-08-19 21:20:47', 'COMPLETED', 'sb-bb9cb31620484@personal.example.com', '96Z77R3P5QHEJ', 900.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compra`
--

CREATE TABLE `detalles_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_compra`
--

INSERT INTO `detalles_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'iphone 11', 450.00, 3),
(2, 1, 2, 'iphone f12', 30000.00, 1),
(3, 1, 4, 'smartphone', 99.90, 1),
(4, 2, 2, 'iphone f12', 30000.00, 1),
(5, 3, 2, 'iphone f12', 30000.00, 1),
(6, 4, 2, 'iphone f12', 30000.00, 1),
(7, 5, 2, 'iphone f12', 30000.00, 1),
(8, 6, 2, 'iphone f12', 30000.00, 1),
(9, 7, 2, 'iphone f12', 30000.00, 1),
(10, 8, 2, 'iphone f12', 30000.00, 1),
(11, 9, 2, 'iphone f12', 30000.00, 1),
(12, 10, 2, 'iphone f12', 30000.00, 1),
(13, 11, 2, 'iphone f12', 30000.00, 1),
(14, 12, 2, 'iphone f12', 30000.00, 1),
(15, 13, 1, 'iphone 11', 450.00, 1),
(16, 14, 1, 'iphone 11', 450.00, 1),
(17, 15, 1, 'iphone 11', 450.00, 1),
(18, 15, 2, 'iphone f12', 30000.00, 1),
(19, 16, 1, 'iphone 11', 450.00, 1),
(20, 16, 2, 'iphone f12', 30000.00, 1),
(21, 17, 1, 'iphone 11', 450.00, 1),
(22, 17, 2, 'iphone f12', 30000.00, 1),
(23, 18, 1, 'iphone 11', 450.00, 1),
(24, 18, 2, 'iphone f12', 30000.00, 1),
(25, 19, 1, 'iphone 11', 450.00, 1),
(26, 19, 2, 'iphone f12', 30000.00, 1),
(27, 20, 1, 'iphone 11', 450.00, 1),
(28, 20, 2, 'iphone f12', 30000.00, 1),
(29, 21, 1, 'iphone 11', 450.00, 3),
(30, 22, 1, 'iphone 11', 450.00, 3),
(31, 23, 1, 'iphone 11', 450.00, 2),
(32, 24, 4, 'smartphone', 99.90, 1),
(33, 25, 1, 'iphone 11', 450.00, 2),
(34, 26, 2, 'iphone f12', 30000.00, 1),
(35, 27, 4, 'smartphone', 99.90, 1),
(36, 28, 2, 'iphone f12', 30000.00, 1),
(37, 29, 2, 'iphone f12', 30000.00, 1),
(38, 30, 2, 'iphone f12', 30000.00, 1),
(39, 31, 2, 'iphone f12', 30000.00, 1),
(40, 32, 4, 'smartphone', 99.90, 1),
(41, 33, 4, 'smartphone', 99.90, 2),
(42, 34, 4, 'smartphone', 99.90, 1),
(43, 35, 1, 'iphone 11', 450.00, 2),
(44, 36, 1, 'iphone 11', 450.00, 2),
(45, 36, 4, 'smartphone', 99.90, 1),
(46, 37, 1, 'iphone 11', 450.00, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_productos_caracteristicas`
--

CREATE TABLE `det_productos_caracteristicas` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_carateristicas` int(11) NOT NULL,
  `valor` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `det_productos_caracteristicas`
--

INSERT INTO `det_productos_caracteristicas` (`id`, `id_producto`, `id_carateristicas`, `valor`, `stock`) VALUES
(1, 1, 2, 'Negro', 4),
(2, 1, 2, 'Blanco', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'iphone 11', 'Iphone de 128 GB', 600.00, 25, 2, 1),
(2, 'iphone f12', 'Celular a estrenar ', 30000.00, 0, 1, 1),
(4, 'smartphone', '<b>Caracteristicas:</b><br>\r\n128 gb\r\n', 111.00, 10, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `det_productos_caracteristicas`
--
ALTER TABLE `det_productos_caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_prod` (`id_producto`),
  ADD KEY `fk_det_caracter` (`id_carateristicas`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `det_productos_caracteristicas`
--
ALTER TABLE `det_productos_caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_productos_caracteristicas`
--
ALTER TABLE `det_productos_caracteristicas`
  ADD CONSTRAINT `fk_det_caracter` FOREIGN KEY (`id_carateristicas`) REFERENCES `caracteristicas` (`id`),
  ADD CONSTRAINT `fk_det_prod` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
