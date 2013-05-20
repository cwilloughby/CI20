<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */

$this->breadcrumbs=array(
	'Evaluation Question'=>array('index'),
	$model->questionid,
);

$this->menu2=array(
	array('label'=>'List Evaluation Questions', 'url'=>array('index')),
	array('label'=>'Create Evaluation Question', 'url'=>array('create')),
	array('label'=>'Update Evaluation Question', 'url'=>array('update', 'id'=>$model->questionid)),
	array('label'=>'Delete Evaluation Question', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->questionid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Evaluation Questions', 'url'=>array('admin')),
);
?>

<h1>View Evaluation Question #<?php echo $model->questionid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'questionid',
		'departmentid',
		'question',
	),
)); ?>
