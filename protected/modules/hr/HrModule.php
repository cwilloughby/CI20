<?php

class HrModule extends CWebModule
{
	public $defaultController = 'hrpolicy';
	public $allowAjax = true;
	
	public function init()
	{
		$this->registerAssets();

		$this->setImport(array(
			'hr.models.*',
		));
	}
	
	public function registerAssets()
	{
		
	}
}
