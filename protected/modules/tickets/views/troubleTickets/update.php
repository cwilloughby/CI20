<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->pageTitle = Yii::app()->name . ' - Update Trouble Ticket';

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	$model->ticketid=>array('view','id'=>$model->ticketid),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'Create Ticket', 'url'=>array('create')),
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'List Closed Trouble Tickets', 'url'=>array('closedindex')),
	array('label'=>'View Trouble Ticket', 'url'=>array('view', 'id'=>$model->ticketid)),
	array('label'=>'Update Trouble Ticket', 'url'=>array('update', 'id'=>$model->ticketid)),
);
?>

<h1>Update Trouble Ticket <?php echo $model->ticketid; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model)); ?>