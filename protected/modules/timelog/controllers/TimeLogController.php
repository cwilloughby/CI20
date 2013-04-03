<?php

class TimeLogController extends Controller
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TimeLog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TimeLog']))
		{
			$model->attributes=$_POST['TimeLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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
		// First unset the cookies for dates.
		unset(Yii::app()->request->cookies['from_date']);  
		unset(Yii::app()->request->cookies['to_date']);

		$model = new TimeLog('search');  // your model
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['TimeLog']))
		{
			$model->attributes=$_GET['TimeLog'];
			
			if(isset($_GET['from_date']) || isset($_GET['to_date']))
			{
				Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_GET['from_date']);  // define cookie for from_date
				Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_GET['to_date']);
				$model->from_date = $_GET['from_date'];
				$model->to_date = $_GET['to_date'];

				if((int)$model->from_date)
				{
					$model->from_date = date('Y-m-d', strtotime($model->from_date));
				}
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
		$model=TimeLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='time-log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
