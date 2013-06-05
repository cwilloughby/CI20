<?php

class TrainingController extends Controller
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id, $type)
	{
		$models=Videos::model()->findAll(array(
			'select'=>'type',
			'distinct'=>true,
		));
		$types=CHtml::listData($models,'type','type');
		$this->render('view',array(
			'video'=>$this->loadModel($id),
			'types'=>$types,
			'type'=>$type
		));
	}
	
	/**
	 * Lists all the different types of training resources.
	 */
	public function actionTypeIndex()
	{
		$models=Videos::model()->findAll(array(
			'select'=>'type',
			'distinct'=>true,
		));
		$types=CHtml::listData($models,'type','type');
		$dataProvider=new CActiveDataProvider('Videos',
				array(
					'criteria'=>array(
						'select'=>'type',
						'distinct' => true
					)
				));
		$this->render('typeindex',array(
			'dataProvider'=>$dataProvider,
			'types'=>$types
		));
	}
	
	/**
	 * Lists all the different training resources of the specified type.
	 */
	public function actionResourceIndex($type)
	{
		$models=Videos::model()->findAll(array(
			'select'=>'type',
			'distinct'=>true,
		));
		$types=CHtml::listData($models,'type','type');
		$dataProvider=new CActiveDataProvider('Videos',
				array(
					'criteria'=>array(
						'condition'=> "t.type = :type",
						'params'=>array(":type" => $type)
					)
				));
		$this->render('resourceindex',array(
			'dataProvider'=>$dataProvider,
			'types'=>$types,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Videos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
