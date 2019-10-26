-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2019 at 09:09 AM
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
(000014, 'dvdvd', 'vdvd', 'hf@edgdg.hgh', 'dvdvd', 'vdv', '2019-08-18 18:17:46', '2019-09-03 05:38:51'),
(000015, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000016, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000017, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000019, 'fhfh', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:47:24'),
(000020, 'vdvdvd', 'ddfdfdf', 'highths', 'gjjj', 'hjhjhjh', '0000-00-00 00:00:00', '2019-09-03 05:38:51'),
(000022, 'grgrg', 'rgrgr', 'grgrgrg@HG.KK', 'rgrgrg', 'rgr', '2019-09-01 07:21:23', '2019-09-03 05:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_order`
--

CREATE TABLE `exchange_order` (
  `ex_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `xo_date` date NOT NULL,
  `customer` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `counter_staff` int(11) NOT NULL,
  `booking_ref` varchar(255) NOT NULL,
  `supplier` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `ex_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ex_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange_order`
--

INSERT INTO `exchange_order` (`ex_id`, `xo_date`, `customer`, `counter_staff`, `booking_ref`, `supplier`, `ex_created_at`, `ex_updated_at`) VALUES
(000001, '2019-10-10', 000003, 22, '6e6e6e6e', 000004, '2019-10-15 14:52:31', '2019-10-15 14:52:31'),
(000002, '2019-10-08', 000001, 22, '78787', 000003, '2019-10-15 14:56:14', '2019-10-15 14:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ex_order` int(6) UNSIGNED ZEROFILL NOT NULL,
  `is_invoice` int(1) NOT NULL,
  `in_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `in_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `exch_order` int(6) UNSIGNED ZEROFILL NOT NULL,
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

INSERT INTO `passenger` (`passenger_id`, `exch_order`, `p_name`, `ticket_no`, `ticket_date`, `basicc`, `yq`, `yr`, `tax_3`, `tax_4`, `total_tax`, `supp_charge`, `service_amt`, `net_profit`, `net_due`, `net_to_supplier`, `from_to`, `class_code`, `airline_code`, `flight_no`, `depart_date`, `pass_created_at`, `pass_updated_at`) VALUES
(000001, 000001, '597878787', '87878', '2019-09-30', '87878.00', '787.00', '87.00', '878.00', '7878.00', '9630.00', '78.00', '787.00', '0.00', '98373.00', '97586.00', '87878', '787', '878787', '878', '2019-10-22', '2019-10-15 14:52:31', '2019-10-15 14:52:31'),
(000002, 000002, '78787', '87878', '2019-10-15', '787.00', '878.00', '78.00', '78.00', '78.00', '1112.00', '8878.00', '78888.00', '78787.00', '89665.00', '10777.00', '8787', '87', '877', '8787', '2019-10-16', '2019-10-15 14:56:14', '2019-10-15 14:56:14'),
(000003, 000002, '78787', '8787', '2019-10-08', '78787.00', '87787.00', '8787.00', '87.00', '87.00', '8787.00', '878.00', '78.00', '787.00', '78.00', '878.00', '64644646', '46464', '64646', '4646', '2019-10-17', '2019-10-15 14:56:14', '2019-10-15 14:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `exc_order` int(6) UNSIGNED ZEROFILL NOT NULL,
  `is_receipt` int(1) NOT NULL,
  `re_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `re_updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(000013, 'vfgfg', 'fgfgfg', 'fgfg', 'fgf', NULL, '2019-08-18 20:23:21', '2019-09-03 05:40:22');

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
(23, 'Mohamed', 'Naharni', 'naharni@gmail.com', '$2y$10$8Zba1sfuOtjA3wh/5BDlaOm6VgSDbdPuqZrr3FvxSObTlXETmbDuu', '0756007036', 'Male', '2019-07-21 06:56:09', '2019-09-03 05:54:10', NULL, NULL, NULL, 0);

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
  ADD KEY `ex_order` (`ex_order`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `exch_order` (`exch_order`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `exc_order` (`exc_order`);

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
  MODIFY `cus_ac_code` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `exchange_order`
--
ALTER TABLE `exchange_order`
  MODIFY `ex_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplierr`
--
ALTER TABLE `supplierr`
  MODIFY `supp_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`ex_order`) REFERENCES `exchange_order` (`ex_id`);

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`exch_order`) REFERENCES `exchange_order` (`ex_id`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`exc_order`) REFERENCES `exchange_order` (`ex_id`);

--
-- Constraints for table `users_acc`
--
ALTER TABLE `users_acc`
  ADD CONSTRAINT `users_acc_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`role_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
