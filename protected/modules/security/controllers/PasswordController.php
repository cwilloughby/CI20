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
	
	/*
	 * The password recovery request form. Used when you can't remember the password.
	 */
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
				$data = $model->find("username = '$model->username'");
				
				// Get the security manager so it can be used to encrypt the username and email in the url.
				$sec = Yii::app()->getSecurityManager();
				
				// Remove the flash message so the email will work again.
				Yii::app()->user->getFlash('success');
				
				// Redirect to the email controller's recovery email action in the email module.
				$this->redirect(array('/email/email/recoveryemail', 
					'username'=>urlencode($sec->encrypt($data->username)), 
					'email'=>urlencode($sec->encrypt($data->email))));
			}
		}
		$this->render('recoveryrequest',array('model'=>$model));
	}
	
	/*
	 * The password recovery form 
	 */
	public function actionRecovery()
	{
		$model=new UserInfo;

		if(isset($_GET["username"]) || isset($_POST['username']))
		{
			$sec = Yii::app()->getSecurityManager();
			$data = $sec->decrypt(urldecode($_GET["username"]));
			$model->username = $data;

			if(isset($_POST['UserInfo']))
			{
				$model->attributes=$_POST['UserInfo'];
				// Use different validation rules.
				$model->scenario = 'recovery';

				if($model->validate())
				{
					// Form inputs are valid. Hash the new password and save it in the database.
					$data = $model->find("username = '$model->username'");
					$data->password = sha1($model->password);
					
					if($data->update())
						$this->redirect(Yii::app()->homeUrl);
				}
			}
			$this->render('recovery',array('model'=>$model));
		}
		else
		{
			// A username was not supplied, redirect back to the homepage.
			$this->redirect(Yii::app()->homeUrl);
		}
	}
	
	/*
	 * The password change form. Used when you can remember the current password.
	 */
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
				// Form inputs are valid. Hash the new password and save it in the database.
				$user = Yii::app()->user->getName();
				$data = $model->find("username = '$user'");
				$data->password = sha1($model->password);

				if($data->update())
					$this->redirect(Yii::app()->homeUrl);
			}
		}
		$this->render('change',array('model'=>$model));
	}
}
