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
		try
		{
			// Grab the time and date of the previous ci2 login.
			$lastCiLog = Yii::app()->db->createCommand()
				->select('ci_log.eventdate')
				->from('ci_log')
				->where('ci_log.userid = :id AND ci_log.event = "Login Succeeded"', array(':id'=>Yii::app()->user->id))
				->order('ci_log.eventdate DESC')
				->limit(1)
				->queryAll();
			
			if(empty($lastCiLog))
			{
				throw new Exception;
			}
			
			$lastCiLog = date('m/d/Y \a\t g:i a', strtotime($lastCiLog[0]['eventdate']));
		}
		catch (Exception $ex)
		{
			$lastCiLog = "Unknown";
		}
		
		try
		{
			// Grab the time and date of the previous computer.
			$lastComputerLog = Yii::app()->db->createCommand()
				->select('ci_time_log.eventdate, ci_time_log.eventtime')
				->from('ci_time_log')
				->where('ci_time_log.username = :name AND ci_time_log.eventtype = "login"', array(':name'=>Yii::app()->user->name))
				->order('ci_time_log.eventdate DESC')
				->limit(1)
				->queryAll();

			if(empty($lastComputerLog))
			{
				throw new Exception;
			}
			
			$lastComputerLog = date('m/d/Y \a\t g:i a', strtotime($lastComputerLog[0]['eventtime'] . " " . $lastComputerLog[0]['eventdate']));
		}
		catch(Exception $ex)
		{
			$lastComputerLog = "Unknown";
		}
		// Display the time report.
		$this->render('timereport',array('ciLog'=>$lastCiLog, 'computerLog'=>$lastComputerLog));
	}
}
