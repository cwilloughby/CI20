<?php

class HrModule extends CWebModule
{
	public $defaultController = 'hrpolicy';
	
	public function init()
	{
		$this->setImport(array(
			'hr.models.*',
		));
	}
}
