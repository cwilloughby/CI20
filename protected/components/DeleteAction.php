<?php
/**
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
			throw new CHttpException(400, "Bad Request. An id must be given.");

		$model = CActiveRecord::model($this->modelClass)->findByPk($_GET[$this->pk]);

		if(!$model)
			throw new CHttpException(400, "Failed to load data.");

		if($model->delete())
		{
			Yii::app()->user->setFlash('deleted', 'Record has been deleted.');
			Yii::app()->getController()->redirect($this->redirectTo);
		}
		else
			throw new CHttpException(500, "Failed to delete data.");
	}
}
