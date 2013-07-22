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
	
	// External Actions
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'EvaluationQuestions'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'EvaluationQuestions'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'EvaluationQuestions'),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EvaluationQuestions;
		
		if($model->attributes = Yii::app()->request->getPost('EvaluationQuestions'))
		{
			// Find the user's department.
			$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);
			$model->departmentid = $department->departmentid;
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->questionid));
		}

		$this->render('create',array(
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EvaluationQuestions('search');
		$model->unsetAttributes();  // clear any default values
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
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
