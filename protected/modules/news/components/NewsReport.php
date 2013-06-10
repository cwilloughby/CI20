<?php
/**
 * This class is for the weather porlet. 
 * This allows the login form to be displayed on the home page.
 */
class NewsReport extends CPortlet
{
	public $pageTitle = 'News';
	public $type = 'Criminal Court Clerk News';
	
	/**
	 * This function renders the login form.
	 */
	protected function renderContent()
	{
		// Grab all the tips and conditionals of the selected subject.
		$news = Yii::app()->db->createCommand()
			->select('ci_news_type.type, ci_news.news')
			->from('ci_news_type')
			->leftJoin('ci_news','ci_news.typeid = ci_news_type.typeid')
			->where('ci_news_type.type = :type', array(':type'=>$this->type))
			->order('ci_news.date DESC')
			->limit(1)
			->queryAll();

		// Put the news into an array.
		$news = CHtml::listData($news, 'type', 'news');
		
		// Display the office news.
		$this->render('news',array('news'=>$news));
	}
}
