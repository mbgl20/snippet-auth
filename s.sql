CREATE TABLE `users` (
	`id` int(11) NOT NULL,
	`un` varchar(50) NOT NULL,
	`dn` varchar(100) NOT NULL,
	`pw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users`
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `un` (`un`);
