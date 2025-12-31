-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Des 2025 pada 04.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kegiatan_id` int(11) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `kegiatan_id`, `waktu`) VALUES
(1, 6, 1, '2025-12-28 07:28:25'),
(3, 7, 1, '2025-12-28 07:29:25'),
(4, 8, 1, '2025-12-28 07:30:02'),
(5, 9, 1, '2025-12-28 07:57:29'),
(6, 6, 3, '2025-12-28 07:59:26'),
(7, 7, 3, '2025-12-28 07:59:39'),
(8, 10, 1, '2025-12-29 08:47:52'),
(9, 10, 3, '2025-12-29 08:47:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `tanggal`) VALUES
(1, 'sepak bola', '2025-12-28'),
(3, 'berenang', '2025-12-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'pandu', 'pandubaturaja15@gmail.com', '$2y$10$HReHN3MPiOnf95g.nB5lkORq2ZG.m7D3mRRUzYQcvLe.BawKre43y', 'admin'),
(2, 'Pandu Wiranata', 'pandubaturaja15@gmail.com', '$2y$10$/bPJkWnxDPvKM24E4FMN3.kl6nWV3eK21BrTuFKrtOV73hEgK4qcC', 'admin'),
(3, 'Pandu', 'pandubaturaja15@gmail.com', '1234', 'admin'),
(4, 'Pandu', 'pandubaturaja15@gmail.com', '$2y$10$eiAbmQUXrXC7a/T39S4nDucjLXK5Da.R.d5X11KRcWBDYEgY6nX6C', 'admin'),
(5, 'Pandu', 'pandubaturaja15@gmail.com', '$2y$10$SrfMnSvBEb8R96IT4E.xf.5E8j.g.f0Vcke.2X59i9.ExwJIFJwTS', 'admin'),
(6, 'Pandu Wiranata', 'aaaaaa@gmail.com', '$2y$10$A8Y2vDY2K3mzBolci7cH5u9OtsGdu4wHxWiam9Xc1NBC58TqwhFjW', 'user'),
(7, 'Pandu Wira', 'keren@gmail.com', '$2y$10$yZhLihkPq.0XdaWuYCz8oeYjb0Zzk6b9hifpRNV7.B.Q6EfnBGJvC', 'user'),
(8, 'pandu wijaya', 'anjay@gmail.com', '$2y$10$LFyT4FtGMOpa9WuMtzC2y.EfTcTaDyoCDK1A6/GC94ooCUs3QfWyG', 'user'),
(9, 'Akbar Wijaya', 'windiprinastinabila@gmail.com', '$2y$10$4GtPxBgYAKOvFyd1DxH8C.hhSTfA1eIubtiH2JeFZgE8ityKrDPrS', 'user'),
(10, 'Rifky Jonata', 'akbarwijaya318gmail.com', '$2y$10$4aoPqp2KpSRyDMFBxW0Mgez7ouiQk1XoAH7tHCfZqztkBSsChCjLe', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unik_absen` (`user_id`,`kegiatan_id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
