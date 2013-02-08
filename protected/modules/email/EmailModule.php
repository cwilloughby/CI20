<?php

class EmailModule extends CWebModule
{
	public $defaultController = 'email';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'email.models.*',
		));
	}
}
