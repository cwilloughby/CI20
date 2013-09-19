<?php
class CreateComment extends CPortlet 
{
    public $pageTitle = 'Create Comment';
	public $viewPath = '/views';
	public $ticket;
	
    /**
     * This function renders the create comment widget.
     */
    protected function renderContent()
	{
		$model = new Comments;
		$file = new Documents;

		if($model->attributes = Yii::app()->request->getPost('Comments'))
		{
			$file->attributes=$_POST['Documents'];
			
			// validate BOTH $model and $file at the same time
			$valid=$model->validate() && $file->validate();
			
			if($valid)
			{
				$file->attachment=CUploadedFile::getInstance($file,'attachment');
				$temp = $model->content;
				
				if(isset($file->attachment))
				{
					$file->save(false);
					// This description will only allow the link to work on the website.
					$model->content .= "\nAttachment: " 
						. CHtml::link($file->documentname,array('/../../../../assets/uploads/' 
							. $file->uploaddate . '/' . $file->documentname));
					// This description will only be used for the email so the link will work.
					$temp .= "\nAttachment: " . CHtml::link($file->documentname, "file:///" . $file->path);
				}
					
				$this->ticket->addComment($model);
				
				$this->controller->redirect(
					array('/email/email/commentemail',
						'creator' => $this->ticket->openedby,
						'ticketid' => $this->ticket->ticketid,
						'content' => $temp,
					));
			}
		}

		$this->render('_formComment',array(
			'model'=>$model, 'file'=>$file
		));
	}
}
