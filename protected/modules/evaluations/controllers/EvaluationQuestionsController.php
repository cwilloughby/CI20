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
	 * This function returns a list of external actions.
	 * External actions are identical functions shared by many controllers throughout ci2.
	 * The code for the external actions can be found in protected\components
	 * @return array
	 */
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'EvaluationQuestions'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'EvaluationQuestions'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'EvaluationQuestions'),
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
	 * This is so that old evaluations that used that question won't have missing data.
	 * @param integer $id the ID of the model to be disabled
	 */
	public function actionDisable($id)
	{
		$model = $this->loadModel($id, 'EvaluationQuestions');
		$model->active = 2;

		if($model->update())
			$this->redirect(array('view','id'=>$model->questionid));
		else
			throw new CHttpException(500, "Internal error. Failed to disable question.");
	}

	/**
	 * Enable a previously disabled question.
	 * @param integer $id the ID of the model to be enabled
	 */
	public function actionEnable($id)
	{
		$model = $this->loadModel($id, 'EvaluationQuestions');
		$model->active = 1;

		if($model->update())
			$this->redirect(array('view','id'=>$model->questionid));
		else
			throw new CHttpException(500, "Internal error. Failed to enable question.");
	}
}
