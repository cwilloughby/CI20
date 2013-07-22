<?php

class VideosController extends Controller
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'Videos'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'Videos'),
			'delete' => array('class' => 'DeleteAction', 'modelClass' => 'Videos')
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$video = new Videos;
		$file = new Documents;
		
		$file->scenario = 'training';
		
		if($video->attributes = Yii::app()->request->getPost('Videos'))
		{
			$file->video = CUploadedFile::getInstance($file,'video');
			
			// Validate both $video and $file at the same time.
			$videoCheck = $video->validate();
			$fileCheck = $file->validate();
			$valid = $videoCheck && $fileCheck;
		
			if($valid)
			{
				if($file->save(false))
				{
					$video->documentid = $file->primaryKey;
					echo $video->documentid;
					if($video->save())
						$this->redirect(array('view','id'=>$video->videoid));
				}
			}
		}

		$this->render('create',array(
			'video'=>$video,
			'file'=>$file,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$video = $this->loadModel($id);
		$file = Documents::model()->findByPk($video->documentid);
		
		if($video->attributes = Yii::app()->request->getPost('Videos'))
		{
			$file->video = CUploadedFile::getInstance($file,'video');
			
			// Validate both $video and $file at the same time.
			$videoCheck = $video->validate();
			$fileCheck = $file->validate();
			$valid = $videoCheck && $fileCheck;
		
			if($valid)
			{
				if($file->save(false))
				{
					$video->documentid = $file->primaryKey;
					echo $video->documentid;
					if($video->save())
						$this->redirect(array('view','id'=>$video->videoid));
				}
			}
		}

		$this->render('update',array(
			'video'=>$video,
			'file'=>$file,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Videos('search');
		$model->unsetAttributes();  // clear any default values
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		if(isset($_GET['Videos']))
			$model->attributes=$_GET['Videos'];

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
		$model=Videos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
