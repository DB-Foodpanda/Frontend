-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 01:36 PM
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
(1, 'หอพักนักศึกษามจพ กรุงเทพฯ', 1),
(2, 'หอ The Curve Salcha 316/73 ห้อง 302 ซ.วงสว่าง11 แขวงวงศ์สว่าง เขตบางซื่อ จ.กรุงเทพมหานคร 10800 เขตบา', 2),
(3, '389 หอพักทรัพย์ทวีรุ่งเรือง ห้อง 602 ซ.7 วงศ์สว่าง ถ.วงศ์สว่าง เขตบางซื่อ แขวงบางซื่อ กรุงเทพฯ 10800', 3);

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
  `cus_tel` char(10) CHARACTER SET utf8 NOT NULL,
  `cus_email` varchar(50) NOT NULL,
  `cus_creditcard_no` char(16) NOT NULL,
  `cus_creditcard_exp` date NOT NULL,
  `cus_creditcard_cvv` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_username`, `cus_password`, `cus_name`, `cus_surname`, `cus_tel`, `cus_email`, `cus_creditcard_no`, `cus_creditcard_exp`, `cus_creditcard_cvv`) VALUES
(1, 'Bell', 'abc1234', 'Emma', 'Olivia', '0817854327', '', '1234567890123456', '2024-09-03', 567),
(2, 'James', 'fgh5679', 'Hello', 'It\'s me', '0956783456', '', '2345678902736483', '2023-07-24', 568),
(3, 'Pop', 'hjk@erwer', 'Kojo', 'Shinobu', '0993241234', '', '1429472550247590', '2025-04-24', 789),
(21, 'Proy3245', 'proy@3258', 'Wanat', 'Churvivat', '0974533632', 'fgdgg@gmail.com', '6746365746757364', '2023-05-14', 567),
(22, 'Halo', 'proy@1809', 'Helloitsme', 'kkkkkk', '0981233467', 'asdasd@outlook.com', '', '0000-00-00', 0);

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
  `driver_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_username`, `driver_password`, `driver_name`, `driver_surname`, `driver_tel`, `driver_earnacc_no`, `driver_earnprice`, `driver_workstatus`, `driver_rate`) VALUES
(5648, 'cat245', '123453453j', 'catmash', 'meow', '0993265478', '4598762103549', 100, b'1', 15),
(5778, 'dog5648', '13284535hp', 'corndog', 'mashita', '0994568712', '2655598443018', 525, b'0', 78.75),
(6548, 'payut112', '23154513', 'payut', 'oho', '0123456789', '1654028793125', 250, b'0', 37.5);

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
  `food_type` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_size`, `food_price`, `food_image`, `food_detail`, `food_type`) VALUES
(1121, 'ข้าวผัดเเมว', 'พิเศษ', 150, '', 'ไม่ใส่ไข่เเมว', 'ผัด'),
(1122, 'เเมวทอดกระเทียม', 'ปกติ', 100, '', 'เเมวทุกตัวสะอาด(เเมววัด)', 'ทอด'),
(1123, 'อึ่งทอดผัดกระเพรา', 'ปกติ', 100, '', 'อึ่งตัวโตๆน่ากิน', 'ผัด');

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
  `order_status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`orders_status_id`, `order_status_name`) VALUES
(0, 'on hold'),
(1, 'complete'),
(2, 'pending');

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
  ADD KEY `C_id` (`cus_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`orders_status_id`);

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
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `C_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `Test` FOREIGN KEY (`ID_Orders`) REFERENCES `orders` (`orders_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
