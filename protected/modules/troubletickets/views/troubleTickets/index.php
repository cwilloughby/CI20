<?php
/* @var $this TroubleTicketsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Trouble Tickets',
);

$this->menu=array(
	array('label'=>'Create TroubleTickets', 'url'=>array('create')),
	array('label'=>'Manage TroubleTickets', 'url'=>array('admin')),
);
?>

<h1>Trouble Tickets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
