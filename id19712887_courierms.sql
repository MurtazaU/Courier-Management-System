-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2022 at 08:13 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id19712887_courierms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminId` int(10) UNSIGNED NOT NULL,
  `AdminEmail` varchar(100) NOT NULL,
  `AdminPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminId`, `AdminEmail`, `AdminPassword`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `AgentId` int(10) UNSIGNED NOT NULL,
  `AgentName` varchar(100) NOT NULL,
  `AgentEmail` varchar(100) NOT NULL,
  `AgentPassword` varchar(100) NOT NULL,
  `AgentFranchiseId` int(10) UNSIGNED NOT NULL,
  `AgentRegistrationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`AgentId`, `AgentName`, `AgentEmail`, `AgentPassword`, `AgentFranchiseId`, `AgentRegistrationDate`) VALUES
(1, 'Asif Ali', 'asif@gmail.com', 'asif123', 1, NULL),
(5, 'Name', 'email@gmail.com', 'password', 1, NULL),
(6, 'agentName', 'agent@gmail.com', 'agent', 1, NULL),
(7, 'Agent', 'agent@email.com', 'agent', 1, '2022-10-08'),
(8, 'agent', 'admin@gmail.com', 'agent', 1, '2022-10-10'),
(9, 'Agent', 'admin1@gmail.com', 'agent', 1, '2022-10-10'),
(10, 'Agent', 'admin3@gmail.com', 'agent', 1, '2022-10-10'),
(11, 'Lahore', 'lahore@agent.com', 'agent', 3, '2022-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `CountryId` int(10) UNSIGNED NOT NULL,
  `CountryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`CountryId`, `CountryName`) VALUES
(2, 'Pakistan'),
(3, 'India'),
(4, 'Sri Lanka'),
(5, 'Bangladesh'),
(6, 'Afghanistan'),
(7, 'Palestine'),
(8, 'Germany'),
(9, 'Turkey'),
(11, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerId` int(10) UNSIGNED NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerEmail` varchar(100) NOT NULL,
  `CustomerPassword` varchar(100) NOT NULL,
  `CustomerZipCode` varchar(100) NOT NULL,
  `CustomerCountryId` int(10) UNSIGNED NOT NULL,
  `CustomerState` varchar(100) NOT NULL,
  `CustomerCity` varchar(100) NOT NULL,
  `CustomerAddress` varchar(255) NOT NULL,
  `CustomerNumber` varchar(100) NOT NULL,
  `CustomerRegistrationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerId`, `CustomerName`, `CustomerEmail`, `CustomerPassword`, `CustomerZipCode`, `CustomerCountryId`, `CustomerState`, `CustomerCity`, `CustomerAddress`, `CustomerNumber`, `CustomerRegistrationDate`) VALUES
(12, 'Murtaza Usmani', 'murtazausmani985@gmail.com', 'murtaza', '75080', 2, 'Sindh', 'Karachi', 'A-140, Block-5, Saadi Town', '92335330990', NULL),
(13, 'Ali Asghar', 'ali@gmail.com', 'ali123', '79021', 3, 'Uttar Pradesh', 'Mirzapur', '89-B, Street 12', '+93 212313131', NULL),
(14, 'Name', 'email@gmail.com', 'password', '75080', 2, 'Sindh', 'Karachi', 'A-140, Block-5, Saadi-Town', '923353309980', '2022-10-07'),
(16, 'mustafausmani', 'mustafausmani902@gmail.com', 'mustafa', '23413', 2, 'Sidnh', 'Karachi', 'Address', '9233533210', '2022-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryservice`
--

CREATE TABLE `deliveryservice` (
  `DeliveryServiceId` int(10) UNSIGNED NOT NULL,
  `DeliveryServiceName` varchar(100) NOT NULL,
  `DeliveryServiceTimeFrom` varchar(50) NOT NULL,
  `DeliveryServiceTimeTo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveryservice`
--

INSERT INTO `deliveryservice` (`DeliveryServiceId`, `DeliveryServiceName`, `DeliveryServiceTimeFrom`, `DeliveryServiceTimeTo`) VALUES
(1, 'Express', '2 Days', '4 Days'),
(4, 'Test', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `franchise`
--

CREATE TABLE `franchise` (
  `FranchiseId` int(10) UNSIGNED NOT NULL,
  `FranchiseCode` varchar(255) NOT NULL,
  `FranchiseName` varchar(100) NOT NULL,
  `FranchiseEmail` varchar(100) NOT NULL,
  `FranchiseNumber` int(11) NOT NULL,
  `FranchiseAddress` varchar(255) NOT NULL,
  `FranchiseCity` varchar(155) NOT NULL,
  `FranchiseState` varchar(155) NOT NULL,
  `FranchiseCountryId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `franchise`
--

INSERT INTO `franchise` (`FranchiseId`, `FranchiseCode`, `FranchiseName`, `FranchiseEmail`, `FranchiseNumber`, `FranchiseAddress`, `FranchiseCity`, `FranchiseState`, `FranchiseCountryId`) VALUES
(1, '270-KH', 'Karachi, University Road', '', 0, 'B-340, Block-5, University Road', 'Karachi', 'Sindh', 2),
(3, 'FR311', 'Area, Lahore', 'lahore@gmail.com', 2147483647, 'Address, lahore', 'Lahore', 'Punjab', 2);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `PackageId` int(10) UNSIGNED NOT NULL,
  `PackageSenderId` int(10) UNSIGNED NOT NULL,
  `PackageReceiverName` varchar(100) NOT NULL,
  `PackageReceiverNumber` varchar(100) NOT NULL,
  `PackageFromAddress` varchar(255) NOT NULL,
  `PackageToAddress` varchar(255) NOT NULL,
  `PackageReceiverZipCode` varchar(100) NOT NULL,
  `PackageReceiverCity` varchar(100) NOT NULL,
  `PackageReceiverCountry` int(10) UNSIGNED NOT NULL,
  `PackageCode` varchar(255) NOT NULL,
  `PackageWeightId` int(10) UNSIGNED NOT NULL,
  `PackageSpecialService` varchar(255) NOT NULL,
  `PackageProductTypeId` int(10) UNSIGNED NOT NULL,
  `PackageAgentId` int(10) UNSIGNED NOT NULL,
  `PackageFranchiseId` int(10) UNSIGNED NOT NULL,
  `PackageDeliveryServiceId` int(10) UNSIGNED NOT NULL,
  `PackageStatus` varchar(50) NOT NULL DEFAULT 'Registered',
  `PackageDateReceived` date DEFAULT NULL,
  `PackageDateDelivered` date DEFAULT NULL,
  `PackageRegistrationCity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`PackageId`, `PackageSenderId`, `PackageReceiverName`, `PackageReceiverNumber`, `PackageFromAddress`, `PackageToAddress`, `PackageReceiverZipCode`, `PackageReceiverCity`, `PackageReceiverCountry`, `PackageCode`, `PackageWeightId`, `PackageSpecialService`, `PackageProductTypeId`, `PackageAgentId`, `PackageFranchiseId`, `PackageDeliveryServiceId`, `PackageStatus`, `PackageDateReceived`, `PackageDateDelivered`, `PackageRegistrationCity`) VALUES
(4, 13, 'Abdullah12313', '92313141312313123131312313', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'Package138', 1, '', 1, 6, 1, 1, 'Delivered', '2022-10-09', NULL, 'Karachi'),
(5, 13, 'Abdullah', '123131321', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'Package939', 1, '', 1, 6, 1, 1, 'Delivered', '2022-10-09', '2022-10-14', 'Karachi'),
(8, 13, 'Abdullah', '123131332131', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'Package338', 1, '', 1, 5, 1, 1, 'Delivered', '2022-10-09', NULL, 'Karachi'),
(9, 14, 'Abdullah', '231313212', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'Package983', 1, '', 1, 5, 1, 1, 'In Progress', '2022-10-09', NULL, 'Karachi'),
(10, 13, 'Abdullah', '2313123131', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'Package359', 1, '', 1, 5, 1, 1, 'Delivered', '2022-10-09', '2022-10-10', 'Karachi'),
(11, 13, 'Abdullah', '3123131', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'Package872', 1, '', 1, 6, 1, 1, 'In Progress', '2022-10-09', NULL, 'Karachi'),
(12, 13, 'Abdullah', '9231413213', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'Package270', 1, '', 1, 5, 1, 1, 'Registered', '2022-10-10', NULL, 'Karachi'),
(14, 13, 'Abdullah', '1314132131', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'CR-27614', 1, '', 1, 1, 1, 1, 'In Progress', '2022-10-10', NULL, 'Karachi'),
(15, 12, 'Test', '21313141', 'Test', 'Test', '231123', 'Test', 3, 'CR-23413', 1, '', 1, 7, 1, 1, 'Registered', '2022-10-01', NULL, 'Karachi'),
(16, 12, 'Test', '21313141', 'Test', 'Test', '231123', 'Test', 3, 'CR-23413', 1, '', 1, 7, 1, 1, 'Registered', '2022-09-11', NULL, 'Karachi'),
(17, 12, 'Test', '21313141', 'Test', 'Test', '231123', 'Test', 3, 'CR-23413', 1, '', 1, 7, 1, 1, 'Registered', '2022-08-11', NULL, 'Karachi'),
(18, 14, 'Jamal', '93132141321', 'Address Of Sender', 'Receiver Address', '50323', 'Karachi', 5, 'CR-63047', 1, '', 1, 5, 1, 1, 'Registered', '2022-10-10', NULL, ''),
(19, 14, 'Jamal', '93132141321', 'Address Of Sender', 'Receiver Address', '50323', 'Karachi', 5, 'CR-16475', 1, '', 1, 5, 1, 1, 'Registered', '2022-10-10', NULL, ''),
(20, 14, 'Jamal', '93132141321', 'Address Of Sender', 'Receiver Address', '50323', 'Karachi', 5, 'CR-61452', 1, '', 1, 5, 1, 1, 'Registered', '2022-10-10', NULL, ''),
(21, 14, 'Jamal', '93132141321', 'Address Of Sender', 'Receiver Address', '50323', 'Karachi', 5, 'CR-57080', 1, '', 1, 5, 1, 1, 'Registered', '2022-10-10', NULL, 'Karachi'),
(24, 14, 'Receiver', '9231413131', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'CR-70695', 2, '', 27, 11, 3, 4, 'Registered', '2022-10-11', NULL, 'Lahore'),
(25, 14, 'Murtaza', '08090909', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'CR-7125', 1, '', 1, 11, 3, 1, 'Registered', '2022-10-11', NULL, 'Lahore'),
(27, 12, 'Jamal', '92335330330091', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'CR-28691', 1, '', 1, 8, 1, 1, 'Registered', '2022-10-14', NULL, 'Karachi'),
(28, 13, 'Rizwan¥‎', '9324131313', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'CR-62800', 1, '', 1, 8, 1, 1, 'In Progress', '2022-10-15', NULL, 'Karachi'),
(29, 13, 'Test123`', '9231314131', 'A-140, Block-5, Saadi Town', 'A-170, Block-5, Saadi Town', '75030', 'Karachi', 4, 'CR-61340', 1, '', 1, 8, 3, 1, 'Registered', '2022-10-15', NULL, 'Lahore');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `ProductTypeId` int(10) UNSIGNED NOT NULL,
  `ProductTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`ProductTypeId`, `ProductTypeName`) VALUES
(1, 'Fragile'),
(27, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `weightclass`
--

CREATE TABLE `weightclass` (
  `WeightClassId` int(10) UNSIGNED NOT NULL,
  `WeightClassName` varchar(100) NOT NULL,
  `WeightClassFromLimit` varchar(100) NOT NULL,
  `WeightClassToLimit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weightclass`
--

INSERT INTO `weightclass` (`WeightClassId`, `WeightClassName`, `WeightClassFromLimit`, `WeightClassToLimit`) VALUES
(1, 'FeatherWeight', '20Kg', '35Kg'),
(2, 'Test', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`AgentId`),
  ADD KEY `AgentFranchiseId` (`AgentFranchiseId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`CountryId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerId`),
  ADD KEY `CustomerCountryId` (`CustomerCountryId`);

--
-- Indexes for table `deliveryservice`
--
ALTER TABLE `deliveryservice`
  ADD PRIMARY KEY (`DeliveryServiceId`);

--
-- Indexes for table `franchise`
--
ALTER TABLE `franchise`
  ADD PRIMARY KEY (`FranchiseId`),
  ADD KEY `FranchiseCountryId` (`FranchiseCountryId`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`PackageId`),
  ADD KEY `PackageSenderId` (`PackageSenderId`),
  ADD KEY `PackageAgentId` (`PackageAgentId`),
  ADD KEY `package_ibfk_2` (`PackageWeightId`),
  ADD KEY `PackageDeliveryServiceId` (`PackageDeliveryServiceId`),
  ADD KEY `package_ibfk_3` (`PackageProductTypeId`),
  ADD KEY `PackageReceiverCountry` (`PackageReceiverCountry`),
  ADD KEY `PackageFranchiseId` (`PackageFranchiseId`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`ProductTypeId`);

--
-- Indexes for table `weightclass`
--
ALTER TABLE `weightclass`
  ADD PRIMARY KEY (`WeightClassId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `AgentId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `CountryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `deliveryservice`
--
ALTER TABLE `deliveryservice`
  MODIFY `DeliveryServiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `franchise`
--
ALTER TABLE `franchise`
  MODIFY `FranchiseId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `PackageId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `ProductTypeId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `weightclass`
--
ALTER TABLE `weightclass`
  MODIFY `WeightClassId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_2` FOREIGN KEY (`AgentFranchiseId`) REFERENCES `franchise` (`FranchiseId`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`CustomerCountryId`) REFERENCES `country` (`CountryId`);

--
-- Constraints for table `franchise`
--
ALTER TABLE `franchise`
  ADD CONSTRAINT `franchise_ibfk_1` FOREIGN KEY (`FranchiseCountryId`) REFERENCES `country` (`CountryId`);

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`PackageSenderId`) REFERENCES `customer` (`CustomerId`),
  ADD CONSTRAINT `package_ibfk_2` FOREIGN KEY (`PackageWeightId`) REFERENCES `weightclass` (`WeightClassId`),
  ADD CONSTRAINT `package_ibfk_3` FOREIGN KEY (`PackageProductTypeId`) REFERENCES `producttype` (`ProductTypeId`),
  ADD CONSTRAINT `package_ibfk_4` FOREIGN KEY (`PackageAgentId`) REFERENCES `agent` (`AgentId`),
  ADD CONSTRAINT `package_ibfk_5` FOREIGN KEY (`PackageDeliveryServiceId`) REFERENCES `deliveryservice` (`DeliveryServiceId`),
  ADD CONSTRAINT `package_ibfk_6` FOREIGN KEY (`PackageReceiverCountry`) REFERENCES `country` (`CountryId`),
  ADD CONSTRAINT `package_ibfk_7` FOREIGN KEY (`PackageFranchiseId`) REFERENCES `franchise` (`FranchiseId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
