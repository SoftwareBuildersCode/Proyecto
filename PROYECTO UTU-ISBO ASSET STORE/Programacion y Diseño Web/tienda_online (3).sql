-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 03:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estatus` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `email`, `password`, `fecha_creacion`, `estatus`) VALUES
(1, 'Asset Store admin', 'nachitoserpa87@gmail.com', '$2y$10$i1DjGdZWDL.LzKxBwtxkNOqwZDgtoQXBVxmXeJpkgEC33nMAN.Um2', '2024-11-05 05:33:18', 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(11) NOT NULL,
  `caracteristica` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `caracteristica`, `activo`) VALUES
(1, 'almacenamiento', 1),
(2, 'color', 1),
(3, 'Color', 1),
(4, 'Almacenamiento', 1),
(5, 'Tamaño', 1),
(6, 'Peso', 1),
(7, 'Material', 1),
(8, 'Resolución', 1),
(9, 'Capacidad de batería', 1),
(10, 'Sistema operativo', 1),
(11, 'Número de puertos', 1),
(12, 'Tipo de pantalla', 1),
(13, 'Conectividad', 1),
(14, 'Garantía', 1),
(15, 'Versión', 1),
(16, 'Tipo de procesador', 1),
(17, 'Velocidad del procesador', 1),
(18, 'Número de núcleos', 1),
(19, 'Fecha de lanzamiento', 1),
(20, 'Certificación', 1),
(21, 'Tamaño', 1),
(22, 'Color', 1),
(23, 'Material', 1),
(24, 'Estilo', 1),
(25, 'Tipo de tejido', 1),
(26, 'Ajuste', 1),
(27, 'Instrucciones de cuidado', 1),
(28, 'Marca', 1),
(29, 'Temporada', 1),
(30, 'Estampado', 1),
(31, 'Género', 1),
(32, 'Ocasión', 1),
(33, 'Corte', 1),
(34, 'Longitud', 1),
(35, 'Ancho', 1),
(36, 'Tela forrada', 1),
(37, 'Tipo de cierre', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `activo`) VALUES
(1, 'Electrónica', 'Productos electrónicos y tecnológicos', 1),
(2, 'Ropa', 'Vestimenta y moda para todas las edades', 1),
(3, 'Hogar y Cocina', 'Artículos para el hogar y la cocina', 1),
(4, 'Deportes', 'Artículos deportivos y de ejercicio', 1),
(5, 'Juguetes', 'Juguetes y entretenimiento para niños', 1),
(6, 'Belleza y Cuidado Personal', 'Productos de belleza y cuidado personal', 1),
(7, 'Automóviles', 'Accesorios y repuestos para vehículos', 1),
(8, 'Libros', 'Libros y material de lectura', 1),
(9, 'Muebles', 'Mobiliario y decoración para el hogar', 1),
(10, 'Mascotas', 'Productos para el cuidado de mascotas', 1),
(11, 'Herramientas', 'Herramientas y equipos de construcción', 1),
(12, 'Jardinería', 'Artículos para jardinería y plantas', 1),
(13, 'Salud y Bienestar', 'Productos relacionados con la salud', 1),
(14, 'Joyería y Relojes', 'Artículos de joyería y relojería', 1),
(15, 'Oficina y Papelería', 'Suministros de oficina y papelería', 1),
(16, 'Videojuegos', 'Consolas, juegos y accesorios', 1),
(17, 'Computación', 'Accesorios y equipos de computación', 1),
(18, 'Calzado', 'Zapatos y calzado en general', 1),
(19, 'Fotografía', 'Cámaras y equipos de fotografía', 1),
(20, 'Música', 'Instrumentos musicales y accesorios', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modif` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `telefono`, `cedula`, `estatus`, `fecha_alta`, `fecha_modif`, `fecha_baja`) VALUES
(2, 'Nacho', 'Serpa', 'nachoserpa79@gmail.com', '099760992', '54806753', 0, '2024-11-05 01:24:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compra`
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

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalles_compra`
--

CREATE TABLE `detalles_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `det_productos_caracteristicas`
--

CREATE TABLE `det_productos_caracteristicas` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_carateristicas` int(11) NOT NULL,
  `valor` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `det_productos_caracteristicas`
--

INSERT INTO `det_productos_caracteristicas` (`id`, `id_producto`, `id_carateristicas`, `valor`, `stock`) VALUES
(1, 1, 1, '128 GB', 4),
(2, 1, 2, 'Blanco', 3),
(3, 1, 1, '1 TB', 1),
(4, 1, 2, 'Negro', 2);

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `RUT` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `telefono`, `RUT`, `email`, `direccion`, `password`) VALUES
(1, 'Fake Company', '6019521325', '233122', 'test@example.us', '1600 Fake Street', '$2y$10$YJHX98XdyUG1g5ccD3FDaOk/R8PA43potPzR4bB36QIUyFu0ZwpcO'),
(3, 'Empresa Falsa', '3121286800', '12324', 'teste@exemplo.us', 'Rua Inexistente, 2000', '$2y$10$9FCYuK.eklqwF/w0qXjmD.Gb3K6US5FagVHvfLd8oFYX2q53MJU36');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `fecha_subida` date NOT NULL DEFAULT curdate(),
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `imagen`, `precio`, `descuento`, `id_categoria`, `activo`, `fecha_subida`, `id_empresa`) VALUES
(1, 'Iphone 11', 'Iphone 11 nuevo sellado', NULL, 16638.00, 30, 1, 1, '2024-11-05', 1),
(2, 'Samsung', 'Samsung A10 nuevo', NULL, 5000.00, 0, 1, 1, '2024-11-05', 1),
(3, 'Samsung', 'Samsung A70', NULL, 7000.00, 10, 1, 1, '2024-11-05', 1),
(5, 'Nike Tech', 'Campera deportiva nike', NULL, 3200.00, 0, 2, 1, '2024-11-05', 1),
(6, 'Pantalon nike tech', 'Pantalon deportivo nike tech', NULL, 2500.00, 10, 2, 1, '2024-11-05', 1),
(8, 'Short Nike Tech', 'Short Nike Tech', NULL, 1500.00, 15, 2, 1, '2024-11-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(120) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(40) DEFAULT NULL,
  `password_request` int(11) NOT NULL DEFAULT 0,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `activo`, `token`, `token_password`, `password_request`, `id_cliente`) VALUES
(1, 'nacho', '$2y$10$i1DjGdZWDL.LzKxBwtxkNOqwZDgtoQXBVxmXeJpkgEC33nMAN.Um2', 1, 'de3fcd24e23d58b741536cc8baa00813', NULL, 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `det_productos_caracteristicas`
--
ALTER TABLE `det_productos_caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_prod` (`id_producto`),
  ADD KEY `fk_det_caracter` (`id_carateristicas`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `RUT` (`RUT`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_empresa` (`id_empresa`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detalles_compra`
--
ALTER TABLE `detalles_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `det_productos_caracteristicas`
--
ALTER TABLE `det_productos_caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `det_productos_caracteristicas`
--
ALTER TABLE `det_productos_caracteristicas`
  ADD CONSTRAINT `fk_det_caracter` FOREIGN KEY (`id_carateristicas`) REFERENCES `caracteristicas` (`id`),
  ADD CONSTRAINT `fk_det_prod` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
