<?php

class EmailController extends Controller
{
	public function actionRegisterEmail()
	{
		$this->render('registeremail');
	}
	
	public function actionAddEmail()
	{
		$this->render('addemail');
	}

	public function actionRecoveryEmail()
	{
		$this->render('recoveryemail');
	}

	public function actionHelpOpenEmail()
	{
		
	}
}