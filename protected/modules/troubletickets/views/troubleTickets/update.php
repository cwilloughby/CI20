<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	$model->ticketid=>array('view','id'=>$model->ticketid),
	'Update',
);

$this->menu=array(
	array('label'=>'List TroubleTickets', 'url'=>array('index')),
	array('label'=>'Create TroubleTickets', 'url'=>array('create')),
	array('label'=>'View TroubleTickets', 'url'=>array('view', 'id'=>$model->ticketid)),
	array('label'=>'Manage TroubleTickets', 'url'=>array('admin')),
);
?>

<h1>Update TroubleTickets <?php echo $model->ticketid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>