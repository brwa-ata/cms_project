-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2017 at 11:43 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `title`) VALUES
(1, 'javascript'),
(5, 'OOP'),
(7, 'PHP'),
(8, 'C#');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(23, 58, 'diyary', 'diyary@yahoo.com', 'mashallah lebe brakam zor qozy', 'unproved', '2017-07-26'),
(24, 58, 'diyary', 'diyary@yahoo.com', 'chya xaly jaw xosha', 'unproved', '2017-07-26'),
(25, 59, 'wafa', 'wafa@gmail.com', 'awa rola aley am shara dalaky tya nyia aw hamw qzh w risha chya', 'unproved', '2017-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `online_id` int(11) NOT NULL,
  `os_session` varchar(255) NOT NULL,
  `os_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`online_id`, `os_session`, `os_time`) VALUES
(3, 'hogfppp8vc9j347t0nnatdpju5', 1500827531),
(4, '6bg7tdimja252p18mtvitn7qm8', 1500813955),
(5, '3kel2837hj92d364cnfkj9h3v8', 1500814527),
(6, 'tga7vtgvl695bb6a6h7qlvapi6', 1500852155),
(7, 'qa467aq4pdr7faovtjb6o3naam', 1500903785),
(8, 'ml3172m3iv2c7hd845lofl033a', 1500909221),
(9, '6jutg1n7h372vl396hiblhrhc8', 1500925705),
(10, 'ae6igicrmu7h7qct6dcn8ssct3', 1500992572),
(11, '6nu9mr0mh40rukf01aokjj80im', 1501061209);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_catagory_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_catagory_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_view_count`) VALUES
(58, 5, 'post 3', '', 'brwa', '2017-07-24', 'IMG_20160225_225039.jpg', '    eiwuewincwcuweicpunewicucewif', 'home, night ,late, sleepy, tired', 0, 'publish', 8),
(61, 7, 'new post', '', 'brwa', '2017-07-24', 'balen.jpg', '   eruyfbddccuiweui', 'brother', 0, 'publish', 2),
(62, 7, 'new picture', '', 'brwa', '2017-07-24', 'rocks.jpg', '    assasasa', 'ssa', 0, 'draft', 8),
(66, 1, 'last post', '', 'wafa', '2017-07-26', 'wafa.jpg', 'this is my big brother', 'brother', 0, 'publish', 0),
(67, 1, '', '', 'paywand', '2017-07-26', 'balen.jpg', 'this is my little brother', 'brother', 0, 'draft', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$qwertyuiopasdfghjklz32',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(31, 'brwa', '$2y$10$eaIjWrjSapUQ38wn4x6bvOVIqcVcQf.Z85G5dzq.WMAIXV0uvTOPi', '', '', 'brwa@gmail.com', '', 'Admin', '$2y$10$qwertyuiopasdfghjklz32', ''),
(33, 'wafa', '$2y$10$/pmjXCvKGW/01aoRHLaaM.cP5mGey6EgRYn.hxPLA9w4c/6wR2sxy', '', '', 'wafa@gmail.com', '', 'Subscriber', '$2y$10$qwertyuiopasdfghjklz32', ''),
(34, 'balen', '$2y$10$VV0r6kGDwm.x1WVT2r1efub/9Q7lFTchJPDymdgN/X5ADi2KxSSnC', '', '', 'balen@yahoo.com', '', 'subscriber', '$2y$10$qwertyuiopasdfghjklz32', ''),
(35, 'khozga', '$2y$10$qwertyuiopasdfghjklz3u21euEmSIwXyOdItn2CIbXi2kmWFEMOu', 'khozga', 'ata', 'khozga@gmail.com', '', 'Admin', '$2y$10$qwertyuiopasdfghjklz32', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`online_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
