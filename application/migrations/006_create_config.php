<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_config extends CI_Migration {

	public function up() {
		$this->down();
		## Create Table migrations
		$sql = <<<EOT
CREATE TABLE `config` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`name` VARCHAR(100) NOT NULL COMMENT '配置名称',
	`value` VARCHAR(100) NOT NULL COMMENT '配置值',
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