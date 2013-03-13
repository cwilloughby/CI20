<?php

class m130311_140153_create_evidence_tables extends CDbMigration
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
		$this->createTable('ci_attorney', array(
				'attyid' => 'INT(9) NOT NULL AUTO_INCREMENT',
				'lname' => 'VARCHAR(40) NULL DEFAULT NULL',
				'fname' => 'VARCHAR(25) NULL DEFAULT NULL',
				'type' => 'VARCHAR(20) NULL DEFAULT "Defense"',
				'barid' => 'INT(10) NULL DEFAULT NULL',
				'PRIMARY KEY (`attyid`)',
			),
			'ENGINE=InnoDB, AUTO_INCREMENT = 502, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_crt_case', array(
				'caseno' => 'VARCHAR(50) NOT NULL',
				'crtdiv' => 'VARCHAR(25) NULL DEFAULT NULL',
				'cptno' => 'VARCHAR(50) NULL DEFAULT NULL',
				'PRIMARY KEY (`caseno`)',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_defendant', array(
				'defid' => 'INT(9) NOT NULL AUTO_INCREMENT',
				'lname' => 'VARCHAR(40) NULL DEFAULT NULL',
				'fname' => 'VARCHAR(25) NULL DEFAULT NULL',
				'oca' => 'INT(10) NULL DEFAULT NULL',
				'PRIMARY KEY (`defid`)',
			),
			'ENGINE=InnoDB, AUTO_INCREMENT = 1326, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_case_summary', array(
				'summaryid' => ' INT(9) NOT NULL AUTO_INCREMENT',
				'defid' => 'INT(9) NOT NULL',
				'caseno' => 'VARCHAR(50) NOT NULL',
				'location' => 'VARCHAR(100) NULL DEFAULT NULL',
				'dispodate' => 'DATE NULL DEFAULT NULL',
				'hearingdate' => 'DATE NULL',
				'hearingtype' => 'VARCHAR(40) NULL DEFAULT NULL', 
				'page' => 'VARCHAR(6) NULL DEFAULT "N/A"',
				'sentence' => 'VARCHAR(100) NULL DEFAULT NULL',
				'indate' => 'DATE NULL DEFAULT NULL',
				'outdate' => 'DATE NULL DEFAULT NULL',
				'destructiondate' => 'DATE NULL DEFAULT NULL',
				'recip' => 'VARCHAR(50) NULL DEFAULT NULL',
				'comment' => 'VARCHAR(255) NULL DEFAULT NULL',
				'dna' => 'INT(1) NULL DEFAULT NULL',
				'bio' => 'INT(1) NULL DEFAULT NULL',
				'drug' => 'INT(1) NULL DEFAULT NULL',
				'firearm' => 'INT(1) NULL DEFAULT NULL',
				'money' => 'INT(1) NULL DEFAULT NULL',
				'other' => 'INT(1) NULL DEFAULT NULL',
				'PRIMARY KEY (`summaryid`)',
				'INDEX `fk_ci_case_summary_ci_crt_case1_idx1` (`caseno` ASC)',
				'INDEX `fk_ci_case_summary_ci_defendant1_idx` (`defid` ASC)',
				'CONSTRAINT `fk_ci_case_summary_ci_crt_case1`
					FOREIGN KEY (`caseno`)
					REFERENCES `ci2`.`ci_crt_case` (`caseno`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_case_summary_ci_defendant1`
					FOREIGN KEY (`defid`)
					REFERENCES `ci2`.`ci_defendant` (`defid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			),
			'ENGINE=InnoDB, AUTO_INCREMENT = 1470, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_case_attorneys', array(
				'summaryid' => ' INT(9) NOT NULL',
				'attyid' => 'INT(9) NOT NULL',
				'PRIMARY KEY (`summaryid`, `attyid`)',
				'INDEX `fk_ci_case_attorneys_ci_case_summary1_idx` (`summaryid` ASC)',
				'INDEX `fk_ci_case_attorneys_ci_attorney1_idx` (`attyid` ASC)',
				'CONSTRAINT `fk_ci_case_attorneys_ci_case_summary1`
					FOREIGN KEY (`summaryid`)
					REFERENCES `ci2`.`ci_case_summary` (`summaryid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
				'CONSTRAINT `fk_ci_case_attorneys_ci_attorney1`
					FOREIGN KEY (`attyid`)
					REFERENCES `ci2`.`ci_attorney` (`attyid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_evidence', array(
				'evidenceid' => ' INT(10) NOT NULL AUTO_INCREMENT',
				'caseno' => 'VARCHAR(50) NOT NULL',
				'exhibitno' => 'VARCHAR(20) NOT NULL',
				'evidencename' => 'VARCHAR(1000) NULL DEFAULT NULL',
				'comment' => 'VARCHAR(100) NULL DEFAULT NULL',
				'dateadded' => 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP',
				'PRIMARY KEY (`evidenceid`)',
				'INDEX `fk_ci_evidence_ci_crt_case1_idx1` (`caseno` ASC)',
				'CONSTRAINT `fk_ci_evidence_ci_crt_case1`
					FOREIGN KEY (`caseno`)
					REFERENCES `ci2`.`ci_crt_case` (`caseno`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			),
		'ENGINE=InnoDB, AUTO_INCREMENT = 11547, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_log', array(
				'eventid' => ' INT(20) NOT NULL AUTO_INCREMENT',
				'userid' => 'INT(4) NOT NULL',
				'tablename' => 'VARCHAR(45) NOT NULL',
				'tablerow' => 'VARCHAR(15) NOT NULL',
				'eventdate' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
				'event' => 'VARCHAR(45) NOT NULL',
				'PRIMARY KEY (`eventid`)',
				'INDEX `fk_ci_log_ci_user_info1_idx` (`userid` ASC)',
				'CONSTRAINT `fk_ci_log_ci_user_info1`
					FOREIGN KEY (`userid`)
					REFERENCES `ci2`.`ci_user_info` (`userid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			),
			'ENGINE=InnoDB, AUTO_INCREMENT = 17737, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the tables.
		$this->dropTable('ci_attorney');
		$this->dropTable('ci_crt_case');
		$this->dropTable('ci_defendant');
		$this->dropTable('ci_case_summary');
		$this->dropTable('ci_case_attorneys');
		$this->dropTable('ci_evidence');
		$this->dropTable('ci_log');
	}
}