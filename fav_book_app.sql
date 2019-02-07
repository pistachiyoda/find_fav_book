-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fav_book_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `fav_book`
--

CREATE TABLE `fav_book` (
  `user_id` int(12) NOT NULL,
  `book_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `fav_book`
--

INSERT INTO `fav_book` (`user_id`, `book_id`) VALUES
(2, 'OgtBw76OY5EC'),
(2, 'Mg9tDwAAQBAJ'),
(2, 'y35oDwAAQBAJ'),
(3, 'OgtBw76OY5EC');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_info`
--

CREATE TABLE `user_info` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `authority` varchar(64) NOT NULL,
  `password_digest` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `authority`, `password_digest`) VALUES
(1, 'test1', 'general', '$2y$10$./yV1WwdCaW1MHTSddd3gOFQQGTp6eaFjE6uuL/bWNQo/33Y.rvjm'),
(2, 'test2', 'general', '$2y$10$9RkgVh7MJIedQiwe9mI4LuegxeSiNXPPouOWuFJCR4pm7siGPUSHK'),
(3, 'test3', 'general', '$2y$10$0TE5KhNxyry0P3LMQDgh8eBIbtHTXLw.gu2EYJ7249xjNKrSm8Sdm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
