-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2021 pada 16.16
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodfox`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `date`) VALUES
(1, 'admin', '$2y$10$mI/hpZ59vGgjs/lPTQWLJu.I82O93AEJ3gwFycAjuibOjAGi9dcTm', 'admin123@gmail.com', '2021-02-26 16:24:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dishesh`
--

CREATE TABLE `dishesh` (
  `d_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dishesh`
--

INSERT INTO `dishesh` (`d_id`, `r_id`, `name`, `about`, `price`, `img`) VALUES
(23, 8, 'Nasi Goreng Telur', 'Nasi Goreng yang enak dimakan saat masih hangat', 8, 'menu-nasi_goreng.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `restaurants`
--

CREATE TABLE `restaurants` (
  `r_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `o_hr` varchar(255) NOT NULL,
  `c_hr` varchar(255) NOT NULL,
  `o_days` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `restaurants`
--

INSERT INTO `restaurants` (`r_id`, `c_id`, `name`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `img`) VALUES
(8, 8, 'Rumah Makan Enak', 'rumahmakanenak@gmail.com', '085865924798', 'http://rumahmakanenak.com', '7am', '10pm', '24 Jam - Setiap hari', 'Jalan Raya Malang No 18', 'resto-1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`) VALUES
(8, 'Indonesian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`) VALUES
(36, 'Xiaconst', 'Mohan', 'Kurnia', 'handana1804@gmail.com', '0858659247', '$2y$10$DB39/TnDuwR3eIU4ZhvEV.4qESbsmmBdM4yjV6Q5B./fHsmuKXI4e', 'Jalan Raya Cemorokandang No 18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_orders`
--

CREATE TABLE `user_orders` (
  `o_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `success-date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_orders`
--

INSERT INTO `user_orders` (`o_id`, `u_id`, `d_id`, `d_name`, `quantity`, `price`, `status`, `date`, `success-date`, `r_id`) VALUES
(39, 36, 23, 'Nasi Goreng Telur', 2, 16, 'closed', '2021-12-17 16:13:23', '2021-12-17 15:14:49', 8);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `dishesh`
--
ALTER TABLE `dishesh`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indeks untuk tabel `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indeks untuk tabel `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indeks untuk tabel `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `d_id` (`d_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dishesh`
--
ALTER TABLE `dishesh`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dishesh`
--
ALTER TABLE `dishesh`
  ADD CONSTRAINT `dishesh_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `restaurants` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `res_category` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_orders`
--
ALTER TABLE `user_orders`
  ADD CONSTRAINT `user_orders_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_orders_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `dishesh` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
