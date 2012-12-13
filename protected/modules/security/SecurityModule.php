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

	public function beforeControllerAction($controller, $action)
	{		
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	public function registerAssets()
	{
		
	}
}
