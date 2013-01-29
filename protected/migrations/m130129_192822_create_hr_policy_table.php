<?php

class m130129_192822_create_hr_policy_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('ci_hr_policy', array(	
				'sectionid' => 'INT(6) NOT NULL AUTO_INCREMENT',
				'section' => 'TEXT NOT NULL',
				'PRIMARY KEY (`sectionid`)',
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the table.
		$this->dropTable('ci_hr_policy');
	}
}