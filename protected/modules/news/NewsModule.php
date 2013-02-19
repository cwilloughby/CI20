<?php

class NewsModule extends CWebModule
{
	public $defaultController = 'news';
	
	public function init()
	{
		$this->setImport(array(
			'news.models.*',
		));
	}
}
