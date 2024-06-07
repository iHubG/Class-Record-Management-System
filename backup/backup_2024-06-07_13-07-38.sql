CREATE TABLE `activity_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `log_data` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `instructor` VALUES (''16'',''Ian Macalinao'',''ipmacalinao'',''$2y$10$UoKpAxhnAE5Y50guWHYv5eNr4XuydDtpcaMb8/jhhGHGhcCQR2yg6'',''6662fdf3f1038_mysql.png'',''CCSICT'',''2024-06-07 20:00:14'');
