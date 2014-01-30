<?php

class CJISDispoModule extends CWebModule
{
	public $defaultController = 'cjisDispo';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'cjisDispo.models.*',
		));
	}
}
