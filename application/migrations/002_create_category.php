<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_category extends CI_Migration {

	public function up() {
		$this->down();
		## Create Table migrations
		$sql = <<<EOT
CREATE TABLE `category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`catogory_name` VARCHAR(100) NOT NULL COMMENT '分类名',
	`create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
	`is_delete` INT(1) NOT NULL DEFAULT '0',
	`order` INT(11) NOT NULL COMMENT '排列顺序，预留用',
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
		$this->dbforge->drop_table("category", TRUE);

	}
}