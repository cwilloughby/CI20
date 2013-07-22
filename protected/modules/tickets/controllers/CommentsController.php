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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Comments;
		$file=new Documents;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if($model->attributes = Yii::app()->request->getPost('Comments'))
		{
			if($model->save())
				$this->redirect(array('view','id'=>$model->commentid));
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
		// To prevent integrity constraint violations, we have to see if the comment is connected to 
		// a trouble ticket on the bridge table.
		$bridge = TicketComments::model()->find('commentid=:selected_id',array(':selected_id'=>$id));
		if($bridge)
		{
			// Delete the connection.
			$bridge->delete();
		}
		
		// Now we can delete the comment.
		$this->loadModel($id)->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Comments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comments('search');
		$model->unsetAttributes();  // clear any default values
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		if(isset($_GET['Comments']))
		{
			$model->attributes=$_GET['Comments'];
			
			if((int)$model->datecreated)
			{
				$model->datecreated = date('Y-m-d', strtotime($model->datecreated));
			}
		}

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
		$model=Comments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
