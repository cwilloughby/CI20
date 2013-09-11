<?php
/**
 * The external view actions used for typical CRUD view reads.
 */
class ViewAction extends CAction
{
	public $pk = 'id';
	public $modelClass;   

	function run()
	{
		if(empty($_GET[$this->pk]))
			throw new CHttpException(400, "Bad Request. An id must be given.");

		$model = CActiveRecord::model($this->modelClass)->findByPk($_GET[$this->pk]);

		if($model)
			Yii::app()->getController()->render('view', array('model'=>$model));
		else
			throw new CHttpException(400, "Failed to load data.");
	}
}
