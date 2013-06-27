<?php
/**
 * This class is for the time report porlet. 
 * This allows the a small report detailing the last time the user logged in, to be displayed on the home page.
 */
class TimeReport extends CPortlet
{
	public $pageTitle = 'Time Report';
	
	/**
	 * This function renders the time report.
	 */
	protected function renderContent()
	{
		// Grab the time and date of the previous ci2 login.
		$lastCiLog = Yii::app()->db->createCommand()
			->select('ci_log.eventdate')
			->from('ci_log')
			->where('ci_log.userid = :id AND ci_log.event = "Login Succeeded"', array(':id'=>Yii::app()->user->id))
			->order('ci_log.eventdate DESC')
			->limit(1, 1)
			->queryAll();

		print_r($lastCiLog);
		
		if(!Yii::app()->user->checkAccess('External', Yii::app()->user->id))
		{
			// Grab the time and date of the previous computer.
			$lastComputerLog = Yii::app()->db->createCommand()
				->select('ci_time_log.eventdate, ci_time_log.eventtime')
				->from('ci_time_log')
				->where('ci_time_log.username = :name AND ci_time_log.eventtype = "login"', array(':name'=>Yii::app()->user->name))
				->order('ci_time_log.eventdate DESC')
				->limit(1)
				->queryAll();

			print_r($lastComputerLog);
		}
		/*
		Yii::app()->user->id;
		
		// Put the news into an array.
		$newsReport = $this->customTruncate(CHtml::listData($news, 'newsid', 'news'), 100);
		$newsDates = CHtml::listData($news, 'newsid', 'date');
		
		// Display the office news.
		$this->render('news',array('news'=>$newsReport, 'type'=>$this->type, 'dates'=>$newsDates));
		*/
	}
}
