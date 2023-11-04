-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 09:25 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forecast_sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_des` varchar(500) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_des`, `cat_id`, `comp_id`) VALUES
(2, 'Arial', 'Arial', 3, 3),
(3, 'Surf', 'Surf', 3, 2),
(4, 'Lux Soap', 'Lux Soap', 4, 2),
(5, 'Ponds Cream', 'Ponds Cream', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `cat_desctiption` varchar(200) NOT NULL,
  `cat_extra2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desctiption`, `cat_extra2`) VALUES
(3, 'Washing Powder', 'Washing Powder', 0),
(4, 'Face Wash', 'Face Wash', 0),
(5, 'Face Cream', 'Face Cream', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(100) NOT NULL,
  `ph_number` varchar(100) NOT NULL,
  `comp_address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`comp_id`, `comp_name`, `ph_number`, `comp_address`) VALUES
(2, 'unilever', '030202022', 'asdasd'),
(3, 'PNG', '06316115', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `data_type`
--

CREATE TABLE `data_type` (
  `data_id` int(11) NOT NULL,
  `data_short` varchar(100) NOT NULL,
  `data_months` varchar(100) NOT NULL,
  `extra1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_type`
--

INSERT INTO `data_type` (`data_id`, `data_short`, `data_months`, `extra1`) VALUES
(1, 'Qtr1', 'Jan-Feb-Mar', 0),
(2, 'Qtr2', 'Apr-May-June', 0),
(3, 'Qtr3', 'Jul-Aug-Sep', 0),
(4, 'Qtr4', 'Oct-Nov-Dec', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forecast_data`
--

CREATE TABLE `forecast_data` (
  `id` int(11) NOT NULL,
  `ser_num` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `sku_id` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forecast_data`
--

INSERT INTO `forecast_data` (`id`, `ser_num`, `comp_id`, `team_id`, `sku_id`, `month`, `data`) VALUES
(265, 1, 2, 13, 3, 'Jan-2022', 168959),
(266, 2, 2, 13, 3, 'Feb-2022', 156632),
(267, 3, 2, 13, 3, 'Mar-2022', 179324),
(268, 4, 2, 13, 3, 'Apr-2022', 176783),
(269, 5, 2, 13, 3, 'May-2022', 227729),
(270, 6, 2, 13, 3, 'June-2022', 149252),
(271, 7, 2, 13, 3, 'July-2022', 190401),
(272, 8, 2, 13, 3, 'Aug-2022', 199905),
(273, 9, 2, 13, 3, 'Sep-2022', 145658),
(274, 10, 2, 13, 3, 'Oct-2022', 176171),
(275, 11, 2, 13, 3, 'Nov-2022', 169219),
(276, 12, 2, 13, 3, 'Dec-2022', 171652),
(277, 13, 2, 13, 3, 'Jan-2023', 170123),
(278, 14, 2, 13, 3, 'Feb-2023', 153671),
(279, 15, 2, 13, 3, 'Mar-2023', 172466),
(280, 16, 2, 13, 3, 'Apr-2023', 162615),
(281, 17, 2, 13, 3, 'May-2023', 192676),
(282, 18, 2, 13, 3, 'June-2023', 140846),
(283, 19, 2, 13, 3, 'July-2023', 161309),
(284, 20, 2, 13, 3, 'Aug-2023', 159995),
(285, 21, 2, 13, 3, 'Sep-2023', 150111),
(286, 22, 2, 13, 3, 'Oct-2023', 166387),
(287, 23, 2, 13, 3, 'Nov-2023', 163152),
(288, 24, 2, 13, 3, 'Dec-2023', 152896),
(289, 1, 3, 17, 7, 'Jan-2023', 1),
(290, 2, 3, 17, 7, 'Feb-2023', 2),
(291, 3, 3, 17, 7, 'Mar-2023', 3),
(292, 4, 3, 17, 7, 'Apr-2023', 4),
(293, 5, 3, 17, 7, 'May-2023', 5),
(294, 6, 3, 17, 7, 'June-2023', 6),
(295, 7, 3, 17, 7, 'July-2023', 7),
(296, 8, 3, 17, 7, 'Aug-2023', 8),
(297, 9, 3, 17, 7, 'Sep-2023', 9),
(298, 10, 3, 17, 7, 'Oct-2023', 10),
(299, 11, 3, 17, 7, 'Nov-2023', 11),
(300, 12, 3, 17, 7, 'Dec-2023', 12),
(301, 13, 3, 17, 7, 'Jan-2024', 13),
(302, 14, 3, 17, 7, 'Feb-2024', 14),
(303, 15, 3, 17, 7, 'Mar-2024', 15),
(304, 16, 3, 17, 7, 'Apr-2024', 16),
(305, 17, 3, 17, 7, 'May-2024', 17),
(306, 18, 3, 17, 7, 'June-2024', 18),
(307, 19, 3, 17, 7, 'July-2024', 19),
(308, 20, 3, 17, 7, 'Aug-2024', 20),
(309, 21, 3, 17, 7, 'Sep-2024', 21),
(310, 22, 3, 17, 7, 'Oct-2024', 22),
(311, 23, 3, 17, 7, 'Nov-2024', 23),
(312, 24, 3, 17, 7, 'Dec-2024', 24),
(321, 1, 2, 15, 3, 'Jan-2022', 1),
(322, 2, 2, 15, 3, 'Feb-2022', 2),
(323, 3, 2, 15, 3, 'Mar-2022', 3),
(324, 4, 2, 15, 3, 'Apr-2022', 4),
(325, 5, 2, 15, 3, 'May-2022', 5),
(326, 6, 2, 15, 3, 'June-2022', 6),
(327, 7, 2, 15, 3, 'July-2022', 7),
(328, 8, 2, 15, 3, 'Aug-2022', 8),
(329, 9, 2, 15, 3, 'Sep-2022', 9),
(330, 10, 2, 15, 3, 'Oct-2022', 10),
(331, 11, 2, 15, 3, 'Nov-2022', 11),
(332, 12, 2, 15, 3, 'Dec-2022', 12),
(333, 13, 2, 15, 3, 'Jan-2023', 13),
(334, 14, 2, 15, 3, 'Feb-2023', 14),
(335, 15, 2, 15, 3, 'Mar-2023', 15),
(336, 16, 2, 15, 3, 'Apr-2023', 16),
(337, 17, 2, 15, 3, 'May-2023', 17),
(338, 18, 2, 15, 3, 'June-2023', 18),
(339, 19, 2, 15, 3, 'July-2023', 19),
(340, 20, 2, 15, 3, 'Aug-2023', 20),
(341, 21, 2, 15, 3, 'Sep-2023', 21),
(342, 22, 2, 15, 3, 'Oct-2023', 22),
(343, 23, 2, 15, 3, 'Nov-2023', 23),
(344, 24, 2, 15, 3, 'Dec-2023', 24),
(345, 1, 2, 21, 5, 'Jan-2023', 112),
(346, 2, 2, 21, 5, 'Feb-2023', 211),
(347, 3, 2, 21, 5, 'Mar-2023', 310),
(348, 4, 2, 21, 5, 'Apr-2023', 49),
(349, 5, 2, 21, 5, 'May-2023', 58),
(350, 6, 2, 21, 5, 'June-2023', 67),
(351, 7, 2, 21, 5, 'July-2023', 76),
(352, 8, 2, 21, 5, 'Aug-2023', 85),
(353, 9, 2, 21, 5, 'Sep-2023', 94),
(354, 10, 2, 21, 5, 'Oct-2023', 103),
(355, 11, 2, 21, 5, 'Nov-2023', 112),
(356, 12, 2, 21, 5, 'Dec-2023', 121),
(357, 13, 2, 21, 5, 'Jan-2024', 1324),
(358, 14, 2, 21, 5, 'Feb-2024', 1423),
(359, 15, 2, 21, 5, 'Mar-2024', 1522),
(360, 16, 2, 21, 5, 'Apr-2024', 1621),
(361, 17, 2, 21, 5, 'May-2024', 1720),
(362, 18, 2, 21, 5, 'June-2024', 1819),
(363, 19, 2, 21, 5, 'July-2024', 1918),
(364, 20, 2, 21, 5, 'Aug-2024', 2017),
(365, 21, 2, 21, 5, 'Sep-2024', 2116),
(366, 22, 2, 21, 5, 'Oct-2024', 2215),
(367, 23, 2, 21, 5, 'Nov-2024', 2314),
(368, 24, 2, 21, 5, 'Dec-2024', 2413);

-- --------------------------------------------------------

--
-- Table structure for table `historical_details`
--

CREATE TABLE `historical_details` (
  `details_id` int(11) NOT NULL,
  `header_id` int(11) NOT NULL,
  `serial_num` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `actual_data` int(11) NOT NULL,
  `forecast_data` int(11) NOT NULL,
  `forecast_error` int(11) NOT NULL,
  `running_sum` int(11) NOT NULL,
  `ad_data` int(11) NOT NULL,
  `map_data` float NOT NULL,
  `cae_data` int(11) NOT NULL,
  `tracking_signal` float NOT NULL,
  `holt_level` int(11) NOT NULL,
  `holt_smtnt` int(11) NOT NULL,
  `season` float NOT NULL,
  `extra1` int(11) NOT NULL,
  `extra2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historical_details`
--

INSERT INTO `historical_details` (`details_id`, `header_id`, `serial_num`, `month`, `actual_data`, `forecast_data`, `forecast_error`, `running_sum`, `ad_data`, `map_data`, `cae_data`, `tracking_signal`, `holt_level`, `holt_smtnt`, `season`, `extra1`, `extra2`) VALUES
(1264, 94, 0, 'Jan-2022', 168959, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1265, 94, 1, 'Feb-2022', 156632, 168959, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1266, 94, 2, 'Mar-2022', 179324, 156632, 22692, 22692, 22692, 0.13, 22692, 1, 0, 0, 0, 0, 0),
(1267, 94, 3, 'Apr-2022', 176783, 179324, -2541, 20151, 2541, 0.01, 25233, 1.6, 0, 0, 0, 0, 0),
(1268, 94, 4, 'May-2022', 227729, 176783, 50946, 71097, 50946, 0.22, 76179, 2.8, 0, 0, 0, 0, 0),
(1269, 94, 5, 'June-2022', 149252, 227729, -78477, -7380, 78477, 0.53, 154656, -0.19, 0, 0, 0, 0, 0),
(1270, 94, 6, 'July-2022', 190401, 149252, 41149, 33769, 41149, 0.22, 195805, 0.86, 0, 0, 0, 0, 0),
(1271, 94, 7, 'Aug-2022', 199905, 190401, 9504, 43273, 9504, 0.05, 205309, 1.26, 0, 0, 0, 0, 0),
(1272, 94, 8, 'Sep-2022', 145658, 199905, -54247, -10974, 54247, 0.37, 259556, -0.3, 0, 0, 0, 0, 0),
(1273, 94, 9, 'Oct-2022', 176171, 145658, 30513, 19539, 30513, 0.17, 290069, 0.54, 0, 0, 0, 0, 0),
(1274, 94, 10, 'Nov-2022', 169219, 176171, -6952, 12587, 6952, 0.04, 297021, 0.38, 0, 0, 0, 0, 0),
(1275, 94, 11, 'Dec-2022', 171652, 169219, 2433, 15020, 2433, 0.01, 299454, 0.5, 0, 0, 0, 0, 0),
(1276, 94, 12, 'Jan-2023', 170123, 171652, -1529, 13491, 1529, 0.01, 300983, 0.49, 0, 0, 0, 0, 0),
(1277, 94, 13, 'Feb-2023', 153671, 170123, -16452, -2961, 16452, 0.11, 317435, -0.11, 0, 0, 0, 0, 0),
(1278, 94, 14, 'Mar-2023', 172466, 153671, 18795, 15834, 18795, 0.11, 336230, 0.61, 0, 0, 0, 0, 0),
(1279, 94, 15, 'Apr-2023', 162615, 172466, -9851, 5983, 9851, 0.06, 346081, 0.24, 0, 0, 0, 0, 0),
(1280, 94, 16, 'May-2023', 192676, 162615, 30061, 36044, 30061, 0.16, 376142, 1.44, 0, 0, 0, 0, 0),
(1281, 94, 17, 'June-2023', 140846, 192676, -51830, -15786, 51830, 0.37, 427972, -0.59, 0, 0, 0, 0, 0),
(1282, 94, 18, 'July-2023', 161309, 140846, 20463, 4677, 20463, 0.13, 448435, 0.18, 0, 0, 0, 0, 0),
(1283, 94, 19, 'Aug-2023', 159995, 161309, -1314, 3363, 1314, 0.01, 449749, 0.13, 0, 0, 0, 0, 0),
(1284, 94, 20, 'Sep-2023', 150111, 159995, -9884, -6521, 9884, 0.07, 459633, -0.27, 0, 0, 0, 0, 0),
(1285, 94, 21, 'Oct-2023', 166387, 150111, 16276, 9755, 16276, 0.1, 475909, 0.41, 0, 0, 0, 0, 0),
(1286, 94, 22, 'Nov-2023', 163152, 166387, -3235, 6520, 3235, 0.02, 479144, 0.29, 0, 0, 0, 0, 0),
(1287, 94, 23, 'Dec-2023', 152896, 163152, -10256, -3736, 10256, 0.07, 489400, -0.17, 0, 0, 0, 0, 0),
(1288, 94, 24, 'Jan-2024', 0, 152896, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1289, 95, 0, 'Jan-2022', 168959, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1290, 95, 1, 'Feb-2022', 156632, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1291, 95, 2, 'Mar-2022', 179324, 162796, 16528, 16528, 16528, 0.09, 16528, 1, 0, 0, 0, 0, 0),
(1292, 95, 3, 'Apr-2022', 176783, 168305, 8478, 25006, 8478, 0.05, 25006, 2, 0, 0, 0, 0, 0),
(1293, 95, 4, 'May-2022', 227729, 170913, 56816, 81822, 56816, 0.25, 81822, 3, 0, 0, 0, 0, 0),
(1294, 95, 5, 'June-2022', 149252, 194612, -45360, 36462, 45360, 0.3, 127182, 1.15, 0, 0, 0, 0, 0),
(1295, 95, 6, 'July-2022', 190401, 184588, 5813, 42275, 5813, 0.03, 132995, 1.59, 0, 0, 0, 0, 0),
(1296, 95, 7, 'Aug-2022', 199905, 189127, 10778, 53053, 10778, 0.05, 143773, 2.21, 0, 0, 0, 0, 0),
(1297, 95, 8, 'Sep-2022', 145658, 179853, -34195, 18858, 34195, 0.23, 177968, 0.74, 0, 0, 0, 0, 0),
(1298, 95, 9, 'Oct-2022', 176171, 178655, -2484, 16374, 2484, 0.01, 180452, 0.73, 0, 0, 0, 0, 0),
(1299, 95, 10, 'Nov-2022', 169219, 173911, -4692, 11682, 4692, 0.03, 185144, 0.57, 0, 0, 0, 0, 0),
(1300, 95, 11, 'Dec-2022', 171652, 163683, 7969, 19651, 7969, 0.05, 193113, 1.02, 0, 0, 0, 0, 0),
(1301, 95, 12, 'Jan-2023', 170123, 172347, -2224, 17427, 2224, 0.01, 195337, 0.98, 0, 0, 0, 0, 0),
(1302, 95, 13, 'Feb-2023', 153671, 170331, -16660, 767, 16660, 0.11, 211997, 0.04, 0, 0, 0, 0, 0),
(1303, 95, 14, 'Mar-2023', 172466, 165149, 7317, 8084, 7317, 0.04, 219314, 0.48, 0, 0, 0, 0, 0),
(1304, 95, 15, 'Apr-2023', 162615, 165420, -2805, 5279, 2805, 0.02, 222119, 0.33, 0, 0, 0, 0, 0),
(1305, 95, 16, 'May-2023', 192676, 162917, 29759, 35038, 29759, 0.15, 251878, 2.09, 0, 0, 0, 0, 0),
(1306, 95, 17, 'June-2023', 140846, 175919, -35073, -35, 35073, 0.25, 286951, -0, 0, 0, 0, 0, 0),
(1307, 95, 18, 'July-2023', 161309, 165379, -4070, -4105, 4070, 0.03, 291021, -0.24, 0, 0, 0, 0, 0),
(1308, 95, 19, 'Aug-2023', 159995, 164944, -4949, -9054, 4949, 0.03, 295970, -0.55, 0, 0, 0, 0, 0),
(1309, 95, 20, 'Sep-2023', 150111, 154050, -3939, -12993, 3939, 0.03, 299909, -0.82, 0, 0, 0, 0, 0),
(1310, 95, 21, 'Oct-2023', 166387, 157138, 9249, -3744, 9249, 0.06, 309158, -0.24, 0, 0, 0, 0, 0),
(1311, 95, 22, 'Nov-2023', 163152, 158831, 4321, 577, 4321, 0.03, 313479, 0.04, 0, 0, 0, 0, 0),
(1312, 95, 23, 'Dec-2023', 152896, 159883, -6987, -6410, 6987, 0.05, 320466, -0.44, 0, 0, 0, 0, 0),
(1313, 95, 24, 'Jan-2024', 0, 160812, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1314, 96, 0, 'Jan-2022', 168959, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1315, 96, 1, 'Feb-2022', 156632, 168959, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1316, 96, 2, 'Mar-2022', 179324, 162154, 17170, 17170, 17170, 0.1, 17170, 1, 0, 0, 0, 0, 0),
(1317, 96, 3, 'Apr-2022', 176783, 171632, 5151, 22321, 5151, 0.03, 22321, 2, 0, 0, 0, 0, 0),
(1318, 96, 4, 'May-2022', 227729, 174475, 53254, 75575, 53254, 0.23, 75575, 3, 0, 0, 0, 0, 0),
(1319, 96, 5, 'June-2022', 149252, 203871, -54619, 20956, 54619, 0.37, 130194, 0.64, 0, 0, 0, 0, 0),
(1320, 96, 6, 'July-2022', 190401, 173721, 16680, 37636, 16680, 0.09, 146874, 1.28, 0, 0, 0, 0, 0),
(1321, 96, 7, 'Aug-2022', 199905, 182929, 16976, 54612, 16976, 0.08, 163850, 2, 0, 0, 0, 0, 0),
(1322, 96, 8, 'Sep-2022', 145658, 192300, -46642, 7970, 46642, 0.32, 210492, 0.27, 0, 0, 0, 0, 0),
(1323, 96, 9, 'Oct-2022', 176171, 166553, 9618, 17588, 9618, 0.05, 220110, 0.64, 0, 0, 0, 0, 0),
(1324, 96, 10, 'Nov-2022', 169219, 171862, -2643, 14945, 2643, 0.02, 222753, 0.6, 0, 0, 0, 0, 0),
(1325, 96, 11, 'Dec-2022', 171652, 170403, 1249, 16194, 1249, 0.01, 224002, 0.72, 0, 0, 0, 0, 0),
(1326, 96, 12, 'Jan-2023', 170123, 171093, -970, 15224, 970, 0.01, 224972, 0.74, 0, 0, 0, 0, 0),
(1327, 96, 13, 'Feb-2023', 153671, 170557, -16886, -1662, 16886, 0.11, 241858, -0.08, 0, 0, 0, 0, 0),
(1328, 96, 14, 'Mar-2023', 172466, 161236, 11230, 9568, 11230, 0.07, 253088, 0.49, 0, 0, 0, 0, 0),
(1329, 96, 15, 'Apr-2023', 162615, 167435, -4820, 4748, 4820, 0.03, 257908, 0.26, 0, 0, 0, 0, 0),
(1330, 96, 16, 'May-2023', 192676, 164774, 27902, 32650, 27902, 0.14, 285810, 1.71, 0, 0, 0, 0, 0),
(1331, 96, 17, 'June-2023', 140846, 180176, -39330, -6680, 39330, 0.28, 325140, -0.33, 0, 0, 0, 0, 0),
(1332, 96, 18, 'July-2023', 161309, 158466, 2843, -3837, 2843, 0.02, 327983, -0.2, 0, 0, 0, 0, 0),
(1333, 96, 19, 'Aug-2023', 159995, 160035, -40, -3877, 40, 0, 328023, -0.21, 0, 0, 0, 0, 0),
(1334, 96, 20, 'Sep-2023', 150111, 160013, -9902, -13779, 9902, 0.07, 337925, -0.77, 0, 0, 0, 0, 0),
(1335, 96, 21, 'Oct-2023', 166387, 154547, 11840, -1939, 11840, 0.07, 349765, -0.11, 0, 0, 0, 0, 0),
(1336, 96, 22, 'Nov-2023', 163152, 161083, 2069, 130, 2069, 0.01, 351834, 0.01, 0, 0, 0, 0, 0),
(1337, 96, 23, 'Dec-2023', 152896, 162225, -9329, -9199, 9329, 0.06, 361163, -0.56, 0, 0, 0, 0, 0),
(1338, 96, 24, 'Jan-2024', 0, 157075, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1339, 97, 0, 'Jan-2022', 168959, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1340, 97, 1, 'Feb-2022', 156632, 0, 0, 0, 0, 0, 0, 0, 156632, 12327, 0, 0, 0),
(1341, 97, 2, 'Mar-2022', 179324, 168959, 10365, 10365, 10365, 0.06, 10365, 1, 174680, 14787, 0, 0, 0),
(1342, 97, 3, 'Apr-2022', 176783, 189467, -12684, -2319, 12684, 0.07, 23049, -0.2, 182466, 11777, 0, 0, 0),
(1343, 97, 4, 'May-2022', 227729, 194243, 33486, 31167, 33486, 0.15, 56535, 1.65, 212727, 19725, 0, 0, 0),
(1344, 97, 5, 'June-2022', 149252, 232452, -83200, -52033, 83200, 0.56, 139735, -1.49, 186526, -23, 0, 0, 0),
(1345, 97, 6, 'July-2022', 190401, 186503, 3898, -48135, 3898, 0.02, 143633, -1.68, 188654, 902, 0, 0, 0),
(1346, 97, 7, 'Aug-2022', 199905, 189556, 10349, -37786, 10349, 0.05, 153982, -1.47, 195269, 3358, 0, 0, 0),
(1347, 97, 8, 'Sep-2022', 145658, 198627, -52969, -90755, 52969, 0.36, 206951, -3.07, 169388, -9215, 0, 0, 0),
(1348, 97, 9, 'Oct-2022', 176171, 160173, 15998, -74757, 15998, 0.09, 222949, -2.68, 169004, -5417, 0, 0, 0),
(1349, 97, 10, 'Nov-2022', 169219, 163587, 5632, -69125, 5632, 0.03, 228581, -2.72, 166696, -4080, 0, 0, 0),
(1350, 97, 11, 'Dec-2022', 171652, 162616, 9036, -60089, 9036, 0.05, 237617, -2.53, 167604, -1935, 0, 0, 0),
(1351, 97, 12, 'Jan-2023', 170123, 165669, 4454, -55635, 4454, 0.03, 242071, -2.53, 168127, -878, 0, 0, 0),
(1352, 97, 13, 'Feb-2023', 153671, 167249, -13578, -69213, 13578, 0.09, 255649, -3.25, 159754, -4101, 0, 0, 0),
(1353, 97, 14, 'Mar-2023', 172466, 155653, 16813, -52400, 16813, 0.1, 272462, -2.5, 164934, -110, 0, 0, 0),
(1354, 97, 15, 'Apr-2023', 162615, 164824, -2209, -54609, 2209, 0.01, 274671, -2.78, 163604, -635, 0, 0, 0),
(1355, 97, 16, 'May-2023', 192676, 162969, 29707, -24902, 29707, 0.15, 304378, -1.23, 179368, 6417, 0, 0, 0),
(1356, 97, 17, 'June-2023', 140846, 185785, -44939, -69841, 44939, 0.32, 349317, -3.2, 160978, -4250, 0, 0, 0),
(1357, 97, 18, 'July-2023', 161309, 156728, 4581, -65260, 4581, 0.03, 353898, -3.13, 159257, -3163, 0, 0, 0),
(1358, 97, 19, 'Aug-2023', 159995, 156094, 3901, -61359, 3901, 0.02, 357799, -3.09, 158247, -2237, 0, 0, 0),
(1359, 97, 20, 'Sep-2023', 150111, 156010, -5899, -67258, 5899, 0.04, 363698, -3.51, 152754, -3637, 0, 0, 0),
(1360, 97, 21, 'Oct-2023', 166387, 149117, 17270, -49988, 17270, 0.1, 380968, -2.62, 158650, 462, 0, 0, 0),
(1361, 97, 22, 'Nov-2023', 163152, 159112, 4040, -45948, 4040, 0.02, 385008, -2.51, 161342, 1421, 0, 0, 0),
(1362, 97, 23, 'Dec-2023', 152896, 162763, -9867, -55815, 9867, 0.06, 394875, -3.11, 157316, -921, 0, 0, 0),
(1363, 97, 24, 'Jan-2024', 0, 156395, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1364, 97, 25, 'Feb-2024', 0, 155474, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1365, 97, 26, 'Mar-2024', 0, 154553, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1366, 97, 27, 'Apr-2024', 0, 153632, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1367, 98, 0, 'Jan-2022', 168959, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.96014, 0, 0),
(1368, 98, 1, 'Feb-2022', 156632, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.89009, 0, 0),
(1369, 98, 2, 'Mar-2022', 179324, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.01904, 0, 0),
(1370, 98, 3, 'Apr-2022', 176783, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.0046, 0, 0),
(1371, 98, 4, 'May-2022', 227729, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.29411, 0, 0),
(1372, 98, 5, 'June-2022', 149252, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.84815, 0, 0),
(1373, 98, 6, 'July-2022', 190401, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.08199, 0, 0),
(1374, 98, 7, 'Aug-2022', 199905, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.13599, 0, 0),
(1375, 98, 8, 'Sep-2022', 145658, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.82773, 0, 0),
(1376, 98, 9, 'Oct-2022', 176171, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.00112, 0, 0),
(1377, 98, 10, 'Nov-2022', 169219, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.96162, 0, 0),
(1378, 98, 11, 'Dec-2022', 171652, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.97544, 0, 0),
(1379, 98, 12, 'Jan-2023', 170123, 0, 0, 0, 0, 0, 0, 0, 177186, 7241, 0.96675, 0, 0),
(1380, 98, 13, 'Feb-2023', 153671, 164157, -10486, -10486, 10486, 0.07, 10486, -1, 177924, 4445, 0.89009, 0, 0),
(1381, 98, 14, 'Mar-2023', 172466, 185841, -13375, -23861, 13375, 0.08, 23861, -2, 175124, 1329, 1.01904, 0, 0),
(1382, 98, 15, 'Apr-2023', 162615, 177265, -14650, -38511, 14650, 0.09, 38511, -3, 168404, -2132, 1.0046, 0, 0),
(1383, 98, 16, 'May-2023', 192676, 215174, -22498, -61009, 22498, 0.12, 61009, -4, 156675, -6259, 1.29411, 0, 0),
(1384, 98, 17, 'June-2023', 140846, 127575, 13271, -47738, 13271, 0.09, 74280, -3.21, 159053, -2545, 0.84815, 0, 0),
(1385, 98, 18, 'July-2023', 161309, 169340, -8031, -55769, 8031, 0.05, 82311, -4.07, 152411, -4307, 1.08199, 0, 0),
(1386, 98, 19, 'Aug-2023', 159995, 168245, -8250, -64019, 8250, 0.05, 90561, -4.95, 144095, -6031, 1.13599, 0, 0),
(1387, 98, 20, 'Sep-2023', 150111, 114280, 35831, -28188, 35831, 0.24, 126392, -1.78, 161960, 4244, 0.82773, 0, 0),
(1388, 98, 21, 'Oct-2023', 166387, 166390, -3, -28191, 3, 0, 126395, -2.01, 166202, 4243, 1.00112, 0, 0),
(1389, 98, 22, 'Nov-2023', 163152, 163903, -751, -28942, 751, 0, 127146, -2.28, 170014, 4058, 0.96162, 0, 0),
(1390, 98, 23, 'Dec-2023', 152896, 169797, -16901, -45843, 16901, 0.11, 144047, -3.5, 164508, -55, 0.97544, 0, 0),
(1391, 98, 24, 'Jan-2024', 0, 160414, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1392, 98, 25, 'Feb-2024', 0, 160360, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1393, 98, 26, 'Mar-2024', 0, 160307, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1394, 98, 27, 'Apr-2024', 0, 160253, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1395, 99, 0, 'Jan-2023', 112, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1396, 99, 1, 'Feb-2023', 211, 112, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1397, 99, 2, 'Mar-2023', 310, 211, 99, 99, 99, 0.32, 99, 1, 0, 0, 0, 0, 0),
(1398, 99, 3, 'Apr-2023', 49, 310, -261, -162, 261, 5.33, 360, -0.9, 0, 0, 0, 0, 0),
(1399, 99, 4, 'May-2023', 58, 49, 9, -153, 9, 0.16, 369, -1.24, 0, 0, 0, 0, 0),
(1400, 99, 5, 'June-2023', 67, 58, 9, -144, 9, 0.13, 378, -1.52, 0, 0, 0, 0, 0),
(1401, 99, 6, 'July-2023', 76, 67, 9, -135, 9, 0.12, 387, -1.74, 0, 0, 0, 0, 0),
(1402, 99, 7, 'Aug-2023', 85, 76, 9, -126, 9, 0.11, 396, -1.91, 0, 0, 0, 0, 0),
(1403, 99, 8, 'Sep-2023', 94, 85, 9, -117, 9, 0.1, 405, -2.02, 0, 0, 0, 0, 0),
(1404, 99, 9, 'Oct-2023', 103, 94, 9, -108, 9, 0.09, 414, -2.09, 0, 0, 0, 0, 0),
(1405, 99, 10, 'Nov-2023', 112, 103, 9, -99, 9, 0.08, 423, -2.11, 0, 0, 0, 0, 0),
(1406, 99, 11, 'Dec-2023', 121, 112, 9, -90, 9, 0.07, 432, -2.08, 0, 0, 0, 0, 0),
(1407, 99, 12, 'Jan-2024', 1324, 121, 1203, 1113, 1203, 0.91, 1635, 7.49, 0, 0, 0, 0, 0),
(1408, 99, 13, 'Feb-2024', 1423, 1324, 99, 1212, 99, 0.07, 1734, 8.39, 0, 0, 0, 0, 0),
(1409, 99, 14, 'Mar-2024', 1522, 1423, 99, 1311, 99, 0.07, 1833, 9.3, 0, 0, 0, 0, 0),
(1410, 99, 15, 'Apr-2024', 1621, 1522, 99, 1410, 99, 0.06, 1932, 10.22, 0, 0, 0, 0, 0),
(1411, 99, 16, 'May-2024', 1720, 1621, 99, 1509, 99, 0.06, 2031, 11.14, 0, 0, 0, 0, 0),
(1412, 99, 17, 'June-2024', 1819, 1720, 99, 1608, 99, 0.05, 2130, 12.08, 0, 0, 0, 0, 0),
(1413, 99, 18, 'July-2024', 1918, 1819, 99, 1707, 99, 0.05, 2229, 13.02, 0, 0, 0, 0, 0),
(1414, 99, 19, 'Aug-2024', 2017, 1918, 99, 1806, 99, 0.05, 2328, 13.96, 0, 0, 0, 0, 0),
(1415, 99, 20, 'Sep-2024', 2116, 2017, 99, 1905, 99, 0.05, 2427, 14.91, 0, 0, 0, 0, 0),
(1416, 99, 21, 'Oct-2024', 2215, 2116, 99, 2004, 99, 0.04, 2526, 15.87, 0, 0, 0, 0, 0),
(1417, 99, 22, 'Nov-2024', 2314, 2215, 99, 2103, 99, 0.04, 2625, 16.82, 0, 0, 0, 0, 0),
(1418, 99, 23, 'Dec-2024', 2413, 2314, 99, 2202, 99, 0.04, 2724, 17.78, 0, 0, 0, 0, 0),
(1419, 99, 24, 'Jan-2025', 0, 2413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1420, 100, 0, 'Jan-2023', 112, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1421, 100, 1, 'Feb-2023', 211, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1422, 100, 2, 'Mar-2023', 310, 162, 148, 148, 148, 0.48, 148, 1, 0, 0, 0, 0, 0),
(1423, 100, 3, 'Apr-2023', 49, 211, -162, -14, 162, 3.31, 310, -0.09, 0, 0, 0, 0, 0),
(1424, 100, 4, 'May-2023', 58, 190, -132, -146, 132, 2.28, 442, -0.99, 0, 0, 0, 0, 0),
(1425, 100, 5, 'June-2023', 67, 139, -72, -218, 72, 1.07, 514, -1.7, 0, 0, 0, 0, 0),
(1426, 100, 6, 'July-2023', 76, 58, 18, -200, 18, 0.24, 532, -1.88, 0, 0, 0, 0, 0),
(1427, 100, 7, 'Aug-2023', 85, 67, 18, -182, 18, 0.21, 550, -1.99, 0, 0, 0, 0, 0),
(1428, 100, 8, 'Sep-2023', 94, 76, 18, -164, 18, 0.19, 568, -2.02, 0, 0, 0, 0, 0),
(1429, 100, 9, 'Oct-2023', 103, 85, 18, -146, 18, 0.17, 586, -1.99, 0, 0, 0, 0, 0),
(1430, 100, 10, 'Nov-2023', 112, 94, 18, -128, 18, 0.16, 604, -1.91, 0, 0, 0, 0, 0),
(1431, 100, 11, 'Dec-2023', 121, 103, 18, -110, 18, 0.15, 622, -1.77, 0, 0, 0, 0, 0),
(1432, 100, 12, 'Jan-2024', 1324, 112, 1212, 1102, 1212, 0.92, 1834, 6.61, 0, 0, 0, 0, 0),
(1433, 100, 13, 'Feb-2024', 1423, 519, 904, 2006, 904, 0.64, 2738, 8.79, 0, 0, 0, 0, 0),
(1434, 100, 14, 'Mar-2024', 1522, 956, 566, 2572, 566, 0.37, 3304, 10.12, 0, 0, 0, 0, 0),
(1435, 100, 15, 'Apr-2024', 1621, 1423, 198, 2770, 198, 0.12, 3502, 11.07, 0, 0, 0, 0, 0),
(1436, 100, 16, 'May-2024', 1720, 1522, 198, 2968, 198, 0.12, 3700, 12.03, 0, 0, 0, 0, 0),
(1437, 100, 17, 'June-2024', 1819, 1621, 198, 3166, 198, 0.11, 3898, 13, 0, 0, 0, 0, 0),
(1438, 100, 18, 'July-2024', 1918, 1720, 198, 3364, 198, 0.1, 4096, 13.96, 0, 0, 0, 0, 0),
(1439, 100, 19, 'Aug-2024', 2017, 1819, 198, 3562, 198, 0.1, 4294, 14.93, 0, 0, 0, 0, 0),
(1440, 100, 20, 'Sep-2024', 2116, 1918, 198, 3760, 198, 0.09, 4492, 15.9, 0, 0, 0, 0, 0),
(1441, 100, 21, 'Oct-2024', 2215, 2017, 198, 3958, 198, 0.09, 4690, 16.88, 0, 0, 0, 0, 0),
(1442, 100, 22, 'Nov-2024', 2314, 2116, 198, 4156, 198, 0.09, 4888, 17.86, 0, 0, 0, 0, 0),
(1443, 100, 23, 'Dec-2024', 2413, 2215, 198, 4354, 198, 0.08, 5086, 18.83, 0, 0, 0, 0, 0),
(1444, 100, 24, 'Jan-2025', 0, 2314, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `historical_header`
--

CREATE TABLE `historical_header` (
  `hs_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sku_id` int(11) NOT NULL,
  `functions_type` int(11) NOT NULL,
  `extra1` int(11) NOT NULL,
  `extra2` int(11) NOT NULL,
  `extra3` int(11) NOT NULL,
  `extra4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historical_header`
--

INSERT INTO `historical_header` (`hs_id`, `team_id`, `session_id`, `company_id`, `sku_id`, `functions_type`, `extra1`, `extra2`, `extra3`, `extra4`) VALUES
(94, 13, 3, 2, 3, 1, 0, 0, 0, 0),
(95, 13, 3, 2, 3, 2, 0, 0, 0, 0),
(96, 13, 3, 2, 3, 6, 0, 0, 0, 0),
(97, 13, 3, 2, 3, 4, 0, 0, 0, 0),
(98, 13, 3, 2, 3, 5, 0, 0, 0, 0),
(99, 21, 3, 2, 5, 1, 0, 0, 0, 0),
(100, 21, 3, 2, 5, 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `extra1` int(11) NOT NULL,
  `extra2` int(11) NOT NULL,
  `extra3` varchar(500) NOT NULL,
  `extra4` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `name`, `user_status`, `type`, `extra1`, `extra2`, `extra3`, `extra4`) VALUES
(1, 'super_admin', 'admin', 'Super Admin', 'super_admin', 'super_admin', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `des` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `extra1` int(11) NOT NULL,
  `extra2` int(11) NOT NULL,
  `extra3` int(11) NOT NULL,
  `extra4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `des`, `status`, `date`, `extra1`, `extra2`, `extra3`, `extra4`) VALUES
(3, 'MBA-IQR-DAY-14', 'Active', '2023-07-20', 0, 0, 0, 0),
(4, 'AAA-FFF-QQQ-12', 'Inactive', '2023-08-09', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sku_unit`
--

CREATE TABLE `sku_unit` (
  `sku_id` int(11) NOT NULL,
  `sku_des` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sku_unit`
--

INSERT INTO `sku_unit` (`sku_id`, `sku_des`, `category_id`, `company_id`, `brand_id`) VALUES
(2, 'Surf 100kg', 3, 2, 3),
(3, 'surf 200kg', 3, 2, 3),
(4, 'surf 1Kg', 3, 2, 3),
(5, 'Lux 70g', 4, 2, 4),
(6, 'Ponds Cream 100gm', 5, 2, 5),
(7, 'Arial 100gm', 3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `team_input`
--

CREATE TABLE `team_input` (
  `input_id` int(11) NOT NULL,
  `input_sku` int(11) NOT NULL,
  `input_alpha` float NOT NULL,
  `input_beta` float NOT NULL,
  `input_gama` float NOT NULL,
  `lead_time` int(11) NOT NULL,
  `month_ostock` int(11) NOT NULL,
  `pend_arr` int(11) NOT NULL,
  `pend_arr_date` date NOT NULL,
  `input_moq` int(11) NOT NULL,
  `data_type` varchar(100) NOT NULL,
  `team_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_input`
--

INSERT INTO `team_input` (`input_id`, `input_sku`, `input_alpha`, `input_beta`, `input_gama`, `lead_time`, `month_ostock`, `pend_arr`, `pend_arr_date`, `input_moq`, `data_type`, `team_id`, `session_id`) VALUES
(18, 3, 0.552, 0.43, 0, 5, 30000, 20000, '2023-08-05', 10000, 'Monthly', 13, 3),
(19, 7, 0.2, 0.43, 0, 5, 30000, 20000, '2023-08-08', 10000, 'Monthly', 17, 3),
(20, 3, 0.2, 0.43, 0, 5, 30000, 20000, '2023-08-09', 10000, 'Monthly', 15, 3),
(21, 5, 0.2, 0.5, 0.74, 12, 12332, 222, '2023-09-13', 1234, 'Monthly', 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `team_master`
--

CREATE TABLE `team_master` (
  `team_id` int(11) NOT NULL,
  `team_user` varchar(100) NOT NULL,
  `team_pass` varchar(100) NOT NULL,
  `team_comp` int(11) NOT NULL,
  `team_datatype` varchar(100) NOT NULL,
  `tm_datafrom` varchar(100) NOT NULL,
  `tm_from_num` int(11) NOT NULL,
  `tm_datato` varchar(100) NOT NULL,
  `tm_to_num` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `extra1` int(11) NOT NULL,
  `extra2` int(11) NOT NULL,
  `extra3` int(11) NOT NULL,
  `extra4` int(11) NOT NULL,
  `extra5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_master`
--

INSERT INTO `team_master` (`team_id`, `team_user`, `team_pass`, `team_comp`, `team_datatype`, `tm_datafrom`, `tm_from_num`, `tm_datato`, `tm_to_num`, `session_id`, `extra1`, `extra2`, `extra3`, `extra4`, `extra5`) VALUES
(13, 'team1', '1234', 3, 'Monthly', '', 2022, '', 2023, 3, 0, 0, 0, 0, 0),
(14, 'team2', '1234', 5, 'Monthly', '', 2022, '', 2023, 3, 0, 0, 0, 0, 0),
(15, 'team3', '1234', 3, 'Monthly', '', 2022, '', 2023, 3, 0, 0, 0, 0, 0),
(17, 'team4', '1234', 7, 'Monthly', '', 2023, '', 2024, 3, 0, 0, 0, 0, 0),
(18, 'team5', '1234', 5, 'Quarterly', 'Qtr1', 2021, 'Qtr4', 2022, 3, 0, 0, 0, 0, 0),
(21, 'team6', '1234', 5, 'Monthly', 'Qtr1', 2023, 'Qtr2', 2024, 3, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `data_type`
--
ALTER TABLE `data_type`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `forecast_data`
--
ALTER TABLE `forecast_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `com_FK` (`comp_id`),
  ADD KEY `sku_FJ` (`sku_id`);

--
-- Indexes for table `historical_details`
--
ALTER TABLE `historical_details`
  ADD PRIMARY KEY (`details_id`),
  ADD KEY `hs_FK` (`header_id`);

--
-- Indexes for table `historical_header`
--
ALTER TABLE `historical_header`
  ADD PRIMARY KEY (`hs_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sku_unit`
--
ALTER TABLE `sku_unit`
  ADD PRIMARY KEY (`sku_id`),
  ADD KEY `cat_FK` (`category_id`),
  ADD KEY `brand_FK` (`brand_id`),
  ADD KEY `comp_FK` (`company_id`);

--
-- Indexes for table `team_input`
--
ALTER TABLE `team_input`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `team_FK` (`team_id`),
  ADD KEY `sku_FF` (`input_sku`);

--
-- Indexes for table `team_master`
--
ALTER TABLE `team_master`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `sku_FK` (`team_comp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_type`
--
ALTER TABLE `data_type`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forecast_data`
--
ALTER TABLE `forecast_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT for table `historical_details`
--
ALTER TABLE `historical_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1445;

--
-- AUTO_INCREMENT for table `historical_header`
--
ALTER TABLE `historical_header`
  MODIFY `hs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sku_unit`
--
ALTER TABLE `sku_unit`
  MODIFY `sku_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `team_input`
--
ALTER TABLE `team_input`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `team_master`
--
ALTER TABLE `team_master`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forecast_data`
--
ALTER TABLE `forecast_data`
  ADD CONSTRAINT `com_FK` FOREIGN KEY (`comp_id`) REFERENCES `company` (`comp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sku_FJ` FOREIGN KEY (`sku_id`) REFERENCES `sku_unit` (`sku_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historical_details`
--
ALTER TABLE `historical_details`
  ADD CONSTRAINT `hs_FK` FOREIGN KEY (`header_id`) REFERENCES `historical_header` (`hs_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sku_unit`
--
ALTER TABLE `sku_unit`
  ADD CONSTRAINT `brand_FK` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comp_FK` FOREIGN KEY (`company_id`) REFERENCES `company` (`comp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_input`
--
ALTER TABLE `team_input`
  ADD CONSTRAINT `sku_FF` FOREIGN KEY (`input_sku`) REFERENCES `sku_unit` (`sku_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_FK` FOREIGN KEY (`team_id`) REFERENCES `team_master` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_master`
--
ALTER TABLE `team_master`
  ADD CONSTRAINT `sku_FK` FOREIGN KEY (`team_comp`) REFERENCES `sku_unit` (`sku_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
