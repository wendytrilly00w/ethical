-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 16, 2024 alle 16:09
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `comments`) VALUES
(1, 1, 'popopo'),
(2, 1, 'popopopopopopo'),
(3, 1, 'pupupu'),
(4, 1, 'pupupu'),
(5, 1, 'pupupu'),
(6, 1, 'pupupu'),
(7, 1, 'pupupu'),
(8, 1, 'pupupu'),
(9, 1, 'pupupu'),
(10, 1, 'pupupu'),
(11, 1, 'pupupu'),
(12, 1, 'pupupu'),
(13, 1, 'pupupu'),
(14, 1, 'pupupu'),
(15, 1, 'pupupu'),
(16, 1, 'pupupu'),
(17, 1, 'pupupu'),
(18, 1, 'fkdmkldmd'),
(19, 1, 'fkdmkldmd');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `name` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`name`, `password`, `id`, `email`, `photo`) VALUES
('aldo', 'password', 1, '', ''),
('wendy', 'a', 2, 'wendy.rosettini@gmail.com', ''),
('Antonio', '1234', 3, 'venditore2@gmail.com', ''),
('wendy', '1234', 8, 'cliente2@gmail.com', 0x76656e646572652d617a69656e64612d312e6a7067),
('pippo', 'pappo', 9, 'pippo@gmail.com', 0x76656e646572652d617a69656e64612d312e6a7067),
('wendy', 'password', 10, 'venditore@gmail.com', 0x76656e646572652d617a69656e64612d312e6a7067);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_comments` (`id_user`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_user_comments` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
