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
	
	// External Actions
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
	public function actionUpdateSection($id1, $id2)
	{
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
	 * Lists all models.
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
		
		// Grab all of the policies.
		$main = Yii::app()->db->createCommand()
			->select('ci_hr_policy.policyid, ci_hr_policy.policy')
			->from('ci_hr_policy')
			->queryAll(); 
		
		// Check if the user has access to edit the hr policy.
		$check = Yii::app()->user->checkAccess('hr@HrEdit', Yii::app()->user->id);
		
		foreach($main as $policy)
		{
			// Grab all of the sections in the current panel.
			$sub = Yii::app()->db->createCommand()
				->select('ci_hr_policy.policyid, ci_hr_policy.policy, ci_hr_sections.sectionid, ci_hr_sections.section, ci_hr_sections.datemade')
				->from('ci_hr_policy')
				->leftJoin('ci_hr_sections','ci_hr_policy.policyid = ci_hr_sections.policyid')
				->where('ci_hr_sections.policyid=:id', array(':id'=>$policy['policyid']))
				->order('ci_hr_sections.datemade DESC')
				->queryAll();
			
			$first = 0;
			
			foreach($sub as $section)
			{
				if($first == 0)
				{
					$subKey = date('M d, Y', strtotime($section['datemade'])) . " Current";
					$first = 1;
				}
				else
					$subKey = date('M d, Y', strtotime($section['datemade'])) . " Old";
				
				// If the user has the rights to edit the hr policy.
				if($check)
				{
					// Add an edit link to the sub panel.
					$panels[$policy['policy']][$subKey] = CHtml::link('Edit',
						array('hrpolicy/updatesection?id1=' . $policy['policyid'] 
							. "&id2=" .$section['sectionid'])) . "<br/><br/>" . $section['section'];
				}
				else
					$panels[$policy['policy']][$subKey] = $section['section'];
			}
			
			// If the user has the rights to edit the hr policy.
			if($check)
			{
				// Take the create policy form and put it into the last main panel.
				$nSection->policyid = $policy['policyid'];
				$panels[$policy['policy']]['Create New Section'] =
					$this->renderPartial('_formSection', array('model'=>$nSection), true);
			}
		}

		$this->render('index',array(
			'panels'=>$panels,
			'section'=>$nSection,
			'policy'=>$nPolicy
		));
	}
}
