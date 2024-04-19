-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2024 at 10:46 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebMaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `chair`
--

CREATE TABLE `chair` (
  `chid` int(11) NOT NULL,
  `simindex` int(10) DEFAULT NULL,
  `simcon` varchar(100) DEFAULT NULL,
  `thirdmark` varchar(50) DEFAULT NULL,
  `finalmk` int(50) DEFAULT NULL,
  `chfeed` text DEFAULT NULL,
  `ex1_report_total` int(10) DEFAULT NULL,
  `ex1_viva_total` int(10) DEFAULT NULL,
  `ex1_difficulty` int(10) DEFAULT NULL,
  `ex1_exisskill` int(10) DEFAULT NULL,
  `ex1_newskill` int(10) DEFAULT NULL,
  `ex1_proimp` int(10) DEFAULT NULL,
  `ex1_understand` int(10) DEFAULT NULL,
  `ex1_addedval` text DEFAULT NULL,
  `ex1_overallcom` text DEFAULT NULL,
  `ex2_report_total` int(10) DEFAULT NULL,
  `ex2_viva_total` int(10) DEFAULT NULL,
  `ex2_difficulty` int(10) DEFAULT NULL,
  `ex2_exisskill` int(10) DEFAULT NULL,
  `ex2_newskill` int(10) DEFAULT NULL,
  `ex2_proimp` int(10) DEFAULT NULL,
  `ex2_understand` int(10) DEFAULT NULL,
  `ex2_addedval` text DEFAULT NULL,
  `ex2_overallcom` text DEFAULT NULL,
  `iitid` int(11) NOT NULL,
  `staffemail` varchar(150) DEFAULT NULL,
  `final_viva_mark` int(50) DEFAULT NULL,
  `final_report_mark` int(50) DEFAULT NULL,
  `final_project_mark` int(50) DEFAULT NULL,
  `final_module_mark` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chair`
--

INSERT INTO `chair` (`chid`, `simindex`, `simcon`, `thirdmark`, `finalmk`, `chfeed`, `ex1_report_total`, `ex1_viva_total`, `ex1_difficulty`, `ex1_exisskill`, `ex1_newskill`, `ex1_proimp`, `ex1_understand`, `ex1_addedval`, `ex1_overallcom`, `ex2_report_total`, `ex2_viva_total`, `ex2_difficulty`, `ex2_exisskill`, `ex2_newskill`, `ex2_proimp`, `ex2_understand`, `ex2_addedval`, `ex2_overallcom`, `iitid`, `staffemail`, `final_viva_mark`, `final_report_mark`, `final_project_mark`, `final_module_mark`) VALUES
(28, 0, 'No', 'No', 30, 'asdsad', 12, 25, 23, 32, 23, 23, 23, 'sdfsf', 'dsfsf', 45, 29, 23, 23, 32, 34, 34, '42342', 'cvsv', 7777, 'dilshard.a@iit.ac.lk', 30, 29, 28, 29),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018613, NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018614, NULL, NULL, NULL, NULL, NULL),
(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018615, NULL, NULL, NULL, NULL, NULL),
(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018616, NULL, NULL, NULL, NULL, NULL),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018617, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `examiner_mark`
--

CREATE TABLE `examiner_mark` (
  `exmkid` int(11) NOT NULL,
  `aim` int(3) DEFAULT NULL,
  `stakehold` int(3) DEFAULT NULL,
  `elicitation` int(3) DEFAULT NULL,
  `reqlist` int(3) DEFAULT NULL,
  `reqana` int(3) DEFAULT NULL,
  `ref` int(3) DEFAULT NULL,
  `protodemo` int(3) DEFAULT NULL,
  `genfeed` text DEFAULT NULL,
  `below40` text DEFAULT NULL,
  `tot_report` int(50) DEFAULT NULL,
  `difficulty` int(3) DEFAULT NULL,
  `exisskill` int(3) DEFAULT NULL,
  `newskill` int(3) DEFAULT NULL,
  `proimp` int(3) DEFAULT NULL,
  `understand` int(3) DEFAULT NULL,
  `addedval` text DEFAULT NULL,
  `overallcom` text DEFAULT NULL,
  `total_viva` int(50) DEFAULT NULL,
  `examiner_count` int(2) DEFAULT NULL,
  `iitid` int(11) NOT NULL,
  `staffemail` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examiner_mark`
--

INSERT INTO `examiner_mark` (`exmkid`, `aim`, `stakehold`, `elicitation`, `reqlist`, `reqana`, `ref`, `protodemo`, `genfeed`, `below40`, `tot_report`, `difficulty`, `exisskill`, `newskill`, `proimp`, `understand`, `addedval`, `overallcom`, `total_viva`, `examiner_count`, `iitid`, `staffemail`) VALUES
(62, 12, 12, 12, 12, 12, 12, 12, 'sdasd', 'asdsad', 12, 23, 32, 23, 23, 23, 'sdfsf', 'dsfsf', 25, 1, 7777, 'dilshard.a@iit.ac.lk'),
(63, 45, 45, 45, 45, 45, 45, 45, 'fsf', 'dfsf', 45, 23, 23, 32, 34, 34, '42342', 'cvsv', 29, 2, 7777, 'dilshard.a@iit.ac.lk'),
(64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2018613, NULL),
(65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2018613, NULL),
(66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2018614, NULL),
(67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2018614, NULL),
(68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2018615, NULL),
(69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2018615, NULL),
(70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2018616, NULL),
(71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2018616, NULL),
(72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2018617, NULL),
(73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2018617, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `login_email` varchar(200) DEFAULT NULL,
  `log` text DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `student_id` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `table_name`, `login_email`, `log`, `time`, `student_id`) VALUES
(10, 'Supervisor-PP', 'john@iit.ac.lk', '12, 12, 12, 12, 12, 12, 12, 12', '2024-04-16 19:26:16', '7777'),
(11, 'Supervisor-PP', 'john@iit.ac.lk', '45, 45, 45, 45, 45, 45, 45, sample sample sample sample , example example example example , 45', '2024-04-16 19:27:34', '7777'),
(12, 'Supervisor-Planning', 'john@iit.ac.lk', '99', '2024-04-16 19:29:07', '7777'),
(13, 'Examiner-report', 'john@iit.ac.lk', '34, 34, 43, 23, 43, 43, 23, sampel, sampel sampel sampel sampel, 34.714285714286', '2024-04-16 19:33:02', '8888'),
(15, 'Examiner-viva', 'john@iit.ac.lk', '89, 45, 56, 43, 32, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 53', '2024-04-16 19:35:54', '7777'),
(17, 'Chair', 'john@iit.ac.lk', '23, 53, 89, 32, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 60.67, sample, 60.67, 24.50, 33.05, 34.98', '2024-04-16 19:49:04', '7777'),
(18, 'Chair', 'john@iit.ac.lk', '23, 53, 89, 32, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 60.67, sample, 60.67, 24.50, 33.05, 34.98', '2024-04-16 20:22:19', '7777'),
(19, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-16 20:30:57', '7777'),
(20, 'Chair', 'john@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 52.25, sample sample, 52.25, 24.50, 30.05, 32.88', '2024-04-16 20:31:27', '7777'),
(21, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:11:32', '7777'),
(22, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:12:58', '7777'),
(23, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:13:28', '7777'),
(24, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:14:59', '7777'),
(25, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:16:55', '7777'),
(26, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:18:36', '7777'),
(27, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:21:15', '7777'),
(28, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:27:42', '7777'),
(29, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:30:48', '7777'),
(30, 'Examiner-viva', 'john@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 14:33:45', '7777'),
(31, 'Examiner-viva', 'john@iit.ac.lk', '12, 23, 23, 23, 23, asdadas, ededa, 20.8', '2024-04-17 14:37:18', '8888'),
(32, 'Examiner-viva', 'john@iit.ac.lk', '56, 23, 23, 23, 23, asdadas, ededa, 29.6', '2024-04-17 14:40:24', '8888'),
(33, 'Examiner-report', 'dilshard.20220423@iit.ac.lk', '34, 54, 34, 54, 34, 34, 32, IIT Celebrates 30 years of Educational Excellence with resounding success in Information Technology and Business Education. We have groomed more than 5000 successful graduates during the past three decades with a growing network of alumni in Sri Lanka and around the globe., Informatics Institute of Technology (IIT) was established in Colombo, Sri Lanka in 1990 as the first private higher education institute awarding reputed British degrees in the field of Information Communication Technology (ICT) and professional business, 39.428571428571', '2024-04-17 14:57:00', '8888'),
(34, 'Examiner-viva', 'dilshard.20220423@iit.ac.lk', '56, 23, 23, 23, 23, Informatics Institute of Technology (IIT) was established in Colombo, Sri Lanka in 1990 as the first private higher education institute awarding reputed British degrees in the field of Information Communication Technology (ICT) and professional business, Informatics Institute of Technology (IIT) was established in Colombo, Sri Lanka in 1990 as the first private higher education institute awarding reputed British degrees in the field of Information Communication Technology (ICT) and professional business, 29.6', '2024-04-17 14:58:20', '8888'),
(35, 'Examiner-viva', 'dilshard.20220423@iit.ac.lk', '56, 23, 23, 23, 23, asdadas, ededa, 29.6', '2024-04-17 14:59:48', '8888'),
(36, 'Examiner-report', 'dilshard.a@iit.ac.lk', '99, 12, 12, 12, 12, 21, 12, dsf, sdf, 25.714285714286', '2024-04-17 15:00:35', '7777'),
(37, 'Examiner-report', 'dilshard.a@iit.ac.lk', '100, 11, 10, 10, 10, 10, 10, test test test test t, test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test , 23', '2024-04-17 15:03:33', '7777'),
(38, 'Examiner-report', 'dilshard.a@iit.ac.lk', '100, 11, 10, 10, 10, 10, 10, test test test test t, test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test , 23', '2024-04-17 15:04:26', '7777'),
(39, 'Examiner-viva', 'dilshard.a@iit.ac.lk', '10, 45, 56, 43, 10, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 32.8', '2024-04-17 15:06:17', '7777'),
(40, 'Supervisor-PP', 'dilshard.a@iit.ac.lk', '34, 34, 34, 23, 42, Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support, Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support, 33.4', '2024-04-17 15:14:39', '7777'),
(41, 'Supervisor-PP', 'dilshard.a@iit.ac.lk', '54, 54, 34, 43, 34, Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support, Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support, 43.8', '2024-04-17 15:16:28', '7777'),
(42, 'Supervisor-PP', 'dilshard.a@iit.ac.lk', '23, 43, 23, 44, 45, 65, 34, Mr777(7777) - Learning disabilitiesMr777(7777) - Learning disabilities, Mr777(7777) - Learning disabilities Mr777(7777) - Learning disabilities, 39.571428571429', '2024-04-17 15:22:14', '7777'),
(43, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '45', '2024-04-17 15:26:44', '7777'),
(44, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 51, sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair , 43.25, 24.50, 30.05, 33.23', '2024-04-17 15:45:23', '7777'),
(45, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 43.25, sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair sample feedback chair, 43.25, 24.50, 30.05, 33.23', '2024-04-17 15:48:23', '7777'),
(46, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 43.25, sample, 43.25, 24.50, 30.05, 33.23', '2024-04-17 16:00:36', '7777'),
(47, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 43.25, le sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample, 43.25, 24.50, 30.05, 33.23', '2024-04-17 16:05:09', '7777'),
(48, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 43.25, ample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 43.25, 24.50, 30.05, 33.23', '2024-04-17 16:08:46', '7777'),
(49, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 43.25, le sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample samp, 43.25, 24.50, 30.05, 33.23', '2024-04-17 16:12:18', '7777'),
(50, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 43.25, mple sample sample sample sample sample sample sample sample sample sample sam, 43.25, 24.50, 30.05, 33.23', '2024-04-17 16:15:25', '7777'),
(51, 'Chair', 'dilshard.a@iit.ac.lk', '23, 33, 10, 10, 45, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 26, 53, 100, 32, 34, 56, 43, sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample , 0, No, No, 43.25,  sample sample sample sample sample sample sample sample sample sample sample sample sample sample sample samp, 43.25, 24.50, 30.05, 33.23', '2024-04-17 16:22:07', '7777'),
(52, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '34', '2024-04-17 16:35:23', '7777'),
(53, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:35:59', '7777'),
(54, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:38:42', '7777'),
(55, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:41:41', '7777'),
(56, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:41:56', '7777'),
(57, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:42:05', '7777'),
(58, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:43:37', '7777'),
(59, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:45:46', '7777'),
(60, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '23', '2024-04-17 16:45:52', '7777'),
(61, 'Supervisor-Planning', 'zzzz@iit.lk', '23', '2024-04-17 16:57:01', '4545'),
(62, 'Examiner-report', 'mrdilshard@gmail.com', '12, 12, 12, 12, 12, 12, 12, 2121212, 12121, 12', '2024-04-17 17:51:44', '9999'),
(63, 'By Admin', 'zzzz@iit.lk', 'Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table', '2024-04-18 21:58:48', '77778'),
(64, 'By Admin', 'zzzz@iit.lk', 'Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table', '2024-04-18 21:59:22', '77778'),
(65, 'By Admin', 'zzzz@iit.lk', 'Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table', '2024-04-18 22:01:05', '77778'),
(66, 'By Admin', 'zzzz@iit.lk', 'Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table', '2024-04-18 22:12:40', '7777'),
(67, 'By Admin', 'zzzz@iit.lk', 'Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table', '2024-04-18 22:27:58', '7777'),
(68, 'By Admin', 'zzzz@iit.lk', 'Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table', '2024-04-18 22:29:56', '7777'),
(69, 'By Admin', 'zzzz@iit.lk', 'Deleted staff from Chair Examiner Schedule Staff ', '2024-04-18 23:03:56', 'sahan@iit.ac.lk'),
(70, 'By Admin', 'zzzz@iit.lk', 'Deleted staff from Chair Examiner Schedule Staff ', '2024-04-18 23:18:10', '123@iit.ac.lk'),
(71, 'Admin - inserted Staff', 'afaz@iit.ac.lk', 'afaz@iit.ac.lk, afaz, 1233, WU9GOOJP, staff, ft, Ai', '2024-04-18 23:21:19', 'zzzz@iit.lk'),
(72, 'Admin - inserted Staff', 'shiraz@iit.ac.lk', 'shiraz@iit.ac.lk, Shiraz, 4567, HRPZRKBD, admin, pt, Machine', '2024-04-18 23:21:19', 'zzzz@iit.lk'),
(73, 'By Admin', 'zzzz@iit.lk', 'Deleted staff from Chair Examiner Schedule Staff ', '2024-04-18 23:23:22', 'mrdilshard@gmail.com'),
(74, 'By Admin', 'zzzz@iit.lk', 'Deleted staff from Chair Examiner Schedule Staff ', '2024-04-18 23:25:11', 'shiraz@iit.ac.lk'),
(75, 'By Admin', 'zzzz@iit.lk', 'Deleted staff from Chair Examiner Schedule Staff ', '2024-04-18 23:25:16', 'afaz@iit.ac.lk'),
(76, 'Admin - inserted Staff', 'afaz@iit.ac.lk', 'afaz@iit.ac.lk, afaz, 1233, E14UY&4O, staff, ft, Ai', '2024-04-18 23:26:02', 'zzzz@iit.lk'),
(77, 'Admin - inserted Staff', 'shiraz@iit.ac.lk', 'shiraz@iit.ac.lk, Shiraz, 4567, 1FCZW8PB, admin, pt, Machine', '2024-04-18 23:26:02', 'zzzz@iit.lk'),
(78, 'By Admin', 'zzzz@iit.lk', 'Deleted staff from Chair Examiner Schedule Staff ', '2024-04-18 23:26:28', 'shiraz@iit.ac.lk'),
(79, 'Examiner-report', 'dilshard.a@iit.ac.lk', '12, 12, 12, 12, 12, 12, 12, sdasd, asdsad, 12', '2024-04-18 23:30:20', '7777'),
(80, 'Examiner-report', 'dilshard.a@iit.ac.lk', '12, 12, 12, 12, 12, 12, 12, sdasd, asdsad, 12', '2024-04-18 23:30:24', '7777'),
(81, 'Admin - inserted Staff', 'by dilshard.a@iit.ac.lk', 'zzzz@iit.lk, XVOEDQ2E, ft, zzzz, Machine Learning, 123, admin', '2024-04-18 23:32:47', 'zzzz@iit.lk'),
(82, 'Examiner-viva', 'dilshard.a@iit.ac.lk', '23, 32, 23, 23, 23, sdfsf, dsfsf, 24.8', '2024-04-18 23:38:22', '7777'),
(83, 'Examiner-report', 'dilshard.a@iit.ac.lk', '45, 45, 45, 45, 45, 45, 45, fsf, dfsf, 45', '2024-04-18 23:39:22', '7777'),
(84, 'Examiner-viva', 'dilshard.a@iit.ac.lk', '23, 23, 32, 34, 34, 42342, cvsv, 29.2', '2024-04-18 23:39:47', '7777'),
(85, 'Supervisor-PP', 'dilshard.a@iit.ac.lk', '21, 12, 21, 12, 12, 12dfdsfs, dfsf, 15.6', '2024-04-18 23:40:12', '7777'),
(86, 'Supervisor-PP', 'dilshard.a@iit.ac.lk', '34, 34, 34, 34, 34, 34, 34, fddgds, sdfsf, 34', '2024-04-18 23:40:32', '7777'),
(87, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '45', '2024-04-18 23:40:44', '7777'),
(88, 'Chair', 'dilshard.a@iit.ac.lk', '12, 25, 23, 23, 32, 23, 23, sdfsf, dsfsf, 45, 29, 23, 34, 23, 32, 34, 42342, cvsv, 45, No, No, 30.00, adassadad, 30.00, 28.50, 28.05, 28.93', '2024-04-18 23:42:01', '7777'),
(89, 'By Admin', 'zzzz@iit.lk', 'Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table', '2024-04-19 00:12:00', '2018618'),
(90, 'Admin - inserted Staff', 'by zzzz@iit.lk', 'servermail2002@gmail.com, UWN@PW62, pt, Afaz, Machine Learning, 1231312, staff', '2024-04-19 00:35:23', 'servermail2002@gmail.com'),
(91, 'Admin - inserted Staff', 'adfafd@iit.ac.lk', 'adfafd@iit.ac.lk, abcd, 1234, 8SCHCXGK, staff, ft, Ai', '2024-04-19 00:39:58', 'zzzz@iit.lk'),
(92, 'By Admin', 'zzzz@iit.lk', 'Deleted staff from Chair Examiner Schedule Staff ', '2024-04-19 00:41:22', 'servermail2002@gmail.com'),
(93, 'Admin - inserted Staff', 'mrdilshard@gmail.com', 'mrdilshard@gmail.com, abcd, 1234, D7DH1071, staff, ft, Ai', '2024-04-19 00:41:44', 'zzzz@iit.lk'),
(94, 'Admin - inserted Staff', 'dilshard.20220423@iit.ac.lk', 'dilshard.20220423@iit.ac.lk, abcd, 1234, 6G4YN7YM, staff, ft, Ai', '2024-04-19 00:41:50', 'zzzz@iit.lk'),
(95, 'Admin - inserted Staff', 'mrdilshard@gmail.com', 'mrdilshard@gmail.com, abcd, 1234, 8EF6BPAO, staff, ft, Ai', '2024-04-19 00:49:49', 'zzzz@iit.lk'),
(96, 'Admin - inserted Staff', 'mrdilshard@gmail.com', 'mrdilshard@gmail.com, abcd, 1234, CRUSR9X#, staff, ft, Ai', '2024-04-19 00:50:34', 'zzzz@iit.lk'),
(97, 'Admin - inserted Staff', 'dilshard.20220423@iit.ac.lk', 'dilshard.20220423@iit.ac.lk, abcd, 1234, Z5ZMC@ZD, staff, ft, Ai', '2024-04-19 00:50:39', 'zzzz@iit.lk'),
(98, 'Admin - inserted Staff', 'mrdilshard@gmail.com', 'mrdilshard@gmail.com, abcd, 1234, GTPTD2YZ, staff, ft, Ai', '2024-04-19 00:52:35', 'zzzz@iit.lk'),
(99, 'Admin - inserted Staff', 'dilshard.20220423@iit.ac.lk', 'dilshard.20220423@iit.ac.lk, abcd, 1234, HF#3HFU&, staff, ft, Ai', '2024-04-19 00:52:35', 'zzzz@iit.lk'),
(100, 'Admin - inserted Staff', 'mrdilshard@gmail.com', 'mrdilshard@gmail.com, abcd, 1234, GTWVMYY0, staff, ft, Ai', '2024-04-19 00:53:47', 'zzzz@iit.lk'),
(101, 'Admin - inserted Staff', 'dilshard.20220423@iit.ac.lk', 'dilshard.20220423@iit.ac.lk, abcd, 1234, @U&9R902, staff, ft, Ai', '2024-04-19 00:53:51', 'zzzz@iit.lk'),
(102, 'Admin - inserted Staff', 'servermail2002@gmail.com', 'servermail2002@gmail.com, abcd, 1234, AR7&&TW&, staff, ft, Ai', '2024-04-19 01:16:27', 'zzzz@iit.lk'),
(103, 'Admin - inserted Staff', 'mrdilshard@gmail.com', 'mrdilshard@gmail.com, abcd, 1234, VK#FNH2V, staff, ft, Ai', '2024-04-19 01:17:08', 'zzzz@iit.lk'),
(104, 'Admin - inserted Staff', 'dilshard.20220423@iit.ac.lk', 'dilshard.20220423@iit.ac.lk, abcd, 1234, GN8TR87@, staff, ft, Ai', '2024-04-19 01:17:08', 'zzzz@iit.lk'),
(105, 'Admin - inserted Staff', 'servermail2002@gmail.com', 'servermail2002@gmail.com, abcd, 1234, M8EDV5@2, staff, ft, Ai', '2024-04-19 01:17:08', 'zzzz@iit.lk'),
(106, 'Chair', 'dilshard.a@iit.ac.lk', '12, 25, 23, 23, 32, 23, 23, sdfsf, dsfsf, 45, 29, 23, 34, 23, 32, 34, 42342, cvsv, 0, No, No, 30.00, sample, 30.00, 28.50, 28.05, 28.93', '2024-04-19 12:51:50', '7777'),
(107, 'Chair', 'dilshard.a@iit.ac.lk', '12, 25, 23, 23, 32, 23, 23, sdfsf, dsfsf, 45, 29, 23, 34, 23, 32, 34, 42342, cvsv, 0, No, No, 30.00, sada, 30.00, 28.50, 28.05, 28.93', '2024-04-19 12:52:34', '7777'),
(108, 'Chair', 'dilshard.a@iit.ac.lk', '12, 25, 23, 23, 32, 23, 23, sdfsf, dsfsf, 45, 29, 23, 34, 23, 32, 34, 42342, cvsv, 0, No, No, 30.00, asdsad, 30.00, 28.50, 28.05, 28.93', '2024-04-19 12:54:30', '7777'),
(109, 'Supervisor-Planning', 'dilshard.a@iit.ac.lk', '46', '2024-04-19 13:55:43', '7777');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schid` int(11) NOT NULL,
  `meeting_time` time DEFAULT NULL,
  `meeting_date` date DEFAULT NULL,
  `hall` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `iitid` int(50) NOT NULL,
  `staffemail` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schid`, `meeting_time`, `meeting_date`, `hall`, `link`, `role`, `iitid`, `staffemail`) VALUES
(78, '23:31:00', '2024-04-13', '4LA', 'http://localhost/phpmyadmin/ind', 'Examiner1', 7777, 'dilshard.a@iit.ac.lk'),
(79, '23:31:00', '2024-04-20', '4LA', 'http://localhost/phpmyadmin/ind', 'Examiner2', 7777, 'dilshard.a@iit.ac.lk'),
(80, '10:29:00', '2024-04-17', '4LA', 'http://localhost/phpmyadmin/ind', 'Supervisor', 7777, 'dilshard.a@iit.ac.lk'),
(81, '23:32:00', '2024-04-12', '4LA', 'http://localhost/phpmyadmin/ind', 'Chair', 7777, 'dilshard.a@iit.ac.lk');

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `staffid` int(11) NOT NULL,
  `staffemail` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `staffname` varchar(100) NOT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `ftpt` varchar(50) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `pass_attempt` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`staffid`, `staffemail`, `password`, `staffname`, `contact`, `ftpt`, `area`, `role`, `pass_attempt`) VALUES
(8, 'john@iit.ac.lk', '123', 'Dilshard', '123', 'ft', 'Machine Learning', 'staff', 1),
(10, 'pushpika@iit.ac.lk', 'sample1', 'Pushpika', '123123123', 'ft', 'Machine Learning', 'staff', 1),
(23, 'abcd@iit.ac.lk', 'F52R1N9T', 'abcd', '1234', 'ft', 'Ai', 'staff', 0),
(141, 'dilshard.a@iit.ac.lk', '123', 'Dilshard Office', '1324141', 'ft', 'Ai', 'staff', 1),
(145, 'afaz@iit.ac.lk', 'E14UY&4O', 'afaz', '1233', 'ft', 'Ai', 'staff', 0),
(147, 'zzzz@iit.lk', '123', 'zzzz', '123', 'ft', 'Machine Learning', 'admin', 1),
(160, 'mrdilshard@gmail.com', 'VK#FNH2V', 'abcd', '1234', 'ft', 'Ai', 'staff', 0),
(161, 'dilshard.20220423@iit.ac.lk', 'GN8TR87@', 'abcd', '1234', 'ft', 'Ai', 'staff', 0),
(162, 'servermail2002@gmail.com', 'M8EDV5@2', 'abcd', '1234', 'ft', 'Ai', 'staff', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `iitid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `uowno` varchar(10) NOT NULL,
  `studentname` varchar(100) NOT NULL,
  `projtitle` text NOT NULL,
  `stream` varchar(10) DEFAULT NULL,
  `resarea` varchar(255) DEFAULT NULL,
  `shortdes` text DEFAULT NULL,
  `final_viva_mark` int(10) DEFAULT NULL,
  `final_report_mark` int(10) DEFAULT NULL,
  `final_project_mark` int(10) DEFAULT NULL,
  `final_module_mark` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`iitid`, `email`, `pass`, `uowno`, `studentname`, `projtitle`, `stream`, `resarea`, `shortdes`, `final_viva_mark`, `final_report_mark`, `final_project_mark`, `final_module_mark`) VALUES
(7777, 'student1@iit.ac.lk', '12213', 'w7777', 'Student1', 'Learning disabilities', 'CS', 'Machine learning', 'dffa', 30, 29, 28, 29),
(2018613, 'someone1@iit.ac.lk', 'abcd1234', 'W1234567', 'someone1', 'sample title 1', 'CS', 'Machine Learning', 'description description description', 0, 0, 0, 0),
(2018614, 'someone2@iit.ac.lk', 'abcd1234', 'W1234568', 'someone2', 'sample title 2', 'SE', 'Machine Learning', 'description description description', 0, 0, 0, 0),
(2018615, 'someone3@iit.ac.lk', 'abcd1234', 'W1234569', 'someone3', 'sample title 3', 'CS', 'Machine Learning', 'description description description', 0, 0, 0, 0),
(2018616, 'someone4@iit.ac.lk', 'abcd1234', 'W1234570', 'someone4', 'sample title 4', 'SE', 'Machine Learning', 'description description description', 0, 0, 0, 0),
(2018617, 'someone5@iit.ac.lk', 'abcd1234', 'W1234571', 'someone5', 'sample title 5', 'SE', 'Machine Learning', 'description description description', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sup_mark_pp_pspd`
--

CREATE TABLE `sup_mark_pp_pspd` (
  `supmkid` int(11) NOT NULL,
  `probstate` int(3) DEFAULT NULL,
  `revsim` int(3) DEFAULT NULL,
  `tool` int(3) DEFAULT NULL,
  `reqlist_pp` int(3) DEFAULT NULL,
  `challenge` int(3) DEFAULT NULL,
  `supfeed_pp` text DEFAULT NULL,
  `below40_pp` text DEFAULT NULL,
  `aim` int(3) DEFAULT NULL,
  `stakehold` int(3) DEFAULT NULL,
  `elicitation` int(3) DEFAULT NULL,
  `reqlist_pspd` int(3) DEFAULT NULL,
  `reqana` int(3) DEFAULT NULL,
  `ref` int(3) DEFAULT NULL,
  `protodemo` int(3) DEFAULT NULL,
  `supfeed_pspd` text DEFAULT NULL,
  `below40_pspd` text DEFAULT NULL,
  `tot_pp` int(50) DEFAULT NULL,
  `tot_pspd` int(50) DEFAULT NULL,
  `planning` int(3) DEFAULT NULL,
  `iitid` int(11) NOT NULL,
  `staffemail` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup_mark_pp_pspd`
--

INSERT INTO `sup_mark_pp_pspd` (`supmkid`, `probstate`, `revsim`, `tool`, `reqlist_pp`, `challenge`, `supfeed_pp`, `below40_pp`, `aim`, `stakehold`, `elicitation`, `reqlist_pspd`, `reqana`, `ref`, `protodemo`, `supfeed_pspd`, `below40_pspd`, `tot_pp`, `tot_pspd`, `planning`, `iitid`, `staffemail`) VALUES
(37, 21, 12, 21, 12, 12, '12dfdsfs', 'dfsf', 34, 34, 34, 34, 34, 34, 34, 'fddgds', 'sdfsf', 16, 34, 46, 7777, 'dilshard.a@iit.ac.lk'),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018613, NULL),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018614, NULL),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018615, NULL),
(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018616, NULL),
(42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2018617, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chair`
--
ALTER TABLE `chair`
  ADD PRIMARY KEY (`chid`),
  ADD KEY `iitid` (`iitid`),
  ADD KEY `staffemail` (`staffemail`);

--
-- Indexes for table `examiner_mark`
--
ALTER TABLE `examiner_mark`
  ADD PRIMARY KEY (`exmkid`),
  ADD KEY `iitid` (`iitid`),
  ADD KEY `staffemail` (`staffemail`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schid`),
  ADD KEY `iitid` (`iitid`),
  ADD KEY `staffemail` (`staffemail`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`staffid`),
  ADD UNIQUE KEY `email` (`staffemail`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`iitid`);

--
-- Indexes for table `sup_mark_pp_pspd`
--
ALTER TABLE `sup_mark_pp_pspd`
  ADD PRIMARY KEY (`supmkid`),
  ADD KEY `iitid` (`iitid`) USING BTREE,
  ADD KEY `staffemail` (`staffemail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chair`
--
ALTER TABLE `chair`
  MODIFY `chid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `examiner_mark`
--
ALTER TABLE `examiner_mark`
  MODIFY `exmkid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `Staff`
--
ALTER TABLE `Staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `sup_mark_pp_pspd`
--
ALTER TABLE `sup_mark_pp_pspd`
  MODIFY `supmkid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chair`
--
ALTER TABLE `chair`
  ADD CONSTRAINT `chair_ibfk_1` FOREIGN KEY (`iitid`) REFERENCES `Student` (`iitid`),
  ADD CONSTRAINT `chair_ibfk_2` FOREIGN KEY (`staffemail`) REFERENCES `Staff` (`staffemail`);

--
-- Constraints for table `examiner_mark`
--
ALTER TABLE `examiner_mark`
  ADD CONSTRAINT `examiner_mark_ibfk_1` FOREIGN KEY (`iitid`) REFERENCES `Student` (`iitid`),
  ADD CONSTRAINT `examiner_mark_ibfk_2` FOREIGN KEY (`staffemail`) REFERENCES `Staff` (`staffemail`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`iitid`) REFERENCES `Student` (`iitid`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`staffemail`) REFERENCES `Staff` (`staffemail`);

--
-- Constraints for table `sup_mark_pp_pspd`
--
ALTER TABLE `sup_mark_pp_pspd`
  ADD CONSTRAINT `sup_mark_pp_pspd_ibfk_1` FOREIGN KEY (`iitid`) REFERENCES `Student` (`iitid`),
  ADD CONSTRAINT `sup_mark_pp_pspd_ibfk_2` FOREIGN KEY (`staffemail`) REFERENCES `Staff` (`staffemail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
