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
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Videos'),
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
		$dcoument = new Documents;
		
		$document->scenario = 'training';
		
		if($video->attributes = Yii::app()->request->getPost('Videos'))
		{
			$document->type = 'video';
			$document->file = CUploadedFile::getInstance($document, 'file');
			
			// Validate both $video and $file at the same time.
			$videoCheck = $video->validate();
			$fileCheck = $document->validate();
			$valid = $videoCheck && $fileCheck;
		
			if($valid)
			{
				if($document->save(false))
				{
					$video->documentid = $document->primaryKey;
					echo $video->documentid;
					if($video->save())
						$this->redirect(array('view', 'id'=>$video->videoid));
				}
			}
		}

		$this->render('create', array('video'=>$video, 'file'=>$document));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$video = $this->loadModel($id, 'Videos');
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

					if($video->save())
						$this->redirect(array('view','id'=>$video->videoid));
				}
			}
		}

		$this->render('update', array('video'=>$video, 'file'=>$file));
	}
}
