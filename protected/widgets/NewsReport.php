<?php
/**
 * This class is for the news porlet. 
 * This allows the news report to be displayed on the home page.
 */
class NewsReport extends CPortlet
{
	public $pageTitle = 'News';
	public $viewPath = '/views';
	public $type = 'Criminal Court Clerk News';
	
	/**
	 * This function renders the news.
	 */
	protected function renderContent()
	{
		if(Yii::app()->user->checkAccess('DefaultExternal', Yii::app()->user->id) || (!isset(Yii::app()->user->id)))
			$this->type = "N/A";
		
		// Grab the 5 most recent news posts of the desired news type.
		$news = Yii::app()->db->createCommand()
			->select('ci_news.newsid, ci_news.news, ci_news.date')
			->from('ci_news_type')
			->leftJoin('ci_news','ci_news.typeid = ci_news_type.typeid')
			->where('ci_news_type.type = :type', array(':type'=>$this->type))
			->order('ci_news.date DESC')
			->limit(5)
			->queryAll();
		
		// Put the news into an array.
		$newsReport = $this->customTruncate(CHtml::listData($news, 'newsid', 'news'), 150);
		$newsDates = CHtml::listData($news, 'newsid', 'date');
		
		// Display the news.
		$this->render('news',array('news'=>$newsReport, 'type'=>$this->type, 'dates'=>$newsDates));
	}
	
	/**
	 * This function takes an array of strings and a number for the maximum length.
	 * If the string is greater than the allowed length, the string will be shortend
	 * to fit the length and "..." characters will be added to the end of the shortend string.
	 * @param Array $text
	 * @param Integer $length
	 * @return Array
	 */
	private function customTruncate($text, $length)
	{
		foreach($text as $key => $value)
		{
			$length = abs((int)$length);
			$text[$key] = strip_tags($text[$key], "<br>");
			if(strlen($text[$key]) > $length) {
				$text[$key] = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text[$key]);
			}
		}
		return $text;
	}
}
