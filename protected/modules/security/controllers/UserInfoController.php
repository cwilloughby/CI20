<?php

class UserInfoController extends Controller
{
	/*
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/*
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/*
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/*
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserInfo;

		// Are there GET variables that need to be pulled into the form?
		if(isset($_GET['firstname']))
		{
			$model->firstname = $_GET['firstname'];
			$model->lastname = $_GET['lastname'];
			$model->middlename = $_GET['middlename'];
			$model->email = $_GET['email'];
			$model->firstname = $_GET['firstname'];
			$model->phoneext = $_GET['phoneext'];
			$model->departmentid = $_GET['departmentid'];
			$model->hiredate = $_GET['hiredate'];
		}
		
		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			$model->password = sha1($model->username);
			$model->departmentid += 1;
			$model->active = true;
			
			if($model->save())
			{
				// Email alert to the new user. Commented out for now.
				/*
				$this->redirect(
					array('/email/email/addemail', 
						'firstname'=>$model->firstname,
						'lastname'=>$model->lastname,
						'middlename'=>$model->middlename,
						'email'=>$model->email,
						'phoneext'=>$model->phoneext,
						'departmentid'=>$model->departmentid,
						'hiredate'=>$model->hiredate,
					));	
				*/
				$this->redirect(array('view','id'=>$model->userid));
			}
		}

		$departments=array_merge(array(""=>""),CHtml::listData(Departments::model()->findAll(),'departmentid','departmentname'));
		
		$this->render('create',array('model'=>$model, 'departments'=>$departments));
	}

	/*
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->userid));
		}
		
		$departments=array_merge(array(""=>""),CHtml::listData(Departments::model()->findAll(),'departmentid','departmentname'));
		
		$this->render('update',array('model'=>$model, 'departments'=>$departments));
	}

	/*
	 * Users are never deleted. Their accounts are just disabled
	 * @param integer $id the ID of the model to be disabled
	 */
	public function actionDisable($id)
	{
		$model = $this->loadModel($id);
		$model->active = 2;
		
		if($model->save())
			$this->redirect(array('view','id'=>$model->userid));
	}

	/*
	 * Enable a user's account.
	 * @param integer $id the ID of the model to be enabled
	 */
	public function actionEnable($id)
	{
		$model = $this->loadModel($id);
		$model->active = 1;
		
		if($model->save())
			$this->redirect(array('view','id'=>$model->userid));
	}
	
	/*
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/*
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserInfo']))
			$model->attributes=$_GET['UserInfo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/*
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=UserInfo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/*
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
