-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2019 at 05:14 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Admin', 'admin', '$2y$10$sX16GpufmWhQjURNukV4juu3tuG3LIECr6xk1oORuDVB1Gytu.LOi');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `date`, `deleted`) VALUES
(1, 'My Album', '2018-09-22 12:35:29', 0),
(3, 'Christmas Album', '2018-09-22 15:22:18', 0),
(4, 'New Year Eve 2019', '2018-09-22 17:09:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Mo:Mo', 'Dumpling Balls'),
(2, 'Pizza', 'Pie Chart'),
(3, 'Chowmin', 'Long Noodles'),
(4, 'Pancakes', 'Fat Weird Roti'),
(5, 'Burger', 'You\'ll Love it');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'David', 'KTM', '123123', 'p@g.c'),
(2, 'Bob', 'BKT', '093939', 'bob@yah.vom'),
(6, 'Mike', 'Lalitpur', '128937', 'masn@asd.c');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `today` tinyint(1) NOT NULL DEFAULT '0',
  `total_sales` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `category_id`, `description`, `price`, `special`, `today`, `total_sales`) VALUES
(1, 'Veg Mo:Mo', 1, 'For Vegetarians ', 60, 0, 1, 0),
(2, 'Chicken Mo:Mo', 1, 'Non-Veg mo:mo with Chicken', 100, 0, 1, 0),
(3, 'Cheese Pizza', 2, 'Cheesy', 150, 0, 1, 0),
(4, 'Chicken Pizza', 2, 'Pizza with Chicken', 200, 0, 1, 0),
(5, 'Banana Pancake', 4, 'Pancake with Banana Jammed Inside', 60, 1, 1, 0),
(6, 'Chicken C - Mo:Mo', 1, 'More Mo:Mo More C', 180, 0, 0, 0),
(7, 'Veg Chowmin', 3, 'Why not a Cola with it?', 70, 0, 1, 0),
(8, 'Mo:Mo + Coke + Chicken C', 1, 'Combo Pack Special Offer Mo:Mo + Coke + Chicken Chilli', 180, 1, 1, 0),
(11, 'Ham Burger', 5, 'Hammed', 80, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `date`) VALUES
(1, 'Niush', 'n@g.c', 'asdfjas daksd aklsdasd alksdn\r\nasdas das\r\ndas dasd', '2018-09-18 01:48:49'),
(2, 'Niush', 'n@g.c', 'akjdnfas dfkjsd fsd\r\nfsd fsdf sdf\r\nsdf s\r\ndf', '2018-09-18 01:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `items` text NOT NULL,
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `delivery_boy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `items`, `status`, `delivery_boy`) VALUES
(1, 1, '\"[{\\\"id\\\":8,\\\"name\\\":\\\"Mo:Mo + Coke + Chicken C\\\",\\\"category\\\":\\\"Mo:Mo\\\",\\\"description\\\":\\\"Combo Pack Special Offer Mo:Mo + Coke + Chicken Chilli\\\",\\\"price\\\":180,\\\"special\\\":1,\\\"quantity\\\":1},{\\\"id\\\":5,\\\"name\\\":\\\"Banana Pancake\\\",\\\"category\\\":\\\"Pancakes\\\",\\\"description\\\":\\\"Pancake with Banana Jammed Inside\\\",\\\"price\\\":60,\\\"special\\\":1,\\\"quantity\\\":1},{\\\"id\\\":7,\\\"name\\\":\\\"Veg Chowmin\\\",\\\"category\\\":\\\"Chowmin\\\",\\\"description\\\":\\\"Why not a Cola with it?\\\",\\\"price\\\":70,\\\"special\\\":0,\\\"quantity\\\":5}]\"', '4', 2),
(2, 1, '\"[{\\\"id\\\":8,\\\"name\\\":\\\"Mo:Mo + Coke + Chicken C\\\",\\\"category\\\":\\\"Mo:Mo\\\",\\\"description\\\":\\\"Combo Pack Special Offer Mo:Mo + Coke + Chicken Chilli\\\",\\\"price\\\":180,\\\"special\\\":1,\\\"quantity\\\":10}]\"', '4', 2),
(3, 1, '\"[{\\\"id\\\":8,\\\"name\\\":\\\"Mo:Mo + Coke + Chicken C\\\",\\\"category\\\":\\\"Mo:Mo\\\",\\\"description\\\":\\\"Combo Pack Special Offer Mo:Mo + Coke + Chicken Chilli\\\",\\\"price\\\":180,\\\"special\\\":1,\\\"quantity\\\":3},{\\\"id\\\":5,\\\"name\\\":\\\"Banana Pancake\\\",\\\"category\\\":\\\"Pancakes\\\",\\\"description\\\":\\\"Pancake with Banana Jammed Inside\\\",\\\"price\\\":60,\\\"special\\\":1,\\\"quantity\\\":2},{\\\"id\\\":7,\\\"name\\\":\\\"Veg Chowmin\\\",\\\"category\\\":\\\"Chowmin\\\",\\\"description\\\":\\\"Why not a Cola with it?\\\",\\\"price\\\":70,\\\"special\\\":0,\\\"quantity\\\":1}]\"', '2', 2),
(4, 3, '\"[{\\\"id\\\":5,\\\"name\\\":\\\"Banana Pancake\\\",\\\"category\\\":\\\"Pancakes\\\",\\\"description\\\":\\\"Pancake with Banana Jammed Inside\\\",\\\"price\\\":60,\\\"special\\\":1,\\\"quantity\\\":4},{\\\"id\\\":3,\\\"name\\\":\\\"Cheese Pizza\\\",\\\"category\\\":\\\"Pizza\\\",\\\"description\\\":\\\"Cheesy\\\",\\\"price\\\":150,\\\"special\\\":0,\\\"quantity\\\":4}]\"', '2', 6),
(5, 1, '\"[{\\\"id\\\":5,\\\"name\\\":\\\"Banana Pancake\\\",\\\"category\\\":\\\"Pancakes\\\",\\\"description\\\":\\\"Pancake with Banana Jammed Inside\\\",\\\"price\\\":60,\\\"special\\\":1,\\\"quantity\\\":3},{\\\"id\\\":8,\\\"name\\\":\\\"Mo:Mo + Coke + Chicken C\\\",\\\"category\\\":\\\"Mo:Mo\\\",\\\"description\\\":\\\"Combo Pack Special Offer Mo:Mo + Coke + Chicken Chilli\\\",\\\"price\\\":180,\\\"special\\\":1,\\\"quantity\\\":3},{\\\"id\\\":11,\\\"name\\\":\\\"Ham Burger\\\",\\\"category\\\":\\\"Burger\\\",\\\"description\\\":\\\"Hammed\\\",\\\"price\\\":80,\\\"special\\\":0,\\\"quantity\\\":1}]\"', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `name`, `url`, `album_id`) VALUES
(1, 'First Photo', 'photo_gallery_1.jpg', 1),
(2, 'Second Photo', 'photo_gallery_2.jpg', 1),
(3, '1537624953_bg1.jpg', '1537624953_bg1.jpg', 1),
(4, '1537624953_face.jpg', '1537624953_face.jpg', 1),
(5, '1537625036_bg.jpg', '1537625036_bg.jpg', 1),
(6, '1537629738_2.png', '1537629738_2.png', 3),
(7, '1537629738_bg.jpg', '1537629738_bg.jpg', 3),
(8, '1537630369_1.jpg', '1537630369_1.jpg', 3),
(9, '1537636198_01_ChasmJump.png', '1537636198_01_ChasmJump.png', 4),
(10, '1537636198_03_PalmKicker.png', '1537636198_03_PalmKicker.png', 4),
(11, '1537636198_05_WaterDive.png', '1537636198_05_WaterDive.png', 4),
(12, '1537636198_b01_Roof.png', '1537636198_b01_Roof.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `date` date NOT NULL,
  `time` varchar(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `seats` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `date`, `time`, `name`, `seats`, `seat_id`, `status`) VALUES
(1, 1, '2019-01-01', '15.00', 'Bro', 4, 19, 1),
(3, 1, '2019-01-01', '16.00', 'David', 4, 14, 1),
(4, 1, '2018-01-01', '15.00', 'David', 4, 27, 0),
(5, NULL, '2018-09-20', '13.30', 'Dave', 5, 13, 0),
(6, 1, '2018-09-27', '10.00', 'shankar', 5, 21, 0),
(7, NULL, '2018-09-23', '18.00', 'nisha', 4, 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `contact`, `email`, `password`, `address`, `city`, `street`, `verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Niush', 'Sitaula', '29034', 'n@g.c', '$2y$10$AcKvq7PpUqq1rG5Y66jXzOdmcjMlL.H5SDWYejn0FLA21xTRJgljC', 'bkt', 'bo', 'pl', 0, 'EGdEpGhpsWlg6AF2CIX6MMTmOy8pjDNKgcf4PXVVwSUTuo6S2EE17oMlgAFc', '2018-09-16 01:18:33', '2018-09-16 01:18:33'),
(2, 'ribesh', 'ribesh', '23456789', 'ribesh@gmail.com', '$2y$10$gdA3KtiDeWOIr0H6O31VnOkrC2SPxW17XoB9ixeeT9FdzAwGi4/6e', 'baneshwor', 'kathmandu', 'skfbf', 0, NULL, '2018-09-18 05:28:56', '2018-09-18 05:28:56'),
(3, 'nisha', 'nisha', '984656798', 'nisha.s@gmail.com', '$2y$10$Eyb7PYMqBVAq9l.i/iDX0.wRinhZN5qYc9ly9Dz9z3h.0NAqZFAFe', 'Bhaktapur', 'Bode Planning', 'Sintitar', 0, 'tBSZZiBAwDJMHNqvvUKG4LyeaYkeOI99mQfowM8yNWvZNTrVf8cXkqUtgWta', '2018-09-21 22:23:08', '2018-09-21 22:23:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `delivery_boy` (`delivery_boy`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
