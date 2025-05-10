-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 02:08 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(5) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` varchar(1000) NOT NULL,
  `pt_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `pt_id`) VALUES
(1, 'herbs', 'Herbs are short-sized plants with soft, green, delicate stems without woody tissues. They complete their life cycle within one or two seasons. Generally, they have few branches or are branchless. These can be easily uprooted from the soil.', 1),
(2, 'shrubs', '\r\nShrubs are medium-sized, woody plants taller than herbs and shorter than a tree. Their height usually ranges from 6m to 10m tall. Their features include bushy, hard, and woody stems with many branches. Although stems are hard, they are flexible but not fragile\r\n', 1),
(3, 'insecticide', 'insecticide, any toxic substance that is used to kill insects. Such substances are used primarily to control pests that infest cultivated plants or to eliminate disease-carrying insects in specific areas.\r\n', 2),
(4, 'stainless steel', 'Stainless steel is a corrosion-resistant alloy of iron, chromium and, in some cases, nickel and other metals. Completely and infinitely recyclable, stainless steel is the “green material” par excellence.', 3),
(6, 'plastic', 'Plastics are a group of materials, either synthetic or naturally occurring, that may be shaped when soft and then hardened to retain the given shape. Plastics are polymers. A polymer is a substance made of many repeating units.', 3),
(7, 'leather ', 'Leather is an ancient, durable material created through a process of tanning animal rawhide to preserve it and make it pliable when dry. Many features of natural leather make it superior to synthetic products including durability, comfort, beauty, suppleness, and resilience.', 3),
(8, 'cotton', 'Cotton is a seed-hair fiber made mostly of cellulose. The fibers are composed of about 87 to 90 percent cellulose (a carbohydrate plant substance), 5 to 8 percent water, and 4 to 6 percent natural impurities.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_id` int(5) NOT NULL,
  `color_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `color_name`) VALUES
(1, 'red'),
(2, 'yellow'),
(3, 'purple'),
(4, 'orange'),
(5, 'white'),
(6, 'violet'),
(7, 'pink'),
(8, 'green');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(5) NOT NULL,
  `comment_name` varchar(100) NOT NULL,
  `cust_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(5) NOT NULL,
  `cust_username` varchar(100) NOT NULL,
  `cust_firstname` varchar(100) NOT NULL,
  `cust_lastname` varchar(100) NOT NULL,
  `cust_password` varchar(100) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_mobile` int(10) NOT NULL,
  `cust_dob` date NOT NULL,
  `cust_street` varchar(100) NOT NULL,
  `cust_town` varchar(100) NOT NULL,
  `cust_zip` int(6) NOT NULL,
  `cust_status` int(10) NOT NULL,
  `cust_image` varchar(1000) NOT NULL,
  `cust_log_count` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_username`, `cust_firstname`, `cust_lastname`, `cust_password`, `cust_email`, `cust_mobile`, `cust_dob`, `cust_street`, `cust_town`, `cust_zip`, `cust_status`, `cust_image`, `cust_log_count`) VALUES
(2, 'nathan', 'Fabrices', 'Quenettes', 'b8d9669b9f47a463d28c0892dbaf8447', 'titifab7@gmail.com', 59036523, '2001-06-27', 'Sohawon Road', 'The Vale', 313011, 1, 'sanjana_profile_pic.jpg', 1),
(3, 'sanjana', 'sanjana', 'bissessur', 'b8d9669b9f47a463d28c0892dbaf8447', 'titifab7@gmail.com', 58162933, '2001-11-21', 'Royal Road', 'Petit Raffray', 303101, 1, 'profile_pic_test.jpg', 1),
(4, 'test', 'test', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'titifab7@gmail.com', 59036523, '2001-06-27', 'RoyalRoad', 'TheVale', 313011, 1, 'profile_pic_test.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `like_dislike_id` int(5) NOT NULL,
  `likes` int(100) NOT NULL,
  `dislikes` int(100) NOT NULL,
  `cust_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(5) NOT NULL,
  `o_date` date NOT NULL,
  `o_total` int(11) NOT NULL,
  `cust_id` int(5) NOT NULL,
  `o_status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `o_date`, `o_total`, `cust_id`, `o_status`) VALUES
(2, '2023-01-16', 750, 2, 1),
(3, '2023-01-16', 250, 2, 1),
(7, '2023-01-16', 0, 2, 1),
(8, '2023-01-16', 750, 2, 0),
(9, '2023-01-17', 1800, 2, 1),
(10, '2023-01-17', 0, 2, 1),
(11, '2023-01-17', 0, 2, 1),
(12, '2023-01-17', 1600, 2, 1),
(13, '2023-01-17', 4000, 2, 1),
(14, '2023-01-18', 1250, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `o_id`, `stock_id`, `qty`) VALUES
(1, 2, 3, 3),
(2, 3, 3, 1),
(3, 8, 3, 3),
(4, 9, 9, 1),
(5, 9, 10, 1),
(6, 9, 7, 2),
(7, 12, 13, 3),
(8, 12, 7, 1),
(9, 13, 13, 5),
(10, 13, 7, 5),
(11, 14, 3, 2),
(12, 14, 4, 2),
(13, 14, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp_id` int(5) NOT NULL,
  `otp` int(10) NOT NULL,
  `expired` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `cust_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`otp_id`, `otp`, `expired`, `created`, `cust_id`) VALUES
(8, 410309, 1, '2023-01-18 09:00:10', 2),
(9, 458066, 1, '2023-01-18 13:12:03', 4);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(5) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `o_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `payment_method`, `o_id`) VALUES
(1, '2023-01-18', 'cash on delivery', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(5) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_desc` varchar(1000) DEFAULT NULL,
  `pt_id` int(5) NOT NULL,
  `cat_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_desc`, `pt_id`, `cat_id`) VALUES
(1, 'rose', 'Roses are erect, climbing, or trailing shrubs, the stems of which are usually copiously armed with prickles of various shapes and sizes, commonly called thorns. The leaves are alternate and pinnately compound (i.e., feather-formed), usually with oval leaflets that are sharply toothed', 1, 2),
(2, 'hibiscus ', 'Native to warm-temperate, subtropical and tropical regions. The large, trumpet-shaped flowers have five or more petals, and come in a range of colors, including white, pink, orange, red, yellow, purple, and multi-hued patterns. \r\n\r\nHibiscus blossoms open wide, inviting pollinators from bees to hummingbirds to reach in for a deep drink of nectar.', 1, 2),
(5, 'daisy', 'Each flower has a rosette of small, thin white petals surrounding a bright yellow centre. These are supported by a single stem which grows from a group of dark green rounded leaves. The petals can sometimes be tinged with pink. It is a common wild flower found growing in our garden lawns', 1, 2),
(8, 'Spade', 'Spades distinguish themselves from shovels because of the formers squared-off blade. You will not be able to do much digging with a spade, given the shape of its blade, but they are good for turning soil, as well as breaking up clumps and roots.', 3, 4),
(9, 'gloves', 'Getting down and dirty in the garden is fun and all, but gardening gloves are a definite must-have to protect you from battering your hands, protecting them from sharp objects and preventing too much gunk from accumulating under your nails. ', 3, 7),
(10, 'pruner', 'A pruner, also known as pruning shears, a hand pruner or a secateur, is a type of scissors to be used specifically on plants. A good pair will be super sharp to cut through thick branches as easily as they can cut through twig-like stems', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `pt_id` int(5) NOT NULL,
  `pt_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`pt_id`, `pt_name`) VALUES
(1, 'Plant'),
(2, 'Pesticide'),
(3, 'Tool');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(5) NOT NULL,
  `rating_value` int(50) DEFAULT NULL,
  `cust_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rating_value`, `cust_id`, `p_id`) VALUES
(10, 5, 2, 1),
(11, 3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(5) NOT NULL,
  `stock_qty` int(5) NOT NULL,
  `stock_price` int(5) NOT NULL,
  `p_id` int(5) NOT NULL,
  `color_id` int(5) NOT NULL,
  `unit_id` int(5) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `stock_sale` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_qty`, `stock_price`, `p_id`, `color_id`, `unit_id`, `file_name`, `stock_sale`) VALUES
(3, 0, 250, 1, 1, 1, 'rsz_red_rose.jpg', 2),
(4, 0, 200, 2, 2, 1, 'yellow_hibiscus.jpg', 2),
(5, 1, 350, 2, 4, 1, 'orange_hibiscus.jpg', 1),
(6, 3, 250, 1, 5, 1, 'white_rose.jpg', 0),
(7, 5, 400, 5, 5, 2, 'white_daisy.jpg', 6),
(9, 1, 500, 9, 2, 1, 'leather_gloves.jpg', 0),
(10, 1, 500, 8, 1, 1, 'stainless_steel_spade.jpg', 0),
(11, 2, 600, 10, 1, 1, 'small_pruner.jpg', 0),
(12, 2, 300, 1, 1, 2, 'rsz_red_rose.jpg', 0),
(13, 5, 400, 1, 1, 3, 'rsz_red_rose.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(5) NOT NULL,
  `unit_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(1, 'small'),
(2, 'medium'),
(3, 'large');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `w_id` int(5) NOT NULL,
  `w_date` date NOT NULL,
  `cust_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `fk_product_type` (`pt_id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comment_customer` (`cust_id`),
  ADD KEY `fk_comment_product` (`p_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`like_dislike_id`),
  ADD KEY `fk_like_dislike_customer` (`cust_id`),
  ADD KEY `fk_like_dislike_product` (`p_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `fk_orders_customer` (`cust_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `fk_order_detail_order` (`o_id`),
  ADD KEY `fk_order_detail_stock` (`stock_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp_id`),
  ADD KEY `fk_otp_customer` (`cust_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_orders` (`o_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk_product_product_type` (`pt_id`),
  ADD KEY `fk_product_category` (`cat_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_rating_customer` (`cust_id`),
  ADD KEY `fk_rating_product` (`p_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `fk_stock_color` (`color_id`),
  ADD KEY `fk_stock_product` (`p_id`),
  ADD KEY `fk_stock_unit` (`unit_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `fk_wishlist_customer` (`cust_id`),
  ADD KEY `fk_wishlist_product` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `like_dislike`
--
ALTER TABLE `like_dislike`
  MODIFY `like_dislike_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `otp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `pt_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `w_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_product_type` FOREIGN KEY (`pt_id`) REFERENCES `product_type` (`pt_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `fk_comment_product` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD CONSTRAINT `fk_like_dislike_customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `fk_like_dislike_product` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_detail_order` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`),
  ADD CONSTRAINT `fk_order_detail_stock` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`);

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `fk_otp_customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_orders` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `fk_product_product_type` FOREIGN KEY (`pt_id`) REFERENCES `product_type` (`pt_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `fk_rating_product` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_color` FOREIGN KEY (`color_id`) REFERENCES `color` (`color_id`),
  ADD CONSTRAINT `fk_stock_product` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `fk_stock_unit` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
