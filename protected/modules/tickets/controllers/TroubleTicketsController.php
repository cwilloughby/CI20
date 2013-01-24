<?php

class TroubleTicketsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	public $path='C:\\Users\\cwilloughby\\Desktop\\CI2Yii\\';
	
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		// Load the ticket.
		$ticket=$this->loadModel($id);
		// Load all comments on that ticket.
		$ticketComments=Comments::model()->with('ciTroubleTickets')->findAll('ciTroubleTickets.ticketid=:selected_id',
                 array(':selected_id'=>$id));
		// Setup the new comment form.
		$comment=$this->createComment($ticket);
		
		$this->render('view',array(
			'model'=>$ticket,
			'ticketComments'=>$ticketComments,
			'comment'=>$comment,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TroubleTickets;

		if(isset($_POST['TroubleTickets']))
		{
			$model->attributes=$_POST['TroubleTickets'];
			
			// Remove the first and last elements from the POST array.
			array_shift($_POST);
			array_pop($_POST);
			
			$model->description .= "\n\n";
			
			// Grab all the data from the conditionals and put them in the description.
			foreach($_POST as $key => $value) 
				$model->description .= $key . ": " . $value . "\n";
			
			$model->attach=CUploadedFile::getInstance($model,'attach');
			if(isset($model->attach))
			{
				$fileName = $model->attach->getName();
				$model->description .= "Attachment: " . $this->path . $fileName;
			}
			else
				$model->description .= "Attachment: None";
			
			if($model->save())
			{
				// Save the attachment if one was given.
				if($fileName != "None")
					$model->attach->saveAs($this->path . $fileName, 'true');
				
				$this->redirect(
					array('/email/email/helpopenemail', 
						'ticketid' => $model->ticketid,
						'category' => $model->categoryid,
						'subject' => $model->subjectid,
						'description' => $model->description,
					));
			}
		}
		
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['TroubleTickets']))
		{
			$model->attributes=$_POST['TroubleTickets'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ticketid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Tickets are closed, instead of deleted. This function first calls the closeTicket form.
	 * @param integer $id the ID of the model to be closed.
	 */
	public function actionClose($id)
	{
		$model=$this->loadModel($id);
		
		if(isset($_POST['TroubleTickets']))
		{
			$model->attributes=$_POST['TroubleTickets'];
			$model->closedbyuserid = Yii::app()->user->id;
			
			if($model->update())
			{
				$this->redirect(
					array('/email/email/helpcloseemail',
						'creator' => $model->openedby,
						'ticketid' => $model->ticketid,
						'category' => $model->categoryid,
						'subject' => $model->subjectid,
						'description' => $model->description,
						'resolution' => $model->resolution,
					));
			}
		}
		
		$this->render('close',array(
			'model'=>$model,
		));
	}
	
	/**
	 * This function will reopen a ticket.
	 * @param integer $id the ID of the model to be closed.
	 */
	public function actionReopen($id)
	{
		$model = $this->loadModel($id);
		$model->closedbyuserid = NULL;
		$model->closedate = NULL;
		
		if($model->update())
			$this->redirect(array('view','id'=>$model->ticketid));
	}
	
	/**
	 * Lists all open trouble tickets.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TroubleTickets', 
			array(
				'criteria'=>array(
					'condition'=>'closedbyuserid IS NULL'
				)
			)
		);
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Lists all closed trouble tickets.
	 */
	public function actionClosedIndex()
	{
		$dataProvider=new CActiveDataProvider('TroubleTickets', 
			array(
				'criteria'=>array(
					'condition'=>'closedbyuserid IS NOT NULL'
				)
			)
		);
		
		$this->render('closedIndex',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TroubleTickets('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TroubleTickets']))
			$model->attributes=$_GET['TroubleTickets'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TroubleTickets::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/*
	 * Grab the subjects associated with the selected category.
	 */
	public function actionDynamicsubjects()
	{	
		$subjects = TicketSubjects::model()->with('ciTicketCategories')->findAll('ciTicketCategories.categoryid=:selected_id',
                 array(':selected_id'=>(int) $_POST['TroubleTickets']['categoryid']));

		/*
		$subjects = Yii::app()->db->createCommand()
			->select('ci_ticket_subjects.subjectid, subjectname')
			->from('ci_ticket_subjects')
			->leftJoin('ci_category_subject_bridge','ci_category_subject_bridge.subjectid = ci_ticket_subjects.subjectid')
			->where('ci_category_subject_bridge.categoryid=:id', array(':id'=>$_POST['TroubleTickets']['categoryid']))
			->queryAll();
		*/
		$data = array("0"=>"Select a subject") + CHtml::listData($subjects, 'subjectid', 'subjectname');
		
		foreach($data as $value => $name) {
			echo CHtml::tag('option', array('value' => $value), CHtml::encode($name),true);
		}
	}
	
	/*
	 * Grab the tips associated with the selected subject.
	 */
	public function actionDynamictips()
	{	
		$tips = Tips::model()->with('ciTicketSubjects')->findAll('ciTicketSubjects.subjectid=:selected_id',
				array(':selected_id'=>(int) $_POST['TroubleTickets']['subjectid']));

		$data = CHtml::listData($tips, 'tipid', 'tip');
		
		echo CHtml::ListBox('tips', ' ', $data, array('disabled'=>'true','style'=>'height:85px; border:none; width:100%; background-color:white; color:black'));
		
		$conditionals = TicketConditionals::model()->with('ciTicketSubjects')->findAll('ciTicketSubjects.subjectid=:selected_id',
				array(':selected_id'=>(int) $_POST['TroubleTickets']['subjectid']));
		
		
		foreach($conditionals as $key => $value)
		{
			echo CHtml::label($conditionals[$key]->label,$conditionals[$key]->label);
			echo CHtml::textField($conditionals[$key]->label,'');
		}
	}
	
	/**
	 * Creates a new comment on an issue
	 */
	protected function createComment($ticket)
	{
		$comment=new Comments;
		if(isset($_POST['Comments']))
		{
			$comment->attributes=$_POST['Comments'];
			if($ticket->addComment($comment))
			{
				Yii::app()->user->setFlash('commentSubmitted',"Your comment has been added.");
				$this->refresh();
			}
		}
		return $comment;
	}
}
