<?php

class EmailController extends Controller
{
	const HELPDESK = "ccc.helpdesk@nashville.gov";
	
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
			
			$firstName = filter_input(INPUT_GET, 'firstname');
			$middleName = filter_input(INPUT_GET, 'middlename');
			$lastName = filter_input(INPUT_GET, 'lastname');
			$email = filter_input(INPUT_GET, 'email');
			$phone = filter_input(INPUT_GET, 'phoneext');
			$department = filter_input(INPUT_GET, 'departmentid');
			
			// Create the link to the user creation page that will go in the email.
			$link = "http://jis18822/security/userinfo/create"				
						. '?firstname=' . urlencode($firstName) . '&lastname=' . urlencode($lastName)
						. '&middlename=' . urlencode($middleName) . '&email=' . urlencode($email)
						. '&phoneext=' . urlencode($phone) . '&departmentid=' . urlencode($department);
			
			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail(self::HELPDESK, self::HELPDESK, "CI Registration Request From " . $firstName . " " .  $lastName,
				$this->renderPartial('registeremailbody', 
					array('firstname' => $firstName, 'lastname' => $lastName, 'link' => $link), true),
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
			$username = filter_input(INPUT_GET, 'username');

			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail(urldecode($_GET['email']), self::HELPDESK, "CI Registration Request",
				$this->renderPartial('addemailbody', array('username' => $username), true),
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
			$username = filter_input(INPUT_GET, 'username');
			$link = $this->createAbsoluteUrl('/security/password/passwordrecoveryform',array('username'=> $username));
			
			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail($email, self::HELPDESK, "CI Password Recovery",
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
			$subject = TicketSubjects::model()->findByPk(filter_input(INPUT_GET, 'subject'))->subjectname;
			// If the subject is "Courtroom Printer Not Working" then GS Courtroom Support should also be CC'd.
			if($subject == "Courtroom Printer Not Working")	
				$cc[1] = "GSCourtroomSupport@nashville.gov";
			
			if(Yii::app()->user->name == "tbrooks" || Yii::app()->user->name == "ethurman")
				$cc[1] = "PattiMcNaney@jis.nashville.org";
			
			$ticketid = filter_input(INPUT_GET, 'ticketid');
			$category = filter_input(INPUT_GET, 'category');
			$description = filter_input(INPUT_GET, 'description');

			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail(self::HELPDESK, $user->email, "Opening CI2 Ticket #" . $ticketid,
				$this->renderPartial('helpopenemailbody', 
					array(
						'ticketID' => $ticketid,
						'user' => Yii::app()->user->name,
						'category' => TicketCategories::model()->findByPk($category)->categoryname,
						'subject' => $subject,
						'description' => nl2br($description)
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
					$bridge->ticketid = $ticketid;
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
		
		$creator = UserInfo::model()->findByPk(filter_input(INPUT_GET, 'creator'));
		$email = $creator->email;
		$description = filter_input(INPUT_GET, 'description');
		$body = explode("\n", $_GET['description']);
		array_pop($body);
		$body = implode("\n", $body);
		$ticketid = filter_input(INPUT_GET, 'ticketid');
		$category = TicketCategories::model()->findByPk(filter_input(INPUT_GET, 'category'))->categoryname;
		$subject = TicketSubjects::model()->findByPk(filter_input(INPUT_GET, 'subject'))->subjectname;
		$resolution = filter_input(INPUT_GET, 'resolution');
		
		// Get the helpdesk email to be CC'd.
		$cc[0] = self::HELPDESK;

		// If the subject is "Courtroom Printer Not Working" then GS Courtroom Support should also be CC'd.
		if($subject == "Courtroom Printer Not Working")	
			$cc[1] = "GSCourtroomSupport@nashville.gov";
		
		if($creator->username == "tbrooks" || $creator->username == "ethurman")
			$cc[1] = "PattiMcNaney@jis.nashville.org";
		
		// Set the sender, the recipient, the subject, the body, and the message type.
		$model->setEmail($email, self::HELPDESK, "Closing CI2 Ticket #" . $ticketid,
			$this->renderPartial('helpcloseemailbody', 
				array(
					'ticketID' => $ticketid,
					'creator' => $creator->username,
					'closer' => Yii::app()->user->name,
					'category' => $category,
					'subject' => $subject,
					'description' => nl2br($body),
					'resolution' => nl2br($resolution),
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
				$bridge->ticketid = $ticketid;
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
		$ticketid = filter_input(INPUT_GET, 'ticketid');
		$category = TicketCategories::model()->findByPk(filter_input(INPUT_GET, 'category'))->categoryname;
		$subject = TicketSubjects::model()->findByPk(filter_input(INPUT_GET, 'subject'))->subjectname;
		$content = filter_input(INPUT_GET, 'content');
		$ticketBody = filter_input(INPUT_GET, 'ticketBody');
		
		// Set the sender, the recipient, the subject, the body, the message type, and cc addresses.
		// The renderPartial function is used to apply a style to the body of the email.
		$model->setEmail($email, self::HELPDESK, "A new comment was made on CI2 Ticket #" . $ticketid,
			$this->renderPartial('commentemailbody', 
				array(
					'ticketID' => $ticketid,
					'user' => Yii::app()->user->name,
					'content' => nl2br($content),
					'category' => $category,
					'subject' => $subject,
					'ticketBody' => nl2br($ticketBody)
				), true
			),
			"Comment", self::HELPDESK
		);
		
		// Send the email.
		if($model->mail->Send())
		{
			// Save a record of the message in the ci_messages table.
			if($model->save())
			{
				// Connect the new message to the ticket on the bridge table.
				$bridge = new TicketMessages;
				$bridge->ticketid = $ticketid;
				$bridge->messageid = $model->messageid;
				$bridge->save();
			}
		}
		else
		{
			throw new CHttpException(400, "Your comment was created, but a problem prevented the email alert from being sent. Please notify IT of this error.");
		}
		$this->redirect(array('/tickets/troubletickets/view?id=' . $ticketid));
	}
	
	/**
	 * This action sends a hearing request email to CCC_Tape_Requests.
	 */
	public function actionHearingRequestEmail()
	{
		// This if statement will prevent the email from being resent if the user refreshes the page.
		if(!Yii::app()->user->hasFlash('success'))
		{
			$model = new Messages;

			// Set the recipient, the sender, the subject, the body, and the message type.
			$model->setEmail($_GET['sendTo'], $_GET['yourEmail'], "Preliminary Hearing Request",
				$this->renderPartial('hearingrequestemailbody', 
					array(
						'defName' => nl2br($_GET['defName']),
						'caseNumber' => nl2br($_GET['caseNumber']),
						'yourName' => nl2br($_GET['yourName']),
						'yourEmail' => nl2br($_GET['yourEmail']),
						'yourNumber' => nl2br($_GET['yourNumber']),
						'yourExtension' => nl2br($_GET['yourExtension']),
						'requestType' => nl2br($_GET['requestType'])
					), true),
				"Hearing Request"
			);
			// Send the email.
			if($model->mail->Send())
			{
				// Save a record of the message in the ci_messages table.
				$model->save();
			}
			else
			{
				throw new CHttpException(400, "A problem prevented the email alert from being sent. You can send your request manually to CCC_Tape_Requests@nashville.gov");
			}
			Yii::app()->user->setFlash('success', "Email Made!");
		}
		
		$this->render('hearingrequestemail',array(
			'requestType'=>$_GET['requestType'],
		));
	}
}
