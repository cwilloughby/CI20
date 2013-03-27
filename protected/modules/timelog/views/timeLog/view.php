<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$this->breadcrumbs=array(
	'Time Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TimeLog', 'url'=>array('index')),
	array('label'=>'Create TimeLog', 'url'=>array('create')),
	array('label'=>'Update TimeLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TimeLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TimeLog', 'url'=>array('admin')),
);
?>

<h1>View TimeLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'computername',
		'eventtype',
		'eventtime',
		'eventdate',
	),
)); ?>
