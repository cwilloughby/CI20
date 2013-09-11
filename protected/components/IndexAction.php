<?php
/**
 * The external index actions used for typical CRUD index reads.
 */
class IndexAction extends CAction
{
	public $modelClass;   

	function run()
	{
		try
		{
			$dataProvider=new CActiveDataProvider($this->modelClass);
		}
		catch(Exception $ex)
		{
			echo "Index page failed with error " . $ex;
		}
		Yii::app()->getController()->render('index', array('dataProvider'=>$dataProvider));
	}
}