<?php
/* @var $this TroubleTicketsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Trouble Tickets',
);

$this->menu=array(
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Create Trouble Ticket', 'url'=>array('create')),
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin')),
);
?>

<h1>Closed Trouble Tickets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_closedview',
)); ?>
