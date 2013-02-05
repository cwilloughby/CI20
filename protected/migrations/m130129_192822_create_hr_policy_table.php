<?php

class m130129_192822_create_hr_policy_table extends CDbMigration
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
		$this->createTable('ci_hr_sections', array(
				'policyid' => 'INT(6) NOT NULL',
				'sectionid' => 'INT(6) NOT NULL',
				'section' => 'TEXT NOT NULL',
				'datemade' => 'DATETIME NOT NULL',
				'PRIMARY KEY (`policyid`, `sectionid`)',
				'INDEX `fk_ci_hr_sections_ci_hr_policy1_idx` (`policyid` ASC)',
				'CONSTRAINT `fk_ci_hr_sections_ci_hr_policy1`
					FOREIGN KEY (`policyid`)
					REFERENCES `ci2`.`ci_hr_policy` (`policyid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_hr_policy', array(
				'policyid' => 'INT(6) NOT NULL AUTO_INCREMENT',
				'policy' => 'VARCHAR(50) NOT NULL',
				'PRIMARY KEY (`policyid`)',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the table.
		$this->dropTable('ci_hr_sections');
		$this->dropTable('ci_hr_policy');
	}
}