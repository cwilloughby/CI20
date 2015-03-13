<?php

class HearingRequestModule extends CWebModule
{
	public $defaultController = 'HearingRequest';
	
	public function init()
	{
		$this->setImport(array(
			'hearingrequest.models.*',
		));
	}
}
