<?php

class TroubleTicketsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // Perform access control for CRUD operations.
			'ajaxOnly + dynamicsubjects, dynamictips', // We only allow these actions to run via AJAX requests.
		);
	}
	
	/**
	 * This function returns a list of external actions.
	 * External actions are identical functions shared by many controllers throughout ci2.
	 * The code for the external actions can be found in protected\components
	 * @return array
	 */
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'TroubleTickets'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'TroubleTickets'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'TroubleTickets')
		);
	}
	
	/**
	 * Creates a new model. Makes use of the beforeSave event in the model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$ticket=new TroubleTickets;
		$file=new Documents;
		
		// AJAX is used to verify that the user has filled out the conditional textboxes.
		// This checks for AJAX posts.
		if(isset($_POST['ajax']) && $_POST['ajax']==='ticketsForm')
		{
			// Validate the form inputs, then output any error messages.
			echo CActiveForm::validate($ticket);
			Yii::app()->end();
		}
		
		if($ticket->attributes = Yii::app()->request->getPost('TroubleTickets'))
		{
			if($ticket->validate())
			{
				// Retieve the conditional text boxes from the posted form data.
				// The number of conditionals is dynamic, so this is need to extract them.
				$file->file = CUploadedFile::getInstance($file, 'file');
				$ticket->IsolateAndRetrieveConditionals($_POST);
				$temp = $ticket->description;
				
				if(isset($file->file))
				{
					$file->uploadType = 'attachment';
					$file->setDocumentAttributes();

					// Validate the file's attributes.
					if($file->validate())
					{
						// Create the folder if it does not exist.
						if(!is_dir($file->path))
							mkdir($file->path, 0777, true);
						// Set the complete path.
						$file->path = $file->path . $file->documentname;
						// Upload the file to the server.
						$file->file->saveAs($file->path, 'false');
						// This description is used so the link to the document will work on the website.
						$ticket->description .= "\nAttachment: " 
							. CHtml::link($file->documentname,array('/files/attachments/' 
								. $file->uploaddate . '/' . $file->documentname));
						// This description is used so the link to the document will work on the email.
						$temp .= "\nAttachment: <a href='file:///" . $file->path . "'>" . $file->documentname . "</a>";
					}
					else 
					{
						echo "bad file read";
					};
				}
				else
					$temp .= "\n";
				
				// Try to save the new ticket.
				if($ticket->save(false))
				{
					// Remove the flash message so the email will work again.
					Yii::app()->user->getFlash('success');

					// Send an email alert.
					$this->redirect(
						array('/email/email/helpopenemail', 
							'ticketid' => $ticket->ticketid,
							'category' => $ticket->categoryid,
							'subject' => $ticket->subjectid,
							'description' => $temp,
						));
				}
				else
					throw new CHttpException(400, "Ticket failed to save.");
				
				/*
				// If one or more files was uploaded.
				if(!empty($_FILES))
				{
					// Loop through each file.
					foreach($_FILES['file']['name'] as $key => $value)
					{
						// Read in the properties of the current file.
						$file->file = array('tempName' => $_FILES['file']['tmp_name'][$key], 'realName' => $_FILES['file']['name'][$key]);
						$file->uploadType = 'attachment';
						$file->setDocumentAttributes();

						// Validate the current file's attributes.
						if($file->validate())
						{
							// Upload the current file to the server.
							$file->uploadFile();
							// This description is used so the link to the document will work on the website.
							$ticket->description .= "\nAttachment: " 
								. CHtml::link($file->documentname,array('/files/attachments/' 
									. $file->uploaddate . '/' . $file->documentname));
							// This description is used so the link to the document will work on the email.
							$temp .= "\nAttachment: <a href='file:///" . $file->path . "'>" . $file->documentname . "</a>";
						}
					}
				}
				else
					$temp .= "\n";

				// Try to save the new ticket.
				if($ticket->save(false))
				{
					// Remove the flash message so the email will work again.
					Yii::app()->user->getFlash('success');

					// Send an email alert.
					$this->redirect(
						array('/email/email/helpopenemail', 
							'ticketid' => $ticket->ticketid,
							'category' => $ticket->categoryid,
							'subject' => $ticket->subjectid,
							'description' => $temp,
						));
				}
				else
					throw new CHttpException(400, "Ticket failed to save.");
				*/
			}
		}
		
		$this->render('create',array(
			'ticket'=>$ticket,
			'file'=>$file,
		));
	}
	
	/**
	 * This function will reopen a ticket.
	 * @param integer $id the ID of the model to be closed.
	 */
	public function actionReopen($id)
	{
		$model = $this->loadModel($id, 'TroubleTickets');
		$model->closedbyuserid = NULL;
		$model->closedate = NULL;

		if($model->update())
			$this->redirect(array('view','id'=>$model->ticketid));
		else
			throw new CHttpException(400, "Ticket failed to reopen.");
	}
	
	/**
	 * This function lists all open trouble tickets or all closed trouble tickets,
	 * depending on what status value is passed through GET.
	 */
	public function actionIndex()
	{
		// A GET variable is used to determine if the user is trying to see a list of open tickets,
		// or a list of closed ticket. First we grab that GET value and determine if the value is valid.
		$status = Yii::app()->request->getQuery('status');
		if($status != "Open" && $status != "Closed")
			throw new CHttpException(400, "Bad Request. Invalid status value given.");
		
		// Create a ticket model object.
		$ticket = new TroubleTickets;
		// Prepare the SQL criteria.
		$criteria = $ticket->TicketListCriteria($status);
		
		// Create a data provider that uses the criteria.
		$dataProvider = new CActiveDataProvider('TroubleTickets', array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>array('ticketid'=>CSort::SORT_ASC))
		));
		
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
			'status'=>$status
		));
	}
	
	/**
	 * Grab the subjects associated with the selected category. This is only used by AJAX.
	 */
	public function actionDynamicsubjects()
	{	
		$model = new TroubleTickets;
		$model->getSubjects();
	}
	
	/**
	 * Grab the tips and conditional textboxes associated with the selected subject. This is only used by AJAX.
	 */
	public function actionDynamictips()
	{	
		$model = new TroubleTickets;
		$model->getTipsAndConditions();
	}
	
	/**
	 * This function is for when the user wants to close the ticket.
	 */
	public static function closeTicket()
	{
		$ticketManager = new ManageTicket;
		$file = new Documents;

		if($ticketManager->attributes = Yii::app()->request->getPost('ManageTicket'))
		{
			// Validate the model.
			if($ticketManager->validate())
			{
				$ticket = $_GET['ticket'];
				
				// Since the user is trying to close the ticket, pass the ticketManager's content attribute 
				// to the ticket's resolution attribute.
				$ticket->resolution = $ticketManager->content;
				$ticket->closedbyuserid = Yii::app()->user->id;
				$temp = $ticketManager->content;

				// If one or more files was uploaded.
				if(!empty($_FILES))
				{
					// Loop through each file.
					foreach($_FILES['file']['name'] as $key => $value)
					{
						// Read in the properties of the current file.
						$file->file = array('tempName' => $_FILES['file']['tmp_name'][$key], 'realName' => $_FILES['file']['name'][$key]);
						$file->uploadType = 'attachment';
						$file->setDocumentAttributes();

						// Validate the current file's attributes.
						if($file->validate())
						{
							// Upload the current file to the server.
							$file->uploadFile();
							// This description is used so the link to the document will work on the website.
							$ticket->resolution .= "\nAttachment: " 
								. CHtml::link($file->documentname,array('/files/attachments/' 
									. $file->uploaddate . '/' . $file->documentname));
							// This description is used so the link to the document will work on the email.
							$temp .= "\nAttachment: " . CHtml::link($file->documentname, "file:///" . $file->path);
						}
					}
				}
				else
					$temp .= "\n";

				// Try to update the trouble ticket.
				if($ticket->update())
				{
					// Send the close ticket email alert.
					Yii::app()->controller->redirect(
						array('/email/email/helpcloseemail',
							'creator' => $ticket->openedby,
							'ticketid' => $ticket->ticketid,
							'category' => $ticket->categoryid,
							'subject' => $ticket->subjectid,
							'description' => $ticket->description,
							'resolution' => $temp,
						));
				}
				else
					throw new Exception("Update failed. Ticket did not close.");
			}
			else 
				return $ticketManager;
		}
	}
	
	/**
	 * This function will be used to import trouble tickets from the old ci site
	 * to ci2.
	 */
	public function actionImportOldTickets()
	{
		// Open the csv file.
		$fileHandle = fopen("C:\Users\cwilloughby\Desktop\helpdeskOld.csv", "r");
		
		// Loop through each row in the csv file.
		while(!feof($fileHandle))
		{
			$ticket = new TroubleTickets;
			
			// Read the current line;
			$lineOfText = fgetcsv($fileHandle);

			if(isset($lineOfText[1]))
			{
				// Read each column in the current row into a variable.
				$ticket->ticketid = $lineOfText[0];
				$openedby = $lineOfText[1];
				$ticket->opendate = $lineOfText[2];
				$ticket->categoryid = TicketCategories::model()->find('categoryname=:catname', array(':catname'=>$lineOfText[3]))->categoryid;
				$ticket->subjectid = TicketSubjects::model()->find('subjectname=:subname', array(':subname'=>$lineOfText[4]))->subjectid;
				$ticket->description = $lineOfText[5];

				if(isset($lineOfText[6]))
					$ticket->resolution = $lineOfText[6];
				if(isset($lineOfText[7]))
					$closedby = $lineOfText[7];
				if(isset($lineOfText[8]))
					$ticket->closedate = $lineOfText[8];

				// Take the username of the ticket's creator and concatenamte it into the description.
				$ticket->description .= "\nThis ticket was originally made by: " . $openedby;
				// For the id of the user who created the ticket, change the user name to id 51
				$ticket->openedby = 51;

				// Change the id of the user who closed the ticket to either 
				// 1 (for cwilloughby),
				// 14 (for sdothard),
				// or 51 (for gelliot)
				if($closedby == "cwilloughby")
					$ticket->closedbyuserid = 1;
				else if($closedby == "sdothard")
					$ticket->closedbyuserid = 14;
				else if($closedby == "gelliott")
					$ticket->closedbyuserid = 51;
				else
					$ticket->closedbyuserid = null;
				
				// Try to save the new ticket.
				if(!$ticket->save(false))
				{
					throw new CHttpException(400, "Ticket failed to import.");
				}
			}
		}
		// Close the csv file.
		fclose($fileHandle);
	}
}
