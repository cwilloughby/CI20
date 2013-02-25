<?php

class UserLogin extends CPortlet
{
	public $pageTitle='Login';
	
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
