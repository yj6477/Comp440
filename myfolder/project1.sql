-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 02:00 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--
DROP TABLE IF EXISTS blogs
CREATE TABLE `blogs` (
  `blogid` int(11) NOT NULL,
  `subject` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postuser` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blogid`, `subject`, `description`, `postuser`, `pdate`) VALUES
(1, 'magna vulputate luctus cum sociis', 'at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus', 'eklemke0', '2020-07-05'),
(2, 'in imperdiet', 'dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et', 'kjeroch1', '2020-06-26'),
(3, 'cubilia curae donec', 'eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu', 'hgude2', '2020-04-15'),
(4, 'quis justo maecenas rhoncus', 'proin interdum mauris non ligula pellentesque ultrices phasellus id sapien in sapien iaculis', 'ppach3', '2020-01-15'),
(5, 'justo pellentesque viverra pede ac', 'tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante', 'irottery4', '2020-09-15'),
(6, 'a odio in hac habitasse', 'id sapien in sapien iaculis congue vivamus metus arcu adipiscing', 'bdmytryk5', '2019-12-08'),
(7, 'duis aliquam', 'nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna', 'zeller6', '2020-06-16'),
(8, 'lacinia erat vestibulum sed', 'est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum', 'roriordan7', '2020-05-26'),
(9, 'maecenas tristique', 'ullamcorper purus sit amet nulla quisque arcu libero rutrum ac lobortis', 'mgebhardt8', '2020-02-20'),
(10, 'dolor quis odio', 'at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id', 'cheathorn9', '2020-03-12'),
(11, 'The future of blockchain', 'Blockchain is a buzz word nowadays. We will take about the future world of blockchain', 'test', '2020-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `blogtags`
--
DROP TABLE IF EXISTS blogtags
CREATE TABLE `blogtags` (
  `blogid` int(11) NOT NULL,
  `tag` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogtags`
--

INSERT INTO `blogtags` (`blogid`, `tag`) VALUES
(1, 'vulputate'),
(2, 'imperdiet'),
(3, 'cubilia'),
(4, 'quis justo'),
(5, 'vivirra'),
(6, 'habitasse'),
(7, 'duisali'),
(8, 'lacinia'),
(9, 'maecenas'),
(10, 'dolor'),
(11, 'blockchain');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS comments
CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL,
  `sentiment` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `blogid` int(11) NOT NULL,
  `author` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `sentiment`, `description`, `cdate`, `blogid`, `author`) VALUES
(1, 'positive', 'vestibulum proin eu mi nulla ac enim in', '2020-01-30', 1, 'kjeroch1'),
(2, 'negative', 'lobortis convallis tortor risus dapibus augue vel accumsan', '2019-11-20', 11, 'hgude2'),
(3, 'negative', 'orci luctus et ultrices posuere cubilia curae', '2020-08-02', 2, 'ppach3'),
(4, 'negative', 'nulla dapibus dolor vel est donec odio justo sollicitudin', '2020-01-23', 3, 'irottery4'),
(5, 'positive', 'cras in purus eu magna vulputate luctus cum sociis natoque', '2020-03-19', 5, 'bdmytryk5'),
(6, 'positive', 'elementum eu interdum eu tincidunt in leo', '2019-12-14', 6, 'zeller6'),
(7, 'positive', 'ornare imperdiet sapien urna pretium nisl ut', '2020-10-22', 7, 'roriordan7'),
(8, 'positive', 'libero nullam sit amet turpis elementum ligula', '2020-09-23', 8, 'mgebhardt8'),
(9, 'positive', 'suspendisse potenti cras in purus eu', '2020-04-11', 9, 'cheathorn9'),
(10, 'negative', 'magna at nunc commodo placerat praesent blandit nam nulla', '2020-01-21', 10, 'eklemke0'),
(11, 'positive', 'viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum', '2020-06-10', 11, 'kjeroch1'),
(12, 'positive', 'feugiat non pretium quis lectus', '2020-11-14', 5, 'test'),
(13, 'positive', 'This is a nice blog. I like the comparison between blockchain and the Internet.', '2020-11-10', 11, 'eklemke0');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--
DROP TABLE IF EXISTS follows
CREATE TABLE `follows` (
  `leader` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `follower` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`leader`, `follower`) VALUES
('bdmytryk5', 'cheathorn9'),
('mgebhardt8', 'cheathorn9'),
('ppach3', 'hgude2'),
('bdmytryk5', 'irottery4'),
('eklemke0', 'irottery4'),
('test', 'irottery4'),
('zeller6', 'kjeroch1'),
('test', 'mgebhardt8'),
('zeller6', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--
DROP TABLE IF EXISTS hobbies
CREATE TABLE `hobbies` (
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `hobby` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`username`, `hobby`) VALUES
('bdmytryk5', 'dancing'),
('cheathorn9', 'swimming'),
('eklemke0', 'hiking'),
('hgude2', 'bowling'),
('irottery4', 'cooking'),
('kjeroch1', 'swimming'),
('mgebhardt8', 'hiking'),
('ppach3', 'movie'),
('roriordan7', 'movie'),
('test', 'cooking'),
('zeller6', 'calligraphy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS users
CREATE TABLE `users` (
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `firstname` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES
('bdmytryk5', 'jYMks6i0MQeh', 'Bliss', 'Dmytryk', 'bdmytryk5@patch.com'),
('cheathorn9', 'zDA26lfoWJM', 'Cherilyn', 'Heathorn', 'cheathorn9@discovery.com'),
('eklemke0', 'tfdgkDi', 'Ethel', 'Klemke', 'eklemke0@bandcamp.com'),
('hgude2', '2DLOfAL', 'Hector', 'Gude', 'hgude2@fastcompany.com'),
('irottery4', 'q5MwiCsQr02', 'Isidro', 'Rottery', 'irottery4@exblog.jp'),
('kjeroch1', 'jKFEqKG0', 'Karalynn', 'Jeroch', 'kjeroch1@huffingtonpost.com'),
('mgebhardt8', 'Ch5tY4B2RQS', 'Marigold', 'Gebhardt', 'mgebhardt8@google.it'),
('ppach3', 'DcXvVyJp', 'Paulie', 'Pach', 'ppach3@yale.edu'),
('roriordan7', 'I4jKJ9BnP', 'Ruth', 'Riordan', 'roriordan7@oracle.com'),
('test', 'pass1234', 'test', 'comp440', 'test@csun.edu'),
('zeller6', 'lowlbJj7K', 'Zorah', 'Eller', 'zeller6@barnesandnoble.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogid`),
  ADD KEY `postuser` (`postuser`);

--
-- Indexes for table `blogtags`
--
ALTER TABLE `blogtags`
  ADD PRIMARY KEY (`blogid`,`tag`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `blogid` (`blogid`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`leader`,`follower`),
  ADD KEY `follower` (`follower`);

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`username`,`hobby`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`postuser`) REFERENCES `users` (`username`);

--
-- Constraints for table `blogtags`
--
ALTER TABLE `blogtags`
  ADD CONSTRAINT `blogtags_ibfk_1` FOREIGN KEY (`blogid`) REFERENCES `blogs` (`blogid`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blogid`) REFERENCES `blogs` (`blogid`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`username`);

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`leader`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`follower`) REFERENCES `users` (`username`);

--
-- Constraints for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD CONSTRAINT `hobbies_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
