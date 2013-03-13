<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	$model->eventid,
);

$this->menu=array(
	array('label'=>'List Logs', 'url'=>array('index')),
	array('label'=>'Manage Logs', 'url'=>array('admin')),
);
?>

<h1>View Log #<?php echo $model->eventid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'eventid',
		'userid',
		'tablename',
		'tablerow',
		'eventdate',
		'event',
	),
)); ?>
