<?php
/* @var $this TroubleTicketsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Open Trouble Tickets';

$this->breadcrumbs=array(
	'Trouble Tickets',
);

$this->menu2=array(
	array('label'=>'Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'Create Ticket', 'url'=>array('create')),
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'List Closed Trouble Tickets', 'url'=>array('closedindex')),
);
?>

<h1>Open Trouble Tickets</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}",
	'sortableAttributes'=>array(
		'ticketid',
	),
)); ?>
