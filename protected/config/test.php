<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		// autoloading model and component classes
		'import'=>array(
			'application.modules.evidence.models.*',
		),
		'modules'=>array(
			'evidence',
		),
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			/* uncomment the following to provide test database connection
			'db'=>array(
				'connectionString'=>'DSN for test database',
			),
			*/
		),
	)
);
