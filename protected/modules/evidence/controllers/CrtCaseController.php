<?php

class CrtCaseController extends Controller
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
		// Grab all the case files for this case.
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CrtCase;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CrtCase']))
		{
			$model->attributes=$_POST['CrtCase'];
			if($model->save())
			{
				// Record the court case create event.
				$log = new Log;
				$log->tablename = 'ci_crt_case';
				$log->event = 'Court Case Created';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$model->caseno));
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

		if(isset($_POST['CrtCase']))
		{
			$model->attributes=$_POST['CrtCase'];
			if($model->save())
			{
				// Record the court case update event.
				$log = new Log;
				$log->tablename = 'ci_crt_case';
				$log->event = 'Court Case Updated';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$model->caseno));
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
			throw new CHttpException('the case cannot be deleted, because it still has evidence assigned to it.');
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
		$dataProvider=new CActiveDataProvider('CrtCase');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CrtCase('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CrtCase']))
			$model->attributes=$_GET['CrtCase'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/*
	 * This function is used to change an existing case file's defendant.
	 */
	public function actionChangeCourtCase($id)
	{
		$summary = CaseSummary::model()->findByPk($id);
		
		if(isset($_POST['CrtCase']))
		{
			$case = new CrtCase;
			$case->attributes = $_POST['CrtCase'];
			
			// Check to see if the new case exists in the crtcase table already.
			// If it does, return it's caseno, otherwise create the case and then return the new caseno.
			$summary->caseno = $case->saveCase($case);
			
			// Save the changed to the case summary
			if($summary->save())
			{
				// Record the case summary update event.
				$log = new Log;
				$log->tablename = 'ci_case_summary';
				$log->event = 'Case Summary Case Changed';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $id;
				$log->save(false);
				
				$this->redirect(array('/evidence/casesummary/view','id'=>$summary->summaryid));
			}
		}
		else
		{
			$case = $this->loadModel($summary->caseno);
		}

		$this->render('changeCourtCase',array(
			'summary' => $summary,
			'case' => $case
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CrtCase::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='crt-case-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
