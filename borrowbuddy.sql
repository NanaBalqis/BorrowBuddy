-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2025 at 10:52 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borrowbuddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminactivitylog`
--

CREATE TABLE `adminactivitylog` (
  `logId` int NOT NULL,
  `adminId` int NOT NULL,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `actionDatetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookId` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publishedYear` year DEFAULT NULL,
  `shelfLocation` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalCopies` int DEFAULT '1',
  `availableCopies` int DEFAULT '1',
  `book_cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookId`, `title`, `author`, `isbn`, `genre`, `description`, `publishedYear`, `shelfLocation`, `totalCopies`, `availableCopies`, `book_cover`, `created_at`) VALUES
(1, 'The American Roommate Exp', 'Elena Armas', '9780306406157', 'Romance', 'Rosie Graham has a problem. A few, actually. She just quit her well paid job to focus on her secret career as a romance writer. She hasn’t told her family and now has terrible writer’s block. Then, the ceiling of her New York apartment literally crumbles on her. Luckily she has her best friend Lina’s spare key while she’s out of town. But Rosie doesn’t know that Lina has already lent her apartment to her cousin Lucas, who Rosie has been stalking—for lack of a better word—on Instagram for the last few months. Lucas seems intent on coming to her rescue like a Spanish knight in shining armor. Only this one strolls around the place in a towel, has a distracting grin, and an irresistible accent. Oh, and he cooks.\r\n\r\nLucas offers to let Rosie stay with him, at least until she can find some affordable temporary housing. And then he proposes an outrageous experiment to bring back her literary muse and meet her deadline: He’ll take her on a series of experimental dates meant to jump-start her romantic inspiration. Rosie has nothing to lose. Her silly, online crush is totally under control—but Lucas’s time in New York has an expiration date, and six weeks may not be enough, for either her or her deadline.', '2022', 'R7', 10, 7, '/uploads/60114057.jpg', '2025-06-25 09:17:44'),
(2, 'LegendBorn', 'Tracy Deon', '2123456489', 'Fantasy', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2020', 'R15', 100, 100, '/uploads/1752355784_8c8961bd43d2cc28fcfc.jpeg', '2025-07-12 13:29:44'),
(3, 'The 101 ', 'Damien Broderick', '0451526538 ', 'Sci-Fi', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2021', 'R6', 150, 150, '/uploads/1752356737_08e696ab6d03bc2b5daf.jpg', '2025-07-12 13:45:37'),
(5, 'The Art Of Teaching Children', 'Phillip Done', '0140449132 ', 'Education', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2012', 'R10', 200, 200, '/uploads/1752356905_381c94aef26f27b9d597.jpg', '2025-07-12 13:48:25'),
(6, 'The Lost Rainforest', 'Eliot Schrefer', '0061120081  ', 'Adventure', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2023', 'R20', 250, 248, '/uploads/1752356990_45721b9d969db727e95c.jpg', '2025-07-12 13:49:50'),
(7, 'A Biography', 'Alert Einstein', '0307277674', 'Biography', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2015', 'R1', 170, 170, '/uploads/1752357094_4ed1ddaeaf76138bbb72.jpg', '2025-07-12 13:51:34'),
(8, 'Alexander and the Terrible', 'Alexander', '067978327X', 'Children', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2016', 'R3', 299, 299, '/uploads/1752357195_7fec5b2ab5457212eb07.jpeg', '2025-07-12 13:53:15'),
(9, 'A New History Of Documentary Film', 'Bioomsbury', '0385472579', 'Documentary', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2018', 'R8', 200, 200, '/uploads/1752357314_56a0152b4ee8815e806b.jpg', '2025-07-12 13:55:14'),
(10, 'Playground', 'Aron Beauregard', '0486280616', 'Horror', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2011', 'R19', 100, 100, '/uploads/1752357396_59e9a3c50401e3d45241.jpg', '2025-07-12 13:56:36'),
(11, 'Books to Die For', 'John Connolly', '0743273567', 'Mystery', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2022', 'R12', 200, 200, '/uploads/1752357502_aba1583851cca453968b.jpg', '2025-07-12 13:58:22'),
(12, 'the thoughts are clouds', 'Georgia', '0553212419', 'Poetary', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2013', 'R8', 170, 170, '/uploads/1752357666_fccc330aad7484823487.jpeg', '2025-07-12 14:01:06'),
(13, 'The Silent Patient', 'Alex Michaelides', '0316066524', 'Thriller', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2011', 'R16', 200, 200, '/uploads/1752357792_023ef3e599a0980caac2.png', '2025-07-12 14:03:12'),
(15, 'Fat chancee, Charlie Vega', 'Crystal', '0451526536', 'Young Adult', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2024', 'R7', 210, 210, '/uploads/1752357900_3c9e0845acee8ebf56d7.jpg', '2025-07-12 14:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `favId` int NOT NULL,
  `userId` int NOT NULL,
  `bookId` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`favId`, `userId`, `bookId`, `title`, `created_at`) VALUES
(20, 7, 1, 'The American Roommate Experiment', '2025-07-13 07:21:24'),
(21, 7, 6, 'The Lost Rainforest', '2025-07-13 10:50:43'),
(22, 7, 7, 'A Biography', '2025-07-13 10:50:44'),
(23, 7, 5, 'The Art Of Teaching Children', '2025-07-13 10:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminderId` int NOT NULL,
  `rentalId` int NOT NULL,
  `userId` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('reminder','overdue') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reminderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminderId`, `rentalId`, `userId`, `message`, `type`, `reminderDate`) VALUES
(1, 2, 7, 'You have an overdue rental: The American Roommate Experiment', 'overdue', '2025-07-12 23:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `rentalId` int NOT NULL,
  `userId` int NOT NULL,
  `bookId` int NOT NULL,
  `rentalDate` date NOT NULL,
  `dueDate` date NOT NULL,
  `returnDate` date DEFAULT NULL,
  `lateFee` decimal(6,2) DEFAULT '0.00',
  `status` enum('rented','returned','late') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'rented'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`rentalId`, `userId`, `bookId`, `rentalDate`, `dueDate`, `returnDate`, `lateFee`, `status`) VALUES
(1, 8, 1, '2025-06-27', '2025-07-02', '2025-07-12', 50.00, 'returned'),
(2, 7, 1, '2025-06-27', '2025-07-10', NULL, 15.00, 'rented'),
(3, 7, 15, '2025-07-13', '2025-07-18', '2025-07-13', 0.00, 'returned'),
(4, 7, 1, '2025-07-13', '2025-07-18', NULL, 0.00, 'rented'),
(5, 7, 6, '2025-07-13', '2025-07-18', NULL, 0.00, 'rented'),
(6, 7, 6, '2025-07-13', '2025-07-18', NULL, 0.00, 'rented');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int NOT NULL,
  `fullName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phoneNum` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userType` enum('admin','member') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'member',
  `membershipDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `staffSince` date DEFAULT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '/assets/images/single-author.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fullName`, `email`, `password`, `phoneNum`, `userType`, `membershipDate`, `position`, `staffSince`, `profile_picture`, `created_at`, `remember_token`, `reset_token`, `reset_expires_at`) VALUES
(1, 'nurainaa balqis', 'nurainaabalqis83@gmail.com', '$2y$10$7afY9B1h0DOkOQ37RPt4weUbbI0DiU53BZODmhdknlrmERb2Z1ahS', '01111417452', 'admin', NULL, NULL, NULL, '/assets/images/single-author.jpg	', '2025-06-22 16:24:27', NULL, NULL, NULL),
(4, 'Nur Adlina Balqis Bt Jaafar', 'adaqis@gmail.com', '$2y$10$8YQWpveAh/vMcF8/mMG3duRvBeyyDb7gJsbyUT1bIQak3QJS3.Ku.', '0179794635', 'admin', NULL, 'Staff', '2025-06-01', '/assets/images/single-author.jpg', '2025-06-24 00:52:37', NULL, '29231a7a29241bc7a7d40954f7c13f4568b6ca61022187ff0965a268658af3db6b0028b2301ef972c395ac38fa1849b58aa7', '2025-07-13 03:55:00'),
(6, 'Siti nurainaa binti mahadi', 'sitinuraina@gmail.com', '$2y$10$RV8iv/1VdSaiCSNGAN3rU.wgPX7tuzZqldnP.V.8OVnzn2pcDo5/q', '01118810602', 'admin', NULL, 'Manager', '2025-06-01', '/uploads/profile_pictures/1752328320_69fd6794153423462c69.jpg', '2025-06-24 01:03:57', NULL, NULL, NULL),
(7, 'siti nurain ', 'nurainaabalqis03@gmail.com', '$2y$10$5p9axVf56JrS8dEXUouqfOizEoJ.Bkdob.0N7DmPotAEA6dCp9PDq', '01118810601', 'member', '2025-06-24 01:05:16', NULL, NULL, '/assets/images/single-author.jpg', '2025-06-24 01:05:16', NULL, NULL, NULL),
(8, 'muhammad izmal haiqal bin abdullah', 'zemeyy08@gmail.com', '$2y$10$gsIuQ0hiXRliKLKfSA0rYOkQvnvvrNiHGeSoBJX3XCb29z1cP0qFC', '01124025190', 'member', '2025-06-26 16:00:00', NULL, NULL, '/assets/images/single-author.jpg', '2025-06-27 03:40:42', NULL, NULL, NULL),
(9, 'CHE NURSYAMIMI', 'chenursyamimilukeman@gmail.com', '$2y$10$QCNHK.Ho9C7CgVonjlI2Vex7mBSPdHDexrPsiNC.3rS6d6QSYtODS', '01162006348', 'admin', '2025-07-10 15:33:35', 'Supervisor', '2024-01-29', '/assets/images/single-author.jpg', '2025-07-10 07:33:35', NULL, NULL, NULL),
(10, 'nana shomel dooh', 'nana@gmail.com', '$2y$10$sQkGlaxL7e8LJBwK0GWoMulWo0ujNYbc1ZKHyN2z2gR5EJi4XwC4G', '0199019800', 'member', '2025-07-12 12:06:20', NULL, NULL, '/assets/images/single-author.jpg', '2025-07-12 12:06:20', NULL, NULL, NULL),
(12, 'Gloria Tan', 'gloria@gmail.com', '$2y$10$pN.kpYjJeW3N9Bv0NgPC1.BpZyJeNz/EbEeTKKW7yVgAaXancr1XK', '0129212248', 'member', '2025-07-13 02:28:52', NULL, NULL, '/assets/images/single-author.jpg', '2025-07-13 02:28:52', NULL, NULL, NULL),
(13, 'Adlina Balqis', 'adlina@gmail.com', '$2y$10$ipeVUcYxo7jOzBkLDffYc.uck3b7ac7yN3d/InUdVMWW/xEVPCbPu', '0192700080', 'member', '2025-07-12 16:00:00', NULL, NULL, '/assets/images/single-author.jpg', '2025-07-12 23:19:44', NULL, NULL, NULL),
(15, 'mohd test', 'test@gmail.com', '$2y$10$YwGq8X9i/Aerb8WcQ4XdbeZUpsg8CR/eCN3Ly7APQp9G4AqbL8lcy', '0111111111', 'admin', '2025-07-12 16:00:00', NULL, NULL, '/assets/images/single-author.jpg', '2025-07-13 02:14:57', NULL, NULL, NULL),
(16, 'joyah', 'joyah@gmail.com', '$2y$10$c8V2zAPof9f9ucpqEQ.qN.jBpxTh.xRzpzFg60tMmKNJAftY6UbRm', '0129087890', 'admin', '2025-07-13 10:33:45', 'Librarians', '2025-07-11', '/assets/images/single-author.jpg', '2025-07-13 10:33:45', NULL, NULL, NULL),
(17, 'peah ', 'peah@gmail.com', '$2y$10$cCth9bCfAtqOOwxu6XMryubDEpFw9/gxkY4GJWqQyvFyAUmUt7hwu', '0135424562', 'admin', '2025-07-12 16:00:00', 'Manager', '2024-06-20', '/assets/images/single-author.jpg', '2025-07-13 02:37:28', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminactivitylog`
--
ALTER TABLE `adminactivitylog`
  ADD PRIMARY KEY (`logId`),
  ADD KEY `fk_adminactivitylog_adminId` (`adminId`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookId`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`favId`),
  ADD KEY `fk_fav_user` (`userId`),
  ADD KEY `fk_fav_book` (`bookId`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`reminderId`),
  ADD KEY `fk_reminder_userId` (`userId`),
  ADD KEY `fk_reminder_rentalId` (`rentalId`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rentalId`),
  ADD KEY `fk_rental_bookId` (`bookId`),
  ADD KEY `fk_rental_userId` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNum` (`phoneNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminactivitylog`
--
ALTER TABLE `adminactivitylog`
  MODIFY `logId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `favId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminderId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `rentalId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminactivitylog`
--
ALTER TABLE `adminactivitylog`
  ADD CONSTRAINT `fk_adminactivitylog_adminId` FOREIGN KEY (`adminId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `fk_fav_book` FOREIGN KEY (`bookId`) REFERENCES `book` (`bookId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_fav_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `fk_reminder_rentalId` FOREIGN KEY (`rentalId`) REFERENCES `rental` (`rentalId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reminder_userId` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `fk_rental_bookId` FOREIGN KEY (`bookId`) REFERENCES `book` (`bookId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rental_userId` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
