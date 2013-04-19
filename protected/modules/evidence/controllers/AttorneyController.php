<?php

class AttorneyController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		// Grab all the case files for this attorney.
		$cases=new CaseSummary('search');
		$cases->unsetAttributes();  // clear any default values
		if(isset($_GET['CaseSummary']))
			$cases->attributes=$_GET['CaseSummary'];
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'cases'=>$cases
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Attorney;

		if(isset($_POST['Attorney']))
		{
			$model->attributes=$_POST['Attorney'];
			if($model->save())
			{
				// Record the attorney create event.
				$log = new Log;
				$log->tablename = 'ci_attorney';
				$log->event = 'Attorney Created';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$model->attyid));
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Attorney']))
		{
			$model->attributes=$_POST['Attorney'];
			if($model->save())
			{
				// Record the attorney update event.
				$log = new Log;
				$log->tablename = 'ci_attorney';
				$log->event = 'Attorney Updated';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$model->attyid));
			}
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
		try
		{
			$this->loadModel($id)->delete();
		}
		catch(Exception $ex)
		{
			throw new CHttpException('the attorney cannot be deleted, because it is still assigned to a case.');
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Attorney');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Attorney('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Attorney']))
			$model->attributes=$_GET['Attorney'];

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
		$model=Attorney::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='attorney-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
