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
		// Find all of the news types.
		$types = CHtml::listData(NewsType::model()->findAll(), 'typeid', 'type');
		
		// Grab the most recent news for each type of news.
		foreach($types as $key => $value)
		{
			$out[$value] = News::model()->find(array(
				'condition'=>'typeid=:id', 
				'order'=>'date DESC', 
				'params'=>array(':id'=>$key)))->getAttribute('news');
		}
		
		$this->render('index',array(
			'news'=>$out,
		));
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
}
