-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 Aug 2018 la 23:41
-- Versiune server: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vmvc`
--
CREATE DATABASE IF NOT EXISTS `vmvc` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `vmvc`;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `create_at`) VALUES
(3, 17, 'Postul unu', 'Este primul meu post', '2018-06-21 22:16:21'),
(4, 17, 'Test 2', 'fvdsfsdfsdfsdfsd', '2018-06-21 22:20:13'),
(5, 17, 'cxzcxzczx', 'vxzvcxvxcv', '2018-06-22 17:55:25');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(17, 'Dan Piciorea', 'gpicioread@gmail.com', '$2y$10$TcuR4o8e1FD.24TqVwgH7ekvbY6StespXMbWARplW7rzWjhPl.Auq', '2018-06-19 23:31:35'),
(18, 'Piciorea Andrei Vladut', 'gvlad.piciorea@gmail.com', '$2y$10$EvZhc55d7WU1hza.eHHZsO.SJfeH9s4QyWDnt.iXpBWIl8ymfgIOO', '2018-06-19 23:32:28'),
(19, 'Dan Piciorea', 'gpsdsdsicioread@gmail.com', '$2y$10$GbCBvHM8Yn1i57VN5ZKZCufpqWmCGvKhYsKlsUBcDA2PutgVriDL2', '2018-06-19 23:33:48'),
(20, 'Piciorea Andrei Vladut', 's.padasdaiciorea@gmail.com', '$2y$10$qmWwcy0wTOFe6ntqRvGiyuDj8o5iVIbmavTf2lbu5yTslabJ8GlIi', '2018-06-19 23:34:39'),
(21, 'Dan Piciorea', 'gpiciossddsread@gmail.com', '$2y$10$vzDiZZADWoeaZwoGm1E93OLBt.3hgeMDLzr0tVqzrafW5Y6AHnHyG', '2018-06-19 23:36:17'),
(22, 'Dracula Sange', 'vanadfsadastorul33@yahoo.com', '$2y$10$iHqupu/zlhzPYx1/3nNLnObq.IJMp52sBCfacCqMgsqXo/2IQJH6C', '2018-06-19 23:38:43'),
(23, 'Dracula Sanges', 'vanafdsfsdftorul33@yahoo.com', '$2y$10$6Qr6jvqkiMS2rvFrr3RBBuU0IoTgOo.CD754uIjEz9V3rNxJjGHxa', '2018-06-19 23:41:49'),
(24, 'Dracula Sange', 'vanatorul33@yahoo.com', '$2y$10$v/YQnnelVgbbsxgjmye1y.LXKX22szm.OnSlPHkAJdSS6moTh2ccy', '2018-06-21 22:21:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
