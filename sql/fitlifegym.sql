-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2026 at 07:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitlifegym`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmi_categories`
--

CREATE TABLE `bmi_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `min_value` decimal(5,2) DEFAULT NULL,
  `max_value` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bmi_categories`
--

INSERT INTO `bmi_categories` (`id`, `name`, `min_value`, `max_value`) VALUES
(1, 'Underweight', 0.00, 18.49),
(2, 'Normal', 18.50, 24.90),
(3, 'Overweight', 25.00, 29.90),
(4, 'Obese', 30.00, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `bmi_records`
--

CREATE TABLE `bmi_records` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `BMI` decimal(5,2) NOT NULL,
  `created_atd` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `access_level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email_address`, `password`, `contact_no`, `created_at`, `modified_at`, `access_level`) VALUES
(1, 'Alexis', 'Dumale', 'ajcodalify@gmail.com', '$2y$10$zPorEKYvwaPhsiT/c4myiuQLEoJ.NPxWEIKqzcSgIVbO9VTje5aNu', '09533307696', '2026-04-02 20:09:16', '2026-04-02 12:51:26', 'Client'),
(2, 'Alexis', 'De Leon', 'alexisdumale@gmail.com', '$2y$10$4C99ZivsNabiuyfhXb0fH.lcz6FukOriEsa664z8w5j19.xgY0Lqq', '09772639814', '2026-04-02 20:10:42', '2026-04-02 12:51:28', 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `id` int(11) NOT NULL,
  `bmi_category_id` int(11) DEFAULT NULL,
  `exercise_name` varchar(100) DEFAULT NULL,
  `sets` int(11) DEFAULT NULL,
  `reps` varchar(20) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `rest` varchar(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`id`, `bmi_category_id`, `exercise_name`, `sets`, `reps`, `duration`, `rest`, `type`, `notes`) VALUES
(1, 1, 'Jumping Jacks', 1, NULL, '2 mins', '30 sec', 'warmup', 'Light cardio'),
(2, 1, 'Arm Circles', 2, NULL, '1 min', '20 sec', 'warmup', 'Shoulder warmup'),
(3, 1, 'Squats', 3, '10 reps', NULL, '45 sec', 'strength', 'Leg strength'),
(4, 1, 'Push-ups', 3, '8 reps', NULL, '45 sec', 'strength', 'Upper body'),
(5, 1, 'Lunges', 3, '8 each leg', NULL, '45 sec', 'strength', 'Balance'),
(6, 1, 'Plank', 3, NULL, '20 sec', '30 sec', 'core', 'Core strength'),
(7, 1, 'Glute Bridge', 3, '10 reps', NULL, '30 sec', 'strength', 'Lower body'),
(8, 1, 'Step-ups', 3, '10 reps', NULL, '30 sec', 'cardio', 'Leg + cardio'),
(9, 1, 'Mountain Climbers', 3, NULL, '20 sec', '30 sec', 'cardio', 'Fat burn'),
(10, 1, 'Stretching', 1, NULL, '5 mins', NULL, 'cooldown', 'Recovery'),
(11, 2, 'Jumping Jacks', 1, NULL, '2 mins', '30 sec', 'warmup', 'Cardio'),
(12, 2, 'Arm Circles', 2, NULL, '1 min', '20 sec', 'warmup', 'Warmup'),
(13, 2, 'Squats', 3, '12 reps', NULL, '45 sec', 'strength', 'Leg'),
(14, 2, 'Push-ups', 3, '10 reps', NULL, '45 sec', 'strength', 'Upper body'),
(15, 2, 'Lunges', 3, '10 each leg', NULL, '45 sec', 'strength', 'Balance'),
(16, 2, 'Plank', 3, NULL, '30 sec', '30 sec', 'core', 'Core'),
(17, 2, 'Glute Bridge', 3, '12 reps', NULL, '30 sec', 'strength', 'Lower'),
(18, 2, 'Step-ups', 3, '12 reps', NULL, '30 sec', 'cardio', 'Leg'),
(19, 2, 'Mountain Climbers', 3, NULL, '30 sec', '30 sec', 'cardio', 'Fat burn'),
(20, 2, 'Stretching', 1, NULL, '5 mins', NULL, 'cooldown', 'Recovery'),
(21, 3, 'Walking', 1, NULL, '10 mins', NULL, 'warmup', 'Low impact'),
(22, 3, 'Arm Circles', 2, NULL, '1 min', '20 sec', 'warmup', 'Warmup'),
(23, 3, 'Squats', 3, '10 reps', NULL, '60 sec', 'strength', 'Leg'),
(24, 3, 'Incline Push-ups', 3, '8 reps', NULL, '60 sec', 'strength', 'Easy push'),
(25, 3, 'Step-ups', 3, '10 reps', NULL, '45 sec', 'cardio', 'Leg'),
(26, 3, 'Plank', 3, NULL, '20 sec', '30 sec', 'core', 'Core'),
(27, 3, 'Glute Bridge', 3, '10 reps', NULL, '30 sec', 'strength', 'Lower'),
(28, 3, 'March in Place', 3, NULL, '1 min', '30 sec', 'cardio', 'Light cardio'),
(29, 3, 'Mountain Climbers', 3, NULL, '20 sec', '30 sec', 'cardio', 'Fat burn'),
(30, 3, 'Stretching', 1, NULL, '5 mins', NULL, 'cooldown', 'Recovery'),
(31, 4, 'Walking', 1, NULL, '15 mins', NULL, 'warmup', 'Very light'),
(32, 4, 'Arm Circles', 2, NULL, '1 min', '20 sec', 'warmup', 'Warmup'),
(33, 4, 'Chair Squats', 3, '8 reps', NULL, '60 sec', 'strength', 'Beginner'),
(34, 4, 'Wall Push-ups', 3, '8 reps', NULL, '60 sec', 'strength', 'Easy'),
(35, 4, 'Seated Leg Raises', 3, '10 reps', NULL, '45 sec', 'strength', 'Leg'),
(36, 4, 'Plank (Knee)', 3, NULL, '15 sec', '30 sec', 'core', 'Core'),
(37, 4, 'March in Place', 3, NULL, '1 min', '30 sec', 'cardio', 'Low impact'),
(38, 4, 'Step Touch', 3, NULL, '1 min', '30 sec', 'cardio', 'Easy cardio'),
(39, 4, 'Deep Breathing', 2, NULL, '1 min', NULL, 'recovery', 'Relax'),
(40, 4, 'Stretching', 1, NULL, '5 mins', NULL, 'cooldown', 'Recovery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmi_categories`
--
ALTER TABLE `bmi_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bmi_records`
--
ALTER TABLE `bmi_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bmi_categories`
--
ALTER TABLE `bmi_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bmi_records`
--
ALTER TABLE `bmi_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
