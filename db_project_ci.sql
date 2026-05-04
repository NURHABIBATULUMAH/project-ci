-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2026 pada 06.52
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
-- Database: `db_project_ci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `tanggal_pinjam` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `alasan_penolakan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user_id`, `produk_id`, `jumlah_pinjam`, `tanggal_pinjam`, `status`, `alasan_penolakan`) VALUES
(1, 1, 6, 1, '2026-05-04 04:38:29', 'selesai', NULL),
(2, 1, 11, 1, '2026-05-04 04:42:37', 'menunggu_kembali', NULL),
(3, 3, 10, 1, '2026-05-04 04:44:28', 'pending', NULL),
(4, 4, 9, 1, '2026-05-04 04:45:06', 'disetujui', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `email_kontak` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `user_id`, `nama_produk`, `deskripsi`, `stok`, `email_kontak`, `gambar`, `created_at`) VALUES
(8, NULL, 'switch', 'tp-link 8 port', 1, 'adminlab@gmail.com', 'f75831d05e146bd6772e12f787af6f44.jpg', '2026-03-23 08:03:15'),
(9, NULL, 'router', 'tp-link', 2, 'adminlab@gmail.com', '0962fcc2a5c9fc87eaeeda62d8e2a33b.jpg', '2026-03-23 08:06:26'),
(10, NULL, 'cpu', 'corei9 X-Series', 5, 'adminlab@gmail.com', 'ca369dc060d3dfedfb4faab4be42b27b.jpg', '2026-03-23 08:08:03'),
(11, 2, 'proyektor', 'proyektor BENQ', 2, 'admin1@gmail.com', 'proyektor.jpg', '2026-05-04 04:41:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'amin', '$2y$10$JIzQ.bECNuVe2/3/bAx8U.VCgsfWavEz5QyRGPskTRYhLfrsLNZ4y', 'user'),
(2, 'admin', '$2y$10$URq58yEAL.03EBDpuvSo7eCHQUP/Kf/PhzQItyA9rKyEJvis9.j0a', 'admin'),
(3, 'firda', '$2y$10$wrJhjkry61haoD.AKUC4HeXN8zhH4Vuaq47AT8CG9erdzj6EkPZs.', 'user'), 
(4, 'habiba', '$2y$10$gTCFbRdcgBPCyKfD8.Fnju/GR5DF9fvUIidxIK8/ikbr5y01mJkq.', 'user');

-- Password
-- - amin: amin123
-- -firda: firda123
-- -habiba: habiba123
-- - admin: admin123

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
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
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
