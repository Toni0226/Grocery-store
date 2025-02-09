-- Active: 1712511609682@@127.0.0.1@3306@store


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--
CREATE DATABASE IF NOT EXISTS `store` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `store`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `addtime`, `updatetime`) VALUES
(1, 'Frozen', 1713944778, 1713944778),
(2, 'Fresh', 1713944778, 1713944778),
(3, 'Beverage', 1713944778, 1713944778),
(4, 'Household', 1713944778, 1713944778),
(5, 'Pet food', 1713944778, 1713944778),
(7, 'Food', 1713947069, 1713947885);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL COMMENT '订单id',
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` float(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单明细';

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `orders_id`, `product_id`, `name`, `photo`, `unit`, `price`, `qty`, `subtotal`) VALUES
(1, 1, 5002, 'Bird Food', 'upload/1713946728698984.jpeg', '500g packet', 3.99, 3, 3.99),
(2, 1, 5003, 'Cat Food', 'upload/1713946655870141.jpg', '500g tin', 2.00, 14, 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT '订单id',
  `orderno` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `totalqty` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL COMMENT '价格',
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `payment` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `addtime` int(11) DEFAULT NULL COMMENT '下单时间',
  `updatetime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderno`, `user_id`, `totalqty`, `amount`, `name`, `phone`, `address`, `email`, `remark`, `payment`, `status`, `addtime`, `updatetime`) VALUES
(1, '20240425131541', 2, 17, 39.97, 'test', '123123123', '1 Regent Street, Chippendale, NSW 2008, Australia', 'test@123.com', 'asd', 2, 1, 1714022141, 1714024275);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `unit_price` float(8,2) DEFAULT NULL,
  `unit_quantity` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `in_stock` int(10) UNSIGNED DEFAULT NULL,
  `content` text,
  `addtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `unit_price`, `unit_quantity`, `img`, `in_stock`, `content`, `addtime`, `updatetime`, `status`) VALUES
(1000, 7, 'Fish Fingers', 2.55, '500 gram', 'upload/1713947868930494.png', 1500, 'Fish Fingers', 1713944778, 1713947868, 1),
(1001, 7, 'Fish Fingers', 5.00, '1000 gram', 'upload/1713947859847213.png', 750, 'Fish Fingers', 1713944778, 1713947859, 1),
(1002, 7, 'Hamburger Patties', 2.35, 'Pack 10', 'upload/1713947829992116.png', 1200, 'Hamburger Patties', 1713944778, 1713947829, 1),
(1003, 7, 'Shelled Prawns', 6.90, '250 gram', 'upload/1713947794717776.png', 300, 'Shelled Prawns', 1713944778, 1713947794, 1),
(1004, 1, 'Tub Ice Cream', 1.80, 'I Litre', 'upload/1713947746741114.png', 800, 'Tub Ice Cream', 1713944778, 1713947746, 1),
(1005, 1, 'Tub Ice Cream', 3.40, '2 Litre', 'upload/1713947736891033.png', 1200, 'Tub Ice Cream', 1713944778, 1713947736, 1),
(2000, 4, 'Panadol', 3.00, 'Pack 24', 'upload/1713947677332678.png', 2000, 'Panadol', 1713944778, 1713947677, 1),
(2001, 4, 'Panadol', 5.50, 'Bottle 50', 'upload/171394766274251.png', 1000, 'Panadol', 1713944778, 1713947698, 1),
(2002, 4, 'Bath Soap', 2.60, 'Pack 6', 'upload/1713947622658485.png', 500, 'Bath Soap', 1713944778, 1713947622, 1),
(2003, 4, 'Garbage Bags Small', 1.50, 'Pack 10', 'upload/1713947530343045.png', 500, 'Garbage Bags Small', 1713944778, 1713947530, 1),
(2004, 4, 'Garbage Bags Large', 5.00, 'Pack 50', 'upload/1713947519644266.png', 300, 'Garbage Bags Large', 1713944778, 1713947542, 1),
(2005, 4, 'Washing Powder', 4.00, '1000 gram', 'upload/1713947581453423.png', 800, 'Washing Powder', 1713944778, 1713947581, 1),
(3000, 1, 'Cheddar Cheese', 8.00, '500 gram', 'upload/1713947443522562.png', 1000, 'Cheddar Cheese', 1713944778, 1713947443, 1),
(3001, 1, 'Cheddar Cheese', 15.00, '1000 gram', 'upload/1713947432378565.png', 1000, 'Cheddar Cheese', 1713944778, 1713947432, 1),
(3002, 1, 'T Bone Steak', 7.00, '1000 gram', 'upload/1713947401603456.png', 200, 'T Bone Steak', 1713944778, 1713947453, 1),
(3003, 2, 'Navel Oranges', 3.99, 'Bag 20', 'upload/1713947351572950.png', 200, 'Navel Oranges', 1713944778, 1713947351, 1),
(3004, 2, 'Bananas', 1.49, 'Kilo', 'upload/1713947324423846.png', 400, 'Bananas', 1713944778, 1713947324, 1),
(3005, 2, 'Peaches', 2.99, 'Kilo', 'upload/1713947299305957.png', 500, 'Peaches', 1713944778, 1713947299, 1),
(3006, 2, 'Grapes', 3.50, 'Kilo', 'upload/1713947274773626.png', 200, 'Grapes', 1713944778, 1713947274, 1),
(3007, 2, 'Apples', 1.99, 'Kilo', 'upload/1713947245334229.png', 500, 'Apples', 1713944778, 1713947245, 1),
(4000, 3, 'Earl Grey Tea Bags', 2.49, 'Pack 25', 'upload/1713947214371349.png', 1200, 'Earl Grey Tea Bags', 1713944778, 1713947214, 1),
(4001, 3, 'Earl Grey Tea Bags', 7.25, 'Pack 100', 'upload/1713947184983814.png', 1200, 'Earl Grey Tea Bags', 1713944778, 1713947185, 1),
(4002, 3, 'Earl Grey Tea Bags', 13.00, 'Pack 200', 'upload/1713947166666672.png', 800, 'Earl Grey Tea Bags', 1713944778, 1713947166, 1),
(4003, 3, 'Instant Coffee', 2.89, '200 gram', 'upload/1713947131522186.png', 500, 'Instant Coffee', 1713944778, 1713947131, 1),
(4004, 3, 'Instant Coffee', 5.10, '500 gram', 'upload/171394711717686.png', 500, 'Instant Coffee', 1713944778, 1713947117, 1),
(4005, 7, 'Chocolate Bar', 2.50, '500 gram', 'upload/1713947081666115.png', 300, 'Chocolate Bar', 1713944778, 1713947081, 1),
(5000, 5, 'Dry Dog Food', 5.95, '5 kg Pack', 'upload/171394700655270.png', 400, 'Dry Dog Food', 1713944778, 1713947006, 1),
(5001, 5, 'Dry Dog Food', 1.95, '1 kg Pack', 'upload/1713946985206529.png', 400, 'Dry Dog Food', 1713944778, 1713946995, 1),
(5002, 5, 'Bird Food', 3.99, '500g packet', 'upload/1713946728698984.jpeg', 197, 'Bird Food', 1713944778, 1713946728, 1),
(5003, 5, 'Cat Food', 2.00, '500g tin', 'upload/1713946655870141.jpg', 186, 'Cat Food', 1713944778, 1713946656, 1),
(5004, 5, 'Fish Food', 3.00, '500g packet', 'upload/1713946612272955.jpg', 200, 'Fish Food', 1713944778, 1713946612, 1),
(2006, 4, 'Laundry Bleach', 3.55, '2 Litre Bottle', 'upload/1713947493485530.png', 500, 'Laundry Bleach', 1713944778, 1713947493, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '帐号',
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` bigint(11) DEFAULT NULL COMMENT '手机号码',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户地址',
  `addtime` int(11) DEFAULT NULL COMMENT '注册时间',
  `updatetime` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `phone`, `address`, `addtime`, `updatetime`, `status`) VALUES
(2, 'test', '123123', 'test', 'test@123.com', 123123123, '1 Regent Street, Chippendale, NSW 2008, Australia', 1713967159, 1713967520, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5006;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=3;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


alter table `orders` add COLUMN `state` VARCHAR(64) not null DEFAULT '' ;
alter table `orders` add COLUMN `city` VARCHAR(64) not null DEFAULT '' ;