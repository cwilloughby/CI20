<?php

class DocumentsController extends Controller
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'Documents'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'Documents'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Documents'),
			'delete' => array('class' => 'DeleteAction', 'modelClass' => 'Documents')
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Documents;

		if($model->attributes = Yii::app()->request->getPost('Documents'))
		{
			if($model->save())
				$this->redirect(array('view','id'=>$model->documentid));
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
		$model=$this->loadModel($id, 'Documents');

		if($model->attributes = Yii::app()->request->getPost('Documents'))
		{
			if($model->save())
				$this->redirect(array('view','id'=>$model->documentid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
}
