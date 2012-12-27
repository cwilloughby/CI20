<?php

class m121227_143855_create_srbac_tables extends CDbMigration
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
		$this->createTable('ci_auth_items', array(
				'name' => 'VARCHAR(64) NOT NULL',
				'type' => 'INT(11) NOT NULL',
				'description' => 'TEXT NULL DEFAULT NULL',
				'bizrule' => 'TEXT NULL DEFAULT NULL',
				'data' => 'TEXT NULL DEFAULT NULL',
				'PRIMARY KEY (`name`)',
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	
		$this->createTable('ci_auth_assignments', array(
				'itemname' => 'VARCHAR(64) NOT NULL',
				'userid' => 'VARCHAR(64) NOT NULL',
				'bizrule' => 'TEXT NULL DEFAULT NULL',
				'data' => 'TEXT NULL DEFAULT NULL',
				'PRIMARY KEY (`itemname`, `userid`)',
				'CONSTRAINT `ci_auth_assignments_ibfk_1`
					FOREIGN KEY (`itemname` )
					REFERENCES `ci2`.`ci_auth_items` (`name` )
					ON DELETE CASCADE
					ON UPDATE CASCADE'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	
		$this->createTable('ci_auth_item_children', array(
				'parent' => 'VARCHAR(64) NOT NULL',
				'child' => 'VARCHAR(64) NOT NULL',
				'PRIMARY KEY (`parent`, `child`)',
				'INDEX `child` (`child` ASC)',
				'CONSTRAINT `ci_auth_item_children_ibfk_1`
					FOREIGN KEY (`parent` )
					REFERENCES `ci2`.`ci_auth_items` (`name` )
					ON DELETE CASCADE
					ON UPDATE CASCADE',
				'CONSTRAINT `ci_auth_item_children_ibfk_2`
					FOREIGN KEY (`child` )
					REFERENCES `ci2`.`ci_auth_items` (`name` )
					ON DELETE CASCADE
					ON UPDATE CASCADE',
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the tables.
		$this->dropTable('ci_auth_items');
		$this->dropTable('ci_auth_assignments');
		$this->dropTable('ci_auth_item_children');
	}
}