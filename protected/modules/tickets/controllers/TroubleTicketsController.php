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
		
		if($ticket->attributes = Yii::app()->request->getPost('TroubleTickets'))
		{
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
	 * Tickets are closed, instead of deleted. This function first calls the closeTicket form.
	 * @param integer $id the ID of the model to be closed.
	 */
	public function actionClose($id)
	{
		$model=$this->loadModel($id);
		// Load all comments on that ticket.
		$ticketComments=Comments::model()->with('ciTroubleTickets')->findAll('ciTroubleTickets.ticketid=:selected_id',
                 array(':selected_id'=>$id));
		
		if($model->attributes = Yii::app()->request->getPost('TroubleTickets'))
		{
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
	 * Lists all trouble tickets.
	 */
	public function actionIndex()
	{
		$status = Yii::app()->request->getQuery('status');
		if($status != "Open" && $status != "Closed")
			throw new CHttpException(404);
		
		$criteria=new CDbCriteria;
		
		// If the user has an IT role, then they can see all open tickets.
		if(Yii::app()->user->checkAccess('IT', Yii::app()->user->id))
		{
			if($status == "Open")
				$criteria->condition = "closedbyuserid IS NULL";
			else
				$criteria->condition = "closedbyuserid IS NOT NULL";
		}
		else if(Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id))
		{
			// If the user is a supervisor, find that supervisor's department
			$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);
			// Find all userids in that department.
			$allUsers = CHtml::ListData(UserInfo::model()->with('department')
					->findAll('department.departmentid=' . $department->getAttribute('departmentid')), 'userid', 'userid');
			// Put all those userid's into a string with "," seperating each value.
			$stringed = join(',', $allUsers);
			
			if($status == "Open")
				$criteria->condition = "closedbyuserid IS NULL";
			else
				$criteria->condition = "closedbyuserid IS NOT NULL";
			
			$criteria->addCondition("openedby IN (" . $stringed . ")");
		}
		else 
		{
			if($status == "Open")
				$criteria->condition = "closedbyuserid IS NULL";
			else
				$criteria->condition = "closedbyuserid IS NOT NULL";
			
			$criteria->addCondition("openedby = :user");
			$criteria->params = array(":user" => Yii::app()->user->id);
		}
		
		$dataProvider = new CActiveDataProvider('TroubleTickets', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>array(
					'ticketid'=>CSort::SORT_ASC,
				),
			)
		));
		
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
			'status'=>$status
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
		$model = new TroubleTickets;
		$model->getSubjects();
	}
	
	/**
	 * Grab the tips and conditional textboxes associated with the selected subject.
	 * This is only used by AJAX.
	 */
	public function actionDynamictips()
	{	
		$model = new TroubleTickets;
		$model->getTipsAndConditions();
	}
}
