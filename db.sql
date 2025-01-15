DROP DATABASE IF EXISTS Nexed2;
CREATE DATABASE Nexed2;
USE Nexed2;

CREATE TABLE `Students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `level` int(11) NOT NULL,
  `absences` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `Coaches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
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
