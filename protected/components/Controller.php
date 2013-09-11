<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends SBaseController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $menu1=array();
	public $menu2=array();
	
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * Returns the data model based on the primary key param and modelClass name.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id = null, $modelClass = null)
	{
		if(is_null($id))
			throw new CHttpException(400, "Bad Request! An id must be given.");
		else if(is_null($modelClass)) 
			throw new CHttpException(404, "Bad Request! A model must be given.");
		
		$model = CActiveRecord::model($modelClass)->findByPk($id);

		if($model===null)
			throw new CHttpException(400, 'The requested data does not exist!');
		else
			return $model;
	}
}
