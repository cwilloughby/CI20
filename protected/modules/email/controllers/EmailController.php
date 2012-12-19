<?php

class EmailController extends Controller
{
	const HOST = "10.107.12.72";
	
	public $mail; 
	
	/*
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function actionRegisteremail()
	{
		// Code to send email to IT is not done yet.
		$this->mail = new JPhpMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = self::HOST;

		$this->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
		
		$this->mail->AddAddress("CharlesWilloughby@jis.nashville.org");
		$this->mail->Subject = "Register Email";
		
		$link = "http://ci2/security/registration/adduser"				
					. '?firstname=' . $_GET['FirstName']
					. '&lastname=' . $_GET['LastName']
					. '&middlename=' . $_GET['MiddleName']
					. '&email=' . $_GET['Email']
					. '&phone=' . $_GET['PhoneExt']
					. '&department=' . $_GET['DepartmentID']
					. '&hiredate=' . $_GET['HireDate'];
		
		$this->mail->Body = "Link: " . $link;
		
		$this->mail->Send();
		
		$this->render('registeremail');
	}
	
	public function actionAddemail()
	{
		$this->render('addemail');
	}

	public function actionRecoveryemail()
	{
		$this->render('recoveryemail');
	}

	public function actionHelpopenemail()
	{
		
	}
	
	public function actionHelpcloseemail()
	{
		
	}
}
