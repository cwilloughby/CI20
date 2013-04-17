<?php

class EvidenceController extends Controller
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
		// Grab all the case files for this piece of evidence.
		$cases=new CaseSummary('search');
		$cases->unsetAttributes();  // clear any default values
		if(isset($_GET['CaseSummary']))
			$cases->attributes=$_GET['CaseSummary'];
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'cases'=>$cases,
		));
	}

	/**
	 * Creates a new model or models.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(isset($_POST['Evidence']))
		{
			if($this->saveEvidence($_POST['Evidence']))
			{
				$this->redirect(array('admin'));
			}
		}

		$model = new Evidence;

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/*
	 * actionCreate returns an array, but model->save() can only save one model at a time.
	 * So this function is used to split the array into individual models.
	 * @param array $formData contains all the rows from the form in an array.
	 */
	protected function saveEvidence($formData)
	{
		if(empty($formData))
			return false;

		$idx = 0;

		// Loop through the array, splitting it into individual models and saving those models. 
		foreach($formData['exhibitno'] as $ex)
		{
			$model = new Evidence;

			// The attributes can be found at the same postion in the formData.
			$model->caseno = $formData['caseno'][$idx];
			$model->hearingtype = $formData['hearingtype'][$idx];
			$model->hearingdate = date('Y-m-d', strtotime($formData['hearingdate'][$idx]));
			$model->exhibitno = $ex;
			$model->evidencename = $formData['evidencename'][$idx];
			$model->comment = $formData['comment'][$idx];
			$model->exhibitlist = $formData['exhibitlist'][$idx];
			
			if(!$model->save())
				return false;
			
			// Record the evidence create event.
			$log = new Log;
			$log->tablename = 'ci_evidence';
			$log->event = 'Evidence Created';
			$log->userid = Yii::app()->user->getId();
			$log->tablerow = $model->getPrimaryKey();
			$log->save(false);
			
			$idx++;
		}
		return true;
	}

	/**
	 * Updates a particular model.
	 * If the update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Evidence']))
		{
			$model->attributes=$_POST['Evidence'];
			$model->exhibitlist = $_POST['Evidence']['exhibitlist'];
			
			if((int)$model->hearingdate)
			{
				$model->hearingdate = date('Y-m-d', strtotime($model->hearingdate));
			}
			
			if($model->save())
			{
				// Record the evidence update event.
				$log = new Log;
				$log->tablename = 'ci_evidence';
				$log->event = 'Evidence Updated';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$model->evidenceid));
			}
		}
		
		$model->hearingdate = date('m/d/Y', strtotime($model->hearingdate));
		
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
		$dataProvider=new CActiveDataProvider('Evidence');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Evidence('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Evidence']))
		{
			$model->attributes=$_GET['Evidence'];
			
			if((int)$model->dateadded)
			{
				$model->dateadded = date('Y-m-d', strtotime($model->dateadded));
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
		$model=Evidence::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='evidence-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
