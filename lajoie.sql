-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 23, 2021 at 03:20 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lajoie`
--

-- --------------------------------------------------------

--
-- Table structure for table `knowledges`
--

CREATE TABLE `knowledges` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `knowledges`
--

INSERT INTO `knowledges` (`id`, `name`) VALUES
(1, 'Disease'),
(2, 'Theory');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_details`
--

CREATE TABLE `knowledge_details` (
  `id` int(5) NOT NULL,
  `knowledge_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `knowledge_details`
--

INSERT INTO `knowledge_details` (`id`, `knowledge_id`, `name`, `text`) VALUES
(1, 2, 'What is Psychology?', 'Dr. Dra. Nina M. Armando, M.Si dalam bukunya yang berjudul “Psikologi Komunikasi” menjelaskan bahwa psikologi adalah studi ilmiah mengenai perilaku dan proses mental, dimana pernyataan ini dikutip dari Papalia & Olds, 1985 dan Weber, 1992.  Kata “psikologi” datang dari kata Latin psyche yang artinya jiwa/soul dan logos berarti kata/wacana. Dalam definisi yang diutarakan pada awal ditemukannya psikologi, beberapa ahli berpendapat bahwa psikologi merupakan wacana mengenai jiwa yang mengartikan behaviour atau perilaku sebagai tindakan yang dapat diobservasi dan diinterpretasikan secara luas. Psikologi juga meneliti hal-hal kecil dalam kejiwaan yang dapat diamati secara langsung, seperti memersepsi, berpikir, mengingat, dan merasa. '),
(2, 2, 'What is Mental Disease?', 'Dalam bukunya, Diana Vidya menjelaskan bahwa kesehatan mental merupakan salah satu kajian dalam ilmu kejiwaan yang sudah dikenal sejak abad ke-19, seperti di Jerman pada tahun 1875 M. Kesehatan mental awalnya hanya terbatas pada individu yang mempunyai gangguan kejiwaan dan tidak diperuntukkan bagi setiap individu pada umumnya. Namun, pandangan tersebut bergeser sehingga kesehatan mental mampu mencakup pembahasan seluruh individu, baik yang terkena gangguang kejiwaan maupun tidak. \r\nKesehatan mental sendiri diungkapkan berkaitan dengan beberapa hal, dimana yang pertama ialah bagaimana seorang individu memikirkan, merasakan, dan menjalani keseharian dalam kehidupan. Kemudian, kesehatan mental juga mencakup bagaimana seseorang memandang diri sendiri dan orang lain, juga bagaimana seseorang mengevaluasi berbagai alternatif solusi dan bagaimana mereka mengambil sebuah keputusan terhadap keadaan yang dihadapi(Yusuf, 2011). Kesehatan mental merupakan keharmonisan dalam kehidupan yang terwujud antara fungsi-fungsi jiwa, kemampuan menghadapi problematika yang dihadapi, serta mampu merasakan kebahagiaan dan kemampuan dirinya secara positif (Daradjat, 1988). \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `question_id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `experience` varchar(255) NOT NULL,
  `document` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL,
  `user_type_id` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `user_type_id`) VALUES
(1, 'Faruk Maulana', 'fark@gmail.com', 'fark', '$2y$10$JA3Y/OqSYKhW1R72JAcwwOjbi0p2BKcC/IXneV8bIVJKw7BXC4l4K', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(1) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `knowledges`
--
ALTER TABLE `knowledges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knowledge_details`
--
ALTER TABLE `knowledge_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `knowledge_details_fk0` (`knowledge_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_fk0` (`user_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_fk0` (`user_id`),
  ADD KEY `responses_fk1` (`question_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissions_fk0` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_fk0` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `knowledges`
--
ALTER TABLE `knowledges`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `knowledge_details`
--
ALTER TABLE `knowledge_details`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `knowledge_details`
--
ALTER TABLE `knowledge_details`
  ADD CONSTRAINT `knowledge_details_fk0` FOREIGN KEY (`knowledge_id`) REFERENCES `knowledges` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `responses_fk1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk0` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
