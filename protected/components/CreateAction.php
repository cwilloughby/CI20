<?php
/**
 * The external create actions used for typical CRUD creates.
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
			if($model->validate())
			{
				if($model->save(false))
				{
					Yii::app()->user->setFlash('created', 'Record has been created.');
					Yii::app()->getController()->redirect(array($this->redirectTo,'id'=>$model->getPrimaryKey()));
				}
				else
					throw new CHttpException(500, "Failed to create data.");
			}
		}
		
		Yii::app()->getController()->render('create', array('model'=>$model));
	}
}
