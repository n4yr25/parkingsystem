-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 09:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle-parking-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `FullName` varchar(200) NOT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `UserName`, `FullName`, `MobileNumber`, `Email`, `Password`) VALUES
(1, 'Administrator', 'admin', 'Main Admin', 7854445410, 'admin@gmail.com', 'd00f5d5217896fb7fd601412cb890830'),
(2, 'Staff', 'staff1', 'Staff1', 9123789456, 'staff1@gmail.com', '4d7d719ac0cf3d78ea8a94701913fe47'),
(16, 'user', 'user1', 'User One', 9132456789, 'user1@gmail.com', '24c9e15e52afc47c225b757e7bee1f9d');

-- --------------------------------------------------------

--
-- Table structure for table `parkarea`
--

CREATE TABLE `parkarea` (
  `areaid` int(11) NOT NULL,
  `areaCode` varchar(50) NOT NULL,
  `areaDesc` varchar(255) NOT NULL,
  `areaSlots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parkarea`
--

INSERT INTO `parkarea` (`areaid`, `areaCode`, `areaDesc`, `areaSlots`) VALUES
(8, 'Park-A', 'All type of vehicle', 10);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(55) NOT NULL,
  `c_website` varchar(55) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `c_name`, `c_email`, `c_website`, `c_address`, `last_update`) VALUES
(1, 'Demo Company', 'vparksystem@company.com', 'codeastro.com', '8169 Geigeer St NW', '2021-06-08 20:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `slotinfo`
--

CREATE TABLE `slotinfo` (
  `slotid` varchar(50) NOT NULL,
  `areaName` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slotinfo`
--

INSERT INTO `slotinfo` (`slotid`, `areaName`, `status`) VALUES
('SLOT001', 'Park-A', 'reserved'),
('SLOT002', 'Park-A', 'reserved'),
('SLOT003', 'Park-A', 'reserved'),
('SLOT004', 'Park-A', 'reserved'),
('SLOT005', 'Park-A', 'available'),
('SLOT006', 'Park-A', 'reserved'),
('SLOT007', 'Park-A', 'available'),
('SLOT008', 'Park-A', 'available'),
('SLOT009', 'Park-A', 'available'),
('SLOT010', 'Park-A', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `item_number` varchar(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_price_currency` varchar(10) NOT NULL,
  `payer_id` varchar(50) NOT NULL,
  `payer_name` varchar(50) NOT NULL,
  `payer_email` varchar(50) NOT NULL,
  `merchant_id` varchar(20) NOT NULL,
  `merchant_email` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `paid_amount_currency` varchar(10) NOT NULL,
  `payment_source` varchar(50) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vcategory`
--

CREATE TABLE `vcategory` (
  `ID` int(10) NOT NULL,
  `VehicleCat` varchar(120) DEFAULT NULL,
  `shortDescription` varchar(50) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vcategory`
--

INSERT INTO `vcategory` (`ID`, `VehicleCat`, `shortDescription`, `CreationDate`) VALUES
(3, 'Motor', 'Light Vehicle', '2023-12-12 20:04:28'),
(4, 'Bike', 'Light Vehicle with no engine', '2023-12-12 20:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `ID` int(10) NOT NULL,
  `area` varchar(20) NOT NULL,
  `slotid` varchar(120) DEFAULT NULL,
  `VehicleCategory` varchar(120) NOT NULL,
  `VehicleCompanyname` varchar(120) DEFAULT NULL,
  `RegistrationNumber` varchar(120) DEFAULT NULL,
  `OwnerName` varchar(120) DEFAULT NULL,
  `OwnerContactNumber` bigint(10) DEFAULT NULL,
  `InTime` timestamp NULL DEFAULT current_timestamp(),
  `OutTime` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ParkingCharge` varchar(120) NOT NULL,
  `chargeStatus` varchar(50) NOT NULL,
  `Remark` mediumtext NOT NULL,
  `Status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicle_info`
--

INSERT INTO `vehicle_info` (`ID`, `area`, `slotid`, `VehicleCategory`, `VehicleCompanyname`, `RegistrationNumber`, `OwnerName`, `OwnerContactNumber`, `InTime`, `OutTime`, `ParkingCharge`, `chargeStatus`, `Remark`, `Status`) VALUES
(1, 'Park-A', 'SLOT002', 'Motor', 'Honda', 'ASD 123', 'Daniel Padilla', 900132564, '2023-12-12 20:06:05', '2023-12-12 20:06:34', '25', '', 'Okay', 'Out'),
(2, 'Park-A', 'SLOT006', 'Bike', 'TREK', 'WEB123', 'Daniel Padilla', 900132564, '2023-12-12 20:08:36', NULL, '25', '', '', ''),
(3, 'Park-A', 'SLOT001', 'Motor', 'Honda', 'ASD 123', 'Ryan King', 900132564, '2023-12-12 20:12:56', NULL, '25', '', '', ''),
(4, 'Park-A', 'SLOT001', 'Motor', 'Honda', 'ASD 123', 'Ryan King', 900132564, '2023-12-12 20:17:29', NULL, '25', '', '', ''),
(5, 'Park-A', 'SLOT003', 'Motor', 'Honda', 'ASD 123', 'Ryan King', 900132564, '2023-12-12 20:17:46', NULL, '25', '', '', ''),
(6, 'Park-A', 'SLOT004', 'Motor', 'Toyota', 'ASD 123', 'Bea Conag', 900132564, '2023-12-12 20:18:44', NULL, '25', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `parkarea`
--
ALTER TABLE `parkarea`
  ADD PRIMARY KEY (`areaid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slotinfo`
--
ALTER TABLE `slotinfo`
  ADD KEY `fk_parkarea` (`areaName`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vcategory`
--
ALTER TABLE `vcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `parkarea`
--
ALTER TABLE `parkarea`
  MODIFY `areaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vcategory`
--
ALTER TABLE `vcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
