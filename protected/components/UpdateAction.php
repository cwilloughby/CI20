<?php
/*
 * The external update actions used for typical CRUD updates.
 */
class UpdateAction extends CAction
{
	public $pk = 'id';
	public $redirectTo = 'view';
	public $modelClass;   

	function run()
	{
		if(empty($_GET[$this->pk]))
			throw new CHttpException(404);
		
		$model = CActiveRecord::model($this->modelClass)->findByPk($_GET[$this->pk]);

		if(!$model)
			throw new CHttpException(404);

		if($model->attributes = Yii::app()->request->getPost($this->modelClass))
		{
			if($model->save())
				Yii::app()->getController()->redirect(array('view','id'=>$_GET[$this->pk]));
		}
		Yii::app()->getController()->render('update', array('model'=>$model));
	}
}