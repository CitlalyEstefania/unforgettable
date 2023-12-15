-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 02:27 AM
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
(21, 'Los mejores looks street style para ir oficina en Oto&ntilde;o 2023', 'Viste con estilo (sin sacrificar la comodidad) para ir a la oficina siguiendo estas tendencias del street style Oto&ntilde;o.', '1679348585otoñoo.png', '2023-03-20 21:43:05', 2, 13, 1, 0);

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
(10, 'Estefania', 'Samano', 'Estefania L', 'citlaly_est@hotmail.com', '65910', '1656394210avatar11.jpg', 1, 1),
(13, 'Citlaly Estefan&iacute;a', 'Samano L&oacute;pez', 'Estftz', 'csamano@ucol.mx', '$2y$10$WpcRIII940z.lhxBu.1OPefb.UK94CrBLGQah8fSU1QsFvpGx83PG', '167910463221c49bac13a5e6c5def42862826ccf08.jpg', 1, 1),
(14, 'alejandro', 'alejandro', 'ale', 'ale@gmail.com', '$2y$10$IQ9YJU8.J9CjFSvtACFIXOo0IsFUFggquV29wuK0T3pE/BPOkIvTe', '1679440123R.jpg', 1, 1),
(15, 'Tona', 'Tona', 'Tona', 'Tona@gmail.com', '$2y$10$NAhN7xRJIGh6j/lMbHcGhe2kinE1sqGGGRQqCTIuWVnkBqGy5R2Se', '1679877412maxresdefault.jpg', 1, 0),
(16, 'kamila', 'kamila', 'kami', 'kamila@gmail.com', '$2y$10$jg4Jc34Ja31gxjczprDcIuyRFZokY/1a7kw/WKqOeXYnGFF0svtl.', '16804761169c04a045252f02f70add747d6d0f0b8e--funny-animals-wild-animals.jpg', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
