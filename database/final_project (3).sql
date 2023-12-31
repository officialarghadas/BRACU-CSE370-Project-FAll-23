-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 11:03 PM
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
-- Database: `final project`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment ID` int(11) NOT NULL,
  `Cost` int(11) NOT NULL,
  `Status` varchar(11) NOT NULL DEFAULT '1',
  `Doctor ID` int(11) NOT NULL,
  `Patient ID` int(11) NOT NULL,
  `CompName` varchar(100) DEFAULT NULL,
  `Slot Serial` int(11) NOT NULL,
  `Prescription` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Appointment ID`, `Cost`, `Status`, `Doctor ID`, `Patient ID`, `CompName`, `Slot Serial`, `Prescription`) VALUES
(3, 600, '2', 3, 4, NULL, 5, NULL),
(4, 600, '1', 6, 4, NULL, 1, NULL),
(5, 600, '1', 3, 4, 'Rimel', 2, NULL),
(6, 600, '1', 5, 4, NULL, 8, NULL),
(7, 600, '1', 6, 4, NULL, 9, NULL),
(8, 600, '2', 11, 4, NULL, 7, NULL),
(16, 500, '1', 6, 4, NULL, 9, NULL),
(20, 500, '1', 6, 4, NULL, 9, NULL),
(21, 500, '1', 6, 4, NULL, 9, NULL),
(22, 500, '1', 6, 4, NULL, 9, NULL),
(23, 500, '1', 6, 4, NULL, 9, NULL),
(24, 500, '1', 6, 4, NULL, 9, NULL),
(25, 500, '1', 6, 4, NULL, 9, NULL),
(29, 1000, '0', 3, 4, NULL, 8, NULL),
(30, 600, '0', 5, 4, NULL, 8, NULL),
(31, 0, '0', 112233, 4, NULL, 112233, NULL),
(32, 0, '0', 112233, 4, NULL, 112233, NULL),
(33, 0, '0', 112233, 4, NULL, 112233, NULL),
(34, 500, '0', 6, 4, NULL, 112233, NULL),
(35, 500, '0', 6, 4, NULL, 112233, NULL),
(36, 500, '0', 6, 4, NULL, 112233, NULL),
(37, 500, '0', 6, 4, NULL, 112233, NULL),
(38, 500, '0', 6, 4, NULL, 7, NULL),
(39, 500, '0', 6, 4, NULL, 7, NULL),
(40, 500, '0', 6, 4, NULL, 7, NULL),
(41, 500, '0', 6, 4, NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `capsule`
--

CREATE TABLE `capsule` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Patient Id` int(11) NOT NULL,
  `Medicine Id` int(11) NOT NULL,
  `Payment Status` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Patient Id`, `Medicine Id`, `Payment Status`, `Quantity`) VALUES
(4, 56, 1, 3),
(4, 56, 1, 3),
(4, 56, 1, 3),
(4, 56, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cream`
--

CREATE TABLE `cream` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `Degree ID` int(11) NOT NULL,
  `Degree` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`Degree ID`, `Degree`) VALUES
(112233, 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `Designation ID` int(11) NOT NULL,
  `Designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `Doctor ID` int(11) NOT NULL,
  `Doctor_Name` varchar(100) NOT NULL,
  `RegNo` varchar(11) NOT NULL,
  `Designation` varchar(40) DEFAULT NULL,
  `Specialties ID` int(11) DEFAULT NULL,
  `Degree ID` int(11) DEFAULT NULL,
  `E-Mail` varchar(200) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `Old Fee` int(11) NOT NULL,
  `New Fee` int(11) NOT NULL,
  `Activestatus` varchar(11) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`Doctor ID`, `Doctor_Name`, `RegNo`, `Designation`, `Specialties ID`, `Degree ID`, `E-Mail`, `Address`, `Old Fee`, `New Fee`, `Activestatus`) VALUES
(3, 'Dr.Ashim Kumar Nandi', 'AK47', 'Professor', 1, NULL, 'ashimnandi62@gmail.com', 'Mymensingh', 600, 1000, 'Active'),
(5, 'Fariha Jabin Farha', 'A12345', 'Intern', 1, NULL, 'farihajabin@gmail.com', 'Dhaka', 400, 600, 'Pending'),
(6, 'Mujibur Rahman Akash', 'F69069', 'Intern', 2, NULL, 'darkknightakash@gmail.com', 'Dhaka', 300, 500, 'Pending'),
(11, 'Cristiano Ronaldo', 'CR7', 'G.O.A.T', 2, NULL, 'ownerofucl@gmail.com', 'Our Heart', 0, 0, 'Pending'),
(78, 'sad yeamin sayem', '7878', NULL, 2, 112233, '', 'DHAKA', 0, 0, 'Pending'),
(112233, 'Dr. Sad', '112233', NULL, 2, NULL, '', 'dhaka', 0, 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `external`
--

CREATE TABLE `external` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gel`
--

CREATE TABLE `gel` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gives slot`
--

CREATE TABLE `gives slot` (
  `Doctor ID` int(11) NOT NULL,
  `Slot ID` int(11) NOT NULL,
  `Total Slots` int(11) NOT NULL,
  `Booked Slots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gives slot`
--

INSERT INTO `gives slot` (`Doctor ID`, `Slot ID`, `Total Slots`, `Booked Slots`) VALUES
(6, 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `injection`
--

CREATE TABLE `injection` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal`
--

CREATE TABLE `internal` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internal`
--

INSERT INTO `internal` (`Medicine Code`) VALUES
(56);

-- --------------------------------------------------------

--
-- Table structure for table `is with`
--

CREATE TABLE `is with` (
  `Patient ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `makes prescription`
--

CREATE TABLE `makes prescription` (
  `Doctor ID` int(11) NOT NULL,
  `Patient ID` int(11) NOT NULL,
  `Restricted Food ID` int(11) NOT NULL,
  `Symptoms ID` int(11) NOT NULL,
  `Date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `Medicine Code` int(11) NOT NULL,
  `Medicine Name` varchar(100) NOT NULL,
  `General Name` varchar(200) NOT NULL,
  `Cost` int(11) NOT NULL,
  `internal` varchar(2) NOT NULL,
  `type` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`Medicine Code`, `Medicine Name`, `General Name`, `Cost`, `internal`, `type`) VALUES
(56, 'napa extra', 'napa', 50, '0', '3'),
(93, 'metril', 'metril', 120, '0', '3');

-- --------------------------------------------------------

--
-- Table structure for table `patient companions`
--

CREATE TABLE `patient companions` (
  `Name` varchar(100) NOT NULL,
  `Patient ID` int(11) NOT NULL,
  `Relation` varchar(30) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `Mobile Number` varchar(20) NOT NULL,
  `Email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient companions`
--

INSERT INTO `patient companions` (`Name`, `Patient ID`, `Relation`, `Address`, `Mobile Number`, `Email`) VALUES
('Rimel', 4, 'Brother from another mother', 'Dhaka', '0176543512', 'rimel@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `Patient ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `Pregnant` tinyint(1) NOT NULL,
  `Breast Feeding` tinyint(1) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Blood Group` varchar(11) NOT NULL,
  `Marital Status` varchar(15) NOT NULL,
  `Old` tinyint(1) NOT NULL,
  `Previous History ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Patient ID`, `Name`, `Age`, `Gender`, `Pregnant`, `Breast Feeding`, `Email`, `Discount`, `Blood Group`, `Marital Status`, `Old`, `Previous History ID`) VALUES
(4, 'Aparup Chowdhury', 23, 'Male', 0, 0, 'apa@gmail.com', 0, 'A+', 'Unmarried', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pays for`
--

CREATE TABLE `pays for` (
  `Patient ID` int(11) NOT NULL,
  `Appointment ID` int(11) DEFAULT NULL,
  `Test Code` int(11) DEFAULT NULL,
  `Medicine Code` int(11) DEFAULT NULL,
  `Transaction ID` varchar(200) DEFAULT NULL,
  `Media` varchar(100) NOT NULL DEFAULT 'Bkash',
  `Total Amount` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pays for`
--

INSERT INTO `pays for` (`Patient ID`, `Appointment ID`, `Test Code`, `Medicine Code`, `Transaction ID`, `Media`, `Total Amount`) VALUES
(4, NULL, NULL, NULL, NULL, 'Bkash', 100);

-- --------------------------------------------------------

--
-- Table structure for table `previous history`
--

CREATE TABLE `previous history` (
  `Previous History ID` int(11) NOT NULL,
  `History Description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restricted food`
--

CREATE TABLE `restricted food` (
  `Restricted Food ID` int(11) NOT NULL,
  `Food Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `serves`
--

CREATE TABLE `serves` (
  `Doctor ID` int(11) NOT NULL,
  `Appointment ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `Slot ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Serial Number` varchar(2) NOT NULL,
  `Slot Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`Slot ID`, `Date`, `Time`, `Serial Number`, `Slot Status`) VALUES
(1, '2023-12-06', '18:00:00', '13', 1),
(2, '2023-12-05', '18:00:00', '07', 1),
(5, '2023-12-01', '16:19:56', '05', 1),
(7, '2023-12-02', '17:19:56', '17', 1),
(8, '2023-12-31', '15:36:31', '18', 1),
(9, '2024-01-03', '18:36:31', '09', 0),
(112233, '2023-12-13', '00:00:18', '63', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `Specialties ID` int(11) NOT NULL,
  `Specialities` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`Specialties ID`, `Specialities`) VALUES
(1, 'Skin & VD'),
(2, 'Medicine');

-- --------------------------------------------------------

--
-- Table structure for table `spray`
--

CREATE TABLE `spray` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `Symptoms ID` int(11) NOT NULL,
  `Symptom Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tablet`
--

CREATE TABLE `tablet` (
  `Medicine Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablet`
--

INSERT INTO `tablet` (`Medicine Code`) VALUES
(56);

-- --------------------------------------------------------

--
-- Table structure for table `testcart`
--

CREATE TABLE `testcart` (
  `Test Id` int(11) NOT NULL,
  `Patient Id` int(11) NOT NULL,
  `Payment Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testcart`
--

INSERT INTO `testcart` (`Test Id`, `Patient Id`, `Payment Status`) VALUES
(55, 4, 1),
(55, 4, 1),
(55, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `Test Code` int(11) NOT NULL,
  `Test Name` varchar(100) NOT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`Test Code`, `Test Name`, `Cost`) VALUES
(55, 'X-Ray', 400);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Mobile Number` varchar(30) NOT NULL,
  `is_doctor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User ID`, `Username`, `Password`, `Mobile Number`, `is_doctor`) VALUES
(3, 'Ashim_Nandi', 'an323538', '01711323538', 1),
(4, 'Aparup_Chy', 'aparup69', '01842154276', 0),
(5, 'Fariha_Jab', 'ungabunga', '01788615726', 1),
(6, 'dark_knight', 'akash69', '01748282349', 1),
(11, 'CR_7', 'siuuu', '01733145283', 1),
(12, 'Messi_leo', 'uclplz', '01752621621', 1),
(78, 'hihi', 'sfdf', '01745184720', 1),
(112233, 'sad', 'iamsad', '01745184728', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Appointment ID`),
  ADD KEY `Doctor ID` (`Doctor ID`),
  ADD KEY `Paitent ID` (`Patient ID`),
  ADD KEY `Slot Serial` (`Slot Serial`),
  ADD KEY `CompName` (`CompName`);

--
-- Indexes for table `capsule`
--
ALTER TABLE `capsule`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `Patient Id_2` (`Patient Id`,`Medicine Id`);

--
-- Indexes for table `cream`
--
ALTER TABLE `cream`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`Degree ID`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`Designation ID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`Doctor ID`),
  ADD KEY `Doctor ID` (`Doctor ID`),
  ADD KEY `Specialties ID` (`Specialties ID`),
  ADD KEY `Degree ID` (`Degree ID`),
  ADD KEY `Designation ID` (`Designation`);

--
-- Indexes for table `external`
--
ALTER TABLE `external`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `gel`
--
ALTER TABLE `gel`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `gives slot`
--
ALTER TABLE `gives slot`
  ADD KEY `Doctor ID` (`Doctor ID`),
  ADD KEY `Slot ID` (`Slot ID`);

--
-- Indexes for table `injection`
--
ALTER TABLE `injection`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `internal`
--
ALTER TABLE `internal`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `is with`
--
ALTER TABLE `is with`
  ADD KEY `Patient ID` (`Patient ID`),
  ADD KEY `Name` (`Name`);

--
-- Indexes for table `makes prescription`
--
ALTER TABLE `makes prescription`
  ADD KEY `Doctor ID` (`Doctor ID`),
  ADD KEY `Patient ID` (`Patient ID`),
  ADD KEY `Restricted Food ID` (`Restricted Food ID`),
  ADD KEY `Symptoms ID` (`Symptoms ID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`Medicine Code`),
  ADD UNIQUE KEY `General Name` (`General Name`);

--
-- Indexes for table `patient companions`
--
ALTER TABLE `patient companions`
  ADD PRIMARY KEY (`Name`,`Patient ID`),
  ADD KEY `Patient ID` (`Patient ID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Patient ID`),
  ADD KEY `Previous History ID` (`Previous History ID`);

--
-- Indexes for table `pays for`
--
ALTER TABLE `pays for`
  ADD UNIQUE KEY `Transaction ID` (`Transaction ID`),
  ADD KEY `Patient ID` (`Patient ID`),
  ADD KEY `Appointment ID` (`Appointment ID`),
  ADD KEY `Test Code` (`Test Code`),
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `previous history`
--
ALTER TABLE `previous history`
  ADD PRIMARY KEY (`Previous History ID`);

--
-- Indexes for table `restricted food`
--
ALTER TABLE `restricted food`
  ADD PRIMARY KEY (`Restricted Food ID`);

--
-- Indexes for table `serves`
--
ALTER TABLE `serves`
  ADD KEY `Doctor ID` (`Doctor ID`),
  ADD KEY `Appointment ID` (`Appointment ID`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`Slot ID`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`Specialties ID`);

--
-- Indexes for table `spray`
--
ALTER TABLE `spray`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`Symptoms ID`);

--
-- Indexes for table `tablet`
--
ALTER TABLE `tablet`
  ADD KEY `Medicine Code` (`Medicine Code`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`Test Code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User ID`),
  ADD UNIQUE KEY `Mobile Number` (`Mobile Number`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Appointment ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `Medicine Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `previous history`
--
ALTER TABLE `previous history`
  MODIFY `Previous History ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restricted food`
--
ALTER TABLE `restricted food`
  MODIFY `Restricted Food ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `Slot ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112234;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `Symptoms ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `Test Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112234;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`Doctor ID`) REFERENCES `doctors` (`Doctor ID`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`Slot Serial`) REFERENCES `slots` (`Slot ID`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`Patient ID`) REFERENCES `patients` (`Patient ID`),
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`CompName`) REFERENCES `patient companions` (`Name`);

--
-- Constraints for table `capsule`
--
ALTER TABLE `capsule`
  ADD CONSTRAINT `capsule_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `internal` (`Medicine Code`);

--
-- Constraints for table `cream`
--
ALTER TABLE `cream`
  ADD CONSTRAINT `cream_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `external` (`Medicine Code`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`Degree ID`) REFERENCES `degree` (`Degree ID`),
  ADD CONSTRAINT `doctors_ibfk_3` FOREIGN KEY (`Specialties ID`) REFERENCES `specialities` (`Specialties ID`),
  ADD CONSTRAINT `doctors_ibfk_4` FOREIGN KEY (`Doctor ID`) REFERENCES `users` (`User ID`);

--
-- Constraints for table `external`
--
ALTER TABLE `external`
  ADD CONSTRAINT `external_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `medicine` (`Medicine Code`);

--
-- Constraints for table `gel`
--
ALTER TABLE `gel`
  ADD CONSTRAINT `gel_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `external` (`Medicine Code`);

--
-- Constraints for table `gives slot`
--
ALTER TABLE `gives slot`
  ADD CONSTRAINT `gives slot_ibfk_1` FOREIGN KEY (`Doctor ID`) REFERENCES `doctors` (`Doctor ID`),
  ADD CONSTRAINT `gives slot_ibfk_2` FOREIGN KEY (`Slot ID`) REFERENCES `slots` (`Slot ID`);

--
-- Constraints for table `injection`
--
ALTER TABLE `injection`
  ADD CONSTRAINT `injection_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `internal` (`Medicine Code`);

--
-- Constraints for table `internal`
--
ALTER TABLE `internal`
  ADD CONSTRAINT `internal_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `medicine` (`Medicine Code`);

--
-- Constraints for table `is with`
--
ALTER TABLE `is with`
  ADD CONSTRAINT `is with_ibfk_1` FOREIGN KEY (`Patient ID`) REFERENCES `patients` (`Patient ID`),
  ADD CONSTRAINT `is with_ibfk_2` FOREIGN KEY (`Name`) REFERENCES `patient companions` (`Name`);

--
-- Constraints for table `makes prescription`
--
ALTER TABLE `makes prescription`
  ADD CONSTRAINT `makes prescription_ibfk_1` FOREIGN KEY (`Doctor ID`) REFERENCES `doctors` (`Doctor ID`),
  ADD CONSTRAINT `makes prescription_ibfk_2` FOREIGN KEY (`Patient ID`) REFERENCES `patients` (`Patient ID`),
  ADD CONSTRAINT `makes prescription_ibfk_3` FOREIGN KEY (`Symptoms ID`) REFERENCES `symptoms` (`Symptoms ID`),
  ADD CONSTRAINT `makes prescription_ibfk_4` FOREIGN KEY (`Restricted Food ID`) REFERENCES `restricted food` (`Restricted Food ID`);

--
-- Constraints for table `patient companions`
--
ALTER TABLE `patient companions`
  ADD CONSTRAINT `patient companions_ibfk_1` FOREIGN KEY (`Patient ID`) REFERENCES `patients` (`Patient ID`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`Previous History ID`) REFERENCES `previous history` (`Previous History ID`),
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`Patient ID`) REFERENCES `users` (`User ID`);

--
-- Constraints for table `pays for`
--
ALTER TABLE `pays for`
  ADD CONSTRAINT `pays for_ibfk_1` FOREIGN KEY (`Patient ID`) REFERENCES `patients` (`Patient ID`),
  ADD CONSTRAINT `pays for_ibfk_2` FOREIGN KEY (`Appointment ID`) REFERENCES `appointment` (`Appointment ID`),
  ADD CONSTRAINT `pays for_ibfk_3` FOREIGN KEY (`Medicine Code`) REFERENCES `medicine` (`Medicine Code`),
  ADD CONSTRAINT `pays for_ibfk_4` FOREIGN KEY (`Test Code`) REFERENCES `tests` (`Test Code`);

--
-- Constraints for table `serves`
--
ALTER TABLE `serves`
  ADD CONSTRAINT `serves_ibfk_1` FOREIGN KEY (`Doctor ID`) REFERENCES `doctors` (`Doctor ID`),
  ADD CONSTRAINT `serves_ibfk_2` FOREIGN KEY (`Appointment ID`) REFERENCES `appointment` (`Appointment ID`);

--
-- Constraints for table `spray`
--
ALTER TABLE `spray`
  ADD CONSTRAINT `spray_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `external` (`Medicine Code`);

--
-- Constraints for table `tablet`
--
ALTER TABLE `tablet`
  ADD CONSTRAINT `tablet_ibfk_1` FOREIGN KEY (`Medicine Code`) REFERENCES `internal` (`Medicine Code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
