-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2023 a las 06:30:03
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sitio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publi`
--

CREATE TABLE `publi` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publi`
--

INSERT INTO `publi` (`id`, `titulo`, `texto`, `imagen`) VALUES
(1, 'Verano', 'En tirantes\r\nDeja de estar en excusas con qué ponerte. Tus shorts vaqueros y una camiseta de tirantes forman el look más casual. Un cinturón estilo cowboy y un dibujo singular en tu parte de arriba harán distinguir tu estilismo de otros. Rompe el conjunto con una camisa de cuadros anudada a la cintura. Eleva tus prendas con la inspiración rock and roll. ¡Rollazo!', '1676869141_P2.png'),
(9, 'Invierno', 'Abrigo grueso, guantes y botas.', '1676869149_P1.png'),
(10, 'Otoño', 'Los mejores colores son naranja, café y negro.', '1676868583_P2.png'),
(11, 'Primavera', 'Motivos florales\r\nEl fondo de armario lo marcan los vestidos de flores. Cortos o kilométricos. Las distintas fórmulas de esta prenda se hacen de desear. Aunque es cierto que la opción con falda de vuelo destaca por su originalidad y por dar lugar a una imagen esbelta. Además, si eliges un estampado sutil, tu dulzura se multiplicará por mil. ¡Asegurado!', '1676868659_P1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `contrasenia`) VALUES
(1, 'ADMIN1597', '6325410.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `publi`
--
ALTER TABLE `publi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `publi`
--
ALTER TABLE `publi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
