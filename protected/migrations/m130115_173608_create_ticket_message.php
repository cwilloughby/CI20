<?php

class m130115_173608_create_ticket_message extends CDbMigration
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
		$this->createTable('ci_ticket_messages', array(
				'ticketid' => 'INT(10) NOT NULL',
				'messageid' => 'INT(11) NOT NULL',
				'PRIMARY KEY (`ticketid`, `messageid`)',
				'INDEX `fk_ci_ticket_messages_ci_messages1_idx` (`messageid` ASC)',
				'CONSTRAINT `fk_ci_ticket_messages_ci_trouble_tickets1`
					FOREIGN KEY (`ticketid`)
					REFERENCES `ci2`.`ci_trouble_tickets` (`ticketid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_ticket_messages_ci_messages1`
					FOREIGN KEY (`messageid`)
					REFERENCES `ci2`.`ci_messages` (`messageid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the table.
		$this->dropTable('ci_ticket_messages');
	}
}