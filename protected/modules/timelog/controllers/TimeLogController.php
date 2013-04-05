<?php

class TimeLogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	private $gpoFile = "C:/Users/cwilloughby/Desktop/In/Logon.txt";
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * Imports the events in the text file into the database.
	 */
	public function actionCreate()
	{
		// Create a transaction so the sql can be rolled back if something goes wrong.
		$transaction = Yii::app()->db->beginTransaction();

		try
		{
			$sql = "LOAD DATA INFILE '" . $this->getGpoFile() . "' INTO TABLE ci_time_log
				FIELDS TERMINATED BY ','
				(@uName, @cName, @eType, @eTime, @date)
				SET username = trim(@uName),
				computername = trim(@cName),
				eventtype = trim(@eType),
				eventtime = trim(@eTime),
				eventdate = STR_TO_DATE(@date, '%a %m/%d/%Y');";

			$command=Yii::app()->db->createCommand($sql);

			if($command->execute())
			{
				// Commit the transaction.
				$transaction->commit();
				// It is now safe to remove those events from the text file.
				// Delete the lines from the text file so they won't be read in the next time the script is run.
				$handle = fopen($this->getGpoFile(), "w");
				fclose($handle);
			}
			else
			{
				// The command failed to execute. Throw an exception.
				throw new Exception('Fail');
			}
		}
		catch(Exception $e)
		{
			// If an error occured, nothing is inserted into the database and the text file is left alone. 
			$transaction->rollback();
		}
		return;
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TimeLog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		// Auto import any new events in the text file to the database.
		//$this->actionCreate();
		
		// First unset the cookies for dates.
		unset(Yii::app()->request->cookies['from_date']);  
		unset(Yii::app()->request->cookies['to_date']);

		$model = new TimeLog('search');
		$model->unsetAttributes();  // Clear any default values.

		if(isset($_GET['TimeLog']))
		{
			$model->attributes=$_GET['TimeLog'];
			
			if(isset($_GET['from_date']) || isset($_GET['to_date']))
			{
				Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_GET['from_date']);  // define cookie for from_date
				Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_GET['to_date']);
				$model->from_date = $_GET['from_date'];
				$model->to_date = $_GET['to_date'];

				// If the from_date is set.
				if((int)$model->from_date)
				{
					// Convert the date format to the same format that is used in the database.
					$model->from_date = date('Y-m-d', strtotime($model->from_date));
				}
				// If the to_date is set.
				if((int)$model->to_date)
				{
					// Convert the date format to the same format that is used in the database.
					$model->to_date = date('Y-m-d', strtotime($model->to_date));
				}
			}
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TimeLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/*
	 * This function returns the path to the file that the GPO writes to.
	 */
	private function getGpoFile()
	{
		return $this->gpoFile;
	}
}
