<?php

class EvidenceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Displays the evidence search and report page
	 */
	public function actionSearch()
	{
		$evidence = new Evidence;

		if($evidence->attributes = Yii::app()->request->getPost('Evidence'))
		{
			if($evidence->validate())
			{
				// Obtain the evidence.
				//$evidence = Evidence::getEvidence();
			}
		}
		
		// Display the evidence.
		$this->render('search', array('evidence'=>$evidence));
	}
}
