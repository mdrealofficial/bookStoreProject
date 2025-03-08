-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 02:17 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Author Name 1', 'author1@example.com', '2024-12-31 04:00:00', '2024-12-31 04:00:00'),
(2, 'Author Name 2', 'author2@example.com', '2024-12-31 04:01:00', '2024-12-31 04:01:00'),
(3, 'Author Name 3', 'author3@example.com', '2024-12-31 04:02:00', '2024-12-31 04:02:00'),
(4, 'Author Name 4', 'author4@example.com', '2024-12-31 04:03:00', '2024-12-31 04:03:00'),
(5, 'Author Name 5', 'author5@example.com', '2024-12-31 04:04:00', '2024-12-31 04:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `price`, `stock_quantity`, `author_id`, `created_at`, `updated_at`) VALUES
(2, 'Book Title 2', '25.49', 15, 2, '2024-12-31 04:01:00', '2024-12-31 04:01:00'),
(3, 'Book Title 3', '15.75', 10, 3, '2024-12-31 04:02:00', '2024-12-31 04:02:00'),
(5, 'Book Title 5', '30.00', 12, 5, '2024-12-31 04:04:00', '2024-12-31 04:04:00'),
(14, 'Book Title 4', '45.30', 25, 4, '2024-12-31 04:03:00', '2025-01-07 17:12:08'),
(16, 'Test Book Title', '100.00', 5, 2, '2025-01-14 15:40:37', '2025-01-14 15:40:37'),
(17, 'Test Book Title', '100.00', 5, 2, '2025-01-14 15:43:12', '2025-01-14 15:43:12'),
(18, 'Test Book Title OOP', '200.78', 5, 2, '2025-01-14 16:54:42', '2025-01-14 16:54:42'),
(19, 'This a test Title', '300.00', 4, 3, '2025-01-14 16:59:54', '2025-01-14 16:59:54'),
(20, 'My Postman Title', '120.00', 23, 2, '2025-01-14 17:12:26', '2025-01-14 17:12:26'),
(21, 'My Postman Title Secure', '12045.00', 232, 2, '2025-01-14 17:39:20', '2025-01-14 17:39:20'),
(22, 'Test', '23.00', 2, 2, '2025-01-14 17:43:59', '2025-01-14 17:43:59'),
(23, '0', '23.00', 2, 2, '2025-01-14 17:54:32', '2025-01-14 17:54:32'),
(24, '0', '0.00', 2, 2, '2025-01-14 17:58:23', '2025-01-14 17:58:23'),
(25, '0', '19.99', 20, 1, '2025-01-14 18:10:30', '2025-01-14 18:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Customer Name 1', 'customer1@example.com', '1234567890', '2024-12-31 04:00:00', '2024-12-31 04:00:00'),
(2, 'Customer Name 2', 'customer2@example.com', '12345678978', '2024-12-31 04:01:00', '2025-01-07 17:15:32'),
(4, 'Customer Name 4', 'customer4@example.com', '1234567893', '2024-12-31 04:03:00', '2024-12-31 04:03:00'),
(5, 'Customer Name 5', 'customer5@example.com', '1234567894', '2024-12-31 04:04:00', '2024-12-31 04:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_amount`, `created_at`, `updated_at`) VALUES
(2, 2, '2024-12-31 10:01:00', '75.30', '2024-12-31 04:01:00', '2024-12-31 04:01:00'),
(4, 4, '2024-12-31 10:03:00', '55.00', '2024-12-31 04:03:00', '2024-12-31 04:03:00'),
(19, 1, '2025-02-27 18:39:19', '65.00', '2025-02-27 12:39:19', '2025-02-27 12:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `line_total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `book_id`, `quantity`, `line_total`, `created_at`, `updated_at`) VALUES
(3, 2, 14, 1, '45.30', '2024-12-31 04:02:00', '2024-12-31 04:02:00'),
(4, 2, 2, 2, '50.98', '2024-12-31 04:03:00', '2024-12-31 04:03:00'),
(10, 19, 5, 2, '40.00', '2025-02-27 12:39:19', '2025-02-27 12:39:19'),
(11, 19, 18, 1, '25.00', '2025-02-27 12:39:19', '2025-02-27 12:39:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
