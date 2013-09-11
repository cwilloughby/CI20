<?php

class CentriodController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * Displays the centriod page.
	 */
	public function actionExamineFiles()
	{
		try
		{
			$model = new Centriod;

			if($model->attributes = Yii::app()->request->getPost('Centriod'))
			{
				if($model->validate())
					$results = $model->reportFiles();
				else
					$results = false;
			}
			else
				$results = false;
		}
		catch(Exception $ex)
		{
			echo "Centriod module failed with error " . $ex;
		}
		
		// Display the form.
		$this->render('index', array('centriod'=> $model, 'results' => $results));
	}
}
