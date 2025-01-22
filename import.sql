DROP DATABASE IF EXISTS rhizome;

CREATE DATABASE rhizome;

USE rhizome;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` BOOLEAN NOT NULL,
  `class` INT(11) NULL,
  `completedModules` varchar(255) NULL,
  `sickDays` int(11) NULL,
  `confirmedAbsentDays` int(11) NULL,
  `unconfirmedAbsentDays` int(11) NULL,
  `lateDays` int(11) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `classes` (
  `classId` int(11) NOT NULL AUTO_INCREMENT,
  `homework` varchar(255) NOT NULL,
  `examName` varchar(255) NOT NULL,
  `examDate` date NOT NULL,
  PRIMARY KEY (`classId`)
);

INSERT INTO `Classes` (`classId`, `homework`, `examName`, `examDate`) VALUES
(1, 'Nederlands presentatie houden', 'Reken examen', '2025-03-02'),
(2, 'Rekenen Hoofdstuk 2 opdracht 3 af hebben', 'Engels examen', '2025-07-02'),
(3, 'Geen huiswerk!', 'Nederlands examen', '2025-11-02');

INSERT INTO `Accounts` (`username`, `password`, `isAdmin`, `class`, `completedModules`, `sickDays`, `confirmedAbsentDays`, `unconfirmedAbsentDays`, `lateDays`) VALUES
('Son Bram van der Burg', 'testPassword', FALSE, 1, 'm1e5m2e2m3e1m7e2', 5, 1, 0, 0),
('Sven Hoeksema', 'sven', FALSE, 2, 'm1e5m2e1m4e5m5e2', 2, 0, 0, 2),
('Jadon Piereau', '12345', FALSE, 3, 'm1e5m2e2m3e4m6e2', 4, 0, 6, 3),
('Wilkes Perea', 'testPassword', FALSE, 1, 'm4e5m5e3m6e5m7e2', 3, 2, 0, 1),
('Sybren Keizer', 'testPassword', FALSE, 2, 'm1e5m2e2m3e4m4e5m5e2m7e4', 2, 4, 6, 0),
('Paul Wiegers', 'testPassword', TRUE, NULL, NULL, NULL, NULL, NULL, NULL)