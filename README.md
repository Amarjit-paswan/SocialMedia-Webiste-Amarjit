![Screenshot 2024-01-19 092302](https://github.com/Amarjit-paswan/SocialMedia-Webiste-Amarjit/assets/137752602/7741f97a-e7cf-4462-8df5-62020e94e51d)
<h1>Features</h1>
<ol>
  <li>use login and sinup account with email verification</li>
  <li> User can Edit Account </li>
  <li>Add Story</li>
  <li>Add Post</li>
  <li>Add Friend</li>
  <li>Watch Friend Post and  Story</li>
  <li>Chat 💬 With Friends</li>
  <li>Add like button</li>
  <li>Add Comment Button</li>
  <li>Watch freind Comment</li>
  <li>Edit Password</li>


</ol>

<h1>Sql Code file</h1>
[Uploading socia-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 04:58 AM
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
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `cPost_id` int(11) DEFAULT NULL,
  `cUser_id` int(11) DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `cPost_id`, `cUser_id`, `comment_text`, `comment_date`) VALUES
(24, 57, 26, 'Nice pic', '2024-01-18 14:13:08'),
(25, 56, 26, 'nice chair', '2024-01-18 14:13:31'),
(26, 57, 27, 'awesome', '2024-01-18 14:13:53'),
(27, 56, 27, 'yes nice chair', '2024-01-18 14:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `friendship_id` int(11) NOT NULL,
  `login_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `friendship_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`friendship_id`, `login_id`, `friend_id`, `friendship_date`) VALUES
(19, 26, 27, '2024-01-18 14:10:46'),
(20, 27, 20, '2024-01-18 14:14:31'),
(21, 27, 21, '2024-01-18 14:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `messageCreated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message_content`, `messageCreated_at`) VALUES
(15, 26, 27, 'Hello Virat', '2024-01-18 14:11:10'),
(16, 27, 26, 'Hii Amarjit', '2024-01-18 14:12:21'),
(17, 26, 27, 'How are you', '2024-01-18 14:12:32'),
(18, 27, 26, 'i am fine', '2024-01-18 14:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_content` text DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `post_date`) VALUES
(55, 26, '1250573.jpg', '2024-01-18 14:05:08'),
(56, 27, 'pexels-rubaitul-azad-12812689.jpg', '2024-01-18 14:08:50'),
(57, 27, 'istockphoto-1288248467-2048x2048.jpg', '2024-01-18 14:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `like_id` int(11) NOT NULL,
  `postlike_id` int(11) DEFAULT NULL,
  `loginuser_id` int(11) DEFAULT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`like_id`, `postlike_id`, `loginuser_id`, `liked_at`) VALUES
(49, 57, 26, '2024-01-18 14:12:56'),
(50, 55, 26, '2024-01-18 14:13:19'),
(51, 57, 27, '2024-01-18 14:13:59'),
(52, 56, 27, '2024-01-18 14:14:15'),
(53, 55, 27, '2024-01-18 14:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `story_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT (current_timestamp() + interval 1 day)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`story_id`, `user_id`, `content`, `created_at`, `expires_at`) VALUES
(23, 26, 'istockphoto-1287863886-2048x2048.jpg', '2024-01-18 14:04:51', '2024-01-19 14:04:51'),
(24, 27, 'pic3.jpg', '2024-01-18 14:08:34', '2024-01-19 14:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `otp` int(6) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `gender`, `user_email`, `password`, `image_path`, `otp`, `status`, `address`, `bio`) VALUES
(20, 'Hrithik', 'Male', 'hrithik@gmail.com', '1234', 'pic3.jpg', 0, 'Active', NULL, NULL),
(21, 'Salman', 'Male', 'salman@gmail.com', '1234', 'pic2.jpg', 0, 'Active', NULL, NULL),
(22, 'Priyanka', 'Female', 'priyanka@gmail.com', '1234', 'picgirl.jpg', 0, 'Active', NULL, NULL),
(23, 'Vicky', 'Male', 'vicky@gmail.com', '1234', 'pic4.jpg', 0, 'Active', NULL, NULL),
(24, 'Pawan', 'Male', 'pawan@gmail.com', '1234', 'pic5.jpg', 0, 'Active', NULL, NULL),
(26, 'Amarjit Paswan', 'Male', 'amarjitpaswan409@gmail.com', 'new1234', 'Screenshot 2023-10-24 135353.png', 0, 'Active', 'Dankuni, 9no Rail Gate, Jorapost,', 'I am a Web Developer'),
(27, 'Virat', 'Male', 'ajkidevelopment12@gmail.com', '1234', '145867.png', 0, 'Active', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `cPost_id` (`cPost_id`),
  ADD KEY `cUser_id` (`cUser_id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`friendship_id`),
  ADD UNIQUE KEY `unique_friendship` (`login_id`,`friend_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `poslike_id` (`postlike_id`),
  ADD KEY `userpost_id` (`loginuser_id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`story_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `story_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`cPost_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`cUser_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`postlike_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`loginuser_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
l_media.sql…]()
