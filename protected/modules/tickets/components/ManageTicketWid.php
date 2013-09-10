<?php
class ManageTicketWid extends CPortlet 
{
    public $pageTitle = 'Close Ticket';
	public $ticket;
	
    /**
     * This function renders the close ticket widget.
     */
    protected function renderContent()
	{
		try
		{
			$ticketManager = new ManageTicket;
			$file = new Documents;

			if($ticketManager->attributes = Yii::app()->request->getPost('ManageTicket'))
			{
				if(isset($_POST['submittype']))
				{
					if($_POST['submittype'] == 'comment')
						$this->processNewComment($ticketManager, $file);
					else if($_POST['submittype'] == 'close')
						$this->processTicketClose($ticketManager, $file);
				}
				else
					throw new Exception("No submit type was provided.");
			}
		}
		catch(Exception $ex)
		{
			echo "Ticket manager failed with error " . $ex;
		}
		
		
		$this->render('_manageTicket',array(
			'model'=>$ticketManager, 'file'=>$file
		));
	}
	
	/**
	 * This function is for when the user wants to close the ticket.
	 * @param ManageTicket $ticketManager
	 * @param Document $file
	 */
	public function processTicketClose($ticketManager, $file)
	{
		// Validate the model.
		if($ticketManager->validate())
		{
			$this->ticket->resolution = $ticketManager->content;
			$this->ticket->closedbyuserid = Yii::app()->user->id;
			$temp = $ticketManager->content;

			// If a file was uploaded.
			if(!empty($_FILES))
			{
				// Loop through each file.
				foreach($_FILES['file']['name'] as $key => $value)
				{
					// Read in the current file.
					$file->file = array('tempName' => $_FILES['file']['tmp_name'][$key], 'realName' => $_FILES['file']['name'][$key]);
					$file->uploadType = 'attachment';
					$file->setDocumentAttributes();

					// Validate attributes.
					if($file->validate())
					{
						// Upload file to server.
						$file->uploadFile();
						// This description will only allow the link to work on the website.
						$this->ticket->resolution .= "\nAttachment: " 
							. CHtml::link($file->documentname,array('/files/attachments/' 
								. $file->uploaddate . '/' . $file->documentname));
						// This description will only be used for the email so the link will work.
						$temp .= "\nAttachment: " . CHtml::link($file->documentname, "file:///" . $file->path);
					}
				}
			}
			else
				$temp .= "\n";
			
			// Try to update the trouble ticket.
			if($this->ticket->update())
			{
				// Send the close ticket email alert.
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
			else
				throw new Exception("Update failed. Ticket did not close.");
		}
	}
	
	/**
	 * This function is for when the user wants to make a new comment.
	 * @param ManageTicket $ticketManager
	 * @param Document $file
	 */
	public function processNewComment($ticketManager, $file)
	{
		// Validate the model.
		if($ticketManager->validate())
		{
			$comment = new Comments;
			$comment->content = $ticketManager->content;
			$temp = $comment->content;
			
			// If a file was uploaded.
			if(!empty($_FILES))
			{
				// Loop through each file.
				foreach($_FILES['file']['name'] as $key => $value)
				{
					$file->file = array('tempName' => $_FILES['file']['tmp_name'][$key], 'realName' => $_FILES['file']['name'][$key]);
					$file->uploadType = 'attachment';
					$file->setDocumentAttributes();

					// Validate attributes.
					if($file->validate())
					{
						// Upload file to server.
						$file->uploadFile();
						// This description will only allow the link to work on the website.
						$comment->content .= "\nAttachment: " 
							. CHtml::link($file->documentname,array('/files/attachments/' 
								. $file->uploaddate . '/' . $file->documentname));
						// This description will only be used for the email so the link will work.
						$temp .= "\nAttachment: " . CHtml::link($file->documentname, "file:///" . $file->path);
					}
				}
			}
			else
				$temp .= "\n";

			// Try to add the new comment to the database.
			if($this->ticket->addComment($comment))
			{
				// Send the new comment email alert.
				$this->controller->redirect(
					array('/email/email/commentemail',
						'creator' => $this->ticket->openedby,
						'ticketid' => $this->ticket->ticketid,
						'content' => $temp,
					));
			}
			else
				throw new Exception("Comment create failed.");
		}
	}
}