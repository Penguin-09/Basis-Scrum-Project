DROP DATABASE IF EXISTS Nexed2;
CREATE DATABASE Nexed2;
USE Nexed2;

CREATE TABLE `Students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `total_xp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `absences` int(11) NOT NULL,
  `completed_modules` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `Coaches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `Modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `level_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `Modules` (`name`, `description`, `level_amount`) VALUES
  ('PHP Beginner', 'Begin met het leren van PHP!', 3),
  ('PHP Advanced', 'Ga verder met het leren van PHP!', 5),
  ('JavaScript Beginner', 'Begin met het leren van JavaScript!', 4),
  ('JavaScript Advanced', 'Ga verder met het leren van JavaScript!', 3);

CREATE TABLE `Levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `xp_amount` int(11) NOT NULL,
  `level_code` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL,
  FOREIGN KEY (`module_id`) REFERENCES `Modules`(`id`),
  PRIMARY KEY (`id`)
);

INSERT INTO `Levels` (`name`, `description`, `xp_amount`, `level_code`, `module_id`) VALUES
  ('PHP Beginner Level 1', 'Het eerste level', 10, 'M01L01', 1),
  ('PHP Beginner Level 2', 'Het tweede level', 20, 'M01L02', 1),
  ('PHP Beginner Level 3', 'Het derde level', 30, 'M01L03', 1),
  ('PHP Advanced Level 1', 'Het eerste level', 10, 'M02L01', 2),
  ('PHP Advanced Level 2', 'Het tweede level', 20, 'M02L02', 2),
  ('PHP Advanced Level 3', 'Het derde level', 30, 'M02L03', 2),
  ('PHP Advanced Level 4', 'Het vierde level', 40, 'M02L04', 2),
  ('PHP Advanced Level 5', 'Het vijfde level', 50, 'M02L05', 2),
  ('JavaScript Beginner Level 1', 'Het eerste level',  10, 'M03L01', 3),
  ('JavaScript Beginner Level 2', 'Het tweede level', 20, 'M03L02', 3),
  ('JavaScript Beginner Level 3', 'Het derde level', 30, 'M03L03', 3),
  ('JavaScript Beginner Level 4', 'Het vierde level', 40, 'M03L04', 3),
  ('JavaScript Advanced Level 1', 'Het eerste level', 10, 'M04L01', 4),
  ('JavaScript Advanced Level 2', 'Het tweede level', 20, 'M04L02', 4),
  ('JavaScript Advanced Level 3', 'Het derde level', 30, 'M04L03', 4);
