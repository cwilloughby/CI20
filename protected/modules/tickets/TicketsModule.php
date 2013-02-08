<?php

class TicketsModule extends CWebModule
{
	public $defaultController = 'troubletickets';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'tickets.models.*',
		));
	}
}
