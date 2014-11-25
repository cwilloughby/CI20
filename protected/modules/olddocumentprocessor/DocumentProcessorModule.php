<?php

class DocumentProcessorModule extends CWebModule
{
	public $defaultController = 'documentProcessor';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'documentprocessor.models.*',
		));
	}
}
