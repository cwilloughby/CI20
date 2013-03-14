<?php
/* @var $this CrtCaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Crt Cases',
);

$this->menu=array(
	array('label'=>'Create CrtCase', 'url'=>array('create')),
	array('label'=>'Manage CrtCase', 'url'=>array('admin')),
);
?>

<h1>Crt Cases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
