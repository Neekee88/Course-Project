-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 08:44 PM
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
-- Database: `flowers`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--
-- Error reading structure for table flowers.customers: #1932 - Table &#039;flowers.customers&#039; doesn&#039;t exist in engine
-- Error reading data for table flowers.customers: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `flowers`.`customers`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `customers2`
--

CREATE TABLE `customers2` (
  `Cust_ID` int(11) NOT NULL,
  `Cust_FName` varchar(100) NOT NULL,
  `Cust_LName` varchar(100) NOT NULL,
  `Cust_Email` varchar(150) NOT NULL,
  `Cust_Phone` varchar(20) NOT NULL,
  `Cust_Address` text NOT NULL,
  `Cust_Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `Flow_Name` varchar(60) NOT NULL,
  `Flow_Id` int(11) NOT NULL,
  `Flow_Price` decimal(10,2) NOT NULL,
  `Stock_Quant` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `Flow_Info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `INV_ID` int(11) NOT NULL,
  `Flow_ID` int(11) NOT NULL,
  `SUPP_ID` int(11) NOT NULL,
  `Flow_Name` varchar(150) NOT NULL,
  `Flow_Price` decimal(10,0) NOT NULL,
  `INV_quantity` int(11) NOT NULL,
  `INV_Received_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order details`
--

CREATE TABLE `order details` (
  `OrderDetails_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Flow_ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Flow_Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(11) NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `Order_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Total_Amount` decimal(10,2) NOT NULL,
  `Order_Status` enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `SUPP_ID` int(11) NOT NULL,
  `SUPP_Name` varchar(100) NOT NULL,
  `SUPP_ContactPerson` varchar(100) NOT NULL,
  `SUPP_Email` varchar(100) NOT NULL,
  `SUPP_Phone` varchar(20) NOT NULL,
  `SUPP_Address` text NOT NULL,
  `SUPP_Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers2`
--
ALTER TABLE `customers2`
  ADD PRIMARY KEY (`Cust_ID`),
  ADD UNIQUE KEY `Cust_Email` (`Cust_Email`);

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`Flow_Name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`INV_ID`),
  ADD UNIQUE KEY `Inventory_ID` (`INV_ID`),
  ADD UNIQUE KEY `Flow_ID` (`Flow_ID`);

--
-- Indexes for table `order details`
--
ALTER TABLE `order details`
  ADD PRIMARY KEY (`OrderDetails_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SUPP_ID`),
  ADD UNIQUE KEY `SUPP_Email` (`SUPP_Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
