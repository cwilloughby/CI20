<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TroubleTickets', 'url'=>array('index')),
	array('label'=>'Manage TroubleTickets', 'url'=>array('admin')),
);
?>

<h1>Create TroubleTickets</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>