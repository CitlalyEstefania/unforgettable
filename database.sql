-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 01:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(2, 'Oto&ntilde;o', 'Los mejores posts sobre moda en oto&ntilde;o'),
(11, 'Verano', '&iexcl;Aqu&iacute; encontrar&aacute;s los mejores post de moda para el verano de tus sue&ntilde;os!'),
(12, 'Primavera', 'Los mejores posts sobre moda durante la primavera'),
(13, 'Invierno', '&iexcl;No te quedes con las ganas y disfruta de nuestros posts sobre moda durante el Invierno!'),
(14, 'Novedades', 'Explora las novedades sobre moda en este 2023'),
(15, '&Eacute;xitos', 'Mantente informado sobre los &eacute;xitos dentro del mundo de la moda.');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(1, 'vilchiskamila@gmail.com', '53999', 1681840226),
(2, 'vilchiskamila@gmail.com', '71065', 1681840265),
(3, 'vilchiskamila@gmail.com', '38020', 1681840380),
(4, 'vilchiskamila@gmail.com', '71701', 1681840526),
(5, 'vilchiskamila@gmail.com', '85850', 1681840638),
(6, 'vilchiskamila@gmail.com', '28643', 1681840817),
(7, 'vilchiskamila@gmail.com', '18130', 1681840876),
(8, 'vilchiskamila@gmail.com', '33388', 1681840925),
(9, 'vilchiskamila@gmail.com', '81009', 1681841182),
(10, 'vilchiskamila@gmail.com', '38934', 1681841261),
(11, 'vilchiskamila@gmail.com', '46950', 1681924653),
(12, 'vilchiskamila@gmail.com', '95840', 1681925151),
(13, 'vilchiskamila@gmail.com', '61340', 1681925893),
(14, 'vilchiskamila@gmail.com', '24232', 1681926038),
(15, 'vilchiskamila@gmail.com', '31147', 1681927069),
(16, 'vilchiskamila@gmail.com', '12817', 1681927304),
(17, 'vilchiskamila@gmail.com', '78295', 1682524553),
(18, 'vilchiskamila@gmail.com', '55607', 1682524685),
(19, 'vilchiskamila@gmail.com', '54514', 1682529491),
(20, 'vilchiskamila@gmail.com', '71175', 1682529565),
(21, 'vilchiskamila@gmail.com', '30420', 1682532604),
(22, 'haro@email.com', '53264', 1682703449),
(23, 'haro@email.com', '78495', 1682703451),
(24, 'haro@email.com', '62080', 1682703453),
(25, 'ajeronimo@ucol.mx', '11057', 1682704109),
(26, 'ajeronimo@ucol.mx', '13689', 1682704111),
(27, 'ajeronimo@ucol.mx', '81864', 1684379797),
(28, 'ajeronimo@ucol.mx', '44363', 1684380035);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) UNSIGNED NOT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `edited` tinyint(1) NOT NULL,
  `reported` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `date_time`, `post_id`, `author_id`, `checked`, `edited`, `reported`) VALUES
(7, 'hola\r\n', '2023-05-19 15:11:27', 18, 18, 0, 0, 0),
(8, 'holaaa', '2023-05-19 16:20:32', 21, 13, 0, 0, 0),
(10, 'Me encanta!!!', '2023-05-20 22:10:03', 33, 13, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `like_type` enum('2','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`post_id`, `user_id`, `date`, `like_type`) VALUES
(18, 13, '2023-05-19 21:46:54', '1'),
(18, 18, '2023-05-19 15:11:18', '1'),
(19, 13, '2023-05-17 04:49:47', '1'),
(19, 18, '2023-05-17 04:13:58', '1'),
(20, 13, '2023-05-19 20:52:39', '1'),
(20, 18, '2023-05-19 01:03:16', '1'),
(21, 13, '2023-05-19 21:07:58', '1'),
(21, 18, '2023-05-17 02:57:28', '1'),
(33, 13, '2023-05-20 22:09:51', '1');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `is_featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `thumbnail`, `date_time`, `category_id`, `author_id`, `checked`, `is_featured`) VALUES
(18, '&iquest;Cu&aacute;l es el mejor vestido de flores accesibles para esta Primavera 2023?', 'Florencia Davalos\r\nVestido de flores en tonos rosas.', '1679348026primaveravestido.png', '2023-03-20 21:33:46', 12, 13, 1, 0),
(19, '&iquest;C&oacute;mo llevar vestidos midi con zapatos planos en verano 2023?', 'Simplemente, es una combinaci&oacute;n que funciona bastante bien, los vestidos midi centran la atenci&oacute;n en tu par favorito, y a su vez, los zapatos bajos aportan un toque elegante al look general. ', '1679348204veranovestido.png', '2023-03-20 21:36:44', 11, 13, 1, 0),
(20, 'La playera tipo polo est&aacute; de regreso para darle un giro a la moda', 'Creada en 1927 por la famosa marca del cocodrilo, la playera polo regresa para darle un nuevo giro a la moda en 2023.', '1679348383polo.png', '2023-03-20 21:39:43', 15, 13, 1, 0),
(21, 'Los mejores looks street style para ir oficina en Oto&ntilde;o 2023', 'Viste con estilo (sin sacrificar la comodidad) para ir a la oficina siguiendo estas tendencias del street style Oto&ntilde;o.', '1679348585otoñoo.png', '2023-03-20 21:43:05', 2, 13, 1, 0),
(29, 'Estampados florales y tonos pastel', 'En el 2023, los estampados florales y los tonos pastel est&aacute;n dominando la temporada de primavera/verano. Combina una blusa con estampado floral con unos pantalones en tono pastel para lucir fresca y a la moda. &iexcl;Perfecto para los&nbsp;d&iacute;as&nbsp;soleados!', '1684618859WhatsApp Image 2023-05-19 at 19.54.43.jpg', '2023-05-20 21:40:59', 12, 21, 1, 0),
(30, 'Revive los 90: el estilo grunge est&aacute; de vuelta', 'El estilo grunge de los a&ntilde;os 90 ha vuelto con fuerza en el 2023. Apuesta por una camiseta de bandas de rock, unos jeans desgastados y unas botas combat para lograr un look alternativo y aut&eacute;ntico. &iexcl;Despierta tu esp&iacute;ritu&nbsp;rebelde!', '1684619445a.jpg', '2023-05-20 21:50:45', 14, 21, 1, 0),
(31, 'Apuesta por la moda sostenible: reutiliza tu ropa vieja', 'En el 2023, la moda sostenible es m&aacute;s importante que nunca. Reutiliza tu ropa vieja mediante el upcycling. Transforma una camisa en un top sin mangas o convierte unos vaqueros en una falda. &iexcl;Haz una declaraci&oacute;n de moda y cuida&nbsp;del&nbsp;planeta!', '1684619598w.jpg', '2023-05-20 21:53:18', 14, 21, 1, 0),
(32, 'Minimalismo chic: elegancia con prendas b&aacute;sicas', 'El minimalismo sigue siendo tendencia en el 2023. Opta por un look chic y sofisticado utilizando prendas b&aacute;sicas como una blusa blanca, pantalones negros y zapatos de tac&oacute;n. Agrega unos accesorios delicados y estar&aacute;s lista para cualquier&nbsp;ocasi&oacute;n.', '1684619632e.jpg', '2023-05-20 21:53:52', 15, 21, 1, 0),
(33, 'Festival de estilo: looks bohemios para el verano', 'Los festivales de verano son la oportunidad perfecta para lucir un look bohemio y libre. Combina un vestido de flores con una chaqueta de flecos y unas sandalias c&oacute;modas. Completa el conjunto con un sombrero y accesorios &eacute;tnicos para lograr un estilo&nbsp;boho&nbsp;aut&eacute;ntico.', '1684619655q.jpg', '2023-05-20 21:54:15', 11, 21, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `checked`, `is_admin`) VALUES
(13, 'Citlaly Estefan&iacute;a', 'Samano L&oacute;pez', 'Estftz', 'csamano@ucol.mx', '$2y$10$WpcRIII940z.lhxBu.1OPefb.UK94CrBLGQah8fSU1QsFvpGx83PG', '167910463221c49bac13a5e6c5def42862826ccf08.jpg', 1, 1),
(18, 'Alejandro', 'Jeronimo Azamar', 'alex', 'ajeronimo@ucol.mx', '$2y$10$NMnc1CwU2yuxzXNvztkMiOVzuoM9l6iiCt1asg7Wce8Oc4D7WZrdy', '646642f6c3b9a.jpg', 1, 1),
(20, 'Fernanda Tonantzin', 'Gonz&aacute;lez Peredia', 'Tona', 'fgonzalez33@ucol.mx', '$2y$10$7euzLRBaOfIXZRMOIyjbcuqUZd2aaeRh8syOXMHx.ywDaXTs3BV5a', '646939d380a34.jpg', 1, 1),
(21, 'Citlaly Estefan&iacute;a', 'Samano L&oacute;pez', 'kami', 'kvilchis@ucol.mx', '$2y$10$pFAx4ywosvx8jOIJGlYCuu75NJiunOYL3w18TkEba6m0.YTpv/YdG', '64693a4bf0742.jpg', 1, 1),
(22, 'Cesar Jared', 'Cobian Garcia', 'cesar', 'ccobian8@ucol.mx', '$2y$10$ky6GmjWm591psIZLvcIaPe47favVjLhc09iuarm1h6OaYC.iuKY4u', '64693b19bb47c.jpg', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `expire` (`expire`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`post_id`,`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blog_category` (`category_id`),
  ADD KEY `FK_blog_author` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_blog_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;