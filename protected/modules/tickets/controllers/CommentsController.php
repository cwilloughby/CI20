<?php

class CommentsController extends Controller
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'Comments'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'Comments'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Comments'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'Comments'),
		);
	}

	/**
	 * Creates a new model. Makes use of the beforeSave event in the model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Comments;
		$file=new Documents;

		if($model->attributes = Yii::app()->request->getPost('Comments'))
		{
			$file->attributes=$_POST['Documents'];
			
			// validate BOTH $model and $file at the same time
			$valid=$model->validate() && $file->validate();
			
			if($valid)
			{
				$file->attachment=CUploadedFile::getInstance($file,'attachment');
				$temp = $model->content;
				
				if(isset($file->attachment))
				{
					$file->save(false);
					// This description will only allow the link to work on the website.
					$model->content .= "\nAttachment: " 
						. CHtml::link($file->documentname,array('/../../../../assets/uploads/' 
							. $file->uploaddate . '/' . $file->documentname));
					// This description will only be used for the email so the link will work.
					$temp .= "\nAttachment: <a href='file:///" . $file->path . "'>" . $file->documentname . "</a>";
				}
				
				$model->save(false);
				$this->redirect(array('view','id'=>$model->commentid));
			}
		}

		$this->render('create',array(
			'model'=>$model, 'file'=>$file
		));
	}

	/**
	 * Deletes a particular model. Makes use of the beforeDelete event in the model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		// Now we can delete the comment.
		$this->loadModel($id, 'Comments')->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
