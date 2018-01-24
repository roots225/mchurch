CREATE TABLE IF NOT EXISTS `ref_skills` (
	`skill_code` varchar(50) NOT NULL,
	`skill_name` varchar(255) NOT NULL,
	`skill_description` text NULL,
	PRIMARY KEY(`skill_code`)
);

CREATE TABLE IF NOT EXISTS `staff_skills` (
	`staff_id` int(11) unsigned NOT NULL,
	`skill_code` varchar(50) NOT NULL,
	`date_skill_acquired` date NULL,
	`skill_level` varchar(100) NOT NULL
	PRIMARY KEY (`staff_id`),
	PRIMARY KEY (`skill_code`),
	FOREIGN KEY (`skill_code`) REFERENCES `ref_skills` (`skill_code`),
	FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id_staff`)
);

CREATE TABLE IF NOT EXISTS `staff` (
	`id_staff` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`staff_first_name` varchar(255) NOT NULL,
	`staff_last_name` varchar(255) NOT NULL,
	`date_joined_staff` timestamp NOT NULL,
	`date_left_staff` timestamp,
	`others_staff_details` text NULL,
	PRIMARY KEY (`id_staff`)
);

CREATE TABLE IF NOT EXISTS `ministry_staff` (
	`ministry_id` int(11) unsigned NOT NULL,
	`staff_id` int(11) unsigned NOT NULL,
	`date_joined_ministry` timestamp,
	`date_left_ministry` timestamp,
	PRIMARY KEY (`ministry_id`),
	FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`ministry_id`)
);

CREATE TABLE IF NOT EXISTS `ministries` (
	`ministry_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`ministry_code` varchar(50) NOT NULL,
	`ministry_name` varchar(255) NOT NULL,
	`other_ministry_details` text NULL,
	PRIMARY KEY(`ministry_id`)
);

CREATE TABLE IF NOT EXISTS `ref_payment_methods` (
	`payment_method_code` varchar(50) NOT NULL,
	`payment_method_description` text NULL,
	`payment_method_comments` text NULL,
	PRIMARY KEY (`payment_method_code`)
);

CREATE TABLE IF NOT EXISTS `activities` (
	`activity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`activity_code` varchar(50) NOT NULL,
	`activity_description` text NULL,
	`activity_start_date` timestamp NULL,
	`activity_end_date` timestamp NULL,
	`others_activity_details` text NULL,
	PRIMARY KEY (`activity_id`)
);

CREATE TABLE IF NOT EXISTS `ministry_activities` (
	`ministry_id` int(11) unsigned NOT NULL,
	`activity_id` int(11) unsigned NOT NULL,
	`ministry_activity_start_date` timestamp NULL,
	`ministry_activity_end_date` timestamp NULL,
	PRIMARY KEY (`ministry_id`, `activity_id`),
	FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`ministry_id`),
	FOREIGN KEY (`activity_id`) REFERENCES `activities` (`activity_id`)
);

CREATE TABLE IF NOT EXISTS `members` (
	`member_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`member_first_name` varchar(255) NOT NULL,
	`member_middle_initial` varchar(255) NULL,
	`member_last_name` varchar(255) NOT NULL,
	`member_phones` varchar(255) NULL,
	`member_email_adress` varchar(255) NULL,
	`other_member_details` text NULL,
	PRIMARY KEY (`member_id`)
);

CREATE TABLE IF NOT EXISTS `member_contributions` (
	`member_contributions_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`member_id` int(11) unsigned NOT NULL,
	`ministry_id` int(11) unsigned NOT NULL,
	`payment_method` varchar(50) NOT NULL,
	`contribution_amount` float NOT NULL,
	`contribution_date` timestamp NOT NULL,
	`contribution_comments` text NULL,
	PRIMARY KEY (`member_contributions_id`),
	FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
	FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`ministry_id`)
);

CREATE TABLE IF NOT EXISTS `ref_activity_types` (
	`activity_type_code` varchar(50) NOT NULL,
	`activity_type_description` text NULL,
	PRIMARY KEY (`activity_type_code`)
);

CREATE TABLE IF NOT EXISTS `member_activities` (
	`member_id` int(11) unsigned NOT NULL,
	`ministry_activity_id` int(11) unsigned NOT NULL,
	`member_activity_start_date` timestamp NULL,
	`member_activity_end_date` timestamp NULL,
	PRIMARY KEY (`member_id`, `ministry_activity_id`),
	FOREIGN KEY(`member_id`) REFERENCES `members` (`member_id`),
	FOREIGN KEY(`ministry_activity_id`) REFERENCES `ministry_activities` (`ministry_id`)
);