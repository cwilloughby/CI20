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
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$color = Yii::app()->db->createCommand()
					->select('ci_user_prefs.color')
					->from('ci_user_prefs')
					->where('ci_user_prefs.userid=:id', array(':id'=>Yii::app()->user->id))
					->queryAll();
				
				if(array_key_exists(0, $color) && array_key_exists('color', $color[0]))
				{
					setcookie("style", $color[0]['color'], time()+604800, '/'); // 604800 = amount of seconds in one week
				}
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to the homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
