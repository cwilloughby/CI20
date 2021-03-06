<?php

class RegistrationController extends Controller
{
	public $layout='//layouts/column1';
	
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

		if($model->attributes = Yii::app()->request->getPost('RegisterForm'))
		{
			if($model->validate())
			{		
				// Remove the flash message so the email will work again.
				Yii::app()->user->getFlash('success');

				// Redirect to the email controller's register email action in the email module.
				$this->redirect(array('/email/email/registeremail',
							'firstname'=>$model->firstname,
							'lastname'=>$model->lastname,
							'middlename'=>$model->middlename,
							'email'=>$model->email,
							'phoneext'=>$model->phoneext,
							'departmentid'=>$model->departmentid));
			}
		}
		
		$departments=Departments::model()->findAll();
		$departments = CHtml::listData($departments,'departmentid','departmentname');
		
		$this->render('register',array('model'=>$model, 'departments'=>$departments));
	}
}
