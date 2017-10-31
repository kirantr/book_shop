CREATE TABLE `kz_users` (
	`id`  int unsigned NOT NULL AUTO_INCREMENT,
	`Name F` varchar(64) NOT NULL,
	`Email` varchar(64) NOT NULL,
	`Role` int unsigned NOT NULL,
	`Pass` varchar(64) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `kz_roles` (
	`id`  int unsigned NOT NULL AUTO_INCREMENT,
	`Role` varchar(64) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `kz_rooms` (
	`id`  int unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(64) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `kz_events` (
	`id`  int unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int unsigned NOT NULL,
	`room_id` int unsigned NOT NULL,
	`Description` TEXT(512) NOT NULL,
	`Time start` TIME NOT NULL,
	`Time end` TIME NOT NULL,
	`Repeat Flag` TEXT(32) NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `kz_events` ADD FOREIGN KEY (`user_id`) REFERENCES `kz_users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `kz_events` ADD FOREIGN KEY (`room_id`) REFERENCES `kz_rooms`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `kz_users` ADD FOREIGN KEY (`Role`) REFERENCES `kz_roles`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `kz_roles` ADD FOREIGN KEY (`id`) REFERENCES `kz_users`(`Role`) ON DELETE CASCADE ON UPDATE CASCADE;