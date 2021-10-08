-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2021 at 06:19 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodpanda`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address_detail` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `cus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_detail`, `cus_id`) VALUES
(1, 'ป่้าช้า', 1),
(2, 'sfsdf', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `cus_password` varchar(10) CHARACTER SET utf8 NOT NULL,
  `cus_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cus_surname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cus_birthday` date DEFAULT NULL,
  `cus_tel` char(10) CHARACTER SET utf8 NOT NULL,
  `cus_email` varchar(50) NOT NULL,
  `cus_creditcard_no` char(16) NOT NULL,
  `cus_creditcard_exp` date NOT NULL,
  `cus_creditcard_cvv` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_username`, `cus_password`, `cus_name`, `cus_surname`, `cus_birthday`, `cus_tel`, `cus_email`, `cus_creditcard_no`, `cus_creditcard_exp`, `cus_creditcard_cvv`) VALUES
(1, 'namee', '', 'na', 'mee', '0000-00-00', '', '', '', '0000-00-00', 0),
(2, 'namee', '', 'na', 'mee', '0000-00-00', '', '', '', '0000-00-00', 0),
(3, 'Hello', '12345', 'Proy', 'Wanat', '2021-09-14', '0873561245', 'dsfsdf@gmail.com', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `driver_username` varchar(20) NOT NULL,
  `driver_password` varchar(20) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `driver_surname` varchar(50) NOT NULL,
  `driver_tel` char(10) NOT NULL,
  `driver_earnacc_no` varchar(13) NOT NULL,
  `driver_earnprice` double NOT NULL,
  `driver_workstatus` bit(1) NOT NULL,
  `driver_rate` double NOT NULL,
  `orders_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_username`, `driver_password`, `driver_name`, `driver_surname`, `driver_tel`, `driver_earnacc_no`, `driver_earnprice`, `driver_workstatus`, `driver_rate`, `orders_status_id`) VALUES
(1, 'cat245', '123453453j', 'catmash', 'meow', '0993265478', '4598762103549', 100, b'1', 15, 0),
(2, 'dog5648', '13284535hp', 'corndog', 'mashita', '0994568712', '2655598443018', 525, b'0', 78.75, 1),
(3, 'payut112', '23154513', 'payut', 'oho', '0123456789', '1654028793125', 250, b'0', 37.5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(70) CHARACTER SET utf8 NOT NULL,
  `food_size` varchar(5) CHARACTER SET utf8 NOT NULL,
  `food_price` double NOT NULL,
  `food_image` varchar(100) CHARACTER SET utf8 NOT NULL,
  `food_detail` varchar(100) CHARACTER SET utf8 NOT NULL,
  `food_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_size`, `food_price`, `food_image`, `food_detail`, `food_type`, `shop_id`) VALUES
(1121, 'ข้าวผัดเเมว', 'พิเศษ', 150, '', 'ไม่ใส่ไข่เเมว', 'ผัด', 1),
(1122, 'เเมวทอดกระเทียม', 'ปกติ', 100, '', 'เเมวทุกตัวสะอาด(เเมววัด)', 'ทอด', 2),
(1123, 'อึ่งทอดผัดกระเพรา', 'ปกติ', 100, '', 'อึ่งตัวโตๆน่ากิน', 'ผัด', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_paytype` bit(1) NOT NULL,
  `products_totalprice` double NOT NULL,
  `orders_vat` double NOT NULL,
  `orders_datestartsend` datetime NOT NULL,
  `orders_dateendsend` datetime NOT NULL,
  `products_number` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_paytype`, `products_totalprice`, `orders_vat`, `orders_datestartsend`, `orders_dateendsend`, `products_number`) VALUES
(1, b'0', 100, 7, '2021-09-12 16:56:20', '2021-09-12 17:12:25', 1),
(2, b'1', 180, 12.6, '2021-09-12 16:58:14', '2021-09-12 17:25:22', 2),
(3, b'0', 200, 14, '2021-09-12 16:59:14', '2021-09-12 17:31:08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `orders_status_id` int(11) NOT NULL,
  `order_status_name` varchar(100) NOT NULL,
  `driver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`orders_status_id`, `order_status_name`, `driver_id`) VALUES
(0, 'on hold', 1),
(1, 'complete', 2),
(2, 'pending', 3);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_username` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `shop_password` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `shop_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `shop_address` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `shop_tel` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `shop_workstatus` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `shop_earnacc_no` varchar(13) CHARACTER SET utf8mb4 NOT NULL,
  `shop_earnprice` float NOT NULL,
  `shop_openday` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `shop_opentime` time NOT NULL,
  `shop_closetime` time NOT NULL,
  `shop_rate` float NOT NULL,
  `shop_image` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_username`, `shop_password`, `shop_name`, `shop_address`, `shop_tel`, `shop_workstatus`, `shop_earnacc_no`, `shop_earnprice`, `shop_openday`, `shop_opentime`, `shop_closetime`, `shop_rate`, `shop_image`) VALUES
(1, 'p_porn', '1996e__', 'ร้านอาหารสารพัดนึก', 'ปากซอยวงศ์สว่าง21,บางซื่อ,บางซื่อ,กรุงเทพมหานคร,10', '0890000000', 'ปิด', '7660000000', 1209, 'จ-ศ', '09:30:00', '21:30:00', 4.9, 'shop1.jpg'),
(2, 'cat_U', '03012544', 'เรื่องแมวๆ', '1518 ถนนประชาราษฎ์1,วงศ์สว่าง,บางซื่อ,กรุงเทพมหานค', '0954567891', 'เปิด', '9071234567897', 2546, 'จ-ศ', '10:00:00', '21:00:00', 4.8, 'IMG202110091709.jpg'),
(3, 'inti_01', '03012544', 'วอเตอร์', 'ปากซอยวงศ์สว่าง11,วงศ์สว่าง,บางซื่อ,กรุงเทพมหานค', '0954567891', 'เปิด', '9071234567897', 2546, 'จ-ศ', '08:30:00', '21:00:00', 4.8, 'IMG202110091709.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer` (`cus_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `orders_status_id` (`orders_status_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`orders_status_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6549;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1126;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `customer` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `shop_id` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`);

--
-- Constraints for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD CONSTRAINT `driver_id` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
