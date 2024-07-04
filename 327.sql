-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2024 at 08:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `327`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `organizer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `approved` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date_time`, `status`, `organizer_id`, `created_at`, `updated_at`, `approved`) VALUES
(1, 'convocation', 'don\'t come... they don\'t provide enough food', '2024-06-07 03:24:00', 'pending', NULL, '2024-06-20 08:31:37', '2024-06-20 08:31:37', 0),
(2, 'abcd', 'ask.Abjasbvcjv', '2024-06-23 03:39:00', 'pending', NULL, '2024-06-20 08:31:37', '2024-06-20 12:54:38', 1),
(3, 'presentation', 'online 22', '2024-06-22 04:19:00', 'pending', NULL, '2024-06-20 08:31:37', '2024-06-20 08:31:37', 0),
(4, 'ban vs ind', 't2o worldcup', '2024-06-21 12:19:00', 'pending', NULL, '2024-06-20 08:31:37', '2024-06-20 13:12:11', 1),
(5, 'asas', 'scarce', '2024-06-22 17:47:00', 'pending', NULL, '2024-06-20 11:47:39', '2024-06-20 11:47:39', 0),
(6, 'euro', 'ger vs st', '2024-06-21 18:03:00', 'pending', NULL, '2024-06-20 12:03:12', '2024-06-20 13:57:24', 1),
(7, 'eid ul adha ', 'ahbsvlavx hxhhsvhv zzz has;asv watch and fun together', '2024-06-22 19:56:00', 'pending', NULL, '2024-06-20 13:56:31', '2024-06-20 13:56:31', 0),
(8, 'RAMISA birthday PARTY', 'at rehans house', '2024-07-02 23:58:00', 'pending', NULL, '2024-06-20 17:58:25', '2024-06-20 17:59:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` enum('student','faculty') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `event_id`, `user_id`, `approved`, `created_at`, `updated_at`, `user_type`) VALUES
(6, 4, 3, 0, '2024-06-20 10:01:54', '2024-06-20 10:01:54', 'faculty'),
(7, 2, 3, 0, '2024-06-20 11:05:56', '2024-06-20 11:05:56', 'faculty'),
(8, 5, 2, 0, '2024-06-20 13:16:13', '2024-06-20 13:16:13', 'student'),
(9, 7, 10, 0, '2024-06-20 14:00:11', '2024-06-20 14:00:11', 'student'),
(10, 8, 12, 0, '2024-06-20 18:01:28', '2024-06-20 18:01:28', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_feedback`
--

CREATE TABLE `faculty_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_feedback`
--

CREATE TABLE `student_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_feedback`
--

INSERT INTO `student_feedback` (`id`, `user_id`, `event_id`, `feedback`) VALUES
(1, 1, 2, 'ben n '),
(2, 1, 7, 'weds'),
(3, 1, 2, 'sknsmcn'),
(4, 1, 2, 'asknclja'),
(5, 1, 8, 'ahaaa ki silo mairi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','student','faculty','organizer') NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `name`, `created_at`, `updated_at`) VALUES
(1, 's@northsouth.edu', '123', 'admin', '', '2024-06-20 08:31:37', '2024-06-20 08:31:37'),
(2, 'a@northsouth.edu', '111', 'student', '', '2024-06-20 08:31:37', '2024-06-20 08:31:37'),
(3, 'b@northsouth.edu', '222', 'faculty', '', '2024-06-20 08:31:37', '2024-06-20 08:31:37'),
(4, 'c@northsouth.edu', '333', 'organizer', '', '2024-06-20 08:31:37', '2024-06-20 08:31:37'),
(5, 'dj@northsouth.edu', '$2y$10$b9xHI2yzzUxr3IvcRL/9EuMJ59dT9g2UJqAuc1WqPzcq3Ijpshege', 'student', 'djBaharul', '2024-06-20 08:31:37', '2024-06-20 08:31:37'),
(6, 'saf@northsouth.edu', '$2y$10$4MeQTwLYaiG9w8l1T0BWUOvx/BDpxNXrrG0B2b3ExrxD0kpNjQG4y', 'student', 'Safwan', '2024-06-20 11:08:11', '2024-06-20 11:08:11'),
(7, 'd@northsouth.edu', '123456', 'student', 'Safwan', '2024-06-20 11:17:37', '2024-06-20 11:17:37'),
(8, 'af@northsouth.edu', 'asd', 'organizer', 'ss', '2024-06-20 12:02:14', '2024-06-20 12:02:14'),
(9, 'g@northsouth.edu', '11234', 'student', 'zxcz', '2024-06-20 12:28:06', '2024-06-20 12:28:06'),
(10, 'student1@northsouth.edu', '123', 'student', 'ifrit hasin', '2024-06-20 13:58:56', '2024-06-20 13:58:56'),
(12, 'ruhan@northsouth.edu', 'ramisa', 'student', 'Ruhan ', '2024-06-20 18:00:01', '2024-06-20 18:00:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `faculty_feedback`
--
ALTER TABLE `faculty_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `student_feedback`
--
ALTER TABLE `student_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_feedback`
--
ALTER TABLE `faculty_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_feedback`
--
ALTER TABLE `student_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `organizer` (`id`);

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_event_registrations_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `faculty_feedback`
--
ALTER TABLE `faculty_feedback`
  ADD CONSTRAINT `faculty_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `faculty_feedback_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `organizer`
--
ALTER TABLE `organizer`
  ADD CONSTRAINT `organizer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_feedback`
--
ALTER TABLE `student_feedback`
  ADD CONSTRAINT `student_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_feedback_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
