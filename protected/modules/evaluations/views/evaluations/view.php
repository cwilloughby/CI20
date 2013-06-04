<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */
/* @var $answersDataProvider dataProvider */

$this->pageTitle = Yii::app()->name . ' - View Evaluation';

$this->breadcrumbs=array(
	'Evaluation'=>array('index'),
	$model->evaluationid,
);

$this->menu2=array(
	array('label'=>'Search Evaluations', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'Create Evaluation', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'List Evaluations', 'url'=>array('index')),
	array('label'=>'View Evaluation', 'url'=>array('view', 'id'=>$model->evaluationid)),
	array('label'=>'Fill Out Evaluation', 'url'=>array('edit', 'id'=>$model->evaluationid), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'Change Employee', 'url'=>array('update', 'id'=>$model->evaluationid), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
);
?>

<h1>View Evaluation #<?php echo $model->evaluationid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(        
			'name'=>'evaluationdate',
			'value'=>isset($model->evaluationdate)?CHtml::encode(date('g:i a m/d/Y', strtotime($model->evaluationdate))):"N\\A"
		),
		array(        
			'name'=>'employee',
			'value'=>isset($model->employee0)?CHtml::encode(
					$model->employee0->firstname . ' ' . $model->employee0->lastname):"Unknown"
		),
		array(
			'name'=>'evaluator',
			'value'=>isset($model->evaluator0)?CHtml::encode(
					$model->evaluator0->firstname . ' ' . $model->evaluator0->lastname):"Unknown"
		),
	),
)); 

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$answersDataProvider,
	'itemView'=>'_viewAnswers',
)); ?>

<?php echo $this->renderPartial('_instructions'); ?>
