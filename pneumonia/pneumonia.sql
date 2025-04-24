-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 08:57 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pneumonia`
--

-- --------------------------------------------------------

--
-- Table structure for table `analyzer_results`
--

CREATE TABLE `analyzer_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image_path` varchar(489) DEFAULT NULL,
  `result` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analyzer_results`
--

INSERT INTO `analyzer_results` (`id`, `user_id`, `image_path`, `result`, `date`) VALUES
(6, 2, 'uploads/tt_2_1742239473.jpg', 'The\n chest X-ray shows findings consistent with pneumonia. There is increased opacity and consolidation\n in the right lower lung field, suggestive of an infectious process.  The extent\n and location suggest a lobar pneumonia.\n\n\nThis requires immediate medical attention.  A course of antibiotics tailored to the likely causative organism is necessary.  The specific\n antibiotic will depend on the results of sputum cultures and other tests your physician may order.  Supportive care such as rest, fluids, and symptomatic relief for fever\n and cough are also vital.  Oxygen therapy may be needed if blood oxygen levels are low.  The severity of the pneumonia will determine the need for hospitalization and potential monitoring for complications such as pleural effusion or respiratory failure.  It\'s\n critical to follow up with your physician regularly to monitor the effectiveness of treatment and ensure complete resolution of the infection.  Failure to seek appropriate treatment can lead to serious complications.\n', '2025-03-17 19:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(10) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_email`, `patient_name`, `doctor_id`, `doctor_name`, `appointment_date`, `appointment_time`, `status`) VALUES
(4, 'sagar@gmail.com', 'sagar', 3, 'kashish', '2025-03-11', '17:28', 'Done'),
(5, 'sagar@gmail.com', 'sagar', 3, 'kashish', '2025-09-23', '14:23', 'Pending'),
(6, 'sagar@gmail.com', 'kamo', 3, 'kashish', '1999-09-09', '23:00', 'Done'),
(7, 'kartik@gmail.com', 'Kartik Thakare', 1, 'sushil mohad', '2025-03-13', '08:00', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `experience` int(11) NOT NULL,
  `qualification` varchar(150) NOT NULL,
  `license_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `fullname`, `email`, `password`, `experience`, `qualification`, `license_number`) VALUES
(1, 'sushil mohad', 'doctor1@gmail.com', '12345', 4, 'MBBS , MD', '1294829MG'),
(3, 'kashish', 'kashish@gmail.com', '12345', 3, 'MD', 'HD6734');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `feedback_text` text,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `appointment_id`, `user_email`, `feedback_text`, `rating`, `created_at`) VALUES
(1, 6, 'sagar@gmail.com', 'nice', 5, '2025-03-17 18:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(2, 'sagar', 'sagar@gmail.com', '123', '2025-03-11 10:10:35'),
(3, 'Kartik Thakare', 'kartik@gmail.com', '123', '2025-03-13 05:54:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analyzer_results`
--
ALTER TABLE `analyzer_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

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
-- AUTO_INCREMENT for table `analyzer_results`
--
ALTER TABLE `analyzer_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
