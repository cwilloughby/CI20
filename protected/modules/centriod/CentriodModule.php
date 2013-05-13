<?php

class CentriodModule extends CWebModule
{
	public $defaultController = 'centriod';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'centriod.models.*',
		));
	}
}
