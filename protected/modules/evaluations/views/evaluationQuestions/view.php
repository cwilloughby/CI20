<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */

$this->pageTitle = Yii::app()->name . ' - View Evaluation Question';

$this->breadcrumbs=array(
	'Evaluation Question'=>array('index'),
	$model->questionid,
);

$this->menu2=array(
	array('label'=>'Search Evaluation Questions', 'url'=>array('admin')),
	array('label'=>'Create Evaluation Question', 'url'=>array('create')),
	array('label'=>'List Evaluation Questions', 'url'=>array('index')),
	array('label'=>'Update Evaluation Question', 'url'=>array('update', 'id'=>$model->questionid)),
	($model->active == 2 
			? array('label'=>'Enable Question', 'url'=>'#', 
				'linkOptions'=>array('submit'=>array('enable','id'=>$model->questionid),'confirm'=>'Are you sure you want to enable this question?'))
			: array('label'=>'Disable Question', 'url'=>'#', 
				'linkOptions'=>(array('submit'=>array('disable','id'=>$model->questionid),'confirm'=>'Are you sure you want to disable this question?')))),
);
?>

<h1>View Evaluation Question #<?php echo $model->questionid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'questionid',
		array(        
			'name'=>'department',
			'value'=>isset($model->department)?CHtml::encode($model->department->departmentname):"Unknown"
		),
		'question',
		array(
			'name' => 'active',
			'value' => ($model->active == 1)?"True":"False",
		)
	),
)); ?>
