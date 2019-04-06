-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 01:45 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_recommendation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `name`, `location`, `description`, `image`) VALUES
(1, 'pokhara', 'pokhara, nepal', 'beautiful place', 'lake.jpeg'),
(2, 'pashupatinath', 'kathmandu, nepal', 'temple', 'pashupatii.jpg'),
(3, 'pashupatinath', 'kathmandu, nepal', 'temple', 'pashupatii.jpg'),
(4, 'pashupatinath', 'kathmandu, nepal', 'temple', 'pashupatii.jpg'),
(5, 'pashupatinath', 'kathmandu, nepal', 'temple', 'pashupatii.jpg'),
(6, 'janakpurdham', 'janakpur, dhanusha', 'this is good to go', 'janaki.jpg'),
(7, 'janakpurdham', 'janakpur, dhanusha', 'this is good to go', 'janaki.jpg'),
(8, 'janakpurdham', 'janakpur, dhanusha', 'this is good to go', 'janaki.jpg'),
(9, 'janakpurdham', 'janakpur, dhanusha', 'this is good to go', 'janaki.jpg'),
(10, 'janakpurdham', 'janakpur, dhanusha', 'this is good to go', 'janaki.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
