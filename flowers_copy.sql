-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 03:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowers_copy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Flow_Id` int(11) NOT NULL,
  `Cart_Quant` int(11) NOT NULL,
  `Added_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `Flow_ID` int(11) NOT NULL,
  `Flow_Name` varchar(255) NOT NULL,
  `Flow_Description` text NOT NULL,
  `Flow_Price` decimal(10,2) NOT NULL,
  `Flow_Stock` int(11) NOT NULL,
  `Flow_Pic` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Orders_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Total_Price` int(11) NOT NULL,
  `Order_Status` enum('pending','processing','shipped','delivered','canceled') NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Order_Items_Id` int(11) NOT NULL,
  `Order_Id` int(11) NOT NULL,
  `Flow_Id` int(11) NOT NULL,
  `Order_Items_Quanity` int(11) NOT NULL,
  `Order_Items_Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Address` text NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_Name`, `User_Email`, `User_Password`, `User_Address`, `Created_At`) VALUES
(1, 'Leremy Mahones', 'LerMah88@pmail.com', 'LeremmJones44#$', '212 Market Lane, Ashville, LA, 99658', '2025-03-20 06:00:45'),
(3, 'Mark Allen', 'fred@smith.com', 'Mark44!', '652 Jenkins Street, Inglewood, CA, 14452', '2025-03-20 06:07:49'),
(4, 'Marie Jones', 'MarJon47@pmail.com', 'QueenMar23@', '8892 Cougar way, Hamptons,  MA, 46621', '2025-03-20 06:07:49'),
(6, 'Mark Jacobs', 'MarJac74@pmail.com', 'MarkIsAwesome!', '8855 Junkers Street, Lynewood VA, 45266', '2025-03-20 06:27:23'),
(7, 'Monica Jeremy', 'MoneeJerm45@ymail.com', 'MoneeHunny55$', '777 Bunny Drive, Brentwood, NY, 11717', '2025-03-20 06:27:23'),
(8, 'Aaron Drake', 'AarnDrk7@pmail.com', 'CrakeLove44*', '555 Appleton Way, Portland, WA, 25663', '2025-03-20 06:32:43'),
(9, 'August Marin', 'Auggie33@pmail.com', 'aUGGIEisKkk^&', '998 French Street, Willington, DE, 26674', '2025-03-20 06:32:43'),
(10, 'Adam Rico', 'Ricomorty66@ymail.com', 'RickJames00!@', '1415 MonkeyLane, Heller, MC, 55412', '2025-03-20 06:35:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_Id`);

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`Flow_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Orders_Id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`Order_Items_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_Email` (`User_Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
