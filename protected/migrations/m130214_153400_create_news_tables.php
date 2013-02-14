<?php

class m130214_153400_create_news_tables extends CDbMigration
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
		$this->createTable('ci_news_type', array(
				'typeid' => 'INT(2) NOT NULL AUTO_INCREMENT',
				'type' => 'VARCHAR(45) NOT NULL',
				'PRIMARY KEY (`typeid`)',
				'UNIQUE INDEX `type_UNIQUE` (`type` ASC)',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_news', array(
				'newsid' => ' INT NOT NULL AUTO_INCREMENT',
				'typeid' => 'INT(2) NOT NULL',
				'postedby' => 'INT(4) NOT NULL',
				'date' => 'DATETIME NOT NULL',
				'news' => 'TEXT NOT NULL',
				'PRIMARY KEY (`newsid`)',
				'INDEX `fk_ci_news_ci_news_type1_idx` (`typeid` ASC)',
				'INDEX `fk_ci_news_ci_user_info1_idx` (`postedby` ASC)',
				'CONSTRAINT `fk_ci_news_ci_news_type1`
					FOREIGN KEY (`typeid`)
					REFERENCES `ci2`.`ci_news_type` (`typeid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_news_ci_user_info1`
					FOREIGN KEY (`postedby`)
					REFERENCES `ci2`.`ci_user_info` (`userid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the table.
		$this->dropTable('ci_news_type');
		$this->dropTable('ci_news');
	}
}