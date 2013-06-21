<?php

class m130621_192034_create_user_prefs extends CDbMigration
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
		$this->createTable('ci_user_prefs', array(
				'userid' => 'INT(4) NOT NULL',
				'color' => 'VARCHAR(45) NULL',
				'PRIMARY KEY (`userid`)',
				'INDEX `fk_ci_user_prefs_ci_user_info1_idx` (`userid` ASC)',
				'CONSTRAINT `fk_ci_user_prefs_ci_user_info1`
					FOREIGN KEY (`userid`)
					REFERENCES `ci2`.`ci_user_info` (`userid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the tables.
		$this->dropTable('ci_user_prefs');
	}
}