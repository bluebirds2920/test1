-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 06:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cranerental`
--

-- --------------------------------------------------------

--
-- Table structure for table `crane`
--

CREATE TABLE `crane` (
  `c_id` int(11) NOT NULL,
  `ct_id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_img` varchar(50) NOT NULL,
  `c_details` varchar(200) NOT NULL,
  `c_num` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crane`
--

INSERT INTO `crane` (`c_id`, `ct_id`, `c_name`, `c_img`, `c_details`, `c_num`) VALUES
(2, 1, 'xxx', '1782166911.jpg', 'asdasdasd', 3500),
(8, 1, 'xxxxx', '2085018003.jpg', 'asd', 4000),
(12, 1, 'xxxxasd', '33873466.jpg', 'asd', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `cranerent`
--

CREATE TABLE `cranerent` (
  `cr_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `cr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cranerent`
--

INSERT INTO `cranerent` (`cr_id`, `r_id`, `cr_date`) VALUES
(9, 8, '2022-08-20'),
(10, 8, '2022-08-21'),
(11, 8, '2022-08-23'),
(12, 8, '2022-08-24'),
(13, 8, '2022-08-25'),
(14, 8, '2022-08-26'),
(15, 8, '2022-08-28'),
(16, 8, '2022-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `cranetype`
--

CREATE TABLE `cranetype` (
  `ct_id` int(11) NOT NULL,
  `ct_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cranetype`
--

INSERT INTO `cranetype` (`ct_id`, `ct_name`) VALUES
(1, 'รถเครนทั่วไป'),
(2, 'รถบรรทุกติดเครน');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `em_id` int(11) NOT NULL,
  `em_firstname` varchar(200) NOT NULL,
  `em_lastname` varchar(200) NOT NULL,
  `em_phone` varchar(50) NOT NULL,
  `em_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`em_id`, `em_firstname`, `em_lastname`, `em_phone`, `em_img`) VALUES
(2, 'karinsss', 'sukchaiss', '0800078813ss', '880677209.jpg'),
(4, 'karinsss', 'sukchai', '0800078813', '1947797794.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `pm_id` int(11) NOT NULL,
  `pm_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`pm_id`, `pm_name`) VALUES
(1, 'เงินสด'),
(2, 'โอนจ่าย'),
(3, 'เครดิต');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `rcpt_id` int(11) NOT NULL,
  `rating_num` int(11) NOT NULL,
  `rating_details` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rcpt_id`, `rating_num`, `rating_details`) VALUES
(4, 9, 2, 'dddddd'),
(5, 10, 1, 'asdasdasdasd'),
(6, 9, 4, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
(7, 4, 5, 'asdqwetcxvqwrthsasfynynsad1w'),
(8, 10, 4, 'ดีมาก'),
(9, 4, 5, 'ยอดเยี่ยม');

-- --------------------------------------------------------

--
-- Table structure for table `rcpt`
--

CREATE TABLE `rcpt` (
  `rcpt_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `rcpt_date` date NOT NULL DEFAULT current_timestamp(),
  `rcpt_num` int(11) NOT NULL,
  `rcpt_allnum` int(11) NOT NULL,
  `rcpt_role` varchar(50) NOT NULL,
  `rcpt_rating` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rcpt`
--

INSERT INTO `rcpt` (`rcpt_id`, `r_id`, `rcpt_date`, `rcpt_num`, `rcpt_allnum`, `rcpt_role`, `rcpt_rating`) VALUES
(4, 8, '2022-08-22', 2975, 8925, 'ชำระสำเร็จ', 'ให้คะแนนสำเร็จ'),
(9, 14, '2022-08-22', 2975, 5950, 'ชำระสำเร็จ', 'ให้คะแนนสำเร็จ'),
(10, 13, '2022-08-22', 3400, 6800, 'ชำระสำเร็จ', 'ให้คะแนนสำเร็จ');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `r_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `r_startdate` date NOT NULL,
  `r_numdate` int(11) NOT NULL,
  `r_place` varchar(500) NOT NULL,
  `pm_id` int(11) NOT NULL,
  `r_role` varchar(500) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`r_id`, `c_id`, `r_startdate`, `r_numdate`, `r_place`, `pm_id`, `r_role`, `users_id`) VALUES
(8, 2, '2022-08-20', 3, 'สุรนารีx', 1, 'ตรวจสอบเสร็จสิ้น', 11),
(13, 8, '2022-08-17', 2, 'สุรนารี', 3, 'ตรวจสอบเสร็จสิ้น', 11),
(14, 2, '2022-08-29', 2, 'สุรนารี', 3, 'ตรวจสอบเสร็จสิ้น', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `urole` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `email`, `password`, `fullname`, `phonenumber`, `urole`) VALUES
(9, 'bluebirds2920@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'karin sukchai', '123456', 'admin'),
(10, 'sboon99@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'xxx ssss', '08000782', 'VIP'),
(11, 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ศิวัช ณะคราม', '0800078813', 'VIP'),
(15, 'test3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'eee', '08000782222d', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `users_question`
--

CREATE TABLE `users_question` (
  `uqt_id` int(11) NOT NULL,
  `uqt_firstname` varchar(50) NOT NULL,
  `uqt_lastname` varchar(50) NOT NULL,
  `uqt_phone` varchar(50) NOT NULL,
  `uqt_details` varchar(500) NOT NULL,
  `uqt_answer` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_question`
--

INSERT INTO `users_question` (`uqt_id`, `uqt_firstname`, `uqt_lastname`, `uqt_phone`, `uqt_details`, `uqt_answer`) VALUES
(13, 'ssss', 'sadasd', '0981023213', 'asdasd', 'xxxxxxasd'),
(14, 'asd', 'asd', '0981023213', 'asd', 'asd'),
(15, 'zap', 'siwat', '0981023213', 'ผมหล่อมั้ย', 'หล่อครับ'),
(16, 'asd', 'asd', '0981023213', 'asd', 'xxx'),
(17, 'zap', 'asd', '0981023213', 'asd', 'afq3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crane`
--
ALTER TABLE `crane`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `crane_ibfk_1` (`ct_id`);

--
-- Indexes for table `cranerent`
--
ALTER TABLE `cranerent`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `cranetype`
--
ALTER TABLE `cranetype`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`em_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `rcpt_id` (`rcpt_id`);

--
-- Indexes for table `rcpt`
--
ALTER TABLE `rcpt`
  ADD PRIMARY KEY (`rcpt_id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `pm_id` (`pm_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `users_question`
--
ALTER TABLE `users_question`
  ADD PRIMARY KEY (`uqt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crane`
--
ALTER TABLE `crane`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cranerent`
--
ALTER TABLE `cranerent`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cranetype`
--
ALTER TABLE `cranetype`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rcpt`
--
ALTER TABLE `rcpt`
  MODIFY `rcpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_question`
--
ALTER TABLE `users_question`
  MODIFY `uqt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crane`
--
ALTER TABLE `crane`
  ADD CONSTRAINT `crane_ibfk_1` FOREIGN KEY (`ct_id`) REFERENCES `cranetype` (`ct_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cranerent`
--
ALTER TABLE `cranerent`
  ADD CONSTRAINT `cranerent_ibfk_3` FOREIGN KEY (`r_id`) REFERENCES `rental` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`rcpt_id`) REFERENCES `rcpt` (`rcpt_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rcpt`
--
ALTER TABLE `rcpt`
  ADD CONSTRAINT `rcpt_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `rental` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `crane` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rental_ibfk_3` FOREIGN KEY (`pm_id`) REFERENCES `payment_type` (`pm_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
