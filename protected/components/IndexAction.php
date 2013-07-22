<?php
/*
 * The external index actions used for typical CRUD index reads.
 */
class IndexAction extends CAction
{
	public $modelClass;   

	function run()
	{
		$dataProvider=new CActiveDataProvider($this->modelClass);

		Yii::app()->getController()->render('index', array('dataProvider'=>$dataProvider));
	}
}