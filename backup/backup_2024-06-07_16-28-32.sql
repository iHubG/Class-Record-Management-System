CREATE TABLE `activity_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `log_data` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `activity_logs` VALUES (''5'',''Admin testadmin logged in.'',''2024-06-07 19:56:32'');
INSERT INTO `activity_logs` VALUES (''6'',''Admin testadmin updated profile.'',''2024-06-07 19:58:00'');
INSERT INTO `activity_logs` VALUES (''7'',''Admin testadmin registered instructor Ian Macalinao'',''2024-06-07 20:00:14'');
INSERT INTO `activity_logs` VALUES (''8'',''Admin testadmin updated instructor Ian Macalinao.'',''2024-06-07 20:00:21'');
INSERT INTO `activity_logs` VALUES (''9'',''Admin testadmin logged out.'',''2024-06-07 20:32:10'');
INSERT INTO `activity_logs` VALUES (''10'',''Instructor Ian Macalinao logged in.'',''2024-06-07 20:32:29'');
INSERT INTO `activity_logs` VALUES (''11'',''Instructor Ian Macalinao updated profile.'',''2024-06-07 20:32:51'');
INSERT INTO `activity_logs` VALUES (''12'',''Instructor Ian Macalinao logged out.'',''2024-06-07 20:34:30'');
INSERT INTO `activity_logs` VALUES (''13'',''Admin testadmin logged in.'',''2024-06-07 20:34:37'');
INSERT INTO `activity_logs` VALUES (''14'',''Admin testadmin logged out.'',''2024-06-07 20:39:52'');
INSERT INTO `activity_logs` VALUES (''15'',''Admin testadmin logged in.'',''2024-06-07 20:39:55'');
INSERT INTO `activity_logs` VALUES (''16'',''Admin testadmin logged out.'',''2024-06-07 21:43:32'');
INSERT INTO `activity_logs` VALUES (''17'',''Instructor Ian Macalinao logged in.'',''2024-06-07 21:43:38'');
INSERT INTO `activity_logs` VALUES (''18'',''Instructor Ian Macalinao logged out.'',''2024-06-07 22:04:00'');
INSERT INTO `activity_logs` VALUES (''19'',''Admin testadmin logged in.'',''2024-06-07 22:04:07'');
INSERT INTO `activity_logs` VALUES (''20'',''Admin testadmin logged out.'',''2024-06-07 22:06:34'');
INSERT INTO `activity_logs` VALUES (''21'',''Instructor Ian Macalinao logged in.'',''2024-06-07 22:06:40'');
INSERT INTO `activity_logs` VALUES (''22'',''Instructor Ian Macalinao logged out.'',''2024-06-08 00:21:23'');
INSERT INTO `activity_logs` VALUES (''23'',''Admin testadmin logged in.'',''2024-06-08 00:21:29'');
INSERT INTO `activity_logs` VALUES (''24'',''Admin testadmin registered instructor Tyron Lumandaz.'',''2024-06-08 00:24:29'');
INSERT INTO `activity_logs` VALUES (''25'',''Admin testadmin logged out.'',''2024-06-08 00:25:03'');
INSERT INTO `activity_logs` VALUES (''26'',''Instructor Tyron Lumandaz logged in.'',''2024-06-08 00:25:15'');
INSERT INTO `activity_logs` VALUES (''27'',''Instructor Tyron Lumandaz updated profile.'',''2024-06-08 00:25:26'');
INSERT INTO `activity_logs` VALUES (''28'',''Instructor Tyron Lumandaz logged out.'',''2024-06-08 00:28:06'');
INSERT INTO `activity_logs` VALUES (''29'',''Admin testadmin logged in.'',''2024-06-08 00:28:11'');
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `profile_picture_filename` varchar(50) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `admin` VALUES (''3'',''testadmin'',''adminpassword'',''6662f5c84c899_ian.png'',''2024-06-07 19:51:34'');
CREATE TABLE `instructor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_picture_filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `instructor` VALUES (''16'',''Ian Macalinao'',''ipmacalinao'',''$2y$10$UoKpAxhnAE5Y50guWHYv5eNr4XuydDtpcaMb8/jhhGHGhcCQR2yg6'',''6662fdf3f1038_mysql.png'',''CCSICT'',''2024-06-07 20:00:14'');
INSERT INTO `instructor` VALUES (''17'',''Tyron Lumandaz'',''tlumandaz'',''$2y$10$AoGpi2TEA2qEWBY/swGIO.w4zw6PxNZZHHbD/XFcVh4bS62VJ5ZYa'','''',''CCSICT'',''2024-06-08 00:24:29'');
CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `instructor_id` int DEFAULT NULL,
  `subject_name` varchar(50) DEFAULT NULL,
  `subject_code` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `instructor_id` (`instructor_id`),
  CONSTRAINT `instructor_id` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `subjects` VALUES (''1'',''16'',''Cloud Computing'',''IT APPDEV 5'',''BSIT 3A WMAD'',''2024-06-08 00:05:10'');
INSERT INTO `subjects` VALUES (''3'',''16'',''Game Development'',''IT APPDEV 4'',''BSIT 3A WMAD'',''2024-06-08 00:19:22'');
INSERT INTO `subjects` VALUES (''4'',''17'',''Capstone Project 1'',''IT 323'',''BSIT 3A WMAD'',''2024-06-08 00:27:06'');
