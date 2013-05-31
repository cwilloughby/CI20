<?php

class BugTrakerModule extends CWebModule
{
	public $defaultController = 'bugtracker';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'bugtracker.models.*',
		));
	}
}
