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
			$pageSizer = filter_input(INPUT_GET,'pageSize');
			if($pageSizer) 
			{
				Yii::app()->user->setState('pageSize',(int)$pageSizer);
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
