-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2015 at 06:26 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `omt`
--

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE IF NOT EXISTS `password` (
  `email` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE IF NOT EXISTS `project_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_progress` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_name` (`project_name`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `project_name`, `created_by`, `created_on`, `project_progress`, `remarks`) VALUES
(1, 'First Project', 'nurealam.masud@gmail.com', '2015-05-26 07:03:49', 50, ''),
(2, 'Second Project', 'nurealam.masud@gmail.com', '2015-05-26 08:53:55', 100, ''),
(7, 'After Design', 'nurealam.masud@gmail.com', '2015-06-11 10:28:35', 0, ''),
(8, 'U Turn', 'nurealam.masud@gmail.com', '2015-06-13 04:27:06', 47, ''),
(9, 'June 15 project', 'nurealam.masud@gmail.com', '2015-06-15 11:03:26', 67, ''),
(10, 'Test Project 1', 'khairul0406@gmail.com', '2015-06-25 04:29:32', 0, ''),
(11, 'new project', 'khairul0406@gmail.com', '2015-06-29 03:28:20', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE IF NOT EXISTS `task_comments` (
  `project` varchar(255) NOT NULL,
  `task` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_by` varchar(255) NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_comments`
--

INSERT INTO `task_comments` (`project`, `task`, `comment`, `comment_by`, `comment_time`) VALUES
('1', '12', 'First comment.', 'nurealam.masud@gmail.com', '2015-06-02 06:43:39'),
('1', '12', 'This is the second comment.', 'nurealam.masud@gmail.com', '2015-06-02 06:48:50'),
('1', '15', 'This comment is in project 1, task 15.', 'admin@admin.com', '2015-06-04 06:02:19'),
('1', '15', 'Task id 15 is assigned to me. Project 1.', 'nurealam.masud@gmail.com', '2015-06-04 06:03:14'),
('1', '21', 'Shop was closed today.\r\nJun 4th.', 'nurealam.masud@gmail.com', '2015-06-04 12:25:59'),
('1', '22', 'First comment.', 'nurealam.masud@gmail.com', '2015-06-14 05:56:09'),
('1', '22', 'Second comment.', 'nurealam.masud@gmail.com', '2015-06-14 06:00:56'),
('1', '2', 'Imam Khomeini turned us into a motivated, hopeful and dynamic people who enjoyed great goals. Today, the people of Iran are dynamic, motivated and hopeful and they are moving towards great goals. Of course, we are far away from reaching our goals, but the important point is that we are moving towards them. The important point is that our people enjoy energy and the determination to make progress. The important point is that our youth believe that they can reach these goals, that they can completely achieve social justice, that they can bring progress and wealth to this country and that they can help us become an advanced and powerful country, as befits our historical identity. Today, this hope moves like a wave through our country and our youth are moving in this direction. We have saved ourselves from intoxication and drowsiness. This was done by our magnanimous Imam''s (r.a.) movement. It was done by that great man. Ayatollah Khamenei, 6/4/2015?', 'nurealam.masud@gmail.com', '2015-06-15 09:32:00'),
('9', '29', 'comment.', 'nurealam.masud@gmail.com', '2015-06-15 11:13:14'),
('8', '25', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'khairul0406@gmail.com', '2015-06-22 06:17:24'),
('8', '25', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'khairul0406@gmail.com', '2015-06-22 06:17:39'),
('8', '25', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'khairul0406@gmail.com', '2015-06-22 06:18:10'),
('8', '25', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'khairul0406@gmail.com', '2015-06-22 06:18:33'),
('8', '25', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'khairul0406@gmail.com', '2015-06-22 06:19:05'),
('8', '26', 'First comment.', 'nurealam.masud@gmail.com', '2015-06-23 06:04:34'),
('8', '26', 'Second comment', 'nurealam.masud@gmail.com', '2015-06-23 06:04:40'),
('8', '26', 'Third comment', 'nurealam.masud@gmail.com', '2015-06-23 06:04:45'),
('8', '41', 'This is the first comment.', 'nurealam.masud@gmail.com', '2015-06-24 06:36:03'),
('8', '41', 'Tesh Comment', 'khairul0406@gmail.com', '2015-06-24 07:12:09'),
('1', '18', 'This is an ongoing task. It was marked as Done first, then the status has been changed back to Ongoing. The task is likely to go on for quite some days...', 'nurealam.masud@gmail.com', '2015-06-28 04:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `task_details`
--

CREATE TABLE IF NOT EXISTS `task_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `assigned_to` varchar(255) NOT NULL,
  `assigned_by` varchar(255) NOT NULL,
  `assigned_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) NOT NULL DEFAULT 'unfinished',
  `completed_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `task_details`
--

INSERT INTO `task_details` (`id`, `project_name`, `task_name`, `assigned_to`, `assigned_by`, `assigned_on`, `deadline`, `status`, `completed_on`, `remarks`) VALUES
(13, '2', 'Task 1', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-04 10:16:03', '2015-05-18 18:00:00', 'unfinished', '2015-06-04 10:16:03', ''),
(14, '2', 'Task 2', 'admin@admin.com', 'nurealam.masud@gmail.com', '2015-05-31 09:57:07', '2015-05-12 18:00:00', 'unfinished', '2015-05-31 09:57:07', ''),
(18, '1', 'Task 13', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 03:59:08', '2015-06-10 18:00:00', 'ongoing', '2015-06-28 03:59:08', ''),
(19, '1', 'Task 14', 'admin@admin.com', 'nurealam.masud@gmail.com', '2015-06-23 05:39:34', '2015-06-16 18:00:00', 'finished', '2015-06-04 10:14:26', ''),
(20, '1', 'Task 15', 'admin@admin.com', 'nurealam.masud@gmail.com', '2015-06-23 05:39:34', '2015-06-23 18:00:00', 'finished', '2015-06-04 10:14:27', ''),
(27, '1', 'asdft', 'admin@admin.com', 'nurealam.masud@gmail.com', '2015-06-23 05:39:34', '2015-06-09 18:00:00', 'finished', '2015-06-21 06:03:36', ''),
(29, '9', 'new task', 'admin@admin.com', 'nurealam.masud@gmail.com', '2015-06-15 11:09:19', '2015-06-18 18:00:00', 'unfinished', '2015-06-15 11:09:19', ''),
(30, '1', 'meet head of dept', 'faysalnahid36@gmail.com', 'nurealam.masud@gmail.com', '2015-06-15 13:53:34', '2015-06-16 18:00:00', 'unfinished', '2015-06-15 13:53:34', ''),
(32, '8', 'New Task', 'khairul0406@gmail.com', 'khairul0406@gmail.com', '2015-06-28 05:15:18', '2015-06-11 18:00:00', 'finished', '2015-06-28 05:15:18', ''),
(33, '8', 'Task 3', 'khairul0406@gmail.com', 'khairul0406@gmail.com', '2015-06-25 09:05:47', '2015-06-18 18:00:00', 'ongoing', '2015-06-25 09:05:47', ''),
(34, '8', 'Task 3', 'khairul0406@gmail.com', 'khairul0406@gmail.com', '2015-06-28 05:15:16', '2015-06-11 18:00:00', 'finished', '2015-06-28 05:15:16', ''),
(35, '8', 'Task 4', 'khairul0406@gmail.com', 'khairul0406@gmail.com', '2015-06-23 05:17:04', '2015-06-03 18:00:00', 'held', '0000-00-00 00:00:00', ''),
(36, '8', 'Task 5', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-25 08:59:32', '2015-06-16 18:00:00', 'held', '2015-06-25 08:59:32', ''),
(37, '8', 'Task Name', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-28 05:15:17', '2015-06-11 18:00:00', 'finished', '2015-06-28 05:15:17', ''),
(38, '8', 'Test Task', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-23 05:39:54', '2015-06-29 18:00:00', 'held', '0000-00-00 00:00:00', ''),
(39, '8', 'New Task Created', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-23 05:39:54', '2015-06-26 18:00:00', 'held', '0000-00-00 00:00:00', ''),
(41, '8', 'This task is to check comment.', 'khairul0406@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 05:15:19', '2015-06-24 18:00:00', 'finished', '2015-06-28 05:15:19', ''),
(42, '8', 'Task to check date time pick', 'khairul0406@gmail.com', 'khairul0406@gmail.com', '2015-06-25 04:25:39', '0000-00-00 00:00:00', 'ongoing', '0000-00-00 00:00:00', ''),
(44, '1', 'Another task', 'khairul0406@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 03:59:09', '0000-00-00 00:00:00', 'ongoing', '2015-06-28 03:59:09', ''),
(45, '8', 'date check', 'khairul0406@gmail.com', 'khairul0406@gmail.com', '2015-06-25 08:59:39', '0000-00-00 00:00:00', 'finished', '2015-06-25 08:59:39', ''),
(48, '10', 'Task to check date time pick', 'nurealam.masud@gmail.com', 'khairul0406@gmail.com', '2015-06-25 05:31:11', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(49, '10', 'Remove hyperlink underline of project title on task comment page', 'khairul0406@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 05:33:01', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(50, '8', 'project date time', 'khairul0406@gmail.com', 'khairul0406@gmail.com', '2015-06-25 08:56:58', '0000-00-00 00:00:00', 'ongoing', '2015-06-25 08:56:58', ''),
(51, '8', 'Date time', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-28 05:15:21', '0000-00-00 00:00:00', 'finished', '2015-06-28 05:15:21', ''),
(52, '8', 'date time picker', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-28 05:15:22', '0000-00-00 00:00:00', 'finished', '2015-06-28 05:15:22', ''),
(53, '8', 'date time picker1', 'nurealam.masud@gmail.com', 'khairul0406@gmail.com', '2015-06-25 08:57:02', '0000-00-00 00:00:00', 'ongoing', '2015-06-25 08:57:02', ''),
(54, '10', 'Task 3', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 06:12:30', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(55, '8', 'task 101', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-25 08:59:31', '0000-00-00 00:00:00', 'held', '2015-06-25 08:59:31', ''),
(56, '10', 'new new', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 06:39:48', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(57, '10', 'new 2', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 07:29:08', '2015-06-16 18:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(58, '10', 'date time local', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 07:53:02', '2015-06-30 06:30:00', 'unfinished', '0000-00-00 00:00:00', ''),
(59, '10', 'new 3', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 08:46:11', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(60, '10', 'not working', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 09:06:26', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(61, '10', 'new 4', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 09:18:29', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(62, '10', '6/25/2015 3:23 PM', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 09:23:46', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(63, '10', '6/25/2015 3:28 PM', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 09:28:44', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(64, '10', '6/25/2015 3:29 PM', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-25 09:29:14', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(70, '10', '6/27/2015 12:29 PM', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-27 06:29:28', '0000-00-00 00:00:00', 'unfinished', '0000-00-00 00:00:00', ''),
(71, '10', 'FROM SQL', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-27 06:34:37', '2015-06-27 06:29:00', 'unfinished', '0000-00-00 00:00:00', ''),
(72, '10', 'using php query', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-27 06:38:59', '2015-06-28 06:38:00', 'unfinished', '0000-00-00 00:00:00', ''),
(73, '8', 'Time input working', 'khairul0406@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 08:28:48', '2015-06-28 20:00:00', 'finished', '2015-06-28 08:28:48', ''),
(74, '9', 'Task 1', 'faysalnahid36@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 09:04:34', '2015-06-28 09:03:00', 'finished', '2015-06-28 09:04:34', ''),
(75, '9', 'Task 2', 'khairul0406@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 09:04:35', '2015-06-30 09:04:00', 'finished', '2015-06-28 09:04:35', ''),
(76, '9', 'Task 3', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 09:05:05', '2015-06-30 09:04:00', 'finished', '2015-06-28 09:05:05', ''),
(77, '9', 'Task 4', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 09:05:18', '2015-06-28 09:04:00', 'finished', '2015-06-28 09:05:18', ''),
(78, '9', 'Task 5', 'nurealam.masud@gmail.com', 'nurealam.masud@gmail.com', '2015-06-28 09:04:59', '2015-06-28 09:04:00', 'unfinished', '0000-00-00 00:00:00', ''),
(79, '11', 'task 1', 'faysalnahid36@gmail.com', 'khairul0406@gmail.com', '2015-06-29 03:28:50', '2015-06-29 19:30:00', 'unfinished', '0000-00-00 00:00:00', '');

--
-- Triggers `task_details`
--
DROP TRIGGER IF EXISTS `on_delete_update_proejct_list`;
DELIMITER //
CREATE TRIGGER `on_delete_update_proejct_list` AFTER DELETE ON `task_details`
 FOR EACH ROW UPDATE project_list SET project_progress = (SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = OLD.project_name AND status='finished')*100/(SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = OLD.project_name) WHERE id=OLD.project_name
//
DELIMITER ;
DROP TRIGGER IF EXISTS `on_insert_update_project_list`;
DELIMITER //
CREATE TRIGGER `on_insert_update_project_list` AFTER INSERT ON `task_details`
 FOR EACH ROW UPDATE project_list SET project_progress = (SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name AND status='finished')*100/(SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name) WHERE id=NEW.project_name
//
DELIMITER ;
DROP TRIGGER IF EXISTS `on_update_update_project_list`;
DELIMITER //
CREATE TRIGGER `on_update_update_project_list` AFTER UPDATE ON `task_details`
 FOR EACH ROW UPDATE project_list SET project_progress = (SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name AND status='finished')*100/(SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name) WHERE id=NEW.project_name
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE IF NOT EXISTS `temp_user` (
  `first_name` varchar(16) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(16) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `admin`) VALUES
(3, 'Nure Alam', 'Masud', 'nurealam.masud@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', b'1'),
(4, 'Khairul', 'Islam', 'khairul0406@gmail.com', '099ebea48ea9666a7da2177267983138', b'1'),
(5, 'Faysal', 'Nahid', 'faysalnahid36@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
