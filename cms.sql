-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2017 at 10:06 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'PHP'),
(2, 'OOP'),
(3, 'Bootstrap'),
(4, 'HTML'),
(5, 'CSS'),
(6, 'Javascript'),
(7, 'HTML5');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(6, 12, 'Anonimous', 'd@gmail.com', 'The comment guy', 'approved', '2017-02-14'),
(24, 43, 'Great', 'gr@gmail.com', 'The best comment ever', 'approved', '2017-02-25'),
(26, 43, 'me', 'ME@GMAIL.COM', 'THIS IS MY COMMENT', 'approved', '2017-02-25'),
(27, 43, 'John', 'john@gmail.com', 'Comment id for your post', 'approved', '2017-02-25'),
(29, 43, 'John', 'john@gmail.com', 'Comment id for your post', 'approved', '2017-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(12, 1, 'Best PHP course EVER', 'Edwin Diazdraft', '', '2017-02-20', 'abbey.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', 'php, chain oop', 6, 'published', 12),
(15, 1, 'Example post 2000', 'Cerghizan Claudiu', '', '2017-02-20', 'abbey.jpg', '<p><strong>This is awesome</strong></p>', 'clau, javascript, php,sasa', 4, 'published', 3),
(18, 1, 'Learning OOP', 'Cerghizan Claudiu', '', '2017-02-20', 'abbey.jpg', '<p>This is the best Course i have seen it really helped me understand a lot of concepts I have been struggling with.</p>', 'oop, php, learn, nubs, expert', 0, 'published', 8),
(21, 1, 'Wow another post, my hands are tired :)', 'Clau', '', '2017-02-20', 'Hell or High Water.jpg', '<p>This is actualy an awesome post, i learned a lot.</p>', '', 0, 'published', 7),
(22, 1, 'Example post', 'clau', '', '2017-02-20', 'edc9d2414ae0e77081205da83220b1b4.jpg', '<p>Content</p>', 'javascript, course, class, !!!!!', 0, 'published', 17),
(23, 1, 'Example post', 'clau', '', '2017-02-23', 'edc9d2414ae0e77081205da83220b1b4.jpg', '<p>Content</p>', 'javascript, course, class, !!!!!', 0, 'published', 2),
(24, 1, 'Wow another post, my hands are tired :)', 'Clau', '', '2017-02-23', 'Hell or High Water.jpg', '<p>This is actualy an awesome post, i learned a lot.</p>', '', 0, 'published', 1),
(25, 1, 'Learning OOP', 'Cerghizan Claudiu', '', '2017-02-23', 'abbey.jpg', '<p>This is the best Course i have seen it really helped me understand a lot of concepts I have been struggling with.</p>', 'oop, php, learn, nubs, expert', 0, 'published', 3),
(26, 1, 'Example post 2000', 'Cerghizan Claudiu', '', '2017-02-23', 'abbey.jpg', '<p><strong>This is awesome</strong></p>', 'clau, javascript, php,sasa', 0, 'published', 2),
(27, 1, 'Best PHP course EVER', 'Edwin Diazdraft', '', '2017-02-23', 'abbey.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', 'php, chain oop', 0, 'published', 0),
(28, 1, 'Best PHP course EVER', 'Edwin Diazdraft', '', '2017-02-23', 'abbey.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', 'php, chain oop', 0, 'published', 1),
(29, 1, 'Example post 2000', 'Cerghizan Claudiu', '', '2017-02-23', 'abbey.jpg', '<p><strong>This is awesome</strong></p>', 'clau, javascript, php,sasa', 0, 'published', 0),
(30, 1, 'Learning OOP', 'Cerghizan Claudiu', '', '2017-02-23', 'abbey.jpg', '<p>This is the best Course i have seen it really helped me understand a lot of concepts I have been struggling with.</p>', 'oop, php, learn, nubs, expert', 0, 'published', 0),
(31, 1, 'Wow another post, my hands are tired :)', 'Clau', '', '2017-02-23', 'Hell or High Water.jpg', '<p>This is actualy an awesome post, i learned a lot.</p>', '', 0, 'published', 0),
(33, 1, 'Example post', 'clau', '', '2017-02-23', 'edc9d2414ae0e77081205da83220b1b4.jpg', '<p>Content</p>', 'javascript, course, class, !!!!!', 0, 'published', 0),
(34, 1, 'Wow another post, my hands are tired :)', 'Clau', '', '2017-02-23', 'Hell or High Water.jpg', '<p>This is actualy an awesome post, i learned a lot.</p>', '', 0, 'published', 4),
(35, 1, 'Learning OOP', 'Cerghizan Claudiu', '', '2017-02-23', 'abbey.jpg', '<p>This is the best Course i have seen it really helped me understand a lot of concepts I have been struggling with.</p>', 'oop, php, learn, nubs, expert', 0, 'published', 0),
(43, 1, 'Wow another post, my hands are tired :)', 'Clau', '', '2017-02-25', 'Hell or High Water.jpg', '<p>This is actualy an awesome post, i learned a lot.</p>', '', 0, 'published', 18),
(54, 1, 'TEST 1', '', 'peter', '2017-02-26', 'ad7c7616394443.562ab1ab0fec3.jpg', '<p>aaa</p>', 'aa', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(21, 'demo', '$2y$12$WNxpOLnKwSayKUP9aSZoGOfltC3ysVe7/GbkDlenGlhsGjCetMguC', '', '', 'demo@yahoo.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(22, 'demo 100', '$1$fIgv5JPu$CQmzgdTgeKNV0HQVegPKL/', '', '', 'demo100@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(25, 'peter', '$2y$12$DAz1ys53NsY/YBHNy1b9quGnDiEQrVFDx6CC9lrX/WJAmf/Sv9YZu', 'Peter', 'Michaels', 'peter@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(27, 'pete', '$2y$12$v2pYrqHM2Q/P7KFmqzxGvu1Luclt4ipizjkzQcXz7PMppGe2AV2XW', 'pete', 'Hudson', 'peter@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(2, '5ad4qdjvpkkc64sa1bhia05ds0', 1488126935),
(3, 'ic6325j1kpu50d71qsdclfc9c6', 1493193960);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

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
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
