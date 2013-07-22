<?php
/*
 * The external view actions used for typical CRUD view reads.
 */
class ViewAction extends CAction
{
	public $pk = 'id';
	public $modelClass;   

	function run()
	{
		if(empty($_GET[$this->pk]))
		throw new CHttpException(404);

		$model = CActiveRecord::model($this->modelClass)->findByPk($_GET[$this->pk]);

		if($model)
			Yii::app()->getController()->render('view', array('model'=>$model));
		else
			throw new CHttpException(404);
	}
}
