<?php
/* @var $this TroubleTicketsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Closed Trouble Tickets';

$this->breadcrumbs=array(
	'Trouble Tickets',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-eye-open"></i> List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-eye-close"></i> List Closed Trouble Tickets', 'url'=>array('closedindex')),
);
?>

<h1>Closed Trouble Tickets</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_closedview',
	'sortableAttributes'=>array(
		'ticketid',
		'closedate',
	),
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}"
)); ?>
