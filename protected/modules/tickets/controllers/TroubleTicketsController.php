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
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='trouble-tickets-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if(isset($_POST['TroubleTickets']))
		{
			$ticket->attributes=$_POST['TroubleTickets'];
			$file->attributes=$_POST['Documents'];
			
			// Validate BOTH $ticket and $file at the same time.
			$valid=$ticket->validate() && $file->validate();
		
			if($valid)
			{
				$file->attachment=CUploadedFile::getInstance($file,'attachment');
				
				// Remove the first two elements and the last two elements from the POST array
				// to isolate the conditionals.
				array_shift($_POST);
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
		// Load all comments on that ticket.
		$ticketComments=Comments::model()->with('ciTroubleTickets')->findAll('ciTroubleTickets.ticketid=:selected_id',
                 array(':selected_id'=>$id));
		
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
			'ticketComments'=>$ticketComments
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
		if(Yii::app()->user->checkAccess('IT', Yii::app()->user->id))
		{
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=>'closedbyuserid IS NULL'
					),
					'sort'=>array(
						'defaultOrder'=>array(
							'ticketid'=>CSort::SORT_ASC,
						),
					),
				)
			);
		}
		else if(Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id))
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
					),
					'sort'=>array(
						'defaultOrder'=>array(
							'ticketid'=>CSort::SORT_ASC,
						),
					),
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
					),
					'sort'=>array(
						'defaultOrder'=>array(
							'ticketid'=>CSort::SORT_ASC,
						),
					),
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
		if(Yii::app()->user->checkAccess('IT', Yii::app()->user->id))
		{
			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'criteria'=>array(
						'condition'=>'closedbyuserid IS NOT NULL'
					),
					'sort'=>array(
						'defaultOrder'=>array(
							'ticketid'=>CSort::SORT_ASC,
						),
					),
				)
			);
		}
		else if(Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id))
		{
			// If the user is a supervisor, find that supervisor's department.
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
					),
					'sort'=>array(
						'defaultOrder'=>array(
							'ticketid'=>CSort::SORT_ASC,
						),
					),
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
					),
					'sort'=>array(
						'defaultOrder'=>array(
							'ticketid'=>CSort::SORT_ASC,
						),
					),
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
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		if(isset($_GET['TroubleTickets']))
		{
			$model->attributes=$_GET['TroubleTickets'];
			
			if((int)$model->opendate)
			{
				$model->opendate = date('Y-m-d', strtotime($model->opendate));
			}
			if((int)$model->closedate)
			{
				$model->closedate = date('Y-m-d', strtotime($model->closedate));
			}
		}

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
	
	/**
	 * Grab the subjects associated with the selected category.
	 * This is only used by AJAX.
	 */
	public function actionDynamicsubjects()
	{	
		// Grab all the subjects of the selected category.
		$subjects = Yii::app()->db->createCommand()
			->select('ci_ticket_subjects.subjectid, subjectname')
			->from('ci_ticket_subjects')
			->leftJoin('ci_category_subject_bridge','ci_category_subject_bridge.subjectid = ci_ticket_subjects.subjectid')
			->where('ci_category_subject_bridge.categoryid=:id', array(':id'=>$_GET['categoryid']))
			->queryAll();
		
		// Put the subjects into a list that is compatible with CHtml::tag
		$data = CHtml::listData($subjects, 'subjectid', 'subjectname');
		echo CHtml::tag('option',array('value' => ''), CHtml::encode('Select a subject'),true);
		
		// Put each subject into the dropdown box.
		foreach($data as $value => $name) {
			echo CHtml::tag('option', array('value' => $value), $name,true);
		}
	}
	
	/**
	 * Grab the tips and conditional textboxes associated with the selected subject.
	 * This is only used by AJAX.
	 */
	public function actionDynamictips()
	{	
		// Grab all the tips and conditionals of the selected subject.
		$tipsAndConditions = Yii::app()->db->createCommand()
			->select('ci_tips.tipid, ci_tips.tip, ci_ticket_conditionals.label')
			->from('ci_tips')
			->leftJoin('ci_subject_tips','ci_subject_tips.tipid = ci_tips.tipid')
			->leftJoin('ci_ticket_subjects','ci_ticket_subjects.subjectid = ci_subject_tips.subjectid')
			->leftJoin('ci_subject_conditions','ci_subject_conditions.subjectid = ci_ticket_subjects.subjectid')
			->leftJoin('ci_ticket_conditionals','ci_ticket_conditionals.conditionalid = ci_subject_conditions.conditionalid')
			->where('ci_subject_tips.subjectid=:id', array(':id'=>$_GET['subjectid']))
			->queryAll();

		// Put the tips into a list that is compatible with CHtml::ListBox
		$tipsData = CHtml::listData($tipsAndConditions, 'tipid', 'tip');
		
		// Output the tips.
		foreach($tipsData as $tip)
			echo CHtml::label($tip,$tip);

		echo "<br/>";
		// Put the conditionals into a list that is compatible with CHtml::label and CHtml::textField
		$conditionalData = CHtml::listData($tipsAndConditions, 'label', 'label');
		
		// Output each conditional textbox and its label.
		foreach($conditionalData as $value => $name)
		{
			if(isset($name))
			{
				echo CHtml::label($value,$name, array('required' => true));
				echo CHtml::textField($value,'', array('required' => true));
			}
		}
	}
	
	/**
	 * Creates a new comment on an issue
	 */
	protected function createComment($ticket)
	{
		$comment=new Comments;
		$file=new Documents;
		
		if(isset($_POST['Comments']))
		{
			$comment->attributes=$_POST['Comments'];
			$file->attributes=$_POST['Documents'];
			
			// validate BOTH $comment and $file at the same time
			$valid=$comment->validate() && $file->validate();
			
			if($valid)
			{
				$file->attachment=CUploadedFile::getInstance($file,'attachment');
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
					
				$ticket->addComment($comment);
				
				$this->redirect(
					array('/email/email/commentemail',
						'creator' => $ticket->openedby,
						'ticketid' => $ticket->ticketid,
						'content' => $temp,
					));
			}
		}
		return array($comment,$file);
	}
}
