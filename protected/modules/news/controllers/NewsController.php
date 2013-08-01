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
	
	// External Actions
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'News'),
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

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		
		// If the pager number was changed.
		if(isset($_GET['pageSize'])) 
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		if(isset($_GET['News']))
		{
			$model->attributes=$_GET['News'];
			
			if((int)$model->date)
			{
				$model->date = date('Y-m-d', strtotime($model->date));
			}
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
