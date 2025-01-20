DROP DATABASE IF EXISTS Rhizome;
CREATE DATABASE Rhizome;
USE Rhizome;

CREATE TABLE `Accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` BOOLEAN NOT NULL,
  `class` INT(11) NULL,
  `total_xp` int(11) NULL,
  `completedModules` varchar(255) NULL,
  `sickDays` int(11) NULL,
  `absentDays` int(11) NULL,
  `lateDays` int(11) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `Classes` (
  `classId` int(11) NOT NULL AUTO_INCREMENT,
  `homework` varchar(255) NOT NULL,
  `examName` varchar(255) NOT NULL,
  `examDate` date NOT NULL,
  PRIMARY KEY (`classId`)
);
