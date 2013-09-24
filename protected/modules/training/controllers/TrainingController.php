<?php

class TrainingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id, $type)
	{
		$models=TrainingResources::model()->findAll(array('select'=>'type','distinct'=>true));
		$types=CHtml::listData($models,'type','type');
		$this->render('view',array(
			'resource'=>$this->loadModel($id, 'TrainingResources'),
			'types'=>$types,
			'type'=>$type
		));
	}
	
	/**
	 * Lists all the different types of training resources.
	 */
	public function actionTypeIndex()
	{
		// We need to count the number of distinct types to get around a yii pager bug.
		$sql = "SELECT COUNT(DISTINCT type) FROM ci_training_resources";
		$num = Yii::app()->db->createCommand($sql)->queryScalar();
		
		$models=TrainingResources::model()->findAll(array('select'=>'type','distinct'=>true));
		$types=CHtml::listData($models,'type','type');
		$dataProvider=new CActiveDataProvider('TrainingResources',
				array(
					'criteria'=>array(
						'select'=>'type',
						'distinct' => true
					),
					'totalItemCount'=>$num,
				));
		$this->render('typeindex',array(
			'dataProvider'=>$dataProvider,
			'types'=>$types
		));
	}
	
	/**
	 * Lists all the different training resources of the specified type.
	 */
	public function actionResourceIndex($type = null)
	{
		if(is_null($type))
			throw new CHttpException(400, "Bad Request! A type must be given.");
		
		$models=TrainingResources::model()->findAll(array('select'=>'type','distinct'=>true));
		$types=CHtml::listData($models,'type','type');
		// Construct a data provider that will grab all the videos.
		$videoProvider=new CActiveDataProvider('TrainingResources', array(
					'criteria'=>array(
						'condition'=> "t.type = :type AND t.category = 'video'",
						'params'=>array(":type" => $type)
					)
				));
		// Construct a data provider that will grab all the documents.
		$docProvider=new CActiveDataProvider('TrainingResources', array(
					'criteria'=>array(
						'condition'=> "t.type = :type AND t.category = 'doc'",
						'params'=>array(":type" => $type)
					)
				));
		// Construct a data provider that will grab all the html reference pages.
		$pageProvider=new CActiveDataProvider('TrainingResources', array(
					'criteria'=>array(
						'condition'=> "t.type = :type AND t.category = 'page'",
						'params'=>array(":type" => $type)
					)
				));
		
		$this->render('resourceindex',array(
			'videoProvider'=>$videoProvider,
			'docProvider'=>$docProvider,
			'pageProvider'=>$pageProvider,
			'types'=>$types,
		));
	}
}
