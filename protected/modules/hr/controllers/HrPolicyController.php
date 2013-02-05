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
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatePolicy()
	{
		$model=new HrPolicy;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HrPolicy']))
		{
			$model->attributes=$_POST['HrPolicy'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->policyid));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new section in a policy.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateSection()
	{
		$model=new HrSections;
		$model->policyid = $_GET['policyid'];
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HrSections']))
		{
			$model->attributes=$_POST['HrSections'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->policyid));
		}

		$this->render('createSection',array(
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HrPolicy']))
		{
			$model->attributes=$_POST['HrPolicy'];
			
			$model->sectionid = Yii::app()->db->createCommand()
				->select('MAX(sectionid)')
				->from('ci_hr_sections')
				->query() + 1;
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->policyid));
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
		$main = Yii::app()->db->createCommand()
			->select('ci_hr_policy.policyid, ci_hr_policy.policy')
			->from('ci_hr_policy')
			->queryAll();
		
		$check = in_array("IT", Yii::app()->user->role);
		
		foreach($main as $policy)
		{
			$sub = Yii::app()->db->createCommand()
				->select('ci_hr_sections.sectionid, ci_hr_sections.section, ci_hr_sections.datemade')
				->from('ci_hr_policy')
				->leftJoin('ci_hr_sections','ci_hr_policy.policyid = ci_hr_sections.policyid')
				->where('ci_hr_sections.policyid=:id', array(':id'=>$policy['policyid']))
				->queryAll();
			
			if(isset($check))
			{
				$links[$policy['policy']] = CHtml::link('Create Section For ' 
					. $policy['policy'], array('hrpolicy/createsection?policyid=' 
						. $policy['policyid']));
			}
			
			foreach($sub as $section)
			{
				if(isset($check))
				{
					$panels[$policy['policy']][$section['datemade']] = CHtml::link('Edit',
							array('hrsections/update?id=' . $section['sectionid'])) . "<br/><br/>" . $section['section'];
				}
				else
					$panels[$policy['policy']][$section['datemade']] = $section['section'];
			}
		}
		
		$this->render('index',array(
			'panels'=>$panels,
			'links'=>$links,
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

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hr-policy-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
