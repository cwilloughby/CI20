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
		$model = new Centriod;
		
		if(isset($_POST['Centriod']))
		{
			$model->attributes = $_POST['Centriod'];
			
			if($model->validate())
			{
				$results = $model->reportFiles();
			}
			else
			{
				$results = false;
			}
		}
		else
		{
			$results = false;
		}

		// Display the form.
		$this->render('index', array('centriod'=> $model, 'results' => $results));
	}
}