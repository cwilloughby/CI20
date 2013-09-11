<?php
/**
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
			throw new CHttpException(400, "Bad Request. An id must be given.");
		
		$model = CActiveRecord::model($this->modelClass)->findByPk($_GET[$this->pk]);

		if(!$model)
			throw new CHttpException(400, "Failed to load data.");

		if($model->attributes = Yii::app()->request->getPost($this->modelClass))
		{
			if($model->validate())
			{
				if($model->save(false))
				{
					Yii::app()->user->setFlash('updated', 'Record has been updated.');
					Yii::app()->getController()->redirect(array($this->redirectTo,'id'=>$_GET[$this->pk]));
				}
				else
					throw new CHttpException(500, "Failed to update data.");
			}
		}
		Yii::app()->getController()->render('update', array('model'=>$model));
	}
}