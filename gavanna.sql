-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2019 a las 23:12:36
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gavanna`
--
CREATE DATABASE IF NOT EXISTS `gavanna` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `gavanna`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `portada` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `portada`) VALUES
(2, 'Sudaderas', 'props/ropa/categoria/Sudadera.jpg'),
(3, 'Sudaderas Capucha', 'props/ropa/categoria/SudaderaCapucha.jpg'),
(4, 'Pantalones', 'props/ropa/categoria/Pantalones.jpg'),
(5, 'Bermudas', 'props/ropa/categoria/Bermuda.jpg'),
(6, 'Chaquetas', 'props/ropa/categoria/Chaqueta.jpg'),
(8, 'T-shirt', 'props/ropa/categoria/T-shirt.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `color` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id_color`, `color`) VALUES
(1, 'Rojo'),
(2, 'Negro'),
(3, 'Blanco'),
(4, 'Gris'),
(5, 'Verde'),
(6, 'Amarrillo'),
(7, 'Azul'),
(8, 'Morado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `departamento` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `departamento`) VALUES
(1, 'San Salvador'),
(2, 'Santa Ana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id_pedido` int(11) NOT NULL,
  `id_producto_detalle` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id_pedido`, `id_producto_detalle`, `cantidad`) VALUES
(1, 2, 2),
(1, 3, 4),
(3, 4, 1),
(3, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_usuario` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` char(9) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_usuario`, `id_direccion`, `id_municipio`, `direccion`, `telefono`) VALUES
(1, 1, 1, 'Prados de venecia 3 etapa, psj 22', '22702900'),
(13, 2, 2, 'Colonia miramontes casa 55', '77897874');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

CREATE TABLE `estado_pedido` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_pedido`
--

INSERT INTO `estado_pedido` (`id_estado`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_producto` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id_producto`, `id_imagen`, `imagen`) VALUES
(4, 1, 'props/ropa/SudaderaLogoBordado/Blanco.jpg'),
(4, 2, 'props/ropa/SudaderaLogoBordado/Negro.jpg'),
(4, 3, 'props/ropa/SudaderaLogoBordado/Gris.jpg'),
(4, 4, 'props/ropa/SudaderaLogoBordado/Rojo.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `municipio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `municipio`, `id_departamento`) VALUES
(1, 'Soyapango', 1),
(2, 'San Jacinto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` float NOT NULL,
  `cargo_envio` float NOT NULL,
  `monto_total` float NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario`, `fecha`, `subtotal`, `cargo_envio`, `monto_total`, `id_estado`) VALUES
(1, 1, '2019-12-17', 0, 0, 0, 1),
(3, 13, '2019-12-16', 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `descripcion`, `id_categoria`) VALUES
(1, 'BoxLogo Rojo', 50, 'Estandar, 100% algodon, cuello redondo', 8),
(2, 'Estampada Allover', 45, 'Estandar, cuello en U', 8),
(3, 'Skate Coleccion', 55, 'Cuello U, 100% algodon', 8),
(4, 'Sudadera Logo Bordado', 85, 'Algodon, cuello redondo, Unisex', 2),
(5, 'Sudadera Bicolor ', 100, 'Estampada, coleccion Fall, cuello U', 2),
(6, 'Bordado en contraste', 95, 'Unisex, 100% algodon, cuello redondo', 2),
(7, 'Capucha Estampada', 115, 'Estampada en la manga, 100% polyester, cuello U', 3),
(8, 'Capucha Bordada', 120, 'Punto de esponja, algodon cuello en U', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_detalle`
--

CREATE TABLE `producto_detalle` (
  `id_producto_detalle` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_talla` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_detalle`
--

INSERT INTO `producto_detalle` (`id_producto_detalle`, `id_producto`, `id_talla`, `id_color`, `cantidad`) VALUES
(2, 4, 3, 4, 5),
(3, 4, 5, 1, 10),
(4, 4, 1, 2, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `id_talla` int(11) NOT NULL,
  `talla` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`id_talla`, `talla`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `contrasenia`, `id_rol`) VALUES
(1, 'Hector', 'Calles', 'hector7chess@gmail.com', '123', 2),
(4, 'Gaby', 'Gavanna', 'gavanna7766@hotmail.com', '123', 2),
(6, 'JeffreyeJon', 'Hardie', 'hardy988@gmail.com', '123', 2),
(13, 'Matt', 'Hardy', 'matty@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(178, 'hola', 'asdsadsad', 'asdsa@jjj.com', 'c99a11a53a3748269e3f86d7ac38df11', 2),
(194, 'Lic Cristian ', 'Cruz', 'cruz@gmail.com', '58a3713fa2272fb5e53871a9383bbec0', 2),
(196, 'Klonoa ', 'Chess', 'aa@aa.com', 'efc91020c448e85a70aae9c2b9c8b8be', 1),
(197, 'Dimitri', 'Gasparov', 'bb@bb.com', 'efc91020c448e85a70aae9c2b9c8b8be', 2),
(199, 'Michael', 'Jackson', 'jackson5@gmail.com', 'efc91020c448e85a70aae9c2b9c8b8be', 2),
(202, 'Paola', 'Heracles', 'pao123@gmail.com', 'c0834881a8df1ba7619fd6c93d68ce3f', 2),
(203, 'Isidro', 'Peña', 'isidro@gmail.com', '2a166214de0fe325f6f100708d225868', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD KEY `id_producto_detalle` (`id_producto_detalle`),
  ADD KEY `id_pedido` (`id_pedido`,`id_producto_detalle`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `id_usuario` (`id_usuario`,`id_direccion`,`id_municipio`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`,`id_estado`),
  ADD KEY `estadoPedido` (`id_estado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  ADD PRIMARY KEY (`id_producto_detalle`),
  ADD KEY `id_producto` (`id_producto`,`id_talla`,`id_color`),
  ADD KEY `id_talla` (`id_talla`),
  ADD KEY `id_color` (`id_color`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`id_talla`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  MODIFY `id_producto_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `id_talla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `detalles_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `detalles_ibfk_2` FOREIGN KEY (`id_producto_detalle`) REFERENCES `producto_detalle` (`id_producto_detalle`);

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `direccion_ibfk_2` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `estadoPedido` FOREIGN KEY (`id_estado`) REFERENCES `estado_pedido` (`id_estado`),
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  ADD CONSTRAINT `producto_detalle_ibfk_1` FOREIGN KEY (`id_talla`) REFERENCES `talla` (`id_talla`),
  ADD CONSTRAINT `producto_detalle_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`),
  ADD CONSTRAINT `producto_detalle_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
