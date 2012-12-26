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
		
		$link = "http://ci2/security/userinfo/create"				
					. '?firstname=' . urlencode($_GET['firstname'])
					. '&lastname=' . urlencode($_GET['lastname'])
					. '&middlename=' . urlencode($_GET['middlename'])
					. '&email=' . urlencode($_GET['email'])
					. '&phoneext=' . urlencode($_GET['phoneext'])
					. '&departmentid=' . urlencode($_GET['departmentid'])
					. '&hiredate=' . urlencode($_GET['hiredate']);
		
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
		$this->mail = new JPhpMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = self::HOST;

		$this->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
		
		$sec = Yii::app()->getSecurityManager();
		// Decrypt the email that was passed in the $_GET
		$email = $sec->decrypt(urldecode($_GET["email"]));
		
		// Set the destination addess.
		$this->mail->AddAddress($email);
		
		$this->mail->Subject = "CI Password Recovery";
		
		$link = "http://ci2/security/password/recovery"				
					. '?username=' . urlencode($_GET['username']);
		
		$this->mail->Body = "Follow this link to recover your password: " . $link;
		
		$this->mail->Send();
		
		$this->render('recoveryemail');
	}

	public function actionHelpopenemail()
	{
		$this->render('helpopenemail');
	}
	
	public function actionHelpcloseemail()
	{
		$this->render('helpcloseemail');
	}
}
