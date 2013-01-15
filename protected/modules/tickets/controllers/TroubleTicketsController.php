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
		$model=new TroubleTickets;

		if(isset($_POST['TroubleTickets']))
		{
			$model->attributes=$_POST['TroubleTickets'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ticketid));
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
				$this->redirect(array('view','id'=>$model->ticketid));
		}
		
		$this->render('close',array(
			'model'=>$model,
		));
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

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='trouble-tickets-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/*
	 * Grab the subjects associated with the selected category.
	 */
	public function actionDynamicsubjects()
	{	
		$subjects = TicketSubjects::model()->with('ciTicketCategories')->findAll('ciTicketCategories.categoryid=:selected_id',
                 array(':selected_id'=>(int) $_POST['TroubleTickets']['categoryid']));

		$data = array_merge(array("0"=>"Select a subject"),CHtml::listData($subjects, 'subjectid', 'subjectname'));
		
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
		
		//echo CHtml::tag('div', array('style' => 'display:block'), CHtml::encode($name),true);
		
		foreach($data as $value => $name) {
			echo CHtml::tag('option', array('value' => $value), CHtml::encode($name),true);
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
				Yii::app()->user->setFlash('commentSubmitted',"Your comment has been added." );
				$this->refresh();
			}
		}
		return $comment;
	}
}
