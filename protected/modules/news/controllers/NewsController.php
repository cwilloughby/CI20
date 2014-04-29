<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/**
	 * This function returns a list of external actions.
	 * External actions are identical functions shared by many controllers throughout ci2.
	 * The code for the external actions can be found in protected\components
	 * @return array
	 */
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'News'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'News'),
			'create' => array('class' => 'CreateAction', 'modelClass' => 'News'),
			'update' => array('class' => 'UpdateAction', 'modelClass' => 'News'),
			'delete' => array('class' => 'DeleteAction', 'modelClass' => 'News')
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('News', array(			
			'sort'=>array(
				'defaultOrder'=>array(
					'date'=>CSort::SORT_DESC,
				),
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
