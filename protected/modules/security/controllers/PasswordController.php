<?php

class PasswordController extends Controller
{
	/*
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function actionRecoveryrequest()
	{
		$model=new UserInfo;

		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			// Use different validation rules.
			$model->scenario = 'request';
			
			if($model->validate())
			{
				// Form inputs are valid.
				// Redirect to the email controller's recovery email action in the email module.
				$this->redirect(array('/email/email/recoveryemail', 'username'=>$model->username));
			}
		}
		$this->render('recoveryrequest',array('model'=>$model));
	}
	
	public function actionRecovery()
	{
		$model=new UserInfo;

		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			// Use different validation rules.
			$model->scenario = 'recovery';
			
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('recovery',array('model'=>$model));
	}
	
	public function actionChange()
	{
		$model=new UserInfo;

		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			// Use different validation rules.
			$model->scenario = 'change';
			
			if($model->validate('change'))
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('change',array('model'=>$model));
	}
}
