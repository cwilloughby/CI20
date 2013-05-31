<?php

class DocumentsModule extends CWebModule
{
	public $defaultController = 'documents';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'documents.models.*',
		));
	}
}
