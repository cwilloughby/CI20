<?php

class LogController extends Controller
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
			'view' => array('class' => 'ViewAction', 'modelClass' => 'Log'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'Log'),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->with = array('user');
		
		$dataProvider=new CActiveDataProvider('Log', array(
				'criteria'=>$criteria,
				'sort'=>array(
					'attributes'=>array(
						'user_search'=>array(
							'asc'=>'username',
							'desc'=>'username DESC',
						),
						'tablename',
						'eventdate',
						'event',
					),
				),
			)	
		);
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider
		));
	}
}
