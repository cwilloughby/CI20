<?php

class DocumentProcessorController extends Controller
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'Documents'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Documents'),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		try
		{
			// Create Document model object.
			$document = new Documents;
			if(isset($_GET['uploadType']))
				$document->uploadType = $_GET['uploadType'];
			
			// If the form was posted.
			if(isset($_POST['Documents'])) 
			{	
				// Read in the current file.
				$document->file = CUploadedFile::getInstance($document, 'file');
				$document->setDocumentAttributes();
				// Validate attributes.
				if($document->validate())
				{
					// Upload file to server.
					$document->uploadFile();
					// Call function to read the file’s content and metadata.
					$document->setModelContentsAndMetadata();
					// Save the Document Model
					$document->save(false);
				}
			}

			// Call view to render the upload form.
			$this->render('create', array(
				'document' => $document,
			));
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "DPC1: Document upload form failed with error " . $ex);
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id, 'Documents');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documents']))
		{
			$model->attributes=$_POST['Documents'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->documentid));
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
	public function actionDelete($id)
	{
		$this->loadModel($id, 'Documents')->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Documents');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documents-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
