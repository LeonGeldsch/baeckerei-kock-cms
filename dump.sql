-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2021 at 09:39 PM
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
-- Database: `baeckerei-kock-cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `fileId` int(11) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `fileType` varchar(255) NOT NULL,
  `fileUri` varchar(255) NOT NULL,
  `fileThumbnails` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`fileId`, `fileName`, `filePath`, `fileType`, `fileUri`, `fileThumbnails`) VALUES
(2, 'schrippe-1630265983-4514.png', '/var/www/html/Baeckerei-kock-cms/public/uploads/2021/08/29/schrippe-1630265983-4514.png', 'image/png', '/uploads/2021/08/29/schrippe-1630265983-4514.png', 's:501:\"{\"thumbnail\":{\"filename\":\"schrippe-1630265983-4514-key\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/29\\/schrippe-1630265983-4514-thumbnail.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/29\\/schrippe-1630265983-4514-thumbnail.png\"},\"full-hd\":{\"filename\":\"schrippe-1630265983-4514-key\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/29\\/schrippe-1630265983-4514-full-hd.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/29\\/schrippe-1630265983-4514-full-hd.png\"}}\";'),
(3, 'schrippe-1630266159-7701.png', '/var/www/html/Baeckerei-kock-cms/public/uploads/2021/08/29/schrippe-1630266159-7701.png', 'image/png', '/uploads/2021/08/29/schrippe-1630266159-7701.png', 's:501:\"{\"thumbnail\":{\"filename\":\"schrippe-1630266159-7701-key\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266159-7701-thumbnail.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266159-7701-thumbnail.png\"},\"full-hd\":{\"filename\":\"schrippe-1630266159-7701-key\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266159-7701-full-hd.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266159-7701-full-hd.png\"}}\";'),
(4, 'schrippe-1630266252-7678.png', '/var/www/html/Baeckerei-kock-cms/public/uploads/2021/08/29/schrippe-1630266252-7678.png', 'image/png', '/uploads/2021/08/29/schrippe-1630266252-7678.png', 's:501:\"{\"thumbnail\":{\"filename\":\"schrippe-1630266252-7678-key\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266252-7678-thumbnail.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266252-7678-thumbnail.png\"},\"full-hd\":{\"filename\":\"schrippe-1630266252-7678-key\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266252-7678-full-hd.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/29\\/schrippe-1630266252-7678-full-hd.png\"}}\";'),
(5, 'schrippe-1630330268-1653.png', '/var/www/html/Baeckerei-kock-cms/public/uploads/2021/08/30/schrippe-1630330268-1653.png', 'image/png', '/uploads/2021/08/30/schrippe-1630330268-1653.png', 's:511:\"{\"thumbnail\":{\"filename\":\"schrippe-1630330268-1653-thumbnail\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330268-1653-thumbnail.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330268-1653-thumbnail.png\"},\"full-hd\":{\"filename\":\"schrippe-1630330268-1653-full-hd\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330268-1653-full-hd.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330268-1653-full-hd.png\"}}\";'),
(6, 'schrippe-1630330285-5554.png', '/var/www/html/Baeckerei-kock-cms/public/uploads/2021/08/30/schrippe-1630330285-5554.png', 'image/png', '/uploads/2021/08/30/schrippe-1630330285-5554.png', 's:511:\"{\"thumbnail\":{\"filename\":\"schrippe-1630330285-5554-thumbnail\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330285-5554-thumbnail.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330285-5554-thumbnail.png\"},\"full-hd\":{\"filename\":\"schrippe-1630330285-5554-full-hd\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330285-5554-full-hd.png\",\"fileuri\":\"\\/uploads\\/2021\\/08\\/30\\/schrippe-1630330285-5554-full-hd.png\"}}\";'),
(7, 'schrippe-1630697863-4840.png', '/var/www/html/Baeckerei-kock-cms/public/uploads/2021/09/03/schrippe-1630697863-4840.png', 'image/png', '/uploads/2021/09/03/schrippe-1630697863-4840.png', 's:511:\"{\"thumbnail\":{\"filename\":\"schrippe-1630697863-4840-thumbnail\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/09\\/03\\/schrippe-1630697863-4840-thumbnail.png\",\"fileuri\":\"\\/uploads\\/2021\\/09\\/03\\/schrippe-1630697863-4840-thumbnail.png\"},\"full-hd\":{\"filename\":\"schrippe-1630697863-4840-full-hd\",\"filepath\":\"\\/var\\/www\\/html\\/Baeckerei-kock-cms\\/public\\/uploads\\/2021\\/09\\/03\\/schrippe-1630697863-4840-full-hd.png\",\"fileuri\":\"\\/uploads\\/2021\\/09\\/03\\/schrippe-1630697863-4840-full-hd.png\"}}\";');

-- --------------------------------------------------------

--
-- Table structure for table `orderItems`
--

CREATE TABLE `orderItems` (
  `orderItemId` int(11) NOT NULL,
  `orderItemProductId` int(11) NOT NULL,
  `orderItemOrderId` int(11) NOT NULL,
  `orderItemAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderItems`
--

INSERT INTO `orderItems` (`orderItemId`, `orderItemProductId`, `orderItemOrderId`, `orderItemAmount`) VALUES
(113, 3, 170, 3),
(114, 12, 170, 3),
(115, 11, 170, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `orderUserId` int(11) NOT NULL,
  `orderStatus` varchar(255) NOT NULL,
  `orderTimestamp` int(11) NOT NULL,
  `orderPickupTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `orderUserId`, `orderStatus`, `orderTimestamp`, `orderPickupTime`) VALUES
(170, 4, 'in progress', 1630695124, 1630749600);

-- --------------------------------------------------------

--
-- Table structure for table `productCategories`
--

CREATE TABLE `productCategories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productCategories`
--

INSERT INTO `productCategories` (`categoryId`, `categoryName`) VALUES
(1, 'Bread'),
(2, 'Buns'),
(3, 'Cake'),
(4, 'Snacks'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` float NOT NULL,
  `productDescription` text NOT NULL,
  `productActive` tinyint(1) NOT NULL,
  `productImageId` int(11) NOT NULL,
  `productCategory` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `productPrice`, `productDescription`, `productActive`, `productImageId`, `productCategory`) VALUES
(3, 'WM-Brot', 3.6, 'WM-Brot', 1, 3, 'Bread'),
(11, 'Cake', 2.5, 'cake', 1, 5, 'Cake'),
(12, 'Bread', 3.2, 'bread', 1, 6, 'Bread'),
(13, 'Buns', 0.44, 'just buns', 1, 7, 'Buns');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userFirstname` varchar(255) NOT NULL,
  `userLastname` varchar(255) NOT NULL,
  `userUsername` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userPhoneNumber` varchar(255) DEFAULT NULL,
  `userMobileNumber` varchar(255) DEFAULT NULL,
  `userLevel` varchar(255) NOT NULL,
  `userSalt` char(128) NOT NULL,
  `userRegisterTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userFirstname`, `userLastname`, `userUsername`, `userEmail`, `userPassword`, `userPhoneNumber`, `userMobileNumber`, `userLevel`, `userSalt`, `userRegisterTime`) VALUES
(4, 'Leon', 'Geldschlaeger', 'LeonGeldsch', 'leon.geldschlaeger@gmail.com', 'd5b7cf0fb306efb9a429ce1848dced6e4b597a0253896ab451cf2db0c45863bf4f115e103330d2494d195fb1b0f6e30f39fec15197e13a06047b0c00b5fca176', '', '', 'admin', '4d77d1333d70c509b83818372faef6d5f04e64e0ffb2f0b6275dc02ae2e0bc090020e4aeeee185d4c21058911e596b8738fb54163f61b8ca5062198b6313c9ca', 1628792615),
(5, 'wadadawd', 'dwadwadawd', 'awdwadawwa', 'tuffilro@gml.com', '8da236f4b347aceaf1e3d111eb96ddb67c45e8898023967409f6ba5c7700427d57a22e4e54a9f6fbc11f337c666abcb2f9fa1f9866d823c0edca8f975eccb52f', '', '', 'regular', '8a0cfcd44490b41d2a015d5466074d50ec2887cf853252b9ef6133b8c436906555dc68d905147321b3cd6eed356e442e6ba85ae39a1d8742d1e08f1f7a1cf4be', 1629649516),
(6, 'Leon', 'Geldschläger', 'wdawdwa', 'wadwadwad@wda.d', 'cbf1bbeead2112dbdb5929524e6752c920d8373c570f299ab032c9951185c328ac2b530fbf0fd77c67b3209b8edaebd146fe65b1c56316658594d543ffe964b5', '213123', '213213', 'regular', 'ea73b9dd48ea368a3edea856a549ecd06d058ae1712ac02b6aa6334ebae900be4a9db7bb36b6bdf5abed74398d798ae0897d731c89f50af174cf79340f7af149', 1630693139);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileId`);

--
-- Indexes for table `orderItems`
--
ALTER TABLE `orderItems`
  ADD PRIMARY KEY (`orderItemId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `productCategories`
--
ALTER TABLE `productCategories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userUsername` (`userUsername`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userUsername_4` (`userUsername`),
  ADD KEY `userUsername_2` (`userUsername`),
  ADD KEY `userUsername_3` (`userUsername`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderItems`
--
ALTER TABLE `orderItems`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `productCategories`
--
ALTER TABLE `productCategories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
