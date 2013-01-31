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
		$ticket=new TroubleTickets;
		$file=new Documents;
		
		if(isset($_POST['TroubleTickets']))
		{
			$ticket->attributes=$_POST['TroubleTickets'];
			$file->attributes=$_POST['Documents'];
			
			// validate BOTH $ticket and $file at the same time
			$valid=$ticket->validate() && $file->validate();
		
			if($valid)
			{
				$file->attachment=CUploadedFile::getInstance($file,'attachment');
				
				// Remove the first and last elements from the POST array.
				array_shift($_POST);
				array_pop($_POST);
				array_pop($_POST);

				$ticket->description .= "\n\n";
			
				// Grab all the data from the conditionals and put them in the description.
				foreach($_POST as $key => $value) 
					$ticket->description .= $key . ": " . $value . "\n";
				
				$temp = $ticket->description;
				
				if(isset($file->attachment))
				{
					$file->save(false);
					// This description will only allow the link to work on the website.
					$ticket->description .= "\nAttachment: " 
						. CHtml::link($file->documentname,array('/../../../../assets/uploads/' 
							. $file->uploaddate . '/' . $file->documentname));
					// This description will only be used for the email so the link will work.
					$temp .= "\nAttachment: <a href='file:///" . $file->path . "'>" . $file->documentname . "</a>";
				}
				else
					$temp .= "\n";
				
				$ticket->save(false);
				
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
		// If the user has an IT role then they can see all open tickets.
		if(Assignments::model()->find("userid = " . Yii::app()->user->id . " AND itemname = 'IT'"))
		{
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=>'closedbyuserid IS NULL'
					)
				)
			);
		}
		else if(Assignments::model()->find("userid = " . Yii::app()->user->id . " AND itemname = 'Supervisor'"))
		{
			// If the user is a supervisor.
			// Find that supervisor's department
			$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);

			// Find all users in that department.
			$allUsers = CHtml::ListData(UserInfo::model()->with('department')
					->findAll('department.departmentid=' . $department->getAttribute('departmentid')), 'userid', 'userid');
			
			// Find all the tickets for those users.
			$stringed = join(',', $allUsers);
			
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=> "closedbyuserid IS NULL AND openedby IN (" . $stringed . ")"
					)
				)
			);
		}
		else 
		{
			// Only show tickets that this user has opened.
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=> 'closedbyuserid IS NULL AND openedby= ' . Yii::app()->user->id
					)
				)
			);
		}

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Lists all closed trouble tickets.
	 */
	public function actionClosedIndex()
	{
		// If the user has an IT role then they can see all closed tickets.
		if(Assignments::model()->find("userid = " . Yii::app()->user->id . " AND itemname = 'IT'"))
		{
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=>'closedbyuserid IS NOT NULL'
					)
				)
			);
		}
		else if(Assignments::model()->find("userid = " . Yii::app()->user->id . " AND itemname = 'Supervisor'"))
		{
			// If the user is a supervisor.
			// Find that supervisor's department
			$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);

			// Find all users in that department.
			$allUsers = CHtml::ListData(UserInfo::model()->with('department')
					->findAll('department.departmentid=' . $department->getAttribute('departmentid')), 'userid', 'userid');
			
			// Find all the tickets for those users.
			$stringed = join(',', $allUsers);
			
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=> "closedbyuserid IS NOT NULL AND openedby IN (" . $stringed . ")"
					)
				)
			);
		}
		else 
		{
			// Only show tickets that this user has closed.
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=>'openedby= ' . Yii::app()->user->id . ' AND closedbyuserid IS NOT NULL'
					)
				)
			);
		}
		
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
		//$subjects = TicketSubjects::model()->with('ciTicketCategories')->findAll('ciTicketCategories.categoryid=:selected_id',
        //        array(':selected_id'=>(int) $_POST['TroubleTickets']['categoryid']));
		
		$subjects = Yii::app()->db->createCommand()
			->select('ci_ticket_subjects.subjectid, subjectname')
			->from('ci_ticket_subjects')
			->leftJoin('ci_category_subject_bridge','ci_category_subject_bridge.subjectid = ci_ticket_subjects.subjectid')
			->where('ci_category_subject_bridge.categoryid=:id', array(':id'=>$_POST['categoryid']))
			->queryAll();

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
		//$tips = Tips::model()->with('ciTicketSubjects')->findAll('ciTicketSubjects.subjectid=:selected_id',
		//		array(':selected_id'=>(int) $_POST['TroubleTickets']['subjectid']));

		$tips = Yii::app()->db->createCommand()
			->select('ci_tips.tipid, tip')
			->from('ci_tips')
			->leftJoin('ci_subject_tips','ci_subject_tips.tipid = ci_tips.tipid')
			->where('ci_subject_tips.subjectid=:id', array(':id'=>$_POST['subjectid']))
			->queryAll();
		
		$data = CHtml::listData($tips, 'tipid', 'tip');
		
		echo CHtml::ListBox('tips', ' ', $data, array('disabled'=>'true','style'=>'height:85px; border:none; width:100%; background-color:white; color:black'));
		
		//$conditionals = TicketConditionals::model()->with('ciTicketSubjects')->findAll('ciTicketSubjects.subjectid=:selected_id',
		//		array(':selected_id'=>(int) $_POST['TroubleTickets']['subjectid']));
		
		$conditionals = Yii::app()->db->createCommand()
			->select('ci_ticket_conditionals.label')
			->from('ci_ticket_conditionals')
			->leftJoin('ci_subject_conditions','ci_subject_conditions.conditionalid = ci_ticket_conditionals.conditionalid')
			->where('ci_subject_conditions.subjectid=:id', array(':id'=>$_POST['subjectid']))
			->queryAll();
		
		foreach($conditionals as $key1 => $value1)
		{
			foreach($value1 as $key2 => $value2)
			{
				echo CHtml::label($value2,$value2);
				echo CHtml::textField($value2,'');
			}
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
				$this->redirect(
					array('/email/email/commentemail',
						'creator' => $ticket->openedby,
						'ticketid' => $ticket->ticketid,
						'content' => $comment->content,
					));
			}
		}
		return $comment;
	}
}
