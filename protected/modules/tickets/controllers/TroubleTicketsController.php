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
			'postOnly + delete', // We only allow deletion via POST requests.
			'ajaxOnly + dynamicsubjects, dynamictips', // We only allow these actions to run via AJAX requests.
		);
	}
	
	// External Actions
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
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='ticketsForm')
		{
			echo CActiveForm::validate($ticket);
			Yii::app()->end();
		}
		
		if($ticket->attributes = Yii::app()->request->getPost('TroubleTickets'))
		{
			if($ticket->validate())
			{
				$ticket->IsolateAndRetrieveConditionals($_POST);
				$temp = $ticket->description;
				
				// Were any files attached to the new ticket?
				if(!empty($_FILES))
				{
					// Loop throught each file.
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
							$ticket->description .= "\nAttachment: " 
								. CHtml::link($file->documentname,array('/files/uploads/' 
									. $file->uploaddate . '/' . $file->documentname));
							// This description will only be used for the email so the link will work.
							$temp .= "\nAttachment: <a href='file:///" . $file->path . "'>" . $file->documentname . "</a>";
						}
					}
				}
				else
					$temp .= "\n";
				
				$ticket->save(false);
				
				// Remove the flash message so the email will work again.
				Yii::app()->user->getFlash('success');
				
				$this->redirect(
					array('/email/email/helpopenemail', 
						'ticketid' => $ticket->ticketid,
						'category' => $ticket->categoryid,
						'subject' => $ticket->subjectid,
						'description' => $temp,
					));
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
	}
	
	/**
	 * Lists all trouble tickets.
	 */
	public function actionIndex()
	{
		$status = Yii::app()->request->getQuery('status');
		if($status != "Open" && $status != "Closed")
			throw new CHttpException(404);
		
		$ticket = new TroubleTickets;
		$criteria = $ticket->TicketListCriteria($status);
		
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
}
