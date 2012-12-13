<?php

class RegistrationController extends Controller
{
	/*
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/*
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform the 'register' and 'mail' action
				'actions'=>array('register', 'mail'),
				'users'=>array('*'),
				'deniedCallback'=>'/security/login/login',
			),
			array('allow', // Allow IT user to perform the 'adduser' action
				'actions'=>array('adduser'),
				'roles'=>array('IT'),
				'message'=>'Access Denied.',
			),
			array('deny',  // Deny everything else.
				'users'=>array('*'),
				'message'=>'Access Denied.',
			),
			
		);
	}
	
	public function actionRegister()
	{
		$model=new UserInfo('register');

		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			if($model->validate())
			{
				// form inputs are valid.
				// Code to send email to IT is not done yet.
			}
		}
		
		$departments=Departments::model()->findAll();
		$departments = array_merge(array(""=>""),CHtml::listData($departments,'DepartmentID','DepartmentName'));
		
		$this->render('register',array('model'=>$model, 'departments'=>$departments));
	}
	
	public function actionAdduser()
	{
		$model=new UserInfo('register');

		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				
			}
		}
		
		$departments=Departments::model()->findAll();
        $roles=Roles::model()->findAll();
		
		$roles = array_merge(array(""=>""),CHtml::listData($roles,'RoleID','RoleName'));
		$departments = array_merge(array(""=>""),CHtml::listData($departments,'DepartmentID','DepartmentName'));
		
		$this->render('adduser',array('model'=>$model, 'roles'=>$roles, 'departments'=>$departments));
	}
	
	public function actionMail()
	{
		$this->render('mail');
	}
}
