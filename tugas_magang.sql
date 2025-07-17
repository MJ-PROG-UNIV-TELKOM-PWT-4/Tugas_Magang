-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2025 at 01:50 AM
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
-- Database: `tugas_magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL COMMENT 'nullable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Elektronik', 'Produk elektronik'),
(2, 'Pakaian', 'Baju dan aksesori'),
(3, 'Makanan', 'Makanan dan minuman');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL COMMENT 'Stock Keeping Unit',
  `description` text DEFAULT NULL COMMENT 'nullable',
  `purchase_price` decimal(10,0) DEFAULT NULL,
  `selling_price` decimal(10,0) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'nullable, Path ke file gambar',
  `minimum_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `name`, `sku`, `description`, `purchase_price`, `selling_price`, `image`, `minimum_stock`) VALUES
(1, 3, 3, 'Jaket Hoodie Max', 'JH-001', 'Jaket Hoodie Max dengan kualitas terbaik.', 171533, 239848, 'img/jh-001.jpg', 30),
(2, 3, 1, 'Kamera Digital Pro', 'KD-002', 'Kamera Digital Pro dengan kualitas terbaik.', 132763, 151155, 'img/kd-002.jpg', 20),
(3, 2, 3, 'Sereal Organik X', 'SO-003', 'Sereal Organik X dengan kualitas terbaik.', 196492, 287158, 'img/so-003.jpg', 20),
(4, 3, 2, 'Celana Jeans X', 'CJ-004', 'Celana Jeans X dengan kualitas terbaik.', 132672, 227737, 'img/cj-004.jpg', 10),
(5, 3, 1, 'Celana Jeans Max', 'CJ-005', 'Celana Jeans Max dengan kualitas terbaik.', 39879, 108885, 'img/cj-005.jpg', 10),
(6, 1, 2, 'Roti Gandum X', 'RG-006', 'Roti Gandum X dengan kualitas terbaik.', 196868, 255116, 'img/rg-006.jpg', 30),
(7, 3, 3, 'Kaos Oversize Lite', 'KO-007', 'Kaos Oversize Lite dengan kualitas terbaik.', 49236, 138911, 'img/ko-007.jpg', 20),
(8, 1, 2, 'Headphone Pro', 'HPX-008', 'Headphone Pro dengan kualitas terbaik.', 160725, 250372, 'img/hpx-008.jpg', 10),
(9, 2, 2, 'Headphone Pro', 'HPX-009', 'Headphone Pro dengan kualitas terbaik.', 66561, 91981, 'img/hpx-009.jpg', 10),
(10, 3, 3, 'Keyboard Mekanik Max', 'KM-010', 'Keyboard Mekanik Max dengan kualitas terbaik.', 197059, 281554, 'img/km-010.jpg', 30),
(11, 1, 3, 'Kamera Digital Pro', 'KD-011', 'Kamera Digital Pro dengan kualitas terbaik.', 194558, 213837, 'img/kd-011.jpg', 10),
(12, 3, 3, 'Kamera Digital X', 'KD-012', 'Kamera Digital X dengan kualitas terbaik.', 122912, 140375, 'img/kd-012.jpg', 20),
(13, 2, 2, 'Coklat Batangan Pro', 'CB-013', 'Coklat Batangan Pro dengan kualitas terbaik.', 21151, 96858, 'img/cb-013.jpg', 20),
(14, 2, 2, 'Coklat Batangan Max', 'CB-014', 'Coklat Batangan Max dengan kualitas terbaik.', 68903, 98468, 'img/cb-014.jpg', 30),
(15, 2, 1, 'Roti Gandum Lite', 'RG-015', 'Roti Gandum Lite dengan kualitas terbaik.', 170392, 200436, 'img/rg-015.jpg', 30),
(16, 2, 3, 'Kaos Oversize Lite', 'KO-016', 'Kaos Oversize Lite dengan kualitas terbaik.', 11364, 59341, 'img/ko-016.jpg', 20),
(17, 2, 3, 'Kaos Oversize Max', 'KO-017', 'Kaos Oversize Max dengan kualitas terbaik.', 134230, 173999, 'img/ko-017.jpg', 10),
(18, 2, 2, 'Celana Jeans Lite', 'CJ-018', 'Celana Jeans Lite dengan kualitas terbaik.', 72399, 110881, 'img/cj-018.jpg', 20),
(19, 3, 1, 'Jaket Hoodie Max', 'JH-019', 'Jaket Hoodie Max dengan kualitas terbaik.', 147720, 185823, 'img/jh-019.jpg', 30),
(20, 3, 3, 'Jaket Hoodie Lite', 'JH-020', 'Jaket Hoodie Lite dengan kualitas terbaik.', 162198, 186268, 'img/jh-020.jpg', 20),
(21, 2, 3, 'Jaket Hoodie Lite', 'JH-021', 'Jaket Hoodie Lite dengan kualitas terbaik.', 151612, 224978, 'img/jh-021.jpg', 10),
(22, 3, 1, 'Roti Gandum X', 'RG-022', 'Roti Gandum X dengan kualitas terbaik.', 25288, 104200, 'img/rg-022.jpg', 10),
(23, 3, 1, 'Celana Jeans Max', 'CJ-023', 'Celana Jeans Max dengan kualitas terbaik.', 87169, 180692, 'img/cj-023.jpg', 20),
(24, 3, 1, 'Power Bank X', 'PB-024', 'Power Bank X dengan kualitas terbaik.', 132495, 161351, 'img/pb-024.jpg', 20),
(25, 3, 3, 'Kamera Digital Max', 'KD-025', 'Kamera Digital Max dengan kualitas terbaik.', 111788, 190333, 'img/kd-025.jpg', 20),
(26, 1, 2, 'Power Bank Lite', 'PB-026', 'Power Bank Lite dengan kualitas terbaik.', 57369, 74639, 'img/pb-026.jpg', 30),
(27, 2, 1, 'Coklat Batangan X', 'CB-027', 'Coklat Batangan X dengan kualitas terbaik.', 179897, 208475, 'img/cb-027.jpg', 10),
(28, 2, 3, 'Sereal Organik Lite', 'SO-028', 'Sereal Organik Lite dengan kualitas terbaik.', 121953, 155657, 'img/so-028.jpg', 10),
(29, 2, 3, 'Kaos Oversize X', 'KO-029', 'Kaos Oversize X dengan kualitas terbaik.', 107575, 193210, 'img/ko-029.jpg', 20),
(30, 2, 1, 'Jaket Hoodie Max', 'JH-030', 'Jaket Hoodie Max dengan kualitas terbaik.', 41141, 130547, 'img/jh-030.jpg', 30);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'Misalnya: ukuran, warna, berat',
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `value`) VALUES
(1, 1, 'Warna', 'Biru'),
(2, 1, 'Berat', '200 gram'),
(3, 2, 'Warna', 'Putih'),
(4, 2, 'Berat', '100 gram'),
(5, 3, 'Warna', 'Putih'),
(6, 3, 'Berat', '100 gram'),
(7, 4, 'Warna', 'Hitam'),
(8, 4, 'Berat', '300 gram'),
(9, 5, 'Warna', 'Biru'),
(10, 5, 'Berat', '300 gram'),
(11, 6, 'Warna', 'Hitam'),
(12, 6, 'Berat', '250 gram'),
(13, 7, 'Warna', 'Biru'),
(14, 7, 'Berat', '250 gram'),
(15, 8, 'Warna', 'Putih'),
(16, 8, 'Berat', '100 gram'),
(17, 9, 'Warna', 'Putih'),
(18, 9, 'Berat', '200 gram'),
(19, 10, 'Warna', 'Merah'),
(20, 10, 'Berat', '250 gram'),
(21, 11, 'Warna', 'Merah'),
(22, 11, 'Berat', '100 gram'),
(23, 12, 'Warna', 'Hitam'),
(24, 12, 'Berat', '100 gram'),
(25, 13, 'Warna', 'Biru'),
(26, 13, 'Berat', '200 gram'),
(27, 14, 'Warna', 'Putih'),
(28, 14, 'Berat', '250 gram'),
(29, 15, 'Warna', 'Putih'),
(30, 15, 'Berat', '200 gram'),
(31, 16, 'Warna', 'Putih'),
(32, 16, 'Berat', '200 gram'),
(33, 17, 'Warna', 'Merah'),
(34, 17, 'Berat', '200 gram'),
(35, 18, 'Warna', 'Putih'),
(36, 18, 'Berat', '300 gram'),
(37, 19, 'Warna', 'Putih'),
(38, 19, 'Berat', '250 gram'),
(39, 20, 'Warna', 'Merah'),
(40, 20, 'Berat', '250 gram'),
(41, 21, 'Warna', 'Merah'),
(42, 21, 'Berat', '100 gram'),
(43, 22, 'Warna', 'Putih'),
(44, 22, 'Berat', '250 gram'),
(45, 23, 'Warna', 'Hitam'),
(46, 23, 'Berat', '200 gram'),
(47, 24, 'Warna', 'Biru'),
(48, 24, 'Berat', '250 gram'),
(49, 25, 'Warna', 'Putih'),
(50, 25, 'Berat', '300 gram'),
(51, 26, 'Warna', 'Biru'),
(52, 26, 'Berat', '300 gram'),
(53, 27, 'Warna', 'Hitam'),
(54, 27, 'Berat', '300 gram'),
(55, 28, 'Warna', 'Merah'),
(56, 28, 'Berat', '200 gram'),
(57, 29, 'Warna', 'Merah'),
(58, 29, 'Berat', '300 gram'),
(59, 30, 'Warna', 'Biru'),
(60, 30, 'Berat', '100 gram');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` enum('Masuk','Keluar') DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('Pending','Diterima','Ditolak','Dikeluarkan') DEFAULT NULL,
  `notes` text DEFAULT NULL COMMENT 'nullable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL COMMENT 'nullable',
  `phone` varchar(255) DEFAULT NULL COMMENT 'nullable',
  `email` varchar(255) DEFAULT NULL COMMENT 'nullable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'PT. Sumber Rejeki', 'Jl. Mawar No. 10', '081234567890', 'sumber@rejeki.co.id'),
(2, 'IndoFashion', 'Jl. Melati No. 2', '085678901234', 'info@indofashion.com'),
(3, 'MakanEnak Inc', 'Jl. Kenanga No. 5', '087712345678', 'cs@makanenak.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Staff Gudang','Manajer Gudang') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Aji Prasetyo Nugroho', 'ajiprast@gmail.com', '$2y$10$A5SzzHClkPK3.OGZRRXffOTOFrH/gkiSiDzQ0Tf4vS33eTi7er3s.', 'Admin'),
(2, 'Rio', 'rio@gmail.com', '$2y$10$tUq6a7h.fvCxyBX4OXyTF.wNoya2HTq8z9Iw.99d56asqIy/.XZiS', 'Manajer Gudang'),
(3, 'Aji', 'aji123@gmail.com', '$2y$10$fYB4x6QSP5qGmHL9/eN.KOaOzOcWL42tBPI0HRu5YSWLslbxeisEq', 'Admin'),
(4, 'Reggy', 'reggy@gmail.com', '$2y$10$OqC/h5kat1HNd7LwEIvz..jLjIfvFj7F5gPISnJWCe9Y5SLeSGQvi', 'Staff Gudang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
