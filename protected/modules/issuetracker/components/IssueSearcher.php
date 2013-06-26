<?php
/**
 * This class is for the issue searcher porlet. 
 */
class IssueSearcher extends CPortlet
{
	public $pageTitle = 'Search Issues';
	public $search = null;
	public $type = 'Search';
	
	/**
	 * This function renders the issue searcher widget.
	 */
	public function renderContent()
	{
		if($this->type == "Search")
		{
			$tracker = new IssueTracker;

			if(!is_null($this->search))
			{
				$tracker->attributes=$this->search;
				$tracker->scenario = 'search';

				if($tracker->validate())
				{
					$criteria=new CDbCriteria;
					$criteria->compare('t.key', $tracker->search, true, 'OR');
					$criteria->compare('t.type', $tracker->search, true, 'OR');
					$criteria->compare('t.summary', $tracker->search, true, 'OR');
					$criteria->compare('t.description', $tracker->search, true, 'OR');

					$dataProvider = new CActiveDataProvider('IssueTracker', array(
						'pagination'=>array(
							'pageSize'=> 3,
						),
						'criteria'=>$criteria,
					));
				}
				else
					$dataProvider = null;
			}
			else
				$dataProvider = null;

			$this->render('issuesearcher',array(
				'tracker'=>$tracker,
			));
		}
		else 
		{
			$dataProvider=new CActiveDataProvider('IssueTracker', array(
					'pagination'=>array(
						'pageSize'=>3
					),
				));
		}
		
		if(!is_null($dataProvider))
		{
			$this->render('indexissues',array(
				'dataProvider'=>$dataProvider
			));
		}
	}
	
	/**
	 * This function takes a string and a number for the maximum length.
	 * If the string is greater than the allowed length, the string will be shortend
	 * to fit the length and "..." characters will be added to the end of the shortend string.
	 * @param Array $text
	 * @param Integer $length
	 * @return Array
	 */
	public function customTruncate($text, $length)
	{
		$length = abs((int)$length);
		if(strlen($text) > $length) {
			$text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
		}
		return $text;
	}
}
