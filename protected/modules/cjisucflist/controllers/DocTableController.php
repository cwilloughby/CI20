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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if($model->attributes = Yii::app()->request->getPost('DocTable'))
		{
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if($model->attributes = Yii::app()->request->getPost('DocTable'))
		{
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('searchableTable'));
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
		$fileContent = file_get_contents($path . "." . $ext);
		$file = $name . "." . $ext;

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
		header("Content-disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		echo $fileContent;
		exit;
	}
}
