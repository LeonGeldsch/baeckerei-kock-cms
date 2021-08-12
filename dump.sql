-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2021 at 09:39 PM
-- Server version: 10.5.10-MariaDB-1:10.5.10+maria~focal
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbd0321_5100_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
                            `id` int(11) NOT NULL,
                            `post_id` int(11) NOT NULL,
                            `user_id` int(11) NOT NULL,
                            `comment` varchar(400) NOT NULL,
                            `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `timestamp`) VALUES
(7, 23, 7, 'Hallo zurück, ich bin der erste Kommentar', 1627405502),
(8, 23, 7, 'Hallo zurück, ich bin der erste Kommentar', 1627405506),
(9, 23, 7, 'Hallo zurück, ich bin der erste Kommentar', 1627405601),
(10, 24, 7, 'Hallo ich bin ein Super Kommentar!', 1627406847),
(11, 24, 7, 'Hallo ich bin ein Super Kommentar!', 1627406941),
(12, 23, 9, 'Hi ich bin der neue hier im Bunde!', 1627407417),
(13, 28, 9, 'asdasdkjhskj3jk2h34jk2h34kj2h34kjh23kj4h234', 1627409987),
(14, 28, 9, 'asdasdkjhskj3jk2h34jk2h34kj2h34kjh23kj4h234', 1627410012);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
                         `id` int(11) NOT NULL,
                         `type` char(128) NOT NULL,
                         `filename` char(128) NOT NULL,
                         `filepath` varchar(1024) NOT NULL,
                         `fileuri` varchar(1024) NOT NULL,
                         `thumbnails` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `type`, `filename`, `filepath`, `fileuri`, `thumbnails`) VALUES
(5, 'image/jpeg', 'avatar-1627397908-8686.jpeg', '/var/www/html/wbd0321-5100/wbd5100_cms/public/uploads/2021/07/27/avatar-1627397908-8686.jpeg', '/uploads/2021/07/27/avatar-1627397908-8686.jpeg', 's:507:\"{\"thumbnail\":{\"filename\":\"avatar-1627397987-6457-key\",\"filepath\":\"\\/var\\/www\\/html\\/wbd0321-5100\\/wbd5100_cms\\/public\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-thumbnail.jpeg\",\"fileuri\":\"\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-thumbnail.jpeg\"},\"full-hd\":{\"filename\":\"avatar-1627397987-6457-key\",\"filepath\":\"\\/var\\/www\\/html\\/wbd0321-5100\\/wbd5100_cms\\/public\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-full-hd.jpeg\",\"fileuri\":\"\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-full-hd.jpeg\"}}\";'),
(6, 'image/jpeg', 'avatar-1627397987-6457.jpeg', '/var/www/html/wbd0321-5100/wbd5100_cms/public/uploads/2021/07/27/avatar-1627397987-6457.jpeg', '/uploads/2021/07/27/avatar-1627397987-6457.jpeg', 's:507:\"{\"thumbnail\":{\"filename\":\"avatar-1627397987-6457-key\",\"filepath\":\"\\/var\\/www\\/html\\/wbd0321-5100\\/wbd5100_cms\\/public\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-thumbnail.jpeg\",\"fileuri\":\"\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-thumbnail.jpeg\"},\"full-hd\":{\"filename\":\"avatar-1627397987-6457-key\",\"filepath\":\"\\/var\\/www\\/html\\/wbd0321-5100\\/wbd5100_cms\\/public\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-full-hd.jpeg\",\"fileuri\":\"\\/uploads\\/2021\\/07\\/27\\/avatar-1627397987-6457-full-hd.jpeg\"}}\";'),
(7, 'image/jpeg', 'avatar_-1627407402-1457.jpeg', '/var/www/html/wbd0321-5100/wbd5100_cms/public/uploads/2021/07/27/avatar_-1627407402-1457.jpeg', '/uploads/2021/07/27/avatar_-1627407402-1457.jpeg', 's:513:\"{\"thumbnail\":{\"filename\":\"avatar_-1627407402-1457-key\",\"filepath\":\"\\/var\\/www\\/html\\/wbd0321-5100\\/wbd5100_cms\\/public\\/uploads\\/2021\\/07\\/27\\/avatar_-1627407402-1457-thumbnail.jpeg\",\"fileuri\":\"\\/uploads\\/2021\\/07\\/27\\/avatar_-1627407402-1457-thumbnail.jpeg\"},\"full-hd\":{\"filename\":\"avatar_-1627407402-1457-key\",\"filepath\":\"\\/var\\/www\\/html\\/wbd0321-5100\\/wbd5100_cms\\/public\\/uploads\\/2021\\/07\\/27\\/avatar_-1627407402-1457-full-hd.jpeg\",\"fileuri\":\"\\/uploads\\/2021\\/07\\/27\\/avatar_-1627407402-1457-full-hd.jpeg\"}}\";');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
                         `id` int(11) NOT NULL,
                         `post_id` int(11) NOT NULL,
                         `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(20, 28, 9),
(30, 26, 7),
(31, 24, 7),
(32, 23, 7),
(33, 28, 7),
(35, 29, 7);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
                         `id` int(11) NOT NULL,
                         `user_id` int(11) NOT NULL,
                         `message` varchar(400) NOT NULL,
                         `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `message`, `timestamp`) VALUES
(23, 7, 'Hallo Welt, ich bin der erste Beitrag!', 1627405492),
(24, 7, 'Hallo Welt, ich bin der zweite Beitrag!', 1627406108),
(25, 9, 'Ein neuer Testbeitrag, um zu überprüfen das alles läuft!', 1627409044),
(26, 9, 'Ein neuer Testbeitrag, um zu überprüfen das alles läuft!', 1627409048),
(27, 9, 'Ein neuer Testbeitrag, um zu überprüfen das alles läuft!', 1627409056),
(28, 9, 'Ein weiterer Testbeitrag', 1627409293),
(29, 7, 'Ich bin ein aktueller Beitrag, für den Feed', 1627929826);

-- --------------------------------------------------------

--
-- Table structure for table `reposts`
--

CREATE TABLE `reposts` (
                           `id` int(11) NOT NULL,
                           `post_id` int(11) NOT NULL,
                           `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reposts`
--

INSERT INTO `reposts` (`id`, `post_id`, `user_id`) VALUES
(1, 28, 7),
(2, 27, 7),
(3, 26, 7),
(4, 25, 7),
(5, 29, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `username` char(16) NOT NULL,
                         `email` char(255) NOT NULL,
                         `password` char(128) NOT NULL,
                         `salt` char(128) NOT NULL,
                         `registered` int(11) NOT NULL,
                         `avatar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `registered`, `avatar`) VALUES
(7, 'admin', 'admin@sae.edu', '841ec49f077917ca7bbe27655c290b1dd33e6b5a72077eeaf9cec6f5cfa5104ed8b5a289549f494c6607cfbf5d4b62c3fdee6e840902b72b9d40b6866eb6c4f6', 'afb5d21230ab220944142d56031558c9d2e07cc2c19121e4c750180f575b77bc89502424f3e1b039fe932dca9674ec669892a5b13201de24927bf58d02d1c2e3', 1627397908, 5),
(8, 'test', 'test@sae.edu', '8be6411043c07828c8e30ad3083327fad4e2be0cad979fd50848cb319a6c07a9cfd42e00cdb10ae7edbfc7a042a4d34fff6cbb9952b755acf2b6553c72206b8a', 'df7aec6fbc72c67dc1066a5aab653c02640fe82ac6d17433236f3a33019d5f38230c5639966bc2f9920d34cee42e885fbc2e9188737f0393b3c87be8529b4795', 1627397987, 6),
(9, 'avatar', 'avatar@sae.edu', '6e0b03c1bef05a88d0a79b768b785047a469b4cd0d60ee5773f21fa3ab954cd6142524a55b58abfafbdd52c25a1477dbe700fe5ce4143cc789f798fd0a1a4364', '613851204fdf4cef1d9324c1de0a10bdd1add2d588ef3d72dce3fad195773038fb4cb84593a8489f0d7f948724283e47f460b92dd8a56267eb337be660bfcbe6', 1627407402, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reposts`
--
ALTER TABLE `reposts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `USERNAME` (`username`),
  ADD UNIQUE KEY `EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reposts`
--
ALTER TABLE `reposts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;