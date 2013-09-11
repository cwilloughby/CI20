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
	 * This function returns a list of external actions.
	 * External actions are identical functions shared by many controllers throughout ci2.
	 * The code for the external actions can be found in protected\components
	 * @return array
	 */
	function actions()
	{
		return array(
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'CrtCase'),
			'create' => array('class' => 'CreateAction', 'modelClass' => 'CrtCase'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'CrtCase'),
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
			'model'=>$this->loadModel($id, 'CrtCase'),
			'cases'=>$cases,
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
			$this->loadModel($id, 'CrtCase')->delete();
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
	 * This function is used to change an existing case file's defendant.
	 * @param integer $id the id of the summary
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
				$this->redirect(array('/evidence/casesummary/view','id'=>$summary->summaryid));
		}
		else
		{
			$case = $this->loadModel($summary->caseno, 'CrtCase');
		}

		$this->render('changeCourtCase',array('summary' => $summary, 'case' => $case));
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
