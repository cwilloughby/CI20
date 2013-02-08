<?php

class EmailController extends Controller
{
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
		// This will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;

			// Set the recipient, the sender, and the subject.
			$model->mail->AddAddress("ccc.helpdesk@nashville.gov");
			$model->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
			$model->mail->Subject = "CI Registration Request";
			$model->to = urldecode($_GET['email']);
			$model->from = $model->mail->From;
			$model->subject = $model->mail->Subject;

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
			$model->mail->Body = "A new user is requesting registration to the CI2.0 website. 
				Follow the link to review their information: " . $link;

			$model->messagebody = $model->mail->Body;
			$model->messagetype = "Registration Request";

			// Send the email.
			$model->mail->Send();
			// Save a record of the message in the ci_messages table.
			$model->save();

			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->render('registeremail');
	}
	
	/*
	 * After an IT user adds a new user, this action sends that new user an 
	 * email letting them know that they can now use the website.
	 */
	public function actionAddemail()
	{
		// This will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;

			// Set the recipient, the sender, and the subject.
			$model->mail->AddAddress(urldecode($_GET['email']));
			$model->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
			$model->mail->Subject = "CI Registration Request";
			$model->to = urldecode($_GET['email']);
			$model->from = $model->mail->From;
			$model->subject = $model->mail->Subject;

			// Set the message's body.
			$model->mail->Body = "Your CI2.0 registration has been approved. " 
						. "Your credentials are below. Please change your password as soon as you login.\n\n" 
						. "Username: " . $_GET['username'] . "\n"
						. "Password: Same as your username";

			$model->messagebody = $model->mail->Body;
			$model->messagetype = "New User";

			// Send the email.
			$model->mail->Send();
			// Save a record of the message in the ci_messages table.
			$model->save();

			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->render('addemail');
	}

	/*
	 * This action sends an email to a registered user that can't remember their password.
	 * The email contains a link with the username encrypted in the url. The link
	 * will take the user to the password recovery form where they can change their password.
	 */
	public function actionRecoveryemail()
	{
		// This will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;

			// Decrypt the email that was passed in the $_GET
			$sec = Yii::app()->getSecurityManager();
			$email = $sec->decrypt(urldecode($_GET["email"]));

			// Set the recipient, the sender, and the subject.
			$model->mail->AddAddress($email);
			$model->mail->SetFrom("ccc.helpdesk@nashville.gov", "CCC Helpdesk");
			$model->mail->Subject = "CI Password Recovery";
			$model->to = $email;
			$model->from = $model->mail->From;
			$model->subject = $model->mail->Subject;

			// Create the link to the password recovery page.
			$link = "http://ci2/security/password/recovery"				
						. '?username=' . urlencode($_GET['username']);

			// Set the message's body.
			$model->mail->Body = "Follow this link to recover your password: " . $link;

			$model->messagebody = "Follow this link to recover your password: Link omited for security";
			$model->messagetype = "Recovery";

			// Send the email.
			$model->mail->Send();
			// Save a record of the message in the ci_messages table.
			$model->save();

			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->render('recoveryemail');
	}

	/*
	 * This action will be used to send an alert email to the helpdesk when a new
	 * trouble ticket is made.
	 */
	public function actionHelpopenemail()
	{
		// This will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;

			$user = UserInfo::model()->findByPk(Yii::app()->user->id);

			// Set the recipient, the sender, and the subject.
			$model->mail->ContentType = "text/html";
			// The address will later be changed to "ccc.helpdesk@nashville.gov"
			$model->mail->AddAddress("CharlesWilloughby@jis.nashville.org");
			$model->mail->AddCC($user->email);
			$model->mail->SetFrom($user->email);
			$model->mail->Subject = "Opening CI Ticket #" . $_GET['ticketid'];
			$model->to = "CharlesWilloughby@jis.nashville.org";
			$model->from = $user->email;
			$model->subject = $model->mail->Subject;

			// Set the message's body.
			$model->mail->Body = 'A new CI ticket was submitted by ' . Yii::app()->user->name . "<br/><br/>"
						. "Category: " . TicketCategories::model()->findByPk($_GET['category'])->categoryname . "<br/>"
						. "Subject: " . TicketSubjects::model()->findByPk($_GET['subject'])->subjectname . "<br/>"
						. "Description: " . nl2br($_GET['description']);

			$model->messagebody = $model->mail->Body;
			$model->messagetype = "Trouble Ticket";

			// Send the email.
			$model->mail->Send();

			// Save a record of the message in the ci_messages table.
			if($model->save())
			{
				// Connect the new message to the ticket on the bridge table.
				$bridge = new TicketMessages;
				$bridge->ticketid = $_GET['ticketid'];
				$bridge->messageid = $model->messageid;
				$bridge->save();
			}

			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->render('helpopenemail');
	}
	
	/*
	 * This action will be used to send an alert email to the trouble ticket
	 * creator when their ticket is closed.
	 */
	public function actionHelpcloseemail()
	{
		$model = new Messages;
		$email = UserInfo::model()->findByPk($_GET['creator'])->email;
		
		// Set the recipient, the sender, and the subject.
		$model->mail->AddAddress($email);
		//$model->mail->AddCC("ccc.helpdesk@nashville.gov");
		$model->mail->SetFrom("ccc.helpdesk@nashville.gov");
		$model->mail->Subject = "Closing CI Ticket #" . $_GET['ticketid'];
		$model->to = $email;
		$model->from = "ccc.helpdesk@nashville.gov";
		$model->subject = $model->mail->Subject;
		
		// Remove the attachment from the description.
		$body = explode("\n", $_GET['description']);
		array_pop($body);
		$body = implode("\n", $body);
		
		// Set the message's body.
		$model->mail->Body = "CI ticket #" . $_GET['ticketid'] . " was closed by " . Yii::app()->user->name . "\n\n"
					. "Category: " . TicketCategories::model()->findByPk($_GET['category'])->categoryname . "\n"
					. "Subject: " . TicketSubjects::model()->findByPk($_GET['subject'])->subjectname . "\n"
					. "Description: " . $body . "\n"
					. "Resolution: " . $_GET['resolution'];
		
		$model->messagebody = $model->mail->Body;
		$model->messagetype = "Trouble Ticket";
		
		// Send the email.
		if($model->mail->Send())
		{
			// Save a record of the message in the ci_messages table.
			if($model->save())
			{
				// Connect the new message to the ticket on the bridge table.
				$bridge = new TicketMessages;
				$bridge->ticketid = $_GET['ticketid'];
				$bridge->messageid = $model->messageid;
				$bridge->save();
			}
		}
		
		$this->redirect(array('/tickets/troubletickets/index'));
	}
	
	/*
	 * This action will be used to send an alert email when a new comment is made.
	 */
	public function actionCommentEmail()
	{
		$model = new Messages;
		$email = UserInfo::model()->findByPk($_GET['creator'])->email;
		
		// Set the recipient, the sender, and the subject.
		$model->mail->ContentType = "text/html";
		$model->mail->AddAddress($email);
		//$model->mail->AddCC("ccc.helpdesk@nashville.gov");
		$model->mail->SetFrom("ccc.helpdesk@nashville.gov");
		$model->mail->Subject = "A new comment was made on CI Ticket #" . $_GET['ticketid'];
		$model->to = $email;
		$model->from = "ccc.helpdesk@nashville.gov";
		$model->subject = $model->mail->Subject;
		
		// Set the message's body.
		$model->mail->Body = nl2br("A new comment on CI ticket #" . $_GET['ticketid'] . " was made by " . Yii::app()->user->name . "\n\n"
					. "Content: " . $_GET['content'] . "\n");
		
		$model->messagebody = $model->mail->Body;
		$model->messagetype = "Comment";
		
		// Send the email.
		if($model->mail->Send())
		{
			// Save a record of the message in the ci_messages table.
			if($model->save())
			{
				// Connect the new message to the ticket on the bridge table.
				$bridge = new TicketMessages;
				$bridge->ticketid = $_GET['ticketid'];
				$bridge->messageid = $model->messageid;
				$bridge->save();
			}
		}
		$this->redirect(array('/tickets/troubletickets/view?id=' . $_GET['ticketid']));
	}
}
