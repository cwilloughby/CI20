<?php

class DeviceHistoricController extends Controller
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
	 * Manages all models.
	 */
	public function actionReportHistoric()
	{
		try
		{
			// Do not import the events if this code is being run locally. Otherwise 
			// the events could be imported into the wrong database.
			if(($_SERVER['REMOTE_ADDR'] != "127.0.0.1")) 
			{
				// Auto import any new events in the text file to the database.
				$this->importTimeLog();
			}
			
			$model=new DeviceHistoric('search');
			$model->unsetAttributes();  // clear any default values
			
			// If a search form was posted, store the parameters in the session. 
			if(isset($_GET['DeviceHistoric']) AND !(Yii::app()->request->getParam('export')))
			{
				$model->attributes=$_GET['DeviceHistoric'];
				// If the date range was provided, convert the formats.
				$model->dateFormatter("YYYY-mm-dd");
				// Save the search parameters so they will be remembered after a page refreash.
				$model->saveSearchValues();
			}
			else
				$model->readSearchValues();
			
			// If the export button on the search form was clicked.
			if(Yii::app()->request->getParam('export'))
			{
				$this->actionPrintHistoricCSV(array(
						'device.devicename',
						'username',
						'location',
						'datechanged',
					),
					$model
				);
				Yii::app()->end();
			}

			// If the pager number was changed.
			if(isset($_GET['pageSize'])) 
			{
				Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
				unset($_GET['pageSize']);
			}
			
			$this->render('reportHistoric',array(
				'model'=>$model,
			));
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "INVH1: Inventory Historic Report failed with error " . $ex);
		}
	}
	
	/**
	 * Export the inventory gridview to a csv file.
	 */
	public function actionPrintHistoricCSV($headers, $model)
	{
		try
		{
			$fp = fopen('php://temp', 'w');

			// Write a header row of the csv file.
			$row = array();
			foreach($headers as $header) {
				$row[] = DeviceHistoric::model()->getAttributeLabel($header);
			}
			fputcsv($fp,$row);

			$dp = $model->search();
			$dp->setPagination(false);

			// Get models, write to a file
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
		catch(Exception $ex)
		{
			throw new CHttpException(500, "INVH2: Inventory Historic Print CSV failed with error " . $ex);
		}
	}
	
	/**
	 * Pull the csv from the session and send it to the user.
	 */
	public function actionExportFile()
	{
		try
		{
			Yii::app()->request->sendFile('export.csv',Yii::app()->user->getState('export'));
			Yii::app()->user->clearState('export');
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "INVH3: Inventory Historic File Export failed with error " . $ex);
		}
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
				throw new CHttpException(500, "INVH4: Inventory Historic Time Log Import failed.");
			}
		}
		catch(Exception $e)
		{
			// If an error occured, nothing is inserted into the database and the text file is left alone. 
			$transaction->rollback();
		}
	}
}
