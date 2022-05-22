-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2020 年 08 月 31 日 10:07
-- 伺服器版本： 5.6.49-cll-lve
-- PHP 版本： 7.3.6
-- harry beeno*/
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
use education1;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `education1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `center`
--

CREATE TABLE `center` (
  `center_ID` varchar(255) NOT NULL,
  `center_name` varchar(45) NOT NULL,
  `center_address` varchar(255) NOT NULL,
  `center_phoneNo` varchar(8) NOT NULL,
  `center_roomAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `center`
--

INSERT INTO `center` (`center_ID`, `center_name`, `center_address`, `center_phoneNo`, `center_roomAmount`) VALUES
('C001', 'Mong Kok Branch', 'LG, Mong Kok Center, Mong Kok', '25554444', 10),
('C002', 'Tiu Keng Leng Branch', 'G/F, Tiu Keng Leng Center, Tiu Keng Leng', '24212222', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `class`
--

CREATE TABLE `class` (
  `class_ID` int(255) NOT NULL,
  `course_ID` varchar(255) NOT NULL,
  `total_lessons` int(255) NOT NULL,
  `category_ID` int(255) NOT NULL,
  `attended_lesson` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `class`
--

INSERT INTO `class` (`class_ID`, `course_ID`, `total_lessons`, `category_ID`, `attended_lesson`) VALUES
(1, '3', 29, 5, 1),
(2, '1', 1, 1, 0),
(3, '1', 1, 2, 0),
(4, '2', 10, 3, 0),
(5, '3', 20, 6, 0),
(6, '3', 20, 7, 0),
(7, '4', 25, 8, 0),
(8, '5', 30, 11, 0),
(9, '4', 20, 9, 0),
(10, '4', 20, 10, 0),
(11, '5', 25, 12, 0),
(12, '6', 20, 13, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `class_category`
--

CREATE TABLE `class_category` (
  `category_ID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class_credit` int(255) NOT NULL,
  `class_hours` int(11) NOT NULL,
  `people_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `class_category`
--

INSERT INTO `class_category` (`category_ID`, `name`, `class_credit`, `class_hours`, `people_amount`) VALUES
(1, 'IELTS 1st Lesson', 50, 50, 50),
(2, 'DSE 1st Lesson', 50, 50, 50),
(3, 'Teacher Training', 50, 50, 50),
(4, 'Staff Training', 50, 50, 50),
(5, 'IELTS Class', 50, 50, 50),
(6, 'IELTS VIP', 50, 50, 50),
(7, 'IELTS Marking', 50, 50, 50),
(8, 'DSE Marking', 50, 50, 50),
(9, 'DSE Skype channel', 50, 50, 50),
(10, 'DSE Eng Speaking Mock', 50, 50, 50),
(11, 'Business Eng - Accounting', 50, 50, 50),
(12, 'Business Eng - IT', 50, 50, 50),
(13, 'High Dip - English', 50, 50, 50);

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `course_ID` varchar(255) NOT NULL,
  `course_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`course_ID`, `course_name`) VALUES
('1', '1st Lesson / Receiption Meet'),
('2', 'Training / Meeting'),
('3', 'IELTS'),
('4', 'DSE'),
('5', 'Business Eng'),
('6', 'Others'),
('7', 'CS');

-- --------------------------------------------------------

--
-- 資料表結構 `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_ID` int(11) NOT NULL,
  `course_ID` varchar(255) CHARACTER SET utf8 NOT NULL,
  `student_ID` varchar(255) CHARACTER SET utf8 NOT NULL,
  `class_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `enrollment`
--

INSERT INTO `enrollment` (`enrollment_ID`, `course_ID`, `student_ID`, `class_ID`) VALUES
(1, '3', 'SD000001', 1),
(2, '4', 'SD000001', 7),
(3, '3', 'SD000002', 1),
(4, '1', 'SD000002', 2),
(5, '5', 'SD000002', 8),
(6, '1', 'SD000010', 2),
(7, '3', 'SD000011', 1),
(8, '3', 'SD000012', 1),
(10, '3', 'SD000013', 1),
(13, '3', 'SD000014', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `homework`
--

CREATE TABLE `homework` (
  `homework_ID` int(11) NOT NULL,
  `class_ID` int(11) NOT NULL,
  `work_No` varchar(255) NOT NULL,
  `work_type` enum('Exam','Test','Lab') NOT NULL,
  `work_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `homework`
--

INSERT INTO `homework` (`homework_ID`, `class_ID`, `work_No`, `work_type`, `work_name`) VALUES
(1, 2, '1', 'Lab', 'work name'),
(2, 1, 'Lab01', 'Lab', 'php'),
(3, 1, 'Lab02', 'Lab', 'DB'),
(4, 1, 'LAB03', 'Lab', 'ABC'),
(5, 1, 'Lab04', 'Lab', 'DB'),
(8, 6, 'lab01', 'Lab', 'database'),
(9, 6, 'lab02', 'Lab', 'php'),
(10, 7, 'lab012', 'Lab', 'iohohj');

-- --------------------------------------------------------

--
-- 資料表結構 `manager`
--

CREATE TABLE `manager` (
  `manager_ID` varchar(255) NOT NULL,
  `staff_ID` varchar(255) NOT NULL,
  `center_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `manager`
--

INSERT INTO `manager` (`manager_ID`, `staff_ID`, `center_ID`) VALUES
('M001', 'ST001', 'C001'),
('M002', 'ST005', 'C002');

-- --------------------------------------------------------

--
-- 資料表結構 `preferral_workday`
--

CREATE TABLE `preferral_workday` (
  `staffID` varchar(255) NOT NULL,
  `weekday` varchar(45) NOT NULL,
  `workday_startTime` time NOT NULL,
  `workday_endTime` time NOT NULL,
  `workday_workhour` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `preferral_workday`
--

INSERT INTO `preferral_workday` (`staffID`, `weekday`, `workday_startTime`, `workday_endTime`, `workday_workhour`) VALUES
('ST002', 'Friday', '09:00:00', '17:00:00', 8),
('ST002', 'Monday', '09:00:00', '17:00:00', 8),
('ST002', 'Saturday', '09:00:00', '17:00:00', 8),
('ST002', 'Sunday', '09:00:00', '17:00:00', 8),
('ST002', 'Thursday', '09:00:00', '17:00:00', 8),
('ST002', 'Tuesday', '09:00:00', '17:00:00', 8),
('ST002', 'Wednesday', '09:00:00', '17:00:00', 8),
('ST003', 'Friday', '09:00:00', '17:00:00', 8),
('ST003', 'Monday', '09:00:00', '17:00:00', 8),
('ST003', 'Saturday', '09:00:00', '17:00:00', 8),
('ST003', 'Sunday', '09:00:00', '17:00:00', 8),
('ST003', 'Thursday', '09:00:00', '17:00:00', 8),
('ST003', 'Tuesday', '09:00:00', '17:00:00', 8),
('ST003', 'Wednesday', '09:00:00', '17:00:00', 8),
('ST004', 'Friday', '09:00:00', '17:00:00', 8),
('ST004', 'Monday', '12:00:00', '20:00:00', 8),
('ST004', 'Saturday', '09:00:00', '17:00:00', 8),
('ST004', 'Sunday', '00:00:00', '00:00:00', 0),
('ST004', 'Thursday', '00:00:00', '00:00:00', 0),
('ST004', 'Tuesday', '00:00:00', '00:00:00', 0),
('ST004', 'Wednesday', '00:00:00', '00:00:00', 0),
('ST006', 'Friday', '09:00:00', '17:00:00', 8),
('ST006', 'Monday', '09:00:00', '17:00:00', 8),
('ST006', 'Saturday', '09:00:00', '17:00:00', 8),
('ST006', 'Sunday', '09:00:00', '17:00:00', 8),
('ST006', 'Thursday', '09:00:00', '17:00:00', 8),
('ST006', 'Tuesday', '09:00:00', '17:00:00', 8),
('ST006', 'Wednesday', '09:00:00', '17:00:00', 8),
('ST007', 'Friday', '10:00:00', '18:00:00', 8),
('ST007', 'Monday', '10:00:00', '18:00:00', 8),
('ST007', 'Saturday', '10:00:00', '18:00:00', 8),
('ST007', 'Sunday', '10:00:00', '18:00:00', 8),
('ST007', 'Thursday', '10:00:00', '18:00:00', 8),
('ST007', 'Tuesday', '10:00:00', '18:00:00', 8),
('ST007', 'Wednesday', '10:00:00', '18:00:00', 8),
('ST008', 'Friday', '11:00:00', '19:00:00', 8),
('ST008', 'Monday', '11:00:00', '19:00:00', 8),
('ST008', 'Saturday', '11:00:00', '19:00:00', 8),
('ST008', 'Sunday', '11:00:00', '18:00:00', 7),
('ST008', 'Thursday', '11:00:00', '19:00:00', 8),
('ST008', 'Tuesday', '11:00:00', '17:00:00', 6),
('ST008', 'Wednesday', '12:00:00', '17:00:00', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `staff`
--

CREATE TABLE `staff` (
  `staff_ID` varchar(255) NOT NULL,
  `staff_name` varchar(45) NOT NULL,
  `staff_phoneNo` int(8) NOT NULL,
  `staff_email` varchar(254) NOT NULL,
  `staff_joinDate` date NOT NULL,
  `job_type` enum('manager','teacher','staff') NOT NULL,
  `staff_isActive` tinyint(1) NOT NULL,
  `salary` float NOT NULL,
  `staff_description` longtext,
  `staff_password` varchar(20) NOT NULL,
  `center_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `staff`
--

INSERT INTO `staff` (`staff_ID`, `staff_name`, `staff_phoneNo`, `staff_email`, `staff_joinDate`, `job_type`, `staff_isActive`, `salary`, `staff_description`, `staff_password`, `center_ID`) VALUES
('ST001', 'Wong Siu Ming', 98782111, 'wongsiuming@gmail.com', '2020-01-01', 'manager', 1, 30000, 'BUHK grad', 'abcd1234', 'C001'),
('ST002', 'Lee Ho Tung', 97540554, 'leehotung999@gmail.com', '2020-02-01', 'teacher', 1, 25000, 'HKU grad', 'abcd1234', 'C001'),
('ST003', 'Wong Ming', 98948400, 'wongmingming@gmail.com', '2020-02-01', 'staff', 1, 18000, 'testing', 'abcd1234', 'C001'),
('ST004', 'Ho Wai', 94505233, 'howai123@gmail.com', '2020-02-01', 'teacher', 1, 20000, 'usa U grad', 'abcd1234', 'C001'),
('ST005', 'Chan Yiu Hung', 95554878, 'yiuhung@gmail.com', '2020-06-02', 'manager', 1, 27000, 'testing1234', '1234abcd', 'C002'),
('ST006', 'Tong pong', 97554487, 'tongpong@gmail.com', '2020-06-03', 'teacher', 1, 20000, 'CU grad', '1234abcd', 'C002'),
('ST007', 'Fong Ho Ming', 94448888, 'homing@gmail.com', '2020-06-04', 'staff', 1, 15800, 'testing1234', '1234abcd', 'C002'),
('ST008', 'Tse Chun Yiu', 97215466, 'chungyiu789@gmail.com', '2020-06-04', 'teacher', 1, 24000, 'UK U grad', 'abcd1234', 'C002');

-- --------------------------------------------------------

--
-- 資料表結構 `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `staffAttendance_ID` int(6) NOT NULL,
  `staff_ID` varchar(255) NOT NULL,
  `center_ID` varchar(255) NOT NULL,
  `ST_StartDateTime` datetime DEFAULT NULL,
  `ST_EndDateTime` datetime DEFAULT NULL,
  `is_late` tinyint(1) DEFAULT NULL,
  `break_Time` float DEFAULT NULL,
  `real_workhours` float DEFAULT NULL,
  `ST_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `staff_attendance`
--

INSERT INTO `staff_attendance` (`staffAttendance_ID`, `staff_ID`, `center_ID`, `ST_StartDateTime`, `ST_EndDateTime`, `is_late`, `break_Time`, `real_workhours`, `ST_Date`) VALUES
(1, 'ST002', 'C001', '2020-08-23 17:55:46', '2020-08-23 17:55:57', 1, 0, 0, '2020-08-23'),
(2, 'ST003', 'C001', '2020-08-23 17:55:46', '2020-08-23 17:55:59', 1, 0, 0, '2020-08-23'),
(3, 'ST004', 'C001', '2020-08-23 17:55:47', '2020-08-23 17:56:01', 1, 0, 0, '2020-08-23'),
(4, 'ST002', 'C001', '2020-08-24 14:23:41', NULL, 1, 0, NULL, '2020-08-24'),
(5, 'ST003', 'C001', '2020-08-24 14:53:37', NULL, 1, 0, NULL, '2020-08-24'),
(6, 'ST004', 'C001', '2020-08-24 14:53:38', NULL, 1, 0, NULL, '2020-08-24'),
(7, 'ST002', 'C001', NULL, NULL, NULL, NULL, NULL, '2020-08-30'),
(8, 'ST003', 'C001', NULL, NULL, NULL, NULL, NULL, '2020-08-30'),
(9, 'ST004', 'C001', '2020-08-30 16:20:27', '2020-08-30 16:21:05', 1, 0, 0.01, '2020-08-30'),
(16, 'ST006', 'C002', '2020-08-31 17:08:01', '2020-08-31 17:08:25', 1, 0, 0.01, '2020-08-31'),
(17, 'ST007', 'C002', NULL, NULL, NULL, NULL, NULL, '2020-08-31'),
(18, 'ST008', 'C002', NULL, NULL, NULL, NULL, NULL, '2020-08-31');

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `student_ID` varchar(255) NOT NULL,
  `student_name` varchar(45) NOT NULL,
  `student_phoneNo` int(8) NOT NULL,
  `student_email` varchar(254) NOT NULL,
  `student_joinDate` date NOT NULL,
  `student_dateOfBirth` date NOT NULL,
  `student_isActive` tinyint(1) NOT NULL,
  `fullmark` int(11) NOT NULL,
  `student_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `student`
--

INSERT INTO `student` (`student_ID`, `student_name`, `student_phoneNo`, `student_email`, `student_joinDate`, `student_dateOfBirth`, `student_isActive`, `fullmark`, `student_password`) VALUES
('SD000001', 'Chan Tai Man', 97770215, 'chantaiman13@gmail.com', '2020-05-01', '1999-05-05', 1, 0, 'abcd1234'),
('SD000002', 'Wong Siu Tung', 94710000, 'siutung@gmail.com', '2020-07-01', '1998-01-05', 1, 0, 'abcd1234'),
('SD000003', 'Ho Chiu Po', 93452555, 'popo2555@gmail.com', '2020-06-11', '2002-01-05', 1, 0, 'abcd1234'),
('SD000004', 'Chan Jo', 93552885, 'hopo24455@gmail.com', '2020-07-11', '2004-11-05', 1, 0, 'abcd1234'),
('SD000005', 'Wong Tung', 65481555, 'tungtung123@gmail.com', '2020-07-11', '2004-06-05', 1, 0, 'abcd1234'),
('SD000006', 'Ko Chung Fu', 61234877, 'fufu777@gmail.com', '2020-07-11', '2002-07-05', 1, 0, 'abcd1234'),
('SD000007', 'Fu Ka Chun', 64210005, 'kaka77@gmail.com', '2020-07-11', '2002-08-05', 1, 0, 'abcd1234'),
('SD000008', 'Lam Kit', 68878765, 'ff@gmail.com', '2020-07-11', '2002-09-05', 1, 0, 'abcd1234'),
('SD000009', 'Lee Ming Ho', 68421544, 'hohoming@gmail.com', '2020-07-11', '2002-10-05', 1, 0, 'abcd1234'),
('SD000010', 'Jo Jo', 12345678, 'jojo@gmail.com', '2020-08-24', '2000-06-07', 1, 0, '12345678'),
('SD000011', 'CHAN TAI HO', 98888888, 'chan@gmail.com', '2020-08-22', '1994-03-31', 1, 0, '98888888'),
('SD000012', 'HO MING', 92345678, 'homing@gmail.com', '2020-08-30', '2000-05-05', 1, 0, 'abcd1234'),
('SD000013', 'Chan Tai', 98884000, 'chan@gmail.com', '2020-08-31', '2000-05-05', 1, 0, '98884000'),
('SD000014', 'Chan Tai wing', 96478226, 'chan123@gmail.com', '2020-08-31', '2000-03-07', 1, 0, '96478226');

-- --------------------------------------------------------

--
-- 資料表結構 `student_attendance`
--

CREATE TABLE `student_attendance` (
  `studentAttendance_ID` int(6) NOT NULL,
  `student_ID` varchar(255) NOT NULL,
  `timetable_ID` int(255) NOT NULL,
  `is_late` tinyint(1) DEFAULT NULL,
  `arrival_time` datetime DEFAULT NULL,
  `SD_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `student_attendance`
--

INSERT INTO `student_attendance` (`studentAttendance_ID`, `student_ID`, `timetable_ID`, `is_late`, `arrival_time`, `SD_Date`) VALUES
(1, 'SD000001', 1, 0, '2020-08-01 15:00:00', NULL),
(2, 'SD000002', 1, 1, '2020-08-01 15:20:00', NULL),
(3, 'SD000002', 2, NULL, NULL, NULL),
(4, 'SD000002', 4, 0, '2020-08-16 10:55:00', NULL),
(5, 'SD000002', 5, NULL, NULL, NULL),
(6, 'SD000002', 6, 1, '2020-08-19 11:05:00', NULL),
(7, 'SD000002', 7, 1, '2020-08-20 11:05:00', NULL),
(8, 'SD000002', 8, 0, '2020-08-21 10:55:00', NULL),
(9, 'SD000002', 9, 1, '2020-08-24 11:05:00', NULL),
(10, 'SD000002', 10, 1, '2020-08-26 11:05:00', NULL),
(11, 'SD000002', 11, 0, '2020-08-27 11:05:00', NULL),
(12, 'SD000002', 12, NULL, NULL, NULL),
(13, 'SD000002', 13, 1, '2020-08-29 11:10:03', NULL),
(14, 'SD000002', 14, 1, '2020-08-29 11:10:03', NULL),
(15, 'SD000002', 2, 1, '2020-08-24 15:13:11', '2020-08-24'),
(16, 'SD000001', 16, NULL, NULL, '2020-08-30'),
(17, 'SD000002', 16, NULL, NULL, '2020-08-30'),
(18, 'SD000011', 16, NULL, NULL, '2020-08-30'),
(19, 'SD000012', 16, 1, '2020-08-30 16:00:22', '2020-08-30'),
(31, 'SD000014', 23, 1, '2020-08-31 17:09:53', '2020-08-31'),
(32, 'SD000014', 24, 0, '2020-08-31 17:10:12', '2020-08-31');

-- --------------------------------------------------------

--
-- 資料表結構 `student_result`
--

CREATE TABLE `student_result` (
  `result_ID` int(255) NOT NULL,
  `student_ID` varchar(255) NOT NULL,
  `homework_ID` int(11) NOT NULL,
  `marks` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `student_result`
--

INSERT INTO `student_result` (`result_ID`, `student_ID`, `homework_ID`, `marks`) VALUES
(1, 'SD000001', 1, 80),
(2, 'SD000001', 2, 80),
(3, 'SD000002', 2, 89.5),
(4, 'SD000001', 3, 40.4),
(5, 'SD000002', 3, 0),
(6, 'SD000001', 4, 0),
(7, 'SD000002', 4, 0),
(8, 'SD000011', 4, 20),
(9, 'SD000001', 5, 0),
(10, 'SD000002', 5, 0),
(11, 'SD000011', 5, 0),
(12, 'SD000012', 5, 50),
(15, 'SD000014', 8, 80),
(16, 'SD000014', 9, 30),
(17, 'SD000001', 10, 60);

-- --------------------------------------------------------

--
-- 資料表結構 `teacher`
--

CREATE TABLE `teacher` (
  `teacher_ID` varchar(255) NOT NULL,
  `is_PartTime` tinyint(1) NOT NULL,
  `Staff_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `teacher`
--

INSERT INTO `teacher` (`teacher_ID`, `is_PartTime`, `Staff_ID`) VALUES
('T001', 0, 'ST002'),
('T002', 1, 'ST004'),
('T003', 0, 'ST006'),
('T004', 1, 'ST008');

-- --------------------------------------------------------

--
-- 資料表結構 `teacher_class`
--

CREATE TABLE `teacher_class` (
  `teacherID` varchar(255) NOT NULL,
  `class_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `teacher_class`
--

INSERT INTO `teacher_class` (`teacherID`, `class_ID`) VALUES
('T001', 1),
('T004', 6),
('T002', 7),
('T003', 8);

-- --------------------------------------------------------

--
-- 資料表結構 `timetable`
--

CREATE TABLE `timetable` (
  `timetable_ID` int(255) NOT NULL,
  `class_ID` int(255) NOT NULL,
  `center_ID` varchar(255) NOT NULL,
  `teacher_ID` varchar(45) DEFAULT NULL,
  `class_StartTime` datetime NOT NULL,
  `class_EndTime` datetime NOT NULL,
  `lesson` int(255) NOT NULL,
  `is_online` tinyint(4) NOT NULL,
  `class_room` int(11) DEFAULT NULL,
  `manager_ID` varchar(255) NOT NULL,
  `is_accept` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `timetable`
--

INSERT INTO `timetable` (`timetable_ID`, `class_ID`, `center_ID`, `teacher_ID`, `class_StartTime`, `class_EndTime`, `lesson`, `is_online`, `class_room`, `manager_ID`, `is_accept`) VALUES
(1, 1, 'C001', 'T001', '2020-08-01 15:00:00', '2020-08-01 17:00:00', 1, 0, NULL, 'M001', 2),
(2, 1, 'C001', 'T001', '2020-08-15 15:00:00', '2020-08-15 17:00:00', 2, 0, NULL, 'M001', 2),
(3, 7, 'C002', 'T002', '2020-08-11 11:00:00', '2020-08-11 11:00:00', 1, 0, NULL, 'M002', 0),
(4, 1, 'C001', 'T001', '2020-08-16 11:00:00', '2020-08-16 13:00:00', 3, 0, NULL, 'M002', 2),
(5, 1, 'C001', 'T001', '2020-08-18 11:00:00', '2020-08-18 13:00:00', 4, 0, NULL, 'M001', 0),
(6, 1, 'C001', 'T001', '2020-08-19 11:00:00', '2020-08-19 13:00:00', 5, 0, NULL, 'M001', 0),
(7, 1, 'C001', 'T001', '2020-08-20 11:00:00', '2020-08-20 13:00:00', 6, 0, NULL, 'M001', 0),
(8, 1, 'C001', 'T001', '2020-08-21 11:00:00', '2020-08-21 13:00:00', 7, 0, NULL, 'M001', 0),
(9, 2, 'C002', 'T002', '2020-08-24 11:00:00', '2020-08-24 13:00:00', 1, 0, NULL, 'M001', 0),
(10, 8, 'C002', 'T002', '2020-08-26 11:00:00', '2020-08-26 13:00:00', 1, 0, NULL, 'M001', 0),
(11, 8, 'C002', 'T002', '2020-08-27 11:00:00', '2020-08-27 13:00:00', 2, 0, NULL, 'M001', 0),
(12, 8, 'C002', 'T002', '2020-08-28 11:00:00', '2020-08-28 13:00:00', 3, 0, NULL, 'M001', 0),
(13, 8, 'C002', 'T002', '2020-08-29 11:00:00', '2020-08-29 13:00:00', 4, 0, NULL, 'M001', 0),
(14, 8, 'C002', 'T002', '2020-08-30 11:00:00', '2020-08-30 13:00:00', 5, 0, NULL, 'M001', 2),
(15, 11, 'C001', 'T002', '2020-08-24 15:14:00', '2020-08-24 17:14:00', 1, 0, 5, 'M001', 2),
(16, 1, 'C001', 'T001', '2020-08-30 16:00:00', '2020-08-30 17:00:00', 8, 0, 1, 'M001', 2),
(23, 6, 'C002', 'T004', '2020-08-31 12:00:00', '2020-08-31 14:00:00', 1, 0, 1, 'M002', 2),
(24, 6, 'C002', 'T004', '2020-08-31 17:15:00', '2020-08-31 18:15:00', 2, 0, 1, 'M002', 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `center`
--
ALTER TABLE `center`
  ADD PRIMARY KEY (`center_ID`),
  ADD UNIQUE KEY `center_ID_UNIQUE` (`center_ID`),
  ADD UNIQUE KEY `center_name_UNIQUE` (`center_name`);

--
-- 資料表索引 `class`
--
ALTER TABLE `class`
  ADD UNIQUE KEY `Class_ID_UNIQUE` (`class_ID`),
  ADD KEY `class_category_fk` (`category_ID`),
  ADD KEY `class_couseID_fk` (`course_ID`);

--
-- 資料表索引 `class_category`
--
ALTER TABLE `class_category`
  ADD PRIMARY KEY (`category_ID`);

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_ID`),
  ADD UNIQUE KEY `Course_ID_UNIQUE` (`course_ID`);

--
-- 資料表索引 `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_ID`),
  ADD KEY `enrollment_course_ID_fk` (`course_ID`),
  ADD KEY `enrollment_student_ID_fk` (`student_ID`),
  ADD KEY `enrollment_class_ID_fk` (`class_ID`);

--
-- 資料表索引 `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`homework_ID`),
  ADD KEY `homework_class_ID_fk` (`class_ID`);

--
-- 資料表索引 `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_ID`),
  ADD KEY `manager_center_ID_fk` (`center_ID`),
  ADD KEY `manager_staff_ID_fk` (`staff_ID`);

--
-- 資料表索引 `preferral_workday`
--
ALTER TABLE `preferral_workday`
  ADD PRIMARY KEY (`staffID`,`weekday`),
  ADD KEY `staff_fk_idx` (`staffID`);

--
-- 資料表索引 `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`),
  ADD KEY `staff_centerID_fk` (`center_ID`);

--
-- 資料表索引 `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`staffAttendance_ID`),
  ADD KEY `staff_attendance_centerID_fk` (`center_ID`),
  ADD KEY `staff_attendance_staffID_fk` (`staff_ID`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_ID`),
  ADD UNIQUE KEY `student_ID_UNIQUE` (`student_ID`);

--
-- 資料表索引 `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`studentAttendance_ID`),
  ADD KEY `student_attendance_studentID_fk` (`student_ID`),
  ADD KEY `student_attendance_timetable_ID_fk` (`timetable_ID`);

--
-- 資料表索引 `student_result`
--
ALTER TABLE `student_result`
  ADD PRIMARY KEY (`result_ID`) USING BTREE,
  ADD KEY `student_result_studentID_fk` (`student_ID`),
  ADD KEY `student_result_homeworkID_fk` (`homework_ID`);

--
-- 資料表索引 `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_ID`),
  ADD KEY `teacher_staffID_fk` (`Staff_ID`);

--
-- 資料表索引 `teacher_class`
--
ALTER TABLE `teacher_class`
  ADD PRIMARY KEY (`teacherID`,`class_ID`),
  ADD KEY `teacher_class_classID_fk` (`class_ID`);

--
-- 資料表索引 `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_ID`),
  ADD KEY `timetable_centerID_fk` (`center_ID`),
  ADD KEY `timetable_classID_fk` (`class_ID`),
  ADD KEY `timetable_teacherID_fk` (`teacher_ID`),
  ADD KEY `timetable_managerID_fk` (`manager_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `class`
--
ALTER TABLE `class`
  MODIFY `class_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `homework`
--
ALTER TABLE `homework`
  MODIFY `homework_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `staffAttendance_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `studentAttendance_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student_result`
--
ALTER TABLE `student_result`
  MODIFY `result_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_category_fk` FOREIGN KEY (`category_ID`) REFERENCES `class_category` (`category_ID`),
  ADD CONSTRAINT `class_couseID_fk` FOREIGN KEY (`course_ID`) REFERENCES `course` (`course_ID`);

--
-- 資料表的限制式 `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_class_ID_fk` FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`),
  ADD CONSTRAINT `enrollment_course_ID_fk` FOREIGN KEY (`course_ID`) REFERENCES `course` (`course_ID`),
  ADD CONSTRAINT `enrollment_student_ID_fk` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_ID`);

--
-- 資料表的限制式 `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_class_ID_fk` FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`);

--
-- 資料表的限制式 `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_center_ID_fk` FOREIGN KEY (`center_ID`) REFERENCES `center` (`center_ID`),
  ADD CONSTRAINT `manager_staff_ID_fk` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`);

--
-- 資料表的限制式 `preferral_workday`
--
ALTER TABLE `preferral_workday`
  ADD CONSTRAINT `workday_staffID_fk` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staff_ID`);

--
-- 資料表的限制式 `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_centerID_fk` FOREIGN KEY (`center_ID`) REFERENCES `center` (`center_ID`);

--
-- 資料表的限制式 `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD CONSTRAINT `staff_attendance_centerID_fk` FOREIGN KEY (`center_ID`) REFERENCES `center` (`center_ID`),
  ADD CONSTRAINT `staff_attendance_staffID_fk` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`);

--
-- 資料表的限制式 `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD CONSTRAINT `student_attendance_student_ID_fk` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_ID`),
  ADD CONSTRAINT `student_attendance_timetable_ID_fk` FOREIGN KEY (`timetable_ID`) REFERENCES `timetable` (`timetable_ID`);

--
-- 資料表的限制式 `student_result`
--
ALTER TABLE `student_result`
  ADD CONSTRAINT `student_result_homeworkID_fk` FOREIGN KEY (`homework_ID`) REFERENCES `homework` (`homework_ID`),
  ADD CONSTRAINT `student_result_studentID_fk` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_ID`);

--
-- 資料表的限制式 `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_staffID_fk` FOREIGN KEY (`Staff_ID`) REFERENCES `staff` (`staff_ID`);

--
-- 資料表的限制式 `teacher_class`
--
ALTER TABLE `teacher_class`
  ADD CONSTRAINT `teacher_class_classID_fk` FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`),
  ADD CONSTRAINT `teacher_class_teacherID_fk` FOREIGN KEY (`teacherID`) REFERENCES `teacher` (`teacher_ID`);

--
-- 資料表的限制式 `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_centerID_fk` FOREIGN KEY (`center_ID`) REFERENCES `center` (`center_ID`),
  ADD CONSTRAINT `timetable_classID_fk` FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`),
  ADD CONSTRAINT `timetable_managerID_fk` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`),
  ADD CONSTRAINT `timetable_teacherID_fk` FOREIGN KEY (`teacher_ID`) REFERENCES `teacher` (`teacher_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
