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
				$model->name = $model->fileUp->name;
				$model->extension = $model->fileUp->extensionName;
				$model->setPath();
				$model->save(false);
				$model->fileUp->saveAs($model->path);
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
				$model->name = $model->fileUp->name;
				$model->extension = $model->fileUp->extensionName;
				$model->setPath();
				$model->save(false);
				$model->fileUp->saveAs($model->path);
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
	 * This function is used by the download links to send the file to the user.
	 */
	public function actionDownload($path, $name, $ext)
	{
		if(!file_exists($path))
			throw new CHttpException(404, 'The file ' . $name . ' was not found!');
		
		try
		{
			$size = filesize($path);
			$fileContent = file_get_contents($path);

			$supportedMimeTypes=array(
				"doc" => "application/msword",
				"docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
				"ppt" => "application/vnd.ms-powerpoint",
				"xls" => "application/vnd.ms-excel",
				"xlsx"=> "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
				"zip" => "application/zip",
			);

			// Select the correct MIME type.
			if(array_key_exists($ext, $supportedMimeTypes))
				$mimeType=$supportedMimeTypes[$ext];
			else
				$mimeType="text/plain";

			// Turn off output buffering to decrease cpu usage.
			@ob_end_clean(); 

			// Required for IE, otherwise Content-Disposition could be ignored.
			if(ini_get('zlib.output_compression'))
				ini_set('zlib.output_compression', 'Off');

			header('Content-Type: ' . $mimeType);
			header('Content-disposition: attachment; filename="' . $name . '"');
			header("Content-Length: " . $size);
			header("Content-Transfer-Encoding: binary");
			header("Pragma: no-cache");
			echo $fileContent;
			exit;
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "An unknown error has occurred while trying to download the file " . $name);
		}
	}
}
