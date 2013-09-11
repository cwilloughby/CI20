<?php

class EvaluationsController extends Controller
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
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Evaluations'),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$dataProvider=new CActiveDataProvider('EvaluationAnswers', array(
			'criteria'=>array(
				'condition'=>'evaluationid=' . $id
			)));
		$total = $dataProvider->getTotalitemCount();
		$dataProvider=new CActiveDataProvider('EvaluationAnswers', array(
			'criteria'=>array(
				'condition'=>'evaluationid=' . $id
			),
			'pagination'=>array('pageSize'=>$total)));
		
		// If an answer was posted.
		if(isset($_POST['EvaluationAnswers']))
		{
			// Record the answer.
			$model=$this->loadAnswerModel($_POST['EvaluationAnswers']['evaluationid'], $_POST['EvaluationAnswers']['questionid']);
			$model->attributes=$_POST['EvaluationAnswers'];
			$model->save();
		}
		// If the PDF print button was pressed.
		else if(isset($_POST['PDFButton']))
		{
			$html2pdf = Yii::app()->ePdf->HTML2PDF('', 'A5');
			$html2pdf->WriteHTML($this->renderPartial('pdfoutput', array(
				'model'=>$this->loadModel($id, 'Evaluations'),
				'answersDataProvider'=>$dataProvider,
				), true));
			$html2pdf->Output();
		}
		else
		{
			$this->render('view',array(
				'model'=>$this->loadModel($id, 'Evaluations'),
				'answersDataProvider'=>$dataProvider,
			));
		}
	}

	/**
	 * Creates a new model. Makes use of the beforeSave and afterSave events in the model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Evaluations;
		
		// Find all departments that the current user is the supervisor of.
		$departments = Departments::model()->findAll('supervisorid=' . Yii::app()->user->id);
		
		// If the create evaluation form was posted.
		if($model->attributes = Yii::app()->request->getPost('Evaluations'))
		{
			// Save the new evaluation.
			if($model->save())
			{
				$questions = EvaluationQuestions::model()->prepareQuestions($departments);
				
				foreach($questions as $question)
				{
					// Each question will eventaully have an answer, but for now we create blank entries in the
					// ci_evaluation_answers table to bridge the questions to the new evaluation.
					$answer = new EvaluationAnswers;
					$answer->evaluationid = $model->evaluationid;
					$answer->questionid = $question;
					$answer->save();
				}
				// Redirect to the edit page so the current user can begin to fill out the evaluation.
				$this->redirect(array('edit','id'=>$model->evaluationid, 'EvaluationAnswers_page'=>1));
			}
		}

		// Prepare a list of users that the current user is allowed to make evaluations for.
		$allUsers = $model->prepareUserList($departments);

		$this->render('create',array(
			'model'=>$model,
			'allUsers' => $allUsers,
		));
	}

	/**
	 * Change the employee being evaluated. Makes use of the beforeSave and afterSave events in the model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id, 'Evaluations');

		if($model->attributes = Yii::app()->request->getPost('Evaluations'))
		{
			if($model->save())
				$this->redirect(array('view','id'=>$model->evaluationid));
		}
		
		// Find the user's department.
		$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);
		// Find all active users in that department, except for the current user and put them in an array.
		$allUsers = CHtml::ListData(UserInfo::model()->findAll(
				'departmentid=' . $department->getAttribute('departmentid') 
				. ' AND active = 1 AND userid !=' . Yii::app()->user->id), 'userid', 'username');
		
		$this->render('update',array(
			'model'=>$model,
			'allUsers' => $allUsers,
		));
	}
	
	/**
	 * This function is used to answer the evaluation questions. Makes use of the beforeSave event in the EvaluationAnswers model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id)
	{
		$dataProvider=new CActiveDataProvider('EvaluationAnswers', array(
			'criteria'=>array('condition'=>'evaluationid=' . $id),
			'pagination'=>array(
				'pageSize'=>1,
			)));
		
		// If an answer was posted, 
		if(isset($_POST['EvaluationAnswers']))
		{
			// Record the answer.
			$model=$this->loadAnswerModel($_POST['EvaluationAnswers']['evaluationid'], $_POST['EvaluationAnswers']['questionid']);
			$model->attributes=$_POST['EvaluationAnswers'];
			$model->save();

			$page = $_GET['EvaluationAnswers_page'] + 1;
			// Redirect to the next question in the list. If all questions are answered, redirect to the view page.
			if($page <= $dataProvider->totalItemCount)
				$this->redirect(array('edit','id'=>$model->evaluationid, 'EvaluationAnswers_page'=>$page));
			else
				$this->redirect(array('view','id'=>$model->evaluationid));
		}

		$this->render('edit',array(
			'model'=>$this->loadModel($id, 'Evaluations'),
			'answersDataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// If the user has supervisor access.
		if(Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id))
		{
			// Find the user's department.
			$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);
			// Find all users in that department.
			$allUsers = CHtml::ListData(UserInfo::model()->with('department')
					->findAll('department.departmentid=' . $department->getAttribute('departmentid')), 'userid', 'userid');
			$stringed = join(',', $allUsers);
			
			// Find all evaluations for those users.
			$dataProvider=new CActiveDataProvider('Evaluations',
				array(
					'criteria'=>array(
						'condition'=> "employee IN (" . $stringed . ")"
					)
				));
		}
		else
		{
			// Find all evaluations for the user.
			$dataProvider=new CActiveDataProvider('Evaluations',
				array(
					'criteria'=>array(
						'condition'=> "employee = " . Yii::app()->user->id
					)
				));
		}
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadAnswerModel($evaluationid = null, $questionid = null)
	{
		if(is_null($evaluationid) || is_null($questionid))
			throw new CHttpException(400, "Bad Request! Ids must be given.");
		$model= EvaluationAnswers::model()->findByPk(array('evaluationid' => $evaluationid, 'questionid' => $questionid));
		if($model===null)
			throw new CHttpException(404,'The requested data does not exist.');
		return $model;
	}
}
