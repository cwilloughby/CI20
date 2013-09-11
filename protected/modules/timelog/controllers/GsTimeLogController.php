<?php

class GsTimeLogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	// Store the locations of the Logon.csv and Logoff.csv files.
	private $log1 = array(1 => '//GSCT4482/Audit_User_1$/logon.csv', 
						  2 => '//GSCT4482/Audit_User_1$/Logoff.csv');
	
	// Store the locations of the Logon_Probation.csv and Logoff_Probation.csv files.
	private $log2 = array(1 => '//GSCT4482/Audit_User_1$/Logon_Probation.csv',
						  2 => '//GSCT4482/Audit_User_1$/Logoff_Probation.csv');
	
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
	 * This function returns a list of external actions.
	 * External actions are identical functions shared by many controllers throughout ci2.
	 * The code for the external actions can be found in protected\components
	 * @return array
	 */
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'GsTimeLog'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'GsTimeLog'),
		);
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
				if(filesize($value) != 0)
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
			}
			foreach($this->getLog2() as $value)
			{
				if(filesize($value) != 0)
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(($_SERVER['REMOTE_ADDR'] != "127.0.0.1")) 
		{
			// Auto import any new events in the text file to the database.
			$this->actionCreate();
		}

		// If the export button on the search form was clicked.
		if(Yii::app()->request->getParam('export'))
		{
			$this->actionExport();
			Yii::app()->end();
		}

		$model = new GsTimeLog('search');  // your model
		$model->unsetAttributes();  // clear any default values
		//
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		if(isset($_GET['GsTimeLog']))
		{
			$model->attributes=$_GET['GsTimeLog'];

			// If the date range was provided, convert the formats.
			$model->dateFormatter();
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Export the gridview to a csv file.
	 */
	public function actionExport()
	{
		$fp = fopen('php://temp', 'w');

		// Write a header of csv file
		$headers = array(
			'username',
			'computername',
			'eventdate',
			'eventtype',
			'eventtime',
		);
		$row = array();
		foreach($headers as $header) {
			$row[] = GsTimeLog::model()->getAttributeLabel($header);
		}
		fputcsv($fp,$row);

		// Init dataProvider for first page.
		$model = new GsTimeLog('search');
		$model->unsetAttributes();  // Clear any default values.
		
		if(isset($_GET['GsTimeLog']))
		{
			$model->attributes=$_GET['GsTimeLog'];

			// If the date range was provided, convert the formats.
			$model->dateFormatter();
		}
		
		$dp = $model->search();
		$dp->setPagination(false);

		//Get models, write to a file
		$models = $dp->getData();
		foreach($models as $model)
		{
			$row = array();
			foreach($headers as $head)
			{
				$row[] = CHtml::value($model,$head);
			}
			fputcsv($fp,$row);
		}

		// Save csv content to a session.
		rewind($fp);
		Yii::app()->user->setState('export',stream_get_contents($fp));
		fclose($fp);
	}
	
	/**
	 * Pull the csv from the session and send it to the user.
	 */
	public function actionExportFile()
	{
		Yii::app()->request->sendFile('export.csv',Yii::app()->user->getState('export'));
		Yii::app()->user->clearState('export');
	}
	
	/**
	 * This function returns the array that contains the path to the files
	 * that the GPO writes to for the basic logon and logoff events.
	 */
	private function getLog1()
	{
		return $this->log1;	
	}
	
	/**
	 * This function returns the array that contains the path to the files
	 * that the GPO writes to for the probation logon and logoff events.
	 */
	private function getLog2()
	{
		return $this->log2;
	}
}
