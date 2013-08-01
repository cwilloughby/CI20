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
	
	// External Actions
	function actions()
	{
		return array(
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'CaseSummary'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'CaseSummary'),
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
			$this->forward('changeAttorneys');
		else if(isset($_POST['Evidence']))
			$this->forward('changeEvidence');
		
		$attorneys = new Attorney('search');
		$attorneys->unsetAttributes();  // clear any default values
		$attorneys->attributes = Yii::app()->request->getQuery('Attorney');
		
		$evidence=new Evidence('search');
		$evidence->unsetAttributes();  // clear any default values
		$evidence->attributes = Yii::app()->request->getQuery('Evidence');
		
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
		
		if($summary->attributes = Yii::app()->request->getPost('CaseSummary'))
		{
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
					// Add the attorneys to the database if they don't already exist and associate them to the new case summary.
					$attorney->saveAttorneys($_POST['Attorney'], $summary->summaryid);

					$this->redirect(array('view','id' => $summary->summaryid));
				}
			}
		}

		$this->render('create', array('summary' => $summary,'defendant' => $defendant,'case' => $case,'attorney' => $attorney));
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

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
			// Add the attorneys to the database if they don't already exist and associate them to the case summary.
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
	
	public function actionEvidenceManager()
	{
		$this->render('advanced');
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
