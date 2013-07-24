<?php
/*
 * The external delete actions used for typical CRUD deletions.
 */
class DeleteAction extends CAction
{
	public $pk = 'id';
	public $redirectTo = 'index';
	public $modelClass;   

	function run()
	{
		if(empty($_GET[$this->pk]))
			throw new CHttpException(404);

		$model = CActiveRecord::model($this->modelClass)->findByPk($_GET[$this->pk]);

		if(!$model)
			throw new CHttpException(404);

		if($model->delete())
		{
			Yii::app()->user->setFlash('deleted', 'Record has been deleted.');
			Yii::app()->getController()->redirect($this->redirectTo);
		}

		throw new CHttpException(500);
	}
}
