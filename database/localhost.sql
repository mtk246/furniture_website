-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2020 at 06:57 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtk`
--
CREATE DATABASE IF NOT EXISTS `mtk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mtk`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `A_ID` varchar(200) NOT NULL,
  `A_NAME` varchar(200) NOT NULL,
  `A_USERNAME` varchar(200) NOT NULL,
  `A_PASSWORD` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`A_ID`, `A_NAME`, `A_USERNAME`, `A_PASSWORD`) VALUES
('A_0000000001', 'admin', 'admin', 'admin'),
('A_0000000002', 'admin2', 'admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `V_ID` varchar(200) NOT NULL,
  `P_DATE` varchar(200) NOT NULL,
  `TOTAL` varchar(200) NOT NULL,
  `DELIVERY_ID` varchar(200) NOT NULL,
  `U_ID` varchar(200) NOT NULL,
  `U_NAME` varchar(200) NOT NULL,
  `U_EMAIL` varchar(200) NOT NULL,
  `U_ADDRESS` varchar(200) NOT NULL,
  `U_PHONE` varchar(200) NOT NULL,
  `U_CITY` varchar(200) NOT NULL,
  `U_POSTCODE` varchar(200) NOT NULL,
  `U_CARD` varchar(200) NOT NULL,
  `U_CARD_EXPIRY` varchar(200) NOT NULL,
  `U_CARD_CVC` varchar(200) NOT NULL,
  `STATUS` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`V_ID`, `P_DATE`, `TOTAL`, `DELIVERY_ID`, `U_ID`, `U_NAME`, `U_EMAIL`, `U_ADDRESS`, `U_PHONE`, `U_CITY`, `U_POSTCODE`, `U_CARD`, `U_CARD_EXPIRY`, `U_CARD_CVC`, `STATUS`) VALUES
('V_0000000001', '2020-08-10', '              80000              ', '', 'C_0000000001', 'user1', 'user1@gmail.com', 'no.5', '12345', 'yangon', '1111', '1111', '2020-09-24', '123', 'PENDING'),
('V_0000000002', '2020-09-13', '              80000              ', '', 'C_0000000002', 'user2', 'user2@gmail.com', 'no.50', '123', 'yangon', '1111', '1111', '2020-09-17', '123', 'PENDING'),
('V_0000000003', '2020-09-13', '              20000              ', '', 'C_0000000001', 'user1', 'user1@gmail.com', 'no.50', '12345', 'yangon', '1111', '1111', '2020-09-24', '123', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_agent`
--

CREATE TABLE `delivery_agent` (
  `D_ID` varchar(20) NOT NULL,
  `D_NAME` varchar(30) NOT NULL,
  `D_ADDRESS` varchar(200) NOT NULL,
  `D_PHONE` varchar(20) NOT NULL,
  `D_EMAIL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_agent`
--

INSERT INTO `delivery_agent` (`D_ID`, `D_NAME`, `D_ADDRESS`, `D_PHONE`, `D_EMAIL`) VALUES
('D_0000000001', 'Mg Mg', 'no.50', '12345', 'mgmg@gmail.com'),
('D_0000000002', 'Kyaw Kyaw', 'no.40', '12345', 'kyawkyaw@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_status`
--

CREATE TABLE `delivery_status` (
  `V_ID` varchar(200) NOT NULL,
  `DATE` varchar(200) NOT NULL,
  `D_ID` varchar(200) NOT NULL,
  `D_AGENT_ID` varchar(200) NOT NULL,
  `STATUS` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FEEDBACK_ID` varchar(200) NOT NULL,
  `CUSTOMER_ID` varchar(200) NOT NULL,
  `SUBJECT` varchar(75) NOT NULL,
  `CONTENT` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FEEDBACK_ID`, `CUSTOMER_ID`, `SUBJECT`, `CONTENT`) VALUES
('F_0000000001', 'C_0000000001', 'Testing subject', 'hello 123'),
('F_0000000002', 'C_0000000001', 'testing subject 2', 'hello 123'),
('F_0000000003', 'C_0000000001', 'testing', 'hellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohello'),
('F_0000000004', 'C_0000000001', 'hello', 'testing comment');

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `F_ID` varchar(200) NOT NULL,
  `F_NAME` varchar(200) NOT NULL,
  `F_TYPE_ID` varchar(200) NOT NULL,
  `F_PRICE` varchar(200) NOT NULL,
  `F_SIZE` varchar(200) NOT NULL,
  `F_QUANTITY` varchar(200) NOT NULL,
  `F_DESC` varchar(200) NOT NULL,
  `F_IMAGE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`F_ID`, `F_NAME`, `F_TYPE_ID`, `F_PRICE`, `F_SIZE`, `F_QUANTITY`, `F_DESC`, `F_IMAGE`) VALUES
('F_0000000001', 'wooden chair', 'T_0000000001', '1000', '10', '170', 'wooden chair', './image_for_furniture/sofa2.png'),
('F_0000000002', 'comfy chair', 'T_0000000002', '1000', '10', '115', 'comfy chair', './image_for_furniture/sofa2.png'),
('F_0000000003', 'bathtub', 'T_0000000003', '1000', '10', '110', 'bathtub', './image_for_furniture/bathtub.png'),
('F_0000000004', 'cupboard', 'T_0000000004', '1000', '10', '86', 'cupboard', './image_for_furniture/cupboard.png'),
('F_0000000005', 'dresser', 'T_0000000005', '1000', '10', '108', 'dresser', './image_for_furniture/dresser.png'),
('F_0000000006', 'table', 'T_0000000006', '1000', '10', '80', 'table', './image_for_furniture/table.png'),
('F_0000000007', 'office chair', 'T_0000000007', '1000', '1000', '20', 'office chair', './image_for_furniture/office_chair.png'),
('F_0000000008', 'dining table', 'T_0000000008', '1000', '10', '60', 'dining table', './image_for_furniture/dining_table.png'),
('F_0000000009', 'cabinet', 'T_0000000009', '1000', '10', '80', 'cabinet', './image_for_furniture/cabinet.png');

-- --------------------------------------------------------

--
-- Table structure for table `furniture_type`
--

CREATE TABLE `furniture_type` (
  `F_ID` varchar(20) NOT NULL,
  `F_NAME` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `furniture_type`
--

INSERT INTO `furniture_type` (`F_ID`, `F_NAME`) VALUES
('F_0000000001', 'mtk');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `P_ID` varchar(200) NOT NULL,
  `S_ID` varchar(200) NOT NULL,
  `P_DATE` varchar(200) NOT NULL,
  `TOTAL_AMOUNT` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `P_ID` varchar(200) NOT NULL,
  `S_ID` varchar(200) NOT NULL,
  `P_DATE` varchar(200) NOT NULL,
  `F_ID` varchar(200) NOT NULL,
  `QUANTITY` varchar(200) NOT NULL,
  `PRICE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_detail`
--

INSERT INTO `purchase_detail` (`P_ID`, `S_ID`, `P_DATE`, `F_ID`, `QUANTITY`, `PRICE`) VALUES
('P_0000000001', 'S_0000000002', '2020-09-10', 'F_0000000003', '20', '1000'),
('P_0000000001', 'S_0000000002', '2020-09-10', 'F_0000000005', '20', '1000'),
('P_0000000002', 'S_0000000001', '2020-09-13', 'F_0000000006', '20', '1000'),
('P_0000000002', 'S_0000000001', '2020-09-13', 'F_0000000009', '40', '1000'),
('P_0000000002', 'S_0000000001', '2020-09-13', 'F_0000000008', '20', '1000'),
('P_0000000003', '', '2020-09-20', 'F_0000000002', '55', '1000'),
('P_0000000003', '', '2020-09-20', 'F_0000000004', '6', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `C_ID` varchar(20) NOT NULL,
  `C_NAME` varchar(30) NOT NULL,
  `C_ADDRESS` varchar(200) NOT NULL,
  `C_PHONE` varchar(20) NOT NULL,
  `C_GENDER` varchar(10) NOT NULL,
  `C_EMAIL` varchar(20) NOT NULL,
  `C_BIRTH` varchar(20) NOT NULL,
  `C_USERNAME` varchar(20) NOT NULL,
  `C_PASSWORD` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`C_ID`, `C_NAME`, `C_ADDRESS`, `C_PHONE`, `C_GENDER`, `C_EMAIL`, `C_BIRTH`, `C_USERNAME`, `C_PASSWORD`) VALUES
('C_0000000001', 'mtk', 'no.50', '12345', 'Male', 'user1@gmail.com', '2001-04-03', 'user1', 'user1'),
('C_0000000002', 'user2', 'no.50', '12345', 'Male', 'user2@gmail.com', '2014-02-01', 'user2', 'user2');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `R_ID` varchar(200) NOT NULL,
  `C_ID` varchar(200) NOT NULL,
  `C_NAME` varchar(200) NOT NULL,
  `F_ID` varchar(200) NOT NULL,
  `COMMENT` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`R_ID`, `C_ID`, `C_NAME`, `F_ID`, `COMMENT`) VALUES
('R_0000000001', 'C_0000000001', 'user1', 'F_0000000008', 'dining table comment'),
('R_0000000002', 'C_0000000001', 'user1', 'F_0000000002', 'comfy chair comment'),
('R_0000000003', 'C_0000000001', 'user1', 'F_0000000003', 'testing comment 1\r\n'),
('R_0000000004', 'C_0000000001', 'user1', 'F_0000000003', 'testing comment 2');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `S_ID` varchar(20) NOT NULL,
  `S_NAME` varchar(30) NOT NULL,
  `S_ADDRESS` varchar(200) NOT NULL,
  `S_PHONE` varchar(20) NOT NULL,
  `S_EMAIL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`S_ID`, `S_NAME`, `S_ADDRESS`, `S_PHONE`, `S_EMAIL`) VALUES
('S_0000000001', 'mtk', 'n0.50', '12345', 'minthukyaw454@gmail.com'),
('S_0000000002', 'user1', 'no.4', '1234', 'user1@gmail.com'),
('S_0000000003', 'user2', 'no.50', '1234', 'user2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_final_purchase`
--

CREATE TABLE `user_final_purchase` (
  `V_ID` varchar(200) NOT NULL,
  `P_DATE` varchar(200) NOT NULL,
  `C_ID` varchar(200) NOT NULL,
  `F_ID` varchar(200) NOT NULL,
  `QUANTITY` varchar(200) NOT NULL,
  `F_PRICE` varchar(200) NOT NULL,
  `AMOUNT` varchar(200) NOT NULL,
  `STATUS` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_final_purchase`
--

INSERT INTO `user_final_purchase` (`V_ID`, `P_DATE`, `C_ID`, `F_ID`, `QUANTITY`, `F_PRICE`, `AMOUNT`, `STATUS`) VALUES
('V_0000000001', '2020-08-10', 'C_0000000001', 'F_0000000009', '20', '1000', '20000', 'PENDING'),
('V_0000000001', '2020-08-10', 'C_0000000001', 'F_0000000002', '20', '1000', '20000', 'PENDING'),
('V_0000000001', '2020-08-10', 'C_0000000001', 'F_0000000001', '40', '1000', '40000', 'PENDING'),
('V_0000000002', '2020-09-13', 'C_0000000002', 'F_0000000007', '40', '1000', '40000', 'PENDING'),
('V_0000000002', '2020-09-13', 'C_0000000002', 'F_0000000009', '20', '1000', '20000', 'PENDING'),
('V_0000000002', '2020-09-13', 'C_0000000002', 'F_0000000002', '20', '1000', '20000', 'PENDING'),
('V_0000000003', '2020-09-13', 'C_0000000001', 'F_0000000007', '20', '1000', '20000', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `user_temporary_purchase`
--

CREATE TABLE `user_temporary_purchase` (
  `C_ID` varchar(200) NOT NULL,
  `F_ID` varchar(200) NOT NULL,
  `F_NAME` varchar(200) NOT NULL,
  `P_QUANTITY` varchar(200) NOT NULL,
  `F_PRICE` varchar(200) NOT NULL,
  `F_AMOUNT` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
