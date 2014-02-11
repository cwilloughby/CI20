<?php
/**
 * This class is for the user login porlet. 
 * This allows the login form to be displayed in the side menu.
 */
class UserLogin extends CPortlet
{
	public $pageTitle='Login';
	public $viewPath = '/views';
	
	/**
	 * This function renders the login form.
	 */
	protected function renderContent()
	{	
		$form=new LoginForm;
		
		// Collect user input data.
		if($form->attributes = Yii::app()->request->getPost('LoginForm'))
		{
			// Validate user input, then check if the credentials are valid.
			if($form->validate() && $form->login())
			{
				// Redirect the user to the page they were originally trying to access.
				$this->controller->redirect(Yii::app()->user->returnUrl);
			}
		}
		
		$this->render('login', array('model'=>$form));
	}
}
