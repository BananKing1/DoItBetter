-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 23 maj 2025 kl 10:07
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `supportflowab`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `tblmatters`
--

CREATE TABLE `tblmatters` (
  `id` int(11) NOT NULL,
  `matters` text NOT NULL,
  `beskrivning` text NOT NULL,
  `status` enum('open','ongoing','pending','complete') NOT NULL,
  `priority` enum('low','medium','high','critical') NOT NULL,
  `rapport` int(11) NOT NULL,
  `shared` int(11) NOT NULL,
  `contact` text NOT NULL,
  `comment` text NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `update` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tblmatters`
--

INSERT INTO `tblmatters` (`id`, `matters`, `beskrivning`, `status`, `priority`, `rapport`, `shared`, `contact`, `comment`, `created`, `update`, `end`) VALUES
(1, 'ärenden1', 'beskrivning1', 'open', 'low', 1, 2, 'contact', 'no comment', '2025-03-28', '2025-03-28', '2025-03-31'),
(2, 'ärende 23', 'ärende', '', '', 0, 0, '', '', '2025-03-28', '0000-00-00', '0000-00-00'),
(3, 'Hjälp med laptop', 'Jag kan inte logga in på min laptop, den håller på att sprängas.', 'open', 'critical', 0, 0, '', '', '2025-03-28', '2025-03-31', '0000-00-00'),
(4, 'ärende 3', 'adsfgbn', 'complete', 'critical', 1, 2, 'sdxtfyguhj', 'szdfcvgbhjk', '2025-03-31', '2025-04-25', '0000-00-00'),
(5, 'ärende 4', 'c vbjnkml', 'open', 'critical', 1, 2, 'rftgyuhbjniomk,l', 'xfcfvgbhjnk', '2025-03-31', '2025-03-31', '0000-00-00'),
(6, 'ärenden 5', 'c vbnjmk,l', 'ongoing', 'low', 1, 1, ' bjmkl,ö', 'fcvghuijok', '2025-03-31', '2025-05-23', '0000-00-00'),
(7, 'ärende 7', 'cvbhjnmk', 'open', 'medium', 1, 0, 'cvbhjnkm', 'tfcvgbhj', '2025-03-31', '2025-03-31', '0000-00-00'),
(8, 'ärende 8', 'dsfghj', 'complete', 'high', 1, 1, 'dxrctfvygbhunjmk', 'cgvhbjn', '2025-03-31', '2025-05-23', '0000-00-00'),
(9, 'fjdsifsa', '', 'complete', 'critical', 1, 2, 'djksakpd@gmail.com', 'mlödsakd', '2025-04-28', '2025-04-28', '0000-00-00'),
(10, 'bhsajdhsa', 'dsanködjsaodas', 'complete', 'critical', 1, 2, 'djksakpd@gmail.com', 'mlödsakd', '2025-04-28', '2025-04-28', '0000-00-00');

-- --------------------------------------------------------

--
-- Tabellstruktur `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `role` int(11) NOT NULL DEFAULT 100,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `name`, `role`, `password`) VALUES
(1, 'username1', 'firstname lastname', 100, '7c6a180b36896a0a8c02787eeafb0e4c'),
(4, 'user2', 'name2', 10, 'c1572d05424d0ecb2a65ec6a82aeacbf'),
(5, 'user3', 'name3', 10, '3afc79b597f88a72528e864cf81856d2');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `tblmatters`
--
ALTER TABLE `tblmatters`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `tblmatters`
--
ALTER TABLE `tblmatters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
