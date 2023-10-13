-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 12:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `draft_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `archive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `document_code` varchar(50) NOT NULL,
  `document_title` varchar(255) NOT NULL,
  `Revision_no` int(11) NOT NULL,
  `archive_requested_by` varchar(50) NOT NULL,
  `archive_by` varchar(50) NOT NULL,
  `date_archive` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`archive_id`, `user_id`, `document_id`, `document_code`, `document_title`, `Revision_no`, `archive_requested_by`, `archive_by`, `date_archive`) VALUES
(38, 41, 134, '6J0KYT4MFN', 'PM2023_Processing-of-Financial-Assistance.docx', 1, 'Lbarn', 'MamController', '2023-03-07 06:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `dcrf_table`
--

CREATE TABLE `dcrf_table` (
  `Revision_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Action` text NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Document_Code` varchar(20) DEFAULT NULL,
  `Document_Title` text NOT NULL,
  `Sector` varchar(50) NOT NULL,
  `Document_Type` varchar(50) NOT NULL,
  `Old_Document` varchar(255) DEFAULT NULL,
  `Old_Document_Code` varchar(255) DEFAULT NULL,
  `New_Responsibilties` varchar(255) DEFAULT NULL,
  `Old_Effectivity_Date` date DEFAULT NULL,
  `Author` varchar(50) NOT NULL,
  `Revision_no` int(11) NOT NULL,
  `New_Rev_DateCreated` date NOT NULL DEFAULT current_timestamp(),
  `Notes` varchar(255) NOT NULL,
  `Approver` varchar(50) NOT NULL,
  `Approver_Notes` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dcrf_table`
--

INSERT INTO `dcrf_table` (`Revision_ID`, `User_ID`, `Action`, `Section`, `Document_Code`, `Document_Title`, `Sector`, `Document_Type`, `Old_Document`, `Old_Document_Code`, `New_Responsibilties`, `Old_Effectivity_Date`, `Author`, `Revision_no`, `New_Rev_DateCreated`, `Notes`, `Approver`, `Approver_Notes`, `Status`) VALUES
(180, 41, 'creation', 'Section 1', '', 'PM2023_Processing-of-Financial-Assistance.docx', 'Sector 2', 'Type 2', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '', 'MamController', 'Approved file', 1),
(181, 41, 'creation', 'Section 4', '', '9789240022379-eng.pdf', 'Sector 2', 'Type 4', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '', 'MamController', 'accept', 1),
(182, 41, 'creation', 'Operations', '', 'Document Management System - SDLC.docx', 'Sector 2', 'Process Manual', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '<p>Approve for creation please</p>\r\n', 'MamController', 'Approve file', 2);

--
-- Triggers `dcrf_table`
--
DELIMITER $$
CREATE TRIGGER `dcrf_table` BEFORE INSERT ON `dcrf_table` FOR EACH ROW INSERT INTO logs VALUES(null, NEW.User_ID, NEW.Document_Title, NEW.Approver, 'Document Submitted for  Final Approval', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dcrf_tmp1`
--

CREATE TABLE `dcrf_tmp1` (
  `Revision_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Action` text NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Document_Code` varchar(20) DEFAULT NULL,
  `Document_Title` text NOT NULL,
  `Sector` varchar(50) NOT NULL,
  `Document_Type` varchar(50) NOT NULL,
  `Old_Document` varchar(255) DEFAULT NULL,
  `Old_Document_Code` varchar(255) DEFAULT NULL,
  `New_Responsibilties` varchar(255) DEFAULT NULL,
  `Old_Effectivity_Date` date DEFAULT NULL,
  `Author` varchar(50) NOT NULL,
  `Revision_no` int(11) NOT NULL,
  `New_Rev_DateCreated` date NOT NULL DEFAULT current_timestamp(),
  `Notes` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dcrf_tmp1`
--

INSERT INTO `dcrf_tmp1` (`Revision_ID`, `User_ID`, `Action`, `Section`, `Document_Code`, `Document_Title`, `Sector`, `Document_Type`, `Old_Document`, `Old_Document_Code`, `New_Responsibilties`, `Old_Effectivity_Date`, `Author`, `Revision_no`, `New_Rev_DateCreated`, `Notes`, `Status`) VALUES
(180, 41, 'creation', 'Section 1', '', 'PM2023_Processing-of-Financial-Assistance.docx', 'Sector 2', 'Type 2', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '', 1),
(181, 41, 'creation', 'Section 4', '', '9789240022379-eng.pdf', 'Sector 2', 'Type 4', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '', 1),
(182, 41, 'creation', 'Operations', '', 'Document Management System - SDLC.docx', 'Sector 2', 'Process Manual', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '<p>Approve for creation please</p>\r\n', 1);

--
-- Triggers `dcrf_tmp1`
--
DELIMITER $$
CREATE TRIGGER `insertLog` AFTER INSERT ON `dcrf_tmp1` FOR EACH ROW INSERT INTO logs VALUES(null, NEW.User_ID, NEW.Document_Title, NEW.Author, 'Document Submitted', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dcrf_tmp2`
--

CREATE TABLE `dcrf_tmp2` (
  `Revision_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Action` text NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Document_Code` varchar(20) DEFAULT NULL,
  `Document_Title` text NOT NULL,
  `Sector` varchar(50) NOT NULL,
  `Document_Type` varchar(50) NOT NULL,
  `Old_Document` varchar(255) DEFAULT NULL,
  `Old_Document_Code` varchar(255) DEFAULT NULL,
  `New_Responsibilties` varchar(255) DEFAULT NULL,
  `Old_Effectivity_Date` date DEFAULT NULL,
  `Author` varchar(50) NOT NULL,
  `Revision_no` int(11) NOT NULL,
  `New_Rev_DateCreated` date NOT NULL DEFAULT current_timestamp(),
  `Notes` varchar(255) NOT NULL,
  `Approver` varchar(50) NOT NULL,
  `Approver_Notes` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dcrf_tmp2`
--

INSERT INTO `dcrf_tmp2` (`Revision_ID`, `User_ID`, `Action`, `Section`, `Document_Code`, `Document_Title`, `Sector`, `Document_Type`, `Old_Document`, `Old_Document_Code`, `New_Responsibilties`, `Old_Effectivity_Date`, `Author`, `Revision_no`, `New_Rev_DateCreated`, `Notes`, `Approver`, `Approver_Notes`, `Status`) VALUES
(180, 41, 'creation', 'Section 1', '', 'PM2023_Processing-of-Financial-Assistance.docx', 'Sector 2', 'Type 2', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '', 'Cvcv', 'endorese', 1),
(181, 41, 'creation', 'Section 4', '', '9789240022379-eng.pdf', 'Sector 2', 'Type 4', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '', 'Cvcv', 'okay', 1),
(182, 41, 'creation', 'Operations', '', 'Document Management System - SDLC.docx', 'Sector 2', 'Process Manual', '', 'None', 'None', '1970-01-01', 'Lbarn', 0, '2023-03-07', '<p>Approve for creation please</p>\r\n', 'Cvcv', '', 1);

--
-- Triggers `dcrf_tmp2`
--
DELIMITER $$
CREATE TRIGGER `insert_dcrf_tmp2` AFTER INSERT ON `dcrf_tmp2` FOR EACH ROW INSERT INTO logs VALUES(null, NEW.User_ID, NEW.Document_Title, NEW.Approver, 'Document Submitted for  Draft Approval', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dc_inbox`
--

CREATE TABLE `dc_inbox` (
  `id` int(11) NOT NULL,
  `DCRF_ID` int(11) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Document_Code` varchar(50) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Document_Title` varchar(50) NOT NULL,
  `Document_Type` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Approver` varchar(50) NOT NULL,
  `Notes` varchar(255) NOT NULL,
  `Revision_no` int(11) NOT NULL,
  `Effectivity_Date` date NOT NULL DEFAULT current_timestamp(),
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dc_inbox`
--

INSERT INTO `dc_inbox` (`id`, `DCRF_ID`, `Section`, `Document_Code`, `User_ID`, `Document_Title`, `Document_Type`, `Author`, `Approver`, `Notes`, `Revision_no`, `Effectivity_Date`, `Status`) VALUES
(11, 180, 'Section 1', '6J0KYT4MFN', 41, 'PM2023_Processing-of-Financial-Assistance.docx', 'Type 2', 'Lbarn', 'Qmr', 'endorese for upload approved', 1, '2023-03-07', 3),
(12, 181, 'Section 4', 'VO3C40Q2EC', 41, '9789240022379-eng.pdf', 'Type 4', 'Lbarn', 'Qmr', 'upload file now', 1, '2023-03-07', 3),
(13, 182, 'Operations', '', 41, 'Document Management System - SDLC.docx', 'Process Manual', 'Lbarn', 'Qmr', 'Returned submit another 1', 0, '2023-03-07', 4);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `Document_ID` int(11) NOT NULL,
  `DCRF_ID` int(11) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Document_Code` varchar(50) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Document_Title` varchar(255) NOT NULL,
  `Document_Type` varchar(50) NOT NULL,
  `Uploader` varchar(50) DEFAULT NULL,
  `Size` int(11) NOT NULL,
  `Downloads` int(11) NOT NULL,
  `Approver` varchar(50) NOT NULL,
  `Notes` varchar(255) NOT NULL,
  `Revision_no` varchar(11) NOT NULL,
  `Effectivity_Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`Document_ID`, `DCRF_ID`, `Section`, `Document_Code`, `User_ID`, `Document_Title`, `Document_Type`, `Uploader`, `Size`, `Downloads`, `Approver`, `Notes`, `Revision_no`, `Effectivity_Date`) VALUES
(135, 181, 'Section 4', 'VO3C40Q2EC', 41, '9789240022379-eng.pdf', 'Type 4', 'Lbarn', 810251, 0, 'MamController', 'Approved!', '1', '2023-03-07');

--
-- Triggers `document`
--
DELIMITER $$
CREATE TRIGGER `document_Table` AFTER INSERT ON `document` FOR EACH ROW INSERT INTO logs VALUES(null, NEW.User_ID, NEW.Document_Title, NEW.Approver, 'Document Uploaded', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Sender` varchar(50) NOT NULL,
  `Document_Title` varchar(255) NOT NULL,
  `description` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `user_id`, `Sender`, `Document_Title`, `description`, `date`) VALUES
(162, 41, 'MamController', 'PM2023_Processing-of-Financial-Assistance.docx', 'Okay approve 123', '2023-03-07 17:57:25'),
(163, 41, 'MamController', '9789240022379-eng.pdf', 'Approved!', '2023-03-07 18:14:42'),
(164, 41, 'MamController', 'Document Management System - SDLC.docx', 'Returned by QMR SOrry!', '2023-03-07 19:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_title` varchar(255) NOT NULL,
  `acted_by` varchar(50) NOT NULL,
  `action_made` varchar(255) NOT NULL,
  `action_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `user_id`, `document_title`, `acted_by`, `action_made`, `action_date`) VALUES
(555, 41, 'PM2023_Processing-of-Financial-Assistance.docx', 'Lbarn', 'Document Submitted', '2023-03-07 17:50:24'),
(556, 41, 'PM2023_Processing-of-Financial-Assistance.docx', 'Cvcv', 'Document Submitted for  Draft Approval', '2023-03-07 17:51:43'),
(557, 41, 'PM2023_Processing-of-Financial-Assistance.docx', 'MamController', 'Document Submitted for  Final Approval', '2023-03-07 17:52:13'),
(558, 41, 'PM2023_Processing-of-Financial-Assistance.docx', 'Qmr', 'Document Approved. Wait for file to be uploaded', '2023-03-07 17:56:44'),
(559, 41, 'PM2023_Processing-of-Financial-Assistance.docx', 'MamController', 'Document Uploaded', '2023-03-07 17:57:25'),
(560, 41, '9789240022379-eng.pdf', 'Lbarn', 'Document Submitted', '2023-03-07 18:13:25'),
(561, 41, '9789240022379-eng.pdf', 'Cvcv', 'Document Submitted for  Draft Approval', '2023-03-07 18:13:41'),
(562, 41, '9789240022379-eng.pdf', 'MamController', 'Document Submitted for  Final Approval', '2023-03-07 18:13:54'),
(563, 41, '9789240022379-eng.pdf', 'Qmr', 'Document Approved. Wait for file to be uploaded', '2023-03-07 18:14:07'),
(564, 41, '9789240022379-eng.pdf', 'MamController', 'Document Uploaded', '2023-03-07 18:14:42'),
(565, 41, 'Document Management System - SDLC.docx', 'Lbarn', 'Document Submitted', '2023-03-07 18:58:41'),
(566, 41, 'Document Management System - SDLC.docx', 'Cvcv', 'Document Submitted for  Draft Approval', '2023-03-07 18:59:10'),
(567, 41, 'Document Management System - SDLC.docx', 'MamController', 'Document Submitted for  Final Approval', '2023-03-07 18:59:23'),
(568, 41, 'Document Management System - SDLC.docx', 'Qmr', 'Document Returned to Document Controller', '2023-03-07 19:15:00'),
(569, 41, 'Document Management System - SDLC.docx', 'MamController', 'Document Returned', '2023-03-07 19:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `Office_ID` int(11) NOT NULL,
  `S_ID` int(11) NOT NULL,
  `Office_Name` varchar(50) NOT NULL,
  `Office_Description` varchar(255) NOT NULL,
  `Office_Head` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`Office_ID`, `S_ID`, `Office_Name`, `Office_Description`, `Office_Head`) VALUES
(5, 1, 'OP 1', 'Sample', 'Head 1'),
(6, 1, 'OP 2', 'Sample', 'Head 2'),
(7, 2, 'OVP 1', 'Sample', 'Head 1'),
(8, 2, 'OVP 2', 'Sample', 'Head 2'),
(9, 3, 'ICTO 1', 'SAmple', 'Head '),
(10, 3, 'OLAP 2', 'SAmple', 'Head ');

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `Process_ID` int(11) NOT NULL,
  `O_ID` int(11) NOT NULL,
  `Process_Name` varchar(50) NOT NULL,
  `Process_Desciption` varchar(255) NOT NULL,
  `Process_Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`Process_ID`, `O_ID`, `Process_Name`, `Process_Desciption`, `Process_Type`) VALUES
(3, 5, 'Process 1', 'sample', 'Class 1'),
(4, 5, 'Process 101', 'sample', 'Class 1'),
(5, 10, 'Pro 3', 'Sample', 'Class 3'),
(6, 7, 'Process 2', 'sample', 'Class 3');

-- --------------------------------------------------------

--
-- Table structure for table `reg_form`
--

CREATE TABLE `reg_form` (
  `Reg_ID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `process` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reg_form`
--

INSERT INTO `reg_form` (`Reg_ID`, `fname`, `lname`, `email`, `pass`, `User_Type`, `sector`, `office`, `process`, `status`) VALUES
(39, 'cvcv', 'cvcvc', 'cv@gmail.com', '202cb962ac59075b964b07152d234b70', 'DC', 'Sector 1', 'OP 1', 'Process 1', 'approved'),
(41, 'Lbarn', 'Kbe', 'user@gmail.com', '202cb962ac59075b964b07152d234b70', 'PO', 'Sector 2', 'OVP 1', 'Process 2', 'approved'),
(42, 'MamController', 'Uni', 'iqmso@gmail.com', '202cb962ac59075b964b07152d234b70', 'IQMSO', 'Sector 3', 'OLAP 2', 'Pro 3', 'approved'),
(43, 'Qmr', 'University', 'qmr@gmail.com', '202cb962ac59075b964b07152d234b70', 'QMR', 'Sector 2', 'OVP 1', 'Process 2', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `Section_ID` int(11) NOT NULL,
  `Section_Name` varchar(50) NOT NULL,
  `Section_Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Section_ID`, `Section_Name`, `Section_Description`) VALUES
(1, 'Operations', 'Sample'),
(2, 'Leadership and Planning', 'Sample'),
(3, 'Support', 'sample'),
(4, 'Performance Evaluation', 'Sample');

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `Sector_ID` int(11) NOT NULL,
  `Sector_Name` varchar(50) NOT NULL,
  `Sector_Description` varchar(255) NOT NULL,
  `Sector_Head` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`Sector_ID`, `Sector_Name`, `Sector_Description`, `Sector_Head`) VALUES
(1, 'Sector 1', 'lorem', 'Head 1'),
(2, 'Sector 2', 'lorem', 'Head 2'),
(3, 'Sector 3', 'Sample', 'Head 3');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `Type_ID` int(11) NOT NULL,
  `Type_Name` varchar(50) NOT NULL,
  `Type_Desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`Type_ID`, `Type_Name`, `Type_Desc`) VALUES
(1, 'Quality Manual', 'sample'),
(2, 'Process Manual', 'sample'),
(3, 'Work Instruction Manual', ''),
(4, 'Forms Manual', ''),
(5, 'Reference Manual', ''),
(6, 'Risk Register Manual', ''),
(7, 'Job Description Manual', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`archive_id`);

--
-- Indexes for table `dcrf_table`
--
ALTER TABLE `dcrf_table`
  ADD PRIMARY KEY (`Revision_ID`);

--
-- Indexes for table `dcrf_tmp1`
--
ALTER TABLE `dcrf_tmp1`
  ADD PRIMARY KEY (`Revision_ID`);

--
-- Indexes for table `dcrf_tmp2`
--
ALTER TABLE `dcrf_tmp2`
  ADD PRIMARY KEY (`Revision_ID`);

--
-- Indexes for table `dc_inbox`
--
ALTER TABLE `dc_inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`Document_ID`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`Office_ID`),
  ADD KEY `SecID_FK` (`S_ID`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`Process_ID`),
  ADD KEY `OfficeID_FK` (`O_ID`);

--
-- Indexes for table `reg_form`
--
ALTER TABLE `reg_form`
  ADD PRIMARY KEY (`Reg_ID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`Section_ID`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`Sector_ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`Type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `dcrf_tmp1`
--
ALTER TABLE `dcrf_tmp1`
  MODIFY `Revision_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `dc_inbox`
--
ALTER TABLE `dc_inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `Document_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `Office_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `Process_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reg_form`
--
ALTER TABLE `reg_form`
  MODIFY `Reg_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `Section_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `Sector_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `Type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `office`
--
ALTER TABLE `office`
  ADD CONSTRAINT `office_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `sector` (`Sector_ID`);

--
-- Constraints for table `process`
--
ALTER TABLE `process`
  ADD CONSTRAINT `process_ibfk_1` FOREIGN KEY (`O_ID`) REFERENCES `office` (`Office_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
