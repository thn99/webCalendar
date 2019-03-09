-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Mar-2019 às 00:07
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `initialday` datetime DEFAULT NULL,
  `endday` datetime DEFAULT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `color`, `initialday`, `endday`, `description`) VALUES
(1, 1, 'Meeting at the office', '#0000FF', '2019-02-10 08:00:00', '2019-02-11 10:00:00', 'Room 7'),
(3, 6, 'Meeting at the Café', '#00ff00', '2019-02-19 00:00:00', '2019-02-21 00:00:00', 'Happy hour'),
(33, 6, 'Family dinner', '#ff0000', '2019-02-08 00:00:00', '2019-02-09 00:00:00', 'Buy food'),
(42, 7, 'Reunion', '#FFD700', '2019-02-09 00:00:00', '2019-02-10 00:00:00', 'Office'),
(45, 1, '', '', '2019-02-08 00:00:00', '2019-02-09 00:00:00', ''),
(46, 1, 'Varios dados', '', '2019-02-15 00:00:00', '2019-02-19 00:00:00', ''),
(48, 1, '', '', '2019-02-24 06:00:00', '2019-02-25 09:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'John', 'john@mail.com', 'df780a97b7d6a8f779f14728bccd3c4c'),
(6, 'Mary', 'mary@mail.com', 'df780a97b7d6a8f779f14728bccd3c4c'),
(7, 'Tom', 'tom@mail.com', 'df780a97b7d6a8f779f14728bccd3c4c'),
(8, 'Frank', 'frank@mail.com', 'df780a97b7d6a8f779f14728bccd3c4c'),
(12, 'teste', 'teste@teste.com', 'df780a97b7d6a8f779f14728bccd3c4c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userEvent` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_userEvent` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
