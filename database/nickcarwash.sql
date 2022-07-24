-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2022 at 02:03 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nickcarwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `icAdmin` bigint(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `adminId` int(3) NOT NULL,
  `adminFirstName` varchar(50) NOT NULL,
  `adminLastName` varchar(50) NOT NULL,
  `adminAddress` varchar(100) NOT NULL,
  `adminPhone` varchar(15) NOT NULL,
  `adminEmail` varchar(20) NOT NULL,
  `adminDOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`icAdmin`, `password`, `adminId`, `adminFirstName`, `adminLastName`, `adminAddress`, `adminPhone`, `adminEmail`, `adminDOB`) VALUES
(615070566, 'admin', 3, 'Peter', 'Koay', 'Penang', '0124724532', 'peter@gmail.com', '2000-06-15'),
(900410080721, '123', 1, 'Jess', 'Lee', 'Kuala Lumpur', '0173567758', 'jess@gmail.com', '1990-04-10'),
(980705070366, 'abc', 2, 'Richard', 'Lim', 'Penang', '0123875221', 'richard@gmail.com', '1998-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appId` int(3) NOT NULL,
  `customerIc` bigint(12) NOT NULL,
  `ScheduleId` int(10) NOT NULL,
  `services` varchar(100) NOT NULL,
  `Comment` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appId`, `customerIc`, `ScheduleId`, `services`, `Comment`, `status`) VALUES
(1, 920517105553, 1, 'Car Polish & Wax', '11am-12pm?', 'done'),
(88, 920517105553, 9, 'Exterior Car Detailing', 'HI', 'process');

-- --------------------------------------------------------

--
-- Table structure for table `carwashschedule`
--

CREATE TABLE `carwashschedule` (
  `ScheduleId` int(11) NOT NULL,
  `ScheduleDate` date NOT NULL,
  `ScheduleDay` varchar(15) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `bookavail` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carwashschedule`
--

INSERT INTO `carwashschedule` (`ScheduleId`, `ScheduleDate`, `ScheduleDay`, `StartTime`, `EndTime`, `bookavail`) VALUES
(1, '2021-07-19', 'Tuesday', '09:00:00', '10:00:00', 'Not Availa'),
(2, '2021-07-14', 'Thursday', '10:00:00', '11:00:00', 'Available'),
(3, '2021-07-15', 'Friday', '11:00:00', '12:00:00', 'Available'),
(4, '2021-06-13', 'Monday', '11:00:00', '12:00:00', 'Not Availa'),
(5, '2021-05-13', 'Friday', '13:00:00', '14:00:00', 'Available'),
(6, '2022-07-17', 'Sunday', '08:00:00', '10:00:00', 'notavail'),
(7, '2022-07-20', 'Wednesday', '10:00:00', '03:00:00', 'notavail'),
(8, '2022-07-22', 'Friday', '16:00:00', '17:00:00', 'notavail'),
(9, '2022-07-23', 'Saturday', '15:00:00', '16:00:00', 'available'),
(10, '2022-07-24', 'Sunday', '10:00:00', '11:00:00', 'available'),
(11, '2022-07-25', 'Monday', '12:00:00', '03:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `contactdata`
--

CREATE TABLE `contactdata` (
  `contact_id` int(11) NOT NULL,
  `txtName` varchar(100) NOT NULL,
  `txtEmail` varchar(255) NOT NULL,
  `txtPhone` varchar(15) NOT NULL,
  `txtSubject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ic` bigint(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `CarModel` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ic`, `password`, `FirstName`, `LastName`, `CarModel`, `DOB`, `Gender`, `Address`, `Phone`, `Email`) VALUES
(101070111, 'nicholas123', 'Nicholas', 'Wong', '', '2000-01-01', 'male', '', '', 'nicholaswongkx@gmail.com'),
(606020111, '123', 'Test', '1', '', '1986-04-13', 'male', '', '', 'hello@gmail.com'),
(850912070101, 'test123', 'Test', 'Name', '', '1985-09-12', 'male', '', '', 'testname@gmail.com'),
(920517105553, '123', 'Mohd', 'Mazlan', 'Honda Civic', '1992-05-17', 'male', 'NO 153 BLOK MURNI\r\nKOLEJ CANSELOR UNIVERSITI PUTRA MALAYSIA', '173567758', 'lan.psis@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `servicedata`
--

CREATE TABLE `servicedata` (
  `id` int(11) NOT NULL,
  `servicename` varchar(100) NOT NULL,
  `description` varchar(4096) DEFAULT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicedata`
--

INSERT INTO `servicedata` (`id`, `servicename`, `description`, `filename`) VALUES
(1, 'Snow Wash With Vacuum', 'Our hand car wash service cleans thoroughly the exterior and interior of your car. Providing good protection to your car from keeping the body stay shine and away from contaminants.', 'snowwash.jpg'),
(2, 'Full Car Detailing', 'We provide professional car detailing in Penang which includes interior and exterior detail with a full clean, hand polish protection with scratch & swirl mark reduction treatment.', 'fulldetailing.jpg'),
(3, 'Interior Car Detailing', 'We often protect our car body by washing and polishing, but we shouldn’t neglect the interior, which will direct impact the comfortness of the driver and its occupants.', 'interiordetailing.jpg'),
(4, 'Exterior Car Detailing', 'We provide a top-notch exterior-only car detailing service to restore your car body and prolong its best shape.', 'exteriordetailing.jpg'),
(5, 'Car Polish & Wax', 'Our car polish and wax service using the finest polishes to providing your vehicle with extra shine paint protection and a showroom finish result.', 'carpolish.jpg'),
(6, 'Car Ceramic Coating 9H', 'We provide a 9H nano-ceramic coating technology that gives a permanent bond with the factory paintwork and hardness protection for minor scratches, long-lasting shinier and glossier than ever before.', 'ceramiccoating9h.jpg'),
(7, 'Car Seat Cleaning', 'Our car cushion cleaning service caters for both leather and fabric car seat. We detail the car seat by cleaning and safely removing stubborn stains, sweat mark, coffee spills, dirt, etc.', 'seatcleaning.jpg'),
(8, 'Windscreen & Window Coating', 'Our car window coating service including removing watermarks & stains and applying coating with water repellent product. It helps repels water, dirt, dust & eliminates stone chips.', 'windscreen.jpg'),
(9, 'Headlamp Restoration & Polishing', 'We provide car headlamp restoration service including cleaning and polishing to help your car headlight to restore a brand new look-alike feel.', 'exteriordetailing.jpg'),
(10, 'Rim & Wheel Coating', 'We offer a rim wax coating service by applying a form of wax coat to protect your car wheel and tire against rust, dull, UV ray and dirt.', 'rim.jpg'),
(11, 'Car Disinfection & Sanitizing', 'Our car disinfection and sanitizing service kills 99.99% of germs & bacteria and comes with an air-refreshing effect that provides clean, fresh, and healthy air inside your vehicle.', 'DisinfectionSanitizing.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`icAdmin`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appId`),
  ADD UNIQUE KEY `scheduleId_2` (`ScheduleId`) USING BTREE,
  ADD KEY `customerIc` (`customerIc`),
  ADD KEY `scheduleId` (`ScheduleId`) USING BTREE;

--
-- Indexes for table `carwashschedule`
--
ALTER TABLE `carwashschedule`
  ADD PRIMARY KEY (`ScheduleId`);

--
-- Indexes for table `contactdata`
--
ALTER TABLE `contactdata`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `servicedata`
--
ALTER TABLE `servicedata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `carwashschedule`
--
ALTER TABLE `carwashschedule`
  MODIFY `ScheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `servicedata`
--
ALTER TABLE `servicedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`customerIc`) REFERENCES `customers` (`ic`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`ScheduleId`) REFERENCES `carwashschedule` (`ScheduleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
