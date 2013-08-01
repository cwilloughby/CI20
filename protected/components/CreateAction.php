<?php
/*
 * The external update actions used for typical CRUD updates.
 */
class CreateAction extends CAction
{
	public $redirectTo = 'view';
	public $modelClass;   

	function run()
	{
		$model = new $this->modelClass;

		if($model->attributes = Yii::app()->request->getPost($this->modelClass))
		{
			if($model->save())
			{
				Yii::app()->user->setFlash('created', 'Record has been created.');
				Yii::app()->getController()->redirect(array($this->redirectTo,'id'=>$model->getPrimaryKey()));
			}
		}
		Yii::app()->getController()->render('create', array('model'=>$model));
	}
}
