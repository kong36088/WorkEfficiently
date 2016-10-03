<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_is_delete extends CI_Migration {

	public function up() {
		$this->down();
		## Create Table migrations
		$sql = <<<EOT
ALTER TABLE `task`
	CHANGE COLUMN `is_delete` `is_delete` INT(1) NOT NULL DEFAULT '0' AFTER `deadline`;
EOT;
		$this->db->query($sql);
	}

	public function down()	{
		### Drop table migrations ##
	}
}