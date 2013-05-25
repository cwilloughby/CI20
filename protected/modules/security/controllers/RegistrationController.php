<?php

class RegistrationController extends Controller
{
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
	 * The registration form.
	 */
	public function actionRegister()
	{
		$model = new RegisterForm();

		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			if($model->validate())
			{		
				// Remove the flash message so the email will work again.
				Yii::app()->user->getFlash('success');
				
				$hdate = date('Y-m-d', strtotime($model->hiredate));

				// Redirect to the email controller's register email action in the email module.
				$this->redirect(array('/email/email/registeremail',
							'firstname'=>$model->firstname,
							'lastname'=>$model->lastname,
							'middlename'=>$model->middlename,
							'email'=>$model->email,
							'phoneext'=>$model->phoneext,
							'departmentid'=>$model->departmentid,
							'hiredate'=>urlencode($hdate)));
			}
		}
		
		$departments=Departments::model()->findAll();
		$departments = array_merge(array(""=>""),CHtml::listData($departments,'departmentid','departmentname'));
		
		$this->render('register',array('model'=>$model, 'departments'=>$departments));
	}
}
