<?php

class SecurityModule extends CWebModule
{
	public $defaultController = 'login';
	public $allowAjax = true;
	
	public function init()
	{
		$this->registerAssets();

		$this->setImport(array(
			'security.models.*',
		));
	}
	
	public function registerAssets()
	{
		
	}
}
