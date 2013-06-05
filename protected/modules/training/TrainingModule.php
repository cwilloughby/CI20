<?php

class TrainingModule extends CWebModule
{
	public $defaultController = 'training';
	
	public function init()
	{
		$this->setImport(array(
			'videos.models.*',
			'training.components.*'
		));
	}
}
