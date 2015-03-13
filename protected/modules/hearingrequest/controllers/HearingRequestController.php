<?php

class HearingRequestController extends Controller
{
	public $layout='//layouts/column1';
	
	public function actionDARequest()
	{
		$this->render('../daRequest/DARequest');
	}

	public function actionPDRequest()
	{
		$this->render('../pdRequest/PDRequest');
	}
}