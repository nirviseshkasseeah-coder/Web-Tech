-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2025 at 02:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ryans_coffee_and_pastries_db`
--
CREATE DATABASE IF NOT EXISTS `ryans_coffee_and_pastries_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ryans_coffee_and_pastries_db`;
-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `UserID` int(11) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`UserID`, `PhoneNumber`) VALUES
(1005, '123-456-7890'),
(1006, '987-654-3210'),
(1007, '555-555-5555');

-- --------------------------------------------------------

--
-- Table structure for table `coffee`
--

CREATE TABLE `coffee` (
  `ProductID` int(11) NOT NULL,
  `ServingStyle` enum('Hot','Iced') NOT NULL,
  `IntensityLevel` enum('Mild','Medium','Strong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffee`
--

INSERT INTO `coffee` (`ProductID`, `ServingStyle`, `IntensityLevel`) VALUES
(2009, 'Hot', 'Strong'),
(2010, 'Hot', 'Strong'),
(2011, 'Hot', 'Medium'),
(2012, 'Hot', 'Medium'),
(2013, 'Hot', 'Mild'),
(2014, 'Hot', 'Mild'),
(2015, 'Hot', 'Mild'),
(2016, 'Hot', 'Mild'),
(2017, 'Hot', 'Medium'),
(2018, 'Hot', 'Medium'),
(2019, 'Hot', 'Medium'),
(2020, 'Hot', 'Medium'),
(2021, 'Iced', 'Medium'),
(2022, 'Iced', 'Medium'),
(2023, 'Iced', 'Medium'),
(2024, 'Iced', 'Medium'),
(2025, 'Iced', 'Strong'),
(2026, 'Iced', 'Strong');

-- --------------------------------------------------------

--
-- Table structure for table `desserts`
--

CREATE TABLE `desserts` (
  `ProductID` int(11) NOT NULL,
  `SweetnessLevel` enum('Low','Medium','High') NOT NULL,
  `ServingTemperature` enum('Chilled','Room','Warm') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desserts`
--

INSERT INTO `desserts` (`ProductID`, `SweetnessLevel`, `ServingTemperature`) VALUES
(2001, 'High', 'Room'),
(2002, 'High', 'Room'),
(2003, 'Medium', 'Room'),
(2004, 'High', 'Chilled'),
(2005, 'Medium', 'Chilled'),
(2006, 'High', 'Warm'),
(2007, 'Low', 'Warm'),
(2008, 'Medium', 'Warm');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `ProductID` int(11) NOT NULL,
  `Size` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`ProductID`, `Size`) VALUES
(2009, 'Regular'),
(2010, 'Large'),
(2011, 'Regular'),
(2012, 'Large'),
(2013, 'Regular'),
(2014, 'Large'),
(2015, 'Regular'),
(2016, 'Large'),
(2017, 'Regular'),
(2018, 'Large'),
(2019, 'Regular'),
(2020, 'Large'),
(2021, 'Regular'),
(2022, 'Large'),
(2023, 'Regular'),
(2024, 'Large'),
(2025, 'Regular'),
(2026, 'Large'),
(2027, 'Regular'),
(2028, 'Large'),
(2029, 'Regular'),
(2030, 'Large'),
(2031, 'Regular'),
(2032, 'Large'),
(2033, 'Regular'),
(2034, 'Large'),
(2035, 'Regular'),
(2036, 'Large'),
(2037, 'Regular'),
(2038, 'Large');

-- --------------------------------------------------------

--
-- Table structure for table `milkshake`
--

CREATE TABLE `milkshake` (
  `ProductID` int(11) NOT NULL,
  `BaseIngredient` enum('Ice Cream','Fruit','Syrup') NOT NULL,
  `ContainsAdditives` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `milkshake`
--

INSERT INTO `milkshake` (`ProductID`, `BaseIngredient`, `ContainsAdditives`) VALUES
(2027, 'Ice Cream', 1),
(2028, 'Ice Cream', 1),
(2029, 'Syrup', 1),
(2030, 'Syrup', 1),
(2031, 'Ice Cream', 1),
(2032, 'Ice Cream', 1),
(2033, 'Fruit', 0),
(2034, 'Fruit', 0),
(2035, 'Syrup', 1),
(2036, 'Syrup', 1),
(2037, 'Fruit', 0),
(2038, 'Fruit', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordercontains`
--

CREATE TABLE `ordercontains` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordercontains`
--

INSERT INTO `ordercontains` (`OrderID`, `ProductID`, `Quantity`, `TotalPrice`) VALUES
(3001, 2009, 3, 450.00),
(3001, 2027, 2, 280.00),
(3002, 2012, 2, 280.00),
(3002, 2030, 3, 150.00),
(3003, 2011, 2, 50.00),
(3004, 2015, 2, 50.00),
(3004, 2034, 2, 140.00),
(3005, 2009, 2, 300.00),
(3005, 2029, 3, 120.00),
(3006, 2018, 2, 100.00),
(3006, 2031, 2, 100.00),
(3007, 2020, 3, 90.00),
(3008, 2023, 2, 80.00),
(3008, 2038, 2, 110.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` enum('Pending','Claimed','Cancelled') NOT NULL,
  `Date` datetime NOT NULL,
  `PickupDate` date DEFAULT NULL,
  `PickupTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `Status`, `Date`, `PickupDate`, `PickupTime`) VALUES
(3001, 1001, 'Pending', '2025-11-30 09:15:00', '2025-11-30', '10:00:00'),
(3002, 1002, 'Claimed', '2025-11-29 14:20:00', '2025-11-29', '15:00:00'),
(3003, 1003, 'Cancelled', '2025-11-28 11:05:00', '2025-11-28', '11:30:00'),
(3004, 1004, 'Pending', '2025-11-30 08:45:00', '2025-11-30', '09:30:00'),
(3005, 1001, 'Claimed', '2025-11-29 17:10:00', '2025-11-29', '18:00:00'),
(3006, 1002, 'Pending', '2025-11-30 10:30:00', '2025-11-30', '11:15:00'),
(3007, 1003, 'Claimed', '2025-11-28 15:25:00', '2025-11-28', '16:00:00'),
(3008, 1004, 'Cancelled', '2025-11-29 12:40:00', '2025-11-29', '13:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(5,2) NOT NULL,
  `Points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Description`, `Price`, `Points`) VALUES
(2001, 'Chocolate Cake', 'Experience the ultimate indulgence with this rich chocolate cake, layered to perfection and topped with glossy chocolate ganache and fresh strawberry.', 159.99, 100),
(2002, 'Creamy Chocolate Cake', 'Indulge in the rich layers of this decadent chocolate cake. Perfectly creamy and sweet, each slice boasts an exquisite blend of flavors topped with a hint of cocoa.', 180.00, 125),
(2003, 'Raspberry Cake', 'The rich chocolate and fresh raspberries create a harmonious blend of flavors, beautifully presented on a plate. Topped with vibrant raspberries and a hint of mint.', 149.99, 90),
(2004, 'Cheesecake with grated chocolate', 'Indulge in this luscious cheesecake slice, beautifully adorned with rich chocolate drizzle, a vibrant cherry, and delicate chocolate shavings. A sweetly irresistible, crisp pastry base complements the creamy texture, making it the perfect dessert choice.', 190.00, 130),
(2005, 'Tiramirasu Cake', 'This tantalizing tiramisu cake is a slice of the classic Italian dessert, beautifully presented. The cake features layers of creamy mascarpone cheese, chocolate sponge cake, and subtle coffee flavor, all dusted with cocoa powder.', 200.00, 150),
(2006, 'Chocolate Pancake', 'Indulge in the delectable delights of soft, fluffy pancakes generously drizzled with rich, velvety chocolate sauce. Perfect for a luxurious breakfast. These pancakes promise a heavenly taste experience.', 99.99, 50),
(2007, 'Strawberry Pancake', 'Indulge in this mouthwatering wallpaper featuring fluffy pancakes filled with fresh strawberries. Topped with powdered sugar and accompanied by vibrant strawberries, this dessert is a feast for the eyes.', 90.00, 55),
(2008, 'Stacked Fluffy Pancake', 'Indulge in this mouthwatering featuring a towering stack of golden pancakes drizzled with syrup, topped with fresh blueberries, raspberries, and mint leaves.', 150.00, 90),
(2009, 'Espresso', 'Rich, bold espresso shot served in a regular cup. Perfect for a quick pick-me-up, delivering strong aroma and flavor.', 150.00, 45),
(2010, 'Espresso', 'A stronger, larger serving of rich bold espresso. Ideal for coffee lovers who enjoy a robust and intense flavor experience.', 180.00, 60),
(2011, 'Cappuccino', 'Classic cappuccino with foamed milk in a regular cup. Smooth espresso balanced with creamy milk froth for a delightful experience.', 110.00, 25),
(2012, 'Cappuccino', 'Larger cappuccino with extra smooth foamed milk, perfect for those who enjoy a richer, creamier cup.', 140.00, 40),
(2013, 'Latte', 'Smooth latte with creamy steamed milk, regular size. Comforting and lightly sweet, ideal for a relaxing coffee break.', 110.00, 25),
(2014, 'Latte', 'Large latte with extra steamed milk for a richer and creamier taste. Perfect for enjoying a longer, indulgent coffee moment.', 140.00, 40),
(2015, 'Hot Chocolate', 'Creamy hot chocolate served in a regular cup, smooth and velvety with a rich chocolate taste. Perfect for a cozy treat.', 140.00, 30),
(2016, 'Hot Chocolate', 'Large hot chocolate with richer, extra cocoa flavor and frothy texture. A delightful indulgence for chocolate lovers.', 170.00, 55),
(2017, 'Mocha', 'Regular mocha with a balanced blend of coffee and chocolate. Smooth, rich, and aromatic, ideal for a luxurious coffee experience.', 135.00, 35),
(2018, 'Mocha', 'Large mocha with deeper chocolate and espresso flavor. Perfect for those craving a strong yet creamy coffee treat.', 160.00, 50),
(2019, 'Americano', 'Regular Americano with smooth, bold espresso and hot water. A classic, well-balanced coffee, ideal for any time of the day.', 110.00, 25),
(2020, 'Americano', 'Large Americano with extra hot water for a milder strength, providing a longer, refreshing coffee experience.', 125.00, 30),
(2021, 'Iced Mocha', 'Chilled mocha with ice and chocolate, regular size. A refreshing blend of coffee and chocolate, perfect for warm days.', 160.00, 50),
(2022, 'Iced Mocha', 'Large iced mocha with extra chocolate and smooth espresso, ideal for a luxurious iced coffee treat.', 180.00, 65),
(2023, 'Iced Americano', 'Refreshing iced Americano made with bold espresso. Cool and invigorating, perfect for a hot afternoon.', 125.00, 30),
(2024, 'Iced Americano', 'Large iced Americano with extra espresso for deeper flavor. Crisp, smooth, and ideal for a longer iced coffee experience.', 140.00, 40),
(2025, 'Vietnamese Coffee', 'Traditional Vietnamese coffee with bold, sweet flavor, served in a regular cup. Unique and aromatic, offering a rich coffee experience.', 140.00, 40),
(2026, 'Vietnamese Coffee', 'Large Vietnamese coffee with stronger condensed milk blend, perfect for those who love intense flavor and creaminess.', 160.00, 50),
(2027, 'Vanilla Milkshake', 'Classic vanilla milkshake, smooth and creamy. A sweet, satisfying drink perfect for any time of the day.', 140.00, 40),
(2028, 'Vanilla Milkshake', 'Large vanilla milkshake with extra creaminess for a richer, more indulgent treat.', 160.00, 50),
(2029, 'Chocolate Milkshake', 'Rich chocolate milkshake, regular serving. Smooth, sweet, and deeply chocolatey.', 140.00, 40),
(2030, 'Chocolate Milkshake', 'Large chocolate milkshake with deeper cocoa flavor and creamy texture, perfect for dessert or treat.', 160.00, 50),
(2031, 'Almond Milkshake', 'Smooth almond milkshake with nutty flavor and creamy texture. A perfect light yet indulgent treat.', 140.00, 40),
(2032, 'Almond Milkshake', 'Large almond milkshake with extra richness and nutty flavor, perfect for almond lovers.', 160.00, 50),
(2033, 'Strawberry Milkshake', 'Fresh strawberry milkshake, regular serving. Fruity, creamy, and delightfully refreshing.', 160.00, 50),
(2034, 'Strawberry Milkshake', 'Large strawberry milkshake with extra fruitiness and creaminess, perfect for a sweet summer treat.', 185.00, 70),
(2035, 'Caramel Milkshake', 'Smooth caramel milkshake, lightly sweet and creamy. A delightful dessert drink.', 160.00, 50),
(2036, 'Caramel Milkshake', 'Large caramel milkshake with richer caramel flavor and creamy texture, perfect for caramel lovers.', 180.00, 65),
(2037, 'Banana Milkshake', 'Creamy banana milkshake with natural sweetness, regular serving. Refreshing and smooth.', 150.00, 45),
(2038, 'Banana Milkshake', 'Large banana milkshake with extra banana blend for a richer, fruitier taste.', 170.00, 55);

-- --------------------------------------------------------

--
-- Table structure for table `redeems`
--

CREATE TABLE `redeems` (
  `UserID` int(11) NOT NULL,
  `RewardName` varchar(100) NOT NULL,
  `PointsUsed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `redeems`
--

INSERT INTO `redeems` (`UserID`, `RewardName`, `PointsUsed`) VALUES
(1001, 'Bundle of Delicacies', 150),
(1002, 'Rush N\' Go', 75),
(1003, 'Walnut Brownie Cake', 250),
(1004, 'Brew Crew Trio', 300);

-- --------------------------------------------------------

--
-- Table structure for table `registeredusers`
--

CREATE TABLE `registeredusers` (
  `UserID` int(11) NOT NULL,
  `PointsBalance` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registeredusers`
--

INSERT INTO `registeredusers` (`UserID`, `PointsBalance`) VALUES
(1001, 150),
(1002, 200),
(1003, 120),
(1004, 300),
(1008, 0),
(1010, 0),
(1011, 0),
(1012, 0),
(1026, 0),
(1030, 0),
(1036, 0),
(1037, 0),
(1040, 0),
(1043, 0),
(1045, 0),
(1048, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `RewardName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `PointsToRedeem` int(11) NOT NULL,
  `IsRedeemable` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`RewardName`, `Description`, `PointsToRedeem`, `IsRedeemable`) VALUES
('Brew Crew Trio', 'Redeem a delicious bundle: 3 rich cappuccinos, 2 donuts, and a slice of banana cake — a sweet reward for any time of day.', 400, 0),
('Bundle of Delicacies', 'Treat yourself to two indulgent donuts, a fluffy cupcake, and a smooth latte — all yours to redeem and enjoy.', 150, 0),
('La Boîte de Douceur aux macarons (10 pcs)', 'Indulge in a delightful moment with a steaming cup of coffee paired with an assortment of colourful macarons. Perfect for food enthusiasts and dessert lovers.', 800, 1),
('Rush N\' Go', 'Redeem a bold Greek coffee and a decadent slice of creamy chocolate cake — a reward made for true indulgence.', 75, 0),
('Walnut Brownie Cake', 'Indulge in these rich and fudgy walnut brownies, a delightful treat perfect for any occasion. Each piece is packed with chunks of walnuts, offering a satisfying crunch that complements the chocolatey goodness. Enjoy the perfect blend of flavors and textures in every bite.', 250, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`) VALUES
(1001, 'Bob Smith', 'bob.smith@gmail.com', '$2y$10$5GQ6cwvQ95.MeZEjzl2XTeZ63xRBj1bS6VaI9nqz7k.Tr9IW1mG8S'),
(1002, 'Jeff Stone', 'jeff.stone@yahoo.com', '$2y$10$kNTxMp58GxE2/3aNstbO9u7U3yD1DTiI/mxIk2L9PyN/4mlaIZWFK'),
(1003, 'Alice Johnson', 'alice.johnson@outlook.com', '$2y$10$3KVrPsV5UwNqLRKsPn7VFuKx4EcAcT2Wpa6rGMhKuZMiOa.2cn4Na'),
(1004, 'Gordon Taylor', 'gordon.taylor@hotmail.com', '$2y$10$nG1/EBZp3I5IxsFpE6U1NOXN7Y6JXO78vwMR3D1UtlfRNPq0BvZZm'),
(1005, 'AdminMike', 'mike.admin@gmail.com', '$2y$10$DgJZy/KJz0Lh2W5G5f3R..x4ri0pLO3lR7zjG0vOk3cNY3Jm6bl8u'),
(1006, 'AdminSara', 'sara.admin@yahoo.com', '$2y$10$uT4HIFt6ZdV1xqA1tVnVFe0QzO36YpTFFjZp4aKkNR2x8l9VJfA6S'),
(1007, 'AdminJohn', 'john.admin@gmail.com', '$2y$10$F5R8v1pJjZy3XYgRlwq1L.TXvJz4uKg9Vx7ULtFZJrR/rBz0vUpyC'),
(1008, 'testuser', 'testuser@gmail.com', '$2y$10$eHGreMeJNlT9MfOqo6uMuuGVFjo6qX8dktDzBQXtNo8mGbLNTg80a'),
(1010, 'Tom Smith', 'tom.smith@umail.uom.ac.mu', '$2y$10$anVASFIOpu/8nSQLt9mq/OUjZ6S8W9QAV.U1FanGk2kfiLhoI9pM6'),
(1011, 'Alfred Cooper', 'alfred.cooper@yahoo.com', '$2y$10$yzKp9fii5xho2cVPJo8JfO2R58YiPhFh.Kixv3xrueQhaQuMD3z1K'),
(1012, 'Joe Bryce', 'joe.bryce@gmail.com', '$2y$10$yAywdBmS1X7skWxWmlO0cuwxLQjqH8C.TfJOfxxMMRwNc105/mlfO'),
(1026, 'Rick Astley', 'rick.astley@hismail.com', '$2y$10$6vuK4b6YZ86Zar37NFsrh.RcOpG0I1wzASsW.CTRxPpjr6OZaR4cG'),
(1030, 'Jason Bourne', 'jason.bourne@secretmail.com', '$2y$10$u5OUuFuSox1PCl2eRt56Q.1MVb5xL6aHwOorRBWxKji/icN7hGQ5m'),
(1036, 'John Wick', 'john.wick@continentalmail.com', '$2y$10$ALs665fXKoHfgk8Ad/NQgO6dJ.Iap4qZjJwqUYl95q9ddgjd4AAVa'),
(1037, 'Tom Johnson', 'tom.johnson@gmail.com', '$2y$10$.USZX3wEwVYu.JC8Ph.c2Or6lvWPtZOjQ4KiLbGSEQhh5wbVUb1Hu'),
(1040, 'Tom Keogh', 'tom.keogh@gmail.com', '$2y$10$wLJuu20SBrFrXc6GIjgYVe1VH0QpXxpi4qPQO0KfJ03WffYjT837W'),
(1043, 'John Koegh', 'john.keogh@gmail.com', '$2y$10$VLq0PLdpsHKp1RWs.ztldeU.o/yIuqXWtcwA2pDwpBWW5dmZTK62y'),
(1045, 'Mike Johnson', 'mike.johnson@gmail.com', '$2y$10$XFWAsGzyr0IC7UU1zBrGO.Jwe4hXKY3YSoqI3SMZbH9QsmwtficN2'),
(1048, 'Cole Smith', 'cole.smith@gmail.com', '$2y$10$Qugn6Xb1hhiR.6.vuGsRmu2UxC06Tz4w//QSK2lbvT6EjwjymuMNG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `coffee`
--
ALTER TABLE `coffee`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `desserts`
--
ALTER TABLE `desserts`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `milkshake`
--
ALTER TABLE `milkshake`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `ordercontains`
--
ALTER TABLE `ordercontains`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `redeems`
--
ALTER TABLE `redeems`
  ADD PRIMARY KEY (`UserID`,`RewardName`),
  ADD KEY `RewardName` (`RewardName`);

--
-- Indexes for table `registeredusers`
--
ALTER TABLE `registeredusers`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`RewardName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3009;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2039;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1049;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `coffee`
--
ALTER TABLE `coffee`
  ADD CONSTRAINT `coffee_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `drinks` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `desserts`
--
ALTER TABLE `desserts`
  ADD CONSTRAINT `desserts_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `drinks`
--
ALTER TABLE `drinks`
  ADD CONSTRAINT `drinks_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `milkshake`
--
ALTER TABLE `milkshake`
  ADD CONSTRAINT `milkshake_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `drinks` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `ordercontains`
--
ALTER TABLE `ordercontains`
  ADD CONSTRAINT `ordercontains_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordercontains_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `registeredusers` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `redeems`
--
ALTER TABLE `redeems`
  ADD CONSTRAINT `redeems_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `registeredusers` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `redeems_ibfk_2` FOREIGN KEY (`RewardName`) REFERENCES `rewards` (`RewardName`) ON DELETE CASCADE;

--
-- Constraints for table `registeredusers`
--
ALTER TABLE `registeredusers`
  ADD CONSTRAINT `registeredusers_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
