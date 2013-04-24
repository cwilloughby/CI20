<?php

class CaseSummaryController extends Controller
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
		$case = $this->loadModel($id);
		
		if(isset($_POST['Attorney']))
		{
			$this->forward('changeAttorneys');
		}
		else if(isset($_POST['Evidence']))
		{
			$this->forward('changeEvidence');
		}
		
		$attorneys = new Attorney('search');
		$attorneys->unsetAttributes();  // clear any default values
		if(isset($_GET['Attorney']))
			$attorneys->attributes=$_GET['Attorney'];
		
		$evidence=new Evidence('search');
		$evidence->unsetAttributes();  // clear any default values
		if(isset($_GET['Evidence']))
			$evidence->attributes=$_GET['Evidence'];
		
		$this->render('view',array(
			'case' => $case,
			'attorneys' => $attorneys,
			'evidence' => $evidence,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$summary = new CaseSummary;
		$defendant = new Defendant;
		$case = new CrtCase;
		$attorney = new Attorney;
		
		if(isset($_POST['CaseSummary']))
		{
			$summary->attributes = $_POST['CaseSummary'];
			$defendant->attributes = $_POST['Defendant'];
			$case->attributes = $_POST['CrtCase'];
			
			$valid = $defendant->validate(); 
			$valid = $case->validate() && $valid;
			
			$idx = 0;

			// Loop through the array, splitting it into individual models and validate those models. 
			foreach($_POST['Attorney']['fname'] as $ex)
			{
				$attorney->fname = $_POST['Attorney']['fname'][$idx];
				$attorney->lname = $_POST['Attorney']['lname'][$idx];
				$attorney->barid = $_POST['Attorney']['barid'][$idx];
				
				$valid = $attorney->validate() && $valid;
			}
			
			if($valid)
			{
				// Save the defendant and the case in their corresponding tables if they do not exist and return
				// the defid and the caseno for the summary validation. If they already exist, then these functions
				// will just return the existing defid and caseno.
				$summary->defid = $defendant->saveDefendant($defendant);
				$summary->caseno = $case->saveCase($case);

				if($summary->save())
				{
					// Record the case summary create event.
					$log = new Log;
					$log->tablename = 'ci_case_summary';
					$log->event = 'Case Summary Created';
					$log->userid = Yii::app()->user->getId();
					$log->tablerow = $summary->getPrimaryKey();
					$log->save(false);

					// Add the attorneys to the database if they don't already exist and associate them to the new case summary.
					$attorney->saveAttorneys($_POST['Attorney'], $summary->summaryid);

					$this->redirect(array('view','id' => $summary->summaryid));
				}
			}
		}

		$this->render('create', array(
			'summary' => $summary,
			'defendant' => $defendant,
			'case' => $case,
			'attorney' => $attorney
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$summary = $this->loadModel($id);

		if(isset($_POST['CaseSummary']))
		{
			$summary->attributes = $_POST['CaseSummary'];
			if($summary->save())
			{
				// Record the case summary update event.
				$log = new Log;
				$log->tablename = 'ci_case_summary';
				$log->event = 'Case Summary Updated';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $summary->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$summary->summaryid));
			}
		}

		$this->render('update',array(
			'summary'=>$summary,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		// Delete all records on the attorney bridge table that have this summary id.
		CaseAttorneys::model()->deleteAll('summaryid =' . $id);
		$this->loadModel($id)->delete();
		
		// Log the delete event.
		$log = new Log;
		$log->tablename = 'ci_case_summary';
		$log->event = 'Case Summary Deleted';
		$log->userid = Yii::app()->user->getId();
		$log->tablerow = $id;
		$log->save(false);

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CaseSummary');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CaseSummary('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CaseSummary']))
		{
			$model->attributes=$_GET['CaseSummary'];
			
			if((int)$model->dispodate)
			{
				$model->dispodate = date('Y-m-d', strtotime($model->dispodate));
			}
			if((int)$model->indate)
			{
				$model->indate = date('Y-m-d', strtotime($model->indate));
			}
			if((int)$model->outdate)
			{
				$model->outdate = date('Y-m-d', strtotime($model->outdate));
			}
			if((int)$model->destructiondate)
			{
				$model->destructiondate = date('Y-m-d', strtotime($model->destructiondate));
			}
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * This function allows the user to change or add evidence to a case.
	 * @param integer $id the summary ID
	 */
	public function actionChangeEvidence($id)
	{
		$summary = $this->loadModel($id);
		$evidence = new Evidence;
		
		if(isset($_POST['Evidence']))
		{
			// Add the evidence to the database.
			$evidence->saveEvidence($_POST['Evidence']);
				
			$this->redirect(array('view','id'=>$summary->summaryid));
		}

		$this->render('changeEvidence',array(
			'summary' => $summary,
			'evidence' => $evidence
		));
	}
	
	/**
	 * This function allows the user to change or add attorneys to a case.
	 * @param integer $id the summary ID
	 */
	public function actionChangeAttorneys($id)
	{
		$summary = $this->loadModel($id);
		$attorney = new Attorney;
		
		if(isset($_POST['Attorney']))
		{
			// Add the attorneys to the database if they don't already exist 
			// and associate them to the case summary.
			// If they already exist, then just associate it to the case summary.
			$attorney->saveAttorneys($_POST['Attorney'], $summary->summaryid);
				
			$this->redirect(array('view','id'=>$summary->summaryid));
		}
	}
	
	/**
	 * Removes a particular attorney from a case summary.
	 * @param integer $sid the summary ID
	 * @param integer $aid the attorney ID
	 */
	public function actionDeleteAttorneyFromCase($sid, $aid)
	{
		// Delete the record on the attorney bridge table that has this summaryid and attyid.
		CaseAttorneys::model()->deleteByPk(array('summaryid' => $sid, 'attyid' => $aid));
		
		// Log the delete event.
		$log = new Log;
		$log->tablename = 'ci_case_attorneys';
		$log->event = 'Attorney Removed From Case';
		$log->userid = Yii::app()->user->getId();
		$log->tablerow = $sid . ", " . $aid;
		$log->save(false);
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CaseSummary::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='case-summary-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
