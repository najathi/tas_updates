-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 10:52 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tas_updates`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_ac_code` int(6) UNSIGNED ZEROFILL NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_tele_no` varchar(255) DEFAULT NULL,
  `c_email` varchar(255) DEFAULT NULL,
  `c_address_one` varchar(255) DEFAULT NULL,
  `c_address_two` varchar(255) DEFAULT NULL,
  `c_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_ac_code`, `c_name`, `c_tele_no`, `c_email`, `c_address_one`, `c_address_two`, `c_datetime`, `c_updated_at`) VALUES
(000001, 'Direct Customer', '', '', '', NULL, '2019-07-30 07:39:45', '2019-09-03 05:38:51'),
(000002, 'MHM. Najathi', '0754141331', 'najathi@live.com', '45,   Main Street,kky-6. ', '30110', '2019-07-30 07:41:34', '2019-09-03 05:38:51'),
(000003, 'MHM. Naharni', '0756007036', 'naharni@gmail.com', 'No. 7/1, ABH. Lane, ', 'Kattankudy -06. 30100.', '2019-07-31 10:16:39', '2019-09-03 05:38:51'),
(000004, 'MHF. Nazaaha', '0754896563', 'cccccccccc@hb.gh', 'saithamaruthuu', '', '2019-08-03 12:26:27', '2019-09-03 05:38:51'),
(000005, 'Badree', '0778899663', 'badree@gmail.com', 'kattankudy', '', '2019-08-04 11:33:05', '2019-09-03 05:38:51'),
(000006, 'tututututu', 'tutu', 'tutu', 'dfdxfggggfg', NULL, '2019-08-04 11:33:10', '2019-09-03 05:38:51'),
(000007, 'tututututuut', 'utut', 'tutut', 'ututut', NULL, '2019-08-04 11:33:15', '2019-09-03 05:38:51'),
(000008, 'tututututut', 'tututu', 'tututu', 'tututut', '', '2019-08-04 11:33:22', '2019-09-03 05:38:51'),
(000009, 'tututu', 'tutuututt', 'ututut', 'ututu', '', '2019-08-04 11:33:28', '2019-09-03 05:38:51'),
(000010, 'ututut', 'ututu', 'tutu', 'tututut', '', '2019-08-04 11:33:34', '2019-09-03 05:38:51'),
(000011, 'Najathi', '074141331', 'najathi@live.com', '#7/1, ABH. Lane,', 'Kattankudy -06. 30110.', '2019-08-04 11:33:41', '2019-09-03 05:38:51'),
(000012, 'Nahaarni', '0756007036', 'vdvdvd@dgdg.hfhf', 'fhfhfhf', 'hfhfhf', '2019-08-04 11:34:28', '2019-09-03 05:38:51'),
(000013, 'dbff', '45454545', 'gdgdg', 'dgdgd', 'eege', '2019-08-13 16:08:53', '2019-09-03 05:38:51'),
(000014, 'dvdvd', 'vdvd', 'hf@edgdg.hgh', 'tttttt', 'kjhghscfgf', '2019-08-18 18:17:46', '2019-11-10 09:47:49'),
(000015, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000016, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000017, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000019, 'fhfh', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:47:24'),
(000020, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000022, 'grgrg', 'rgrgr', 'grgrgrg@HG.KK', 'rgrgrg', 'rgr', '2019-09-01 07:21:23', '2019-09-03 05:38:51'),
(000023, '686868', '88686868', '6868@rhr.jyjy', '68', '6868', '2019-11-10 09:45:08', '2019-11-10 09:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_order`
--

CREATE TABLE `exchange_order` (
  `ex_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `xo_date` date NOT NULL,
  `customer` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `counter_staff` int(11) NOT NULL,
  `supplier` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `ex_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ex_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange_order`
--

INSERT INTO `exchange_order` (`ex_id`, `xo_date`, `customer`, `counter_staff`, `supplier`, `ex_created_at`, `ex_updated_at`) VALUES
(000002, '2019-10-08', 000001, 22, 000003, '2019-10-15 14:56:14', '2019-11-06 14:37:09'),
(000008, '2019-11-08', 000001, 22, 000005, '2019-11-08 11:38:58', '2019-11-08 11:38:58'),
(000009, '2019-11-08', 000007, 22, 000006, '2019-11-08 11:39:55', '2019-11-08 11:39:55'),
(000010, '2019-11-08', 000001, 22, 000004, '2019-11-08 13:04:17', '2019-11-08 13:04:17'),
(000015, '2019-11-09', 000005, 22, 000006, '2019-11-09 13:23:21', '2019-11-09 13:23:21'),
(000016, '2019-11-09', 000001, 22, 000006, '2019-11-09 13:23:54', '2019-11-09 13:23:54'),
(000017, '2019-11-20', 000001, 22, 000004, '2019-11-09 13:25:08', '2019-11-09 13:25:08'),
(000018, '2019-11-10', 000001, 22, 000006, '2019-11-10 17:14:22', '2019-11-10 17:14:22'),
(000019, '2019-11-10', 000001, 22, 000007, '2019-11-10 17:16:33', '2019-11-10 17:16:33'),
(000020, '2019-11-10', 000001, 22, 000006, '2019-11-10 17:17:45', '2019-11-10 17:17:45'),
(000021, '2019-11-10', 000001, 22, 000008, '2019-11-10 17:19:12', '2019-11-10 17:19:12'),
(000024, '2019-11-13', 000001, 22, 000010, '2019-11-13 09:31:00', '2019-11-13 09:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ex_order` int(6) UNSIGNED ZEROFILL NOT NULL,
  `is_invoice` int(1) NOT NULL DEFAULT 0,
  `in_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `in_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `ex_order`, `is_invoice`, `in_created_at`, `in_updated_at`) VALUES
(000005, 000015, 1, '2019-11-09 13:23:21', '2019-11-09 13:23:21'),
(000006, 000016, 1, '2019-11-09 13:23:55', '2019-11-09 13:23:55'),
(000008, 000018, 1, '2019-11-10 17:14:23', '2019-11-10 17:14:23'),
(000009, 000019, 0, '2019-11-10 17:16:33', '2019-11-10 17:16:33'),
(000010, 000020, 0, '2019-11-10 17:17:45', '2019-11-10 17:17:45'),
(000011, 000021, 0, '2019-11-10 17:19:12', '2019-11-10 17:19:12'),
(000015, 000024, 0, '2019-11-13 09:31:01', '2019-11-13 09:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `exch_order` int(6) UNSIGNED ZEROFILL NOT NULL,
  `booking_ref` varchar(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `ticket_no` varchar(255) NOT NULL,
  `ticket_date` date NOT NULL,
  `basicc` decimal(15,2) NOT NULL,
  `yq` decimal(15,2) NOT NULL,
  `yr` decimal(15,2) NOT NULL,
  `tax_3` decimal(15,2) NOT NULL,
  `tax_4` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL,
  `supp_charge` decimal(15,2) NOT NULL,
  `service_amt` decimal(15,2) NOT NULL,
  `net_profit` decimal(15,2) NOT NULL,
  `net_due` decimal(15,2) NOT NULL,
  `net_to_supplier` decimal(15,2) NOT NULL,
  `from_to` varchar(255) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `airline_code` varchar(255) NOT NULL,
  `flight_no` varchar(255) NOT NULL,
  `depart_date` date NOT NULL,
  `pass_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pass_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_id`, `exch_order`, `booking_ref`, `p_name`, `ticket_no`, `ticket_date`, `basicc`, `yq`, `yr`, `tax_3`, `tax_4`, `total_tax`, `supp_charge`, `service_amt`, `net_profit`, `net_due`, `net_to_supplier`, `from_to`, `class_code`, `airline_code`, `flight_no`, `depart_date`, `pass_created_at`, `pass_updated_at`) VALUES
(000012, 000008, '757575757', '767868686868', '6868', '2019-08-07', '757.00', '575.00', '75.00', '7575.00', '757.00', '8982.00', '575.00', '75757.00', '75757.00', '86071.00', '10314.00', '575', '7575', '7575', '75', '2019-11-18', '2019-11-08 11:38:58', '2019-11-08 11:38:58'),
(000013, 000009, '757575', '424247', '757', '2019-11-19', '757.00', '575757.00', '575.00', '757.00', '757.00', '59664.00', '57.00', '57.01', '57.01', '60535.01', '60478.00', '57', '5757', '5775', '575', '2019-11-19', '2019-11-08 11:39:55', '2019-11-08 11:39:55'),
(000014, 000009, '868686', '6986868', '686', '2019-11-19', '68686.00', '868.00', '6868.00', '686.00', '868.00', '9290.00', '86.00', '868.00', '868.00', '78930.00', '78062.00', '686', '8688', '86', '8686', '2019-11-26', '2019-11-08 11:39:55', '2019-11-08 11:39:55'),
(000015, 000010, '686868', '868688', '688', '2019-10-29', '686.00', '868.00', '86.00', '686.00', '868.00', '2508.00', '686.00', '86868.00', '86868.00', '90748.00', '3880.00', '68', '86886868', '686', '686', '2019-11-12', '2019-11-08 13:04:17', '2019-11-08 13:04:17'),
(000016, 000010, '7577', '76786769', '575', '2019-11-19', '755.00', '95757.00', '757.00', '757.00', '757575.00', '854846.00', '5757.00', '757.00', '757.00', '862115.00', '861358.00', '5757', '575757', '75575', '57', '2019-11-12', '2019-11-08 13:04:17', '2019-11-08 13:04:17'),
(000028, 000015, '86', '86388888868', '68686', '2019-11-13', '868.00', '686.00', '68.00', '686.00', '868.00', '2308.00', '6.00', '86.00', '86.00', '3268.00', '3182.00', '686', '8686', '868', '8686', '2019-08-14', '2019-11-09 13:23:21', '2019-11-09 13:23:21'),
(000029, 000016, '868', '868', '868686', '2019-11-13', '68.00', '686.00', '868.00', '868.00', '6868.00', '9290.00', '688888888886.00', '68.00', '68.00', '688888898312.00', '688888898244.00', '8686', '8686', '8686', '868', '2019-11-06', '2019-11-09 13:23:54', '2019-11-09 13:23:54'),
(000030, 000017, '767', '\\4\\4', '\\4\\4\\', '2019-11-13', '7676.00', '44.00', '4.00', '444.00', '447767676.00', '447768168.00', '4.00', '44.00', '44.00', '447775892.00', '447775848.00', '\\44', '\\4\\\\4\\', '767', '67', '2019-11-12', '2019-11-09 13:25:08', '2019-11-09 13:25:08'),
(000031, 000017, '575', '767', '767', '2019-10-29', '67.00', '676.00', '6767.00', '767.00', '676.00', '8216.00', '6767.00', '767.00', '767.00', '15817.00', '15050.00', '767', '6767', '767', '7676', '2019-11-05', '2019-11-09 13:25:08', '2019-11-09 13:25:08'),
(000032, 000018, '76767', '76767', '6767', '2019-11-13', '676.00', '767.00', '6767.00', '67.00', '676.00', '8277.00', '767.00', '6767.00', '6767.00', '16487.00', '9720.00', '676', '767', '676', '767', '0007-07-06', '2019-11-10 17:14:23', '2019-11-10 17:14:23'),
(000033, 000018, '7676', '678676', '6767676', '2019-11-21', '767.00', '6767.00', '767.00', '676.00', '676.00', '8886.00', '767.00', '6767.00', '6767.00', '17187.00', '10420.00', '6767', '676', '767', '6767', '2019-11-21', '2019-11-10 17:14:23', '2019-11-10 17:14:23'),
(000034, 000019, '76767', '76767', '67', '2019-11-14', '67.00', '676.00', '6767.00', '67.00', '676.00', '8186.00', '767.00', '6767.00', '6767.00', '15787.00', '9020.00', '767', '6767', '676', '767', '2019-11-14', '2019-11-10 17:16:33', '2019-11-10 17:16:33'),
(000035, 000020, '6767', '867867', '6767', '2019-11-07', '67.00', '6767.00', '676.00', '76.00', '7676.00', '15195.00', '6767.00', '767.00', '767.00', '22796.00', '22029.00', '76767', '67676', '67', '767', '2019-11-06', '2019-11-10 17:17:45', '2019-11-10 17:17:45'),
(000036, 000021, '76767', '767767', '676', '2019-11-27', '67.00', '676.00', '6767.00', '7676.00', '6767.00', '21886.00', '6767.00', '7676.00', '7676.00', '36396.00', '28720.00', '7676', '7676', '676', '767', '2019-11-20', '2019-11-10 17:19:12', '2019-11-10 17:19:12'),
(000040, 000024, '86868686', '868686', '8686', '2019-11-05', '686.00', '6868.00', '868.00', '8686.00', '8686.00', '25108.00', '8686868.00', '86686.00', '86686.00', '8799348.00', '8712662.00', '8686', '8686', '868', '6868', '2019-11-20', '2019-11-13 09:31:01', '2019-11-13 09:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `payment_voucher`
--

CREATE TABLE `payment_voucher` (
  `payment_vou_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `py_pay_to` varchar(255) NOT NULL,
  `py_tele` varchar(255) NOT NULL,
  `py_fax` varchar(255) NOT NULL,
  `py_mode_of_payment` varchar(255) NOT NULL,
  `py_payment_info` varchar(255) NOT NULL,
  `py_amount` decimal(15,2) NOT NULL,
  `py_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `py_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_voucher`
--

INSERT INTO `payment_voucher` (`payment_vou_id`, `py_pay_to`, `py_tele`, `py_fax`, `py_mode_of_payment`, `py_payment_info`, `py_amount`, `py_created_at`, `py_updated_at`) VALUES
(000001, 'efresfzsd', 'cszdcvxzcvxz', 'vxcvcxvc', 'xvxcvxc', '', '0.00', '2019-10-18 18:30:30', '2019-10-18 18:30:30'),
(000002, 'ghdfgfgcf', 'gcxvbxcvcv', 'vcvcvc', 'vcvcvc', '', '0.00', '2019-10-18 18:31:42', '2019-10-18 18:31:42'),
(000003, 'rgrgrg', 'rgrgr', 'grgr', 'grgr', '', '5454545.00', '2019-10-18 18:38:15', '2019-10-18 18:38:15'),
(000004, 'payee details', '0774523569', '06655223369', 'mode of payment', '', '50000.00', '2019-10-18 18:40:50', '2019-10-18 18:40:50'),
(000005, 'fgfgf', 'gfgf', 'gfgf', 'gfgfg', '', '45445.00', '2019-10-18 18:44:14', '2019-10-18 18:44:14'),
(000006, 'yhyh', 'yhyh', 'yhy', 'hyhy', '53535', '53535358.00', '2019-10-18 18:48:30', '2019-10-18 18:48:30'),
(000007, '865656', '5656', '565', '565', '', '456454.00', '2019-10-18 18:49:40', '2019-10-18 18:49:40'),
(000008, '6', '696', '6', '6', '', '6.00', '2019-10-18 18:51:18', '2019-10-18 18:51:18'),
(000009, '56565', '656', '56565', '65656', '6565656', '543656565.00', '2019-10-18 18:51:30', '2019-10-18 18:51:30'),
(000010, 'sdfsfsf', 'sfsf', 'sfsfs', 'fsfs', 'fsfsfs', '435353.00', '2019-10-18 19:02:33', '2019-10-18 19:02:33'),
(000011, 'sdgsdgdg', 'dgdg', 'dgdg', 'dgd', 'gdgd', '7767676.00', '2019-10-18 19:11:01', '2019-10-18 19:11:01'),
(000012, 'sdgsdgdg', 'dgdg', 'dgdg', 'dgd', 'gdgd', '7767676.00', '2019-10-18 19:11:01', '2019-10-18 19:11:01'),
(000013, '57575757676', '7676', '767', '676767676', '76766', '767676.00', '2019-10-18 19:11:44', '2019-10-18 19:11:44'),
(000014, '57575757676', '7676', '767', '676767676', '76766', '767676.00', '2019-10-18 19:11:44', '2019-10-18 19:11:44'),
(000015, '67676', '767', '676', '767', '676767', '67676.00', '2019-10-18 19:12:27', '2019-10-18 19:12:27'),
(000016, '75776', '7676767', '6767', '676', '76767', '67676.00', '2019-10-18 19:12:43', '2019-10-18 19:12:43'),
(000017, '86876868', '686', '8686', '86', '8686', '868686.00', '2019-10-18 19:20:48', '2019-10-18 19:20:48'),
(000018, '6886', '86868', '686', '8686', '8686', '68686.00', '2019-10-18 19:25:46', '2019-10-18 19:25:46'),
(000019, '67676767', '6767', '676', '767', '676', '7676.00', '2019-10-18 19:28:06', '2019-10-18 19:28:06'),
(000020, '686868', '6868', '686', '868', '68686', '868.00', '2019-10-18 19:28:53', '2019-10-18 19:28:53'),
(000021, '8686', '868', '6868', '686', '8686', '8686.00', '2019-10-18 19:29:07', '2019-10-18 19:29:07'),
(000022, '676776', '767', '6767', '676', '76767', '67676.00', '2019-10-18 19:30:36', '2019-10-18 19:30:36'),
(000023, '868686', '8686', '868', '868', '68686', '8686.00', '2019-10-18 19:31:15', '2019-10-18 19:31:15'),
(000024, '688686', '686', '8686', '868', '686868', '6868.00', '2019-10-18 19:31:23', '2019-10-18 19:31:23'),
(000025, '687767', '676', '767', '767', '676767', '676767.00', '2019-10-18 19:35:24', '2019-10-18 19:35:24'),
(000026, '68686', '86868', '686', '86868', '68686', '86868.00', '2019-10-18 19:35:55', '2019-10-18 19:35:55'),
(000027, '786868', '68686', '8686', '86868', '68686', '8686.00', '2019-10-18 19:36:08', '2019-10-18 19:36:08'),
(000028, '68686', '86868', '686', '8686', '868686', '86868.00', '2019-10-18 19:36:17', '2019-10-18 19:36:17'),
(000029, '6767676767', '676', '76767', '6767', '67676', '7667676.00', '2019-10-18 19:39:45', '2019-10-18 19:39:45'),
(000032, 'vgvhgvhjcv', '686', '868', '6868', '6868', '68686.00', '2019-10-18 19:45:20', '2019-10-21 16:59:28'),
(000035, '8686868', '686', '686', '868', '435353', '8686.00', '2019-10-19 10:13:24', '2019-10-21 16:58:11'),
(000037, 'cbvfbgjfghf', '67676', '7676', '767', '6767', '67676.00', '2019-10-19 18:30:00', '2019-10-21 17:00:08'),
(000038, '4244634', '6464', '64646', '464', '646464', '646464.00', '2019-10-19 18:44:28', '2019-10-19 18:44:28'),
(000039, '6767676', '76767', '67676', '7676', '76767', '67676767676.00', '2019-10-19 18:44:53', '2019-10-19 18:44:53'),
(000041, '767676', '7676', '6767', '676', '76767', '676767.00', '2019-10-19 18:47:21', '2019-10-19 18:47:21'),
(000043, '8678686', '8686', '868', '686', '8686', '86868.00', '2019-10-19 18:51:55', '2019-10-19 18:51:55'),
(000045, '565565656', '6565', '65656', '5656', '565656', '5656565.00', '2019-10-20 05:21:13', '2019-10-20 05:21:13'),
(000046, 'MHM. Najathi', '0754141331', '06655223369', '', 'Cash', '10000.00', '2019-10-20 15:58:15', '0000-00-00 00:00:00'),
(000047, 'hhhhhhhhhhhhhhhhhhh', 'jhjhjhjghjhjhj', 'jhhggf', 'ghj', 'jghghjjg', '1265453.99', '2019-10-21 14:05:48', '2019-10-21 16:58:53'),
(000048, 'Mohamed Haneefa', '06767767', '5668', 'Cheque', 'cash', '100000.00', '2019-10-22 13:40:07', '0000-00-00 00:00:00'),
(000053, '445', '445545', '54445', 'Cheque', 'ekfjwgfwgef', '2154.00', '2019-11-13 08:54:36', '0000-00-00 00:00:00'),
(000054, '867676', '76767', '67676', 'Cheque', '76767', '67676.00', '2019-11-13 09:22:00', '2019-11-13 09:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `re_customer` int(6) UNSIGNED ZEROFILL NOT NULL,
  `re_tele` varchar(255) NOT NULL,
  `re_fax` varchar(255) NOT NULL,
  `mode_of_payment` varchar(255) NOT NULL,
  `payment_info` varchar(255) NOT NULL,
  `re_amount` decimal(15,2) NOT NULL,
  `re_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `re_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `re_customer`, `re_tele`, `re_fax`, `mode_of_payment`, `payment_info`, `re_amount`, `re_created_at`, `re_updated_at`) VALUES
(000001, 000003, '45454', '54545', 'Cash', '21245', '20000.00', '2019-11-11 15:51:26', '2019-11-13 07:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `supplierr`
--

CREATE TABLE `supplierr` (
  `supp_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `supp_name` varchar(255) NOT NULL,
  `supp_tele` varchar(255) DEFAULT NULL,
  `supp_email` varchar(255) DEFAULT NULL,
  `supp_address_one` varchar(255) DEFAULT NULL,
  `supp_address_two` varchar(255) DEFAULT NULL,
  `supp_date` datetime NOT NULL DEFAULT current_timestamp(),
  `supp_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplierr`
--

INSERT INTO `supplierr` (`supp_id`, `supp_name`, `supp_tele`, `supp_email`, `supp_address_one`, `supp_address_two`, `supp_date`, `supp_updated_at`) VALUES
(000001, 'hfh', 'fhfh', 'fhfh', 'fhfh', 'f', '2019-09-01 22:07:07', '2019-09-03 05:40:22'),
(000002, 'Naharni', '4545445', 'ghghg', 'hghghg', '', '2019-08-18 19:05:08', '2019-09-03 05:40:22'),
(000003, 'Mohamed Faheem', '0758945369', 'faheem@gmail.com', '#45, Main Street,', 'Kattankudy - 06.', '2019-08-18 19:05:08', '2019-09-03 05:40:22'),
(000004, 'ghghg', 'hghgh', 'ghghg', 'hghghg444444', 'bcnfn', '2019-08-18 19:05:08', '2019-09-03 05:40:22'),
(000005, 'ghghg', 'hghgh', 'ghghg', 'hghghg', NULL, '2019-08-18 19:05:08', '2019-09-03 05:40:22'),
(000006, 'ghghg', 'hghgh', 'ghghg', 'hghghg', NULL, '2019-08-18 19:05:08', '2019-09-03 05:40:22'),
(000007, 'ghghg', 'hghgh', 'ghghg', 'hghghg', NULL, '2019-08-18 19:05:08', '2019-09-03 05:40:22'),
(000008, 'ghghg', 'hghgh', 'ghghg', 'hghghg', NULL, '2019-08-18 19:05:08', '2019-09-03 05:40:22'),
(000009, 'thahlan', 'gfgfg', 'fgfgf', 'gfg', '', '2019-08-18 20:07:35', '2019-09-03 05:50:15'),
(000010, 'fgfgfg', 'fggfgfg', 'fgfg', 'gfgfgfgfg', NULL, '2019-08-18 20:07:35', '2019-09-03 05:40:22'),
(000011, 'Nazzaha', 'fgfgf', 'gfgf', 'gfgfg', NULL, '2019-08-18 20:07:35', '2019-09-03 05:40:22'),
(000012, 'fgfgf', 'gfgffgf', 'gfgfg', 'fgfgfg', NULL, '2019-08-18 20:07:35', '2019-09-03 05:40:22'),
(000013, 'vfgfg', 'fgfgfg', 'fgfg', 'fgf', NULL, '2019-08-18 20:23:21', '2019-09-03 05:40:22'),
(000015, '767676', '7676', '76@7678676', '676', '7676', '2019-11-10 15:26:17', '2019-11-10 09:56:17'),
(000016, '767676', '7676', '76@7678676', '676', '7676', '2019-11-10 15:27:05', '2019-11-10 09:57:05'),
(000017, 'evefef', 'efe', 'fef@3gegege', 'gege', 'gege', '2019-11-10 15:32:57', '2019-11-10 10:02:57'),
(000018, '888888888888888888888', '686', '686@4386866', '868686', '86868', '2019-11-10 22:33:45', '2019-11-10 17:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `users_acc`
--

CREATE TABLE `users_acc` (
  `U_ID` int(11) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `U_Email` varchar(255) NOT NULL,
  `U_Password` varchar(255) NOT NULL,
  `PhNo` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `U_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `U_Address` varchar(255) DEFAULT NULL,
  `Designation` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `user_role_id` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_acc`
--

INSERT INTO `users_acc` (`U_ID`, `Firstname`, `Lastname`, `U_Email`, `U_Password`, `PhNo`, `Gender`, `DTime`, `U_updated_at`, `U_Address`, `Designation`, `Image`, `user_role_id`) VALUES
(22, 'Mohamed', 'Najathi', 'najathi@live.com', '$2y$10$52Eg6xOLUFrwbORwN0hoy.hgL/VBsV0aftmExoFxwuAm4nxIHMxWW', '0754141331', 'Male', '2019-07-21 06:34:10', '2019-09-03 05:43:13', NULL, NULL, NULL, 1),
(23, 'Mohamed', 'Naharni', 'naharni@gmail.com', '$2y$10$VgS3NeBtQCRsE3XlYhEyC.eHQP7O70pL7Dw2/QywP98NZx6Hxk/qe', '0756007036', 'Male', '2019-07-21 06:56:09', '2019-11-10 18:21:27', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(1) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(0, 'user'),
(1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_ac_code`);

--
-- Indexes for table `exchange_order`
--
ALTER TABLE `exchange_order`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `exchange_order_ibfk_1` (`customer`),
  ADD KEY `supplier` (`supplier`),
  ADD KEY `counter_staff` (`counter_staff`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_ibfk_1` (`ex_order`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `passenger_ibfk_1` (`exch_order`);

--
-- Indexes for table `payment_voucher`
--
ALTER TABLE `payment_voucher`
  ADD PRIMARY KEY (`payment_vou_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `re_customer` (`re_customer`);

--
-- Indexes for table `supplierr`
--
ALTER TABLE `supplierr`
  ADD PRIMARY KEY (`supp_id`);

--
-- Indexes for table `users_acc`
--
ALTER TABLE `users_acc`
  ADD PRIMARY KEY (`U_ID`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_ac_code` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `exchange_order`
--
ALTER TABLE `exchange_order`
  MODIFY `ex_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payment_voucher`
--
ALTER TABLE `payment_voucher`
  MODIFY `payment_vou_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplierr`
--
ALTER TABLE `supplierr`
  MODIFY `supp_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_acc`
--
ALTER TABLE `users_acc`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exchange_order`
--
ALTER TABLE `exchange_order`
  ADD CONSTRAINT `exchange_order_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`cus_ac_code`),
  ADD CONSTRAINT `exchange_order_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `supplierr` (`supp_id`),
  ADD CONSTRAINT `exchange_order_ibfk_3` FOREIGN KEY (`counter_staff`) REFERENCES `users_acc` (`U_ID`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`ex_order`) REFERENCES `exchange_order` (`ex_id`) ON DELETE CASCADE;

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`exch_order`) REFERENCES `exchange_order` (`ex_id`) ON DELETE CASCADE;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`re_customer`) REFERENCES `customer` (`cus_ac_code`);

--
-- Constraints for table `users_acc`
--
ALTER TABLE `users_acc`
  ADD CONSTRAINT `users_acc_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`role_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
