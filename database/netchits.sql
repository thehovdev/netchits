-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2019 at 12:46 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.1.30-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netchits`
--

-- --------------------------------------------------------

--
-- Table structure for table `chits`
--

CREATE TABLE `chits` (
  `id` int(255) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `group_id` int(255) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `opg_sitename` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `opg_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `opg_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `like_chit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chits`
--

INSERT INTO `chits` (`id`, `userid`, `group_id`, `address`, `opg_sitename`, `opg_title`, `opg_image`, `like_chit`, `created_at`, `updated_at`) VALUES
(99, 38, 33, 'https://www.youtube.com/watch?v=nso3JfXLZRI', 'youtube', 'Элджей &amp; Era Istrefi - Sayonara Детка', '//img.youtube.com/vi/nso3JfXLZRI/mqdefault.jpg', NULL, '2019-08-04 12:35:01', '2019-08-04 12:35:01'),
(100, 38, 33, 'https://www.youtube.com/watch?v=wOBnq0Ewz5k', 'youtube', 'Элджей &amp; Feduk - Розовое вино', '//img.youtube.com/vi/wOBnq0Ewz5k/mqdefault.jpg', NULL, '2019-08-04 12:36:49', '2019-08-04 12:36:49'),
(101, 42, 36, 'https://www.youtube.com/watch?v=hTWKbfoikeg', 'youtube', 'Nirvana - Smells Like Teen Spirit (Official Music Video)', '//img.youtube.com/vi/hTWKbfoikeg/mqdefault.jpg', NULL, '2019-08-04 13:11:27', '2019-08-04 13:11:27'),
(102, 42, 0, 'https://www.youtube.com/watch?v=OfS1jFck8YQ', 'youtube', 'INNA - Nirvana | Official Music Video', '//img.youtube.com/vi/OfS1jFck8YQ/mqdefault.jpg', NULL, '2019-08-04 13:11:39', '2019-08-04 13:11:39'),
(103, 43, 37, 'https://www.youtube.com/watch?v=l482T0yNkeo', 'youtube', 'AC/DC - Highway to Hell (Official Video)', '//img.youtube.com/vi/l482T0yNkeo/mqdefault.jpg', NULL, '2019-08-04 13:17:11', '2019-08-04 13:17:11'),
(104, 43, 37, 'https://www.youtube.com/watch?v=Lo2qQmj0_h4', 'youtube', 'AC/DC - You Shook Me All Night Long (Official Video)', '//img.youtube.com/vi/Lo2qQmj0_h4/mqdefault.jpg', NULL, '2019-08-04 13:17:19', '2019-08-04 13:17:19'),
(105, 43, 37, 'https://www.youtube.com/watch?v=pAgnJDJN4VA', 'youtube', 'AC/DC - Back In Black (Official Video)', '//img.youtube.com/vi/pAgnJDJN4VA/mqdefault.jpg', NULL, '2019-08-04 13:17:27', '2019-08-04 13:17:27'),
(107, 43, 38, 'https://www.youtube.com/watch?v=v2AC41dglnM', 'youtube', 'AC/DC - Thunderstruck (Official Music Video)', '//img.youtube.com/vi/v2AC41dglnM/mqdefault.jpg', NULL, '2019-08-04 13:18:18', '2019-08-04 13:18:18'),
(108, 43, 38, 'https://www.youtube.com/watch?v=Lo2qQmj0_h4', 'youtube', 'AC/DC - You Shook Me All Night Long (Official Video)', '//img.youtube.com/vi/Lo2qQmj0_h4/mqdefault.jpg', NULL, '2019-08-04 13:18:32', '2019-08-04 13:18:32'),
(109, 43, 38, 'https://www.youtube.com/watch?v=gEPmA3USJdI', 'youtube', 'AC/DC - Highway to Hell (from Live at River Plate)', '//img.youtube.com/vi/gEPmA3USJdI/mqdefault.jpg', NULL, '2019-08-04 13:18:42', '2019-08-04 13:18:42'),
(111, 38, 39, 'https://www.youtube.com/watch?v=v2AC41dglnM', NULL, 'AC/DC - Thunderstruck (Official Music Video)', '//img.youtube.com/vi/v2AC41dglnM/mqdefault.jpg', NULL, '2019-08-04 13:19:53', '2019-08-04 13:19:53'),
(112, 38, 39, 'https://www.youtube.com/watch?v=Lo2qQmj0_h4', NULL, 'AC/DC - You Shook Me All Night Long (Official Video)', '//img.youtube.com/vi/Lo2qQmj0_h4/mqdefault.jpg', NULL, '2019-08-04 13:19:53', '2019-08-04 13:19:53'),
(113, 38, 39, 'https://www.youtube.com/watch?v=gEPmA3USJdI', NULL, 'AC/DC - Highway to Hell (from Live at River Plate)', '//img.youtube.com/vi/gEPmA3USJdI/mqdefault.jpg', NULL, '2019-08-04 13:19:53', '2019-08-04 13:19:53'),
(136, 44, 52, 'https://www.youtube.com/watch?v=n_GFN3a0yj0', 'youtube', 'AC/DC - Thunderstruck (from Live at River Plate)', '//img.youtube.com/vi/n_GFN3a0yj0/mqdefault.jpg', NULL, '2019-08-04 17:50:03', '2019-08-04 17:50:03'),
(137, 44, 52, 'https://www.youtube.com/watch?v=hTWKbfoikeg', 'youtube', 'Nirvana - Smells Like Teen Spirit (Official Music Video)', '//img.youtube.com/vi/hTWKbfoikeg/mqdefault.jpg', NULL, '2019-08-04 17:50:12', '2019-08-04 17:50:12'),
(138, 44, 53, 'https://www.youtube.com/watch?v=v2AC41dglnM', NULL, 'AC/DC - Thunderstruck (Official Music Video)', '//img.youtube.com/vi/v2AC41dglnM/mqdefault.jpg', NULL, '2019-08-04 17:53:42', '2019-08-04 17:53:42'),
(139, 44, 53, 'https://www.youtube.com/watch?v=Lo2qQmj0_h4', NULL, 'AC/DC - You Shook Me All Night Long (Official Video)', '//img.youtube.com/vi/Lo2qQmj0_h4/mqdefault.jpg', NULL, '2019-08-04 17:53:43', '2019-08-04 17:53:43'),
(140, 44, 53, 'https://www.youtube.com/watch?v=gEPmA3USJdI', NULL, 'AC/DC - Highway to Hell (from Live at River Plate)', '//img.youtube.com/vi/gEPmA3USJdI/mqdefault.jpg', NULL, '2019-08-04 17:53:43', '2019-08-04 17:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `chits_group`
--

CREATE TABLE `chits_group` (
  `id` int(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chits_group`
--

INSERT INTO `chits_group` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(33, 38, 'Default Group', '2019-08-04 12:34:59', '2019-08-04 12:34:59'),
(36, 42, 'Default Group', '2019-08-04 13:11:23', '2019-08-04 13:11:23'),
(37, 43, 'Default Group', '2019-08-04 13:17:09', '2019-08-04 13:17:09'),
(38, 43, 'AC/DC', '2019-08-04 13:17:36', '2019-08-04 13:17:36'),
(39, 38, 'AC/DC', '2019-08-04 13:19:53', '2019-08-04 13:19:53'),
(52, 44, 'Default Group', '2019-08-04 17:50:00', '2019-08-04 17:50:00'),
(53, 44, 'AC/DC', '2019-08-04 17:53:42', '2019-08-04 17:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`) VALUES
(1, 38, 43),
(2, 44, 43);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hashtag` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_group` int(255) DEFAULT NULL,
  `image_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.png',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `secret` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `confirmcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `hashtag`, `default_group`, `image_id`, `password`, `secret`, `created_at`, `updated_at`, `confirmcode`, `age`, `status`) VALUES
(38, 'halilov.lib@gmail.com', '#hovdev22', NULL, 'user.png', '$2y$10$zeKILwy/DIyNuc2Ggs0EnettPMTUCFouNdQs0Ph8wYKZCf9xlNAbq', 'MaETT679xUfQk33gcvVXwPoW8vELx/HdZNdmIfNTFr+ELI7Ev1sHAFHg/HbJp+MIYw/RvHZHIBPR85iX2YJMn25Cn7MlUw==', NULL, '2019-08-04 12:59:02', NULL, NULL, NULL),
(43, 'user15649387603917@netchits.com', '#user15649387603917', NULL, 'user.png', '$2y$10$CS.X3t.FognXKuiLpIz5CO1AuOmqtqTvPovAAGW7YURVzCOS6jJRm', '9a8c33a06c7b92797b00ca0fa077373415649387605d47120877a57', '2019-08-04 13:12:40', '2019-08-04 13:12:40', '253b8d91fa1', 'true', 0),
(44, 'user15649477246722@netchits.com', '#user15649477246722', NULL, 'user.png', '$2y$10$WQABDHyucrB7nRe1mGxITuYmH3DCavRfW42q6MagxsJ.kEc73f3xG', 'e3c117e3c7bbf946c0f1310e0a5ff08815649477245d47350cbe7d1', '2019-08-04 15:42:04', '2019-08-04 15:42:04', '72754451e9e', 'true', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chits`
--
ALTER TABLE `chits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chits_group`
--
ALTER TABLE `chits_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chits`
--
ALTER TABLE `chits`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `chits_group`
--
ALTER TABLE `chits_group`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
