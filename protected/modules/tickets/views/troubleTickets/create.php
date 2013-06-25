<?php
/* @var $this TroubleTicketsController */
/* @var $ticket TroubleTickets */
/* @var $file Documents */

$this->pageTitle = Yii::app()->name . ' - Create Trouble Ticket';

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-eye-open"></i> List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-eye-close"></i> List Closed Trouble Tickets', 'url'=>array('closedindex')),
);
?>

<h1>Create Trouble Ticket</h1>

<?php echo $this->renderPartial('_form', array('ticket'=>$ticket, 'file'=>$file)); ?>