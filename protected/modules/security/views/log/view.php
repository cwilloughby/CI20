<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	$model->eventid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Logs', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Logs', 'url'=>array('index')),
);
?>

<h1>View Log #<?php echo $model->eventid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(        
			'name'=>'user_search',
			'value'=>isset($model->user)?CHtml::encode($model->user->username):"Unknown"
		),
		'tablename',
		'tablerow',
		array(        
			'name'=>'eventdate',
			'value'=>isset($model->eventdate)?CHtml::encode(date('g:i:s a Y-m-d', strtotime($model->eventdate))):"N\\A"
		),
		'event',
	),
)); ?>
