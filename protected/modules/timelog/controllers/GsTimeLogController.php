<?php

class GsTimeLogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	// Store the locations of the Logon.csv and Logoff.csv files.
	private $log1 = array(1 => 'C:/Users/cwilloughby/Desktop/In/logon.csv', 
						  2 => 'C:/Users/cwilloughby/Desktop/In/Logoff.csv');
	
	// Store the locations of the Logon_Probation.csv and Logoff_Probation.csv files.
	private $log2 = array(1 => 'C:/Users/cwilloughby/Desktop/In/Logon_Probation.csv',
						  2 => 'C:/Users/cwilloughby/Desktop/In/Logoff_Probation.csv');
	
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
	 * Imports the events in the text files into the database.
	 */
	public function actionCreate()
	{
		// Create a transaction so the sql can be rolled back if something goes wrong.
		$transaction = Yii::app()->db->beginTransaction();

		try
		{
			$i = 0;
			$commands = array();
			
			// Prepare the queries for the regular logs.
			foreach($this->getLog1() as $value)
			{
				$sql = "LOAD DATA INFILE '" . $value . "' INTO TABLE ci_gs_time_log
					FIELDS TERMINATED BY ','
					(@eType, @cName, @uName, @date, @eTime)
					SET username = trim(@uName),
					computername = trim(@cName),
					eventtype = trim(@eType),
					eventtime = trim(@eTime),
					eventdate = STR_TO_DATE(@date, '%a %m/%d/%Y');";
		
				$commands[$i] = Yii::app()->db->createCommand($sql);
				$i++;
			}
			foreach($this->getLog2() as $value)
			{
				$sql = "LOAD DATA INFILE '" . $value . "' INTO TABLE ci_gs_time_log
					FIELDS TERMINATED BY ','
					(@eType, @uName, @cName, @date, @eTime)
					SET username = trim(@uName),
					computername = trim(@cName),
					eventtype = trim(@eType),
					eventtime = trim(@eTime),
					eventdate = STR_TO_DATE(@date, '%a %m/%d/%Y');";

				$commands[$i] = Yii::app()->db->createCommand($sql);
				$i++;
			}
			
			foreach($commands as $command)
			{
				if(!$command->execute())
				{
					// The command failed to execute. Throw an exception.
					throw new Exception('Fail');
				}
			}
			
			// Commit the transaction.
			$transaction->commit();
			
			// It is now safe to remove those events from the text files.
			// Delete the lines from the text files so they won't be read in the next time the script is run.
			foreach($this->getLog1() as $value)
			{
				$handle = fopen($value, "w");
				fclose($handle);
			}
			foreach($this->getLog2() as $value)
			{
				$handle = fopen($value, "w");
				fclose($handle);
			}
		}
		catch(Exception $e)
		{
			// If an error occured, nothing is inserted into the database and the text files are left alone. 
			$transaction->rollback();
		}
		return;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GsTimeLog']))
		{
			$model->attributes=$_POST['GsTimeLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GsTimeLog');
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
		$this->actionCreate();

		// First unset the cookies for dates.
		unset(Yii::app()->request->cookies['from_date']);  
		unset(Yii::app()->request->cookies['to_date']);

		$model = new GsTimeLog('search');  // your model
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['GsTimeLog']))
		{
			$model->attributes=$_GET['GsTimeLog'];
			
			if(isset($_GET['from_date']) || isset($_GET['to_date']))
			{
				Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_GET['from_date']);  // define cookie for from_date
				Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_GET['to_date']);
				$model->from_date = $_GET['from_date'];
				$model->to_date = $_GET['to_date'];

				// If the from_date is set.
				if((int)$model->from_date)
				{
					$model->from_date = date('Y-m-d', strtotime($model->from_date));
				}
				// If the to_date is set.
				if((int)$model->to_date)
				{
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
		$model=GsTimeLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	private function getLog1()
	{
		return $this->log1;	
	}
	
	private function getLog2()
	{
		return $this->log2;
	}
}
