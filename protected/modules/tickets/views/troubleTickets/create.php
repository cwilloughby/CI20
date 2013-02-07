<?php
/* @var $this TroubleTicketsController */
/* @var $ticket TroubleTickets */
/* @var $file Documents */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Closed Trouble Tickets', 'url'=>array('closedindex')),
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin')),
);
?>

<h1>Create Trouble Ticket</h1>

<?php echo $this->renderPartial('_form', array('ticket'=>$ticket, 'file'=>$file)); ?>