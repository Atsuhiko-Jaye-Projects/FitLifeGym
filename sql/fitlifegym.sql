-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2026 at 06:36 PM
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
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bmi_classification` varchar(244) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bmi_records`
--

INSERT INTO `bmi_records` (`id`, `client_id`, `weight`, `height`, `BMI`, `created_at`, `modified_at`, `bmi_classification`, `status`) VALUES
(7, 1, 65.00, 175.00, 21.22, '2026-04-12 13:23:13', '2026-04-12 06:02:02', 'Normal', 'No Plan');

-- --------------------------------------------------------

--
-- Table structure for table `exercise_activities`
--

CREATE TABLE `exercise_activities` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `workout_plan_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `cycle` int(11) DEFAULT NULL,
  `set_per_exercise` int(11) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_activities`
--

INSERT INTO `exercise_activities` (`id`, `client_id`, `workout_plan_id`, `name`, `duration`, `units`, `cycle`, `set_per_exercise`, `day`, `created_at`, `modified_at`) VALUES
(109, 1, 'WORKOUT_ZDS010_003404', 'Bodyweight Squats', 10, NULL, 2, 10, 'Monday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(110, 1, 'WORKOUT_ZDS010_003404', 'Walking or Stationary Jogging', 15, NULL, 0, 0, 'Monday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(111, 1, 'WORKOUT_ZDS010_003404', 'Chest Opener Stretch', 5, NULL, 2, 0, 'Monday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(112, 1, 'WORKOUT_ZDS010_003404', 'Pelvic Tilts', 5, NULL, 2, 10, 'Monday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(113, 1, 'WORKOUT_ZDS010_003404', 'Glute Bridges', 10, NULL, 2, 12, 'Wednesday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(114, 1, 'WORKOUT_ZDS010_003404', 'Brisk Walking or Cycling', 15, NULL, 0, 0, 'Wednesday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(115, 1, 'WORKOUT_ZDS010_003404', 'Shoulder Rolls and Arm Circles', 5, NULL, 1, 10, 'Wednesday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(116, 1, 'WORKOUT_ZDS010_003404', 'Hamstring Stretch', 5, NULL, 2, 0, 'Wednesday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(117, 1, 'WORKOUT_ZDS010_003404', 'Wall Push-ups', 10, NULL, 2, 10, 'Friday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(118, 1, 'WORKOUT_ZDS010_003404', 'Light Cardio (Jump Rope or Marching in Place)', 15, NULL, 0, 0, 'Friday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(119, 1, 'WORKOUT_ZDS010_003404', 'Cat-Cow Stretch for Mobility', 5, NULL, 1, 10, 'Friday', '2026-04-13 00:34:04', '2026-04-12 16:34:04'),
(120, 1, 'WORKOUT_ZDS010_003404', 'Child’s Pose Stretch', 5, NULL, 2, 0, 'Friday', '2026-04-13 00:34:04', '2026-04-12 16:34:04');

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
  `access_level` varchar(25) NOT NULL,
  `first_time_logged_in` int(11) NOT NULL DEFAULT 1,
  `existing_plan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email_address`, `password`, `contact_no`, `created_at`, `modified_at`, `access_level`, `first_time_logged_in`, `existing_plan`) VALUES
(1, 'Alexis', 'Dumale', 'ajcodalify@gmail.com', '$2y$10$zPorEKYvwaPhsiT/c4myiuQLEoJ.NPxWEIKqzcSgIVbO9VTje5aNu', '09533307696', '2026-04-02 20:09:16', '2026-04-12 06:57:40', 'Client', 0, 0),
(2, 'Alexis', 'De Leon', 'alexisdumale@gmail.com', '$2y$10$4C99ZivsNabiuyfhXb0fH.lcz6FukOriEsa664z8w5j19.xgY0Lqq', '09772639814', '2026-04-02 20:10:42', '2026-04-09 04:43:21', 'Client', 1, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `id` int(11) NOT NULL,
  `workout_plan_id` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `workout_plan` varchar(255) DEFAULT NULL,
  `level` varchar(255) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `day_per_week` int(11) DEFAULT NULL,
  `current_bmi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`id`, `workout_plan_id`, `client_id`, `workout_plan`, `level`, `duration`, `day_per_week`, `current_bmi`, `created_at`, `modified_at`) VALUES
(12, 'WORKOUT_KML334_003301', 1, 'Light strength training + cardio + mobility', 'Beginner', 4, 3, '21.22', '2026-04-13 00:33:01', '2026-04-12 16:33:01'),
(13, 'WORKOUT_CLM525_003344', 1, 'Light strength training + cardio + mobility', 'Beginner', 4, 3, '21.22', '2026-04-13 00:33:44', '2026-04-12 16:33:44'),
(14, 'WORKOUT_ZDS010_003404', 1, 'Light strength training + cardio + mobility', 'Beginner', 4, 3, '21.22', '2026-04-13 00:34:04', '2026-04-12 16:34:04');

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
-- Indexes for table `exercise_activities`
--
ALTER TABLE `exercise_activities`
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
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exercise_activities`
--
ALTER TABLE `exercise_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
