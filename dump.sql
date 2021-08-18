-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 18. Aug 2021 um 12:00
-- Server-Version: 10.5.10-MariaDB-1:10.5.10+maria~focal
-- PHP-Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `baeckerei-kock-cms`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `files`
--

CREATE TABLE `files` (
  `fileId` int(11) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `fileType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orderItems`
--

CREATE TABLE `orderItems` (
  `orderItemId` int(11) NOT NULL,
  `orderItemProductId` int(11) NOT NULL,
  `orderItemOrderId` int(11) NOT NULL,
  `orderItemAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `orderItems`
--

INSERT INTO `orderItems` (`orderItemId`, `orderItemProductId`, `orderItemOrderId`, `orderItemAmount`) VALUES
(66, 1, 135, 5),
(67, 2, 135, 2),
(68, 1, 136, 5),
(69, 2, 136, 2),
(70, 1, 137, 5),
(71, 2, 137, 2),
(72, 3, 138, 3),
(73, 1, 138, 5),
(74, 2, 138, 54);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `orderUserId` int(11) NOT NULL,
  `orderStatus` varchar(255) NOT NULL,
  `orderTimestamp` int(11) NOT NULL,
  `orderPickupTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`orderId`, `orderUserId`, `orderStatus`, `orderTimestamp`, `orderPickupTime`) VALUES
(135, 4, 'in progress', 1629225863, 1629324000),
(136, 4, 'in progress', 1629225951, 1629324000),
(137, 4, 'in progress', 1629226086, 1629324000),
(138, 4, 'in progress', 1629226496, 1629496800);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `productCategories`
--

CREATE TABLE `productCategories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `productCategories`
--

INSERT INTO `productCategories` (`categoryId`, `categoryName`) VALUES
(1, 'bread'),
(2, 'buns'),
(3, 'cake');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
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
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`productId`, `productName`, `productPrice`, `productDescription`, `productActive`, `productImageId`, `productCategory`) VALUES
(1, 'Ofenfrische', 0.44, 'Ofenfrische', 1, 1, 'buns'),
(2, 'WM-Brötchen', 0.68, 'WM-Brötchen', 1, 2, 'buns'),
(3, 'WM-Brot', 3.6, 'WM-Brot', 1, 3, 'bread');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
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
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userId`, `userFirstname`, `userLastname`, `userUsername`, `userEmail`, `userPassword`, `userPhoneNumber`, `userMobileNumber`, `userLevel`, `userSalt`, `userRegisterTime`) VALUES
(4, 'Leon', 'Geldschlaeger', 'LeonGeldsch', 'leon.geldschlaeger@gmail.com', 'd5b7cf0fb306efb9a429ce1848dced6e4b597a0253896ab451cf2db0c45863bf4f115e103330d2494d195fb1b0f6e30f39fec15197e13a06047b0c00b5fca176', '', '', 'regular', '4d77d1333d70c509b83818372faef6d5f04e64e0ffb2f0b6275dc02ae2e0bc090020e4aeeee185d4c21058911e596b8738fb54163f61b8ca5062198b6313c9ca', 1628792615);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileId`);

--
-- Indizes für die Tabelle `orderItems`
--
ALTER TABLE `orderItems`
  ADD PRIMARY KEY (`orderItemId`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indizes für die Tabelle `productCategories`
--
ALTER TABLE `productCategories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userUsername` (`userUsername`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userUsername_4` (`userUsername`),
  ADD KEY `userUsername_2` (`userUsername`),
  ADD KEY `userUsername_3` (`userUsername`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `files`
--
ALTER TABLE `files`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `orderItems`
--
ALTER TABLE `orderItems`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT für Tabelle `productCategories`
--
ALTER TABLE `productCategories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
