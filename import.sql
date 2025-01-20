DROP DATABASE IF EXISTS Rhizome;
CREATE DATABASE Rhizome;
USE Rhizome;

CREATE TABLE `Accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` BOOLEAN NOT NULL,
  `class` INT(11) NULL,
  `totalXp` int(11) NULL,
  `completedModules` varchar(255) NULL,
  `sickDays` int(11) NULL,
  `confirmedAbsentDays` int(11) NULL,
  `unconfirmedAbsentDays` int(11) NULL,
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

INSERT INTO `Classes` (`classId`, `homework`, `examName`, `examDate`) VALUES
(1, 'Nederlands presentatie houden', 'Reken examen', '2025-12-02'),
(2, 'Rekenen Hoofdstuk 2 opdracht 3 af hebben', 'Engels examen', '2020-28-02'),
(3, 'Geen huiswerk!', 'Nederlands examen', '2020-21-02');

INSERT INTO `Accounts` (`name`, `password`, `isAdmin`, `class`, `totalXp`, `completedModules`, `sickDays`, `confirmedAbsentDays`, `unconfirmedAbsentDays`, `lateDays`) VALUES
('Son Bram van der Burg', 'testPassword', FALSE, 1, NULL, NULL, 6, 2, 1, 0);
('Sven Hoeksema', 'testPassword', FALSE, 2, NULL, NULL, 3, 1, 0, 2);
('Wilkes Perea', 'testPassword', FALSE, 3, NULL, NULL, 2, 0, 0, 0);