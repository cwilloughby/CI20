<?php

class m130129_192822_create_hr_policy_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('ci_hr_sections', array(	
				'sectionid' => 'INT(6) NOT NULL AUTO_INCREMENT',
				'section' => 'TEXT NOT NULL',
				'datemade' => 'DATETIME NOT NULL',
				'PRIMARY KEY (`sectionid`)',
				),
				'ENGINE=InnoDB, COLLATE=utf8_general_ci');
		
		$this->createTable('ci_hr_bridge', array(
				'policyid' => 'VARCHAR(50) NOT NULL',
				'sectionid' => 'INT(6) NOT NULL',
				'PRIMARY KEY (`policyid`, `sectionid`)',
				'CONSTRAINT `fk_ci_hr_bridge_ci_hr_sections1`
					FOREIGN KEY (`sectionid`)
					REFERENCES `ci2`.`ci_hr_sections` (`sectionid`)
					ON DELETE NO ACTION
					ON UPDATE NO ACTION',
			),
			'ENGINE=InnoDB, COLLATE=utf8_general_ci');
	}

	public function down()
	{
		// Drop the table.
		$this->dropTable('ci_hr_sections');
		$this->dropTable('ci_hr_bridge');
	}
}