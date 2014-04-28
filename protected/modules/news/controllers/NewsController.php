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
	
	/**
	 * This function is used to create a special type of IT news post for announcing new CJIS builds.
	 */
	public function actionCreateCjisNews()
	{
		$model = new News;
		$model->scenario = 'cjisNews';
		
		if($model->attributes = Yii::app()->request->getPost('News'))
		{
			// Grab the id for the IT news type.
			$type = Yii::app()->db->createCommand()
				->select('typeid')
				->from('ci_news_type')
				->where('type=:type', array(':type'=>'IT News'))
				->queryAll();
			
			$model->typeid = $type[0]['typeid'];

			// Format the body of the news post.
			$model->news = "Build #: " . $model->buildNum . "<br/>Release Date: " . $model->releaseDate . "<br/><br/>Features: " . $model->features;
			
			if($model->validate())
			{
				$model->save(false);
				$this->redirect(array('view','newsid'=>$model->newsid));
			}
		}
		
		$this->render('createCjisNews',array(
			'model'=>$model,
		));
	}
}
