<?php
/* @var $this TroubleTicketsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Open Trouble Tickets';

$this->breadcrumbs=array(
	'Trouble Tickets',
);

$this->menu=array(
	array('label'=>'Closed Trouble Tickets', 'url'=>array('closedindex')),
	array('label'=>'Create Trouble Ticket', 'url'=>array('create')),
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
);
?>

<h1>Open Trouble Tickets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes'=>array(
		'opendate',
	),
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}"
)); ?>
