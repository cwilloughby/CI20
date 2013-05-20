<?php

class LinksController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * Displays the links to the printers and copiers.
	 */
	public function actionPrintersCopiers()
	{
		$model = new Links;
		
		// Display the links.
		$this->render('printersCopiers', array('printers'=> $model->getPrinters(), 'copiers' => $model->getCopiers()));
	}
}
