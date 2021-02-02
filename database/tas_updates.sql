-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2020 at 04:29 AM
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
(000001, 'Direct Customer', '', '', '', NULL, '2019-07-30 07:39:45', '2019-09-03 05:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_order`
--

CREATE TABLE `exchange_order` (
  `ex_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `xo_date` date NOT NULL,
  `customer` int(6) UNSIGNED ZEROFILL NOT NULL,
  `counter_staff` int(11) NOT NULL,
  `supplier` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ex_remark` varchar(255) DEFAULT NULL,
  `ex_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ex_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange_order`
--
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
  `from_to` varchar(255) DEFAULT NULL,
  `class_code` varchar(255) DEFAULT NULL,
  `airline_code` varchar(255) DEFAULT NULL,
  `flight_no` varchar(255) DEFAULT NULL,
  `depart_date` date DEFAULT NULL,
  `pass_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pass_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passenger`
--

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
(22, 'Mohamed', 'Najathi', 'najathi@live.com', '$2y$10$WwCKqhENWY.JjoV5E2ZVxOGhcHHNMo1fEZFnVvAEgxVCFfUruJAzO', '0754141331', 'Male', '2019-07-21 06:34:10', '2019-11-21 16:14:56', 'Kattankudy', 'Software Developer', '1574352896.png', 1);

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
  MODIFY `cus_ac_code` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `exchange_order`
--
ALTER TABLE `exchange_order`
  MODIFY `ex_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `payment_voucher`
--
ALTER TABLE `payment_voucher`
  MODIFY `payment_vou_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
