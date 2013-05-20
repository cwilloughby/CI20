<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */

$this->breadcrumbs=array(
	'Evaluation'=>array('index'),
	$model->evaluationid,
);

$this->menu2=array(
	array('label'=>'List Evaluations', 'url'=>array('index')),
	array('label'=>'Create Evaluation', 'url'=>array('create')),
	array('label'=>'Update Evaluation', 'url'=>array('update', 'id'=>$model->evaluationid)),
	array('label'=>'Delete Evaluation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->evaluationid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Evaluations', 'url'=>array('admin')),
);
?>

<h1>View Evaluation #<?php echo $model->evaluationid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'evaluationid',
		'employee',
		'evaluator',
		'evaluationdate',
	),
)); ?>
