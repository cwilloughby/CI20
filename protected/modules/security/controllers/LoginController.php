<?php

class LoginController extends Controller
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
	 * Displays the login page
	 */
	public function actionLoginForm()
	{
		$model=new LoginForm;

		// If it is an ajax validation request.
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// Collect user input data.
		if($model->attributes = Yii::app()->request->getPost('LoginForm'))
		{
			// Validate user input, then check if the credentials are valid.
			if($model->validate() && $model->login())
			{
				// Obtain the user's color preference and set it in a cookie.
				UserPrefs::setUserColor();
				// Redirect the user to the page they were originally trying to access.
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/**
	 * Logs out the current user and redirects to the homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
