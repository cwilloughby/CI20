<?php

class DeviceInventoryModule extends CWebModule
{
	public $defaultController = 'deviceInventory';
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'deviceinventory.models.*',
		));
	}
}
