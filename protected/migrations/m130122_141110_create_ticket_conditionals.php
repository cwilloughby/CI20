<?php

class m130122_141110_create_ticket_conditionals extends CDbMigration
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
		$this->createTable('ci_ticket_conditionals', array(
				'conditionalid' => 'INT(3) NOT NULL AUTO_INCREMENT',
				'label' => 'VARCHAR(45) NOT NULL',
				'PRIMARY KEY (`conditionalid`)',
				'UNIQUE INDEX `label_UNIQUE` (`label` ASC)',
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_subject_conditions', array(
				'subjectid' => 'INT(3) NOT NULL',
				'conditionalid' => 'INT(3) NOT NULL',
				'PRIMARY KEY (`subjectid`, `conditionalid`)',
				'INDEX `fk_ci_subject_conditions_ci_ticket_subjects1_idx` (`subjectid` ASC)',
				'INDEX `fk_ci_subject_conditions_ci_ticket_conditionals1_idx` (`conditionalid` ASC)',
				'CONSTRAINT `fk_ci_subject_conditions_ci_ticket_subjects1`
					FOREIGN KEY (`subjectid` )
					REFERENCES `ci2`.`ci_ticket_subjects` (`subjectid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_subject_conditions_ci_ticket_conditionals1`
					FOREIGN KEY (`conditionalid` )
					REFERENCES `ci2`.`ci_ticket_conditionals` (`conditionalid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the table.
		$this->dropTable('ci_subject_conditions');
		$this->dropTable('ci_ticket_conditionals');
	}
}