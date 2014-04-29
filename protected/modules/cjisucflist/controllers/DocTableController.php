<?php

class DocTableController extends Controller
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
	public function actionViewFileRecord($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id, "DocTable"),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateFileRecord()
	{
		$model=new DocTable;
		$model->scenario = 'create';
		
		if($model->attributes = Yii::app()->request->getPost('DocTable'))
		{
			$model->fileUp = CUploadedFile::getInstance($model,'fileUp');
			if($model->validate())
			{
				$model->fileUp = CUploadedFile::getInstance($model,'fileUp');
				$model->uploadFile();
				$model->extension = $model->fileUp->extensionName;
				$model->save(false);
				$this->redirect(array('viewFileRecord','id'=>$model->id));
			}
		}

		$this->render('upload',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateFileRecord($id)
	{
		$model=$this->loadModel($id, "DocTable");
		$model->scenario = 'update';
		
		if(($model->attributes = Yii::app()->request->getPost('DocTable')) && $model->validate())
		{
			// If a new file is being uploaded.
			if(isset($model->fileUp))
			{
				$model->fileUp = CUploadedFile::getInstance($model,'fileUp');
				$model->uploadFile();
				$model->extension = $model->fileUp->extensionName;
				$model->save(false);
			}
			// If a file record is being updated without a change to the uploaded file.
			else
			{
				$model->save(false);
			}
			$this->redirect(array('viewFileRecord','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteFileRecord($id)
	{
		$this->loadModel($id, "DocTable")->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('searchableFileTable'));
	}

	/**
	 * Manages all models.
	 */
	public function actionSearchableFileTable()
	{
		$model=new DocTable('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocTable']))
			$model->attributes=$_GET['DocTable'];

		$this->render('searchableTable',array(
			'model'=>$model,
		));
	}
	
	/**
	 * This function is used by the download links to display the file for the user.
	 */
	public function actionDisplayOnline($path, $name)
	{
		if(!file_exists($path))
			throw new CHttpException(404, 'The file ' . $name . ' was not found!');
		
		header('Content-disposition: inline');
		header('Content-type: application/pdf');
		readfile($path);
		exit;
	}
	
	/**
	 * This function is used to create a special type of IT news post for announcing new CJIS builds.
	 */
	public function actionCreateCjisNews()
	{
		$model = new DocTable;
		$model->scenario = 'cjisNews';
		
		if($model->attributes = Yii::app()->request->getPost('DocTable') && $model->validate())
		{
			$model->fileUp = CUploadedFile::getInstance($model,'fileUp');
			$model->uploadFile();
			
			$news = new News;
			
			// Grab the id for the "IT news" type.
			$type = Yii::app()->db->createCommand()
				->select('typeid')
				->from('ci_news_type')
				->where('type=:type', array(':type'=>'IT News'))
				->queryAll();
			
			// Set the news type for the new record.
			$news->typeid = $type[0]['typeid'];

			// Format the body of the news post.
			$news->news = "Build #: " . $model->buildNum . "&nbsp;&nbsp;&nbsp;&nbsp;" . CHtml::link('View Doc',
					Yii::app()->createUrl("cjisucflist/doctable/displayonline", array("path"=>"$model->path", "name"=>"$model->name")))
				. "<br/>Release Date: " . $model->releaseDate 
				. "<br/><br/>Features: " . $model->features;
			
			if($news->validate())
			{
				$news->save(false);
				$this->redirect(array('/news/news/view','id'=>$news->newsid));
			}
		}
		
		$this->render('createCjisNews',array(
			'model'=>$model,
		));
	}
}
