<?php

class m121128_212033_create_tables_v1 extends CDbMigration
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
		$this->createTable('ci_tips', array(	
				'tipid' => 'INT(3) NOT NULL',
				'tip' => 'VARCHAR(100) NULL',
				'PRIMARY KEY (`tipid`)'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_document_type', array(
				'typeid' => 'INT(3) NOT NULL',
				'typename' => 'VARCHAR(45) NULL',
				'PRIMARY KEY (`typeID`)'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_messages', array(
				'messageid' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'to' => 'VARCHAR(500) NOT NULL',
				'from' => 'VARCHAR(500) NOT NULL',
				'subject' => 'VARCHAR(125) NOT NULL',
				'messagebody' => 'TEXT NULL',
				'messagetype' => 'VARCHAR(45) NOT NULL',
				'datesent' => 'DATETIME NOT NULL',
				'PRIMARY KEY (`messageid`)'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_ticket_categories', array(
				'categoryid' => 'INT(3) NOT NULL AUTO_INCREMENT',
				'categoryname' => 'VARCHAR(75) NOT NULL',
				'PRIMARY KEY (`categoryid`)',
				'UNIQUE INDEX `categoryname_UNIQUE` (`categoryname` ASC)'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_ticket_subjects', array(
				'subjectid' => 'INT(3) NOT NULL AUTO_INCREMENT',
				'subjectname' => 'VARCHAR(75) NOT NULL',
				'PRIMARY KEY (`subjectid`)',
				'UNIQUE INDEX `subjectName_UNIQUE` (`subjectname` ASC)'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_monitor_inventory', array(
				'servicetag' => 'VARCHAR(45) NOT NULL',
				'size' => 'VARCHAR(45) NULL',
				'PRIMARY KEY (`servicetag`)' 
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_evaluation_questions', array(
				'questionid' => 'INT(4) NOT NULL',
				'question' => 'VARCHAR(500) NOT NULL',
				'PRIMARY KEY (`questionid`)'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_user_info', array(
				'userid' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'firstname' => 'VARCHAR(30) NOT NULL',
				'lastname' => 'VARCHAR(40) NOT NULL',
				'middlename' => 'VARCHAR(45) NULL',
				'username' => 'VARCHAR(41) NOT NULL',
				'password' => 'VARCHAR(128) NOT NULL',
				'email' => 'VARCHAR(100) NOT NULL',
				'phoneext' => 'INT(5) NOT NULL',
				'departmentid' => 'INT(2) NOT NULL',
				'hiredate' => 'DATE NOT NULL',
				'active' => 'TINYINT(1) NULL',
				'PRIMARY KEY (`userid`)',
				'INDEX `email` (`email` ASC, `phoneext` ASC)',
				'INDEX `username` (`username` ASC)',
				'INDEX `fk_ci_user_info_ci_departments1_idx` (`departmentid` ASC)',
				'CONSTRAINT `fk_ci_user_info_ci_departments1`
					FOREIGN KEY (`departmentid` )
					REFERENCES `ci2`.`ci_departments` (`departmentid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_departments', array(
				'departmentid' => 'INT(2) NOT NULL AUTO_INCREMENT',
				'departmentname' => 'VARCHAR(35) NOT NULL',
				'supervisorid' => 'INT(11)',
				'PRIMARY KEY (`departmentid`)',
				'INDEX `fk_ci_departments_ci_user_info1_idx` (`supervisorid` ASC)',
				'CONSTRAINT `fk_ci_departments_ci_user_info1`
					FOREIGN KEY (`supervisorid` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_department_tiers', array(
				'maindepartmentid' => 'INT(2) NOT NULL',
				'subdepartmentid' => 'INT(2) NOT NULL',
				'PRIMARY KEY (`maindepartmentid`, `subdepartmentid`)',
				'INDEX `fk_ci_department_tiers_ci_departments1_idx` (`maindepartmentid` ASC)',
				'INDEX `fk_ci_department_tiers_ci_departments2_idx` (`subdepartmentid` ASC)',
				'CONSTRAINT `fk_ci_department_tiers_ci_departments1`
					FOREIGN KEY (`maindepartmentid` )
					REFERENCES `ci2`.`ci_departments` (`departmentid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_department_tiers_ci_departments2`
					FOREIGN KEY (`subdepartmentid` )
					REFERENCES `ci2`.`ci_departments` (`departmentid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_trouble_tickets', array(
				'ticketid' => 'INT(10) NOT NULL AUTO_INCREMENT',
				'openedby' => 'INT(11) NOT NULL',
				'opendate' => 'DATETIME NOT NULL',
				'categoryid' => 'INT(3) NOT NULL',
				'subjectid' => 'INT(3) NOT NULL',
				'description'=> 'TEXT NULL',
				'closedbyuserid' => 'INT(11) NULL',
				'closedate' => 'DATETIME NULL',
				'resolution'=> 'TEXT NULL',
				'PRIMARY KEY (`ticketid`, `categoryid`, `subjectid`)',
				'INDEX `fk_ci_trouble_tickets_ci_user_info1_idx` (`openedBy` ASC)' ,
				'INDEX `fk_ci_trouble_tickets_ci_ticket_categories1_idx` (`categoryid` ASC)' ,
				'INDEX `fk_ci_trouble_tickets_ci_user_info2_idx` (`closedbyuserid` ASC)' ,
				'INDEX `fk_ci_trouble_tickets_ci_ticket_subjects1_idx` (`subjectid` ASC)' ,
				'CONSTRAINT `fk_ci_trouble_tickets_ci_user_info1`
					FOREIGN KEY (`openedby` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_trouble_tickets_ci_ticket_categories1`
					FOREIGN KEY (`categoryid` )
					REFERENCES `ci2`.`ci_ticket_categories` (`categoryid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_trouble_tickets_ci_user_info2`
					FOREIGN KEY (`closedbyuserid` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_trouble_tickets_ci_ticket_subjects1`
					FOREIGN KEY (`subjectid` )
					REFERENCES `ci2`.`ci_ticket_subjects` (`subjectid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_category_subject_bridge', array(
				'categoryid' => 'INT(3) NOT NULL',
				'subjectid' => 'INT(3) NOT NULL',
				'PRIMARY KEY (`categoryid`, `subjectid`)',
				'INDEX `fk_ci_category_subject_bridge_ci_ticket_categories1_idx` (`categoryid` ASC)',
				'INDEX `fk_ci_category_subject_bridge_ci_ticket_subjects1_idx` (`subjectid` ASC)',
				'CONSTRAINT `fk_ci_category_subject_bridge_ci_ticket_categories1`
					FOREIGN KEY (`categoryid` )
					REFERENCES `ci2`.`ci_ticket_categories` (`categoryid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_category_subject_bridge_ci_ticket_subjects1`
					FOREIGN KEY (`subjectid` )
					REFERENCES `ci2`.`ci_ticket_subjects` (`subjectid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_subject_tips', array(
				'subjectid' => 'INT(3) NOT NULL',
				'tipid' => 'INT(3) NOT NULL',
				'PRIMARY KEY (`subjectid`, `tipid`)',
				'INDEX `fk_ci_subject_tips_ci_ticket_subjects1_idx` (`subjectid` ASC)',
				'INDEX `fk_ci_subject_tips_ci_tips1_idx` (`tipid` ASC)',
				'CONSTRAINT `fk_ci_subject_tips_ci_ticket_subjects1`
					FOREIGN KEY (`subjectid` )
					REFERENCES `ci2`.`ci_ticket_subjects` (`subjectid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_subject_tips_ci_tips1`
					FOREIGN KEY (`tipid` )
					REFERENCES `ci2`.`ci_tips` (`tipid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_computer_inventory', array(
				'computerid' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'computername' => 'VARCHAR(45) NOT NULL',
				'userid' => 'INT(11) NULL',
				'model' => 'VARCHAR(45) NOT NULL',
				'inceptiondate' => 'DATE NULL',
				'warrantyenddate' => 'DATE NULL',
				'PRIMARY KEY (`computerid`)',
				'UNIQUE INDEX `ComputerName_UNIQUE` (`computername` ASC)',
				'INDEX `fk_ci_computer_inventory_ci_user_info1_idx` (`userid` ASC)',
				'CONSTRAINT `fk_ci_computer_inventory_ci_user_info1`
					FOREIGN KEY (`userid` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_evaluations', array(
				'evaluationid' => 'INT(11) NOT NULL',
				'employee' => 'INT(11) NOT NULL',
				'evaluator' => 'INT(11) NOT NULL',
				'evaluationdate' => 'DATE NULL',
				'PRIMARY KEY (`evaluationid`)',
				'INDEX `fk_ci_evaluations_ci_user_info1_idx` (`employee` ASC)',
				'INDEX `fk_ci_evaluations_ci_user_info2_idx` (`evaluator` ASC)',
				'CONSTRAINT `fk_ci_evaluations_ci_user_info1`
					FOREIGN KEY (`employee` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_evaluations_ci_user_info2`
					FOREIGN KEY (`evaluator` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_evaluation_answers', array(
				'evaluationid' => 'INT(11) NOT NULL',
				'questionid' => 'INT(4) NOT NULL',
				'score' => 'INT(2) NULL',
				'comments' => 'VARCHAR(500) NULL',
				'PRIMARY KEY (`evaluationid`, `questionid`)',
				'INDEX `fk_ci_evaluation_answers_ci_evaluation_questions1_idx` (`questionid` ASC)',
				'CONSTRAINT `fk_ci_evaluation_answers_ci_evaluations1`
					FOREIGN KEY (`evaluationid` )
					REFERENCES `ci2`.`ci_evaluations` (`evaluationid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_evaluation_answers_ci_evaluation_questions1`
					FOREIGN KEY (`questionid` )
					REFERENCES `ci2`.`ci_evaluation_questions` (`questionid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_documents', array(
				'documentid' => 'INT NOT NULL',
				'uploader' => 'INT(11) NOT NULL',
				'documentname' => 'VARCHAR(45) NOT NULL',
				'path' => 'VARCHAR(100) NOT NULL',
				'uploaddate' => 'DATETIME NOT NULL',
				'PRIMARY KEY (`documentid`)',
				'INDEX `fk_ci_documents_ci_user_info1_idx` (`uploader` ASC)',
				'CONSTRAINT `fk_ci_documents_ci_user_info1`
					FOREIGN KEY (`uploader` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_message_documents', array(
				'messageid' => 'INT(11) NOT NULL',
				'documentid' => 'INT NOT NULL',
				'INDEX `fk_ci_message_documents_ci_messages1_idx` (`messageid` ASC)',
				'INDEX `fk_ci_message_documents_ci_documents1_idx` (`documentid` ASC)',
				'PRIMARY KEY (`messageid`, `documentid`)',
				'CONSTRAINT `fk_ci_message_documents_ci_messages1`
					FOREIGN KEY (`messageid` )
					REFERENCES `ci2`.`ci_messages` (`messageid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_message_documents_ci_documents1`
					FOREIGN KEY (`documentid` )
					REFERENCES `ci2`.`ci_documents` (`documentid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_document_processor', array(
				'warrantnumber' => 'VARCHAR(45) NOT NULL' ,
				'documentid' => 'INT NOT NULL' ,
				'documenttypeid' => 'INT(3) NOT NULL',
				'completedby' => 'INT(11) NULL',
				'completiondate' => 'DATETIME NULL',
				'PRIMARY KEY (`warrantnumber`, `documentid`)',
				'INDEX `fk_ci_document_processor_ci_user_info1_idx` (`completedby` ASC)',
				'INDEX `fk_ci_document_processor_ci_documents1_idx` (`documentid` ASC)',
				'INDEX `fk_ci_document_processor_ci_document_type1_idx` (`documenttypeid` ASC)',
				'CONSTRAINT `fk_ci_document_processor_ci_user_info1`
					FOREIGN KEY (`completedby` )
					REFERENCES `ci2`.`ci_user_info` (`userid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_document_processor_ci_documents1`
					FOREIGN KEY (`documentid` )
					REFERENCES `ci2`.`ci_documents` (`documentid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_document_processor_ci_document_type1`
					FOREIGN KEY (`documenttypeid` )
					REFERENCES `ci2`.`ci_document_type` (`typeid` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{	
		// Drop the tables.
		$this->dropTable('ci_user_info');
		$this->dropTable('ci_departments');
		$this->dropTable('ci_department_tiers');
		$this->dropTable('ci_messages');
		$this->dropTable('ci_ticket_categories');
		$this->dropTable('ci_ticket_subjects');
		$this->dropTable('ci_trouble_tickets');
		$this->dropTable('ci_category_subject_bridge');
		$this->dropTable('ci_tips');
		$this->dropTable('ci_subject_tips');
		$this->dropTable('ci_computer_inventory');
		$this->dropTable('ci_monitor_inventory');
		$this->dropTable('ci_evaluations');
		$this->dropTable('ci_evaluation_questions');
		$this->dropTable('ci_evaluation_answers');
		$this->dropTable('ci_documents');
		$this->dropTable('ci_message_documents');
		$this->dropTable('ci_document_type');
		$this->dropTable('ci_document_processor');
	}
}
