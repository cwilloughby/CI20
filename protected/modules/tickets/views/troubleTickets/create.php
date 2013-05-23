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
	array('label'=>'Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'List Closed Trouble Tickets', 'url'=>array('closedindex')),
);
?>

<h1>Create Trouble Ticket</h1>

<?php echo $this->renderPartial('_form', array('ticket'=>$ticket, 'file'=>$file)); ?>