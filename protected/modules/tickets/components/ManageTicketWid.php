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
		$model = new ManageTicket;
		$file = new Documents;
		
		if($model->attributes = Yii::app()->request->getPost('ManageTicket'))
		{
			$file->attributes=$_POST['Documents'];
		
			if(isset($_POST['yt1']))
			{
				if($model->validate())
				{
					$this->ticket->resolution = $model->content;
					$this->ticket->closedbyuserid = Yii::app()->user->id;
					$temp = $model->content;
					
					if(!empty($_FILES))
					{
						// Read in the current file.
						$file->file = array('tempName' => $_FILES['file']['tmp_name'], 'realName' => $_FILES['file']['name']);
						$file->type = 'attachment';
						if($file->validate())
						{
							$file->save(false);
							// This description will only allow the link to work on the website.
							$this->ticket->resolution .= "\nAttachment: " 
								. CHtml::link($file->documentname,array('/../../../../assets/uploads/' 
									. $file->uploaddate . '/' . $file->documentname));
							// This description will only be used for the email so the link will work.
							$temp .= "\nAttachment: " . CHtml::link($file->documentname, "file:///" . $file->path);
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
								'resolution' => $this->ticket->resolution,
							));
					}
				}
			}
			else if(isset($_POST['yt0']))
			{
				echo "New Comment button was pressed!";
				
				$comment = new Comments;
				
				// validate BOTH $model and $file at the same time
				$valid=$model->validate() && $file->validate();
				
				if($valid)
				{
					$file->attachment=CUploadedFile::getInstance($file,'attachment');
					$comment->content = $model->content;
					$temp = $comment->content;

					if(isset($file->attachment))
					{
						$file->save(false);
						// This description will only allow the link to work on the website.
						$comment->content .= "\nAttachment: " 
							. CHtml::link($file->documentname,array('/../../../../assets/uploads/' 
								. $file->uploaddate . '/' . $file->documentname));
						// This description will only be used for the email so the link will work.
						$temp .= "\nAttachment: " . CHtml::link($file->documentname, "file:///" . $file->path);
					}

					$this->ticket->addComment($comment);

					$this->controller->redirect(
						array('/email/email/commentemail',
							'creator' => $this->ticket->openedby,
							'ticketid' => $this->ticket->ticketid,
							'content' => $temp,
						));
				}
			}
		}
		$this->render('_manageTicket',array(
			'model'=>$model, 'file'=>$file
		));
	}
}