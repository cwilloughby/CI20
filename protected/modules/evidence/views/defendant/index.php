<?php
/* @var $this DefendantController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Defendants',
);

$this->menu=array(
	array('label'=>'Create Defendant', 'url'=>array('create')),
	array('label'=>'Manage Defendant', 'url'=>array('admin')),
);
?>

<h1>Defendants</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
