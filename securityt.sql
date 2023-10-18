-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2023 at 07:00 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securityt`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `administrator_id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `aid` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_type` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `bin` int NOT NULL,
  PRIMARY KEY (`administrator_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`administrator_id`, `name`, `aid`, `user_type`, `bin`) VALUES
(1, '9F22200130062D5E55122476A328FC03', 'EA0B1A8F8563BF67AD0C5569ED4F1B26', 'ADFBD751728D1DCB', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `yorn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chair`
--

DROP TABLE IF EXISTS `chair`;
CREATE TABLE IF NOT EXISTS `chair` (
  `chair_id` int NOT NULL AUTO_INCREMENT,
  `teacher_id` int NOT NULL,
  `department_id` int NOT NULL,
  `bin` int NOT NULL,
  PRIMARY KEY (`chair_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `chair`
--

INSERT INTO `chair` (`chair_id`, `teacher_id`, `department_id`, `bin`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `course_id` int NOT NULL,
  `student_id` int NOT NULL,
  `bin` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `course_name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `short_name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `department_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `bin` int NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `short_name`, `department_id`, `teacher_id`, `bin`) VALUES
(1, '1F16508AABABA8520FF21A4DF1644F6B4767FDF8F6C1FB271FFA47DFB4E9A0D8', '43AC3F4644205D20', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `bin` int NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `bin`) VALUES
(1, 'F161D250858F2BE7EDE1E969FFA5EAEE3DBA175DF1B598E3', 0),
(2, '76C48E19C49DBF830C41C24A9F2726B8688CBD9FA818496E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `parent_id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `phone_number` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_type` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `name`, `phone_number`, `user_type`) VALUES
(1, '147D79DC45A5A9229830AC5D86CE0528', '5E8971DC8CEA470F', 'C8D73D131C1612EA');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `department_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `student_number` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_type` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `bin` int NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `department_id`, `parent_id`, `student_number`, `address`, `user_type`, `bin`) VALUES
(1, '4F6664D2C2E8A9E49830AC5D86CE0528', 1, 1, '990405017A65BE52AD0C5569ED4F1B26', '7721475C1122364B208508E0A260E06D', 'E54184A7FFF5DAC9', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tid` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `department_id` int NOT NULL,
  `user_type` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `bin` int NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `tid`, `department_id`, `user_type`, `bin`) VALUES
(1, '9B7D53360ED9E0840E35D84974D6DFB2C59D14E8245951077B6F4F3891FCDDB7', 'F6A3463645D3CF43384758454FDC49DA', 1, '637CE4068236E73E', 0),
(2, 'DF98F55C28E382D00EC68A50F8487E05', 'F6A3463645D3CF43C2C343FC62401E02', 1, '637CE4068236E73E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `user_type` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `id`, `user_type`, `password`) VALUES
(1, 1, 'ADFBD751728D1DCB', '1263AB2BC8737F20'),
(2, 1, '637CE4068236E73E', '1263AB2BC8737F20'),
(3, 1, 'C8D73D131C1612EA', '1263AB2BC8737F20'),
(4, 1, 'E54184A7FFF5DAC9', '1263AB2BC8737F20'),
(5, 2, '637CE4068236E73E', '1263AB2BC8737F20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
