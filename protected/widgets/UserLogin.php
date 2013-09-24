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
		if(isset($_POST['LoginForm']))
		{
			$this->controller->forward('/security/login/loginform');
		}
		
		$form=new LoginForm;
		
		$this->render('login', array('model'=>$form));
	}
}
