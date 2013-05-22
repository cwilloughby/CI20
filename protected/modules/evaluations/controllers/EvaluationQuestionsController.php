<?php

class EvaluationQuestionsController extends Controller
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
		$model=new EvaluationQuestions;
		
		if(isset($_POST['EvaluationQuestions']))
		{
			// Find the user's department.
			$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);
			$model->attributes=$_POST['EvaluationQuestions'];
			$model->departmentid = $department->departmentid;
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->questionid));
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
		$model=$this->loadModel($id);

		if(isset($_POST['EvaluationQuestions']))
		{
			$model->attributes=$_POST['EvaluationQuestions'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->questionid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Questions are never deleted, just disabled.
	 * @param integer $id the ID of the model to be disabled
	 */
	public function actionDisable($id)
	{
		$model = $this->loadModel($id);
		$model->active = 2;
		
		if($model->update())
			$this->redirect(array('view','id'=>$model->questionid));
	}

	/**
	 * Enable a previously disabled question.
	 * @param integer $id the ID of the model to be enabled
	 */
	public function actionEnable($id)
	{
		$model = $this->loadModel($id);
		$model->active = 1;
		
		if($model->update())
			$this->redirect(array('view','id'=>$model->questionid));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EvaluationQuestions');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EvaluationQuestions('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EvaluationQuestions']))
			$model->attributes=$_GET['EvaluationQuestions'];

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
		$model=EvaluationQuestions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
