<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin')),
);
?>

<h1>Create Trouble Ticket</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>