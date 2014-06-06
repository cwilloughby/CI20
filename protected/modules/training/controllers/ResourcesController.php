<?php

class ResourcesController extends Controller
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'TrainingResources'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'TrainingResources'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'TrainingResources'),
			'delete' => array('class' => 'DeleteAction', 'modelClass' => 'TrainingResources')
		);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$resource = new TrainingResources;
		$document = new Documents;
		$document->scenario = 'trainingSubmit';
		$document->uploadType = 'training resource';
		
		if($resource->attributes = Yii::app()->request->getPost('TrainingResources'))
		{
			$document->file = CUploadedFile::getInstance($document, 'file');
			$resource->poster = CUploadedFile::getInstance($resource, 'poster');
			
			// Validate the resource and make sure a file was uploaded.
			if($resource->validate() && isset($document->file))
			{
				$document->uploadType = 'training resource';
				$document->setDocumentAttributes();
				
				// Validate the file then make sure a record of it is saved.
				if($document->validate())
				{
					if($document->save(false))
					{
						// Create the folder if it does not exist.
						if(!is_dir($document->path))
							mkdir($document->path, 0777, true);
						// Set the complete path.
						$document->path = $document->path . $document->documentname;
						// Upload the file to the server.
						$document->file->saveAs($document->path, 'false');
						// Link the new foreign key.
						$resource->documentid = $document->primaryKey;
						$resource->uploadImage();
						
						if($resource->save())
							$this->redirect('/training/training/typeIndex');
					}
				}
			}
		}

		$this->render('create', array('resource'=>$resource, 'document'=>$document));
	}
}
