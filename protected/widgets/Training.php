<?php
/**
 * This class is for the weather porlet. 
 * This allows the login form to be displayed on the home page.
 */
class Training extends CPortlet
{
	public $pageTitle = 'Training';
	public $viewPath = '/views';
	
	/**
	 * This function renders the training resources widget.
	 */
	protected function renderContent()
	{
		// We need to count the number of distinct types to get around a yii pager bug.
		$sql = "SELECT COUNT(DISTINCT type) FROM ci_training_resources";
		$num = Yii::app()->db->createCommand($sql)->queryScalar();
		
		$dataProvider=new CActiveDataProvider('TrainingResources',
				array(
					'pagination'=>array(
						'pageSize'=>4
					),
					'criteria'=>array(
						'select'=>'type',
						'distinct' => true
					),
					'totalItemCount'=>$num,
				));
		$this->render('training',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * This function takes a string and a number for the maximum length.
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
			if(strlen($text[$key]) > $length) {
				$text[$key] = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text[$key]);
			}
		}
		return $text;
	}
}
