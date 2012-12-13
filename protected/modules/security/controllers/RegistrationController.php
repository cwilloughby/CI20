<?php

class RegistrationController extends Controller
{
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
		$model=new RegisterForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->register())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		$departments=Departments::model()->findAll();
		
		$departments = array_merge(array(""=>""),CHtml::listData($departments,'DepartmentID','DepartmentName'));
		
		// display the login form
		$this->render('register',array('model'=>$model, 'departments'=>$departments));
	}
	
	public function actionAdduser()
	{
		$model=new AddUserForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='adduser-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['AddUserForm']))
		{
			$model->attributes=$_POST['AddUserForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->adduser())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$departments=Departments::model()->findAll();
        $roles=Roles::model()->findAll();
		
		$roles = array_merge(array(""=>""),CHtml::listData($roles,'RoleID','RoleName'));
		$departments = array_merge(array(""=>""),CHtml::listData($departments,'DepartmentID','DepartmentName'));
		
		// display the login form
		$this->render('adduser',array('model'=>$model, 'roles'=>$roles, 'departments'=>$departments));
	}

	public function actionMail()
	{
		$this->render('mail');
	}
}