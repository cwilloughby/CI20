<?php

class m140423_172553_create_doc_table extends CDbMigration
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
		$this->createTable('doc_table', array(
			'id' => "INT NOT NULL AUTO_INCREMENT",
			'upload_date' => "DATETIME NOT NULL",
			'name' => "VARCHAR(125) NOT NULL",
			'type' => "VARCHAR(45) NOT NULL",
			'path' => "VARCHAR(200) NOT NULL",
			'extension' => "VARCHAR(7) NOT NULL",
			'uploader' => "VARCHAR(45) NOT NULL",
			'release_num' => "VARCHAR(45) NUL",
			'release_date' => "DATETIME NULL",
			'agency' => "VARCHAR(45) NULL",
			'cda_num' => "VARCHAR(100) NULL",
			'problem' => "TEXT NULL",
			'description' => "TEXT NULL",
			'coding_start_date' => "DATETIME NULL",
			'test_start_date' => "DATETIME NULL",
			'production_date' => "DATETIME NULL",
			'documentation_subject' => "TEXT NULL",
			'instruction_feature' => "TEXT NULL",
			"PRIMARY KEY('id')"
		),
		'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		$this->dropTable('doc_table');
	}
}