<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_task_options extends CI_Migration {

	public function up() {
		$this->down();
		## Create Table migrations
		$sql = <<<EOT
CREATE TABLE `task_options` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`task_id` INT(11) NOT NULL,
	`status` INT(1) NOT NULL DEFAULT '1' COMMENT '1进行中，2已完成，-1已过期',
	`title` VARCHAR(255) NOT NULL DEFAULT '1',
	`create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deadline` DATETIME NOT NULL,
	`is_delete` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `task_id` (`task_id`)
)
COMMENT='每个任务下的子任务'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
EOT;
		$this->db->query($sql);
	}

	public function down()	{
		### Drop table migrations ##
		$this->dbforge->drop_table("task_options", TRUE);

	}
}