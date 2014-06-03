<?php

class HrPolicyController extends Controller
{
	/**
	 * @var string the default layout for the views.
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'HrPolicy'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'HrPolicy'),
			'createpolicy' => array('class' => 'CreateAction', 'modelClass' => 'HrPolicy', 'redirectTo' => 'index'),
			'updatepolicy' => array('class' => 'UpdateAction', 'modelClass' => 'HrPolicy'),
		);
	}
	
	/**
	 * Creates a new section in a policy.
	 */
	public function actionCreateSection()
	{
		$model=new HrSections;

		if($model->attributes = Yii::app()->request->getPost('HrSections'))
		{
			$temp = Yii::app()->db->createCommand()
				->select('MAX(sectionid)')
				->from('ci_hr_sections')
				->queryAll();

			$model->sectionid = $temp[0]['MAX(sectionid)'] + 1;

			if($model->save())
				$this->redirect('index');
		}

		$this->render('createSection',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates the section model. Both ids are needed because the section table uses a composite key.
	 * @param integer $id1 the ID of the policy.
	 * @param integer $id2 the ID of the section to be updated.
	 */
	public function actionUpdateSection($id1 = null, $id2 = null)
	{
		$id1 = (integer)strip_tags($_GET['policyid']);
		$id2 = (integer)strip_tags($_GET['sectionid']);
		if($id1 == null || $id2 == null)
			throw new CHttpException(400, "Bad Request! Ids must be given.");
		
		$model=HrSections::model()->findByPk(array('policyid' => $id1, 'sectionid' =>$id2));

		if($model->attributes = Yii::app()->request->getPost('HrSections'))
		{
			if($model->save())
				$this->redirect('index');
		}

		$this->render('updateSection',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Deletes a particular policy and it's section.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(empty($id))
			throw new CHttpException(400, "Bad Request. An id must be given.");

		$policy = CActiveRecord::model('HrPolicy')->findByPk($id);

		if(!$policy)
			throw new CHttpException(400, "Failed to load data.");
		
		// All sections in the policy must be deleted to prevent orphaned records.
		CActiveRecord::model('HrSections')->deleteAll('policyid = :pid' , array('pid'=>$policy->policyid));
		
		if($policy->delete())
		{
			Yii::app()->user->setFlash('deleted', 'Record has been deleted.');
			Yii::app()->getController()->redirect('index');
		}
		else
			throw new CHttpException(500, "Failed to delete data.");
	}
	
	/**
	 * Deletes a particular section.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteSection($sid, $pid)
	{
		if(empty($sid) || empty($pid))
			throw new CHttpException(400, "Bad Request. An id must be given.");

		$section = CActiveRecord::model('HrSections')->findByPk(array('sectionid'=>$sid, 'policyid'=>$pid));

		if(!$section)
			throw new CHttpException(400, "Failed to load data.");
		
		if($section->delete())
		{
			Yii::app()->user->setFlash('deleted', 'Record has been deleted.');
			Yii::app()->getController()->redirect('index');
		}
		else
			throw new CHttpException(500, "Failed to delete data.");
	}
	
	/**
	 * Lists all the policies and policy sections in an accordion that can be 
	 * edited if the user has hr editing rights.
	 */
	public function actionIndex()
	{
		// If the user posted the policy or section form, forward to the createpolicy or createsection actions
		if(isset($_POST['HrPolicy']))
			$this->forward('createpolicy');
		else if(isset($_POST['HrSections']))
			$this->forward('createSection');
		
		// Create the section and policy models.
		$nSection = new HrSections;
		$nPolicy = new HrPolicy;
		
		// Create the array that will be needed by the accordion.
		$panels = $nPolicy->CreateAccordionArray();

		$this->render('index',array(
			'panels'=>$panels,
			'section'=>$nSection,
			'policy'=>$nPolicy
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 * @return EvaluationAnswers
	 */
	public function loadSectionModel($policyid = null, $sectionid = null)
	{
		if(is_null($policyid) || is_null($sectionid))
			throw new CHttpException(400, "Bad Request! Ids must be given.");
		$model= HrSections::model()->findByPk(array('policyid' => $policyid, 'sectionid' => $sectionid));
		if($model===null)
			throw new CHttpException(404, 'The requested data does not exist.');
		return $model;
	}
}
