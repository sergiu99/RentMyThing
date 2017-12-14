-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2017 at 06:47 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(1, 5, '6', 'This item was pretty good to rent.', 4),
(2, 14, '6', 'Great Stuff!', 5),
(4, 16, '6', 'Not bad...', 3),
(5, 9, '6', 'akdhfksdf', 2),
(6, 18, '6', 'TEST COMMENT', 1),
(7, 19, '6', 'jfhgfjhmgilj', 1),
(8, 20, '6', 'Trash', 1),
(9, 21, '6', 'Meh', 2),
(10, 22, '6', 'Great!', 5),
(11, 23, '6', 'Great Again!', 5),
(12, 24, '6', 'Great Again Again', 5),
(13, 25, '6', 'Great Again hope it works ...', 5),
(14, 30, '6', 'dgdfg', 5),
(15, 39, '7', 'mnb\r\n', 5),
(16, 41, '35', 'Very nice condition for low price. Recommended! Owner is also very flexible with item pickup and return location and time.', 5),
(17, 47, '7', 'Book was in mediocre condition. Maybe damaged by previous renter? In any case, the owner did not verify the condition before renting it out and refuses to give me a discount.', 1),
(18, 45, '35', 'doesnt exist', 3);

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
(1, 6, 'Harry Potter', 'Its a book about harry potter', 'images/book.png', 1, 1, NULL, 'enabled'),
(2, 6, 'hjghjg', 'bnjkhjkhjk', 'images/noimage.png', 400, 1, NULL, 'deleted'),
(3, 6, 'Wrench ', 'You know what your looking for', 'images/3.jpg', 15, 15, 4, 'enabled'),
(4, 6, 'Flamboyant Bike', 'You will look very cool', 'images/4.jpeg', 50, 11, NULL, 'deleted'),
(5, 10, 'Cart', 'You can carry stuff in it ', 'images/5.jpg', 23, 15, NULL, 'enabled'),
(6, 7, 'TEST', 'Its a test', 'images/6.jpg', 5000, 1, 3, 'deleted'),
(8, 7, 'ghjg', 'hvjg', 'images/8.png', 58, 1, NULL, 'deleted'),
(9, 6, 'sdfsd', 'sdfsdf', 'images/9.jpg', 500, 1, NULL, 'deleted'),
(10, 6, 'Bike', 'You can ride it', 'images/10.jpeg', 500, 21, NULL, 'deleted'),
(11, 6, 'Bike', 'Its a bike, you can ride it', 'images/11.jpeg', 500, 21, NULL, 'enabled'),
(12, 31, 'Calculus textbook', 'Its a textbook', 'images/12.png', 5, 7, 3, 'disabled'),
(13, 31, 'HP Laptop', 'Laptop for school & studying', 'images/13.png', 30, 9, NULL, 'disabled'),
(14, 35, 'Calculus textbook', 'Perfect condition, cal 1 & 2', 'images/14.png', 10, 7, NULL, 'enabled');

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
(37, 3, 6, '2017-11-28 02:37:43', 'd'),
(38, 12, 6, '2017-12-08 22:49:22', 'khsdkjf skdjhfkjsdf ksjfhjksdhf kdfhsjdhfskdf sdhfsjdkfsdf'),
(39, 14, 6, '2017-12-09 02:33:25', 'Hey thanks for the rental!'),
(40, 14, 7, '2017-12-09 02:48:08', 'yeah np'),
(41, 14, 7, '2017-12-09 02:48:32', 'aksjfhsdkf k jskdjf kj hksjdf'),
(42, 14, 7, '2017-12-09 02:48:38', 'sdfsdgdfh  h dfdg gd'),
(43, 14, 7, '2017-12-09 02:54:28', 'teststets teas s'),
(44, 14, 7, '2017-12-09 02:54:35', 'hhfrjjfdddds'),
(45, 14, 6, '2017-12-09 02:55:04', 'dfghfg'),
(46, 14, 6, '2017-12-09 02:55:07', 'dsfsdfsd'),
(47, 14, 6, '2017-12-09 03:01:16', 'Hello'),
(48, 14, 7, '2017-12-09 03:02:02', 'message from owner'),
(49, 14, 6, '2017-12-09 03:03:35', 'Should be working now'),
(50, 22, 6, '2017-12-10 01:00:20', 'Chat'),
(51, 22, 6, '2017-12-10 01:00:25', 'Chat'),
(52, 22, 6, '2017-12-10 01:00:30', 'Chat'),
(53, 22, 7, '2017-12-10 01:24:19', 'Chat'),
(54, 22, 7, '2017-12-10 01:24:23', 'Chat'),
(55, 22, 7, '2017-12-10 01:24:26', 'Chat'),
(56, 22, 7, '2017-12-10 01:33:50', 'chat'),
(57, 22, 7, '2017-12-10 01:35:28', 'd'),
(58, 22, 7, '2017-12-10 01:35:28', 'f'),
(59, 22, 7, '2017-12-10 01:35:28', 'f'),
(60, 22, 7, '2017-12-10 01:35:30', 'g'),
(61, 22, 7, '2017-12-10 01:35:31', 'f'),
(62, 22, 7, '2017-12-10 01:39:10', 'asdasd'),
(63, 22, 7, '2017-12-10 01:39:13', 'fghfghfgh'),
(64, 22, 7, '2017-12-10 01:39:18', 'gjhjghj'),
(65, 22, 6, '2017-12-10 01:42:44', 'fxgdfgdfg'),
(66, 22, 6, '2017-12-10 01:42:46', 'fhjghjhjgj'),
(67, 22, 6, '2017-12-10 01:42:48', 'dhfghfgh'),
(68, 22, 7, '2017-12-10 01:45:36', 'sfgdfg'),
(69, 22, 7, '2017-12-10 01:45:37', 'fgjfhdt'),
(70, 22, 7, '2017-12-10 01:45:39', 'gdfgdfg'),
(71, 22, 7, '2017-12-10 01:45:42', 'TEST'),
(72, 22, 7, '2017-12-10 01:45:45', 'TEST2'),
(73, 22, 7, '2017-12-10 03:09:37', 'Hey testing notifications!'),
(74, 22, 7, '2017-12-10 03:10:11', 'test2'),
(75, 22, 7, '2017-12-10 03:10:16', 'test4'),
(76, 22, 7, '2017-12-10 03:10:20', 'test5'),
(77, 22, 6, '2017-12-10 03:48:57', 'sdfgfgh'),
(78, 22, 6, '2017-12-10 03:48:59', 'fghfghf'),
(79, 22, 6, '2017-12-10 03:49:01', 'fghfghf'),
(80, 22, 6, '2017-12-10 03:57:49', 'fgjfgjj'),
(81, 22, 6, '2017-12-10 03:57:51', 'fjfhjfgh'),
(82, 22, 6, '2017-12-10 03:57:52', 'fghftfhg'),
(83, 22, 6, '2017-12-10 03:57:54', 'dgfdgdfg'),
(84, 22, 6, '2017-12-10 03:58:57', 'ghfgh'),
(85, 22, 7, '2017-12-10 03:59:16', 'fdgdfgghj'),
(86, 22, 7, '2017-12-10 03:59:28', 'hkhjkfgk'),
(87, 28, 7, '2017-12-12 03:39:45', 'Hey Sup!'),
(88, 28, 6, '2017-12-12 03:40:11', 'When can I pick up the bike?'),
(89, 28, 7, '2017-12-12 03:40:52', 'skdjfskjfd'),
(90, 28, 7, '2017-12-12 03:40:53', 'slkdjflsdf'),
(91, 28, 7, '2017-12-12 03:40:54', 'sdnfksjdhf'),
(92, 28, 7, '2017-12-12 03:40:55', 'sjdfkshdf'),
(93, 28, 7, '2017-12-12 03:40:56', 'skjdfkshd'),
(94, 28, 7, '2017-12-12 03:40:58', 'sdkjfhksdh'),
(95, 28, 7, '2017-12-12 03:40:59', 'ksdjfsfdh'),
(96, 28, 7, '2017-12-12 03:41:00', 'skjdfhsk'),
(97, 28, 7, '2017-12-12 03:41:02', 'kjsdhf'),
(98, 28, 6, '2017-12-12 03:41:10', 'dssdfsdf'),
(99, 28, 7, '2017-12-12 03:45:26', 'vhnghj'),
(100, 28, 7, '2017-12-12 03:46:54', 'fghfgh'),
(101, 28, 7, '2017-12-12 03:47:08', 'sdsdfs'),
(102, 28, 7, '2017-12-12 03:47:14', 'fghghfh'),
(103, 28, 7, '2017-12-12 03:47:42', 'sdfsdf'),
(104, 28, 7, '2017-12-12 03:48:05', 'sdfsdf'),
(105, 28, 6, '2017-12-12 03:48:28', 'dfgdgdf'),
(106, 28, 7, '2017-12-12 03:51:19', 'sdfsdfs'),
(107, 28, 7, '2017-12-12 03:52:23', 'dfgdf'),
(108, 28, 7, '2017-12-12 03:53:01', 'sdfsdf'),
(109, 28, 7, '2017-12-12 03:53:53', 'njhgj'),
(110, 33, 6, '2017-12-13 18:24:32', 'fdgdf'),
(111, 31, 6, '2017-12-13 18:29:13', 'sdfjksdhf'),
(112, 41, 31, '2017-12-14 17:00:35', 'Hey Sergiu'),
(113, 41, 31, '2017-12-14 17:01:13', 'Can you see this message?'),
(114, 41, 31, '2017-12-14 17:06:21', 'Test again'),
(115, 41, 31, '2017-12-14 17:10:00', 'Testing again'),
(116, 41, 35, '2017-12-14 17:10:18', 'hey it works!'),
(117, 42, 31, '2017-12-14 17:10:40', 'Just chatting'),
(118, 42, 7, '2017-12-14 17:11:14', 'Sup'),
(119, 42, 31, '2017-12-14 17:14:42', 'sup');

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
(2, 6, 'One of your rentals has been completed', '2017-11-28 02:23:58', '/Rentals', 1),
(3, 6, 'Someone wants to rent your Jigly Book item.', '2017-11-28 02:33:05', '/Rentals', 1),
(4, 6, 'Someone wants to rent your Jigly Book item.', '2017-11-28 02:34:16', '/Rentals', 1),
(5, 5, 'Someone wants to rent your Harry Potter item.', '2017-11-30 17:42:58', '/Rentals', 0),
(6, 6, 'One of your rentals has been terminated before starting', '2017-11-30 17:43:06', '/Rentals', 1),
(7, 6, 'One of your rentals has been terminated before starting', '2017-11-30 17:43:07', '/Rentals', 1),
(8, 7, 'Someone has declined your rental request.', '2017-12-08 14:27:18', '/Rentals', 1),
(9, 6, 'Someone has declined your rental request.', '2017-12-08 14:27:20', '/Rentals', 1),
(10, 6, 'Someone has declined your rental request.', '2017-12-08 14:27:24', '/Rentals', 1),
(11, 6, 'One of your rentals needs your approval to be completed', '2017-12-08 14:27:30', '/Rentals', 1),
(12, 6, 'One of your rentals has been completed', '2017-12-08 14:27:36', '/Rentals', 1),
(13, 6, 'Someone wants to rent your Wrench  item.', '2017-12-08 14:28:40', '/Rentals', 1),
(14, 6, 'Someone has accepted your rental request.', '2017-12-08 14:28:50', '/Rentals', 1),
(15, 6, 'One of your rentals needs your approval to be completed', '2017-12-08 14:28:53', '/Rentals', 1),
(16, 6, 'One of your rentals has been completed', '2017-12-08 14:28:57', '/Rentals', 1),
(17, 5, 'Someone wants to rent your Harry Potter item.', '2017-12-08 14:45:31', '/Rentals', 0),
(18, 5, 'Someone wants to rent your Harry Potter item.', '2017-12-08 16:59:59', '/Rentals', 0),
(19, 6, 'One of your rentals has been terminated before starting', '2017-12-08 17:00:03', '/Rentals', 1),
(20, 5, 'Someone wants to rent your Harry Potter item.', '2017-12-08 17:00:17', '/Rentals', 0),
(21, 6, 'One of your rentals has been terminated before starting', '2017-12-08 17:00:22', '/Rentals', 1),
(22, 6, 'New message for the item rental Harry Potter #12', '2017-12-08 22:49:22', '/Rentals', 1),
(23, 6, 'One of your rentals has been terminated before starting', '2017-12-09 02:14:08', '/Rentals', 1),
(24, 5, 'Someone wants to rent your Harry Potter item.', '2017-12-09 02:30:58', '/Rentals', 0),
(25, 7, 'One of your rentals has been terminated before starting', '2017-12-09 02:31:28', '/Rentals', 1),
(26, 7, 'Someone wants to rent your TEST item.', '2017-12-09 02:32:48', '/Rentals', 1),
(27, 6, 'Someone has accepted your rental request.', '2017-12-09 02:33:06', '/Rentals', 1),
(28, 6, 'New message for the item rental TEST #14', '2017-12-09 02:33:25', '/Rentals', 1),
(29, 7, 'New message for the item rental TEST #14', '2017-12-09 02:48:08', '/Rentals?chat=14', 1),
(30, 7, 'New message for the item rental TEST #14', '2017-12-09 02:48:32', '/Rentals?chat=14', 1),
(31, 7, 'New message for the item rental TEST #14', '2017-12-09 02:48:38', '/Rentals?chat=14', 1),
(32, 7, 'New message for the item rental TEST', '2017-12-09 02:54:28', '/Rentals?chat=14', 1),
(33, 7, 'New message for the item rental TEST', '2017-12-09 02:54:35', '/Rentals?chat=14', 1),
(34, 6, 'New message for the item rental TEST', '2017-12-09 02:55:04', '/Rentals?chat=14', 1),
(35, 6, 'New message for the item rental TEST', '2017-12-09 02:55:07', '/Rentals?chat=14', 1),
(36, 6, 'New message for the item rental TEST', '2017-12-09 03:01:16', '/Rentals?chat=14', 1),
(37, 7, 'New message for the item rental TEST', '2017-12-09 03:02:02', '/Rentals?chat=14', 1),
(38, 7, 'New message for the item rental TEST', '2017-12-09 03:03:35', '/Rentals?chat=14', 1),
(39, 6, 'One of your rentals needs your approval to be completed', '2017-12-09 14:54:21', '/Rentals', 1),
(40, 7, 'Someone wants to rent your TEST item.', '2017-12-09 15:10:40', '/Rentals', 1),
(41, 7, 'One of your rentals has been terminated before starting', '2017-12-09 15:11:03', '/Rentals', 1),
(42, 6, 'One of your rentals has been completed', '2017-12-09 15:11:39', '/Rentals', 1),
(43, 7, 'Someone wants to rent your TEST item.', '2017-12-09 15:12:00', '/Rentals', 1),
(44, 6, 'Someone has accepted your rental request.', '2017-12-09 15:12:13', '/Rentals', 1),
(45, 6, 'One of your rentals needs your approval to be completed', '2017-12-09 15:13:19', '/Rentals', 1),
(46, 6, 'One of your rentals has been completed', '2017-12-09 15:13:30', '/Rentals', 1),
(47, 7, 'Someone wants to rent your TEST item.', '2017-12-09 15:15:55', '/Rentals', 1),
(48, 11, 'Someone has accepted your rental request.', '2017-12-09 15:16:07', '/Rentals', 1),
(49, 7, 'Someone wants to rent your TEST item.', '2017-12-09 15:17:02', '/Rentals', 1),
(50, 6, 'Someone has accepted your rental request.', '2017-12-09 15:17:09', '/Rentals', 1),
(51, 11, 'One of your rentals needs your approval to be completed', '2017-12-09 17:57:12', '/Rentals', 1),
(52, 11, 'One of your rentals has been completed', '2017-12-09 17:57:28', '/Rentals', 1),
(53, 6, 'One of your rentals needs your approval to be completed', '2017-12-09 17:58:08', '/Rentals', 1),
(54, 6, 'One of your rentals has been completed', '2017-12-09 17:58:21', '/Rentals', 1),
(55, 7, 'Someone wants to rent your TEST item.', '2017-12-09 22:34:44', '/Rentals', 1),
(56, 6, 'Someone has accepted your rental request.', '2017-12-09 22:34:56', '/Rentals', 1),
(57, 6, 'One of your rentals needs your approval to be completed', '2017-12-09 22:35:10', '/Rentals', 1),
(58, 6, 'One of your rentals has been completed', '2017-12-09 22:35:36', '/Rentals', 1),
(59, 7, 'Someone wants to rent your TEST item.', '2017-12-09 22:36:23', '/Rentals', 1),
(60, 6, 'Someone has accepted your rental request.', '2017-12-09 22:36:53', '/Rentals', 1),
(61, 6, 'One of your rentals needs your approval to be completed', '2017-12-09 22:37:06', '/Rentals', 1),
(62, 7, 'Someone wants to rent your TEST item.', '2017-12-09 22:47:02', '/Rentals', 1),
(63, 6, 'Someone has accepted your rental request.', '2017-12-09 22:47:11', '/Rentals', 1),
(64, 7, 'One of your rentals needs your approval to be completed', '2017-12-09 22:47:26', '/Rentals', 1),
(65, 6, 'One of your rentals has been completed', '2017-12-09 22:47:38', '/Rentals', 1),
(66, 6, 'One of your rentals has been completed', '2017-12-09 22:47:41', '/Rentals', 1),
(67, 7, 'Someone wants to rent your TEST item.', '2017-12-10 00:51:55', '/Rentals', 1),
(68, 6, 'Someone has accepted your rental request.', '2017-12-10 00:52:02', '/Rentals', 1),
(100, 7, 'New message for the item rental TEST', '2017-12-10 03:58:57', '/Rentals?chat=22', 1),
(102, 6, 'New message for the item rental TEST', '2017-12-10 03:59:28', '/Rentals?chat=22', 1),
(103, 7, 'One of your rentals needs your approval to be completed', '2017-12-10 04:01:14', '/Rentals', 1),
(104, 6, 'One of your rentals has been completed', '2017-12-10 04:01:27', '/Rentals', 1),
(105, 7, 'Someone wants to rent your TEST item.', '2017-12-10 04:02:21', '/Rentals', 1),
(106, 6, 'Someone has accepted your rental request.', '2017-12-10 04:02:34', '/Rentals', 1),
(107, 7, 'One of your rentals needs your approval to be completed', '2017-12-10 04:02:48', '/Rentals', 1),
(108, 6, 'One of your rentals has been completed', '2017-12-10 04:03:00', '/Rentals', 1),
(109, 7, 'Someone wants to rent your TEST item.', '2017-12-10 04:04:24', '/Rentals', 1),
(110, 6, 'Someone has accepted your rental request.', '2017-12-10 04:04:31', '/Rentals', 1),
(111, 6, 'One of your rentals needs your approval to be completed', '2017-12-10 04:04:40', '/Rentals', 1),
(112, 7, 'One of your rentals has been completed', '2017-12-10 04:04:51', '/Rentals', 1),
(113, 7, 'Someone wants to rent your TEST item.', '2017-12-10 04:05:34', '/Rentals', 1),
(114, 6, 'Someone has accepted your rental request.', '2017-12-10 04:05:43', '/Rentals', 1),
(115, 7, 'One of your rentals needs your approval to be completed', '2017-12-10 04:05:52', '/Rentals', 1),
(116, 6, 'One of your rentals has been completed', '2017-12-10 04:05:59', '/Rentals', 1),
(117, 7, 'Someone wants to rent your TEST item.', '2017-12-10 04:09:31', '/Rentals', 1),
(118, 7, 'Someone wants to rent your TEST item.', '2017-12-12 03:32:54', '/Rentals', 1),
(119, 7, 'One of your rentals has been terminated before starting', '2017-12-12 03:33:34', '/Rentals', 1),
(120, 6, 'Someone has declined your rental request.', '2017-12-12 03:35:33', '/Rentals', 1),
(121, 6, 'Someone wants to rent your Flamboyant Bike item.', '2017-12-12 03:39:23', '/Rentals', 1),
(122, 7, 'Someone has accepted your rental request.', '2017-12-12 03:39:31', '/Rentals', 1),
(141, 7, 'New message for the item rental Flamboyant Bike', '2017-12-12 03:48:28', '/Rentals?chat=28', 1),
(145, 6, 'New message for the item rental Flamboyant Bike', '2017-12-12 03:53:53', '/Rentals?chat=28', 1),
(146, 5, 'Someone wants to rent your Harry Potter item.', '2017-12-12 22:40:23', '/Rentals', 0),
(147, 6, 'Someone wants to rent your Wrench  item.', '2017-12-13 03:23:03', '/Rentals', 1),
(148, 6, 'Someone has accepted your rental request.', '2017-12-13 03:23:23', '/Rentals', 1),
(149, 6, 'One of your rentals needs your approval to be completed', '2017-12-13 03:23:25', '/Rentals', 1),
(150, 6, 'One of your rentals has been completed', '2017-12-13 03:23:27', '/Rentals', 1),
(151, 6, 'Someone wants to rent your Wrench  item.', '2017-12-13 06:20:32', '/Rentals', 1),
(152, 6, 'Someone wants to rent your Wrench  item.', '2017-12-13 06:20:45', '/Rentals', 1),
(153, 6, 'Someone wants to rent your Wrench  item.', '2017-12-13 06:21:12', '/Rentals', 1),
(154, 6, 'One of your rentals has been terminated before starting', '2017-12-13 06:21:15', '/Rentals', 1),
(155, 6, 'Someone has accepted your rental request.', '2017-12-13 06:22:40', '/Rentals', 1),
(156, 6, 'Someone has accepted your rental request.', '2017-12-13 06:22:43', '/Rentals', 1),
(157, 10, 'Someone wants to rent your Cart item.', '2017-12-13 18:20:12', '/Rentals', 0),
(158, 6, 'Someone wants to rent your Bike item.', '2017-12-13 18:21:30', '/Rentals', 1),
(159, 6, 'One of your rentals needs your approval to be completed', '2017-12-13 18:21:39', '/Rentals', 1),
(160, 6, 'One of your rentals has been completed', '2017-12-13 18:21:42', '/Rentals', 1),
(161, 10, 'One of your rentals has been terminated before starting', '2017-12-13 18:23:17', '/Rentals', 0),
(162, 6, 'One of your rentals needs your approval to be completed', '2017-12-13 18:23:20', '/Rentals', 1),
(163, 6, 'One of your rentals needs your approval to be completed', '2017-12-13 18:23:22', '/Rentals', 1),
(164, 6, 'New message for the item rental Wrench ', '2017-12-13 18:24:32', '/Rentals?chat=33', 1),
(165, 6, 'New message for the item rental Wrench ', '2017-12-13 18:29:13', '/Rentals?chat=31', 1),
(166, 7, 'Someone has accepted your rental request.', '2017-12-13 18:56:57', '/Rentals', 1),
(167, 7, 'Someone wants to rent your TEST item.', '2017-12-13 22:08:00', '/Rentals/tab/proposals', 1),
(168, 7, 'One of your rentals has been terminated before starting', '2017-12-13 22:09:20', '/Rentals', 1),
(169, 7, 'Someone wants to rent your TEST item.', '2017-12-13 22:09:33', '/Rentals/tab/proposals', 1),
(170, 7, 'One of your rentals has been terminated before starting', '2017-12-13 22:13:36', '/Rentals', 1),
(171, 7, 'Someone wants to rent your TEST item.', '2017-12-13 22:14:13', '/Rentals/tab/proposals', 1),
(172, 6, 'Someone has accepted your rental request.', '2017-12-13 22:14:34', '/Rentals', 1),
(173, 7, 'One of your rentals needs your approval to be completed', '2017-12-13 22:14:47', '/Rentals', 1),
(174, 6, 'One of your rentals has been completed', '2017-12-13 22:15:01', '/Rentals/tab/completed', 1),
(175, 7, 'One of your rentals needs your approval to be completed', '2017-12-14 01:29:56', '/Rentals', 1),
(176, 6, 'One of your rentals has been completed', '2017-12-14 01:30:53', '/Rentals/tab/completed', 1),
(177, 6, 'Someone wants to rent your Wrench  item.', '2017-12-14 03:22:56', '/Rentals/tab/proposals', 1),
(178, 7, 'Someone has accepted your rental request.', '2017-12-14 03:23:10', '/Rentals', 1),
(179, 6, 'One of your rentals needs your approval to be completed', '2017-12-14 03:23:31', '/Rentals/tab/owned', 1),
(180, 7, 'One of your rentals has been completed', '2017-12-14 03:23:50', '/Rentals/tab/completed', 1),
(181, 31, 'Someone wants to rent your Calculus textbook item.', '2017-12-14 16:51:05', '/Rentals/tab/proposals', 1),
(182, 35, 'Someone has declined your rental request.', '2017-12-14 16:52:44', '/Rentals', 1),
(183, 31, 'Someone wants to rent your Calculus textbook item.', '2017-12-14 16:53:37', '/Rentals/tab/proposals', 1),
(184, 35, 'Someone has accepted your rental request.', '2017-12-14 16:53:56', '/Rentals', 1),
(185, 7, 'Someone wants to rent your TEST item.', '2017-12-14 16:55:26', '/Rentals/tab/proposals', 1),
(186, 31, 'Someone has accepted your rental request.', '2017-12-14 16:55:42', '/Rentals', 1),
(187, 7, 'Someone wants to rent your TEST item.', '2017-12-14 16:56:19', '/Rentals/tab/proposals', 1),
(188, 7, 'One of your rentals has been terminated before starting', '2017-12-14 16:56:38', '/Rentals/tab/owned', 1),
(189, 7, 'Someone wants to rent your TEST item.', '2017-12-14 16:57:53', '/Rentals/tab/proposals', 1),
(190, 31, 'Someone has declined your rental request.', '2017-12-14 16:58:10', '/Rentals', 1),
(191, 7, 'Someone wants to rent your TEST item.', '2017-12-14 16:58:24', '/Rentals/tab/proposals', 1),
(192, 35, 'Someone has accepted your rental request.', '2017-12-14 16:58:36', '/Rentals', 1),
(196, 35, 'New message for the item rental Calculus textbook', '2017-12-14 17:10:00', '/Rentals?chat=41', 1),
(197, 31, 'New message for the item rental Calculus textbook', '2017-12-14 17:10:18', '/Rentals?chat=41', 1),
(199, 31, 'New message for the item rental TEST', '2017-12-14 17:11:14', '/Rentals?chat=42', 1),
(200, 7, 'One of your rentals needs your approval to be completed', '2017-12-14 17:11:43', '/Rentals/tab/owned', 1),
(201, 31, 'One of your rentals has been completed', '2017-12-14 17:12:50', '/Rentals/tab/completed', 1),
(202, 35, 'One of your rentals needs your approval to be completed', '2017-12-14 17:13:28', '/Rentals', 1),
(203, 31, 'One of your rentals has been completed', '2017-12-14 17:13:50', '/Rentals/tab/completed', 1),
(204, 7, 'New message for the item rental TEST', '2017-12-14 17:14:42', '/Rentals?chat=42', 1),
(205, 7, 'Someone wants to rent your TEST item.', '2017-12-14 17:15:08', '/Rentals/tab/proposals', 1),
(206, 7, 'One of your rentals has been terminated before starting', '2017-12-14 17:15:14', '/Rentals/tab/owned', 1),
(207, 31, 'Someone wants to rent your Calculus textbook item.', '2017-12-14 17:17:08', '/Rentals/tab/proposals', 1),
(208, 7, 'Someone has accepted your rental request.', '2017-12-14 17:17:16', '/Rentals', 1),
(209, 7, 'One of your rentals needs your approval to be completed', '2017-12-14 17:17:19', '/Rentals', 1),
(210, 31, 'One of your rentals has been completed', '2017-12-14 17:17:41', '/Rentals/tab/completed', 1),
(211, 7, 'One of your rentals needs your approval to be completed', '2017-12-14 17:34:17', '/Rentals/tab/owned', 1),
(212, 35, 'One of your rentals has been completed', '2017-12-14 17:34:54', '/Rentals/tab/completed', 1);

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
(3, 6, 2, '2017-11-23', '2017-11-29', 280, 'completed'),
(4, 7, 2, '2017-11-24', '2017-11-27', 160, 'declined'),
(5, 6, 2, '2017-11-26', '2017-11-30', 200, 'completed'),
(6, 6, 2, '2017-11-27', '2017-11-29', 120, 'declined'),
(7, 6, 2, '2017-11-27', '2017-11-29', 120, 'declined'),
(8, 6, 1, '2017-11-30', '2017-12-21', 22, 'cancelled'),
(9, 6, 3, '2017-12-08', '2017-12-09', 30, 'completed'),
(10, 6, 1, '2017-12-08', '2017-12-08', 1, 'cancelled'),
(11, 6, 1, '2017-12-08', '2017-12-09', 2, 'cancelled'),
(12, 6, 1, '2017-12-08', '2017-12-09', 2, 'cancelled'),
(13, 7, 1, '2017-12-08', '2017-12-09', 2, 'cancelled'),
(14, 6, 6, '2017-12-08', '2017-12-08', 500, 'completed'),
(15, 7, 6, '2017-12-17', '2017-12-23', 3500, 'cancelled'),
(16, 6, 6, '2017-12-17', '2017-12-23', 3500, 'completed'),
(17, 11, 6, '2017-12-15', '2017-12-15', 500, 'completed'),
(18, 6, 6, '2017-12-10', '2017-12-14', 2500, 'completed'),
(19, 6, 6, '2017-12-09', '2017-12-11', 1500, 'completed'),
(20, 6, 6, '2017-12-09', '2017-12-19', 5500, 'completed'),
(21, 6, 6, '2017-12-09', '2017-12-12', 2000, 'completed'),
(22, 6, 6, '2017-12-27', '2017-12-29', 15000, 'completed'),
(23, 6, 6, '2017-12-09', '2017-12-21', 65000, 'completed'),
(24, 6, 6, '2017-12-09', '2017-12-09', 5000, 'completed'),
(25, 6, 6, '2017-12-09', '2017-12-09', 5000, 'completed'),
(26, 6, 6, '2017-12-09', '2017-12-09', 5000, 'declined'),
(27, 7, 6, '2017-12-11', '2017-12-11', 5000, 'cancelled'),
(28, 7, 4, '2017-12-11', '2017-12-11', 50, 'completed'),
(30, 6, 3, '2017-12-12', '2017-12-12', 15, 'completed'),
(31, 6, 3, '2017-12-13', '2017-12-13', 15, 'cancelled'),
(32, 6, 3, '2017-12-13', '2017-12-13', 15, 'cancelled'),
(33, 6, 3, '2017-12-18', '2017-12-22', 75, 'cancelled'),
(34, 6, 5, '2017-12-13', '2017-12-20', 184, 'cancelled'),
(35, 7, 11, '2017-12-13', '2017-12-20', 4000, 'completed'),
(36, 6, 6, '2017-12-13', '2017-12-27', 75000, 'cancelled'),
(37, 6, 6, '2017-12-13', '2017-12-20', 40000, 'cancelled'),
(38, 6, 6, '2017-12-20', '2017-12-22', 15000, 'completed'),
(39, 7, 3, '2017-12-13', '2017-12-15', 45, 'completed'),
(40, 35, 12, '2017-12-14', '2017-12-16', 15, 'declined'),
(41, 35, 12, '2017-12-14', '2017-12-16', 15, 'completed'),
(42, 31, 6, '2017-12-28', '2017-12-30', 15000, 'completed'),
(43, 31, 6, '2017-12-16', '2017-12-17', 10000, 'cancelled'),
(44, 31, 6, '2017-12-16', '2017-12-17', 10000, 'declined'),
(45, 35, 6, '2017-12-16', '2017-12-17', 10000, 'completed'),
(46, 31, 6, '2017-12-19', '2017-12-19', 5000, 'cancelled'),
(47, 7, 12, '2017-12-14', '2017-12-14', 5, 'completed');

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
(3, 'Testing', 'Just testing', 'High', 7, 'open'),
(4, 'Not sure if stuff works', 'I think its broken', 'High', 7, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `email` varchar(72) NOT NULL,
  `display_name` varchar(72) DEFAULT NULL,
  `password` varchar(72) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
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
(5, 'user3@yahoo.com', 'curlyburry', '$2y$10$oYiUZ8cGSOgOfqCNnfJ8IupiXQfuYQf1f8Za295b3PSId5nfvwyT.', 'Vasinlerh', 'Hueld', '5145169584', '2017-10-26 19:40:24', '21374 Sherbrooke ', 'Montreal', 'H4B1T8', 'QC', 0, 0, 0, 'active'),
(6, 'user5@yahoo.com', 'Johny bravo', '$2y$10$5pjOkt4g3tlpn20nIvCmTuLoc0sdNxgRujRU77GuAMZrtOw3/LQrW', 'Johny ', 'Bravo', '2147483647', '2017-10-30 18:21:15', '9393 Saint-Jacque', 'Montreal', 'H4B2W8', 'AB', 0, 0, 0, 'active'),
(7, 'clement@email.com', 'Clement Potteck', '$2y$10$hO1z5t/DMh1tzFbfq3PVMOe.9aj9y3/lNgM6P7cv6JUukRUxud8KG', 'Clement', 'Potteck', '514-444-4444', '2017-12-10 16:27:17', '5555 Street', 'Montreal', 'H4A1M8', 'QC', 0, 0, 1, 'active'),
(10, 'user6@yahoo.com', 'therulerofearth', '$2y$10$jir6tVprmUFHEsOvBWU/1OVbK3.HpcZOKQE5wZFcKW27439HuBrZG', 'Genghis', 'Khan', '5145932323', '2017-11-30 17:57:51', '2154 Mongolia Avenue', 'Montreal', 'H4B1J8', 'QC', 0, 0, 0, 'active'),
(11, 'dgfgd@email.com', 'dghhgh', '$2y$10$qXQQl3LEJw/rZXePz/a6huzS2MDM8jPJhp6yP7LjaZgCxSU0T6WSG', 'fdgdh', 'dfhdfg', '5144444444', '2017-12-09 03:15:27', 'sfkjsdh', 'Montreal', 'H4A 1M', 'QC', 0, 0, 0, 'active'),
(13, 'cpotteck@gmail.com', '', '$2y$10$5M4nJPjyWO5Y1nxNpMQD3OLtvFiVYGe1yOzzGtqUlzbuH865cHKQ.', 'Clement', 'Potteck', '514-444-4444', '2017-12-12 03:29:54', '', 'Montreal', 'H4A1M8', 'QC', 0, 0, 0, 'active'),
(30, 'someemail@email.com', 'name', '$2y$10$KWXqUc9nFFqbD/dts0VqieHvT9SjA03f1K.YJ5GcXv8YhXK8u/TVO', '', '', '', '2017-12-13 19:17:01', '', 'Toronto', 'A1A1A1', 'AB', 0, 0, 0, 'disabled'),
(31, 'uottawa@email.com', 'University of Ottawa', '$2y$10$4F5ELDS5cP4PJ5iq1L1th.pukdWX4clS7AzVonG1Qck43XM2w/qL6', 'university', 'ottawa', '', '2017-12-14 14:36:33', '', 'Ottawa', 'K1N6N5', 'ON', 0, 0, 0, 'disabled'),
(35, 'serge@email.com', 'Sergiu Ifimov', '$2y$10$qKmM2IqZyhF8/gkTB/KCKefk0Yl/1KyHYkICa8gbE9eLSaN46/PpC', 'Serge', 'Ifimov', '555-555-2222', '2017-12-14 14:48:41', '75 Laurier Ave E.', 'Ottawa', 'K1S1R1', 'ON', 1, 1, 1, 'active');

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
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
