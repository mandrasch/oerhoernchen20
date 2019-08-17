-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2019 at 04:34 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `oerhoernchen20prologin`
--

-- --------------------------------------------------------

--
-- Table structure for table `oerh_entries_awaiting_approval`
--

CREATE TABLE `oerh_entries_awaiting_approval` (
  `id` bigint(20) NOT NULL,
  `imgur_url` varchar(255) DEFAULT NULL,
  `imgur_delete_hash` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `json_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oerh_log_imgur_uploads`
--

CREATE TABLE `oerh_log_imgur_uploads` (
  `id` bigint(20) NOT NULL,
  `imgur_url` varchar(255) DEFAULT NULL,
  `imgur_delete_hash` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oerh_log_submitted_entries`
--

CREATE TABLE `oerh_log_submitted_entries` (
  `id` bigint(20) NOT NULL,
  `oerhoernchen_id` varchar(255) NOT NULL,
  `elastic_id` varchar(255) DEFAULT NULL,
  `imgur_url` varchar(255) DEFAULT NULL,
  `imgur_delete_hash` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `json_object` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oerh_entries_awaiting_approval`
--
ALTER TABLE `oerh_entries_awaiting_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oerh_log_imgur_uploads`
--
ALTER TABLE `oerh_log_imgur_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oerh_log_submitted_entries`
--
ALTER TABLE `oerh_log_submitted_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oerh_entries_awaiting_approval`
--
ALTER TABLE `oerh_entries_awaiting_approval`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `oerh_log_imgur_uploads`
--
ALTER TABLE `oerh_log_imgur_uploads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oerh_log_submitted_entries`
--
ALTER TABLE `oerh_log_submitted_entries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
