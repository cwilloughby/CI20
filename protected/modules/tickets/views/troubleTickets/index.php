<?php
/* @var $this TroubleTicketsController */
/* @var $dataProvider CActiveDataProvider */
/* @var $status String */

$this->pageTitle = Yii::app()->name . ' - ' . $status . ' Trouble Tickets';

$this->breadcrumbs=array(
	'Trouble Tickets',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-eye-open"></i> List Open Trouble Tickets', 'url'=>array('index', 'status'=>'Open')),
	array('label'=>'<i class="icon icon-eye-close"></i> List Closed Trouble Tickets', 'url'=>array('index', 'status'=>'Closed')),
);
?>

<?php echo "<h1>" .$status . " Trouble Tickets</h1>"; ?>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}",
	'sortableAttributes'=>array(
		'ticketid',
	),
)); ?>
