<?php

class m130814_134031_create_document_table_changes extends CDbMigration
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
		$this->dropTable('ci_document_type');
		$this->dropTable('ci_document_processor');
		
		$this->createTable('ci_document_queues', array(
			'itemid' => 'INT(11) NOT NULL AUTO_INCREMENT',
			'queue' => 'VARCHAR(45) NOT NULL' ,
			'documentid' => 'INT(11) NOT NULL' ,
			'completedby' => 'INT(4) NULL',
			'completiondate' => 'DATETIME NULL',
			'PRIMARY KEY (`itemid`)',
			'INDEX `fk_ci_document_queues_ci_user_info1_idx` (`completedby` ASC)',
			'INDEX `fk_ci_document_queues_ci_documents1_idx` (`documentid` ASC)',
			'CONSTRAINT `fk_ci_document_queues_ci_user_info1`
				FOREIGN KEY (`completedby`)
				REFERENCES `ci2`.`ci_user_info` (`userid`)
				ON DELETE NO ACTION
				ON UPDATE NO ACTION',
			'CONSTRAINT `fk_ci_document_queues_ci_documents1`
				FOREIGN KEY (`documentid`)
				REFERENCES `ci2`.`ci_documents` (`documentid`)
				ON DELETE NO ACTION
				ON UPDATE NO ACTION',
		),
		'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		$this->dropTable('ci_document_queues');
	}
}