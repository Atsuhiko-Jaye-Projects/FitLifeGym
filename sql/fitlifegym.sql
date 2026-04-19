-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2026 at 07:56 AM
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
(82, 1, 'WORKOUT_EVC057_092541', 'Bodyweight Squats', 5, NULL, 3, 12, 'Monday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(83, 1, 'WORKOUT_EVC057_092541', 'Push-Ups (Modified if needed)', 5, NULL, 3, 10, 'Monday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(84, 1, 'WORKOUT_EVC057_092541', 'Walking or Jogging (Outdoor or Treadmill)', 20, NULL, 0, 0, 'Monday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(85, 1, 'WORKOUT_EVC057_092541', 'Plank', 3, NULL, 3, 0, 'Monday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(86, 1, 'WORKOUT_EVC057_092541', 'Rest or Light Activity (e.g., stretching, walking)', 60, NULL, 0, 0, 'Tuesday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(87, 1, 'WORKOUT_EVC057_092541', 'Dumbbell Deadlifts (Light weight)', 5, NULL, 3, 12, 'Wednesday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(88, 1, 'WORKOUT_EVC057_092541', 'Dumbbell Shoulder Press', 5, NULL, 3, 12, 'Wednesday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(89, 1, 'WORKOUT_EVC057_092541', 'Stationary Cycling or brisk walking', 20, NULL, 0, 0, 'Wednesday', '2026-04-19 09:25:41', '2026-04-19 01:25:41'),
(90, 1, 'WORKOUT_EVC057_092541', 'Bird Dog', 1, NULL, 3, 10, 'Sunday', '2026-04-19 09:25:41', '2026-04-19 04:02:06'),
(91, 1, 'WORKOUT_EVC057_092541', 'Rest or Light Activity (e.g., stretching, walking)', 1, NULL, 0, 0, 'Sunday', '2026-04-19 09:25:41', '2026-04-19 04:01:20');

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
  `progress` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_logs`
--

INSERT INTO `training_logs` (`id`, `exercise_id`, `workplan_id`, `workout`, `sets`, `duration`, `status`, `created_at`, `modified_at`, `day`, `progress`) VALUES
(96, 90, 'WORKOUT_EVC057_092541', 'Bird Dog', 10, 1.00, 'finished', '2026-04-19 12:19:31', '2026-04-19 04:20:32', 'Sunday', '100');

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
(1, 'Alexis', 'Dumale', 'ajcodalify@gmail.com', '$2y$10$zPorEKYvwaPhsiT/c4myiuQLEoJ.NPxWEIKqzcSgIVbO9VTje5aNu', '09533307696', '2026-04-02 20:09:16', '2026-04-19 01:25:41', 'Client', 0, 1),
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
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  `remaining_session` int(11) NOT NULL,
  `total_weeks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`id`, `workout_plan_id`, `client_id`, `workout_plan`, `level`, `duration`, `day_per_week`, `current_bmi`, `created_at`, `modified_at`, `status`, `remaining_session`, `total_weeks`) VALUES
(44, 'WORKOUT_EVC057_092541', 1, 'Light strength training + cardio + mobility', 'Beginner', 4, 3, '21.22', '2026-04-19 09:25:41', '2026-04-19 01:25:41', 'Active', 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `training_logs`
--
ALTER TABLE `training_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
