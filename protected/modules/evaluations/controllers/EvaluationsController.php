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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$dataProvider=new CActiveDataProvider('EvaluationAnswers', array('criteria'=>array('condition'=>'evaluationid=' . $id)));
		if(isset($_POST['EvaluationAnswers']))
		{
			// An answer was posted, record it.
			$model=$this->loadAnswerModel($_POST['EvaluationAnswers']['evaluationid'], $_POST['EvaluationAnswers']['questionid']);
			$model->attributes=$_POST['EvaluationAnswers'];
			$model->save();
		}
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'answersDataProvider'=>$dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Evaluations;
		
		// Find the user's department.
		$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);
		
		if(isset($_POST['Evaluations']))
		{
			$model->attributes=$_POST['Evaluations'];
			if($model->save())
			{
				// Record the evaluation create event.
				$log = new Log;
				$log->tablename = 'ci_evaluations';
				$log->event = 'Evaluation Created';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				// Find all general questions.
				$questions = CHtml::ListData(EvaluationQuestions::model()->findAll(
						'departmentid IS NULL'), 'questionid', 'questionid');
				
				// Find all questions for the department.
				$questions2 = CHtml::ListData(EvaluationQuestions::model()->findAll(
						'departmentid=' . $department->getAttribute('departmentid')), 'questionid', 'questionid');
				
				$questions = array_merge($questions, $questions2);
				
				foreach($questions as $question)
				{
					// Each question will eventaully have an answer, but for now we create blank entries in the
					// ci_evaluation_answers table to bridge the questions to the new evaluation.
					$answer = new EvaluationAnswers;
					
					$answer->evaluationid = $model->evaluationid;
					$answer->questionid = $question;
					
					$answer->save();
				}
				
				$this->redirect(array('edit','id'=>$model->evaluationid));
			}
		}

		if($department->departmentname != 'Administration')
		{
			// Find all active users in that department, except for the current user and put them in an array.
			$allUsers = CHtml::ListData(UserInfo::model()->findAll(
					'departmentid=' . $department->getAttribute('departmentid') 
					. ' AND active = 1 AND userid !=' . Yii::app()->user->id), 'userid', 'username');
		}
		else
		{
			// People in the administration department can create evaluations for anyone, except themself.
			$allUsers = CHtml::ListData(UserInfo::model()->findAll(
					'active = 1 AND userid !=' . Yii::app()->user->id), 'userid', 'username');
		}
		
		$this->render('create',array(
			'model'=>$model,
			'allUsers' => $allUsers,
		));
	}

	/**
	 * Change the employee being evaluated.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Evaluations']))
		{
			$model->attributes=$_POST['Evaluations'];
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
	 * This function is used to answer the evaluation questions.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id)
	{
		$dataProvider=new CActiveDataProvider('EvaluationAnswers', array(
			'criteria'=>array('condition'=>'evaluationid=' . $id),
			'pagination'=>array('pageSize'=>1)));
		
		if(isset($_POST['EvaluationAnswers']))
		{
			// An answer was posted, record it.
			$model=$this->loadAnswerModel($_POST['EvaluationAnswers']['evaluationid'], $_POST['EvaluationAnswers']['questionid']);
			$model->attributes=$_POST['EvaluationAnswers'];
			$model->save();
			
			// Record the evaluation create event.
			$log = new Log;
			$log->tablename = 'ci_evaluation_answers';
			$log->event = 'Evaluation Answer Updated';
			$log->userid = Yii::app()->user->getId();
			$log->tablerow = $model->evaluationid . ", " . $model->questionid;
			$log->save(false);
			
			Yii::app()->user->setFlash('success', "Answer saved");
		}
		
		$this->render('edit',array(
			'model'=>$this->loadModel($id),
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Evaluations('search');
		$model->unsetAttributes();  // clear any default values
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		// If the search form was posted.
		if(isset($_GET['Evaluations']))
		{
			$model->attributes=$_GET['Evaluations'];
			
			if((int)$model->evaluationdate)
			{
				// If the date was posted, convert it to the format that the database recognizes.
				$model->evaluationdate = date('Y-m-d', strtotime($model->evaluationdate));
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
		$model=Evaluations::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadAnswerModel($evaluationid, $questionid)
	{
		$model= EvaluationAnswers::model()->findByPk(array('evaluationid' => $evaluationid, 'questionid' => $questionid));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
