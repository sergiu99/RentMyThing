-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2017 at 09:13 PM
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
(1, 5, 'Harry Potter', 'its a book', 'images/book.png', 1, 13, NULL, 'enabled'),
(2, 6, 'Jigly Book', 'iz a book', 'images/noimage.png', 40, 18, NULL, 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `redirect` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 6, 1, '2017-11-23', '2017-11-17', 7, 'pending'),
(3, 6, 2, '2017-11-23', '2017-11-29', 280, 'accepted');

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
(2, 'I need yo help', 'check yo privliges son', 'Low', 6, ''),
(3, 'fEEwf', 'SFSFD', 'Medium', 6, ''),
(4, 'Kirill has pipi on his face', 'Help me  now!', 'High', 6, ''),
(5, 'dsasdas', 'dasdasd', 'High', 6, 'open');

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
  `phone_number` int(10) DEFAULT NULL,
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
(1, 'user1@email.com', 'Jon', '$2y$10$9LOAGlVIjL4eqms18B3XW.3u187XwVTmI/xQDVbsKGQ7v6mhGKJ82', '', '', 0, '2017-10-26 18:58:20', ' ', '', '', '', 0, 0, 0, 'active'),
(2, 'user2@email.com', 'Jake', '$2y$10$xXdcyTvrW/xR7zPf7C/C7.lN5bwMWU6.cH3aMVKKzPcWFXVJSQ9U6', 'Jake', 'Mo', 0, '2017-10-26 18:58:20', ' ', '', '', '', 0, 0, 0, 'active'),
(5, 'user3@yahoo.com', 'dasd', '$2y$10$oYiUZ8cGSOgOfqCNnfJ8IupiXQfuYQf1f8Za295b3PSId5nfvwyT.', 'dasd', 'asdsad', 234234, '2017-10-26 19:40:24', 'asdasd ', '', 'h4b1t2', '', 0, 0, 0, 'active'),
(6, 'user5@yahoo.com', 'Johny bravo', '$2y$10$5pjOkt4g3tlpn20nIvCmTuLoc0sdNxgRujRU77GuAMZrtOw3/LQrW', 'fiasdmo', 'asddalsdlsad', 2147483647, '2017-10-30 18:21:15', '123123 124213', 'montreal', 'h4b2w8', 'qyebec', 0, 0, 0, 'active'),
(7, 'clement@email.com', 'Clement Potteck', '$2y$10$ejPIwySjs5xykhd1DszybeK0ylTf78m.2UMxIDXlkNq5lqrsodniW', 'Clement', 'Potteck', 2147483647, '2017-11-22 16:52:41', '5555 Street', 'Montreal', 'H5H4H2', 'QC', 0, 0, 0, 'active'),
(8, 'jiojdieoaijdo@hotmail.com', 'freddy kruegger', '$2y$10$1R631JdsO8s5ebXYF2jNWOvfqe3j92kT9p6PhvuElZ0lLi1Np8mZ.', 'Jerry', 'Brown', 2147483647, '2017-11-23 20:07:11', '4129943343 rehicashi', 'montreal', 'H4B2W9', 'quebec', 0, 0, 0, 'active'),
(9, 'superman@yahoo.com', 'superman', '$2y$10$Fe.7c9ywliLriL32roexNuRWCglikXEE9pIo0JXYF/4CaAoIzWc7q', 'JERRY', 'krueg', 123213, '2017-11-23 20:07:38', '43', 'montreal', 'H4B2W9', 'quebec', 0, 0, 0, 'active');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
