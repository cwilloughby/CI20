<?php

class m130528_173451_create_videos_table extends CDbMigration
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
		$this->createTable('ci_videos', array(
				'videoid' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'documentid' => 'INT(11) NOT NULL',
				'title' => 'VARCHAR(100) NULL',
				'type' => 'VARCHAR(45) NOT NULL',
				'PRIMARY KEY (`videoid`)',
				'INDEX `fk_ci_videos_ci_documents1_idx` (`documentid` ASC)',
				'CONSTRAINT `fk_ci_videos_ci_documents1`
					FOREIGN KEY (`documentid` )
					REFERENCES `ci2`.`ci_documents` (`documentid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the tables.
		$this->dropTable('ci_videos');
	}
}