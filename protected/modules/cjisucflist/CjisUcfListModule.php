<?php

class CjisUcfListModule extends CWebModule
{
	public $defaultController = 'doctable';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'cjisucflist.models.*',
			'news.models.*'
		));
	}
}
