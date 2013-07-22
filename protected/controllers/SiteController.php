<?php

class SiteController extends Controller
{
	public $layout='//layouts/column1';
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	/**
	 * This function is used to select the color style for the site, 
	 * and save the choice to the logged in user.
	 */
	public function actionColor()
	{
		if(!is_null($_GET) && !Yii::app()->user->isGuest)
		{
			$prefs = UserPrefs::model()->findByPk(Yii::app()->user->id);  

			//now check if the model is null
			if(!$prefs) 
				$prefs = new UserPrefs;

			$prefs->userid = Yii::app()->user->id;
			$prefs->color = $_GET['style'];

			//save
			$prefs->save(false);
			
			setcookie("style", $_GET['style'], time()+604800, '/'); // 604800 = amount of seconds in one week
			$results = Yii::app()->theme->baseUrl . $_GET['style'];
			echo $results;
		}
		else if(!is_null($_GET) && Yii::app()->user->isGuest)
		{
			setcookie("style", $_GET['style'], time()+604800, '/'); // 604800 = amount of seconds in one week
			$results = Yii::app()->theme->baseUrl . $_GET['style'];
			echo $results;
		}
	}
	
	/**
	 * This function is used to obtain the counts from the copiers and printers, for use
	 * in the chart on the homepage.
	 */
	public function actionPrints()
	{
		// This snippet will be used later on for obtaining the correct dates.
		/*
		$date = new DateTime();
		$date->add(DateInterval::createFromDateString('yesterday'));
		echo $date->format('Y-m-d') . "\n";
		*/
		
		$yesterday = Yii::app()->db->createCommand()
			->select('starttotal, endtotal')
			->from('ci_print_count')
			->where('date=:date', array(':date'=>'2013-06-30'))
			->queryAll();
		
		$dayBefore = Yii::app()->db->createCommand()
			->select('starttotal, endtotal')
			->from('ci_print_count')
			->where('date=:date', array(':date'=>'2013-07-01'))
			->queryAll();
		
		// These if statements will prevent errors if nothing was returned from the database.
		if(empty($yesterday))
		{
			$yesterday[0]['starttotal'] = 0;
			$yesterday[0]['endtotal'] = 0;
		}
		if(empty($dayBefore))
		{
			$dayBefore[0]['starttotal'] = 0;
			$dayBefore[0]['endtotal'] = 0;
		}
			
		echo json_encode(array(
			0 => ($yesterday[0]['endtotal'] - $yesterday[0]['starttotal']),
			1 => ($dayBefore[0]['endtotal'] - $dayBefore[0]['starttotal'])));
	}
}
