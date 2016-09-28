<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_task extends CI_Migration {

	public function up() {
		$this->down();
		## Create Table migrations
		$sql = <<<EOT
CREATE TABLE `task` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`status` INT(1) NOT NULL DEFAULT '1' COMMENT '1进行中，2已完成，-1已过期',
	`title` VARCHAR(255) NOT NULL,
	`create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deadline` DATETIME NOT NULL COMMENT '最后限期，不填则无',
	`is_delete` DATETIME NOT NULL,
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
		$this->dbforge->drop_table("task", TRUE);

	}
}