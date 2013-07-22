<?php

class IssueTrackerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	
	// External Actions
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'IssueTracker'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'IssueTracker'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'IssueTracker'),
			'delete' => array('class' => 'DeleteAction', 'modelClass' => 'IssueTracker')
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new IssueTracker;

		if($model->attributes = Yii::app()->request->getPost('IssueTracker'))
		{
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new IssueTracker('search');
		$model->unsetAttributes();  // clear any default values
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		if(isset($_GET['IssueTracker']))
			$model->attributes=$_GET['IssueTracker'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Reads in the csv file, creating or updating the records as needed.
	 * If import is successful, the browser will be redirected to the 'admin' page.
	 */
	public function actionImportIssues()
	{
		$myFile = "C:/Users/cwilloughby/Desktop/JIRA_Open_UCFs.csv";
		$fh = fopen($myFile, 'r');
		$priority = 1;
		
		// A priority number is not provided in the csv. So these steps are performed to set a default.
		// First we need to find the largest number in the priority column.
		$criteria = new CDbCriteria;
		$criteria->select = 'max(priority) AS priority';
		$row = IssueTracker::model()->find($criteria);
		// If there is no priority number set.
		if(is_null($row->priority))
		{
			// The next inserted record will have priority 1.
			$priority = 1;
		}
		else
		{
			// The next inserted record will have a priority of the largest plus 1.
			$priority = $row->priority + 1;
		}
		
		while(!feof($fh)) 
		{
			$tmp = fgetcsv($fh, 1024);

			if((!empty($tmp[1])) && ($tmp[1] != 'Key'))
			{
				// Check if the record is already in the database.
				$check = IssueTracker::model()->findByPk($tmp[1]);
				if(is_null($check))
				{
					// It is not in the database, so a new record will be made for it.
					$model = new IssueTracker;
					// If the issue does not have a resolution of 'Fixed'
					if($tmp[6] != 'Fixed')
					{
						$model->priority = $priority;
						$priority++;
					}
				}
				else
				{
					// It is in the database, so the record will be updated.
					$model = $check;
				}
				
				$model->type = $tmp[0];
				$model->key = $tmp[1];
				$model->summary = $tmp[2];
				$model->assigned = $tmp[3];
				$model->reporter = $tmp[4];
				$model->resolution = $tmp[6];
				$model->created = date("Y-m-d", STRTOTIME($tmp[7]));
				$model->updated = date("Y-m-d", STRTOTIME($tmp[8]));
				$model->description = $tmp[9];
				$model->originalestimate = $tmp[10];
				$model->remainingestimate = $tmp[11];
				$model->timespent = $tmp[12];
				
				$model->save();
			}
		}
		
		fclose($fh);
		
		$this->redirect(array('admin'));
	}

	public function actionChangePriorities()
	{	
		// Handle the POST request data submission.
		if(isset($_POST['ChangePriorities']))
		{
			// Since we converted the Javascript array to a string,
			// convert the string back to a PHP array.
			$models = explode(',', $_POST['ChangePriorities']);

			for($i = 0; $i < sizeof($models); $i++)
			{
				if($issue = IssueTracker::model()->find('id=:id AND priority IS NOT NULL', array(':id'=>$models[$i])))
				{
					// Use updateByPK to avoid running model validate
					$issue->updateByPk($models[$i], array("priority" => $i));
				}
			}
		}
		// Handle the regular model order view.
		else
		{
			$dataProvider = new CActiveDataProvider('IssueTracker', array(
				'pagination' => false,
				'criteria' => array(
					'condition' => 'priority IS NOT NULL',
					'order' => 'priority ASC, id DESC',
				),
			));

			$this->render('changepriorities',array(
				'dataProvider' => $dataProvider,
			));
		}
	}
	
	function actionPortlet()
	{
		if(!is_null($_GET['IssueTracker']))
			$results = $this->widget('IssueSearcher', array('search'=>$_GET['IssueTracker']), true);
		else
			$results = $this->widget('IssueSearcher', array('search'=>null), true);
		echo $results;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=IssueTracker::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
