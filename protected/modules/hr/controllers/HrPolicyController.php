<?php

class HrPolicyController extends Controller
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
	 * Creates a policy.
	 */
	public function actionCreatePolicy()
	{
		$model=new HrPolicy;

		if(isset($_POST['HrPolicy']))
		{
			$model->attributes=$_POST['HrPolicy'];
			if($model->save())
				$this->redirect('index');
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new section in a policy.
	 */
	public function actionCreateSection()
	{
		$model=new HrSections;

		if(isset($_POST['HrSections']))
		{
			$model->attributes=$_POST['HrSections'];
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
	 * Updates the policy model.
	 * @param integer $id the ID of the policy to be updated
	 */
	public function actionUpdatePolicy($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['HrPolicy']))
		{
			$model->attributes=$_POST['HrPolicy'];
			
			if($model->save())
				$this->redirect('index');
		}

		$this->render('update',array(
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

		if(isset($_POST['HrSections']))
		{
			$model->attributes=$_POST['HrSections'];
			
			if($model->save())
				$this->redirect('index');
		}

		$this->render('updateSection',array(
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
		// If the user posted the policy or section form, 
		// forward to the createpolicy or createsection actions
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
				->queryAll();
			
			foreach($sub as $section)
			{
				// Is the user IT?
				if($check)
				{
					// Add an edit link to the sub panel.
					$panels[$policy['policy']][$section['datemade']] = CHtml::link('Edit',
						array('hrpolicy/updatesection?id1=' . $policy['policyid'] 
							. "&id2=" .$section['sectionid'])) . "<br/><br/>" . $section['section'];
				}
				else
					$panels[$policy['policy']][$section['datemade']] = $section['section'];
			}
			
			// Is the user IT?
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

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HrPolicy('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HrPolicy']))
			$model->attributes=$_GET['HrPolicy'];

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
		$model=HrPolicy::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
