<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$this->breadcrumbs=array(
	'Time Logs'=>array('index'),
	$model->id,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Time Logs', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Time Logs', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Time Log', 'url'=>array('view')),
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
