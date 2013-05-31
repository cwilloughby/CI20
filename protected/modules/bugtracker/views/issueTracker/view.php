<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->breadcrumbs=array(
	'Issue Trackers'=>array('index'),
	$model->key,
);

$this->menu=array(
	array('label'=>'List IssueTracker', 'url'=>array('index')),
	array('label'=>'Create IssueTracker', 'url'=>array('create')),
	array('label'=>'Update IssueTracker', 'url'=>array('update', 'id'=>$model->key)),
	array('label'=>'Delete IssueTracker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IssueTracker', 'url'=>array('admin')),
);
?>

<h1>View IssueTracker #<?php echo $model->key; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'key',
		'type',
		'created',
		'reporter',
		'summary',
		'description',
		'assigned',
		'updated',
		'originalestimate',
		'remainingestimate',
		'timespent',
		'resolution',
	),
)); ?>
