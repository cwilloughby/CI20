<?php

class CommentsController extends Controller
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
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'Comments'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'Comments'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Comments'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'Comments'),
		);
	}

	/**
	 * Deletes a particular model. Makes use of the beforeDelete event in the model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		// Now we can delete the comment.
		$this->loadModel($id, 'Comments')->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	/**
	 * This function is for when the user wants to make a new comment.
	 */
	public static function createComment($ticket)
	{
		$model = new ManageTicket;
		$comment = new Comments;
		$file = new Documents;
		
		if($model->attributes = Yii::app()->request->getPost('ManageTicket'))
		{
			$file->attributes=$_POST['Documents'];
			
			if($model->validate())
			{
				$file->file=CUploadedFile::getInstance($file,'file');
				$comment->content = $model->content;
				$temp = $comment->content;

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
						$comment->content .= "\nAttachment: " 
							. CHtml::link($file->documentname,array("/files/attachments/" 
								. $file->uploaddate . "/" . $file->documentname));
						// This description is used so the link to the document will work on the email.
						$temp .= '<br/><br/>Attachment: <a href="file:///' . $file->path . '">' . $file->documentname . '</a>';
					}
				}

				$ticket->addComment($comment);

				Yii::app()->controller->redirect(
					array('/email/email/commentemail',
						'creator' => $ticket->openedby,
						'ticketid' => $ticket->ticketid,
						'content' => $temp,
						'category' => $ticket->categoryid,
						'subject' => $ticket->subjectid,
						'ticketBody' => str_replace("/files/attachments/", "file:///C:/wamp/files/attachments/" , $ticket->description),
					));
			}
		}
	}
}
