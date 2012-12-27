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
	
	/*
	 * This action sends an email to the helpdesk, letting them know that someone is trying to register.
	 */
	public function actionRegisteremail()
	{
		// Create a mailer object, tell it to use SMTP and set the host.
		$this->mail = new JPhpMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = self::HOST;

		// Set the sender, the recipient, and the subject.
		$this->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
		$this->mail->AddAddress("ccc.helpdesk@nashville.gov");
		$this->mail->Subject = "CI Registration Request";
		
		// Create the link to the user creation page that will go in the email.
		// The $_GET variables will be used to autopopulate many of the form fields.
		$link = "http://ci2/security/userinfo/create"				
					. '?firstname=' . urlencode($_GET['firstname'])
					. '&lastname=' . urlencode($_GET['lastname'])
					. '&middlename=' . urlencode($_GET['middlename'])
					. '&email=' . urlencode($_GET['email'])
					. '&phoneext=' . urlencode($_GET['phoneext'])
					. '&departmentid=' . urlencode($_GET['departmentid'])
					. '&hiredate=' . urlencode($_GET['hiredate']);
		
		// Set the message's body.
		$this->mail->Body = "A new user is requesting registration to the CI2.0 website. 
			Follow the link to review their information: " . $link;
		
		// Send the email.
		$this->mail->Send();
		
		$this->render('registeremail');
	}
	
	/*
	 * After an IT user adds a new user, this action sends that new user an 
	 * email letting them know that they can now use the website.
	 */
	public function actionAddemail()
	{
		// Create a mailer object, tell it to use SMTP and set the host.
		$this->mail = new JPhpMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = self::HOST;
		
		// Set the sender, the recipient, and the subject.
		$this->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
		$this->mail->AddAddress(urldecode($_GET['email']));
		$this->mail->Subject = "CI Registration Request";
		
		// Set the message's body.
		$this->mail->Body = "Your CI2.0 registration has been approved. " 
					. "Your credentials are below. Please change your password as soon as you login.\n\n" 
					. "Username: " . $_GET['username'] . "\n"
					. "Password: Same as your username";
		
		// Send the email.
		$this->mail->Send();
		
		$this->render('addemail');
	}

	/*
	 * This action sends an email to a registered user that can't remember their password.
	 * The email contains a link with the username encrypted in the url. The link
	 * will take the user to the password recovery form where they can change their password.
	 */
	public function actionRecoveryemail()
	{
		// Create a mailer object, tell it to use SMTP and set the host.
		$this->mail = new JPhpMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = self::HOST;
		
		// Decrypt the email that was passed in the $_GET
		$sec = Yii::app()->getSecurityManager();
		$email = $sec->decrypt(urldecode($_GET["email"]));
		
		// Set the sender, the recipient, and the subject.
		$this->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
		$this->mail->AddAddress($email);
		$this->mail->Subject = "CI Password Recovery";
		
		// Create the link to the password recovery page.
		$link = "http://ci2/security/password/recovery"				
					. '?username=' . urlencode($_GET['username']);
		
		// Set the message's body.
		$this->mail->Body = "Follow this link to recover your password: " . $link;
		
		// Send the email.
		$this->mail->Send();
		
		$this->render('recoveryemail');
	}

	/*
	 * This action will be used to send an alert email to the helpdesk when a new
	 * trouble ticket is made.
	 * This is just a place holder until the trouble ticket system is done.
	 */
	public function actionHelpopenemail()
	{
		$this->render('helpopenemail');
	}
	
	/*
	 * This action will be used to send an alert email to the trouble ticket
	 * creator when their ticket is closed.
	 * This is just a place holder until the trouble ticket system is done.
	 */
	public function actionHelpcloseemail()
	{
		$this->render('helpcloseemail');
	}
}
