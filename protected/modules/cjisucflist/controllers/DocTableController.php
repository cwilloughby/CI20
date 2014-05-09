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
	 * View the details of a file record. The DocTable model class is what actually loads the record.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewFileRecord($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id, "DocTable"),
		));
	}

	/**
	 * This function shows the create form and processes it, allowing the user to enter the details 
	 * of the file record and upload the file itself.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateFileRecord()
	{
		$model=new DocTable;
		$model->scenario = 'create';
		
		if(($model->attributes = Yii::app()->request->getPost('DocTable')) && $model->validate())
		{
			$model->uploadFile();
			$model->save(false);
			$this->redirect(array('viewFileRecord','id'=>$model->id));
		}
				
		$this->render('upload',array(
			'model'=>$model,
		));
	}

	/**
	 * This function shows the update form and processes it, allowing the user to change the details
	 * of a file record and even upload a new file for that record to use.
	 * If update is successful, the browser will be redirected to the 'viewFileRecord' page.
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
				$model->uploadFile();
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
	 * This function is used to delete a file record.
	 * The DocTable model class does the actual deleting, but this function tells it what to delete.
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
	 * This function displays the search form and the table where the results are shown. 
	 * The DocTable model class does the actual searching.
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
	 * The document links call this function to open the file in the user’s browser.
	 */
	public function actionDisplayOnline($path, $name)
	{
		if(!file_exists($path))
			throw new CHttpException(404, 'The file ' . $name . ' was not found!');
		
		try
		{
			if(ini_get('zlib.output_compression'))
				ini_set('zlib.output_compression', 'Off');

			header('Content-type: application/pdf');
			header('Content-disposition: inline');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($path));
			readfile($path);
			exit;
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, 'An unexpected error occurred while sending the file ' . $name);
		}
	}
	
	/**
	 * This function displays the cjis news post form and processes it.
	 * the release number, release date, and document are posted to it from the ViewFileRecord view page.
	 */
	public function actionCreateCjisNews()
	{
		$model = new DocTable;
		$model->scenario = 'cjisNews';
		
		/*
		 * Normally the presence of POST data is what causes validation to be performed.
		 * But this time, POST data is passed in from the previous view page when this page is first loaded.
		 * So we need to perform a check to see if this is the first time the page is loaded, 
		 * to prevent incorrect validation errors.
		 */
		if(isset($_POST['firstView']))
			$model->attributes = Yii::app()->request->getPost('DocTable');
		else if(($model->attributes = Yii::app()->request->getPost('DocTable')) && $model->validate())
		{
			$news = new News;

			try
			{
				// Grab the id for the "IT news" type.
				$type = Yii::app()->db->createCommand()
					->select('typeid')
					->from('ci_news_type')
					->where('type=:type', array(':type'=>'IT News'))
					->queryAll();
			}
			catch(Exception $ex)
			{
				throw new CDbException('Error retrieving news type from database.', PDO::errorInfo());
			}

			// Set the news type for the new record.
			$news->typeid = $type[0]['typeid'];
			
			// If a release date and release number were provided, the cjis build news format will be used.
			if(isset($_POST['release_date']) && isset($_POST['release_num']))
			{
				// Format the body of the news post using the cjisBuildNewsBody view.
				$news->news = $this->renderPartial('cjisBuildNewsBody', array('model' => $model), true);
			}
			// Otherwise use the generic cjis news post format.
			else
			{
				// Format the body of the news post using the cjisNewsBody view.
				$news->news = $this->renderPartial('cjisNewsBody', array('model' => $model), true);
			}

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
