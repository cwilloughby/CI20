<?php

class LinksModule extends CWebModule
{
	public $defaultController = 'links';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'links.models.*',
		));
	}
}
