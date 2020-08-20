-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 02:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `CatagoryName` varchar(255) NOT NULL,
  `CatagoryDescription` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `CatagoryName`, `CatagoryDescription`) VALUES
(1, 'Shampoo', 'Hair Care, Hair Hygiene, Hair Cleaning and hair shine.'),
(2, 'Soap', 'Body Care, Body Hygiene, Body Cleaning.'),
(4, 'Detergent', 'Clothes washing cleaning and care.'),
(5, 'boys shirts', 'Cotton Shirts, T shirts'),
(6, 'Fruits', 'Summer Fruits'),
(7, 'Shirts', 'Multipurpose.'),
(8, 'Snacks', 'Thing to eat'),
(9, 'Electronics', 'Appliences');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Paid` varchar(255) NOT NULL,
  `Unpaid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fullname`, `phone`, `email`, `Paid`, `Unpaid`) VALUES
(1, 'Waleed Zia', '0302762034', 'pythoning7@gmail.com', '2000', '200');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fullname`, `phone`, `email`, `address`, `designation`, `salary`) VALUES
(1, 'Waleed Zia', '234234', 'pythoning7@gmail.com', 'Pakistan', 'Junior Developer', '45000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `catagory` varchar(255) NOT NULL,
  `Purchased_unit` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `purchase_per_unit` varchar(255) NOT NULL,
  `sale_per_unit` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `discount_enable` varchar(255) NOT NULL,
  `expiry_Date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `catagory`, `Purchased_unit`, `unit`, `purchase_per_unit`, `sale_per_unit`, `status`, `discount_enable`, `expiry_Date`) VALUES
(12, 'Life Boy', 'Shampoo', '340', 'mg', '300', '450', 'In Stock', 'No', '2021-06-03'),
(13, 'Lux', 'Soap', '94', 'mg', '80', '99', 'In Stock', 'No', '2021-06-03'),
(14, 'Safe Guard', 'Soap', '45', 'mg', '70', '85', 'In Stock', 'No', '2021-06-03'),
(15, 'Surf Axel', 'Detergent', '300', 'Kg', '600', '800', 'In Stock', 'No Discount', '2021-06-03'),
(16, 'Areal', 'Detergent', '271', 'Kg', '700', '950', 'In Stock', 'No', '2021-06-03'),
(17, 'Kurta', 'boys shirts', '20', '900g', '700', '900', 'In Stock', 'No Discount', '2021-06-03'),
(18, 'Pop Corn', 'Snacks', '250', '50mg', '40', '50', 'In Stock', 'No', '2021-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `Invoice` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Catagory` varchar(255) NOT NULL,
  `UnitWeight` varchar(255) NOT NULL,
  `Saleprice` varchar(255) NOT NULL,
  `BoughtUnit` varchar(255) NOT NULL,
  `Total` varchar(255) NOT NULL,
  `Saledate` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `Invoice`, `Name`, `Catagory`, `UnitWeight`, `Saleprice`, `BoughtUnit`, `Total`, `Saledate`, `year`, `month`) VALUES
(1, 'P-00000001', 'Dove', 'Shampoo', '500mg', '920', '2', '1840', '2020-05-25', '2020', '05'),
(2, 'P-00000001', 'Nevia', 'Shampoo', '500mg', '990', '2', '1980', '2020-05-25', '2020', '05'),
(3, 'P-00000001', 'Head And Shoulders', 'Shampoo', '500mg', '850', '2', '1700', '2020-05-25', '2020', '05'),
(4, 'P-00000001', 'lux', 'Soap', '500mg', '60', '2', '120', '2020-05-25', '2020', '05'),
(5, 'P-00000002', 'Dove', 'Shampoo', '500mg', '920', '3', '2760', '2020-05-25', '2020', '05'),
(6, 'P-00000002', 'Nevia', 'Shampoo', '500mg', '990', '3', '2970', '2020-05-25', '2020', '05'),
(7, 'P-00000002', 'Head And Shoulders', 'Shampoo', '500mg', '850', '3', '2550', '2020-05-25', '2020', '05'),
(8, 'P-00000002', 'lux', 'Soap', '500mg', '60', '3', '180', '2020-05-25', '2020', '05'),
(9, 'P-00000003', 'Dove', 'Shampoo', '500mg', '920', '4', '3680', '2020-05-25', '2020', '05'),
(10, 'P-00000003', 'Nevia', 'Shampoo', '500mg', '990', '4', '3960', '2020-05-25', '2020', '05'),
(11, 'P-00000003', 'Head And Shoulders', 'Shampoo', '500mg', '850', '4', '3400', '2020-05-25', '2020', '05'),
(12, 'P-00000003', 'lux', 'Soap', '500mg', '60', '4', '240', '2020-05-25', '2020', '05'),
(13, 'P-00000004', 'Dove', 'Shampoo', '500mg', '920', '5', '4600', '2020-05-25', '2020', '05'),
(14, 'P-00000004', 'Nevia', 'Shampoo', '500mg', '990', '5', '4950', '2020-05-25', '2020', '05'),
(15, 'P-00000004', 'Head And Shoulders', 'Shampoo', '500mg', '850', '5', '4250', '2020-05-25', '2020', '05'),
(16, 'P-00000004', 'lux', 'Soap', '500mg', '60', '5', '300', '2020-05-25', '2020', '05'),
(17, 'P-00000005', 'Dove', 'Shampoo', '500mg', '920', '6', '5520', '2020-05-25', '2020', '05'),
(18, 'P-00000005', 'Nevia', 'Shampoo', '500mg', '990', '6', '5940', '2020-05-25', '2020', '05'),
(19, 'P-00000005', 'Head And Shoulders', 'Shampoo', '500mg', '850', '6', '5100', '2020-05-25', '2020', '05'),
(20, 'P-00000005', 'lux', 'Soap', '500mg', '60', '6', '360', '2020-05-25', '2020', '05'),
(34, 'P-000000011', 'Dove', 'Shampoo', '500mg', '920', '30', '27600', '2020-06-01', '2020', '06'),
(35, 'P-000000012', 'Dove', 'Shampoo', 'mg', '650', '30', '19500', '2020-06-04', '2020', '06'),
(36, 'P-000000012', 'Areal', 'Detergent', 'Kg', '950', '20', '19000', '2020-06-04', '2020', '06'),
(37, 'P-000000013', 'Safe Guard', 'Soap', 'mg', '85', '50', '4250', '2020-06-11', '2020', '06'),
(38, 'P-000000013', 'Areal', 'Detergent', 'Kg', '950', '9', '8550', '2020-06-11', '2020', '06'),
(39, 'P-000000014', 'Pop Corn', 'Snacks', '50mg', '50', '50', '2500', '2020-06-11', '2020', '06'),
(40, 'P-000000015', 'Lux', 'Soap', 'mg', '99', '6', '594', '2020-06-11', '2020', '06'),
(41, 'P-000000016', 'Safe Guard', 'Soap', 'mg', '85', '5', '425', '2020-06-18', '2020', '06');

-- --------------------------------------------------------

--
-- Table structure for table `sales_profit`
--

CREATE TABLE `sales_profit` (
  `id` int(11) NOT NULL,
  `Invoice` varchar(255) NOT NULL,
  `Profit` varchar(255) NOT NULL,
  `Datee` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_profit`
--

INSERT INTO `sales_profit` (`id`, `Invoice`, `Profit`, `Datee`, `year`, `month`) VALUES
(1, 'P-00000001', '1040', '2020-05-25', '2020', '05'),
(2, 'P-00000002', '1560', '2020-05-25', '2020', '05'),
(3, 'P-00000003', '2080', '2020-05-25', '2020', '05'),
(4, 'P-00000004', '2600', '2020-05-25', '2020', '05'),
(5, 'P-00000005', '3120', '2020-05-25', '2020', '05'),
(12, 'P-000000011', '5100', '2020-06-01', '2020', '06'),
(13, 'P-000000012', '9500', '2020-06-04', '2020', '06'),
(14, 'P-000000013', '3000', '2020-06-11', '2020', '06'),
(15, 'P-000000014', '500', '2020-06-11', '2020', '06'),
(16, 'P-000000015', '114', '2020-06-11', '2020', '06'),
(17, 'P-000000016', '75', '2020-06-18', '2020', '06');

-- --------------------------------------------------------

--
-- Table structure for table `temp_sales_tbl`
--

CREATE TABLE `temp_sales_tbl` (
  `id` int(11) NOT NULL,
  `Invoice` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Catagory` varchar(255) NOT NULL,
  `UnitWeight` varchar(255) NOT NULL,
  `Saleprice` varchar(255) NOT NULL,
  `BoughtUnit` varchar(255) NOT NULL,
  `Total` varchar(255) NOT NULL,
  `Saledate` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(111) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `password`, `cpassword`, `token`, `status`) VALUES
(1, 'Muhammad Waleed Khan', '03017646935', 'pythoning7@gmail.com', '$2y$10$b3YBr/AOgT9L1wMNiDFVQue6fkRm8BAnbj7mh15h0bSBgLyqRUgRe', '$2y$10$2iwOpDzItSWbDOU4IeUij.ehNMqDd6JXmKG8Wo/1hmawEQv1tJ2Vu', '78e417a4893fbf355b7d2fc3076357', 'active'),
(15, 'riddaali32@gmail.com', 'riddaali32@gmail.com', 'riddaali32@gmail.com', '$2y$10$Vhwj61vd6uTraOi4vm3FNOjGW36kidzFfO0J.8vXSiXy2w8ZhOJaK', '$2y$10$zUwC1o9RY18fFEp5bZhT1OjZ4tXEHZAn/O9zH7zyjG1OPsj.cq/aO', 'e179eacd91d897d0effa0d3d924d91', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_profit`
--
ALTER TABLE `sales_profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_sales_tbl`
--
ALTER TABLE `temp_sales_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sales_profit`
--
ALTER TABLE `sales_profit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `temp_sales_tbl`
--
ALTER TABLE `temp_sales_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
