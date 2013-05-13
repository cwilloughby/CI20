<?php

class WeatherModule extends CWebModule
{
	public $defaultController = 'weather';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'weather.models.*',
			'weather.components.*'
		));
	}
}
