<?php
/*
 * The external index actions used for typical CRUD index reads.
 */
class AdminAction extends CAction
{
	public $modelClass;   

	function run()
	{
		$model=new $this->modelClass('search');
		$model->unsetAttributes();  // clear any default values
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		if(isset($_GET[$this->modelClass]))
			$model->attributes=$_GET[$this->modelClass];

		Yii::app()->getController()->render('admin',array(
			'model'=>$model,
		));
	}
}
