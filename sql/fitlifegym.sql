-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 11:10 AM
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
(7, 1, 90.00, 176.00, 29.05, '2026-04-12 13:23:13', '2026-04-28 07:11:13', 'Overweight', 'No Plan'),
(8, 3, 80.00, 175.00, 26.12, '2026-04-21 21:39:20', '2026-04-21 13:39:20', 'Overweight', 'No Plan');

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
(208, 1, 'WORKOUT_EHF323_151129', 'Brisk Walking or Light Jog on Treadmill', 15, NULL, 0, 0, 'Monday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(209, 1, 'WORKOUT_EHF323_151129', 'Bodyweight Circuit (Repeat 3 Times)', 20, NULL, 0, 0, 'Monday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(210, 1, 'WORKOUT_EHF323_151129', 'Jumping Jacks', 30, NULL, 3, 0, 'Monday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(211, 1, 'WORKOUT_EHF323_151129', 'Bodyweight Squats', 30, NULL, 3, 0, 'Monday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(212, 1, 'WORKOUT_EHF323_151129', 'Push-ups (Modified if needed)', 30, NULL, 3, 0, 'Monday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(213, 1, 'WORKOUT_EHF323_151129', 'Rest', 2, NULL, 0, 0, 'Monday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(214, 1, 'WORKOUT_EHF323_151129', 'Stationary Cycling or Marching in Place', 15, NULL, 0, 0, 'Wednesday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(215, 1, 'WORKOUT_EHF323_151129', 'Circuit (Repeat 3 Times)', 20, NULL, 0, 0, 'Wednesday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(216, 1, 'WORKOUT_EHF323_151129', 'High Knees Marching', 30, NULL, 3, 0, 'Wednesday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(217, 1, 'WORKOUT_EHF323_151129', 'Bodyweight Lunges', 30, NULL, 3, 0, 'Wednesday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(218, 1, 'WORKOUT_EHF323_151129', 'Modified Plank', 30, NULL, 3, 0, 'Wednesday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(219, 1, 'WORKOUT_EHF323_151129', 'Rest', 2, NULL, 0, 0, 'Wednesday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(220, 1, 'WORKOUT_EHF323_151129', 'Jump Rope or Mimic Jump Rope Motion', 15, NULL, 0, 0, 'Friday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(221, 1, 'WORKOUT_EHF323_151129', 'Circuit (Repeat 3 Times)', 20, NULL, 0, 0, 'Friday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(222, 1, 'WORKOUT_EHF323_151129', 'Mountain Climbers (Modified if needed)', 30, NULL, 3, 0, 'Friday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(223, 1, 'WORKOUT_EHF323_151129', 'Glute Bridges', 30, NULL, 3, 0, 'Friday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(224, 1, 'WORKOUT_EHF323_151129', 'Bicycle Crunches (Modified)', 30, NULL, 3, 0, 'Friday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(225, 1, 'WORKOUT_EHF323_151129', 'Rest', 2, NULL, 0, 0, 'Friday', '2026-04-28 15:11:29', '2026-04-28 07:11:29'),
(226, 1, 'WORKOUT_EHF323_151129', 'Light Cardio (Walking or Easy Cycling)', 1, NULL, 0, 0, 'Tuesday', '2026-04-28 15:11:29', '2026-04-28 07:21:26'),
(227, 1, 'WORKOUT_EHF323_151129', 'Circuit Review (Repeat 2 Times)', 1, NULL, 0, 0, 'Tuesday', '2026-04-28 15:11:29', '2026-04-28 07:21:29'),
(228, 1, 'WORKOUT_EHF323_151129', 'Side Leg Raises', 1, NULL, 3, 0, 'Tuesday', '2026-04-28 15:11:29', '2026-04-28 07:21:31'),
(229, 1, 'WORKOUT_EHF323_151129', 'Seated or Wall Push-ups', 1, NULL, 3, 0, 'Tuesday', '2026-04-28 15:11:29', '2026-04-28 07:21:33'),
(230, 1, 'WORKOUT_EHF323_151129', 'Deep Breathing & Stretching', 1, NULL, 0, 0, 'Tuesday', '2026-04-28 15:11:29', '2026-04-28 07:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `training_logs`
--

CREATE TABLE `training_logs` (
  `id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `workplan_id` varchar(255) NOT NULL,
  `workout` varchar(255) NOT NULL,
  `sets` int(11) NOT NULL,
  `duration` double(5,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `day` varchar(255) NOT NULL,
  `progress` varchar(11) NOT NULL,
  `personal_best` int(11) NOT NULL,
  `cycle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_logs`
--

INSERT INTO `training_logs` (`id`, `exercise_id`, `workplan_id`, `workout`, `sets`, `duration`, `status`, `created_at`, `modified_at`, `day`, `progress`, `personal_best`, `cycle`) VALUES
(109, 226, 'WORKOUT_EHF323_151129', 'Light Cardio (Walking or Easy Cycling)', 0, 15.00, 'finished', '2026-04-28 15:20:59', '2026-04-28 07:23:53', 'Tuesday', '100', 5, 0),
(110, 227, 'WORKOUT_EHF323_151129', 'Circuit Review (Repeat 2 Times)', 0, 1.00, 'finished', '2026-04-28 15:23:56', '2026-04-28 07:30:42', 'Tuesday', '100', 3, 0);

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
  `existing_plan` int(11) NOT NULL DEFAULT 0,
  `profile_image` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email_address`, `password`, `contact_no`, `created_at`, `modified_at`, `access_level`, `first_time_logged_in`, `existing_plan`, `profile_image`) VALUES
(1, 'Alexis Jaye', 'Dumale', 'ajcodalify@gmail.com', '$2y$10$zPorEKYvwaPhsiT/c4myiuQLEoJ.NPxWEIKqzcSgIVbO9VTje5aNu', '09324435144', '2026-04-02 20:09:16', '2026-04-28 07:11:29', 'Client', 0, 1, 'IMG_69eaea344b2d64.92371690.png'),
(2, 'Alexis', 'De Leon', 'alexisdumale@gmail.com', '$2y$10$4C99ZivsNabiuyfhXb0fH.lcz6FukOriEsa664z8w5j19.xgY0Lqq', '09772639814', '2026-04-02 20:10:42', '2026-04-09 04:43:21', 'Client', 1, 0, ''),
(3, 'Juan', 'Dela Cruz', 'juandelacruz@gmail.com', '$2y$10$DZl4uHLuOp1h6iJojKUhDOp6gjnTj051vabOF9HzS3sZBzpOsDTcC', '09533307696', '2026-04-21 21:30:53', '2026-04-21 13:39:20', 'Client', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_bmi_histories`
--

CREATE TABLE `user_bmi_histories` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `weight` double(5,2) NOT NULL,
  `height` double(5,2) NOT NULL,
  `bmi_classification` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `workout_plan_id` varchar(255) NOT NULL,
  `BMI` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_bmi_histories`
--

INSERT INTO `user_bmi_histories` (`id`, `client_id`, `weight`, `height`, `bmi_classification`, `status`, `created_at`, `workout_plan_id`, `BMI`) VALUES
(5, 1, 90.00, 176.00, 'Overweight', '', '2026-04-28 14:21:55', '', 29.05),
(6, 1, 90.00, 176.00, 'Overweight', '', '2026-04-28 14:22:48', '', 29.05),
(7, 1, 90.00, 176.00, 'Overweight', '', '2026-04-28 14:23:32', '', 29.05),
(8, 1, 90.00, 176.00, 'Overweight', '', '2026-04-28 14:23:43', '', 29.05),
(9, 1, 90.00, 176.00, 'Overweight', '', '2026-04-28 14:24:48', '', 29.05);

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
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  `remaining_session` int(11) NOT NULL,
  `total_weeks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`id`, `workout_plan_id`, `client_id`, `workout_plan`, `level`, `duration`, `day_per_week`, `current_bmi`, `created_at`, `modified_at`, `status`, `remaining_session`, `total_weeks`) VALUES
(53, 'WORKOUT_HLN820_145346', 1, 'Walking + light full-body workouts', 'Beginner', 4, 3, '29.05', '2026-04-28 14:53:46', '2026-04-28 07:11:13', 'Cancelled', 0, 0),
(54, 'WORKOUT_EHF323_151129', 1, 'Walking + light full-body workouts', 'Beginner', 4, 3, '29.05', '2026-04-28 15:11:29', '2026-04-28 07:11:29', 'Active', 0, 0);

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
-- Indexes for table `training_logs`
--
ALTER TABLE `training_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bmi_histories`
--
ALTER TABLE `user_bmi_histories`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exercise_activities`
--
ALTER TABLE `exercise_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `training_logs`
--
ALTER TABLE `training_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_bmi_histories`
--
ALTER TABLE `user_bmi_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
