<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_note extends CI_Migration {

	public function up() {
		$this->down();
		## Create Table migrations
		$sql = <<<EOT
CREATE TABLE `note` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`content` TEXT NOT NULL,
	`create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`is_delete` INT NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `user_id` (`user_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

EOT;
		$this->db->query($sql);
	}

	public function down()	{
		### Drop table migrations ##
		$this->dbforge->drop_table("note", TRUE);

	}
}