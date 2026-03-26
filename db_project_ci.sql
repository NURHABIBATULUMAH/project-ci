CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text,
  `email_kontak` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `email_kontak`, `gambar`, `created_at`) VALUES
(6, 'buku', 'buku python', 'adminlab@gmail.com', '1bd397437d99fc77fcf29c4fc61063a8.jpg', '2026-03-10 14:20:39'),
(7, 'keyboard', 'berwarna pink', 'adminlab@gmail.com', '84126bb2dcce0aa82a611cf0a5587446.jpg', '2026-03-23 15:00:08'),
(8, 'switch', 'tp-link 8 port', 'adminlab@gmail.com', 'f75831d05e146bd6772e12f787af6f44.jpg', '2026-03-23 15:03:15'),
(9, 'router', 'tp-link', 'adminlab@gmail.com', '0962fcc2a5c9fc87eaeeda62d8e2a33b.jpg', '2026-03-23 15:06:26'),
(10, 'cpu', 'corei9 \r\nX-Series', 'adminlab@gmail.com', 'ca369dc060d3dfedfb4faab4be42b27b.jpg', '2026-03-23 15:08:03');


CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `username`, `password`) VALUES
(2, 'habiba', '$2y$10$tK8iwAYxOmr.Iroe7WZFd.YpbOg4lR6fbn19yJA7cqMBCmeprdaPO'),
(0, 'f', '$2y$10$Huo9R6PqLovGwZPyKsyjc.vPh5qEzyoEtiDrhIloy5H/3K4.hxAvS');
COMMIT;

ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
