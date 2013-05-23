<?php

class EvaluationsModule extends CWebModule
{
	public $defaultController = 'evaluations';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'evaluations.models.*',
		));
	}
}
