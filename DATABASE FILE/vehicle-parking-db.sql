-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 05:36 PM
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
(18, 'Park-A', 'All type of vehicle', 10),
(19, 'Park-B', 'Light Vehicles only', 5);

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
('SLOT005', 'Park-A', 'reserved'),
('SLOT006', 'Park-A', 'reserved'),
('SLOT007', 'Park-A', 'AVAILABLE'),
('SLOT008', 'Park-A', 'AVAILABLE'),
('SLOT009', 'Park-A', 'AVAILABLE'),
('SLOT010', 'Park-A', 'AVAILABLE'),
('SLOT001', 'Park-B', 'reserved'),
('SLOT002', 'Park-B', 'reserved'),
('SLOT003', 'Park-B', 'reserved'),
('SLOT004', 'Park-B', 'reserved'),
('SLOT005', 'Park-B', 'reserved');

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
(7, 'Bike', 'Light Vehicle with no engine', '2023-12-10 13:32:39'),
(8, 'E-bike', 'Electric Bicycle', '2023-12-10 13:32:59'),
(9, 'Motor', 'Light Vehicle with Engine', '2023-12-10 13:33:25'),
(10, 'Car', 'Vehicle with four wheels', '2023-12-10 13:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `ID` int(10) NOT NULL,
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

INSERT INTO `vehicle_info` (`ID`, `slotid`, `VehicleCategory`, `VehicleCompanyname`, `RegistrationNumber`, `OwnerName`, `OwnerContactNumber`, `InTime`, `OutTime`, `ParkingCharge`, `chargeStatus`, `Remark`, `Status`) VALUES
(1, '96069', 'Four Wheeler', 'Hyundai', 'GGZ-1155', 'Jamie Macon', 8956232528, '2021-03-09 05:58:38', '2021-03-09 10:15:43', '34', '', 'NA', 'Out'),
(2, '52796', 'Two Wheeler', 'KTM', 'GTM-1069', 'Dan Wilson', 8989898989, '2021-03-09 08:58:38', '2021-03-09 14:16:26', '20', '', 'NA', 'Out'),
(3, '65023', 'Two Wheeler', 'Yamaha', 'JFF-7888', 'Lynn Roberts\n', 7845123697, '2021-03-09 08:58:38', '2021-03-09 12:16:31', '20', '', 'Vehicle Out', 'Out'),
(4, '90880', 'Two Wheeler', 'Suzuki', 'PLO-8507', 'Charles Mathew', 2132654447, '2021-03-09 08:58:38', '2021-03-09 13:58:38', '20', '', 'Vehicle Out', 'Out'),
(5, '09894', 'Two Wheeler', 'Piaggio', 'DLE-7701', 'Theresa Hay\n', 4654654654, '2021-03-09 08:58:38', '2021-03-09 14:58:38', '15', '', 'none', 'Out'),
(6, '78915', 'Two Wheeler', 'Aprilia', 'GZG-7896', 'Susie Eller', 7978999879, '2021-03-09 08:58:38', NULL, '', '', '', ''),
(7, '25207', 'Two Wheeler', 'Honda', 'LDC-7019', 'Shannon Pinson\n', 1234567890, '2021-03-09 11:03:05', '2021-03-09 11:58:38', '5', '', 'none', 'Out'),
(8, '58836', 'Two Wheeler', 'Yamaha', 'FYS-6969', 'Mark Paull', 1234567890, '2021-03-09 11:32:02', '2021-03-09 12:58:38', '5', '', 'Vehicle Out', 'Out'),
(9, '52207', 'Four Wheeler', 'Ford ', 'CAS-7850', 'Bernice Willilams\n', 7411112000, '2021-03-07 10:42:52', '2021-03-09 11:58:38', '7', '', 'none', 'Out'),
(10, '47648', 'Four Wheeler', 'Tesla', 'CST-6907', 'Myra Warnke\n', 8541112500, '2021-03-07 14:54:03', NULL, '', '', '', ''),
(11, '03289', 'Four Wheeler', 'Volkswagen', 'STT-7002', 'Colin Greenwood', 2574442560, '2021-03-08 13:50:15', NULL, '', '', '', ''),
(12, '62450', 'Two Wheeler', 'KTM', 'ILS-2580', 'Bruno Denn', 1254447850, '2021-03-08 09:34:55', '2021-03-08 15:58:38', '30', '', 'none', 'Out'),
(13, '28913', 'Four Wheeler', 'Hyundai', 'SSO-8800', 'Tanya Chilton\n', 2570005640, '2021-03-09 13:09:16', NULL, '', '', '', ''),
(14, '63879', 'Four Wheeler', 'Hyundai', 'GEP-7805', 'Matthew  Foust\n', 6667869500, '2021-07-16 15:28:32', '2021-07-16 17:17:19', '5', '', 'none', 'Out'),
(15, '37066', 'Four Wheeler', 'Tesla', 'QWE-9602', 'Paul Nicholls', 7412589658, '2021-07-17 16:18:01', '2021-07-17 16:49:40', '5', '', 'none', 'Out'),
(16, '19803', 'Four Wheeler', 'Renault', 'ABE-3470', 'Alyse Conn', 7896547850, '2021-07-17 16:59:26', '2021-07-17 17:20:22', '2', '', 'none', 'Out'),
(17, '25088', 'Four Wheeler', 'Volkswagen', 'TRS-8027', 'Bonnie Jackson', 7014741470, '2021-07-17 17:40:22', NULL, '', '', '', ''),
(18, '37496', 'Four Wheeler', 'Chevrolet', 'VNT-9135', 'Larry Clark', 7890240001, '2021-07-17 17:43:16', NULL, '', '', '', ''),
(19, '99316', 'Four Wheeler', 'MG', 'PIJ-8802', 'Jessica Garner', 7012560025, '2021-07-17 17:44:07', '2021-07-17 17:45:05', '3', '', 'none.', 'Out'),
(20, '59268', 'Two Wheeler', 'Kawasaki', 'LLL-8987', 'James', 7014569980, '2021-07-17 17:46:37', NULL, '', '', '', ''),
(21, '62740', 'Motor', 'Honda', 'ASD 123', 'Ryan King', 900132564, '2023-12-10 13:38:55', NULL, '', '', '', ''),
(22, '14488', 'Car', 'Toyota', 'ASD 123', 'Ryan King', 900132564, '2023-12-10 13:43:27', NULL, '', '', '', ''),
(23, '22537', 'Car', 'Toyota', 'ASD 123', 'Ryan King', 900132564, '2023-12-10 13:44:27', NULL, '', '', '', ''),
(24, '98370', 'Car', 'Honda', 'ASD 123', 'Ryan King', 900132564, '2023-12-10 13:45:37', NULL, '', '', '', ''),
(25, '75984', 'Bike', 'Honda', 'ASD 123', 'Ryan King', 900132564, '2023-12-10 13:47:09', NULL, '', '', '', ''),
(26, '69184', 'E-bike', 'Honda', 'ASD 123', 'Ryan King', 900132564, '2023-12-10 13:47:43', NULL, '', '', '', ''),
(27, '98711', 'Bike', 'Bike', 'ASD-123', 'Ryan King', 900132564, '2023-12-12 13:00:09', NULL, '', '', '', ''),
(28, 'SLOT001', 'Bike', 'Bike', 'ASD-1234', 'Ryan King', 900132564, '2023-12-12 13:25:46', NULL, '', '', '', ''),
(29, 'SLOT002', 'Motor', 'Honda', 'QWE123', 'Daniel Padilla', 902020202, '2023-12-12 13:31:39', NULL, '', '', '', ''),
(30, 'SLOT001', 'Car', 'Mitsubishi', 'QWE123', 'Bea Conag', 900132564, '2023-12-12 13:37:41', NULL, '', '', '', ''),
(31, 'SLOT001', 'Car', 'Mitsubishi', 'QWE123', 'Bea Conag', 900132564, '2023-12-12 13:37:51', NULL, '', '', '', ''),
(32, 'SLOT001', 'Car', 'Mitsubishi', 'QWE123', 'Bea Conag', 900132564, '2023-12-12 13:38:18', NULL, '', '', '', ''),
(33, 'SLOT001', 'Car', 'Mitsubishi', 'QWE123', 'Bea Conag', 900132564, '2023-12-12 13:39:41', NULL, '', '', '', ''),
(34, 'SLOT003', 'Car', 'Honda', 'ASD-123', 'Kathleen Sison', 902020202, '2023-12-12 15:42:31', NULL, '', '', '', ''),
(35, 'SLOT002', 'Car', 'Mitsubishi', 'ASD-123', 'Ben Ben', 902020202, '2023-12-12 15:47:08', NULL, '', '', '', ''),
(36, 'SLOT002', 'Car', 'Mitsubishi', 'ASD-123', 'Ben Ben', 902020202, '2023-12-12 15:49:56', NULL, '', '', '', ''),
(37, 'SLOT004', 'Motor', 'Honda', 'ASD-123', 'Ryan King', 900132564, '2023-12-12 15:53:21', NULL, '', '', '', ''),
(38, 'SLOT005', 'Motor', 'Honda', 'ASD-123', 'Ryan King', 900132564, '2023-12-12 15:58:35', '2023-12-12 16:26:33', '25', '', 'okay', 'Out'),
(39, 'SLOT006', 'E-bike', 'Honda', 'ASD-123', 'Ryan King', 900132564, '2023-12-12 16:18:23', '2023-12-12 16:26:15', '25', '', 'okay', 'Out');

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
  MODIFY `areaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
