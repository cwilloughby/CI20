<?php

class IssuetrackerModule extends CWebModule
{
	public $defaultController = 'issuetracker';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'issuetracker.models.*',
			'issuetracker.components.*',
		));
	}
}
