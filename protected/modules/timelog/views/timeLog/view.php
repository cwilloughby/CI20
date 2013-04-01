<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$this->breadcrumbs=array(
	'Time Logs'=>array('index'),
	$model->id,
);

$this->menu2=array(
	array('label'=>'List Time Logs', 'url'=>array('index')),
	array('label'=>'Manage Time Logs', 'url'=>array('admin')),
);
?>

<h1>View Time Log Event #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'computername',
		array(        
			'name'=>'eventdate',
			'value'=>isset($model->eventdate)?CHtml::encode(date('m/d/Y', strtotime($model->eventdate))):"N\\A"
		),
		'eventtype',
		array(        
			'name'=>'eventtime',
			'value'=>isset($model->eventtime)?CHtml::encode(date('g:i:s a', strtotime($model->eventtime))):"N\\A"
		),
	),
)); ?>
