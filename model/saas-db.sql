
-- Database: `crms_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`password` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`profile_picture_filename` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`username` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`password` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`profile_picture_filename` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`department` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;


--
-- Table structure for table `student`
--

CREATE TABLE `student` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`student_id` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`first_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`last_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`username` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`password` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`profile_picture_filename` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`course` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`year_level` INT(10) NULL DEFAULT NULL,
	`date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

--
-- Table structure for table `subjects`
--
CREATE TABLE `subjects` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`instructor_id` INT(10) NULL DEFAULT NULL,
	`subject_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`subject_code` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`section` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `instructor_id` (`instructor_id`) USING BTREE,
	CONSTRAINT `instructor_id` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;


--
-- Table structure for table `class`
--
CREATE TABLE `class` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`subject_id` INT(10) NULL DEFAULT NULL,
	`student_id` INT(10) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `subject_id` (`subject_id`) USING BTREE,
	INDEX `student_id` (`student_id`) USING BTREE,
	CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;


--
-- Table structure for table `activity_logs`
--
CREATE TABLE `activity_logs` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`log_data` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;


