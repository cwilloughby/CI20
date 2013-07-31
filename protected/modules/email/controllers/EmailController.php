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
			// The $_GET variables will be used to autopopulate many of the form fields.
			$link = "http://jis18822/security/userinfo/create"				
						. '?firstname=' . urlencode($_GET['firstname'])
						. '&lastname=' . urlencode($_GET['lastname'])
						. '&middlename=' . urlencode($_GET['middlename'])
						. '&email=' . urlencode($_GET['email'])
						. '&phoneext=' . urlencode($_GET['phoneext'])
						. '&departmentid=' . urlencode($_GET['departmentid'])
						. '&hiredate=' . urlencode($_GET['hiredate']);
			
			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail("ccc.helpdesk@nashville.gov", "ccc.helpdesk@nashville.gov", "CI Registration Request From " . $_GET['firstname'] . " " .  $_GET['lastname'],
				$this->renderPartial('registeremailbody', 
					array('firstname' => $_GET['firstname'], 'lastname' => $_GET['lastname'] ,'link' => $link), true),
				"Registration Request"
			);

			// Send the email.
			$model->mail->Send();
			// Save a record of the message in the ci_messages table.
			$model->save();

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
			$model->mail->Send();
			// Save a record of the message in the ci_messages table.
			$model->save();

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
			$link = $this->createAbsoluteUrl('/security/password/recovery',array('username'=> $_GET['username']));
			
			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail($email, "ccc.helpdesk@nashville.gov", "CI Password Recovery",
				$this->renderPartial('recoveryemailbody', array('link' => $link), true),
				"Recovery"
			);
			
			// Send the email.
			$model->mail->Send();
			// Save a record of the message in the ci_messages table.
			$model->save();

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

			// Set the sender, the recipient, the subject, the body, and the message type.
			$model->setEmail("ccc.helpdesk@nashville.gov", $user->email, "Opening CI Ticket #" . $_GET['ticketid'],
				$this->renderPartial('helpopenemailbody', 
					array(
						'ticketID' => $_GET['ticketid'],
						'user' => Yii::app()->user->name,
						'category' => TicketCategories::model()->findByPk($_GET['category'])->categoryname,
						'subject' => TicketSubjects::model()->findByPk($_GET['subject'])->subjectname,
						'description' => nl2br($_GET['description'])
					), true),
				"Trouble Ticket",
				$user->email
			);
			
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
	
	/**
	 * This action will be used to send an alert email to the trouble ticket creator when their ticket is closed.
	 */
	public function actionHelpcloseemail()
	{
		$model = new Messages;
		$email = UserInfo::model()->findByPk($_GET['creator'])->email;
		
		$body = explode("\n", $_GET['description']);
		array_pop($body);
		$body = implode("\n", $body);
		
		// Set the sender, the recipient, the subject, the body, and the message type.
		$model->setEmail($email, "ccc.helpdesk@nashville.gov", "Closing CI Ticket #" . $_GET['ticketid'],
			$this->renderPartial('helpcloseemailbody', 
				array(
					'ticketID' => $_GET['ticketid'],
					'user' => Yii::app()->user->name,
					'category' => TicketCategories::model()->findByPk($_GET['category'])->categoryname,
					'subject' => TicketSubjects::model()->findByPk($_GET['subject'])->subjectname,
					'description' => nl2br($body),
					'resolution' => nl2br($_GET['resolution']),
				), true),
			"Trouble Ticket",
			"ccc.helpdesk@nashville.gov"
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
		
		$this->redirect(array('/tickets/troubletickets/index?status=Open'));
	}
	
	/**
	 * This action will be used to send an alert email when a new comment is made.
	 */
	public function actionCommentEmail()
	{
		$model = new Messages;
		$email = UserInfo::model()->findByPk($_GET['creator'])->email;
		
		// Set the sender, the recipient, the subject, the body, and the message type.
		$model->setEmail($email, "ccc.helpdesk@nashville.gov", "A new comment was made on CI Ticket #" . $_GET['ticketid'],
			$this->renderPartial('commentemailbody', 
				array('ticketID' => $_GET['ticketid'], 'user' => Yii::app()->user->name, 'content' => nl2br($_GET['content'])), true),
			"Comment",
			"ccc.helpdesk@nashville.gov"
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
		$this->redirect(array('/tickets/troubletickets/view?id=' . $_GET['ticketid']));
	}
}
