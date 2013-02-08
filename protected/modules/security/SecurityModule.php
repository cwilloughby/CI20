<?php

class SecurityModule extends CWebModule
{
	public $defaultController = 'login';
	
	public function init()
	{
		$this->setImport(array(
			'security.models.*',
		));
	}
}
