-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2017 at 10:35 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pubgdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `gun`
--

CREATE TABLE `gun` (
  `id` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `nombre` text NOT NULL,
  `calibre` text NOT NULL,
  `tipo` text NOT NULL,
  `balas` text NOT NULL,
  `retroceso` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gun`
--

INSERT INTO `gun` (`id`, `imagen`, `nombre`, `calibre`, `tipo`, `balas`, `retroceso`, `created_at`, `updated_at`) VALUES
(2, '', 'Killer', '72.12', 'melee', '20', 'leve', '2017-12-15 20:52:04', '2017-12-15 21:37:49'),
(3, 'http://media.vandal.net/m/5-2017/2017525133723_2.jpg', 'asasddsasaddsa', '7.32, 7.24', 'sadsadasd', 'asdasddsa', 'sadasdasdasdasd', '2017-12-15 21:38:01', '2017-12-15 22:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` text NOT NULL,
  `steamid` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `steamid`, `created_at`, `updated_at`) VALUES
(2, 'Adolfo', 'adolfo@adolfo.adolfo', '$2y$10$o.v1ulkKN5XqgPx4jM2eB.hSTMaVKuKh2di1pAztcLUtLi9mm2V8O', '', '2017-12-15 22:22:33', '2017-12-15 22:22:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gun`
--
ALTER TABLE `gun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gun`
--
ALTER TABLE `gun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
