<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	$model->ticketid,
);

$this->menu=array(
	array('label'=>'List Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Create Trouble Ticket', 'url'=>array('create')),
	array('label'=>'Update Trouble Tickets', 'url'=>array('update', 'id'=>$model->ticketid)),
	array('label'=>'Delete Trouble Ticket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ticketid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin')),
);
?>

<h1>View Trouble Ticket #<?php echo $model->ticketid; ?></h1>

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
