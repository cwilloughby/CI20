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
	
	// External Actions
	function actions()
	{
		return array(
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Defendant'),
			'create' => array('class' => 'CreateAction', 'modelClass' => 'Defendant'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'Defendant'),
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
			'model'=>$this->loadModel($id, 'Defendant'),
			'cases'=>$cases,
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
			$this->loadModel($id, 'Defendant')->delete();
		}
		catch(Exception $ex)
		{
			throw new CHttpException('the defendant cannot be deleted, because it is still assigned to a case file.');
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * This is used by the autocomplete for the defendant's first name.
	 * @param string $term the letters that have been typed into the textbox
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

	/**
	 * This is used by the autocomplete for the defendant's last name.
	 * @param string $term the letters that have been typed into the textbox
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
	
	/**
	 * This function is used to change an existing case file's defendant.
	 * @param integer $id the id of the summary
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
			$defendant = $this->loadModel($summary->defid, 'Defendant');
		}

		$this->render('changeDefendant',array(
			'summary' => $summary,
			'defendant' => $defendant
		));
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
