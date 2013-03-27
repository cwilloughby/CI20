<?php

class TimeLogModule extends CWebModule
{
	public $defaultController = 'timelog';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'timelog.models.*',
		));
	}
}
