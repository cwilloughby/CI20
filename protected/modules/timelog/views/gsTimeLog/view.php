<?php
/* @var $this GsTimeLogController */
/* @var $model GsTimeLog */

$this->breadcrumbs=array(
	'Gs Time Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GsTimeLog', 'url'=>array('index')),
	array('label'=>'Create GsTimeLog', 'url'=>array('create')),
	array('label'=>'Update GsTimeLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GsTimeLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GsTimeLog', 'url'=>array('admin')),
);
?>

<h1>View GsTimeLog #<?php echo $model->id; ?></h1>

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
