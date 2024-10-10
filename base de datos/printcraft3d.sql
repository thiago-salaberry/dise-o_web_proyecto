-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2024 a las 16:46:07
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
-- Base de datos: `printcraft3d`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID_carrito` int(11) NOT NULL,
  `ID_producto` int(11) NOT NULL,
  `ID_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_cliente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_cliente`, `nombre`, `apellido`, `pais`, `direccion`, `telefono`, `email`, `contraseña`) VALUES
(1, 'Sebastián', 'Salaberry', 'Argentina', 'Los Platanos', '01151128601', 'lizule.mamani79@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_personalizados`
--

CREATE TABLE `pedidos_personalizados` (
  `ID_pedido` int(11) NOT NULL,
  `ID_cliente` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_producto` int(11) NOT NULL,
  `nombre_prod` varchar(255) NOT NULL,
  `precio_prod` decimal(10,2) NOT NULL,
  `descripcion_prod` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_producto`, `nombre_prod`, `precio_prod`, `descripcion_prod`) VALUES
(1, 'Figura coleccionable de Breaking Bad', 49.99, 'Figura coleccionable de Walter White con traje de laboratorio, perfecta para los fanáticos de la serie Breaking Bad.'),
(2, 'Figura coleccionable de Wall-E', 39.99, 'Figura detallada del adorable robot Wall-E, ideal para coleccionistas y amantes de Pixar.'),
(3, 'Figura coleccionable de Han Solo', 59.99, 'Figura clásica de Han Solo, uno de los héroes más icónicos de la saga Star Wars, en una postura de acción.'),
(4, 'Reloj decorativo para casa', 24.99, 'Reloj de pared moderno con un diseño minimalista, ideal para decorar cualquier espacio del hogar.'),
(5, 'Soporte para celular', 9.99, 'Soporte para celular ajustable, diseñado para mantener tu dispositivo estable mientras trabajas o ves videos.'),
(6, 'Maceta decorativa', 19.99, 'Maceta decorativa de cerámica con diseño artístico, perfecta para interiores y exteriores.'),
(7, 'Prótesis de mano', 299.99, 'Prótesis de mano de alta calidad, diseñada para proporcionar funcionalidad y confort.'),
(8, 'Bota ortopédica', 149.99, 'Bota ortopédica ajustable, diseñada para la recuperación de lesiones en pies y tobillos.'),
(9, 'Prótesis para perro', 199.99, 'Prótesis ligera y resistente para perro, diseñada para mejorar la movilidad de mascotas con amputaciones.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ID_carrito`),
  ADD KEY `ID_producto` (`ID_producto`),
  ADD KEY `ID_cliente` (`ID_cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_cliente`);

--
-- Indices de la tabla `pedidos_personalizados`
--
ALTER TABLE `pedidos_personalizados`
  ADD PRIMARY KEY (`ID_pedido`),
  ADD KEY `ID_cliente` (`ID_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `ID_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedidos_personalizados`
--
ALTER TABLE `pedidos_personalizados`
  MODIFY `ID_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`ID_producto`) REFERENCES `productos` (`ID_producto`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`ID_cliente`) REFERENCES `clientes` (`ID_cliente`);

--
-- Filtros para la tabla `pedidos_personalizados`
--
ALTER TABLE `pedidos_personalizados`
  ADD CONSTRAINT `pedidos_personalizados_ibfk_1` FOREIGN KEY (`ID_cliente`) REFERENCES `clientes` (`ID_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
