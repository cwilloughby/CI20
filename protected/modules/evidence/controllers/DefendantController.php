<?php

class DefendantController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		// Grab all the case files for this defendant.
		$cases=new CaseSummary('search');
		$cases->unsetAttributes();  // clear any default values
		if(isset($_GET['CaseSummary']))
			$cases->attributes=$_GET['CaseSummary'];

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'cases'=>$cases,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Defendant;

		if(isset($_POST['Defendant']))
		{
			$model->attributes=$_POST['Defendant'];
			if($model->save())
			{
				// Record the defendant create event.
				$log = new Log;
				$log->tablename = 'ci_defendant';
				$log->event = 'Defendant Created';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$model->defid));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Defendant']))
		{
			$model->attributes=$_POST['Defendant'];
			if($model->save())
			{
				// Record the defendant update event.
				$log = new Log;
				$log->tablename = 'ci_defendant';
				$log->event = 'Defendant Updated';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $model->getPrimaryKey();
				$log->save(false);
				
				$this->redirect(array('view','id'=>$model->defid));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		try
		{
			$this->loadModel($id)->delete();
		}
		catch(Exception $ex)
		{
			throw new CHttpException('the defendant cannot be deleted, because it still assigned to a case file.');
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Defendant');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Defendant('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Defendant']))
			$model->attributes=$_GET['Defendant'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/*
	 * This is used by the autocomplete for the defendant's first name. 
	 */
	public function actionDefendantFirstNameLookup($term)
	{
        //the $term parameter is what the user typed in on the control
        //send back an array of data:
        $criteria = new CDbCriteria;
        $criteria->compare('fname', $term, true);
		$criteria->limit = 10;
		$criteria->group = 'fname';
        $model = Defendant::model()->findAll($criteria);

        foreach($model as $value) 
		{
            $array[] = array('value' => trim($value->fname), 'label' => trim($value->fname));
        }

        echo CJSON::encode($array);
    }

	/*
	 * This is used by the autocomplete for the defendant's last name. 
	 */
	public function actionDefendantLastNameLookup($term)
	{
        //the $term parameter is what the user typed in on the control
        //send back an array of data:
        $criteria = new CDbCriteria;
        $criteria->compare('lname', $term, true);
		$criteria->limit = 10;
		$criteria->group = 'lname';
        $model = Defendant::model()->findAll($criteria);

        foreach($model as $value) 
		{
            $array[] = array('value' => trim($value->lname), 'label' => trim($value->lname));
        }

        echo CJSON::encode($array);
	}
	
	/*
	 * This function is used to change an existing case file's defendant.
	 */
	public function actionChangeDefendant($id)
	{
		$summary = CaseSummary::model()->findByPk($id);
		
		if(isset($_POST['Defendant']))
		{
			$defendant = new Defendant;
			$defendant->attributes = $_POST['Defendant'];
			
			// Check to see if the new defendant exists in the defendant table already.
			// If it does, return it's defid, otherwise create the defendant and then return the new defid.
			$summary->defid = $defendant->saveDefendant($defendant);
			
			// Save the change to the case summary
			if($summary->save())
			{
				// Record the case summary update event.
				$log = new Log;
				$log->tablename = 'ci_case_summary';
				$log->event = 'Case Summary Defendant Changed';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $id;
				$log->save(false);
				
				$this->redirect(array('/evidence/casesummary/view','id'=>$summary->summaryid));
			}
		}
		else
		{
			$defendant = $this->loadModel($summary->defid);
		}

		$this->render('changeDefendant',array(
			'summary' => $summary,
			'defendant' => $defendant
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Defendant::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='defendant-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
