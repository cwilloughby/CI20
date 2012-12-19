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
	
	public function actionRegister()
	{
		$model = new RegisterForm();

		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			if($model->validate())
			{
				// Form inputs are valid.
				// Redirect to the email controller's register email action in the email module.
				$this->redirect(array('/email/email/registeremail',
							'firstname'=>$model->firstname,
							'lastname'=>$model->lastname,
							'middlename'=>$model->middlename,
							'email'=>$model->email,
							'phoneext'=>$model->phoneext,
							'departmentid'=>$model->departmentid,
							'hiredate'=>$model->hiredate));
			}
		}
		
		$departments=Departments::model()->findAll();
		$departments = array_merge(array(""=>""),CHtml::listData($departments,'departmentid','departmentname'));
		
		$this->render('register',array('model'=>$model, 'departments'=>$departments));
	}
	
	public function actionAdduser()
	{
		$model=new AddUserForm();

		if(isset($_POST['AddUserForm']))
		{
			$model->attributes=$_POST['AddUserForm'];
			if($model->validate())
			{
				$user=new UserInfo;
				
				$user->attributes = $model->attributes;
				$user->departmentid += 1;
				$user->password = sha1($model->username);
				
				if($user->save())
					$this->redirect(array('view','id'=>$model->id));
				else
					echo "Something broke.";
				
				// form inputs are valid. 
				// Redirect to the email controller's add email action in the email module.
				$this->redirect(
					array('/email/email/addemail', 
						'firstname'=>$model->firstname,
						'lastname'=>$model->lastname,
						'middlename'=>$model->middlename,
						'email'=>$model->email,
						'phoneext'=>$model->phoneext,
						'departmentid'=>$model->departmentid,
						'hiredate'=>$model->hiredate,
					));
			}
		}
		
		$departments=array_merge(array(""=>""),CHtml::listData(Departments::model()->findAll(),'departmentid','departmentname'));
		
		$this->render('adduser',array('model'=>$model, 'departments'=>$departments));
	}
}
