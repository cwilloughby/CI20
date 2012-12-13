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
		$this->createTable('ci_roles', array(
				'RoleID' => 'INT(3) NOT NULL AUTO_INCREMENT',
				'RoleName' => 'VARCHAR(35) NOT NULL',
				'PRIMARY KEY (`RoleID`)',
				'UNIQUE INDEX `RoleName_UNIQUE` (`RoleName` ASC)'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_tips', array(	
				'TipID' => 'INT(3) NOT NULL',
				'Tip' => 'VARCHAR(100) NULL',
				'PRIMARY KEY (`TipID`)'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_document_type', array(
					'TypeID' => 'INT(3) NOT NULL',
					'TypeName' => 'VARCHAR(45) NULL',
					'PRIMARY KEY (`TypeID`)'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_messages', array(
				'MessageID' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'To' => 'VARCHAR(500) NOT NULL',
				'From' => 'VARCHAR(500) NOT NULL',
				'Subject' => 'VARCHAR(125) NOT NULL',
				'MessageBody' => 'VARCHAR(500) NULL',
				'MessageType' => 'VARCHAR(45) NOT NULL',
				'SuccessfullySent' => 'TINYINT(1) NOT NULL',
				'DateSent' => 'DATE NULL' ,
				'PRIMARY KEY (`MessageID`)'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_ticket_categories', array(
				'CategoryID' => 'INT(3) NOT NULL AUTO_INCREMENT',
				'CategoryName' => 'VARCHAR(75) NOT NULL',
				'PRIMARY KEY (`CategoryID`)',
				'UNIQUE INDEX `CategoryName_UNIQUE` (`CategoryName` ASC)'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_ticket_subjects', array(
				'SubjectID' => 'INT(3) NOT NULL AUTO_INCREMENT',
				'SubjectName' => 'VARCHAR(75) NOT NULL',
				'PRIMARY KEY (`SubjectID`)',
				'UNIQUE INDEX `SubjectName_UNIQUE` (`SubjectName` ASC)'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_monitor_inventory', array(
				'ServiceTag' => 'VARCHAR(45) NOT NULL',
				'Size' => 'VARCHAR(45) NULL',
				'PRIMARY KEY (`ServiceTag`)' 
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_evaluation_questions', array(
				'QuestionID' => 'INT(4) NOT NULL',
				'Question' => 'VARCHAR(500) NOT NULL',
				'PRIMARY KEY (`QuestionID`)'
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_user_info', array(
				'UserID' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'FirstName' => 'VARCHAR(30) NOT NULL',
				'LastName' => 'VARCHAR(40) NOT NULL',
				'MiddleName' => 'VARCHAR(45) NULL',
				'Username' => 'VARCHAR(41) NOT NULL',
				'Password' => 'VARCHAR(128) NOT NULL',
				'Email' => 'VARCHAR(100) NOT NULL',
				'PhoneExt' => 'INT(5) NOT NULL',
				'DepartmentID' => 'INT(2) NOT NULL',
				'RoleID' => 'INT(2) NOT NULL',
				'HireDate' => 'DATE NULL',
				'Active' => 'TINYINT(1) NULL',
				'PRIMARY KEY (`UserID`)',
				'INDEX `Email` (`Email` ASC, `PhoneExt` ASC)',
				'INDEX `Username` (`Username` ASC)',
				'INDEX `fk_ci_user_info_ci_roles_idx` (`RoleID` ASC)',
				'INDEX `fk_ci_user_info_ci_departments1_idx` (`DepartmentID` ASC)',
				'CONSTRAINT `fk_ci_user_info_ci_roles`
					FOREIGN KEY (`RoleID` )
					REFERENCES `ci2`.`ci_roles` (`RoleID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_user_info_ci_departments1`
					FOREIGN KEY (`DepartmentID` )
					REFERENCES `ci2`.`ci_departments` (`DepartmentID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_departments', array(
				'DepartmentID' => 'INT(2) NOT NULL AUTO_INCREMENT',
				'DepartmentName' => 'VARCHAR(35) NOT NULL',
				'SupervisorID' => 'INT(11) NOT NULL',
				'PRIMARY KEY (`DepartmentID`)',
				'INDEX `fk_ci_departments_ci_user_info1_idx` (`SupervisorID` ASC)',
				'CONSTRAINT `fk_ci_departments_ci_user_info1`
					FOREIGN KEY (`SupervisorID` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_department_tiers', array(
				'MainDepartmentID' => 'INT(2) NOT NULL',
				'SubDepartmentID' => 'INT(2) NOT NULL',
				'PRIMARY KEY (`MainDepartmentID`, `SubDepartmentID`)',
				'INDEX `fk_ci_department_tiers_ci_departments1_idx` (`MainDepartmentID` ASC)',
				'INDEX `fk_ci_department_tiers_ci_departments2_idx` (`SubDepartmentID` ASC)',
				'CONSTRAINT `fk_ci_department_tiers_ci_departments1`
					FOREIGN KEY (`MainDepartmentID` )
					REFERENCES `ci2`.`ci_departments` (`DepartmentID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_department_tiers_ci_departments2`
					FOREIGN KEY (`SubDepartmentID` )
					REFERENCES `ci2`.`ci_departments` (`DepartmentID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_trouble_tickets', array(
				'TicketID' => 'INT(10) NOT NULL AUTO_INCREMENT',
				'OpenedBy' => 'INT(11) NOT NULL',
				'OpenDate' => 'DATE NOT NULL',
				'CategoryID' => 'INT(3) NOT NULL',
				'SubjectID' => 'INT(3) NOT NULL',
				'ClosedByUserID' => 'INT(11) NULL',
				'CloseDate' => 'DATE NULL',
				'PRIMARY KEY (`TicketID`, `CategoryID`, `SubjectID`)',
				'INDEX `fk_ci_trouble_tickets_ci_user_info1_idx` (`OpenedBy` ASC)' ,
				'INDEX `fk_ci_trouble_tickets_ci_ticket_categories1_idx` (`CategoryID` ASC)' ,
				'INDEX `fk_ci_trouble_tickets_ci_user_info2_idx` (`ClosedByUserID` ASC)' ,
				'INDEX `fk_ci_trouble_tickets_ci_ticket_subjects1_idx` (`SubjectID` ASC)' ,
				'CONSTRAINT `fk_ci_trouble_tickets_ci_user_info1`
					FOREIGN KEY (`OpenedBy` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_trouble_tickets_ci_ticket_categories1`
					FOREIGN KEY (`CategoryID` )
					REFERENCES `ci2`.`ci_ticket_categories` (`CategoryID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_trouble_tickets_ci_user_info2`
					FOREIGN KEY (`ClosedByUserID` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_trouble_tickets_ci_ticket_subjects1`
					FOREIGN KEY (`SubjectID` )
					REFERENCES `ci2`.`ci_ticket_subjects` (`SubjectID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
			), 
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_category_subject_bridge', array(
				'CategoryID' => 'INT(3) NOT NULL',
				'SubjectID' => 'INT(3) NOT NULL',
				'PRIMARY KEY (`CategoryID`, `SubjectID`)',
				'INDEX `fk_ci_category_subject_bridge_ci_ticket_categories1_idx` (`CategoryID` ASC)',
				'INDEX `fk_ci_category_subject_bridge_ci_ticket_subjects1_idx` (`SubjectID` ASC)',
				'CONSTRAINT `fk_ci_category_subject_bridge_ci_ticket_categories1`
					FOREIGN KEY (`CategoryID` )
					REFERENCES `ci2`.`ci_ticket_categories` (`CategoryID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_category_subject_bridge_ci_ticket_subjects1`
					FOREIGN KEY (`SubjectID` )
					REFERENCES `ci2`.`ci_ticket_subjects` (`SubjectID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_subject_tips', array(
				'SubjectID' => 'INT(3) NOT NULL',
				'TipID' => 'INT(3) NOT NULL',
				'PRIMARY KEY (`SubjectID`, `TipID`)',
				'INDEX `fk_ci_subject_tips_ci_ticket_subjects1_idx` (`SubjectID` ASC)',
				'INDEX `fk_ci_subject_tips_ci_tips1_idx` (`TipID` ASC)',
				'CONSTRAINT `fk_ci_subject_tips_ci_ticket_subjects1`
					FOREIGN KEY (`SubjectID` )
					REFERENCES `ci2`.`ci_ticket_subjects` (`SubjectID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_subject_tips_ci_tips1`
					FOREIGN KEY (`TipID` )
					REFERENCES `ci2`.`ci_tips` (`TipID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_computer_inventory', array(
				'ComputerID' => 'INT(11) NOT NULL AUTO_INCREMENT',
				'ComputerName' => 'VARCHAR(45) NOT NULL',
				'UserID' => 'INT(11) NULL',
				'Model' => 'VARCHAR(45) NOT NULL',
				'InceptionDate' => 'DATE NULL',
				'WarrantyEndDate' => 'DATE NULL',
				'PRIMARY KEY (`ComputerID`)',
				'UNIQUE INDEX `ComputerName_UNIQUE` (`ComputerName` ASC)',
				'INDEX `fk_ci_computer_inventory_ci_user_info1_idx` (`UserID` ASC)',
				'CONSTRAINT `fk_ci_computer_inventory_ci_user_info1`
					FOREIGN KEY (`UserID` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_evaluations', array(
				'EvaluationID' => 'INT(11) NOT NULL',
				'Employee' => 'INT(11) NOT NULL',
				'Evaluator' => 'INT(11) NOT NULL',
				'EvaluationDate' => 'DATE NULL',
				'PRIMARY KEY (`EvaluationID`)',
				'INDEX `fk_ci_evaluations_ci_user_info1_idx` (`Employee` ASC)',
				'INDEX `fk_ci_evaluations_ci_user_info2_idx` (`Evaluator` ASC)',
				'CONSTRAINT `fk_ci_evaluations_ci_user_info1`
					FOREIGN KEY (`Employee` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_evaluations_ci_user_info2`
					FOREIGN KEY (`Evaluator` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_evaluation_answers', array(
				'EvaluationID' => 'INT(11) NOT NULL',
				'QuestionID' => 'INT(4) NOT NULL',
				'Score' => 'INT(2) NULL',
				'Comments' => 'VARCHAR(500) NULL',
				'PRIMARY KEY (`EvaluationID`, `QuestionID`)',
				'INDEX `fk_ci_evaluation_answers_ci_evaluation_questions1_idx` (`QuestionID` ASC)',
				'CONSTRAINT `fk_ci_evaluation_answers_ci_evaluations1`
					FOREIGN KEY (`EvaluationID` )
					REFERENCES `ci2`.`ci_evaluations` (`EvaluationID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_evaluation_answers_ci_evaluation_questions1`
					FOREIGN KEY (`QuestionID` )
					REFERENCES `ci2`.`ci_evaluation_questions` (`QuestionID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_documents', array(
				'DocumentID' => 'INT NOT NULL',
				'Uploader' => 'INT(11) NOT NULL',
				'DocumentName' => 'VARCHAR(45) NOT NULL',
				'Path' => 'VARCHAR(100) NOT NULL',
				'UploadDate' => 'DATE NULL',
				'PRIMARY KEY (`DocumentID`)',
				'INDEX `fk_ci_documents_ci_user_info1_idx` (`Uploader` ASC)',
				'CONSTRAINT `fk_ci_documents_ci_user_info1`
					FOREIGN KEY (`Uploader` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_message_documents', array(
				'MessageID' => 'INT(11) NOT NULL',
				'DocumentID' => 'INT NOT NULL',
				'INDEX `fk_ci_message_documents_ci_messages1_idx` (`MessageID` ASC)',
				'INDEX `fk_ci_message_documents_ci_documents1_idx` (`DocumentID` ASC)',
				'PRIMARY KEY (`MessageID`, `DocumentID`)',
				'CONSTRAINT `fk_ci_message_documents_ci_messages1`
					FOREIGN KEY (`MessageID` )
					REFERENCES `ci2`.`ci_messages` (`MessageID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_message_documents_ci_documents1`
					FOREIGN KEY (`DocumentID` )
					REFERENCES `ci2`.`ci_documents` (`DocumentID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');

		$this->createTable('ci_document_processor', array(
				'WarrantNumber' => 'VARCHAR(45) NOT NULL' ,
				'DocumentID' => 'INT NOT NULL' ,
				'DocumentTypeID' => 'INT(3) NOT NULL',
				'CompletedBy' => 'INT(11) NULL',
				'CompletionDate' => 'DATE NULL',
				'PRIMARY KEY (`WarrantNumber`, `DocumentID`)',
				'INDEX `fk_ci_document_processor_ci_user_info1_idx` (`CompletedBy` ASC)',
				'INDEX `fk_ci_document_processor_ci_documents1_idx` (`DocumentID` ASC)',
				'INDEX `fk_ci_document_processor_ci_document_type1_idx` (`DocumentTypeID` ASC)',
				'CONSTRAINT `fk_ci_document_processor_ci_user_info1`
					FOREIGN KEY (`CompletedBy` )
					REFERENCES `ci2`.`ci_user_info` (`UserID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_document_processor_ci_documents1`
					FOREIGN KEY (`DocumentID` )
					REFERENCES `ci2`.`ci_documents` (`DocumentID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_document_processor_ci_document_type1`
					FOREIGN KEY (`DocumentTypeID` )
					REFERENCES `ci2`.`ci_document_type` (`TypeID` )
					ON DELETE NO ACTION
					ON UPDATE NO ACTION'
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{	
		// Drop the tables.
		$this->dropTable('ci_roles');
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
