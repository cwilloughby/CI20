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
	public static function createComment()
	{
		$ticketManager = new ManageTicket;
		$file = new Documents;

		if($ticketManager->attributes = Yii::app()->request->getPost('ManageTicket'))
		{
			// Validate the model.
			if($ticketManager->validate())
			{
				$ticket = $_GET['ticket'];
				
				// Since the user is trying to make a new comment, pass the ticketManager's content attribute 
				// to the comment's content attribute.
				$comment = new Comments;
				$comment->content = $ticketManager->content;
				$temp = $comment->content;

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
							$comment->content .= "\nAttachment: " 
								. CHtml::link($file->documentname,array('/files/attachments/' 
									. $file->uploaddate . '/' . $file->documentname));
							// This description is used so the link to the document will work on the email.
							$temp .= "\nAttachment: " . CHtml::link($file->documentname, "file:///" . $file->path);
						}
					}
				}
				else
					$temp .= "\n";

				// Try to add the new comment to the database.
				if($ticket->addComment($comment))
				{
					// Send the new comment email alert.
					Yii::app()->controller->redirect(
						array('/email/email/commentemail',
							'creator' => $ticket->openedby,
							'ticketid' => $ticket->ticketid,
							'content' => $temp,
						));
				}
				else
					throw new Exception("Comment create failed.");
			}
			else 
				return $ticketManager;
		}
	}
}
