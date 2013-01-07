<?php

class m130107_204741_create_trouble_ticket_expansion extends CDbMigration
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
		$this->createTable('ci_ticket_comments', array(
				'commentid' => 'INT(11) NOT NULL',
				'ticketid' => 'INT(10) NOT NULL',
				'PRIMARY KEY (`commentid`, `ticketid`)',
				'INDEX `fk_ci_ticket_comments_ci_trouble_tickets1_idx` (`ticketid` ASC)',
				'CONSTRAINT `fk_ci_ticket_comments_ci_trouble_tickets1`
					FOREIGN KEY (`ticketid` )
					REFERENCES `ci2`.`ci_trouble_tickets` (`ticketid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	
		$this->createTable('ci_comments', array(
				'commentid' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'content' => 'TEXT NOT NULL',
				'createdby' => 'INT(11) NOT NULL',
				'datecreated' => 'DATETIME NOT NULL',
				'PRIMARY KEY (`commentid`)',
				'INDEX `fk_ci_comments_ci_ticket_comments1_idx` (`commentid` ASC) ',
				'INDEX `fk_ci_comments_ci_user_info1_idx` (`createdby` ASC) ',
				'CONSTRAINT `fk_ci_comments_ci_ticket_comments1`
					FOREIGN KEY (`commentid` )
					REFERENCES `ci2`.`ci_ticket_comments` (`commentid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_comments_ci_user_info1`
					FOREIGN KEY (`createdby` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the tables.
		$this->dropTable('ci_ticket_comments');
		$this->dropTable('ci_comments');
	}
}