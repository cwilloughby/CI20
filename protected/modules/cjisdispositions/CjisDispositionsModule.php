<?php

class CJISDispositionsModule extends CWebModule
{
	public $defaultController = 'cjisDispositions';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'cjisdispositions.models.*',
		));
	}
}
