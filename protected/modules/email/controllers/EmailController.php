<?php

class EmailController extends Controller
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
	 * This action sends an email to the helpdesk, letting them know that someone is trying to register.
	 */
	public function actionRegisteremail()
	{
		// This will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;

			// Create the link to the user creation page that will go in the email.
			$link = "http://jis18822/security/userinfo/create"				
						. '?firstname=' . urlencode($_GET['firstname']) . '&lastname=' . urlencode($_GET['lastname'])
						. '&middlename=' . urlencode($_GET['middlename']) . '&email=' . urlencode($_GET['email'])
						. '&phoneext=' . urlencode($_GET['phoneext']) . '&departmentid=' . urlencode($_GET['departmentid'])
						. '&hiredate=' . urlencode($_GET['hiredate']);
			
			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail("ccc.helpdesk@nashville.gov", "ccc.helpdesk@nashville.gov", "CI Registration Request From " . $_GET['firstname'] . " " .  $_GET['lastname'],
				$this->renderPartial('registeremailbody', 
					array('firstname' => $_GET['firstname'], 'lastname' => $_GET['lastname'], 'link' => $link), true),
				"Registration Request"
			);

			// Send the email.
			if($model->mail->Send())
			{
				// Save a record of the message in the ci_messages table.
				$model->save();
			}
			else
			{
				throw new CHttpException(400, "A problem prevented your registration email alert from being sent to the helpdesk. Please notify IT of this error.");
			}
			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->render('registeremail');
	}
	
	/**
	 * After an IT user adds a new user, this action sends that new user an email letting them know that they can now use the website.
	 */
	public function actionAddemail()
	{
		// This will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;

			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail(urldecode($_GET['email']), "ccc.helpdesk@nashville.gov", "CI Registration Request",
				$this->renderPartial('addemailbody', array('username' => $_GET['username']), true),
				"New User"
			);
			
			// Send the email.
			if($model->mail->Send())
			{
				// Save a record of the message in the ci_messages table.
				$model->save();
			}
			else
			{
				throw new CHttpException(400, "The new user was created, but a problem prevented the email alert from being sent to the new user. Please notify the user that their account is ready.");
			}
			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->render('addemail');
	}

	/**
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
			// Create the link to the password recovery page.
			$link = $this->createAbsoluteUrl('/security/password/passwordrecoveryform',array('username'=> $_GET['username']));
			
			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail($email, "ccc.helpdesk@nashville.gov", "CI Password Recovery",
				$this->renderPartial('recoveryemailbody', array('link' => $link), true),
				"Recovery"
			);
			
			// Send the email.
			if($model->mail->Send())
			{
				// Save a record of the message in the ci_messages table.
				$model->save();
			}
			else
			{
				throw new CHttpException(400, "The password recovery email could not be sent. Please notify IT of this error.");
			}
			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->render('recoveryemail');
	}

	/**
	 * This action will be used to send an alert email to the helpdesk when a new trouble ticket is made.
	 */
	public function actionHelpopenemail()
	{
		// This will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;
			$user = UserInfo::model()->findByPk(Yii::app()->user->id);
			// Get the current user's email to be CC'd.
			$cc[0] = $user->email;
			// Get the name of the subject.
			$subject = TicketSubjects::model()->findByPk($_GET['subject'])->subjectname;
			// If the subject is "Courtroom Printer Not Working" then GS Courtroom Support should also be CC'd.
			if($subject == "Courtroom Printer Not Working")	
				$cc[1] = "GSCourtroomSupport@nashville.gov";

			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail("ccc.helpdesk@nashville.gov", $user->email, "Opening CI2 Ticket #" . $_GET['ticketid'],
				$this->renderPartial('helpopenemailbody', 
					array(
						'ticketID' => $_GET['ticketid'],
						'user' => Yii::app()->user->name,
						'category' => TicketCategories::model()->findByPk($_GET['category'])->categoryname,
						'subject' => $subject,
						'description' => nl2br($_GET['description'])
					), true),
				"Trouble Ticket", $cc[0], (isset($cc[1]) ? $cc[1] : null)
			);
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
			else
			{
				throw new CHttpException(400, "Your ticket was created, but a problem prevented the email alert from being sent to the helpdesk. Please notify IT of this error.");
			}
			Yii::app()->user->setFlash('success', "Email Made!");
		}
		$this->redirect(array('/tickets/troubletickets/index?status=Open'));
	}
	
	/**
	 * This action will be used to send an alert email to the trouble ticket creator when their ticket is closed.
	 */
	public function actionHelpcloseemail()
	{
		$model = new Messages;
		$creator = UserInfo::model()->findByPk($_GET['creator']);
		$email = $creator->email;
		
		$body = explode("\n", $_GET['description']);
		array_pop($body);
		$body = implode("\n", $body);
		// Get the helpdesk email to be CC'd.
		$cc[0] = "ccc.helpdesk@nashville.gov";
		// Get the name of the subject.
		$subject = TicketSubjects::model()->findByPk($_GET['subject'])->subjectname;
		// If the subject is "Courtroom Printer Not Working" then GS Courtroom Support should also be CC'd.
		if($subject == "Courtroom Printer Not Working")	
			$cc[1] = "GSCourtroomSupport@nashville.gov";
		
		// Set the sender, the recipient, the subject, the body, and the message type.
		$model->setEmail($email, "ccc.helpdesk@nashville.gov", "Closing CI2 Ticket #" . $_GET['ticketid'],
			$this->renderPartial('helpcloseemailbody', 
				array(
					'ticketID' => $_GET['ticketid'],
					'creator' => $creator->username,
					'closer' => Yii::app()->user->name,
					'category' => TicketCategories::model()->findByPk($_GET['category'])->categoryname,
					'subject' => $subject,
					'description' => nl2br($body),
					'resolution' => nl2br($_GET['resolution']),
				), true),
			"Trouble Ticket", $cc[0], (isset($cc[1]) ? $cc[1] : null)
		);

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
		else
		{
			throw new CHttpException(400, "The ticket was closed, but a problem prevented the email alert from being sent. Please notify the ticket submitter that their problem is fixed.");
		}
		$this->redirect(array('/tickets/troubletickets/index?status=Open'));
	}
	
	/**
	 * This action will be used to send an alert email when a new comment is made.
	 */
	public function actionCommentEmail()
	{
		$model = new Messages;
		$email = UserInfo::model()->findByPk($_GET['creator'])->email;
		
		// Set the sender, the recipient, the subject, the body, the message type, and cc addresses.
		// The renderPartial function is used to apply a style to the body of the email.
		$model->setEmail($email, "ccc.helpdesk@nashville.gov", "A new comment was made on CI2 Ticket #" . $_GET['ticketid'],
			$this->renderPartial('commentemailbody', 
				array(
					'ticketID' => $_GET['ticketid'],
					'user' => Yii::app()->user->name,
					'content' => nl2br($_GET['content']),
					'category' => TicketCategories::model()->findByPk($_GET['category'])->categoryname,
					'subject' => TicketSubjects::model()->findByPk($_GET['subject'])->subjectname,
					'ticketBody' => nl2br($_GET['ticketBody'])
				), true
			),
			"Comment", "ccc.helpdesk@nashville.gov"
		);
		
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
		else
		{
			throw new CHttpException(400, "Your comment was created, but a problem prevented the email alert from being sent. Please notify IT of this error.");
		}
		$this->redirect(array('/tickets/troubletickets/view?id=' . $_GET['ticketid']));
	}
	
	/**
	 * This function is used to send out the document share emails.
	 */
	public function actionDocumentShareEmail()
	{
		// This will prevent the email from being resent if the user refreshes the page.
		//if(!Yii::app()->user->hasFlash('success'))
		{
			// Create a message object.
			$model = new Messages;
			$email = UserInfo::model()->findByPk(Yii::app()->user->id)->email;

			// Set the sender, the recipient, the subject, the body, the message type, and cc addresses.
			$model->setEmail($email, "ccc.helpdesk@nashville.gov", "Someone shared a document with you",
				$this->renderPartial('sharedocumentemailbody', array('file' => 'placeholder value'), true),
				"Share", $email
			);
			
			// Send the email.
			$model->mail->Send();
			// Save a record of the message in the ci_messages table.
			$model->save();

			//Yii::app()->user->setFlash('shared', "Email Made!");
		}
		$this->render('sharedocumentemail');
	}
}
