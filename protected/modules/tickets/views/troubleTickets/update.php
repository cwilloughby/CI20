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
	array('label'=>'<i class="icon icon-search"></i> Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-eye-open"></i> List Open Trouble Tickets', 'url'=>array('index', 'status'=>'Open')),
	array('label'=>'<i class="icon icon-eye-close"></i> List Closed Trouble Tickets', 'url'=>array('index', 'status'=>'Closed')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Trouble Ticket', 'url'=>array('view', 'id'=>$model->ticketid)),
	array('label'=>'<i class="icon icon-pencil"></i> Update Trouble Ticket', 'url'=>array('update', 'id'=>$model->ticketid)),
);
?>

<h1>Update Trouble Ticket <?php echo $model->ticketid; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model)); ?>