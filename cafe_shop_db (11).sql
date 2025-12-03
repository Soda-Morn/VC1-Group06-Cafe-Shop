-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 09:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_ID`, `email`, `name`, `password`, `profile_picture`, `created_at`, `updated_at`) VALUES
(32, 'mornsoda23@gmail.com', 'Giyu san', '$2y$10$TAMzmg5Z6CONfaUmqKKtO.iTdGrBiUrTLmZDFFWmx4QH7jHxqqVna', 'uploads/1745734864_WIN_20250221_15_20_10_Pro.jpg', '2025-04-27 13:21:04', '2025-04-27 13:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_id`, `name`) VALUES
(10, 'coffee'),
(11, 'tea'),
(12, 'milk');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `password_reset_ID` int(11) NOT NULL,
  `admin_ID` int(11) DEFAULT NULL,
  `reset_token` int(11) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Category_id` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `name`, `price`, `image`, `Category_id`, `description`) VALUES
(55, 'Orange cat', 1, 'uploads/1744291359_photo_2025-03-25_14-54-39 (3).jpg', NULL, 'Hello here is orange cat\r\n'),
(56, 'Meal coffee', 1, 'uploads/1744291382_photo_2025-03-25_14-54-39 (2).jpg', NULL, 'Hello here is Meal coffee'),
(57, 'Cream ', 2, 'uploads/1744291416_photo_2025-03-25_14-55-34.jpg', NULL, 'Hello here is cream '),
(58, 'Meal coffee', 2, 'uploads/1744291439_photo_2025-03-25_14-54-39 (4).jpg', NULL, 'Hello here is meal coffee'),
(59, 'Macha', 2, 'uploads/1744291464_photo_2025-03-25_14-55-31.jpg', NULL, 'Hello here is Macha'),
(60, 'Coffee cream', 3, 'uploads/1744291486_photo_2025-03-25_14-54-39 (5).jpg', NULL, 'Hello here is coffee cream'),
(61, 'neze coffee', 2, 'uploads/1744291516_photo_2025-03-25_14-54-39.jpg', NULL, 'Hello here is neze coffee'),
(62, 'Ice_cream', 2, 'uploads/1744293158_Ice cream.jpg', NULL, 'Hello here is Ice cream'),
(64, 'Cream ', 2, 'uploads/1744293272_Cream.jpg', NULL, 'Hello here is cream');

-- --------------------------------------------------------

--
-- Table structure for table `profile_updates`
--

CREATE TABLE `profile_updates` (
  `profile_update_ID` int(11) NOT NULL,
  `admin_ID` int(11) DEFAULT NULL,
  `updated_field` varchar(255) NOT NULL,
  `previous_value` varchar(255) DEFAULT NULL,
  `new_value` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_ID` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_ID`, `total_price`, `date`) VALUES
(1, 2, '2025-04-01 19:24:54'),
(2, 1, '2025-04-02 08:22:46'),
(3, 11, '2025-04-02 08:22:55'),
(4, 11, '2025-04-02 08:23:10'),
(5, 1, '2025-04-02 08:23:30'),
(6, 11, '2025-04-02 08:23:41'),
(7, 77, '2025-04-02 08:24:15'),
(8, 11, '2025-04-02 08:46:02'),
(9, 99, '2025-04-02 10:36:15'),
(10, 60, '2025-04-03 09:57:54'),
(11, 1, '2025-04-03 09:58:49'),
(12, 1, '2025-04-07 13:49:42'),
(13, 50, '2025-04-07 15:59:29'),
(14, 5, '2025-04-07 16:06:15'),
(15, 12, '2025-04-07 16:07:22'),
(16, 7, '2025-04-07 16:07:59'),
(17, 16, '2025-04-07 16:09:47'),
(18, 30, '2025-04-07 16:12:46'),
(19, 84, '2025-04-09 07:45:13'),
(20, 10, '2025-04-09 07:46:09'),
(21, 30, '2025-04-09 07:47:05'),
(22, 18, '2025-04-09 08:06:41'),
(23, 60, '2025-04-10 15:22:25'),
(24, 60, '2025-04-10 15:27:06'),
(25, 48, '2025-04-10 17:34:38'),
(26, 28, '2025-04-10 17:43:17'),
(27, 11, '2025-04-10 17:43:24'),
(28, 40, '2025-04-10 17:43:33'),
(29, 12, '2025-04-10 17:48:43'),
(30, 14, '2025-04-10 20:26:43'),
(31, 9, '2025-04-10 20:26:47'),
(32, 22, '2025-04-10 20:27:01'),
(33, 3, '2025-04-10 20:48:20'),
(34, 56, '2025-04-10 20:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `purchase_item_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `store_unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`purchase_item_id`, `purchase_id`, `product_id`, `product_name`, `product_image`, `quantity`, `price`, `store_unit`) VALUES
(42, NULL, NULL, 'HJCoffee', 'uploads/1744281262_FmY5muXOVgaK_hNxjiOSiJ4yVFds.jpg', 0, 12.00, 1),
(44, NULL, NULL, 'Alicafe', 'uploads/1744281445_Alicafe.jpg', 0, 14.00, 1),
(45, NULL, NULL, 'Gala caffe', 'uploads/1744281600_Gala Caffe.jpg', 0, 11.00, 1),
(46, NULL, NULL, 'Green Tea', 'uploads/1744281638_3.jpg', 0, 10.00, 1),
(47, NULL, NULL, 'Black coffee', 'uploads/1744281656_5.jpg', 0, 8.00, 1),
(48, NULL, NULL, 'Brown Coffee', 'uploads/1744281677_6.jpg', 0, 9.00, 1),
(49, NULL, NULL, 'Black coffee', 'uploads/1744281697_7.jpg', 0, 7.00, 1),
(50, NULL, NULL, 'White caffee', 'uploads/1744281730_2.jpg', 0, 5.00, 1),
(51, NULL, NULL, 'Good day coffee', 'uploads/1744281750_8.jpg', 0, 2.00, 1),
(54, NULL, NULL, 'MC coffee', 'uploads/1744292895_McCafe_Products.jpg', 0, 3.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'uploads/qr_codes/qr_code_1744337744.jpg', '2025-04-07 03:51:18', '2025-04-11 02:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `sale_date` datetime DEFAULT current_timestamp(),
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `sale_date`, `total_price`) VALUES
(102, '2025-04-10 20:25:38', 7),
(103, '2025-04-10 20:26:02', 4),
(104, '2025-04-10 20:26:15', 6),
(105, '2025-04-10 20:26:28', 12),
(106, '2025-04-10 20:32:46', 7),
(107, '2025-04-10 20:33:15', 4),
(108, '2025-04-10 20:34:03', 1),
(109, '2025-04-10 20:34:12', 1),
(110, '2025-04-10 20:56:05', 16),
(111, '2025-04-11 07:38:36', 5),
(112, '2025-04-11 08:44:19', 1),
(113, '2025-04-11 08:45:17', 1),
(114, '2025-04-11 09:02:07', 1),
(115, '2025-04-11 09:11:52', 2),
(116, '2025-04-11 09:15:20', 7),
(117, '2025-04-11 09:15:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`sale_item_id`, `sale_id`, `product_id`, `quantity`) VALUES
(119, 102, 55, 4),
(120, 102, 56, 3),
(121, 103, 61, 2),
(122, 104, 58, 3),
(123, 105, 60, 4),
(124, 106, 55, 4),
(125, 106, 56, 1),
(126, 106, 57, 1),
(127, 107, 56, 4),
(128, 108, 55, 1),
(129, 109, 56, 1),
(130, 110, 62, 4),
(131, 110, 64, 4),
(132, 111, 56, 5),
(133, 112, 55, 1),
(134, 113, 55, 1),
(135, 114, 55, 1),
(136, 115, 55, 1),
(137, 115, 56, 1),
(138, 116, 55, 7),
(139, 117, 55, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sessions_ID` int(11) NOT NULL,
  `admin_ID` int(11) DEFAULT NULL,
  `session_token` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_lists`
--

CREATE TABLE `stock_lists` (
  `stock_list_id` int(11) NOT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_lists`
--

INSERT INTO `stock_lists` (`stock_list_id`, `purchase_item_id`, `product_id`, `quantity`, `status`, `date`) VALUES
(39, 42, NULL, 0, 0, '2025-04-10 17:34:38'),
(40, 44, NULL, 6, 0, '2025-04-10 20:57:13'),
(41, 45, NULL, 2, 0, '2025-04-10 20:27:01'),
(42, 46, NULL, 4, 0, '2025-04-10 17:43:33'),
(44, 49, NULL, 2, 0, '2025-04-10 20:26:43'),
(45, 48, NULL, 2, 0, '2025-04-10 20:27:01'),
(46, 51, NULL, 1, 0, '2025-04-10 20:27:01'),
(47, 54, NULL, 1, 0, '2025-04-10 20:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone_number`, `address`) VALUES
(44, 'Rachana.Chhum', '0884123745', 'Phnom Penh'),
(45, 'Chea', '0884123745', 'Phnom Penh'),
(46, 'Morn Soda', '099861664', 'Sangkat Tuek Thla'),
(47, 'Kosal', '099861664', 'Sangkat Tuek Thla'),
(48, 'Pich', '099861664', 'Sangkat Tuek Thla');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(1, 'packet'),
(2, 'kg'),
(3, 'liter'),
(4, 'g'),
(5, 'Glass'),
(6, 'Cans');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`password_reset_ID`),
  ADD KEY `admin_ID` (`admin_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `Category_id` (`Category_id`);

--
-- Indexes for table `profile_updates`
--
ALTER TABLE `profile_updates`
  ADD PRIMARY KEY (`profile_update_ID`),
  ADD KEY `admin_ID` (`admin_ID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_ID`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`purchase_item_id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_purchase_items_store_unit` (`store_unit`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`sale_item_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessions_ID`),
  ADD KEY `admin_ID` (`admin_ID`);

--
-- Indexes for table `stock_lists`
--
ALTER TABLE `stock_lists`
  ADD PRIMARY KEY (`stock_list_id`),
  ADD KEY `purchase_item_id` (`purchase_item_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `password_reset_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `profile_updates`
--
ALTER TABLE `profile_updates`
  MODIFY `profile_update_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `purchase_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `sessions_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_lists`
--
ALTER TABLE `stock_lists`
  MODIFY `stock_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`admin_ID`) REFERENCES `admins` (`admin_ID`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `categories` (`Category_id`) ON DELETE SET NULL;

--
-- Constraints for table `profile_updates`
--
ALTER TABLE `profile_updates`
  ADD CONSTRAINT `profile_updates_ibfk_1` FOREIGN KEY (`admin_ID`) REFERENCES `admins` (`admin_ID`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `fk_purchase_items_store_unit` FOREIGN KEY (`store_unit`) REFERENCES `unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_items_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_ID`),
  ADD CONSTRAINT `purchase_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_ID`);

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_ID`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`admin_ID`) REFERENCES `admins` (`admin_ID`) ON DELETE CASCADE;

--
-- Constraints for table `stock_lists`
--
ALTER TABLE `stock_lists`
  ADD CONSTRAINT `stock_lists_ibfk_1` FOREIGN KEY (`purchase_item_id`) REFERENCES `purchase_items` (`purchase_item_id`),
  ADD CONSTRAINT `stock_lists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
