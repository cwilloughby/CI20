<?php

class EvidenceModule extends CWebModule
{
	public $defaultController = 'evidence';
	
	public function init()
	{
		$this->setImport(array(
			'evidence.models.*',
		));
	}
}
