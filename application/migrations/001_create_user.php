<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_user extends CI_Migration {

	public function up() {
		$this->down();
		## Create Table migrations
		$sql = <<<EOT
CREATE TABLE `user` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NOT NULL,
	`password` VARCHAR(50) NOT NULL,
	`salt` VARCHAR(4) NOT NULL COMMENT '盐值',
	`create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`last_login` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
EOT;
		$this->db->query($sql);
	}

	public function down()	{
		### Drop table migrations ##
		$this->dbforge->drop_table("user", TRUE);

	}
}