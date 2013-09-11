<?php
/**
 * The external admin actions used for typical admin pages.
 */
class AdminAction extends CAction
{
	public $modelClass;   

	function run()
	{
		try
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
		}
		catch(Exception $ex)
		{
			echo "Admin page failed with error " . $ex;
		}
		
		Yii::app()->getController()->render('admin',array(
			'model'=>$model,
		));
	}
}
