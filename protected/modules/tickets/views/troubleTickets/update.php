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
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Closed Trouble Tickets', 'url'=>array('closedindex')),
	array('label'=>'View Trouble Tickets', 'url'=>array('view', 'id'=>$model->ticketid)),
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
);
?>

<h1>Update Trouble Ticket <?php echo $model->ticketid; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model)); ?>