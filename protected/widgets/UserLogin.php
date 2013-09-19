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
		
		if(isset($_POST['LoginForm']))
		{
			$form->attributes = $_POST['LoginForm'];
			
			if($form->validate())
				$this->controller->forward('/security/login/login', 
					array('model'=>$form));
		}
		$this->render('login', array('model'=>$form));
	}
}
