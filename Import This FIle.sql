-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2017 at 07:45 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ts`
--

-- --------------------------------------------------------

--
-- Table structure for table `call_codes`
--

CREATE TABLE `call_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `center_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `callCode` int(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `taken` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_codes`
--

INSERT IGNORE INTO `call_codes` (`id`, `center_id`, `callCode`, `created_at`, `updated_at`, `deleted_at`, `taken`) VALUES
(1, '1', 1, '2017-08-08 03:19:00', '2017-08-13 09:14:02', NULL, '1'),
(2, '1', 2, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(3, '1', 3, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(4, '1', 4, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(5, '1', 5, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(6, '1', 6, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(7, '1', 7, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(8, '1', 8, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(9, '1', 9, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(10, '1', 10, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(11, '1', 11, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(12, '1', 12, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(13, '1', 13, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(14, '1', 14, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(15, '1', 15, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(16, '1', 16, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(17, '1', 17, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(18, '1', 18, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(19, '1', 19, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(20, '1', 20, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(21, '1', 21, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(22, '1', 22, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(23, '1', 23, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(24, '1', 24, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(25, '1', 25, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(26, '1', 26, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(27, '1', 27, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(28, '1', 28, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(29, '1', 29, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(30, '1', 30, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(31, '1', 31, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(32, '1', 32, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(33, '1', 33, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(34, '1', 34, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(35, '1', 35, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(36, '1', 36, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(37, '1', 37, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(38, '1', 38, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(39, '1', 39, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(40, '1', 40, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(41, '1', 41, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(42, '1', 42, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(43, '1', 43, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(44, '1', 44, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(45, '1', 45, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(46, '1', 46, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(47, '1', 47, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(48, '1', 48, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(49, '1', 49, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(50, '1', 50, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(51, '1', 51, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(52, '1', 52, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(53, '1', 53, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(54, '1', 54, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(55, '1', 55, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(56, '1', 56, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(57, '1', 57, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(58, '1', 58, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(59, '1', 59, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(60, '1', 60, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(61, '1', 61, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(62, '1', 62, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(63, '1', 63, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(64, '1', 64, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(65, '1', 65, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(66, '1', 66, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(67, '1', 67, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(68, '1', 68, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(69, '1', 69, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(70, '1', 70, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(71, '1', 71, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(72, '1', 72, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(73, '1', 73, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(74, '1', 74, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(75, '1', 75, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(76, '1', 76, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(77, '1', 77, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(78, '1', 78, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(79, '1', 79, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(80, '1', 80, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(81, '1', 81, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(82, '1', 82, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(83, '1', 83, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(84, '1', 84, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(85, '1', 85, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(86, '1', 86, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(87, '1', 87, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(88, '1', 88, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(89, '1', 89, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(90, '1', 90, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(91, '1', 91, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(92, '1', 92, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(93, '1', 93, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(94, '1', 95, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(95, '1', 94, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(96, '1', 96, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(97, '1', 97, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(98, '1', 98, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(99, '1', 99, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(100, '1', 100, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(101, '1', 101, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(102, '1', 102, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(103, '1', 103, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(104, '1', 104, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(105, '1', 105, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(106, '1', 106, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(107, '1', 107, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(108, '1', 108, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(109, '1', 109, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(110, '1', 110, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(111, '1', 111, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(112, '1', 112, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(113, '1', 113, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(114, '1', 114, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(115, '1', 115, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(116, '1', 116, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(117, '1', 117, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(118, '1', 118, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(119, '1', 119, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(120, '1', 120, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(121, '1', 121, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(122, '1', 122, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(123, '1', 123, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(124, '1', 124, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(125, '1', 125, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(126, '1', 126, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(127, '1', 127, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(128, '1', 128, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(129, '1', 129, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(130, '1', 130, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(131, '1', 131, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(132, '2', 1, '2017-08-08 03:19:00', '2017-08-13 09:14:20', NULL, '1'),
(133, '2', 2, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(134, '2', 3, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(135, '2', 4, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(136, '2', 5, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(137, '2', 6, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(138, '2', 7, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(139, '2', 8, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(140, '2', 9, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(141, '2', 10, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(142, '2', 11, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(143, '2', 12, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(144, '2', 13, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(145, '2', 14, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(146, '2', 15, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(147, '2', 16, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(148, '2', 17, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(149, '2', 18, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(150, '2', 19, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(151, '2', 20, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(152, '2', 21, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(153, '2', 22, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(154, '2', 23, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(155, '2', 24, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(156, '2', 25, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(157, '2', 26, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(158, '2', 27, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(159, '2', 28, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(160, '2', 29, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(161, '2', 30, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(162, '2', 31, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(163, '2', 32, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(164, '2', 33, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(165, '2', 34, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(166, '2', 35, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(167, '2', 36, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(168, '2', 37, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(169, '2', 38, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(170, '2', 39, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(171, '2', 40, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(172, '2', 41, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(173, '2', 42, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(174, '2', 43, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(175, '2', 44, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(176, '2', 45, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(177, '2', 46, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(178, '2', 47, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(179, '2', 48, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(180, '2', 49, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(181, '2', 50, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(182, '2', 51, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(183, '2', 52, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(184, '2', 53, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(185, '2', 54, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(186, '2', 55, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(187, '2', 56, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(188, '2', 57, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(189, '2', 58, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(190, '2', 59, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(191, '2', 60, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(192, '2', 61, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(193, '2', 62, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(194, '2', 63, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(195, '2', 64, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(196, '2', 65, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(197, '2', 66, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(198, '2', 67, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(199, '2', 68, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(200, '2', 69, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(201, '2', 70, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(202, '2', 71, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(203, '2', 72, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(204, '2', 73, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(205, '2', 74, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(206, '2', 75, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(207, '2', 76, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(208, '2', 77, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(209, '2', 78, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(210, '2', 79, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(211, '2', 80, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(212, '2', 81, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(213, '2', 82, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(214, '2', 83, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(215, '2', 84, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(216, '2', 85, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(217, '2', 86, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(218, '2', 87, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(219, '2', 88, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(220, '2', 89, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(221, '2', 90, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(222, '2', 91, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(223, '2', 92, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(224, '2', 93, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(225, '2', 94, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(226, '2', 95, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(227, '2', 96, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(228, '2', 97, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(229, '2', 98, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(230, '2', 99, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(231, '2', 100, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(232, '2', 101, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(233, '2', 102, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(234, '2', 103, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(235, '2', 104, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(236, '2', 105, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(237, '2', 106, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(238, '2', 107, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(239, '2', 108, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(240, '2', 109, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(241, '2', 110, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(242, '2', 111, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(243, '2', 112, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(244, '2', 113, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(245, '2', 114, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(246, '2', 115, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(247, '2', 116, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(248, '2', 117, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(249, '2', 118, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(250, '2', 119, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(251, '2', 1120, '2017-08-08 03:19:00', '2017-08-08 03:20:40', '2017-08-08 03:20:40', '0'),
(252, '2', 120, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(253, '2', 121, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(254, '2', 122, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(255, '2', 123, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(256, '2', 124, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(257, '2', 125, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(258, '2', 126, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(259, '2', 127, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(260, '2', 128, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(261, '2', 129, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(262, '2', 130, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(263, '2', 131, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(264, '2', 132, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(265, '2', 133, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(266, '2', 134, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(268, '2', 131, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(269, '1', 131, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(270, '1', 134, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(271, '1', 140, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(272, '1', 135, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(273, '1', 136, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(274, '1', 132, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(275, '1', 133, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(276, '1', 137, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(277, '1', 138, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(278, '1', 139, '2017-08-08 03:19:00', '2017-08-08 03:19:00', NULL, '0'),
(279, '1', 141, '2017-08-08 03:21:15', '2017-08-08 03:21:15', NULL, '0'),
(280, '1', 142, '2017-08-08 03:21:21', '2017-08-08 03:21:21', NULL, '0'),
(281, '1', 143, '2017-08-08 03:21:27', '2017-08-08 03:21:27', NULL, '0'),
(282, '1', 144, '2017-08-08 03:21:36', '2017-08-08 03:21:36', NULL, '0'),
(283, '1', 145, '2017-08-08 03:21:47', '2017-08-08 03:21:47', NULL, '0'),
(284, '1', 146, '2017-08-08 03:21:54', '2017-08-08 03:21:54', NULL, '0'),
(285, '1', 147, '2017-08-08 03:21:58', '2017-08-08 03:21:58', NULL, '0'),
(286, '1', 148, '2017-08-08 03:22:09', '2017-08-08 03:22:09', NULL, '0'),
(287, '1', 149, '2017-08-08 03:22:15', '2017-08-08 03:22:15', NULL, '0'),
(288, '1', 150, '2017-08-08 03:22:21', '2017-08-08 03:22:21', NULL, '0'),
(289, '2', 135, '2017-08-08 03:23:05', '2017-08-08 03:23:05', NULL, '0'),
(290, '2', 136, '2017-08-08 03:23:12', '2017-08-08 03:23:12', NULL, '0'),
(291, '2', 137, '2017-08-08 03:23:20', '2017-08-08 03:23:20', NULL, '0'),
(292, '2', 138, '2017-08-08 03:23:29', '2017-08-08 03:23:29', NULL, '0'),
(293, '2', 139, '2017-08-08 03:23:37', '2017-08-08 03:23:37', NULL, '0'),
(294, '2', 140, '2017-08-08 03:23:45', '2017-08-08 03:23:45', NULL, '0'),
(295, '2', 141, '2017-08-08 03:24:16', '2017-08-08 03:24:16', NULL, '0'),
(296, '2', 142, '2017-08-08 03:24:41', '2017-08-08 03:24:41', NULL, '0'),
(297, '1', 143, '2017-08-08 03:24:57', '2017-08-08 03:25:04', '2017-08-08 03:25:04', '0'),
(298, '2', 143, '2017-08-08 03:25:13', '2017-08-08 03:25:13', NULL, '0'),
(299, '2', 144, '2017-08-08 03:25:19', '2017-08-08 03:25:19', NULL, '0'),
(300, '2', 145, '2017-08-08 03:25:26', '2017-08-08 03:25:26', NULL, '0'),
(301, '2', 146, '2017-08-08 03:25:39', '2017-08-08 03:25:39', NULL, '0'),
(302, '2', 147, '2017-08-08 03:25:47', '2017-08-08 03:25:47', NULL, '0'),
(303, '2', 148, '2017-08-08 03:25:55', '2017-08-08 03:25:55', NULL, '0'),
(304, '2', 149, '2017-08-08 03:26:03', '2017-08-08 03:26:03', NULL, '0'),
(305, '2', 150, '2017-08-08 03:26:10', '2017-08-08 03:26:10', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GSTTin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RegNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `island` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ownername` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owneremail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ownermobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT IGNORE INTO `companies` (`id`, `name`, `GSTTin`, `RegNo`, `address`, `island`, `city`, `telephone`, `fax`, `mobile`, `email`, `website`, `ownername`, `owneremail`, `ownermobile`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'City Cab', NULL, 'BN-1098/2013', 'H.Kulhlhavahmaage', 'Male', 'Male', '+9607774713', '+9603332244', '+9607774713', 'citycab13@gmail.com', NULL, 'Hassan Rameez', NULL, '+9607774713', NULL, '2017-08-05 16:08:21', '2017-08-07 10:55:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `taxi_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverIdNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverTempAdd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverPermAdd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverMobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverEmail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverLicenceNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverLicenceExp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverPermitNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverPermitExp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photoUrl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT IGNORE INTO `drivers` (`id`, `taxi_id`, `driverName`, `driverIdNo`, `driverTempAdd`, `driverPermAdd`, `driverMobile`, `driverEmail`, `driverLicenceNo`, `driverLicenceExp`, `driverPermitNo`, `driverPermitExp`, `photoUrl`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'driverName', 'driverName', 'driverName', 'driverName', 'driverName', 'driverName', 'driverName', '2017/08/13', 'driverName', '2017/08/13', 'driverPhotos/Y9SK4pUQlYREu33uSkGowyTcGZ9CIXT4jEfwEPQb.png', '2017-08-13 09:20:18', '2017-08-13 09:20:18', NULL),
(2, '2', 'driverName', 'driverName', 'driverName', 'driverName', 'driverName', 'driverName', 'driverName', '2017/08/13', 'driverName', '2017/08/13', NULL, '2017-08-13 09:22:14', '2017-08-13 09:22:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2017_07_02_194652_create_companies_table', 2),
(6, '2017_08_05_091711_TaxiCenter', 3),
(7, '2017_08_06_153346_create_call_codes_table', 4),
(8, '2017_08_07_080835_create_taxis_table', 5),
(9, '2017_08_07_162156_create_drivers_table', 6),
(10, '2017_08_11_050758_create_payment_histories_table', 7),
(11, '2017_08_11_051336_create_payment_months_table', 7),
(12, '2017_08_13_135249_add_center_name_to_taxis', 8),
(13, '2017_08_13_140137_add_taken_to_callcode', 9),
(14, '2017_08_13_140144_add_taken_to_taxi', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `taxi_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `gstAmount` int(11) DEFAULT NULL,
  `totalAmount` int(11) DEFAULT NULL,
  `slipNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `paymentStatus` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_months`
--

CREATE TABLE `payment_months` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxis`
--

CREATE TABLE `taxis` (
  `id` int(10) UNSIGNED NOT NULL,
  `callcode_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiChasisNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiEngineNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiBrand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiModel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiColor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiOwnerName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiOwnerMobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiOwnerEmail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxiOwnerAddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registeredDate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anualFeeExpiry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roadWorthinessExpiry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insuranceExpiry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `center_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taken` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxis`
--

INSERT IGNORE INTO `taxis` (`id`, `callcode_id`, `taxiNo`, `taxiChasisNo`, `taxiEngineNo`, `taxiBrand`, `taxiModel`, `taxiColor`, `taxiOwnerName`, `taxiOwnerMobile`, `taxiOwnerEmail`, `taxiOwnerAddress`, `registeredDate`, `anualFeeExpiry`, `roadWorthinessExpiry`, `insuranceExpiry`, `rate`, `state`, `created_at`, `updated_at`, `deleted_at`, `center_name`, `taken`) VALUES
(1, '1', 'A02017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017/10/13', '2017/10/13', '2017/10/13', '2017/10/13', '600', NULL, '2017-08-13 09:14:02', '2017-08-13 09:20:18', NULL, 'CBMM', '1'),
(2, '132', 'A02016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017/10/13', '2017/10/13', '2017/10/13', '2017/10/13', '600', '1', '2017-08-13 09:14:20', '2017-08-13 09:23:23', NULL, 'JRMM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `taxi_centers`
--

CREATE TABLE `taxi_centers` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxi_centers`
--

INSERT IGNORE INTO `taxi_centers` (`id`, `company_id`, `name`, `cCode`, `address`, `telephone`, `mobile`, `email`, `fax`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'City Cab', 'CBMM', 'H.KULHLHAVAHMAAGE,  MOONLIGHTHIGUN', '3335656', '3328939', 'taviyanigroup@gmail.com', '3011919', '1', NULL, '2017-08-07 10:55:06', NULL),
(2, '1', 'JR Taxi', 'JRMM', 'MA.GAAFOLHU', '3330618', '3328939', 'taviyanigroup@gmail.com', '3011919', NULL, '2017-08-06 21:33:33', '2017-08-06 21:33:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'athik', 'athik.13@gmail.com', '$2y$10$WKYeO4pE7gCQ1TxbV.G5luM1X.Z6Lw8g9O5jJG6aeW7qnJVUNbYoW', 'p0MtRwFBWFbL1jA68qDCtwjNp2Iv9M6wsNTNwfuWJBRjc2Jad9uJciZQbq6i', '2017-08-05 15:45:35', '2017-08-05 15:45:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `call_codes`
--
ALTER TABLE `call_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_months`
--
ALTER TABLE `payment_months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxis`
--
ALTER TABLE `taxis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxi_centers`
--
ALTER TABLE `taxi_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `call_codes`
--
ALTER TABLE `call_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_months`
--
ALTER TABLE `payment_months`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `taxis`
--
ALTER TABLE `taxis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `taxi_centers`
--
ALTER TABLE `taxi_centers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
