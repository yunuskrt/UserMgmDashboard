-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 31 Tem 2023, 14:10:56
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `userdashboard`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Project`
--

CREATE TABLE `Project` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `statu` varchar(20) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Project`
--

INSERT INTO `Project` (`id`, `title`, `description`, `statu`, `department`, `startDate`, `endDate`) VALUES
(1, 'Website Redesign', 'Redesign and revamp the company\'s website to improve user experience and modernize the interface.', 'active', 'Engineering', '2023-02-15', '2023-06-30'),
(2, 'Mobile App Development', 'Develop a cross-platform mobile application for seamless access to the company\'s services.', 'active', 'Engineering', '2023-03-10', '2023-08-31'),
(4, 'Database Optimization', 'Improve application performance through optimized database queries and architecture.', 'active', 'Engineering', '2023-05-05', '2023-10-24'),
(5, 'Automated Testing Implementation', 'Implement automated testing frameworks to ensure code quality and reduce manual testing efforts.', 'active', 'Engineering', '2023-06-15', '2023-11-30'),
(6, 'Bug Fixing and Maintenance', 'Address and fix reported bugs and issues in the software to maintain a stable and reliable system.', 'active', 'Engineering', '2023-07-01', '2023-12-31'),
(7, 'UI Prototype Design', 'Create interactive UI prototypes to gather user feedback and iterate on design concepts.', 'pending', 'Engineering', '2023-08-01', '2023-12-31'),
(8, 'User Documentation', 'Prepare comprehensive user documentation to help users effectively navigate and utilize the software.', 'pending', 'Engineering', '2023-09-01', '2024-02-28'),
(10, 'Code Review and Refactoring', 'Conduct thorough code reviews and refactor existing code for improved maintainability and readability.', 'pending', 'Engineering', '2023-11-01', '2024-04-30'),
(11, 'Performance Optimization', 'Analyze and optimize the software\'s performance to ensure optimal response times and resource usage.', 'finished', 'Engineering', '2023-01-01', '2023-03-31'),
(12, 'Security Assessment', 'Conduct thorough security assessments and implement necessary measures to protect against potential threats.', 'finished', 'Engineering', '2022-12-01', '2023-02-28'),
(13, 'Integration with Third-Party Services', 'Integrate the software with external APIs and services to enhance functionality and user experience.', 'finished', 'Engineering', '2022-11-01', '2023-01-31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Skill`
--

CREATE TABLE `Skill` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Skill`
--

INSERT INTO `Skill` (`id`, `title`, `userId`) VALUES
(1, 'C++', 34),
(2, 'Python', 34),
(3, 'JavaScript', 34),
(4, 'TypeScript', 34),
(5, 'SQL', 34),
(6, 'PostgreSQL', 34),
(7, 'MongoDB', 34),
(8, 'ReactJS', 34),
(9, 'Next.js', 34),
(10, 'C#', 34),
(11, '.NET', 34),
(12, 'Flutter', 34),
(13, 'Dart', 34),
(14, 'Firebase', 34),
(15, 'Figma', 34),
(16, 'Swagger', 34),
(17, 'Git', 34),
(18, 'HTML', 34),
(19, 'CSS', 34),
(20, 'JIRA', 34);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Step`
--

CREATE TABLE `Step` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `completed` varchar(255) DEFAULT NULL,
  `projectId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Step`
--

INSERT INTO `Step` (`id`, `title`, `description`, `completed`, `projectId`) VALUES
(1, 'Project Requirements and Goals', 'Define the project requirements and set clear goals for the automated testing implementation.', 'Yes', 5),
(2, 'Research and Framework Selection', 'Conduct research to identify suitable automated testing frameworks and tools.', 'Yes', 5),
(3, 'Integration and Implementation', 'Integrate the chosen automated testing framework into the existing codebase and implement test cases.', 'Yes', 5),
(4, 'Test Execution and Analysis', 'Execute test suites and analyze test results to measure code quality improvements.', 'No', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `enteredDate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parole` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `User`
--

INSERT INTO `User` (`id`, `role`, `department`, `enteredDate`, `age`, `username`, `email`, `gender`, `picture`, `name`, `parole`) VALUES
(1, 'Admin', 'Finance', '2022-10-15', 30, 'john_doe', 'john.doe@example.com', 'Male', 'https://randomuser.me/api/portraits/men/89.jpg', 'John Doe', 'password1'),
(2, 'Superadmin', 'Hr', '2021-05-03', 42, 'jane_smith', 'jane.smith@example.com', 'Female', 'https://randomuser.me/api/portraits/women/39.jpg', 'Jane Smith', 'password2'),
(3, 'Employee', 'Marketing', '2023-01-20', 25, 'sam_jones', 'sam.jones@example.com', 'Male', 'https://randomuser.me/api/portraits/men/7.jpg', 'Sam Jones', 'password3'),
(4, 'Admin', 'Sales', '2020-11-12', 38, 'alex_wilson', 'alex.wilson@example.com', 'Male', 'https://randomuser.me/api/portraits/men/50.jpg', 'Alex Wilson', 'password4'),
(5, 'Superadmin', 'Engineering', '2023-03-07', 29, 'sophie_brown', 'sophie.brown@example.com', 'Female', 'https://randomuser.me/api/portraits/women/55.jpg', 'Sophie Brown', 'password5'),
(10, 'Employee', 'It', '2022-08-28', 33, 'mike_smith', 'mike.smith@example.com', 'Male', 'https://randomuser.me/api/portraits/men/48.jpg', 'Mike Smith', 'password6'),
(13, 'Admin', 'Operations', '2021-12-05', 37, 'emily_jones', 'emily.jones@example.com', 'Female', 'https://randomuser.me/api/portraits/women/3.jpg', 'Emily Jones', 'password7'),
(17, 'Superadmin', 'Logistics', '2023-06-17', 44, 'peter_doe', 'peter.doe@example.com', 'Male', 'https://randomuser.me/api/portraits/men/83.jpg', 'Peter Doe', 'password8'),
(18, 'Employee', 'Customer Support', '2020-09-30', 27, 'lisa_anderson', 'lisa.anderson@example.com', 'Female', 'https://randomuser.me/api/portraits/women/84.jpg', 'Lisa Anderson', 'password9'),
(19, 'Admin', 'Research', '2022-04-22', 31, 'david_wilson', 'david.wilson@example.com', 'Male', 'https://randomuser.me/api/portraits/men/78.jpg', 'David Wilson', 'password10'),
(20, 'Superadmin', 'Finance', '2021-05-03', 35, 'mary_smith', 'mary.smith@example.com', 'Female', 'https://randomuser.me/api/portraits/women/10.jpg', 'Mary Smith', 'password11'),
(22, 'Employee', 'Hr', '2023-01-20', 29, 'paul_jones', 'paul.jones@example.com', 'Male', 'https://randomuser.me/api/portraits/men/7.jpg', 'Paul Jones', 'password12'),
(23, 'Admin', 'Marketing', '2020-11-12', 41, 'diana_wilson', 'diana.wilson@example.com', 'Female', 'https://randomuser.me/api/portraits/women/74.jpg', 'Diana Wilson', 'password13'),
(24, 'Superadmin', 'Sales', '2023-03-07', 26, 'michael_brown', 'michael.brown@example.com', 'Male', 'https://randomuser.me/api/portraits/men/53.jpg', 'Michael Brown', 'password14'),
(25, 'Employee', 'Engineering', '2022-08-28', 32, 'sara_smith', 'sara.smith@example.com', 'Female', 'https://randomuser.me/api/portraits/women/8.jpg', 'Sara Smith', 'password15'),
(26, 'Admin', 'It', '2021-12-05', 34, 'james_jones', 'james.jones@example.com', 'Male', 'https://randomuser.me/api/portraits/men/63.jpg', 'James Jones', 'password16'),
(27, 'Superadmin', 'Logistics', '2023-06-17', 39, 'laura_doe', 'laura.doe@example.com', 'Female', 'https://randomuser.me/api/portraits/women/81.jpg', 'Laura Doe', 'password17'),
(28, 'Employee', 'Customer Support', '2020-09-30', 28, 'jason_anderson', 'jason.anderson@example.com', 'Male', 'https://randomuser.me/api/portraits/men/66.jpg', 'Jason Anderson', 'password18'),
(29, 'Admin', 'Research', '2022-04-22', 36, 'anna_wilson', 'anna.wilson@example.com', 'Female', 'https://randomuser.me/api/portraits/women/48.jpg', 'Anna Wilson', 'password19'),
(30, 'Superadmin', 'Finance', '2021-05-03', 45, 'matt_smith', 'matt.smith@example.com', 'Male', 'https://randomuser.me/api/portraits/men/38.jpg', 'Matt Smith', 'password20'),
(34, 'Employee', 'Engineering', '2023-07-29', 22, 'yunuskrt', 'yunuskrt@example.com', 'Male', 'https://randomuser.me/api/portraits/men/96.jpg', 'Yunus Kerestecioglu', 'yunus12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `UserInProject`
--

CREATE TABLE `UserInProject` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `projectId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `UserInProject`
--

INSERT INTO `UserInProject` (`id`, `userId`, `projectId`) VALUES
(1, 34, 1),
(2, 34, 2),
(4, 34, 4),
(5, 34, 7),
(6, 34, 8),
(8, 34, 13),
(9, 5, 13),
(10, 5, 7),
(11, 5, 4),
(12, 5, 2),
(13, 25, 12),
(14, 25, 11),
(15, 25, 1),
(16, 25, 2),
(17, 25, 6),
(18, 25, 8);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Skill`
--
ALTER TABLE `Skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Tablo için indeksler `Step`
--
ALTER TABLE `Step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectId` (`projectId`);

--
-- Tablo için indeksler `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `UserInProject`
--
ALTER TABLE `UserInProject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `projectId` (`projectId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `Project`
--
ALTER TABLE `Project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `Skill`
--
ALTER TABLE `Skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `Step`
--
ALTER TABLE `Step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Tablo için AUTO_INCREMENT değeri `UserInProject`
--
ALTER TABLE `UserInProject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `Skill`
--
ALTER TABLE `Skill`
  ADD CONSTRAINT `skill_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `Step`
--
ALTER TABLE `Step`
  ADD CONSTRAINT `step_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `Project` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `UserInProject`
--
ALTER TABLE `UserInProject`
  ADD CONSTRAINT `userinproject_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userinproject_ibfk_2` FOREIGN KEY (`projectId`) REFERENCES `Project` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
