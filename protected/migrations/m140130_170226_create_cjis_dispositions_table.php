<?php

class m140130_170226_create_cjis_dispositions_table extends CDbMigration
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
		$this->createTable('ci_cjis_dispositions', array(
			'dispoid' => "INT NOT NULL AUTO_INCREMENT",
			'court' => "VARCHAR(8) NOT NULL DEFAULT 'CC'",
			'case' => "VARCHAR(25) NOT NULL",
			'lastname' => "VARCHAR(45) NOT NULL",
			'firstname' => "VARCHAR(45) NOT NULL",
			'dateofbirth' => "DATE NOT NULL",
			'gender' => "CHAR NOT NULL",
			'race' => "CHAR NOT NULL",
			'count' => "INT(3) NULL",
			'offensedescription' => "TEXT NOT NULL",
			'offensetype' => "VARCHAR(25) NOT NULL",
			'disposition' => "VARCHAR(45) NULL",
			'dateconcluded' => "DATE NULL",
			'location' => "VARCHAR(45) NULL",
			'incarcerationyears' => "INT(5) NULL",
			'incarcerationmonths' => "INT(2) NULL",
			'incarcerationdays' => "INT(2) NULL",
			'incarcerationhours' => "INT(2) NULL",
			'percentage' => "VARCHAR(25) NULL",
			'suspendallbut' => "VARCHAR(25) NULL",
			'suspendpercentage' => "VARCHAR(25) NULL",
			'dayfordayflag' => "CHAR NOT NULL DEFAULT 'N'",
			'hourforhourflag' => "CHAR NOT NULL DEFAULT 'N'",
			'suspendedflag' => "CHAR NOT NULL DEFAULT 'N'",
			'noworkdetailflag' => "CHAR NOT NULL DEFAULT 'N'",
			'workreleaseflag' => "CHAR NOT NULL DEFAULT 'N'",
			'workreleasepercentage' => "VARCHAR(25) NULL",
			'earlyreleaseflag' => "CHAR NOT NULL DEFAULT 'N'",
			'timeservedcredit' => "VARCHAR(25) NULL",
			'specifiedjailcreditmonths' => "VARCHAR(45) NULL",
			'specifiedjailcreditdays' => 'VARCHAR(45) NULL',
			'specifiedjailcredithours' => 'VARCHAR(45) NULL',
			'incarcerationspecialconditions' => "TEXT NULL",
			'probationtype' => "VARCHAR(25) NULL",
			'probationyears' => "INT(2) NULL",
			'probationmonths' => "INT(2) NULL",
			'probationdays' => "INT(2) NULL",
			'probationspecialconditions' => "TEXT NULL",
			'restitutionamount' => "VARCHAR(25) NULL",
			'courtfines' => "VARCHAR(25) NULL",
			'finesspecialcondition' => "TEXT NULL",
			"PRIMARY KEY('dispoid')"
		),
		'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		$this->dropTable('ci_cjis_dispositions');
	}
}