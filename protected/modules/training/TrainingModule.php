<?php

class TrainingModule extends CWebModule
{
	public $defaultController = 'training';
	
	public function init()
	{
		$this->setImport(array(
			'training.models.*',
		));
	}
}
