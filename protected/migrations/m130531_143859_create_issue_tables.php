<?php

class m130531_143859_create_issue_tables extends CDbMigration
{
	public function __construct()
	{
		// Turn the checks on foreign key constraints off before a migration.
		// This prevents incorrect constraint errors when creating or removing the tables.
		Yii::app()->db->createCommand('SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;')->execute();
		Yii::app()->db->createCommand('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;')->execute();
		Yii::app()->db->createCommand('SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE="TRADITIONAL";')->execute();
	}
	
	public function __destruct()
	{
		// Turn the checks on foreign key constraints back on after a migration.
		Yii::app()->db->createCommand('SET SQL_MODE=@OLD_SQL_MODE;')->execute();
		Yii::app()->db->createCommand('SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;')->execute();
		Yii::app()->db->createCommand('SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;')->execute();
	}
	
	public function up()
	{
		$this->createTable('ci_issue_tracker', array(
			'key' => 'VARCHAR(10) NOT NULL',
			'type' => 'VARCHAR(45) NOT NULL',
			'created' => 'DATETIME NOT NULL',
			'reporter' => 'VARCHAR(45) NULL',
			'summary' => 'TEXT NULL',
			'description' => 'TEXT NULL',
			'assigned' => 'VARCHAR(45) NULL',
			'updated' => 'DATETIME NULL',
			'originalestimate' => 'INT(20) NULL',
			'remainingestimate' => 'INT(20) NULL',
			'timespent' => 'INT(20) NULL',
			'resolution' => 'VARCHAR(45) NOT NULL',
			'PRIMARY KEY (`key`)',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the tables.
		$this->dropTable('ci_issue_tracker');
	}
}