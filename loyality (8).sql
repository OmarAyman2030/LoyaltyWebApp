-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 05:44 PM
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
-- Database: `loyality`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` varchar(50) NOT NULL,
  `cvv` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `cvv`, `date`, `name`) VALUES
('1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`user_id`, `product_id`, `quantity`) VALUES
(17, 24, 3),
(12, 23, 1),
(70, 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Foods and drinks'),
(2, 'fun'),
(3, 'Hotels'),
(4, 'Health'),
(5, 'Retails');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`fname`, `lname`, `email`, `phone`, `message`) VALUES
('omar', 'sadaam', 'ahmed@gmail.com', 'nooo', 'nooo'),
('omar', 'sadaam', 'hamada@gmail.com', 'noooooooo', 'noooooooo'),
('ahmed', 'sayed', 'omr@gmail.con', '01115182462', 'dcfmkl,'),
('nabil', 'omar', 'nabil@gmail.com', '01033829132', 'opopopopopopopopopopopop'),
('omar', 'sadaam', 'Omar_20220318@fci.helwan.edu.eg', '01067977217', 'uidschuiedui');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `loyality` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `loyality`, `points`, `sub`) VALUES
(12, 3, 5817, 1),
(14, 3, 3193, 1),
(49, 3, 2429, 1),
(57, 3, 1826, 1),
(69, 2, 785, 1),
(70, 1, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `don` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `name`, `don`) VALUES
(1, 'Resala', 317),
(2, 'Gaza', 13);

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `name`, `cat_id`) VALUES
(1, 'Abo Tarek', 1),
(2, 'pizza_hut', 1),
(3, 'Helton', 3),
(5, 'Bazoka', 1),
(6, 'Max Muscle ', 4),
(7, 'Lego', 2),
(8, 'Lululemon', 5),
(13, 'tazkarti', 5),
(16, 'dream park', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Merchant-N` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `Pay_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`user_id`, `product_id`, `quantity`, `Merchant-N`, `price`, `Pay_by`) VALUES
(12, 22, 3, 'Abo Tarek', 45, 'PayPal'),
(12, 21, 2, 'pizza_hut', 350, 'PayPal'),
(12, 21, 5, 'pizza_hut', 350, 'PayPal'),
(12, 23, 5, 'Helton', 1342, 'PayPal'),
(12, 22, 2, 'Abo Tarek', 45, 'PayPal'),
(12, 22, 2, 'Abo Tarek', 45, 'PayPal'),
(12, 22, 2, 'Abo Tarek', 45, 'PayPal'),
(12, 22, 2, 'Abo Tarek', 45, 'PayPal'),
(12, 24, 2, 'Helton', 478, 'PayPal'),
(12, 21, 6, 'pizza_hut', 350, 'PayPal'),
(12, 22, 1, 'Abo Tarek', 45, 'PayPal'),
(12, 21, 2, 'pizza_hut', 350, 'PayPal'),
(12, 24, 1, 'Helton', 478, 'paypal'),
(12, 22, 1, 'Abo Tarek', 65, 'paypal'),
(12, 24, 1, 'Helton', 478, 'apple pay'),
(12, 24, 2, 'Helton', 478, 'CARD_NUMBER'),
(14, 22, 2, 'Abo Tarek', 65, 'CARD_NUMBER'),
(14, 24, 1, 'Helton', 478, 'CARD_NUMBER'),
(14, 22, 2, 'Abo Tarek', 65, 'CARD_NUMBER'),
(14, 24, 1, 'Helton', 478, 'CARD_NUMBER'),
(14, 22, 2, 'Abo Tarek', 65, 'paypal'),
(14, 24, 1, 'Helton', 478, 'paypal'),
(14, 23, 1, 'Helton', 1342, 'CARD_NUMBER'),
(14, 24, 1, 'Helton', 478, 'paypal'),
(12, 24, 1, 'Helton', 478, 'paypal'),
(12, 22, 1, 'Abo Tarek', 65, 'paypal'),
(12, 24, 1, 'Helton', 478, 'paypal'),
(12, 22, 1, 'Abo Tarek', 65, 'paypal'),
(12, 23, 1, 'Helton', 1342, 'paypal'),
(12, 24, 1, 'Helton', 478, 'paypal'),
(12, 24, 1, 'Helton', 478, 'paypal'),
(12, 24, 1, 'Helton', 478, 'paypal'),
(12, 23, 1, 'Helton', 1342, 'paypal'),
(12, 22, 1, 'Abo Tarek', 65, 'paypal'),
(12, 22, 1, 'Abo Tarek', 65, 'paypal'),
(12, 23, 1, 'Helton', 1342, 'paypal'),
(12, 24, 1, 'Helton', 478, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'CARD_NUMBER'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'google pay'),
(49, 23, 2, 'Helton', 1342, 'apple pay'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 23, 2, 'Helton', 1342, 'paypal'),
(49, 22, 1, 'Abo Tarek', 65, 'paypal'),
(49, 22, 1, 'Abo Tarek', 65, 'paypal'),
(49, 23, 1, 'Helton', 1342, 'paypal'),
(49, 23, 1, 'Helton', 1342, 'google pay'),
(49, 22, 4, 'Abo Tarek', 65, 'google pay'),
(49, 23, 1, 'Helton', 1342, 'paypal'),
(49, 22, 4, 'Abo Tarek', 65, 'paypal'),
(57, 24, 1, 'Helton', 478, 'paypal'),
(57, 24, 1, 'Helton', 478, 'paypal'),
(57, 24, 1, 'Helton', 478, 'paypal'),
(57, 23, 2, 'Helton', 1342, 'paypal'),
(14, 28, 1, 'pizza_hut', 20, 'paypal'),
(14, 30, 4, 'Helton', 323, 'CARD_NUMBER'),
(14, 32, 1, 'Helton', 1400, 'paypal'),
(14, 44, 1, 'Lululemon', 65, 'paypal'),
(14, 43, 1, 'Lululemon', 560, 'paypal'),
(14, 46, 1, 'Lululemon', 250, 'paypal'),
(69, 28, 1, 'pizza_hut', 20, 'paypal'),
(69, 28, 1, 'pizza_hut', 20, 'paypal'),
(69, 28, 1, 'pizza_hut', 20, 'paypal'),
(69, 28, 1, 'pizza_hut', 20, 'paypal'),
(69, 45, 1, 'Abo Tarek', 21, 'paypal'),
(69, 28, 1, 'pizza_hut', 20, 'paypal'),
(69, 45, 1, 'Abo Tarek', 21, 'paypal'),
(69, 28, 4, 'pizza_hut', 20, 'paypal'),
(69, 45, 2, 'Abo Tarek', 21, 'paypal'),
(14, 28, 1, 'pizza_hut', 20, 'paypal'),
(14, 44, 4, 'Lululemon', 65, 'paypal'),
(69, 37, 1, 'Max Muscle ', 1500, 'paypal'),
(70, 45, 1, 'Abo Tarek', 21, 'paypal'),
(70, 45, 1, 'Abo Tarek', 21, 'paypal'),
(70, 45, 1, 'Abo Tarek', 21, 'CARD_NUMBER'),
(70, 45, 1, 'Abo Tarek', 21, 'paypal'),
(70, 45, 1, 'Abo Tarek', 21, 'paypal'),
(14, 32, 1, 'Helton', 1400, 'paypal'),
(14, 29, 7, 'pizza_hut', 35, 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `descripition` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `donation_p` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `Merchant_N` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `descripition`, `quantity`, `donation_p`, `image`, `category_id`, `donation_id`, `Merchant_N`) VALUES
(22, 'koshry', 35, 'anho ko4ry y 5al ', 29, 20, '../Views/imagesP/11-05-34cf0f1c8b-ff5d-4011-80aa-3dd02d046749.jpg', 1, 1, 'Abo Tarek'),
(23, 'rooom', 1342, 'scnsdncinwdiocnwdoncoedn', 0, 14, '../Views/imagesP/02-05-14960x0.webp', 3, 2, 'Helton'),
(24, 'rommm2', 478, 'erfermixwmeiqxmiwmeui33uimxui', 2, 12, '../Views/imagesP/03-05-07February-Blog-Images-8-800x533.png', 3, 2, 'Helton'),
(28, 'pizza', 20, 'pizaaaaaaaaaaaaaaaaaa', 1, 12, '../Views/imagesP/07-05-552652401_QFSSL_SupremePizza_00072-d910a935ba7d448e8c7545a963ed7101.jpg', 1, 1, 'pizza_hut'),
(29, 'Pasta ', 35, 'afkwekfwkfwejkl', 5, 12, '../Views/imagesP/07-05-1511691-tomato-and-garlic-pasta-ddmfs-3x4-1-bf607984a23541f4ad936b33b22c9074.jpg', 1, 1, 'pizza_hut'),
(31, 'Room #4', 1200, 'our rooom per night', 231, 20, '../Views/imagesP/11-05-41Penthouse-Room-Type-XOTELS.webp', 3, 2, 'Helton'),
(32, 'Room #5', 1400, 'our room is very near from nile ', 63, 19, '../Views/imagesP/11-05-40140127103345-peninsula-shanghai-deluxe-mock-up.jpg', 3, 1, 'Helton'),
(33, 'Fried chicken', 200, 'wgbaa hnia tkfy mia ', 220, 12, '../Views/imagesP/11-05-52Fried-Chicken_2-SQ.webp', 1, 1, 'Bazoka'),
(34, 'Series 26 Space', 120, 'WARNING:\r\nCHOKING HAZARD.\r\nToy contains small parts and a small ball. Not for children under 3 years.', 99, 16, '../Views/imagesP/11-05-4971046_Prod.webp', 2, 2, 'Lego'),
(35, 'McLaren MP4/4 & Ayrton Senna', 80, 'Collectible model race car for adults\r\nGet up close to the McLaren MP4/4 – ranked as one of the most successful F1 race cars of all time.', 350, 24, '../Views/imagesP/11-05-0210330_boxprod_v39.webp', 2, 2, 'Lego'),
(36, 'tazkrt dream park', 150, 'مش بس أقوى الألعاب ولا بس أكبر ملاهي فى الشرق\r\nالأوسط ولا أفضل برنامج فنى و مسارح دى كمان برامج طول اليوم ..\r\nتعاااالو...\r\n🎪 تعاااالو معانا في يوم مليان بالمغامرة والمرح\r\n🤡 ومش هانفوت فقرة الكلاون الم', 199, 18, '../Views/imagesP/11-05-44438127996_765684055703775_7571965756065824833_n.jpg', 2, 1, 'dream park'),
(37, 'Whey', 1500, 'Is a highly pure form of creatine monohydrate, it is made in Germany with 99.9% purity, which means that it is very low in impurities. This makes it a safe and effective choice for people looking to i', 99, 29, '../Views/imagesP/11-05-59image_512.jfif', 4, 2, 'Max Muscle '),
(38, 'creatin', 1750, 'Is a 100% ultra micronized creatine monohydrate pharmaceutical grade, Muscle Add creatine monohydrate creates energy in your body by increasing phosphocreatine levels to enhance your performance and i', 183, 13, '../Views/imagesP/11-05-20image_512 (1).jfif', 4, 1, 'Max Muscle '),
(39, 'Ahly vs eltrgy', 75, 'final of african cup', 2000, 19, '../Views/imagesP/11-05-4822.jpg', 5, 2, 'tazkarti'),
(40, 'wegz concert tickt', 500, 'wegz concert in zed park ', 299, 16, '../Views/imagesP/11-05-38342828_0.jpg', 5, 1, 'tazkarti'),
(41, 'early bird ticket', 450, 'essam sasa and double zokush in this concert ', 192, 14, '../Views/imagesP/11-05-522022_12_25_15_41_33_319.jpg', 5, 1, 'tazkarti'),
(42, 'She2oo film ticket', 100, 'she2ooo film fom vox cinema \r\n', 76, 13, '../Views/imagesP/11-05-52P_HO00011021.jpg', 5, 1, 'tazkarti'),
(43, 'hodies ', 560, 'hodeis made of 100% cotton', 344, 12, '../Views/imagesP/11-05-51mszpKaQVG4Uknnw8Er3TTW-1200-80.jpg', 5, 2, 'Lululemon'),
(44, 'Adel Shakel glasses', 65, 'glass that adel shakel were it ', 19, 12, '../Views/imagesP/11-05-50441874630_996646722030911_5213698330670510677_n.jpg', 1, 2, 'Lululemon'),
(45, 'rozblbn', 21, 'sfhuwhuifwuief', 0, 15, '../Views/imagesP/08-05-25Roz-Bi-Laban.jpg.webp', 1, 2, 'Abo Tarek'),
(46, 'Chemise m3dy elnas ', 250, 'Chemise Album 2017 m3dy el nas ', 128, 14, '../Views/imagesP/10-05-08thumb.jfif', 5, 2, 'Lululemon'),
(47, 'room #9', 1234, 'asjdqwdjkanwdqwdlkl', 1234, 14, '../Views/imagesP/04-05-45140127103345-peninsula-shanghai-deluxe-mock-up.jpg', 3, 2, 'Helton');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `Merchant_N` varchar(255) NOT NULL,
  `product_N` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`Merchant_N`, `product_N`, `status`) VALUES
('pizza_hut', 'pizza', 'Accepted'),
('pizza_hut', 'pasta ', 'Reject'),
('Abo Tarek', 'koshry', 'Accepted'),
('Abo Tarek', 'roz_blbn', 'Reject'),
('Helton', 'rooom', 'Accepted'),
('Abo Tarek', 'koshry', 'Accepted'),
('Abo Tarek', 'rozblbn', 'Accepted'),
('Lululemon', 'Chemise m3dy elnas ', 'Accepted'),
('Lululemon', 'kot4y aymony', 'Reject'),
('Helton', 'room #9', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Customer'),
(3, 'Merchant');

-- --------------------------------------------------------

--
-- Table structure for table `suggest_products`
--

CREATE TABLE `suggest_products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `descripition` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `donation_p` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `Merchant_N` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggest_products`
--

INSERT INTO `suggest_products` (`id`, `name`, `price`, `descripition`, `quantity`, `donation_p`, `image`, `category_id`, `donation_id`, `Merchant_N`) VALUES
(31, '4ta', 34, 'hmfdmhmdm', 6, 10, '../Views/imagesP/03-05-12GettyImages-1495444849-e1697493109641.webp', 1, 1, 'Abo Tarek');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `role_id`) VALUES
(1, 'OMAR', '3YAD', '01067977217', 'omr@gmail.com', '12345', 1),
(12, 'omar', 'ahmed', '01142376657', 'Sayed@gmail.com', '123', 2),
(14, 'omar', 'ahmed', '01142376657', 'Ahmed@gmail.com', '12', 2),
(16, 'Abo Tarek', '', '19191', 'abotarek@gmail.com', '1234', 3),
(18, 'pizza_hut', '', '0125251522', 'pizza_hut@mail.com', '12345', 3),
(22, 'Helton', '', '011122122112', 'helton@mail.com', '1234', 3),
(49, 'omar', 'sadaam', '01033829132', 'now@gmail.com', '12', 2),
(57, 'pepo', 'sadaam', 'm', 'o@fwffwfw2', '1', 2),
(58, 'Bazoka', '', '012737271811', 'bazoka@gmail.com', '12345', 3),
(59, 'Max Muscle', '', '0122828919', 'max@gmail.com', '12345', 3),
(62, 'Lego', '', '0122828919', 'lego@gmail.com', '12345', 3),
(63, 'Lululemon', '', '0122828919', 'Lululemon@gmail.com', '12345', 3),
(66, 'tazkarti', '', '012132434343', 'tazkarti@gmail.com', '123456', 3),
(67, 'dream park', '', '01233423444', 'dreampark@gmail.com', '12345', 3),
(69, 'pepo', 'ahmed', '01011002', 'pop0@gmail.com', '123', 2),
(70, 'hema', 'ahmed', '01067977217', 'hema123@gmail.com', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD KEY `cart_item_ibfk_1` (`user_id`),
  ADD KEY `cart_item_ibfk_2` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD KEY `user_id` (`id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `products_ibfk_1` (`donation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggest_products`
--
ALTER TABLE `suggest_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suggest_products`
--
ALTER TABLE `suggest_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `merchants_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
