<?php

class VideosModule extends CWebModule
{
	public $defaultController = 'videos';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'videos.models.*',
		));
	}
}
