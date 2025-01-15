DROP DATABASE IF EXISTS Nexed2;
CREATE DATABASE Nexed2;
USE Nexed2;

CREATE TABLE `Students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
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
  ('PHP Beginner (Placeholder)', 'Begin met het leren van PHP!', 3),
  ('PHP Advanced (Placeholder)', 'Ga verder met het leren van PHP!', 5),
  ('JavaScript Beginner (Placeholder)', 'Begin met het leren van JavaScript!', 4),
  ('JavaScript Advanced (Placeholder)', 'Ga verder met het leren van JavaScript!', 3);
  ('JavaScript Beginner (Placeholder)', 'Begin met het leren van JavaScript!', 4),
  ('JavaScript Advanced (Placeholder)', 'Ga verder met het leren van JavaScript!', 3);

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

INSERT INTO `Levels` (`name`, `description`, `xp_amount`, `levelIndex`, `module_id`) VALUES
  ('PHP Beginner (Placeholder)', 'Het eerste level', 10, 1, 1),
  ('PHP Beginner (Placeholder)', 'Het tweede level', 20, 2, 1),
  ('PHP Beginner (Placeholder)', 'Het derde level', 30, 3, 1),
  ('PHP Advanced (Placeholder)', 'Het eerste level', 10, 1, 2),
  ('PHP Advanced (Placeholder)', 'Het tweede level', 20, 2, 2),
  ('PHP Advanced (Placeholder)', 'Het derde level', 30, 3, 2),
  ('PHP Advanced (Placeholder)', 'Het vierde level', 40, 4, 2),
  ('PHP Advanced (Placeholder)', 'Het vijfde level', 50, 5, 2),
  ('JavaScript Beginner (Placeholder)', 'Het eerste level',  10, 1, 3),
  ('JavaScript Beginner (Placeholder)', 'Het tweede level', 20, 2, 3),
  ('JavaScript Beginner (Placeholder)', 'Het derde level', 30, 3, 3),
  ('JavaScript Beginner (Placeholder)', 'Het vierde level', 40, 4, 3),
  ('JavaScript Advanced (Placeholder)', 'Het eerste level', 10, 5, 4),
  ('JavaScript Advanced (Placeholder)', 'Het tweede level', 20, 6, 4),
  ('JavaScript Advanced (Placeholder)', 'Het derde level', 30, 7, 4);
