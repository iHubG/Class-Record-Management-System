
-- Database: `crms_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`password` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`profile_picture_filename` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
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
	`school_id` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`first_name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`last_name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`username` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`password` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`profile_picture_filename` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`course` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
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
	`subject_name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`subject_code` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`section` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
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
	`attitude` INT(10) NULL DEFAULT NULL,
	`attendance` INT(10) NULL DEFAULT NULL,
	`recitation` INT(10) NULL DEFAULT NULL,
	`assignment` INT(10) NULL DEFAULT NULL,
	`quiz` INT(10) NULL DEFAULT NULL,
	`project` INT(10) NULL DEFAULT NULL,
	`prelim` INT(10) NULL DEFAULT NULL,
	`midterm` INT(10) NULL DEFAULT NULL,
	`final` INT(10) NULL DEFAULT NULL,
	`final_grade` DECIMAL(20,2) NULL DEFAULT NULL,
	`remarks` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`category` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`attitude_amount` INT(10) NULL DEFAULT NULL,
	`attendance_amount` INT(10) NULL DEFAULT NULL,
	`recitation_amount` INT(10) NULL DEFAULT NULL,
	`assignment_amount` INT(10) NULL DEFAULT NULL,
	`quiz_amount` INT(10) NULL DEFAULT NULL,
	`project_amount` INT(10) NULL DEFAULT NULL,
	`prelim_amount` INT(10) NULL DEFAULT NULL,
	`midterm_amount` INT(10) NULL DEFAULT NULL,
	`final_amount` INT(10) NULL DEFAULT NULL,
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


