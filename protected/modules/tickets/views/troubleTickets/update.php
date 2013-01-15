<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	$model->ticketid=>array('view','id'=>$model->ticketid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Closed Trouble Tickets', 'url'=>array('closedindex')),
	array('label'=>'Create Trouble Ticket', 'url'=>array('create')),
	array('label'=>'View Trouble Tickets', 'url'=>array('view', 'id'=>$model->ticketid)),
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin')),
);
?>

<h1>Update Trouble Ticket <?php echo $model->ticketid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>