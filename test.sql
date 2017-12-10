-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2017 at 09:06 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Clothing'),
(2, 'Arts & Collectibles'),
(3, 'Furniture'),
(5, 'Other'),
(6, 'Sporting Goods & Exercise'),
(7, 'Books'),
(8, 'Toys & Games'),
(9, 'Electronics'),
(10, 'Home Appliances'),
(11, 'Home Outdoor'),
(12, 'Video Games & Consoles'),
(13, 'Home Renovation Materials'),
(14, 'Phones'),
(15, 'Tools'),
(16, 'Computer Accessories'),
(17, 'Hobbies & Crafts'),
(18, 'Musical Instruments'),
(19, 'Jewellery & Watches'),
(20, 'CDs, DVDs & Blu-ray'),
(21, 'Bikes'),
(22, 'Business & Industrial'),
(23, 'Health & Special Needs'),
(24, 'Audio'),
(25, 'Cameras & Camcorders'),
(26, 'Computers'),
(27, 'TVs & Video'),
(28, 'Cars'),
(29, 'Property'),
(30, 'Home Rentals');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `poster_status` varchar(15) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `rental_id`, `poster_status`, `content`, `rating`) VALUES
(1, 5, '6', 'This item was pretty good to rent.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `rating` int(5) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'enabled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `user_id`, `name`, `description`, `image_path`, `price`, `category`, `rating`, `status`) VALUES
(1, 5, 'Harry Potter', 'Its a book', 'images/book.png', 1, 7, NULL, 'enabled'),
(2, 6, 'Jigly Book', 'It has a slight smell of vanilla', 'images/noimage.png', 40, 18, NULL, 'enabled'),
(3, 6, 'Wrench ', 'You know what your looking for', 'images/3.jpg', 15, 15, NULL, 'enabled'),
(4, 6, 'Flamboyant Bike', 'You will look very cool', 'images/4.jpeg', 50, 11, NULL, 'enabled'),
(5, 10, 'Cart', 'You can carry stuff in it ', 'images/5.jpg', 23, 15, NULL, 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `rental_id`, `sender_id`, `created_on`, `content`) VALUES
(1, 2, 7, '2017-11-24 16:42:38', 'fgdfg'),
(2, 2, 7, '2017-11-24 16:42:42', 'gfhfgh'),
(3, 2, 7, '2017-11-24 16:58:10', 'hello'),
(4, 2, 7, '2017-11-24 16:58:14', 'hello'),
(5, 2, 7, '2017-11-24 16:58:39', 'hello'),
(6, 2, 7, '2017-11-24 17:15:08', 'sdfsdf'),
(7, 2, 7, '2017-11-24 17:30:37', 'dfhfhjg'),
(8, 2, 7, '2017-11-24 17:30:39', 'ghjghj'),
(9, 2, 7, '2017-11-24 17:30:56', 'gfhfghffgh'),
(10, 2, 7, '2017-11-24 17:30:57', 'hfghfg'),
(11, 2, 7, '2017-11-24 17:30:58', 'fghfgh'),
(12, 2, 7, '2017-11-24 17:30:59', 'fghfgh'),
(13, 2, 7, '2017-11-24 17:31:03', 'fgjghjg'),
(14, 2, 7, '2017-11-24 17:31:04', 'ghjgh'),
(15, 2, 7, '2017-11-24 17:31:07', 'ghjfgf'),
(16, 2, 7, '2017-11-24 17:31:11', 'fghfhjgd'),
(17, 2, 7, '2017-11-24 17:31:14', 'hfghfg'),
(18, 2, 7, '2017-11-24 17:31:16', 'sds'),
(19, 2, 7, '2017-11-24 17:31:18', 'fgdf'),
(20, 2, 7, '2017-11-24 17:31:22', 'sdfsd'),
(21, 2, 7, '2017-11-24 17:31:24', 'dfgdfg'),
(22, 2, 7, '2017-11-24 17:31:25', 'sdfsdf'),
(23, 2, 7, '2017-11-24 17:31:26', 'sdfsdf'),
(24, 2, 7, '2017-11-24 17:31:28', 'sdfsdf'),
(25, 2, 2, '2017-11-24 17:45:10', 'sdfsdf'),
(26, 2, 7, '2017-11-24 17:31:30', 'sdfsdf'),
(27, 2, 7, '2017-11-24 17:31:31', 'sdfsdf'),
(28, 2, 7, '2017-11-24 17:31:32', 'sdfsdf'),
(29, 2, 7, '2017-11-24 17:31:33', 'sdfsd'),
(30, 2, 7, '2017-11-24 17:31:34', 'sdfsdf'),
(31, 2, 7, '2017-11-24 17:31:36', 'sdfsd'),
(32, 2, 7, '2017-11-24 17:34:59', ';drop table message;'),
(33, 2, 2, '2017-11-24 17:40:49', 'msfsdjfgsdfashd'),
(34, 3, 6, '2017-11-28 02:37:31', 'asd'),
(35, 3, 6, '2017-11-28 02:37:33', 'dasdasd'),
(36, 6, 6, '2017-11-28 02:37:37', 'sadasd'),
(37, 3, 6, '2017-11-28 02:37:43', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `redirect` varchar(100) NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `content`, `created_on`, `redirect`, `viewed`) VALUES
(2, 6, 'One of your rentals has been completed', '2017-11-28 02:23:58', '/Rentals', 0),
(3, 6, 'Someone wants to rent your Jigly Book item.', '2017-11-28 02:33:05', '/Rentals', 0),
(4, 6, 'Someone wants to rent your Jigly Book item.', '2017-11-28 02:34:16', '/Rentals', 0),
(5, 5, 'Someone wants to rent your Harry Potter item.', '2017-11-30 17:42:58', '/Rentals', 0),
(6, 6, 'One of your rentals has been terminated before starting', '2017-11-30 17:43:06', '/Rentals', 0),
(7, 6, 'One of your rentals has been terminated before starting', '2017-11-30 17:43:07', '/Rentals', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `user_id`, `item_id`, `start_date`, `end_date`, `total`, `status`) VALUES
(2, 6, 1, '2017-11-23', '2017-11-17', 7, 'cancelled'),
(3, 6, 2, '2017-11-23', '2017-11-29', 280, 'accepted'),
(4, 7, 2, '2017-11-24', '2017-11-27', 160, 'pending'),
(5, 6, 2, '2017-11-26', '2017-11-30', 200, 'completed'),
(6, 6, 2, '2017-11-27', '2017-11-29', 120, 'pending'),
(7, 6, 2, '2017-11-27', '2017-11-29', 120, 'pending'),
(8, 6, 1, '2017-11-30', '2017-12-21', 22, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `urgency` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `description`, `urgency`, `user_id`, `status`) VALUES
(2, 'I need yo help', 'check yo privliges son', 'Low', 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `email` varchar(72) NOT NULL,
  `display_name` varchar(72) NOT NULL,
  `password` varchar(72) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `street_address` varchar(255) DEFAULT NULL,
  `city_address` varchar(20) DEFAULT NULL,
  `postal_code_address` varchar(6) NOT NULL,
  `province_address` varchar(20) DEFAULT NULL,
  `show_phone` tinyint(1) NOT NULL DEFAULT '0',
  `show_email` tinyint(1) NOT NULL DEFAULT '0',
  `show_address` tinyint(1) NOT NULL DEFAULT '0',
  `account_status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `email`, `display_name`, `password`, `first_name`, `last_name`, `phone_number`, `join_date`, `street_address`, `city_address`, `postal_code_address`, `province_address`, `show_phone`, `show_email`, `show_address`, `account_status`) VALUES
(1, 'user1@email.com', 'Jon', '$2y$10$9LOAGlVIjL4eqms18B3XW.3u187XwVTmI/xQDVbsKGQ7v6mhGKJ82', '', '', '0', '2017-10-26 18:58:20', ' ', '', '', '', 0, 0, 0, 'active'),
(2, 'user2@email.com', 'Jake', '$2y$10$xXdcyTvrW/xR7zPf7C/C7.lN5bwMWU6.cH3aMVKKzPcWFXVJSQ9U6', 'Jake', 'Mo', '0', '2017-10-26 18:58:20', ' ', '', '', '', 0, 0, 0, 'active'),
(5, 'user3@yahoo.com', 'curlyburry', '$2y$10$oYiUZ8cGSOgOfqCNnfJ8IupiXQfuYQf1f8Za295b3PSId5nfvwyT.', 'Vasinlerh', 'Hueld', '5145169584', '2017-10-26 19:40:24', '21374 Sherbrooke ', 'Montreal', 'H4B1T8', 'Quebec', 0, 0, 0, 'active'),
(6, 'user5@yahoo.com', 'Johny bravo', '$2y$10$5pjOkt4g3tlpn20nIvCmTuLoc0sdNxgRujRU77GuAMZrtOw3/LQrW', 'Johny ', 'Bravo', '2147483647', '2017-10-30 18:21:15', '9393 Saint-Jacque', 'Montreal', 'H4B2W8', 'Quebec', 0, 0, 0, 'active'),
(7, 'clement@email.com', 'Clement Potteck', '$2y$10$ejPIwySjs5xykhd1DszybeK0ylTf78m.2UMxIDXlkNq5lqrsodniW', 'Clement', 'Potteck', '2147483647', '2017-11-22 16:52:41', '5555 Street', 'Montreal', 'H5H4H2', 'QC', 0, 0, 0, 'active'),
(10, 'user6@yahoo.com', 'therulerofearth', '$2y$10$jir6tVprmUFHEsOvBWU/1OVbK3.HpcZOKQE5wZFcKW27439HuBrZG', 'Genghis', 'Khan', '5145932323', '2017-11-30 17:57:51', '2154 Mongolia Avenue', 'Montreal', 'H4B1J8', 'Quebec', 0, 0, 0, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_rental_id_fk` (`rental_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorite_item_id_fk` (`item_id`),
  ADD KEY `favorite_user_id_fk` (`user_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_category_fk` (`category`),
  ADD KEY `item_user_id_fk` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_rental_id_fk` (`rental_id`),
  ADD KEY `message_sender_id_fk` (`sender_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_user_id_fk` (`user_id`),
  ADD KEY `rental_item_id_fk` (`item_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `display_name` (`display_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_rental_id_fk` FOREIGN KEY (`rental_id`) REFERENCES `rental` (`id`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `favorite_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_category_fk` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `item_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_rental_id_fk` FOREIGN KEY (`rental_id`) REFERENCES `rental` (`id`),
  ADD CONSTRAINT `message_sender_id_fk` FOREIGN KEY (`sender_id`) REFERENCES `user` (`ID`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`);

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `rental_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;