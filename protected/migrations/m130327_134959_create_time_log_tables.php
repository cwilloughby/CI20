<?php

class m130327_134959_create_time_log_tables extends CDbMigration
{
	public function up()
	{
		$this->createTable('ci_time_log', array(
				'id' => 'INT(10) NOT NULL',
				'username' => 'VARCHAR(20) NULL',
				'computername' => 'VARCHAR(15) NULL',
				'eventtype' => 'VARCHAR(7) NULL',
				'eventtime' => 'TIME NULL',
				'eventdate' => 'DATE NULL',
				'PRIMARY KEY (`id`)',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_gs_time_log', array(
				'id' => 'INT(10) NOT NULL',
				'username' => 'VARCHAR(20) NULL',
				'computername' => 'VARCHAR(15) NULL',
				'eventtype' => 'VARCHAR(7) NULL',
				'eventtime' => 'TIME NULL',
				'eventdate' => 'DATE NULL',
				'PRIMARY KEY (`id`)',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the tables.
		$this->dropTable('ci_time_log');
		$this->dropTable('ci_gs_time_log');
	}
}