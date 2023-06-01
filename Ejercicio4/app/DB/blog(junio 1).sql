-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 04:38 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postId`, `name`, `email`, `comment`, `created_at`) VALUES
(1, 3, 'Comentario Hola', 'correo@gmail.com', 'Este es el texto de un comentario', '2023-05-04 18:38:55'),
(2, 3, 'Segundo Comment', 'correo@gmail.com', 'Este es un segundo comentario.', '2023-05-04 18:49:30'),
(6, 8, 'Comentario', 'a@a.a', 'Hola hola', '2023-05-11 18:37:19'),
(8, 6, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Chiiii', '2023-05-16 14:38:17'),
(9, 2, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Comentario', '2023-05-16 14:40:56'),
(11, 12, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Jeje hola', '2023-05-18 14:13:33'),
(14, 12, 'Ximena Manzo', 'xmanzo@ucol.mx', 'hOLA', '2023-05-18 15:13:36'),
(15, 12, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Hola que hola', '2023-05-18 15:22:23'),
(16, 12, 'Ximena Manzo', 'xmanzo@ucol.mx', '4?', '2023-05-18 15:22:31'),
(17, 11, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Comentario prueba', '2023-05-18 15:23:36'),
(18, 10, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Hola', '2023-05-23 14:03:07'),
(19, 11, 'Ximena Manzo', 'xmanzo@ucol.mx', 'aaaaaaaaa', '2023-05-23 14:14:57'),
(20, 11, 'Ximena Manzo', 'xmanzo@ucol.mx', 'tras', '2023-05-23 14:15:28'),
(21, 10, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Hola', '2023-05-30 14:10:06'),
(22, 10, 'Ximena Manzo', 'xmanzo@ucol.mx', 'Holis', '2023-05-30 14:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL COMMENT 'ID del usuario que interactúa',
  `postId` int(11) DEFAULT NULL,
  `tipo` enum('1','2','3') DEFAULT NULL COMMENT '1 - Like\n2 - Dislike\n3 - Fun',
  `create_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`id`, `userId`, `postId`, `tipo`, `create_at`) VALUES
(6, 1, 8, '3', '2023-05-30 14:25:50'),
(10, 1, 12, '1', '2023-06-01 00:48:59'),
(37, 1, 2, '2', '2023-06-01 03:08:23'),
(40, 1, 10, '2', '2023-06-01 03:21:49'),
(73, 1, 11, '1', '2023-06-01 05:43:52'),
(82, 1, 13, '1', '2023-06-01 14:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userId`, `title`, `body`, `active`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 1, 'Primera Publicación', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pharetra hendrerit accumsan. Curabitur accumsan massa vitae leo pellentesque, vitae aliquet sapien porta. In hac habitasse platea dictumst. ', 1, '2023-03-30 14:57:55', '2023-05-28 20:52:27', 0),
(2, 1, 'Segunda Publicación', 'Pellentesque auctor faucibus turpis vitae blandit. Praesent id eros at ante ultrices bibendum. Vestibulum quis ipsum nisl. Vestibulum in rhoncus sem, vel bibendum est. Nam eu mauris id leo iaculis pretium. Ut pulvinar dolor eget mattis venenatis. Fusce dignissim elit a sapien tempus rutrum. Ut laoreet non nisi eget egestas. In posuere eu justo et imperdiet. Pellentesque neque lorem, placerat quis dui at, hendrerit vulputate eros. Sed a turpis ultricies, feugiat metus sit amet, posuere libero. Morbi lacinia, diam at dapibus ullamcorper, dui risus eleifend lorem, eu consectetur justo lorem vel tellus. ', 1, '2023-04-18 14:03:07', NULL, 0),
(3, 1, 'aaaaaaaaaaa', 'assssssssssss', 1, '2023-04-27 15:15:53', '2023-05-30 13:23:26', 0),
(6, 1, 'Publicacion de Prueba', 'Holi holi holaaa Kimy', 1, '2023-05-04 23:38:14', NULL, 0),
(8, 1, 'Prueba visible', 'Editandoppp', 1, '2023-05-04 23:44:16', NULL, 0),
(10, 1, 'Nueva publi despues de editar', 'Estoyyyyy feliizzzz porqueeeee yaaaa seee pudoooooo', 1, '2023-05-17 03:04:19', '2023-05-17 03:22:33', 0),
(11, 1, 'Si funcionaaa', 'Si, me pone feliz programar y son las 9:22&#13;&#10;(editado) ahora son las 9:23', 1, '2023-05-17 03:22:57', '2023-05-17 04:41:51', 0),
(12, 1, 'titulo nuevo', 'A ver si funciona', 0, '2023-05-17 03:27:12', '2023-06-01 02:19:25', 0),
(13, 1, 'Prueba de Funcionamiento', 'Viva Lana del Rey', 1, '2023-06-01 02:19:57', NULL, 0);

--
-- Triggers `posts`
--
DELIMITER $$
CREATE TRIGGER `hora_post_actualizado` BEFORE UPDATE ON `posts` FOR EACH ROW BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(45) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 2,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `passwd`, `tipo`, `active`, `created_at`) VALUES
(1, 'Ximena Manzo', 'xmanzo@ucol.mx', 'xmanzo', '29bd54d8d1e9bec6aaaaf7f987478bf8ce693b2b', 1, 1, '2023-03-23 14:47:46'),
(3, 'miguel', 'm@m.m', 'miguel', '8cb2237d0679ca88db6464eac60da96345513964', 2, 1, '2023-05-09 14:48:21'),
(4, 'Kimmy Manzo', 'kmanzo@ucol.mx', 'kmanzo', '48d817e865325c50e26471d5e28b1c73a3ffd9d1', 2, 1, '2023-05-11 18:14:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_postid_idx` (`postId`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_interactions_user_idx` (`userId`),
  ADD KEY `fk_interactions_posts1_idx` (`postId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_userid_idx` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_postid` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `fk_interactions_posts1` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_interactions_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_userid` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
