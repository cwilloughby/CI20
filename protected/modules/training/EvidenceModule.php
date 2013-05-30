<?php

class EvidenceModule extends CWebModule
{
	public $defaultController = 'summary';
	
	public function init()
	{
		$this->setImport(array(
			'evidence.models.*',
		));
	}
}
