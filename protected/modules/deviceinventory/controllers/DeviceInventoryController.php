<?php

class DeviceInventoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	private $gpoFile = "//crim10048/TimeLogIn$/Logon.txt";
	
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
			'model'=>$this->loadModel($id, 'DeviceInventory'),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DeviceInventory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeviceInventory']))
		{
			$model->attributes=$_POST['DeviceInventory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->deviceid));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id, 'DeviceInventory');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeviceInventory']))
		{
			$model->attributes=$_POST['DeviceInventory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->deviceid));
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
		$this->loadModel($id, 'DeviceInventory')->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DeviceInventory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionSearch()
	{
		// Do not import the events if this code is being run locally. Otherwise 
		// the events could be imported into the wrong database.
		if(($_SERVER['REMOTE_ADDR'] != "127.0.0.1")) 
		{
			// Auto import any new events in the text file to the database.
			$this->importTimeLog();
		}
		
		try
		{
			$model=new DeviceInventory('search');
			$model->unsetAttributes();  // clear any default values

			// If the pager number was changed.
			if(isset($_GET['pageSize'])) 
			{
				Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
				unset($_GET['pageSize']);
			}

			if(isset($_GET['DeviceInventory']))
				$model->attributes=$_GET['DeviceInventory'];
		}
		catch(Exception $ex)
		{
			echo "Search page failed with error " . $ex;
		}
		$this->render('search',array(
			'model'=>$model,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='device-inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * This function returns the path to the file that the GPO writes to.
	 */
	private function getGpoFile()
	{
		return $this->gpoFile;
	}
	
	/**
	 * Imports the events in the text file into the database.
	 */
	private function importTimeLog()
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
	}
}
