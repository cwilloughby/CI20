<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	$model->ticketid,
);

$this->menu=array(
	array('label'=>'List TroubleTickets', 'url'=>array('index')),
	array('label'=>'Create TroubleTickets', 'url'=>array('create')),
	array('label'=>'Update TroubleTickets', 'url'=>array('update', 'id'=>$model->ticketid)),
	array('label'=>'Delete TroubleTickets', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ticketid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TroubleTickets', 'url'=>array('admin')),
);
?>

<h1>View TroubleTickets #<?php echo $model->ticketid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ticketid',
		'openedby',
		'opendate',
		'categoryid',
		'subjectid',
		'description',
		'closedbyuserid',
		'closedate',
		'resolution',
	),
)); ?>
