<?php

class m130528_173451_create_videos_table extends CDbMigration
{
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