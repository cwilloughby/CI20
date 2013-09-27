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
			'delete' => array('class' => 'DeleteAction', 'modelClass' => 'HrPolicy')
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
		if($id1 == null || $id2 == null)
			throw new CHttpException(400, "Bad Request. Ids must be given.");
		
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
	 * Lists all the policies and policy sections in an accordion that can be 
	 * edited if the user has hr editing rights.
	 */
	public function actionIndex()
	{
		// If the user posted the policy or section form, forward to the createpolicy or createsection actions
		if(isset($_POST['HrPolicy']))
			$this->forward('createPolicy');
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
