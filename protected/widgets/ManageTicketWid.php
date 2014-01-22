<?php
/*
class ManageTicketWid extends CPortlet 
{
    public $pageTitle = 'Ticket Manager';
	public $viewPath = '/views';
	public $ticket;
	
    /**
     * This function renders the manage ticket widget.
     */
	 /*
    protected function renderContent()
	{
		try
		{
			$ticketManager = new ManageTicket;
			$file = new Documents;

			if(Yii::app()->request->getPost('ManageTicket'))
			{
				if(isset($_POST['submittype']))
				{
					// If the user is trying to submit a new comment.
					if($_POST['submittype'] == 'comment')
					{
						$_GET['ticket'] = $this->ticket;
						$ticketManager = CommentsController::createComment();
					}
					// If the user is trying to close the ticket.
					else if($_POST['submittype'] == 'close')
					{
						$_GET['ticket'] = $this->ticket;
						$ticketManager = TroubleTicketsController::closeTicket();
					}
					else
						throw new Exception("Invalid submit type was provided.");
				}
				else
					throw new Exception("No submit type was provided.");
			}
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "TMW1: Ticket manager failed with error " . $ex);
		}
		
		$this->render('_manageTicket',array(
			'model'=>$ticketManager, 'file'=>$file
		));
	}
}
*/

class ManageTicketWid extends CPortlet 
{
    public $pageTitle = 'Ticket Manager';
	public $ticket;
	
    /**
     * This function renders the close ticket widget.
     */
    protected function renderContent()
	{
		$model = new ManageTicket;
		$file = new Documents;
		
		if($model->attributes = Yii::app()->request->getPost('ManageTicket'))
		{
			$file->attributes=$_POST['Documents'];
		
			if(isset($_POST['yt1']))
			{
				if($model->validate())
				{
					$file->file =CUploadedFile::getInstance($file,'file');
					$this->ticket->resolution = $model->content;
					$this->ticket->closedbyuserid = Yii::app()->user->id;
					$temp = $model->content;
					
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
							$this->ticket->resolution .= "\nAttachment: " 
								. CHtml::link($file->documentname,array('/files/attachments/' 
									. $file->uploaddate . '/' . $file->documentname));
							// This description is used so the link to the document will work on the email.
							$temp .= "\nAttachment: <a href='file:///" . $file->path . "'>" . $file->documentname . "</a>";
						}
					}
					
					if($this->ticket->update())
					{
						$this->controller->redirect(
							array('/email/email/helpcloseemail',
								'creator' => $this->ticket->openedby,
								'ticketid' => $this->ticket->ticketid,
								'category' => $this->ticket->categoryid,
								'subject' => $this->ticket->subjectid,
								'description' => $this->ticket->description,
								'resolution' => $temp,
							));
					}
				}
			}
			else if(isset($_POST['yt0']))
			{
				// The user is trying to enter a new comment on a ticket.
				$comment = new Comments;
				
				if($model->validate())
				{
					CommentsController::createComment($this->ticket);
				}
			}
		}
		$this->render('_manageTicket',array(
			'model'=>$model, 'file'=>$file
		));
	}
}
